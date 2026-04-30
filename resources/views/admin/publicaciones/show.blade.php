@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Detalles de la Publicación</h2>

    <div class="card p-4">
        <h3>{{ $publicacione->titulo }}</h3>
        <p><strong>Descripción:</strong> {{ $publicacione->descripcion }}</p>
        <p><strong>Fecha:</strong> {{ $publicacione->fecha }}</p>
        <p><strong>Tipo:</strong> {{ ucfirst($publicacione->tipo) }}</p>
        <p><strong>Estado:</strong>
            <span class="badge {{ $publicacione->estado ? 'bg-success' : 'bg-danger' }}">
                {{ $publicacione->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </p>
        @if($publicacione->imagen)
            <p><strong>Imagen:</strong></p>
            <img src="{{ asset('storage/'.$publicacione->imagen) }}" width="300">
        @endif
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.publicaciones.edit', $publicacione) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('admin.publicaciones.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
