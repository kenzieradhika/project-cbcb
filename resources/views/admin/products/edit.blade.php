@extends('admin.layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h4 class="mb-4">Edit Produk</h4>
    <div class="card border-0 shadow-sm" style="max-width: 640px;">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.products._form', ['product' => $product])
                <button class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection