@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-4">
        <div class="card-header bg-success text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h4>➕ Tambah Arsip Baru</h4>
                <a href="{{ route('sekretaris.kategori.create') }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-plus-circle"></i> Buat Kategori
                </a>
        </div>
        <div class="card-body">

        {{-- Alert jika kategori belum tersedia --}}
            @if ($kategori->isEmpty())
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Belum ada kategori arsip. Silakan buat kategori terlebih dahulu sebelum mengupload arsip.
                </div>
            @endif

            <form action="{{ route('sekretaris.arsip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
    <label for="judul_arsip" class="form-label">Judul Arsip</label>
    <input type="text" class="form-control @error('judul_arsip') is-invalid @enderror" id="judul_arsip" name="judul_arsip" value="{{ old('judul_arsip') }}" required>
    @error('judul_arsip')
    <div class="invalid-feedback">
        Judul arsip sudah dipakai.
    </div>
@enderror
</div>


                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" name="kategori_id" id="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_upload" class="form-label">Tanggal Upload</label>
                    <input type="date" class="form-control" id="tanggal_upload" name="tanggal_upload" required>
                </div>

                <div class="mb-3">
    <label for="file_arsip" class="form-label">File Arsip</label>
    <input type="file" class="form-control @error('file_arsip') is-invalid @enderror" id="file_arsip" name="file_arsip" required>
    @error('file_arsip')
        <div class="invalid-feedback">
        format file harus pdf, doc, docx
    </div>
    @enderror
</div>

                <button type="submit" class="btn btn-success">💾 Simpan Arsip</button>
                <a href="{{ route('sekretaris.arsip.index') }}" class="btn btn-secondary">↩️ Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
