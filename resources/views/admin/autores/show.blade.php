@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Detalles del Autor</h2>

    <div class="card p-4">
        <h3>{{ $autor->nombre }} {{ $autor->apellido }}</h3>
        <p><strong>Estado:</strong>
            <span class="badge {{ $autor->estado ? 'bg-success' : 'bg-danger' }}">
                {{ $autor->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </p>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.autores.edit', $autor) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('admin.autores.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
