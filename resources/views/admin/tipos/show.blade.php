@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Detalles del Tipo</h2>

    <div class="card p-4">
        <h3>{{ $tipo->nombre }}</h3>
        <p><strong>Descripción:</strong> {{ $tipo->descripcion ?? 'Sin descripción' }}</p>
        <p><strong>Estado:</strong>
            <span class="badge {{ $tipo->estado ? 'bg-success' : 'bg-danger' }}">
                {{ $tipo->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </p>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.tipos.edit', $tipo) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('admin.tipos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
