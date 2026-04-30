@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Editar Administrador</h2>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ $user->estado ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$user->estado ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        {{-- <div class="mb-3">
            <label for="role_id" class="form-label">Rol</label>
   
            <select name="role_id" id="role_id" class="form-select" required>
                <option value="">-- Selecciona un rol --</option>
                @foreach($roles as $key => $value)
                    <option value="{{ $value }}" 
                        {{ $user->hasRole($value) ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div> --}}

        <div class="mb-3">
    <label for="role_id" class="form-label">Rol</label>
    <select name="role_id" id="role_id" class="form-select" required>
        <option value="">-- Selecciona un rol --</option>

        @foreach($roles as $key => $value)
            {{-- 🔒 Solo mostrar "Desarrollador" si el usuario actual tiene ese rol --}}
            @if($value !== 'Desarrollador' || auth()->user()->hasRole('Desarrollador'))
                <option value="{{ $value }}" 
                    {{ $user->hasRole($value) ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endif
        @endforeach
    </select>

    @error('role_id')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>



        <div class="mb-3">
            <label for="password" class="form-label">Contraseña (dejar en blanco si no cambia)</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>


        {{-- Confirmar contraseña --}}
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
