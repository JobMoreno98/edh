@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Comité Editorial</h2>

    <a href="{{ route('admin.comite_editorial.create') }}" class="btn btn-primary mb-3" style="background-color: #34142F; border: none; outline: none; box-shadow: none;">➕ Nuevo Miembro</a>

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
                <th>Dependencia</th>
                <th>País</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comite as $miembro)
                <tr>
                    <td>{{ $miembro->id }}</td>
                    <td>{{ $miembro->nombre }}</td>
                    <td>{{ $miembro->apellido }}</td>
                    <td>{{ $miembro->dependencia }}</td>
                    <td>{{ $miembro->pais }}</td>
                    <td>
                        <span class="badge {{ $miembro->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $miembro->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>

                    {{-- <x-acciones-crud :model="$miembro" :routeName="'comite_editorial'"/> --}}
                    <x-acciones-crud :model="$miembro" routeName="comite_editorial" tipo="Comite_Editorial" />
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay miembros registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    {{ $comite->links('pagination::bootstrap-5') }}
</div>
@endsection
