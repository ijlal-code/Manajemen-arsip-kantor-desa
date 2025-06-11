@extends('layouts.app')

@section('content')
<div class="py-5" style="min-height: 100vh; background-color: #f8f9fa;">
    <div class="container">

        {{-- Alert sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary mb-0">📁 Kelola Kategori Arsip</h2>
                <small class="text-muted">Tambah, edit, atau hapus kategori arsip</small>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        {{-- Tombol Aksi dan Form Pencarian --}}
        <div class="row mb-3 align-items-center">
            <div class="col-md-4 mb-2 mb-md-0">
                <a href="{{ route('sekretaris.kategori.create') }}" class="btn btn-success w-100">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
                </a>
            </div>

            <div class="col-md-8">
                <form action="{{ route('sekretaris.kategori.index') }}" method="GET" class="row g-2 justify-content-end" role="search">
                    <div class="col-auto flex-grow-1">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="🔍 Cari kategori...">
                    </div>
                    <div class="col-auto d-flex gap-2">
                        <button type="submit" class="btn btn-primary fw-semibold">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <a href="{{ route('sekretaris.kategori.index') }}" class="btn btn-secondary fw-semibold">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Kategori --}}
        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-bordered bg-white">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Nama Kategori</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $index => $kat)
                        <tr>
                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                            <td class="align-middle">{{ $kat->nama_kategori }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('sekretaris.kategori.edit', $kat->id) }}" class="btn btn-sm btn-warning me-1 mb-1 mb-md-0">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('sekretaris.kategori.destroy', $kat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada kategori tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
