@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Detalles de la Serie</h2>

    <div class="card p-4">
        <h3>{{ $serie->nombre }}</h3>
        <p><strong>Descripción:</strong> {{ $serie->descripcion ?? 'Sin descripción' }}</p>
        <p><strong>Estado:</strong>
            <span class="badge {{ $serie->estado ? 'bg-success' : 'bg-danger' }}">
                {{ $serie->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </p>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.series.edit', $serie) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
