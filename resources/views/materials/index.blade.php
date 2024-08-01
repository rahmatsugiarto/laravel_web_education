@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Materi Edukasi</h1>
    @if ($materials->isEmpty())
        <p>Belum ada materi edukasi.</p>
    @else
        <ul class="list-group">
            @foreach ($materials as $material)
                <li class="list-group-item">
                    <h3>{{ $material->title }}</h3>
                    <p>{{ $material->description }}</p>
                    <p><small>Dibuat oleh: {{ $material->user->name }} pada {{ $material->created_at->format('d M Y') }}</small></p>
                    @if ($material->type == 'article')
                        <p>Artikel</p>
                    @elseif ($material->type == 'image' && $material->file_path)
                        <img src="{{ asset('storage/' . $material->file_path) }}" alt="{{ $material->title }}" style="max-width: 30%; height: auto;">
                    @elseif ($material->type == 'audio' && $material->file_path)
                        <audio controls>
                            <source src="{{ asset('storage/' . $material->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @elseif ($material->type == 'video' && $material->file_path)
                        <video controls style="max-width: 100%; height: auto;">
                            <source src="{{ asset('storage/' . $material->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @elseif ($material->type == 'pdf' && $material->file_path)
                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank">Lihat PDF</a>
                    @endif

                    @auth
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <input type="hidden" name="educational_material_id" value="{{ $material->id }}">
                            <div class="form-group">
                                <textarea name="content" class="form-control" rows="3" placeholder="Tambahkan komentar..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Kirim</button>
                        </form>
                        <br>
                        <h4>Komentar:</h4>
                        <ul class="list-group">
                            @foreach ($material->comments as $comment)
                                <li class="list-group-item">
                                    <strong>{{ $comment->user->name }}</strong> ({{ $comment->created_at->format('d M Y H:i') }})
                                    <p>{{ $comment->content }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endauth
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
