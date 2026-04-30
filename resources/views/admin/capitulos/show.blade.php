@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2>Capítulo: {{ $capitulo->nombre }}</h2>

    <div class="card p-4">
    <p>Descripción: {{ $capitulo->descripcion }}</p>
    <p><strong>Libro:</strong> {{ $capitulo->libro->titulo ?? 'N/A' }}</p>
    <p><strong>Autores:</strong>
        @if($capitulo->autores->count())
            @foreach($capitulo->autores as $autor)
                {{ $autor->nombre }} {{ $autor->apellido }}<br>
            @endforeach
        @else
            Sin autores
        @endif
    </p>
    <p><strong>Cita:</strong> {{ $capitulo->cita_articulo }}</p>
    <p><strong>Estado:</strong> {{ $capitulo->estado ? 'Activo' : 'Inactivo' }}</p>
    </div>

    <div class="mt-3">
    <a href="{{ route('admin.capitulos.edit',$capitulo) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('admin.capitulos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
