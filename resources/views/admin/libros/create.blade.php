@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Nuevo Libro</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.libros.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required value="{{ old('titulo') }}">
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Colección</label>
            <select name="tipos_id" id="tipo" class="form-select">
                <option value="">-- Ninguna --</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ old('tipos_id') == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="volumen" class="form-label">Volumen</label>
            <input type="text" name="volumen" id="volumen" class="form-control" required value="{{ old('volumen') }}">
        </div>

        <div class="mb-3">
            <label for="anio" class="form-label">Año</label>
            <input type="number" name="anio" id="anio" class="form-control" required value="{{ old('anio') }}">
        </div>

        <div class="mb-3">
            <label for="resumen" class="form-label">Resumen</label>
            <textarea name="resumen" id="resumen" class="form-control" rows="10">{{ old('resumen') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cita" class="form-label">¿Cómo citar?</label>
            <textarea name="cita" id="cita" class="form-control">{{ old('cita') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn') }}">
        </div>

        <div class="mb-3">
            <label for="isbn_coleccion" class="form-label">ISBN de la colección</label>
            <input type="text" name="isbn_coleccion" id="isbn_coleccion" class="form-control" value="{{ old('isbn_coleccion') }}">
        </div>

        <div class="mb-3">
            <label for="palabras_clave" class="form-label">Palabras clave</label>
            <textarea name="palabras_clave" id="palabras_clave" class="form-control">{{ old('palabras_clave') }}</textarea>
        </div>

        {{-- <div class="mb-3">
            <label for="resena" class="form-label">Reseña (por quitar)</label>
            <textarea name="resena" id="resena" class="form-control">{{ old('resena') }}</textarea>
        </div> --}}

        <div class="mb-3">
            <label for="doi" class="form-label">DOI</label>
            <textarea name="doi" id="doi" class="form-control">{{ old('doi') }}</textarea>
        </div> 

        <div class="mb-3">
            <label for="serie" class="form-label">Serie</label>
            <select name="series_id" id="serie" class="form-select">
                <option value="">-- Ninguna --</option>
                @foreach($series as $serie)
                    <option value="{{ $serie->id }}" {{ old('series_id') == $serie->id ? 'selected' : '' }}>
                        {{ $serie->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- 🔹 Autores --}}
        <div id="autores-wrapper">
            <div class="autor-rol mb-2 d-flex align-items-center">
                <select name="roles[0][autor_id]" class="form-select me-2">
                    <option value="">-- Seleccione autor --</option>
                    @foreach($autores as $autor)
                        <option value="{{ $autor->id }}" {{ old('roles.0.autor_id') == $autor->id ? 'selected' : '' }}>
                            {{ $autor->nombre }} {{ $autor->apellido }}
                        </option>
                    @endforeach
                </select>

                <select name="roles[0][roles][]" class="form-select me-2" multiple>
                    @php $oldRoles = old('roles.0.roles', []); @endphp
                    <option value="autor_libro" {{ in_array('autor_libro', $oldRoles) ? 'selected' : '' }}>Autor</option>
                    <option value="coordinador" {{ in_array('coordinador', $oldRoles) ? 'selected' : '' }}>Coordinador</option>
                    <option value="editor" {{ in_array('editor', $oldRoles) ? 'selected' : '' }}>Editor</option>
                    <option value="compilador" {{ in_array('compilador', $oldRoles) ? 'selected' : '' }}>Compilador</option>
                    <option value="presentador" {{ in_array('presentador', $oldRoles) ? 'selected' : '' }}>Presentador</option>
                    {{-- <option value="Preface/Foreword" {{ in_array('Preface/Foreword', $oldRoles) ? 'selected' : '' }}>Preface/Foreword</option> --}}
                </select>

                <button type="button" class="btn btn-danger remove-autor">❌</button>
            </div>
        </div>

        <button type="button" id="add-autor" class="btn btn-primary mb-3">➕ Añadir autor</button>

        <script>
        let index = 1;
        document.getElementById('add-autor').addEventListener('click', function() {
            let wrapper = document.getElementById('autores-wrapper');
            let clone = wrapper.children[0].cloneNode(true);
            clone.querySelectorAll('select').forEach((select) => {
                let name = select.getAttribute('name');
                select.setAttribute('name', name.replace(/\d+/, index));
                select.value = '';
            });
            wrapper.appendChild(clone);
            index++;
        });

        document.addEventListener('click', function(e){
            if(e.target.classList.contains('remove-autor')){
                e.target.closest('.autor-rol').remove();
            }
        });
        </script>
        {{-- 🔹 Fin bloque autores --}}

        <div class="mb-3">
            <label for="pdf" class="form-label">PDF</label>
            <input type="file" name="pdf" id="pdf" class="form-control" required accept="application/pdf">
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
