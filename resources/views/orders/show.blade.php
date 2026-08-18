@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Pesanan Saya</a></li>
            <li class="breadcrumb-item active">{{ $order->order_number }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card bg-white shadow-sm">
                <div class="card-header bg-white fw-bold">Item Pesanan</div>
                <div class="card-body p-0">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="3" class="text-end fw-bold">Total</td>
                                <td class="text-end price fs-5">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card bg-white shadow-sm mb-3">
                <div class="card-header bg-white fw-bold">Status Pesanan</div>
                <div class="card-body">
                    @include('partials.order-status-badge', ['status' => $order->status, 'large' => true])
                </div>
            </div>
            <div class="card bg-white shadow-sm">
                <div class="card-header bg-white fw-bold">Pengiriman</div>
                <div class="card-body">
                    <p class="mb-1"><strong>{{ $order->customer_name }}</strong></p>
                    @if($order->customer_phone)<p class="mb-1">{{ $order->customer_phone }}</p>@endif
                    <p class="mb-0 text-muted">{{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection