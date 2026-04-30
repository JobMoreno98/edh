@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2>Permisos (Sólo para el desarrollador)</h2>
    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary mb-3" style="background-color: #34142F; border: none; outline: none; box-shadow: none;">➕ Nuevo Permiso</a>

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
            @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                {{-- <td>
                    <a href="{{ route('admin.permissions.show',$permission) }}" class="btn btn-info">👁 Ver</a>
                    <a href="{{ route('admin.permissions.edit',$permission) }}" class="btn btn-warning">✏️ Editar</a>
                    <form action="{{ route('admin.permissions.destroy',$permission) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Seguro?')">🗑 Eliminar</button>
                    </form>
                </td> --}}
                {{-- <x-acciones-crud :model="$permission" :routeName="'permissions'"/> --}}
                <x-acciones-crud :model="$permission" routeName="permissions" tipo="Permissions" />
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
        {{ $permissions->links('pagination::bootstrap-5') }}

</div>

@endsection
