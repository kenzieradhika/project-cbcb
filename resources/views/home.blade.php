@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="hero-cartoon p-5 mb-5">
        <div class="container py-4">
            <h1 class="display-4 fw-bold mb-3">TokoKita<br><span style="color: var(--retro-ink); background: var(--retro-mustard); padding: 0 .25rem;">Est. 2026</span></h1>
            <p class="lead mb-4">Produk pilihan dengan harga bersahabat. Belanja mudah, aman, dan cepat.</p>
            <a href="#produk" class="btn btn-cartoon btn-lg"><i class="bi bi-bag me-1"></i>Mulai Belanja</a>
        </div>
    </div>

    <h2 class="mb-4" id="produk">Produk Terbaru</h2>

    @if($products->count() === 0)
        <div class="alert alert-info">Belum ada produk tersedia. Silakan cek kembali nanti.</div>
    @endif

    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card product-card h-100">
                    <img src="{{ $product->image ?: 'https://placehold.co/600x400?text=Produk' }}" class="card-img-top product-img" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="card-text small text-muted">{{ Str::limit($product->description, 60) }}</p>
                        <div class="mt-auto">
                            <div class="price mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary flex-fill">Detail</a>
                                @auth
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm btn-primary" @if($product->stock < 1) disabled @endif>
                                            <i class="bi bi-cart-plus"></i>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                            @if($product->stock < 1)
                                <span class="badge text-bg-danger mt-2">Stok Habis</span>
                            @elseif($product->stock <= 5)
                                <span class="badge text-bg-warning mt-2">Sisa {{ $product->stock }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
@endsection