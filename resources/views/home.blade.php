@extends('layouts.app')

@section('title', auth()->check() ? 'Dashboard Seller | ' . config('app.name') : config('app.name') . ' | Seller Space')

@section('content')
    @auth
        <section class="container dashboard-page">
            <div class="dashboard-hero">
                <div class="dashboard-hero-copy">
                    <span class="dashboard-pill"><span aria-hidden="true">✦</span> SELLER MODE ON</span>
                    <h1>Hai, {{ Str::words(auth()->user()->name, 1, '') }} 👋<br>Tokomu siap naik level?</h1>
                    <p>Gas cek produk, harga, dan stok. Semua beres dari satu tempat.</p>
                    <a href="{{ route('admin.products.create') }}" class="button dashboard-hero-button">+ Tambah Produk</a>
                </div>
                <div class="dashboard-hero-art" aria-hidden="true">
                    <span class="dashboard-art-orbit"></span>
                    <span class="dashboard-art-sparkle sparkle-one">✦</span>
                    <span class="dashboard-art-sparkle sparkle-two">✳</span>
                    <span class="dashboard-art-rocket">🚀</span>
                    <div class="dashboard-art-card">
                        <span class="dashboard-art-card-label">STOCK CHECK</span>
                        <strong>Looks good ✨</strong>
                        <span class="dashboard-art-card-meter"><i></i></span>
                    </div>
                    <span class="dashboard-art-sticker">GOOD<br>VIBES</span>
                </div>
            </div>

            <div class="stats-grid dashboard-stats">
                <article class="dashboard-stat stat-orange">
                    <div class="dashboard-stat-top">
                        <span class="dashboard-stat-icon" aria-hidden="true">📦</span>
                        <span class="dashboard-stat-tag">CATALOG</span>
                    </div>
                    <h3>{{ number_format($totalProducts) }}</h3>
                    <p>Total produk</p>
                    <span class="dashboard-stat-decoration" aria-hidden="true">✦</span>
                </article>
                <article class="dashboard-stat stat-lime">
                    <div class="dashboard-stat-top">
                        <span class="dashboard-stat-icon" aria-hidden="true">🧃</span>
                        <span class="dashboard-stat-tag">IN THE BAG</span>
                    </div>
                    <h3>{{ number_format($totalStock) }}</h3>
                    <p>Total stok tersedia</p>
                    <span class="dashboard-stat-decoration" aria-hidden="true">↗</span>
                </article>
                <article class="dashboard-stat stat-lilac">
                    <div class="dashboard-stat-top">
                        <span class="dashboard-stat-icon" aria-hidden="true">⚡</span>
                        <span class="dashboard-stat-tag">LOW STOCK</span>
                    </div>
                    <h3>{{ number_format($lowStockProducts) }}</h3>
                    <p>Produk perlu restock</p>
                    <span class="dashboard-stat-decoration" aria-hidden="true">!</span>
                </article>
                <a href="{{ route('admin.products.create') }}" class="dashboard-add-card">
                    <span class="dashboard-add-icon" aria-hidden="true">＋</span>
                    <strong>Got something new?</strong>
                    <span>Tambah produk ke tokomu <span aria-hidden="true">↗</span></span>
                </a>
            </div>

            <section class="dashboard-recent">
                <div class="section-head">
                    <div>
                        <p class="dashboard-section-kicker">THE LATEST DROPS</p>
                        <h2>Produk terbaru</h2>
                        <p class="admin-description">Update terbaru dari inventaris tokomu.</p>
                    </div>
                    <a href="{{ route('admin.products.index') }}">Lihat semua <span aria-hidden="true">↗</span></a>
                </div>

                @if ($recentProducts->isEmpty())
                    <div class="empty-state dashboard-empty">
                        <span class="dashboard-empty-icon" aria-hidden="true">📦</span>
                        <h3>Inventarismu masih kosong</h3>
                        <p>Tambahkan produk pertama agar stok toko mulai tercatat.</p>
                        <a href="{{ route('admin.products.create') }}" class="button primary small">Tambah Produk</a>
                    </div>
                @else
                    <div class="table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>{{ number_format($product->stock) }}</td>
                                        <td>
                                            <span class="stock-pill {{ $product->stock <= 5 ? 'stock-low' : 'stock-ok' }}">
                                                {{ $product->stock <= 5 ? 'Restock yuk' : 'Aman' }}
                                            </span>
                                        </td>
                                        <td><a href="{{ route('admin.products.edit', $product) }}" class="button secondary small">Edit</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </section>
    @else
        <section class="container">
            <div class="dashboard-hero seller-landing-hero">
                <div class="dashboard-hero-copy">
                    <span class="dashboard-pill"><span aria-hidden="true">✦</span> {{ strtoupper(config('app.name')) }} SELLER SPACE</span>
                    <h1>Kelola produk tokomu, tanpa ribet.</h1>
                    <p>Catat barang yang kamu jual, atur harga dan stok, lalu pantau semuanya dari satu dashboard.</p>
                    <div class="cta-row">
                        <a href="{{ route('register') }}" class="button dashboard-hero-button">Daftar sebagai seller <span aria-hidden="true">↗</span></a>
                        <a href="{{ route('login') }}" class="button seller-login-button">Masuk ke akun</a>
                    </div>
                </div>

                <div class="dashboard-hero-art" aria-hidden="true">
                    <span class="dashboard-art-orbit"></span>
                    <span class="dashboard-art-sparkle sparkle-one">✦</span>
                    <span class="dashboard-art-sparkle sparkle-two">✳</span>
                    <span class="dashboard-art-rocket">🚀</span>
                    <div class="dashboard-art-card">
                        <span class="dashboard-art-card-label">YOUR SELLER SPACE</span>
                        <strong>Ready to grow ✨</strong>
                        <span class="dashboard-art-card-meter"><i></i></span>
                    </div>
                    <span class="dashboard-art-sticker">SELLER<br>ENERGY</span>
                </div>
            </div>
        </section>

        <section class="container section">
            <div class="seller-benefits">
                <article class="info-card">
                    <span class="info-icon" aria-hidden="true">▦</span>
                    <h3>Kelola produk</h3>
                    <p>Tambah, ubah, dan hapus produk tokomu kapan saja.</p>
                </article>
                <article class="info-card">
                    <span class="info-icon" aria-hidden="true">#</span>
                    <h3>Pantau stok</h3>
                    <p>Lihat jumlah stok agar inventaris tetap teratur.</p>
                </article>
                <article class="info-card">
                    <span class="info-icon" aria-hidden="true">⌂</span>
                    <h3>Dashboard sederhana</h3>
                    <p>Ringkasan produk dan stok tampil setelah kamu masuk.</p>
                </article>
            </div>
        </section>
    @endauth
@endsection
