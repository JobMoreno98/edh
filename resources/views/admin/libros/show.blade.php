@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>{{ $libro->titulo }}</h2>

    <div class="card p-4">
    <p><strong>Volumen:</strong> {{ $libro->volumen }}</p>
    <p><strong>Año:</strong> {{ $libro->anio }}</p>
    <p><strong>Resumen:</strong> {{ $libro->resumen }}</p>
    <p><strong>Cita:</strong> {{ $libro->cita }}</p>
    <p><strong>ISBN:</strong> {{ $libro->isbn }}</p>
    <p><strong>ISBN Colección:</strong> {{ $libro->isbn_coleccion }}</p>
    <p><strong>Palabras clave:</strong> {{ $libro->palabras_clave }}</p>
    <p><strong>DOI:</strong> {{ $libro->doi }}</p>
    <p><strong>Documento:</strong> <a href="{{ asset('storage/' . $libro->pdf) }}" target="_blank">Ver PDF</a></p>
    <p><strong>Serie:</strong> {{ $libro->serie->nombre ?? '-' }}</p>

    @if($libro->imagen)
        <p><img src="{{ asset('storage/'.$libro->imagen) }}" alt="{{ $libro->titulo }}" width="150"></p>
    @endif
    

    <p><strong>Estado:</strong> {{ $libro->estado ? 'Activo' : 'Inactivo' }}</p>

    <h4>Autores</h4>
    <p>
        {{ $libro->autores->map(function($a) {
            return $a->pivot->rol === 'autor_libro'
                ? $a->nombre . ' ' . $a->apellido
                : $a->nombre . ' ' . $a->apellido . ' (' . $a->pivot->rol . ')';
        })->join(', ') ?: '-' }}
    </p>


    </div>

    <div class="mt-3">
    <a href="{{ route('admin.libros.edit',$libro) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">Volver</a>
    </div>

</div>
@endsection


