@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Editar Tipo</h2>

    <form action="{{ route('admin.tipos.update', $tipo) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $tipo->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" class="form-control">{{ $tipo->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ $tipo->estado ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$tipo->estado ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.tipos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
