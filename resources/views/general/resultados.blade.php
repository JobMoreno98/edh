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


{{-- <hr class="my-5"> --}}

<hr style="width: 150px; border: 2px solid #F2B81B; margin: 2rem auto; opacity: 1; border-radius: 2px;">


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


<div class="container my-5">
    <h2 class="text-2xl mb-3">
        Resultados de: "{{ $q }}"
    </h2>

    <div class="card mb-4 shadow-sm border-0" style="background-color:#F4F5F7;">
        <div class="card-body">

            @if($resultados->isEmpty())
                <p>No se encontraron resultados.</p>
            @else

                <ul class="list-unstyled">
                    @foreach($resultados as $item)
                        <li class="py-3">

                            {{-- -------------------------- --}}
                            {{-- CONTENIDO SI ES LIBRO      --}}
                            {{-- -------------------------- --}}
                            @if($item->tipo === 'libro')

                                <h3 class="font-bold text-lg">{{ $item->titulo }}</h3>

                                @if($item->volumen)
                                    <p><strong>Volumen:</strong> {{ $item->volumen }}</p>
                                @endif

                                @if($item->anio)
                                    <p><strong>Año:</strong> {{ $item->anio }}</p>
                                @endif

                                @if($item->nombre_autor)
                                    <p><strong>Autor(es):</strong> {{ $item->nombre_autor }}</p>
                                @endif

                                <a href="{{ route('general.libro.detalle', $item->id) }}" 
                                    class="btn btn-sm" 
                                    style="background-color:#34142F; color:white;">
                                    Ver detalle
                                </a>

                            @endif



                            {{-- ------------------------------ --}}
                            {{-- CONTENIDO SI ES PUBLICACIÓN    --}}
                            {{-- ------------------------------ --}}
                            @if($item->tipo === 'publicacion')

    <h3 class="font-bold text-lg">{{ $item->titulo }}</h3>

    @if($item->descripcion)
        <p><strong>Descripción:</strong> {{ $item->descripcion }}</p>
    @endif

    {{-- Botón para ver detalle de la publicación --}}
    <a href="{{ route('general.publicacion.detalle', $item->id) }}" 
        class="btn btn-sm" 
        style="background-color:#34142F; color:white;">
        Ver detalle
    </a>

@endif





                            {{-- Línea separadora --}}
                            @if(!$loop->last)
                                <hr class="mt-4" style="border-top: 1px solid #ccc;">
                            @endif

                        </li>
                    @endforeach
                </ul>

            @endif

        </div>
    </div>
</div>




@endsection
