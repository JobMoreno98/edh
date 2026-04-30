@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Colecciones (Sólo para el desarrollador)</h2>

    <a href="{{ route('admin.tipos.create') }}" class="btn btn-primary mb-3" style="background-color: #34142F; border: none; outline: none; box-shadow: none;">➕ Nuevo Tipo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tipos as $tipo)
                <tr>
                    <td>{{ $tipo->id }}</td>
                    <td>{{ $tipo->nombre }}</td>
                    <td>
                        <span class="badge {{ $tipo->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $tipo->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>

                    {{-- <x-acciones-crud :model="$tipo" :routeName="'tipos'"/> --}}

                    <x-acciones-crud :model="$tipo" routeName="tipos" tipo="Tipos" />
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay tipos registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    
</div>
@endsection
