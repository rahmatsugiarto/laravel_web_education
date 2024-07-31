@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Materi Menunggu Persetujuan</h1>
    @if ($materials->isEmpty())
        <p>Tidak ada materi yang menunggu persetujuan.</p>
    @else
        <ul class="list-group">
            @foreach ($materials as $material)
                <li class="list-group-item">
                    <h3>{{ $material->title }}</h3>
                    <p>{{ $material->description }}</p>
                    <p>Status: <span class="badge badge-warning">Menunggu Persetujuan</span></p>
                    <form method="POST" action="{{ route('admin.materials.approve', $material->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection