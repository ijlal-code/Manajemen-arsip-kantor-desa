@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-4">
        <div class="card-header bg-warning text-dark rounded-top-4">
            <h4>✏️ Edit Arsip</h4>
        </div>
        <div class="card-body">
            <form action="{{ route(auth()->user()->role . '.arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul_arsip" class="form-label">Judul Arsip</label>
                    <input type="text" class="form-control" id="judul_arsip" name="judul_arsip" value="{{ $arsip->judul_arsip }}" required>
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" name="kategori_id" id="kategori_id" required>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}" {{ $k->id == $arsip->kategori_id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_upload" class="form-label">Tanggal Upload</label>
                    <input type="date" class="form-control" id="tanggal_upload" name="tanggal_upload" value="{{ $arsip->tanggal_upload }}" required>
                </div>

                <div class="mb-3">
                    <label for="file_arsip" class="form-label">Ganti File (Opsional)</label>
                    <input type="file" class="form-control" id="file_arsip" name="file_arsip">
                </div>

                <button type="submit" class="btn btn-warning">🔄 Update Arsip</button>
                @php $role = auth()->user()->role; @endphp
                <a href="{{ route($role . '.arsip.index') }}" class="btn btn-secondary">↩️ Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
