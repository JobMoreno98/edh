@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Detalles del Administrador</h2>

    <div class="card p-4">
        <h3>{{ $user->name }}</h3>
        <p><strong>Correo:</strong> {{ $user->email }}</p>
        <p><strong>Estado:</strong>
            <span class="badge {{ $user->estado ? 'bg-success' : 'bg-danger' }}">
                {{ $user->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </p>
        <p><strong>Rol:</strong>
            <span class="badge {{ $user->rol_id == 1 ? 'bg-primary' : 'bg-secondary' }}">
                {{-- {{ $user->rol_id == 1 ? 'Superadmin' : 'Admin' }} --}}
                {{ Auth::user()->getRoleNames()->implode(', ') ?: 'No definido' }}
            </span>
        </p>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
