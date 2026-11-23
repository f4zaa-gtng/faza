@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <section class="container">
        <div class="section-head">
            <div>
                <p class="eyebrow">Produk Baru</p>
                <h1>Tambah Produk</h1>
            </div>
            <a href="{{ route('admin.products.index') }}" class="button secondary">Kembali</a>
        </div>

        <div class="form-card admin-form-card">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div class="field">
                        <label for="name">Nama Produk</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                    </div>

                    <div class="field">
                        <label for="price">Harga</label>
                        <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price') }}" required>
                    </div>

                    <div class="field">
                        <label for="stock">Stok</label>
                        <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', 0) }}" required>
                    </div>
                </div>

                <div class="field description-field">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description">{{ old('description') }}</textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="button primary">Simpan Produk</button>
                    <a href="{{ route('admin.products.index') }}" class="button secondary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection
