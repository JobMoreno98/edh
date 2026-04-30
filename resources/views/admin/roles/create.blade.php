@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2>Nuevo Rol</h2>

    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Rol</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
