@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Libros</h2>

    <a href="{{ route('admin.libros.create') }}" class="btn btn-primary mb-3" style="background-color: #34142F; border: none; outline: none; box-shadow: none;">➕ Nuevo Libro</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Volumen</th>
                <th>Año</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->volumen ?? 'N/A' }}</td>
                    <td>{{ $libro->anio ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $libro->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $libro->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    {{-- <x-acciones-crud :model="$libro" :routeName="'libros'"/> --}}
                    <x-acciones-crud :model="$libro" routeName="libros" tipo="Libros" />
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay libros registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    {{ $libros->links('pagination::bootstrap-5') }}
</div>
@endsection
