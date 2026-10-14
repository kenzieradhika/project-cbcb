@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-md-6">
            <img src="{{ $product->image_url ?: 'https://placehold.co/800x600?text=Produk' }}" class="img-fluid rounded-4 w-100" alt="{{ $product->name }}" style="object-fit: cover; max-height: 480px;">
        </div>
        <div class="col-md-6">
            <h1 class="mb-2">{{ $product->name }}</h1>
            <h2 class="price mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>

            @if($product->stock > 0)
                <span class="badge text-bg-success mb-3"><i class="bi bi-check-circle me-1"></i>Stok: {{ $product->stock }}</span>
            @else
                <span class="badge text-bg-danger mb-3">Stok Habis</span>
            @endif

            <p class="lead">{{ $product->description }}</p>

            @auth
                <form action="{{ route('cart.add', $product) }}" method="POST" class="d-flex gap-2 align-items-center">
                    @csrf
                    <div class="input-group" style="max-width: 160px;">
                        <button type="button" class="btn btn-outline-secondary" onclick="qtyDec()">-</button>
                        <input type="number" id="qty" name="quantity" value="1" min="1" max="{{ max($product->stock, 1) }}" class="form-control text-center">
                        <button type="button" class="btn btn-outline-secondary" onclick="qtyInc({{ $product->stock }})">+</button>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg" @if($product->stock < 1) disabled @endif>
                        <i class="bi bi-cart-plus me-1"></i>Masukkan ke Keranjang
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Masuk untuk Membeli</a>
            @endauth
        </div>
    </div>

    <h3 class="mt-5 mb-3">Produk Lainnya</h3>
    <div class="row g-4">
        @foreach($related as $product)
            <div class="col-6 col-md-3">
                <div class="card product-card h-100">
                    <img src="{{ $product->image_url ?: 'https://placehold.co/600x400?text=Produk' }}" class="card-img-top product-img" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
<script>
    function qtyInc(max) {
        const el = document.getElementById('qty');
        if (parseInt(el.value) < max) el.value = parseInt(el.value) + 1;
    }
    function qtyDec() {
        const el = document.getElementById('qty');
        if (parseInt(el.value) > 1) el.value = parseInt(el.value) - 1;
    }
</script>
@endpush