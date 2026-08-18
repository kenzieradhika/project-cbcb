@extends('admin.layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <h4 class="mb-4">Tambah Produk</h4>
    <div class="card border-0 shadow-sm" style="max-width: 640px;">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.products._form', ['product' => null])
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection