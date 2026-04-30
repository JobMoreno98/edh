@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2>Detalles del Permiso</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $permission->id }}</p>
            <p><strong>Nombre:</strong> {{ $permission->name }}</p>
            <p><strong>Guard:</strong> {{ $permission->guard_name }}</p>
            <p><strong>Creado:</strong> {{ $permission->created_at }}</p>
            <p><strong>Actualizado:</strong> {{ $permission->updated_at }}</p>
        </div>
    </div>
    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary mt-2">Volver</a>
</div>
@endsection
