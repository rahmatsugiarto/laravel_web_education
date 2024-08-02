@extends('layouts.app')

@section('content')
<head>
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
</head>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Materi Edukasi</h1>
    @if ($materials->isEmpty())
        <div class="alert alert-info" role="alert">
            Belum ada materi edukasi.
        </div>
    @else
        <div class="list-group">
            @foreach ($materials as $material)
                <div class="list-group-item border-0 mb-3 rounded shadow-sm">
                    <div class="d-flex flex-column">
                        <h5 class="mb-2">{{ $material->title }}</h5>
                        <p class="text-muted mb-2">{{ $material->description }}</p>
                        <p class="text-muted mb-2">
                            <small>Dibuat oleh: <strong>{{ $material->user->name }}</strong> pada {{ $material->created_at->format('d M Y') }}</small>
                        </p>

                        @if ($material->type == 'article')
                            <!-- Handle article type if needed -->
                        @elseif ($material->type == 'image' && $material->file_path)
                            <div class="image-container mt-2">
                                <img src="{{ asset('storage/' . $material->file_path) }}" alt="{{ $material->title }}" class="img-fluid rounded">
                            </div>
                        @elseif ($material->type == 'audio' && $material->file_path)
                            <audio controls class="w-100 mt-2">
                                <source src="{{ asset('storage/' . $material->file_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @elseif ($material->type == 'video' && $material->file_path)
                            <video controls class="w-100 mt-2 rounded">
                                <source src="{{ asset('storage/' . $material->file_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @elseif ($material->type == 'pdf' && $material->file_path)
                            <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-outline-primary mt-2">Lihat PDF</a>
                        @endif

                        @auth
                        <br>
                            <div class="mt-3">
                                <form method="POST" action="{{ route('comments.store') }}">
                                    @csrf
                                    <input type="hidden" name="educational_material_id" value="{{ $material->id }}">
                                    <div class="mb-3 d-flex align-items-center">
                                        <textarea name="content" class="form-control mr-2" rows="1" placeholder="Tambahkan komentar..."></textarea>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </form>
                                @if($material->comments->isNotEmpty())
                                    <h5 class="mt-4">Komentar:</h5>
                                @endif
                                <ul class="list-group">
                                    @foreach ($material->comments as $comment)
                                        <li class="list-group-item border-0 rounded shadow-sm mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong>{{ $comment->user->name }}</strong>
                                                <small class="text-muted">{{ $comment->created_at->format('d M Y H:i') }}</small>
                                            </div>
                                            <p class="mt-2">{{ $comment->content }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
