@extends('layouts.app')

@section('content')
<head>
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
</head>
<div class="container mt-5">
    <h1 class="mb-4">Buat Materi Edukasi Baru</h1>
    <div class="card p-4 shadow-sm rounded">
        <form method="POST" action="{{ route('materials.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipe</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="article" {{ old('type') == 'article' ? 'selected' : '' }}>Artikel</option>
                    <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Gambar</option>
                    <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                    <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">File (Opsional)</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection

