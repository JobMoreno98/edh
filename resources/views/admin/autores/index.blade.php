@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Autores</h2>

    <a href="{{ route('admin.autores.create') }}" class="btn btn-primary mb-3" style="background-color: #34142F; border: none; outline: none; box-shadow: none;">➕ Nuevo Autor</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($autores as $autor)
                <tr>
                    <td>{{ $autor->id }}</td>
                    <td>{{ $autor->nombre }}</td>
                    <td>{{ $autor->apellido }}</td>
                    <td>
                        <span class="badge {{ $autor->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $autor->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>

                        {{-- <x-acciones-crud :model="$autor" :routeName="'autores'"/> --}}
                        <x-acciones-crud :model="$autor" routeName="autores" tipo="Autores" />

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay autores registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    {{-- {{ $autores->links() }} --}}
    {{ $autores->links('pagination::bootstrap-5') }}

</div>
@endsection
