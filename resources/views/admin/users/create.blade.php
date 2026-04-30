@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Nuevo Administrador</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Correo --}}
        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Rol --}}
{{-- <div class="mb-3">
    <label for="role_id" class="form-label">Rol</label>
    <select name="role_id" id="role_id" class="form-select" required>
        <option value="">-- Selecciona un rol --</option>
        @foreach($roles as $role)
            <option value="{{ $role->name }}" {{ old('name') == $role->id ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div> --}}

{{-- Rol --}}
<div class="mb-3">
    <label for="role_id" class="form-label">Rol</label>
    <select name="role_id" id="role_id" class="form-select" required>
        <option value="">-- Selecciona un rol --</option>

        @foreach($roles as $role)
            {{-- 🔒 Solo mostrar "Desarrollador" si el usuario actual tiene ese rol --}}
            @if($role->name !== 'Desarrollador' || auth()->user()->hasRole('Desarrollador'))
                <option value="{{ $role->name }}" 
                    {{ old('role_id') == $role->name ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endif
        @endforeach
    </select>

    @error('role_id')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>



        {{-- Estado --}}
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ old('estado') == "1" ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado') == "0" ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Contraseña --}}
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirmar contraseña --}}
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        {{-- Botones --}}
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
