@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Dashboard</h2>
    <p>Selamat datang, {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</p>
    <hr>

    @if(auth()->user()->role === 'admin')
        <a href="{{ route('users.index') }}" class="btn btn-primary mb-2">Kelola Pengguna</a>
        <a href="{{ route('kategori.index') }}" class="btn btn-success mb-2">Kelola Kategori Arsip</a>
        <a href="{{ route('arsip.index') }}" class="btn btn-warning mb-2">Lihat Semua Arsip</a>

</div>
@endsection
