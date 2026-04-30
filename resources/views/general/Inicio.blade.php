@extends('layouts.layout_general')

@section('contenido')

<!-- {{-- HERO con logo a lo largo de la pantalla --}} -->
<section class="w-100" style="background-color: transparent; padding: 0; margin: 0;">
    <div class="container-fluid p-0 m-0">
        <img src="{{ asset('imagenes/logos/1_LOGO_PRINCIPAL_con_titulo_ROJO.jpg') }}" 
             alt="Logo Estudios de la Humanidad" 
             class="img-fluid w-100" 
             style="height: 50px; object-fit: contain; display: block;">
    </div>
</section>






{{-- CARRUSEL --}}
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach($publicaciones as $key => $pub)
      <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
        <div class="w-100" style="background-color:#F2B81B; min-height:60vh; display:flex; justify-content:center; align-items:center;">
          <div class="row w-100 justify-content-center align-items-center" style="max-width:1200px; padding:40px; border-radius:15px;">
            
            {{-- Texto --}}
            <div class="col-md-6 text-white text-md-start text-center">
                <h5 class="fst-italic">{{ ucfirst($pub->tipo) }}</h5>
                <h2 class="fw-bold">{{ $pub->titulo }}</h2>
                @if($pub->fecha)
                  <small class="d-block mb-3">
                      {{ \Carbon\Carbon::parse($pub->fecha)->locale('es')->translatedFormat('d M, Y') }}
                  </small>
              @endif



                <a href="{{ route('general.publicacion.detalle', $pub->id) }}" 
                class="btn mt-2 px-4 py-2 fw-semibold" 
                style="background-color:#FFFFFF; color:#34142F; border:none;">
                Detalles
                </a>
            </div>

            @if($pub->imagen)
            <div class="col-md-6 d-flex align-items-center justify-content-center mt-3 mt-md-0">
            <img src="{{ asset('storage/' . $pub->imagen) }}" 
                class="img-fluid rounded shadow d-none d-md-block" 
                alt="Imagen de {{ $pub->titulo }}"
                style="max-height:400px; width:auto; object-fit:contain;">
            </div>
            @endif


          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{-- Controles --}}
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

<div class="d-flex justify-content-end mb-3">
    <form action="{{ route('general.buscar') }}" method="GET" class="d-flex gap-2">
        <input 
            type="text"
            name="q"
            placeholder="Buscar..."
            class="border p-2 rounded w-64"
        >
        <button 
            type="submit"
            class="btn btn-outline-dark"
        >
            Buscar
        </button>
    </form>
</div>





<!-- Sección de Contadores a Pantalla Completa -->
<section class="d-flex flex-wrap position-relative text-center" style="height:100vh; background-color:#f8f5ec;">

  <!-- Líneas divisorias -->
  <div style="position:absolute; top:50%; left:0; width:100%; height:2px;  transform:translateY(-50%); z-index:1;"></div>
  <div style="position:absolute; left:50%; top:0; width:2px; height:100%;  transform:translateX(-50%); z-index:1;"></div>

  <!-- Cuadro 1 -->
  <div class="col-6 d-flex flex-column justify-content-center align-items-center p-4 quadrant" style="background-color:#FFFFFF;">
    <p class="fs-4 mb-0" style="color:#E44942;">Más de</p>
    <h1 class="fw-bold counter" data-target="30" style="font-size:5rem; color:#E44942;">0</h1>
    <p class="fs-4 mb-0" style="color:#E44942;">Años de trayectoria</p>
  </div>

  <!-- Cuadro 2 -->
  <div class="col-6 d-flex flex-column justify-content-center align-items-center p-4 quadrant" style="background-color:#FFFFFF;">
    <p class="fs-4 mb-0" style="color:#7689A5;">Más de</p>
    <h1 class="fw-bold counter" data-target="40" style="font-size:5rem; color:#7689A5;">0</h1>
    <p class="fs-4 mb-0" style="color:#7689A5;">Volúmenes</p>
  </div>

  <!-- Cuadro 3 -->
  <div class="col-6 d-flex flex-column justify-content-center align-items-center p-4 quadrant" style="background-color:#FFFFFF;">
        <p class="fs-4 mb-0" style="color:#F2B81B;">Más de</p>
    <h1 class="fw-bold counter" data-target="400" style="font-size:5rem; color:#F2B81B;">0</h1>
    <p class="fs-4 mb-0" style="color:#F2B81B;">Autores</p>
  </div>

  <!-- Cuadro 4 -->
  <div class="col-6 d-flex flex-column justify-content-center align-items-center p-4 quadrant" style="background-color:#FFFFFF;">
    <h1 class="fw-bold counter" data-target="24" style="font-size:5rem; color:#34142F;">0</h1>
    <p class="fs-4 mb-0" style="color:#34142F;">Investigadores del comité editorial</p>
  </div>
</section>

<script>
  // --- Animación de contadores ---
  const counters = document.querySelectorAll('.counter');
  const speed = 150;

  const animateCounters = () => {
    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = target / speed;

        if (count < target) {
          counter.innerText = Math.ceil(count + increment);
          setTimeout(updateCount, 20);
        } else {
          counter.innerText = target;
        }
      };
      updateCount();
    });
  };

  // Detecta cuando entra a la vista
  const section = document.querySelector('section.d-flex.flex-wrap');
  let started = false;
  window.addEventListener('scroll', () => {
    const sectionTop = section.offsetTop - window.innerHeight + 100;
    if (!started && window.scrollY > sectionTop) {
      animateCounters();
      started = true;
    }
  });
</script>




<!-- Línea del Tiempo -->
<section class="timeline-section py-5">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="color:#E44942;">Nuestra historia</h2>

    <div class="timeline position-relative">
      <!-- Línea central -->
      <div class="timeline-line"></div>

      <!-- Item 1 -->
      <div class="timeline-item">
        <div class="timeline-content bg-white shadow-sm rounded p-4">
          <h5 class="fw-bold" style="color:#E44942;">1994</h5>
          <p>Nace <em>Estudios del Hombre</em>, como una revista especializada en Antropología, Arqueología, Historia y Etnografía..</p>
        </div>
      </div>

      <!-- Item 1.5 -->
      <div class="timeline-item">
        <div class="timeline-content bg-white shadow-sm rounded p-4">
          <h5 class="fw-bold" style="color:#E44942;">1997</h5>
          <p>La revista comenzó a ser una publicación temática a partir del número 5 con el tema <em>Ensayos sobre el tiempo</em>.</p>
        </div>
      </div>

      <!-- Item 2 -->
      <div class="timeline-item">
        <div class="timeline-content bg-white shadow-sm rounded p-4">
          <h5 class="fw-bold" style="color:#E44942;">2006</h5>
          <p>La publicación se gestionó como una colección de libros y se crearon las series Antropología, Antropología de la alimentación, Arqueología, Historia, Interfaces y Ensayos.</p>
        </div>
      </div>

      <!-- Item 3 -->
      <div class="timeline-item">
        <div class="timeline-content bg-white shadow-sm rounded p-4">
          <h5 class="fw-bold" style="color:#E44942;">2021</h5>
          <p>Se actualiza el comité editorial.</p>
        </div>
      </div>

      <!-- Item 3 -->
      <div class="timeline-item">
        <div class="timeline-content bg-white shadow-sm rounded p-4">
          <h5 class="fw-bold" style="color:#E44942;">2023</h5>
          <p><em>Estudios de la humanidad</em>  actualiza el nombre de la colección a <em>Estudios de la humanidad</em>.</p>
        </div>
      </div>

      <!-- Item 4 -->
      <div class="timeline-item">
        <div class="timeline-content bg-white shadow-sm rounded p-4">
          <h5 class="fw-bold" style="color:#E44942;">2025</h5>
          <p>Se crea el logotipo del departamento.</p>
        </div>
      </div>

      <!-- Item 4 -->
      <div class="timeline-item">
        <div class="timeline-content bg-white shadow-sm rounded p-4">
          <h5 class="fw-bold" style="color:#E44942;">2026</h5>
          <p>Se integra los DOI a las publicaciones en formato digital.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- <hr class="my-5"> --}}

<hr style="width: 150px; border: 2px solid #F2B81B; margin: 2rem auto; opacity: 1; border-radius: 2px;">





<section class="py-5" style="background: linear-gradient(180deg, #EDE4CA, #FFFFFF);">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-9">
        {{-- <div class="p-5 rounded-4 shadow-sm bg-white"> --}}
          <h2 class="fw-bold mb-4" style="color:#34142F;">Presentación</h2>
          <p class="text-muted" style="text-align: justify; line-height: 1.8;">
            Las temáticas abordadas en las publicaciones de la Colección <strong>Estudios de la Humanidad</strong> buscan aportar conocimientos sobre el ser humano y su incidencia en el mundo desde una perspectiva humanística y de las ciencias sociales, sin limitación de marco temporal y espacial. <br> <br>Se trata de textos que examinan, desde enfoques teóricos y metodológicos diversos y transdisciplinarios, los fenómenos de las diversas expresiones de la cultura material y simbólica de la Humanidad; se abordan también aspectos de la sociedad, de la historia, la etnohistoria y la etnografía del Occidente de México, de sus agentes individuales y colectivos, y sus movimientos sociales.
          </p>
        {{-- </div> --}}
      </div>
    </div>
  </div>
</section>





{{-- <hr class="my-5"> --}}
{{-- <hr style="width: 150px; border: 2px solid #F2B81B; margin: 2rem auto; opacity: 1; border-radius: 2px;"> --}}


{{-- COMITÉ EDITORIAL CON COLLAPSE --}}
<section class="container my-5">
  <h3 class="fw-bold mb-3" style="display: inline-block; border-bottom: 1px solid #F2B81B; padding-bottom: 0.25rem;">Comité Editorial</h3>

  {{-- Directora visible --}}
  <div class="mb-3">
    <h5 class="fw-bold text-danger" style="color:#E44942;">Directora:</h5>
    <p><strong>Chloé Marie Pomedio</strong></p>
  </div>

  {{-- Botón para mostrar resto del comité --}}
  <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#comiteCollapse" aria-expanded="false" aria-controls="comiteCollapse"  >
    Ver resto del comité editorial
  </button>

  <div class="collapse mt-3" id="comiteCollapse">
    <ul class="list-unstyled">
      @foreach($comite as $miembro)
        @if(!Str::contains(strtolower($miembro->nombre), 'chloé')) {{-- evita repetir a la directora --}}
          <li class="mb-2">
            <strong>{{ $miembro->nombre }} {{ $miembro->apellido }}</strong> — 
            <span class="text-muted">{{ $miembro->dependencia }}, {{ $miembro->pais }}</span>
          </li>
        @endif
      @endforeach
    </ul>
  </div>
</section>

{{-- <hr class="my-5"> --}}

<hr style="width: 150px; border: 2px solid #F2B81B; margin: 2rem auto; opacity: 1; border-radius: 2px;">



{{-- LINEAMIENTOS Y NORMAS --}}
<section class="container">
  <h3 class="fw-bold mb-3" style="display: inline-block; border-bottom: 1px solid #F2B81B; padding-bottom: 0.25rem;"">Lineamientos y Normas</h3>
  {{-- <div class="row g-4">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body"> --}}
          <h5 class="card-title" style="color:#E44942;">Dictaminación y normas editoriales</h5>
          <p class="card-text text-muted">Revisa el proceso de dictaminación y las normas editoriales.</p>
          <a href="{{ asset('pdfs/2025_Normas_actualizadas_guía_de_autores_y_coordinadores. EDH.docx.pdf') }}" download class="btn text-white" style="background-color:#F2B81B;">
            Descargar PDF
          </a>
        {{-- </div>
      </div>
    </div>
  </div> --}}
</section>

{{-- <hr class="my-5"> --}}
<hr style="width: 150px; border: 2px solid #F2B81B; margin: 2rem auto; opacity: 1; border-radius: 2px;">


{{-- PROPUESTAS --}}
<section class="container mb-5">
  <h3 class="fw-bold mb-3" style="display: inline-block; border-bottom: 1px solid #F2B81B; padding-bottom: 0.25rem;"">Propuestas de números</h3>
  <p class="text-muted">
    Si cuentas con un producto de investigación que se alinee con los principios de la colección Estudios de la Humanidad, 
    puedes enviarlo para evaluación del comité editorial mediante el siguiente formato.
  </p>
  <a href="{{ asset('pdfs/EDH_Formato_Presentacion_Propuesta_2025.docx') }}" 
     download class="btn text-white" 
     style="background-color:#F2B81B;">
     Descargar Formato (Word)
  </a>
</section>


<style>
  /* === ESTILOS DE LÍNEA DEL TIEMPO === */
  .timeline {
    position: relative;
    padding: 2rem 0;
  }

  /* Línea central */
  .timeline-line {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: 100%;
    background-color: #F2B81B;
  }

  .timeline-item {
    position: relative;
    margin-bottom: 2rem;
  }

  /* Puntos circulares */
  .timeline-item::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 18px;
    height: 18px;
    background-color: #E44942;
    border-radius: 50%;
    z-index: 1;
  }

  /* Caja de contenido */
  .timeline-content {
    position: relative;
    width: 45%;
  }

  /* Alineación alternada */
  .timeline-item:nth-child(odd) .timeline-content {
    margin-left: 55%;
  }

  .timeline-item:nth-child(even) .timeline-content {
    margin-right: 55%;
  }

  /* Responsivo */
  @media (max-width: 768px) {
    .timeline-line {
      left: 8px;
    }
    .timeline-item::before {
      left: 8px;
      transform: none;
    }
    .timeline-content {
      width: calc(100% - 30px);
      margin: 0 0 0 30px !important;
    }
  }
</style>

@endsection
