@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2>Detalles del Rol</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $role->id }}</p>
            <p><strong>Nombre:</strong> {{ $role->name }}</p>
            <p><strong>Guard:</strong> {{ $role->guard_name }}</p>
            <p><strong>Creado:</strong> {{ $role->created_at }}</p>
            <p><strong>Actualizado:</strong> {{ $role->updated_at }}</p>
        </div>
    </div>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mt-2">Volver</a>
</div>
@endsection
