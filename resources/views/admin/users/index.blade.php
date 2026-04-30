@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">

    <h2 class="mb-4">Administradores</h1><br>

<a href="{{ route('admin.users.create') }}" 
   class="btn btn-primary mb-3" 
   style="background-color: #34142F; border: none; outline: none; box-shadow: none;">
   ➕ Nuevo Administrador
</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    {{-- <th>ID</th>
                    <th>Imagen</th> --}}
                    <th>Nombre</th>
                    {{-- <th>Apellido</th> --}}
                    <th>Correo</th>
                    {{-- <th>Teléfono</th>
                    <th>Usuario</th> --}}
                    <th>Estado</th>
                    {{-- <th>Rol</th> --}}
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($users as $user)
                    <tr>
                        {{-- <td>{{ $admin->id }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$admin->imagen) }}" 
                                 alt="Imagen" 
                                 class="rounded-circle"
                                 width="50" height="50">
                        </td> --}}
                        <td>{{ $user->name }}</td>
                        {{-- <td>{{ $admin->apellido }}</td> --}}
                        <td>{{ $user->email }}</td>
                        {{-- <td>{{ $admin->telefono }}</td>
                        <td>{{ $admin->usuario }}</td> --}}
                        <td>
                            <span class="badge {{ $user->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $user->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                        </td>

                        {{-- <x-acciones-crud :model="$user" :routeName="'users'"/> --}}

                        <x-acciones-crud :model="$user" routeName="users" tipo="Administradores" />
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">No hay administradores registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
                    {{-- {{ $user->links('pagination::bootstrap-5') }} --}}

    </div>
</div>


</div>

@endsection


