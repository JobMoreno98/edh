@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2>Capítulos</h2>
    <a href="{{ route('admin.capitulos.create') }}" class="btn btn-primary mb-3" style="background-color: #34142F; border: none; outline: none; box-shadow: none;">➕ Nuevo Capítulo</a>  {{-- class="btn btn-success mb-2" --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Libro</th>
                <th>Autores</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($capitulos as $capitulo)
            <tr>
                <td>{{ $capitulo->id }}</td>
                <td>{{ $capitulo->nombre }}</td>
                <td>{{ $capitulo->libro->titulo ?? 'N/A' }}</td>
                <td>
                    @if($capitulo->autores->count())
                        @foreach($capitulo->autores as $autor)
                            {{ $autor->nombre }} {{ $autor->apellido }}<br>
                        @endforeach
                    @else
                        Sin autores
                    @endif
                </td>
                <td>{{ $capitulo->estado ? 'Activo' : 'Inactivo' }}</td>
                {{-- <td>
                    <a href="{{ route('admin.capitulos.show',$capitulo) }}" class="btn btn-info">👁 Ver</a>
                    <a href="{{ route('admin.capitulos.edit',$capitulo) }}" class="btn btn-warning">✏️ Editar</a>
                    <form action="{{ route('admin.capitulos.destroy',$capitulo) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Seguro?')">🗑 Eliminar</button>
                    </form>
                </td> --}}
                {{-- <x-acciones-crud :model="$capitulo" :routeName="'capitulos'"/> --}}
                {{-- <x-acciones-crud :model="$capitulo" :routeName="'capitulos'" :$tipo="'Capitulos'"/> --}}
                <x-acciones-crud :model="$capitulo" routeName="capitulos" tipo="Capitulos" />

            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    {{ $capitulos->links('pagination::bootstrap-5') }}
</div>
@endsection
