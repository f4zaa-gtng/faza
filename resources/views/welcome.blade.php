@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <section class="container">
        <div class="empty-state">
            <span class="brand-mark" aria-hidden="true">M</span>
            <h1>Selamat datang di {{ config('app.name') }}</h1>
            <p>Dashboard seller untuk mengelola produk dan stok tokomu.</p>
            <a href="{{ route('home') }}" class="button primary">Buka dashboard</a>
        </div>
    </section>
@endsection
