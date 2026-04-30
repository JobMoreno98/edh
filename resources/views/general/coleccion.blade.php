@extends('layouts.layout_general')

@section('contenido')
<div style="font-family: 'Cambria', sans-serif;">

<div class="d-flex justify-content-end mb-3">
    <form action="{{ route('general.buscar') }}" method="GET" class="d-flex gap-2">
        <input 
            type="text"
            name="q"
            placeholder="Buscar..."
            class="border p-2 rounded w-64"
        >
        <button 
            type="submit"
            class="btn btn-outline-dark"
        >
            Buscar
        </button>
    </form>
</div>

<h1 class="text-center fw-bold mt-5 mb-5">{{ $tipoSeleccionado->nombre }}</h1>

<div class="container">
    <div class="row justify-content-center g-4"> {{-- g-4 = espacio entre cards --}}
        @forelse($libros as $libro)
            <div class="col-md-6 col-lg-5 d-flex align-items-stretch">
                <div class="card shadow-sm d-flex flex-column border-0" style="max-width: 500px; margin: 0 auto;">

                    {{-- Imagen del libro --}}
                    @if($libro->imagen)
                        <img src="{{ Storage::url($libro->imagen) }}" 
                             class="card-img-top" 
                             style="height: 420px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;" 
                             alt="{{ $libro->titulo }}">
                    @else
                        <img src="{{ asset('images/default-libro.png') }}" 
                             class="card-img-top" 
                             style="height: 320px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;" 
                             alt="Sin imagen">
                    @endif

                    {{-- Contenido --}}
                    <div class="card-body bg-light d-flex flex-column justify-content-between" 
                         style="flex-grow: 1; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">

                        <div>
                            {{-- Volumen --}}
                            <p class="mb-1 fw-bold" style="color: #000;">
                                Volumen {{ $libro->volumen ?? '-' }}
                            </p>

                            {{-- Título --}}
                            <h5 class="card-title fw-bold mb-3" style="color: #000;">
                                {{ $libro->titulo }}
                            </h5>

                            {{-- Autores --}}
                            <p class="mb-3" style="font-size: 1rem;">
                                <strong>Autores:</strong><br>
                                {{ $libro->autores->map(function($a) {
                                    return $a->pivot->rol === 'autor_libro'
                                        ? $a->nombre . ' ' . $a->apellido
                                        : $a->nombre . ' ' . $a->apellido . ' (' . $a->pivot->rol . ')';
                                })->join(', ') ?: '-' }}
                            </p>

                            {{-- Cita --}}
                            <p class="mb-3" style="font-size: 1rem;">
                                <strong>Año</strong><br>
                                {{ $libro->anio ?? '-' }}
                            </p>

                            {{-- Serie --}}
                            @if(!empty($libro->serie?->nombre))
                                <p class="mb-3" style="font-size: 1rem;">
                                    <strong>Serie:</strong> {{ $libro->serie->nombre }}
                                </p>
                            @endif
                        </div>

                        {{-- Botón Detalles --}}
                        <div class="mt-auto">
                            <a href="{{ route('general.libro.detalle', $libro->id) }}" 
                               class="btn w-100 fw-semibold text-white" 
                               style="background-color: #FF6F00; border: none; transition: 0.3s;">
                               Detalles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>No hay libros para este tipo.</p>
            </div>
        @endforelse
    </div>
</div>

{{-- Estilos adicionales --}}
<style>
.card {
    min-height: 600px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
.card-body p {
    color: #333;
    line-height: 1.5;
}
.btn:hover {
    background-color: #e05f00 !important;
}
</style>
</div>
@endsection
