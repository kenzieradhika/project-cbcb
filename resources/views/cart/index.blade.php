@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
    <h2 class="mb-4"><i class="bi bi-cart3 me-2"></i>Keranjang Belanja</h2>

    @if(empty($items))
        <div class="text-center py-5">
            <i class="bi bi-cart-x display-1 text-muted"></i>
            <h4 class="mt-3">Keranjang kosong</h4>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle bg-white rounded-3 overflow-hidden">
                <thead class="table-dark">
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $item['product']->image ?: 'https://placehold.co/200x150?text=Produk' }}" width="64" height="48" style="object-fit: cover" class="rounded" alt="">
                                    <div>
                                        <a href="{{ route('products.show', $item['product']) }}" class="text-decoration-none text-dark fw-semibold">{{ $item['product']->name }}</a>
                                        @if($item['product']->stock < $item['quantity'])
                                            <div><span class="badge text-bg-warning">Stok tersisa {{ $item['product']->stock }}</span></div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="d-inline-flex gap-1">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock }}" class="form-control form-control-sm text-center" style="width: 70px;">
                                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-repeat"></i></button>
                                </form>
                            </td>
                            <td class="text-end fw-bold">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                            <td class="text-end">
                                <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card bg-white shadow-sm mt-4">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Total: <span class="price fs-4">Rp {{ number_format($total, 0, ',', '.') }}</span></h5>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">Lanjut Belanja</a>
                    <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg"><i class="bi bi-credit-card me-1"></i>Checkout</a>
                </div>
            </div>
        </div>
    @endif
@endsection