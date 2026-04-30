@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Publicaciones</h2>

    <a href="{{ route('admin.publicaciones.create') }}" class="btn btn-primary mb-3" style="background-color: #34142F; border: none; outline: none; box-shadow: none;">➕ Nueva Publicación</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($publicaciones as $publicacion)
                <tr>
                    <td>{{ $publicacion->id }}</td>
                    <td>{{ $publicacion->titulo }}</td>
                    <td>{{ ucfirst($publicacion->tipo) }}</td>
                    <td>{{ $publicacion->fecha }}</td>
                    <td>
                        <span class="badge {{ $publicacion->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $publicacion->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td>
                        @if($publicacion->imagen)
                            <img src="{{ asset('storage/'.$publicacion->imagen) }}" width="80">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>
                    {{-- <td>
                        <a href="{{ route('admin.publicaciones.show', $publicacion) }}" class="btn btn-info btn-sm">👁️ Ver</a>
                        <a href="{{ route('admin.publicaciones.edit', $publicacion) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                        <form action="{{ route('admin.publicaciones.destroy', $publicacion) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta publicación?')">🗑️ Eliminar</button>
                        </form>
                    </td> --}}
                    {{-- <x-acciones-crud :model="$publicacion" :routeName="'publicaciones'"/> --}}
                    <x-acciones-crud :model="$publicacion" routeName="publicaciones" tipo="Publicaciones" />
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay publicaciones registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    {{ $publicaciones->links('pagination::bootstrap-5') }}
</div>
@endsection
