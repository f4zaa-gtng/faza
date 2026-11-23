<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name'))</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header class="site-header">
            <div class="container header-inner">
                <a href="{{ route('home') }}" class="brand">
                    <span class="brand-mark" aria-hidden="true">M</span>
                    <span>Metro<span class="brand-accent">Store</span></span>
                </a>
                <nav class="main-nav" aria-label="Navigasi utama">
                    @auth
                        <a href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Dashboard</a>
                        <a href="{{ route('admin.products.index') }}" class="nav-admin" @if (request()->routeIs('admin.products.*')) aria-current="page" @endif>Produk Saya</a>
                        <span class="nav-greeting">Hai, {{ Str::words(auth()->user()->name, 1, '') }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="nav-form">
                            @csrf
                            <button type="submit" class="nav-action">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Masuk</a>
                        <a href="{{ route('register') }}" class="nav-register">Daftar</a>
                    @endauth
                </nav>
            </div>
        </header>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if (session('info'))
            <div class="alert info">{{ session('info') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert error" role="alert">
                <strong>Periksa kembali data Anda.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main class="page-shell">
            @yield('content')
        </main>

        <footer class="site-footer">
            <div class="container">
                © {{ date('Y') }} {{ config('app.name') }}. Kelola inventaris tokomu dengan lebih praktis.
            </div>
        </footer>
    </body>
</html>
