@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Roles (Sólo para el desarrollador)</h2>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3" style="background-color: #34142F; border: none; outline: none; box-shadow: none;">➕ Nuevo Rol</a>


    <div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Guard</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->guard_name }}</td>               
                 {{-- <x-acciones-crud :model="$role" :routeName="'roles'"/> --}}
                 <x-acciones-crud :model="$role" routeName="roles" tipo="Roles" />

            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
            {{-- {{ $role->links('pagination::bootstrap-5') }} --}}

</div>
@endsection
