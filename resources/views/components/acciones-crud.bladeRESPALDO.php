{{-- <div> --}}
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
@props(['model', 'routeName', 'tipo'])

<td>
    <div class="d-flex gap-1">

        {{dd($tipo)}}

        {{-- VER --}}
        @can("{$tipo} Ver")
            <a href="{{ route("admin.{$routeName}.show", $model) }}"
               class="btn btn-info btn-sm"
               style="background-color:#7689A5; border:none;">
                Ver
            </a>
        @endcan

        {{-- EDITAR --}}
        @can("{$tipo} Editar")
            <a href="{{ route("admin.{$routeName}.edit", $model) }}"
               class="btn btn-warning btn-sm"
               style="background-color:#F2B81B; border:none;">
                Editar
            </a>
        @endcan

        {{-- EDITAR PERMISOS (solo en admin.roles.index) --}}
        @can("gestionar permisos")
            @if(Route::is('admin.roles.index'))
                <a href="{{ route("admin.roles.editPermissions", $model) }}"
                   class="btn btn-primary btn-sm">
                    Permisos
                </a>
            @endif
        @endcan

        {{-- ELIMINAR --}}
        @can("{$tipo} Eliminar")
            <form action="{{ route("admin.{$routeName}.destroy", $model) }}"
                  method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Seguro que deseas eliminar?')">
                    Eliminar
                </button>
            </form>
        @endcan

    </div>
</td>
{{--   

{{-- <div>  <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius --> @props(['model', 'routeName']) <td> <div class="d-flex gap-1"> {{-- Ver  <a href="{{ route("admin.{$routeName}.show", $model) }}" class="btn btn-info btn-sm" style="background-color:#7689A5; border:none;">Ver</a> {{-- Editar: solo admin o superadmin  @if(auth()->user()->hasRole(['SuperAdmin', 'Desarrollador','admin'])) <a href="{{ route("admin.{$routeName}.edit", $model) }}" class="btn btn-warning btn-sm" style="background-color:#F2B81B; border:none;">Editar</a> @endif {{-- Editar permisos: solo SuperAdmin o Desarrollador, y solo en la ruta de roles --} @if(auth()->user()->hasAnyRole('Desarrollador') && Route::is('admin.roles.index')) <a href="{{ route("admin.roles.editPermissions", $model) }}" class="btn btn-primary">Permisos</a> @endif {{-- Eliminar: solo superadmin --} @if(auth()->user()->hasRole(['SuperAdmin', 'Desarrollador'])) <form action="{{ route("admin.{$routeName}.destroy", $model) }}" method="POST" class="d-inline"> @csrf @method('DELETE') <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</button> </form> @endif </div> </td>

--}}



@props(['model', 'routeName'])

<td>
    <div class="d-flex gap-1">

        {{-- VER (siempre visible) --}}
        <a href="{{ route("admin.{$routeName}.show", $model) }}"
           class="btn btn-info btn-sm"
           style="background-color:#7689A5; border:none;">
            Ver
        </a>

        {{-- EDITAR --}}
        @can("{$routeName} Editar")
            <a href="{{ route("admin.{$routeName}.edit", $model) }}"
               class="btn btn-warning btn-sm"
               style="background-color:#F2B81B; border:none;">
                Editar
            </a>
        @endcan

        {{-- PERMISOS (solo en roles.index) --}}
        @can("Roles Editar")
            @if(Route::is('admin.roles.index'))
                <a href="{{ route("admin.roles.editPermissions", $model) }}"
                   class="btn btn-primary btn-sm">
                    Permisos
                </a>
            @endif
        @endcan

        {{-- ELIMINAR --}}
        @can("{$routeName} Eliminar")
            <form action="{{ route("admin.{$routeName}.destroy", $model) }}"
                  method="POST" class="d-inline">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Seguro que deseas eliminar?')">
                    Eliminar
                </button>
            </form>
        @endcan

    </div>
</td>
