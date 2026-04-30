<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Estudios Humanidad')</title>
    {{-- @vite(['resources/js/app.js']) --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet"> <!-- Para la tipografía -->
        <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logos/2A_Logo_blanco_circulo_MORADO.png') }}">


</head>
<body style="background-color: #FFFFFF; min-height: 100vh; margin: 0; padding: 0;">

<!-- NAVBAR ADMIN -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #EDE4CA; font-family: 'Cambria', sans-serif;">
    <div class="container">

        <!-- Logo y nombre -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('imagenes/logos/2A_Logo_blanco_circulo_MORADO.png') }}" 
                 width="35" height="35" class="d-inline-block me-2">
            <span style="color: #4a4a4a;">{{ Auth::user()->name ?? '-' }}</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                {{-- Administradores --}}
                @can('Administradores Crear')
                    <li class="nav-item px-2">
                        <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active fw-bold' : '' }}"
                           href="{{ route('admin.users.index') }}">
                            Administradores
                        </a>
                    </li>
                @endcan

                {{-- Roles --}}
                @can('Roles Crear')
                    <li class="nav-item px-2">
                        <a class="nav-link {{ request()->routeIs('admin.roles.index') ? 'active fw-bold' : '' }}"
                           href="{{ route('admin.roles.index') }}">
                            Roles
                        </a>
                    </li>
                @endcan

                {{-- Permisos --}}
                @can('Permisos Crear')
                    <li class="nav-item px-2">
                        <a class="nav-link {{ request()->routeIs('admin.permissions.index') ? 'active fw-bold' : '' }}"
                           href="{{ route('admin.permissions.index') }}">
                            Permisos
                        </a>
                    </li>
                @endcan

                {{-- Comité editorial --}}
                @can('Comite_Editorial Crear')
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('admin.comite_editorial.index') ? 'active fw-bold' : '' }}"
                       href="{{ route('admin.comite_editorial.index') }}">
                        Comité editorial
                    </a>
                </li>
                @endcan

                {{-- Publicaciones --}}
                @can('Publicaciones Crear')
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('admin.publicaciones.index') ? 'active fw-bold' : '' }}"
                       href="{{ route('admin.publicaciones.index') }}">
                        Publicaciones
                    </a>
                </li>
                @endcan

                {{-- Dropdown Libros (si puede Crear cualquier submódulo) --}}
                @canany(['Autores Crear', 'Series Crear', 'Capitulos Crear', 'Tipos Crear', 'Libros Crear'])
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Libros</a>

                    <ul class="dropdown-menu">

                        @can('Autores Crear')
                            <li><a class="dropdown-item" href="{{ route('admin.autores.index') }}">Autores</a></li>
                        @endcan

                        @can('Series Crear')
                            <li><a class="dropdown-item" href="{{ route('admin.series.index') }}">Series</a></li>
                        @endcan

                        @can('Capitulos Crear')
                            <li><a class="dropdown-item" href="{{ route('admin.capitulos.index') }}">Capítulos</a></li>
                        @endcan

                        @can('Tipos Crear')
                            <li><a class="dropdown-item" href="{{ route('admin.tipos.index') }}">Colecciones</a></li>
                        @endcan

                        <li><hr class="dropdown-divider"></li>

                        @can('Libros Crear')
                            <li><a class="dropdown-item" href="{{ route('admin.libros.index') }}">Libros</a></li>
                        @endcan

                    </ul>
                </li>
                @endcanany

            </ul>

            <!-- Logout -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>

    </div>
</nav>

<!-- {{-- HERO con logo a lo largo de la pantalla --}} -->
<section class="w-100" style="background-color: transparent; padding: 0; margin: 0;">
    <div class="container-fluid p-0 m-0">
        <img src="{{ asset('imagenes/logos/2_Logo_con_titulo_MORADO.jpg') }}" 
             alt="Logo Estudios de la Humanidad" 
             class="img-fluid w-100" 
             style="height: 50px; object-fit: contain; display: block;">
    </div>
</section>


    {{-- <!-- CONTENIDO PRINCIPAL  --> @section('contenido')  --}}
    <div style="background-color: #FFFFFF; font-family: 'Cambria', sans-serif; padding-bottom: 50px;">  <!-- Color del Fondo y tipografía -->
        @yield('contenido') 
    </div>


</body>
</html>

