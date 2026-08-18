<div class="mb-3">
    <label class="form-label">Nama Produk</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product?->name) }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $product?->description) }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Harga (Rp)</label>
        <input type="number" step="0.01" min="0" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product?->price) }}" required>
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Stok</label>
        <input type="number" min="0" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product?->stock) }}" required>
        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Gambar Produk</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
    @if($product?->image)
        <img src="{{ $product->image }}" width="120" height="90" style="object-fit: cover" class="rounded mt-2" alt="">
    @endif
</div>
<div class="mb-4 form-check form-switch">
    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" {{ old('is_active', $product?->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="isActive">Produk aktif (tampil di toko)</label>
</div>