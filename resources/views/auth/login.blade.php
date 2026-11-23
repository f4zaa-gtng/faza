@extends('layouts.app')

@section('title', 'Masuk | ' . config('app.name'))

@section('content')
    <section class="container auth-layout">
        <div class="auth-intro">
            <span class="dashboard-pill"><span aria-hidden="true">✦</span> SELLER MODE ON</span>
            <h1>Senang melihat tokomu berkembang.</h1>
            <p>Masuk untuk mengelola produk, memantau stok, dan menjaga tokomu tetap tertata.</p>
            <div class="auth-showcase" aria-hidden="true">
                <span>🚀</span>
                <div><strong>Back to business</strong><small>Produk dan stok, satu tempat.</small></div>
            </div>
        </div>
        <div class="form-card auth-card">
            <h2>Masuk ke akun seller</h2>
            <p class="auth-caption">Kelola produk tokomu dengan mudah.</p>
            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                </div>
                <div class="field">
                    <label for="password">Kata sandi</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>
                </div>
                <label class="checkbox-label" for="remember">
                    <input id="remember" name="remember" type="checkbox" value="1">
                    Ingat saya
                </label>
                <button type="submit" class="button primary auth-submit">Masuk</button>
            </form>
            <p class="auth-switch">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
        </div>
    </section>
@endsection
