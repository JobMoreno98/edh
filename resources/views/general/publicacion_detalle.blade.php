@extends('layouts.layout_general')

@section('contenido')

<!-- {{-- HERO con logo a lo largo de la pantalla --}} -->
<section class="w-100" style="background-color: transparent; padding: 0; margin: 0;">
    <div class="container-fluid p-0 m-0">
        <img src="{{ asset('imagenes/logos/1_LOGO_PRINCIPAL_con_titulo_ROJO.jpg') }}" 
             alt="Logo Estudios de la Humanidad" 
             class="img-fluid w-100" 
             style="height: 50px; object-fit: contain; display: block;">
    </div>
</section>

{{-- Hero de convocatoria --}}
{{-- <section class="text-center py-5"> --}}
    <section class="text-center py-5 bg-light">

    <div class="container">
        <h1 class="display-5 fw-bold">{{ $publicacion->titulo }}</h1>
        {{-- <p class="lead text-muted">{{ $publicacion->tipo }}</p> --}}
        @if($publicacion->fecha)
            <small class="text-muted">{{ \Carbon\Carbon::parse($publicacion->fecha)->format('d M, Y') }}</small>
        @endif

    </div>
</section>

{{-- Contenido principal --}}
<section class="container my-5">
    <div class="row justify-content-center align-items-center" style="max-width: 1200px; margin: auto;">

        
        <div class="col-md-6 d-flex flex-column justify-content-start">
            <p class="text-muted" style="text-align: justify;">{!! nl2br(e($publicacion->descripcion)) !!}</p>
        </div>

        @if($publicacion->imagen)
            <div class="col-md-6 d-flex align-items-center justify-content-center mt-3 mt-md-0">
                <img src="{{ asset('storage/' . $publicacion->imagen) }}" class="img-fluid rounded shadow" alt="Imagen de {{ $publicacion->titulo }}">
            </div>
        @endif

    </div>
</section>


@endsection
