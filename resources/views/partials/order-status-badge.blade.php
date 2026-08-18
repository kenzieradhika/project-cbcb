@php
    $colors = [
        'pending' => 'warning',
        'paid' => 'info',
        'shipped' => 'primary',
        'completed' => 'success',
        'cancelled' => 'danger',
    ];
    $labels = [
        'pending' => 'Menunggu',
        'paid' => 'Dibayar',
        'shipped' => 'Dikirim',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
    ];
@endphp
<span class="badge text-bg-{{ $colors[$status] ?? 'secondary' }} {{ isset($large) && $large ? 'fs-6' : '' }}">
    {{ $labels[$status] ?? ucfirst($status) }}
</span>