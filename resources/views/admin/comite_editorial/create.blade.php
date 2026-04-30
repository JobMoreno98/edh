@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Nuevo Miembro</h2>

    <form action="{{ route('admin.comite_editorial.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="dependencia" class="form-label">Dependencia</label>
            <input type="text" name="dependencia" id="dependencia" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <input type="text" name="pais" id="pais" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.comite_editorial.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
