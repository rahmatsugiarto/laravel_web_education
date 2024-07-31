@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload Materi Edukasi</h1>
    <form method="POST" action="{{ route('materials.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Judul</label>
            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                value="{{ old('title') }}" required>
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                name="description" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="type">Tipe Materi</label>
            <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                <option value="article" {{ old('type') == 'article' ? 'selected' : '' }}>Artikel</option>
                <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Gambar</option>
                <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="file">File</label>
            <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file">
            @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection