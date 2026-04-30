@extends('layouts.layout_admin')

@section('contenido')
<div class="container">
    <h2>Permisos del Rol: {{ $role->name }}</h2>
    <form action="{{ route('admin.roles.updatePermissions', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table class="table">
            <thead>
                <tr>
                    <th>Módulo</th>
                    <th>Permiso</th>
                    <th>Asignar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $module => $actions)
                    @foreach($actions as $action)
                        <tr>
                            <td>{{ $module }}</td>
                            <td>{{ $action }}</td>
                            <td>
                                <input type="checkbox" name="{{ $module }}_{{ $action }}" 
                                    {{ in_array("$module $action", $rolePermissions) ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary">Guardar permisos</button>
    </form>
</div>
@endsection
