@extends('layouts.layout_general')

@section('contenido')
    <div style="font-family: 'Cambria', serif; background-color:#FFFFFF; min-height:100vh;">

        <div class="d-flex justify-content-end mb-3">
            <form action="{{ route('general.buscar') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="q" placeholder="Buscar..." class="border p-2 rounded w-64">
                <button type="submit" class="btn btn-outline-dark">
                    Buscar
                </button>
            </form>
        </div>

        <div class="container my-5">

            {{-- Título del libro --}}
            <h1 class="mb-4 fw-bold text-center" style="color:#2F3E46;">
                {{ $libro->titulo }}
            </h1>

            <div class="d-flex flex-column flex-md-row w-100">
                {{-- Imagen del libro --}}
                <div class="text-center mb-4 col-sm-12 col-md-4">
                    <a href="{{ Storage::url($libro->imagen) }}" data-aos-duration="600" data-aos="fade-up"
                        data-aos-easing="ease-in-sine" class="glightbox">
                        <img src="{{ Storage::url($libro->imagen) }}"
                            class="h-100 img-fluid rounded-4 shadow-md border border-2"
                            style="object-fit: cover; border-color:#7689A5;max-height:400px" alt="{{ $libro->titulo }}">
                    </a>
                </div>

                {{-- Información general --}}
                <div class="card shadow-sm mb-4 border-0 w-100 mx-2" style="background-color:#F4F5F7;" data-aos="fade-left"
                    data-aos-anchor="#example-anchor" data-aos-offset="500" data-aos-duration="500">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4 fw-bold" style="color:#34142F;">
                            Información del libro
                        </h4>

                        @php
                            $roles = [
                                'autor_libro' => 'Autor',
                                'coordinador' => 'Coordinador',
                                'editor' => 'Editor',
                                'presentador' => 'Presentador',
                                'compilador' => 'Compilador',
                            ];
                        @endphp

                        @foreach ($roles as $clave => $nombreRol)
                            @php
                                $autoresPorRol = $libro->autores->filter(
                                    fn($a) => in_array($clave, explode(',', $a->pivot->rol)),
                                );
                            @endphp
                            @if ($autoresPorRol->isNotEmpty())
                                <p><strong>{{ $nombreRol }}:</strong>
                                    <span
                                        style="color:#2F3E46;">{{ $autoresPorRol->map(fn($a) => $a->nombre . ' ' . $a->apellido)->join(', ') }}</span>
                                </p>
                            @endif
                        @endforeach

                        @if ($libro->serie)
                            <p><strong>Serie:</strong> <span style="color:#2F3E46;">{{ $libro->serie->nombre }}</span></p>
                        @endif

                        <p><strong>Volumen:</strong> <span style="color:#2F3E46;">{{ $libro->volumen }}</span>
                            <strong>Año:</strong> <span style="color:#2F3E46;">{{ $libro->anio }}</span>
                        </p>
                        @if (!empty($libro->palabras_clave))
                            <p><strong>Palabras clave:</strong>
                                <span style="color:#2F3E46;">{{ $libro->palabras_clave }}</span>
                            </p>
                        @endif
                        <p><strong>Resumen:</strong></p>
                        <p style="color:#4A5568; text-align: justify; line-height:1.8;">
                            {!! nl2br(e($libro->resumen)) !!}
                        </p>



                        @if (!empty($libro->doi))
                            <p><strong>DOI:</strong>
                                <span style="color:#2F3E46;">{{ $libro->doi }}</span>
                            </p>
                        @endif

                        <p>
                            <strong>ISBN:</strong> <span style="color:#2F3E46;">{{ $libro->isbn }}</span>
                            @if (!empty($libro->isbn_coleccion))
                                <strong>ISBN colección:</strong> <span
                                    style="color:#2F3E46;">{{ $libro->isbn_coleccion }}</span>
                            @endif


                        </p>
                        @if (!empty($libro->cita))
                            <p><strong>¿Cómo citar?:</strong>
                                <span style="color:#2F3E46;">{{ $libro->cita }}</span>
                            </p>
                        @endif

                        @if ($libro->pdf)
                            <p>
                                <strong>Documento:</strong>
                                <a href="{{ asset('storage/' . $libro->pdf) }}" target="_blank"
                                    class="btn btn-sm text-white" style="background-color:#7689A5; border:none;">
                                    Ver PDF
                                </a>
                            </p>
                        @endif
                    </div>
                </div>

            </div>


            {{-- Contenido del libro --}}
            <div class="card mb-4 shadow-sm border-0" style="background-color:#F4F5F7;">
                <div class="card-body">
                    <h4 class="card-title mb-4 fw-bold" style="color:#34142F;">Contenido del libro</h4>

                    @foreach ($libro->capitulos as $index => $capitulo)
                        <h5 class="fw-bold mb-2" style="color:#2F3E46;">
                            {{ $capitulo->nombre }}
                        </h5>

                        @if ($capitulo->autores->isNotEmpty())
                            <p><strong>Autor(es):</strong>
                                <span
                                    style="color:#4A5568;">{{ $capitulo->autores->map(fn($a) => $a->nombre . ' ' . $a->apellido)->join(', ') }}</span>
                            </p>
                        @endif

                        @php
                            $lineas = explode("\n", $capitulo->descripcion);
                        @endphp
                        @foreach ($lineas as $linea)
                            @if (trim($linea) !== '')
                                <p class="text-muted" style="text-indent: 2em; text-align: justify; line-height: 1.8;">
                                    {{ $linea }}
                                </p>
                            @endif
                        @endforeach

                        {{-- Cita del capítulo con collapse --}}
                        @if ($capitulo->cita_articulo)
                            @php $collapseId = 'citaCapitulo' . $index; @endphp

                            <div class="my-3">
                                <button class="btn btn-outline-secondary btn-sm btn-cita" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="false"
                                    aria-controls="{{ $collapseId }}" style="border-color:#7689A5; color:#7689A5;">
                                    Ver cita
                                </button>

                                <div class="collapse mt-3" id="{{ $collapseId }}">
                                    <div class="card card-body"
                                        style="background-color:#F7FAFC; border-left:5px solid #7689A5;">
                                        <em>{{ $capitulo->cita_articulo }}</em>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.btn-cita').forEach(btn => {
                    const target = document.querySelector(btn.dataset.bsTarget);
                    if (target) {
                        target.addEventListener('show.bs.collapse', () => btn.textContent = 'Ocultar cita');
                        target.addEventListener('hide.bs.collapse', () => btn.textContent = 'Ver cita');
                    }
                });
            });
        </script>

    </div>
@endsection
