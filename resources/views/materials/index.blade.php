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
                    @if ($material->type == 'article')
                        <p>Artikel</p>
                    @elseif ($material->type == 'image')
                        <img src="{{ Storage::url($material->file_path) }}" alt="{{ $material->title }}"
                            style="max-width: 100%; height: auto;">
                    @elseif ($material->type == 'audio')
                        <audio controls>
                            <source src="{{ Storage::url($material->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @elseif ($material->type == 'video')
                        <video controls style="max-width: 100%; height: auto;">
                            <source src="{{ Storage::url($material->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif

                    @auth
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <input type="hidden" name="educational_material_id" value="{{ $material->id }}">
                            <div class="form-group">
                                <textarea name="content" class="form-control" rows="3"
                                    placeholder="Tambahkan komentar..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Kirim</button>
                        </form>

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