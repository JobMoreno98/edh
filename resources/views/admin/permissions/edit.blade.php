@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2>Editar Permiso</h2>

    <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Permiso</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name', $permission->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
