@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Detalles del Miembro</h2>

    <div class="card p-4">
        <p><strong>Nombre:</strong> {{ $miembro->nombre }}</p>
        <p><strong>Apellido:</strong> {{ $miembro->apellido }}</p>
        <p><strong>Dependencia:</strong> {{ $miembro->dependencia }}</p>
        <p><strong>País:</strong> {{ $miembro->pais }}</p>
        <p><strong>Estado:</strong>
            <span class="badge {{ $miembro->estado ? 'bg-success' : 'bg-danger' }}">
                {{ $miembro->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </p>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.comite_editorial.edit', $miembro) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('admin.comite_editorial.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
