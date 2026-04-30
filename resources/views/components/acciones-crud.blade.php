{{-- <div> --}}
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
@props(['model', 'routeName', 'tipo'])

<td>
    <div class="d-flex gap-1">

        {{-- Ver --}}
        <a href="{{ route("admin.{$routeName}.show", $model) }}"
           class="btn btn-info btn-sm"
           style="background-color:#7689A5; border:none;">
            Ver
        </a>

        {{-- Editar --}}
        @can("{$tipo} Editar")
            <a href="{{ route("admin.{$routeName}.edit", $model) }}"
               class="btn btn-warning btn-sm"
               style="background-color:#F2B81B; border:none;">
                Editar
            </a>
        @endcan

        {{-- Permisos (solo para roles) --}}
        @if($tipo === 'Roles')
            @can("Roles Editar")
                @if(Route::is('admin.roles.index'))
                    <a href="{{ route("admin.roles.editPermissions", $model) }}"
                       class="btn btn-primary btn-sm">
                        Permisos
                    </a>
                @endif
            @endcan
        @endif

        {{-- Eliminar --}}
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
