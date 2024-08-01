@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Materi Edukasi Baru</h1>
    <form method="POST" action="{{ route('materials.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="type">Tipe</label>
            <select name="type" id="type" class="form-control" required>
                <option value="article" {{ old('type') == 'article' ? 'selected' : '' }}>Artikel</option>
                <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Gambar</option>
                <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
            </select>
        </div>

        <div class="form-group">
            <label for="file">File (Opsional)</label>
            <input type="file" name="file" id="file" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
