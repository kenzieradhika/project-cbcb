<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Total units in the session cart that are still orderable. The cart page
     * and checkout both skip lines whose product is gone/inactive/out of stock,
     * so the navbar bubble must agree instead of summing every stored line.
     *
     * @param  array<int|string, int>  $cart  product id => quantity
     */
    public static function cartCount(array $cart): int
    {
        if (empty($cart)) {
            return 0;
        }

        $live = static::whereIn('id', array_keys($cart))
            ->where('is_active', true)
            ->where('stock', '>=', 1)
            ->pluck('id')
            ->all();

        return array_sum(array_intersect_key($cart, array_flip($live)));
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Usable <img src>. Admin uploads store a disk-relative path
     * ("products/ab.jpg") which is not a valid URL on its own; the seeder stores
     * absolute https URLs. Return each in the form a browser can load.
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (! $this->image) {
                return null;
            }

            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }

            return Storage::disk('public')->url($this->image);
        });
    }
}
