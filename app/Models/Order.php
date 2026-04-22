<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'customer_phone',
        'shipping_address',
        'status',
        'total',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * A unique order number. order_number has a unique index, so a random
     * collision would otherwise surface as a QueryException inside the checkout
     * transaction and lose the order; retry until the value is free.
     */
    public static function generateNumber(): string
    {
        do {
            $number = 'ORD-'.strtoupper(Str::random(10));
        } while (static::where('order_number', $number)->exists());

        return $number;
    }
}
