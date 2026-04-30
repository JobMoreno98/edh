@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Nueva Publicación</h2>

    <form action="{{ route('admin.publicaciones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="10" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" >
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-select" required>
                <option value="convocatoria">Convocatoria</option>
                <option value="noticia">Noticia</option>
                <option value="evento">Evento</option>
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.publicaciones.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
