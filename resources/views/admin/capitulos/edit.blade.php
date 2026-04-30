@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2>{{ isset($capitulo) ? 'Editar Capítulo' : 'Nuevo Capítulo' }}</h2>

    <form action="{{ isset($capitulo) ? route('admin.capitulos.update',$capitulo) : route('admin.capitulos.store') }}" method="POST">
        @csrf
        @if(isset($capitulo))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required
                   value="{{ old('nombre',$capitulo->nombre ?? '') }}">
        </div>

        {{-- <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" required
                   value="{{ old('descripcion',$capitulo->descripcion ?? '') }}">
        </div> --}}

        <div class="mb-3">
            <label for="descripcion" class="form-label">Sub capítulos (separados por salto de linea)</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="10">{{ old('descripcion',$capitulo->descripcion ?? '') }}</textarea>

        </div>

        <div class="mb-3">
            <label for="libro_id" class="form-label">Libro</label>
            <select name="libro_id" id="libro_id" class="form-select" required>
                <option value="">-- Seleccione libro --</option>
                @foreach($libros as $libro)
                    <option value="{{ $libro->id }}"
                        {{ (isset($capitulo) && $capitulo->libro_id==$libro->id) ? 'selected' : '' }}>
                        {{ $libro->titulo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="autores" class="form-label">Autores del capítulo</label>
            <select name="autores[]" id="autores" class="form-select" multiple>
                @foreach($autores as $autor)
                    <option value="{{ $autor->id }}"
                        {{ (isset($capitulo) && $capitulo->autores->contains($autor->id)) ? 'selected' : '' }}>
                        {{ $autor->nombre }} {{ $autor->apellido }}
                    </option>
                @endforeach
            </select>
            <small>Ctrl+Click o Cmd+Click para seleccionar varios autores</small>
        </div>

        <div class="mb-3">
            <label for="cita_articulo" class="form-label">Cita Artículo</label>
            <textarea name="cita_articulo" id="cita_articulo" class="form-control">{{ old('cita_articulo',$capitulo->cita_articulo ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ (isset($capitulo) && $capitulo->estado) ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ (isset($capitulo) && !$capitulo->estado) ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.capitulos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
