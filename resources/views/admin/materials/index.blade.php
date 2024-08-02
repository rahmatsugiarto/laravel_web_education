@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Materi Menunggu Persetujuan</h1>
    @if ($materials->isEmpty())
        <div class="alert alert-info" role="alert">
            Tidak ada materi yang menunggu persetujuan.
        </div>
    @else
        <div class="list-group">
            @foreach ($materials as $material)
                <div class="list-group-item border-0 mb-3 shadow-sm rounded">
                    <h3 class="h5">{{ $material->title }}</h3>
                    <p class="text-muted">{{ $material->description }}</p>
                    <p class="text-muted">Dibuat oleh: <strong>{{ $material->user->name }}</strong></p>
                    <p class="text-muted">Tanggal Pembuatan: <strong>{{ $material->created_at->format('d M Y H:i') }}</strong></p>

                    @if ($material->file_path)
                        <div class="mt-3">
                            @if ($material->type == 'image')
                                <img src="{{ asset('storage/' . $material->file_path) }}" alt="{{ $material->title }}" class="img-fluid rounded">
                            @elseif ($material->type == 'audio')
                                <audio controls class="w-100 mt-2">
                                    <source src="{{ asset('storage/' . $material->file_path) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @elseif ($material->type == 'video')
                                <video controls class="w-100 mt-2 rounded">
                                    <source src="{{ asset('storage/' . $material->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @elseif ($material->type == 'pdf')
                                <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-outline-primary mt-2">Lihat PDF</a>
                            @endif
                        </div>
                    @endif

                    <p class="mt-3">
                        Status: <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                    </p>
                    <form method="POST" action="{{ route('admin.materials.approve', $material->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success mt-2">Setujui</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
