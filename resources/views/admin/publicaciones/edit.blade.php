@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Editar Publicación</h2>

    <form action="{{ route('admin.publicaciones.update', $publicacione) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $publicacione->titulo }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="10" class="form-control" required>{{ $publicacione->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            
            @if($publicacione->fecha)
                <!-- Checkbox para eliminar -->
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="eliminar_fecha" id="eliminar_fecha" value="1">
                    <label class="form-check-label" for="eliminar_fecha">
                        Eliminar fecha actual
                    </label>
                </div>
            @endif

            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $publicacione->fecha }}">
        </div>



        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            
            @if($publicacione->imagen)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$publicacione->imagen) }}" width="100">
                </div>
                <!-- Checkbox para eliminar -->
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="eliminar_imagen" id="eliminar_imagen" value="1">
                    <label class="form-check-label" for="eliminar_imagen">
                        Eliminar imagen actual
                    </label>
                </div>
            @endif

            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>


        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ $publicacione->estado ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$publicacione->estado ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-select" required>
                <option value="convocatoria" {{ $publicacione->tipo == 'convocatoria' ? 'selected' : '' }}>Convocatoria</option>
                <option value="noticia" {{ $publicacione->tipo == 'noticia' ? 'selected' : '' }}>Noticia</option>
                <option value="evento" {{ $publicacione->tipo == 'evento' ? 'selected' : '' }}>Evento</option>
            </select>
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.publicaciones.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection


