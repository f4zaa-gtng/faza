@extends('layouts.app')

@section('title', 'Produk Saya | ' . config('app.name'))

@section('content')
    <section class="container">
        <div class="section-head">
            <div>
                <p class="eyebrow">Inventaris toko</p>
                <h1>Produk Saya</h1>
                <p class="admin-description">Kelola nama, harga, dan stok produk yang kamu jual.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="button primary">Tambah Produk</a>
        </div>

        <div class="admin-overview">
            <span class="admin-overview-icon" aria-hidden="true">▦</span>
            <span><strong>{{ $products->total() }}</strong><small>produk terdaftar</small></span>
        </div>

        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ Str::limit($product->description ?? '-', 70) }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="button secondary small">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button warning small" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state table-empty">
                                    <h3>Belum ada produk</h3>
                                    <p>Tambahkan produk pertama untuk mulai mengisi katalog tokomu.</p>
                                    <a href="{{ route('admin.products.create') }}" class="button primary small">Tambah Produk</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $products->links() }}
        </div>
    </section>
@endsection
