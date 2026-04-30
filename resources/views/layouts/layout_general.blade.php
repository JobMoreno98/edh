<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Estudios Humanidad')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet"> <!-- Para la tipografía -->
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logos/1A_Logo_blanco_circulo_ROJO.png') }}">


</head>
<body style="background-color: #FFFFFF; min-height: 100vh; margin: 0; padding: 0;">




<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #EDE4CA; font-family: 'Michroma', sans-serif;">

  <div class="container">

    <!-- Logo e inicio -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('general.inicio') }}">
      <img src="{{ asset('imagenes/logos/1A_Logo_blanco_circulo_ROJO.png') }}" 
           alt="Logo" 
           width="35" 
           height="35" 
           class="d-inline-block me-2">
      <span style="color: #4a4a4a;">Inicio</span>
    </a>

    <!-- Botón móvil -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido"
      aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido del navbar -->
    <div class="collapse navbar-collapse justify-content-center" id="navbarContenido">

      @if (isset($tipos) && $tipos->count() > 0)
        <ul class="navbar-nav text-center">
          @foreach ($tipos as $tipo)
            <li class="nav-item px-3">
              <a class="nav-link
                {{ request()->routeIs('general.coleccion') && request()->route('tipo') == $tipo->id ? 'fw-bold' : '' }}"
                href="{{ route('general.coleccion', $tipo->id) }}"
                style="color: #4a4a4a;">
                {{ $tipo->nombre }}
              </a>
            </li>
          @endforeach
        </ul>
      @endif

    </div>

  </div>
</nav>






    <!-- CONTENIDO -->
    <div style="background-color: #FFFFFF; font-family: 'Michroma', sans-serif; padding-bottom: 50px;">  <!-- Color del Fondo y tipografía -->
        @yield('contenido')
    </div> 

   <!-- FOOTER -->
<footer style="background-color: #EDE4CA; font-family: 'Michroma', sans-serif; color: #4a4a4a; margin-top: 50px;">

    <div class="container py-4 text-center">

        <!-- Logo principal horizontal -->
        <div class="mb-4">
            <img src="{{ asset('imagenes/logos/1_LOGO_PRINCIPAL_con_titulo_ROJO.png') }}" 
                 alt="Logo principal Estudios Humanidad"
                 style="max-width: 300px; height: auto;">
        </div>

        <div class="row text-center text-md-start justify-content-center">

            <!-- Dirección -->
            <div class="col-md-4 mb-4">
                <i class="bi bi-geo-alt-fill fs-4"></i>
                <h6 class="mt-2 fw-semibold">Dirección</h6>
                <p class="small mb-0">
                    Estudios Mesoamericanos y Mexicanos Ave. Parres Arias Núm. 150<br>
                    Esquina con periférico norte<br>
                    Colonia San José del Bajío, C.P. 45132<br>
                    Zapopan, Jalisco, México<br>
                    Edificio A Planta Baja, Núcleo Los Belenes
                </p>
            </div>

            <!-- Teléfono -->
            <div class="col-md-4 mb-4">
                <i class="bi bi-telephone-fill fs-4"></i>
                <h6 class="mt-2 fw-semibold">Teléfono</h6>
                <p class="small mb-0">(33) 3819-3365, Ext. 23365</p>

                <i class="bi bi-envelope-fill fs-4"></i>
                <h6 class="mt-2 fw-semibold">Correo</h6>
                <p class="small mb-2">edh.cucsh@academicos.udg.mx</p>
            </div>

            <!-- Correo y login -->
            <div class="col-md-4 mb-4">
                {{-- <i class="bi bi-envelope-fill fs-4"></i>
                <h6 class="mt-2 fw-semibold">Correo</h6>
                <p class="small mb-2">edh.cucsh@academicos.udg.mx</p> --}}

                <!-- Login -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link p-0 small" href="{{ route('login') }}" style="color: #4a4a4a;">Login</a>
                        </li>
                    @endguest
                </ul>
                <!-- Logo pequeño cuadrado -->
            <img src="{{ asset('imagenes/logos/1A_Logo_blanco_circulo_ROJO.png') }}" 
                 alt="Logo circular Estudios Humanidad"
                 style="width: 40px; height: 40px; margin-top: 15px;">
            </div>

        </div>

        <!-- Línea de copyright -->
        {{-- <div class="d-flex flex-column flex-md-row justify-content-center align-items-center border-top pt-3" style="border-color: #4a4a4a;">
            <small>&copy; 2025 Estudios de la Humanidad</small>
        </div> --}}
    </div>
</footer>


<!-- ESTILO ANIMADO -->
<style>
  .nav-link {
    position: relative;
    color: #4a4a4a !important;
    transition: color 0.3s ease;
  }

  /* Línea animada */
  .nav-link::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0;
    height: 2px;
    background-color: #E44942; /* color del subrayado */
    transition: width 0.3s ease;
  }

  /* Al pasar el mouse */
  .nav-link:hover::after {
    width: 100%;
  }

  /* Página activa */
  .nav-link.active::after {
    width: 100%;
  }

  .nav-link.active {
    font-weight: bold;
  }
</style>



</body>
</html>




