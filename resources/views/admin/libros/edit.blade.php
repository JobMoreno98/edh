@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Editar Libro</h2>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.libros.update', $libro) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Campos básicos --}}
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $libro->titulo }}" required>
        </div>

        {{-- Tipo --}}
        <div class="mb-3">
            <label for="tipo" class="form-label">Colección</label>
            <select name="tipos_id" id="tipo" class="form-select">
                <option value="">-- Seleccione tipo --</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ $libro->tipos_id == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->nombre }}
                    </option>
                @endforeach
            </select>


        </div>

        <div class="mb-3">
            <label for="volumen" class="form-label">Volumen</label>
            <input type="text" name="volumen" id="volumen" class="form-control" value="{{ $libro->volumen }}">
        </div>

        <div class="mb-3">
            <label for="anio" class="form-label">Año</label>
            <input type="number" name="anio" id="anio" class="form-control" value="{{ $libro->anio }}">
        </div>

        <div class="mb-3">
            <label for="resumen" class="form-label">Resumen</label>
            <textarea name="resumen" id="resumen" class="form-control" rows="10">{{ $libro->resumen }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cita" class="form-label">¿Cómo citar?</label>
            <textarea name="cita" id="cita" class="form-control">{{ $libro->cita }}</textarea>
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" value="{{ $libro->isbn }}">
        </div>

        <div class="mb-3">
            <label for="isbn_coleccion" class="form-label">ISBN de la colección</label>
            <input type="text" name="isbn_coleccion" id="isbn_coleccion" class="form-control" value="{{ $libro->isbn_coleccion }}">
        </div>

        <div class="mb-3">
            <label for="palabras_clave" class="form-label">Palabras clave</label>
            <textarea name="palabras_clave" id="palabras_clave" class="form-control">{{ $libro->palabras_clave }}</textarea>
        </div>

        {{-- <div class="mb-3">
            <label for="resena" class="form-label">Reseña(por quitar)</label>
            <textarea name="resena" id="resena" class="form-control">{{ $libro->resena }}</textarea>
        </div> --}}

        <div class="mb-3">
            <label for="doi" class="form-label">DOI</label>
            <textarea name="doi" id="doi" class="form-control">{{ $libro->doi }}</textarea>
        </div> 

        {{-- Serie --}}
        <div class="mb-3">
            <label for="serie" class="form-label">Serie</label>
            <select name="series_id" id="serie" class="form-select">
                <option value="">-- Ninguna --</option>
                @foreach($series as $serie)
                    <option value="{{ $serie->id }}" {{ $libro->series_id == $serie->id ? 'selected' : '' }}>{{ $serie->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- 🔹 Bloque autores / coordinadores / presentadores --}}
<div id="autores-wrapper">
    @forelse($libro->autores as $i => $autor)
    <div class="autor-rol mb-2 d-flex align-items-center">
        <select name="roles[{{ $i }}][autor_id]" class="form-select me-2">
            <option value="">-- Seleccione autor --</option>
            @foreach($autores as $a)
                <option value="{{ $a->id }}" {{ $autor->id == $a->id ? 'selected' : '' }}>
                    {{ $a->nombre }} {{ $a->apellido }}
                </option>
            @endforeach
        </select>

        <select name="roles[{{ $i }}][roles][]" class="form-select me-2" multiple>
            @php
                $selectedRoles = is_array($autor->pivot->rol) ? $autor->pivot->rol : [$autor->pivot->rol];
            @endphp
            <option value="autor_libro" {{ in_array('autor_libro', $selectedRoles) ? 'selected' : '' }}>Autor</option>
            <option value="coordinador" {{ in_array('coordinador', $selectedRoles) ? 'selected' : '' }}>Coordinador</option>
            <option value="editor" {{ in_array('editor', $selectedRoles) ? 'selected' : '' }}>Editor</option>
            <option value="compilador" {{ in_array('compilador', $selectedRoles) ? 'selected' : '' }}>Compilador</option>
            <option value="presentador" {{ in_array('presentador', $selectedRoles) ? 'selected' : '' }}>Presentador</option>
            {{-- <option value="Preface/Foreword" {{ in_array('Preface/Foreword', $selectedRoles) ? 'selected' : '' }}>Preface/Foreword</option> --}}
        </select>

        <button type="button" class="btn btn-danger remove-autor">❌</button>
    </div>
    @empty
    <div class="autor-rol mb-2 d-flex align-items-center">
        <select name="roles[0][autor_id]" class="form-select me-2">
            <option value="">-- Seleccione autor --</option>
            @foreach($autores as $a)
                <option value="{{ $a->id }}">{{ $a->nombre }} {{ $a->apellido }}</option>
            @endforeach
        </select>

        <select name="roles[0][roles][]" class="form-select me-2" multiple>
            <option value="autor_libro">Autor</option>
            <option value="coordinador">Coordinador</option>
            <option value="editor">Editor</option>
            <option value="compilador">Compilador</option>
            <option value="presentador">Presentador</option>
            {{-- <option value="Preface/Foreword">Preface/Foreword</option> --}}
        </select>

        <button type="button" class="btn btn-danger remove-autor">❌</button>
    </div>
    @endforelse
</div>

<button type="button" id="add-autor" class="btn btn-primary mb-3">➕ Añadir autor</button>

<script>
let index = {{ $libro->autores->count() ?: 1 }};

document.getElementById('add-autor').addEventListener('click', function() {
    let wrapper = document.getElementById('autores-wrapper');
    let clone = wrapper.children[0].cloneNode(true);
    clone.querySelectorAll('select').forEach((select) => {
        let name = select.getAttribute('name');
        select.setAttribute('name', name.replace(/\d+/, index));
        select.value = '';
        if(select.multiple){
            Array.from(select.options).forEach(o => o.selected = false);
        }
    });
    wrapper.appendChild(clone);
    index++;
});

// Quitar bloque
document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-autor')){
        e.target.closest('.autor-rol').remove();
    }
});
</script>


        <div class="mb-3">
            <label for="pdf" class="form-label">Archivo PDF</label>
            <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf">

            @if ($libro->pdf)
                <p class="mt-2">
                    Archivo actual: 
                    <a href="{{ asset('storage/' . $libro->pdf) }}" target="_blank">Ver PDF</a>
                </p>
            @endif
        </div>

        {{-- Imagen --}}
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            @if($libro->imagen)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$libro->imagen) }}" alt="{{ $libro->titulo }}" width="120">
                </div>
            @endif
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        {{-- Estado --}}
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ $libro->estado ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$libro->estado ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
{{--  let index = {{ count($oldRoles) }}; --}}
<script>
let index = {{ $libro->autores ? $libro->autores->count() : 1 }};


document.getElementById('add-autor').addEventListener('click', function() {
    let template = document.getElementById('autor-template').children[0].cloneNode(true);

    template.querySelectorAll('select').forEach((select) => {
        let name = select.getAttribute('name');
        select.setAttribute('name', name.replace(/\d+/, index));
        select.value = '';
        select.querySelectorAll('option').forEach(opt => opt.selected = false);
    });

    document.getElementById('autores-wrapper').appendChild(template);
    index++;
});

document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-autor')){
        e.target.closest('.autor-rol').remove();
    }
});
</script>
@endsection
