@extends('layouts.app')

@section('title', 'Daftar | ' . config('app.name'))

@section('content')
    <section class="container auth-layout">
        <div class="auth-intro">
            <span class="dashboard-pill"><span aria-hidden="true">✦</span> YOUR SELLER ERA</span>
            <h1>Semua produk tokomu, lebih mudah dikelola.</h1>
            <p>Buat akun seller untuk mencatat produk dan mengatur stok dalam satu dashboard.</p>
            <div class="auth-showcase" aria-hidden="true">
                <span>✨</span>
                <div><strong>Start something good</strong><small>Tokomu, caramu, gayamu.</small></div>
            </div>
        </div>
        <div class="form-card auth-card">
            <h2>Daftar sebagai seller</h2>
            <p class="auth-caption">Buat akun untuk mulai mengelola produk tokomu.</p>
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label for="name">Nama lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
                </div>
                <div class="field">
                    <label for="password">Kata sandi</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" minlength="8" required>
                    <small>Gunakan minimal 8 karakter.</small>
                </div>
                <div class="field">
                    <label for="password_confirmation">Ulangi kata sandi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="8" required>
                </div>
                <button type="submit" class="button primary auth-submit">Daftar</button>
            </form>
            <p class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
        </div>
    </section>
@endsection
