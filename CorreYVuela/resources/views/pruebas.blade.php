<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Pruebas</title>
    <style>
    .carreras-container {
    max-width: 900px; /* Más ancho para el contenedor */
    margin: 2rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.carrera-block {
    margin-bottom: 3.5rem;
    padding-bottom: 2.5rem;
    border-bottom: 1px solid #e0e0e0;
    text-align: center;
}

.carrera-cartel {
    display: block;
    margin: 0 auto 1.5rem auto;
    max-width: 500px;  /* Imagen más grande */
    max-height: 600px; /* Altura mayor para no deformar */
    width: 100%;       /* Para que sea responsiva */
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    object-fit: contain; /* Mantiene proporciones sin recortar */
}

.carrera-title {
    margin-bottom: 0.7rem;
    font-size: 2.4rem; /* Título más grande */
    color: #1a237e#f5cba7;
}

.carrera-info {
    margin: 0.3rem 0;
    font-size: 1.15rem; /* Texto un poco más grande */
    line-height: 1.5;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

.btn-info {
    margin-top: 1.2rem;
    padding: 0.7rem 1.8rem;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background 0.25s;
}



@media (max-width: 960px) {
    .carreras-container {
        max-width: 95%;
        padding: 1rem;
    }
    .carrera-cartel {
        max-width: 100%;
        max-height: 400px;
    }
    .carrera-title {
        font-size: 1.8rem;
    }
    .carrera-info {
        font-size: 1rem;
    }
}

.search-container {
    display: flex;
    justify-content: center;
    margin: 1.5rem auto 0 auto;
}

#search {
    padding: 0.8rem;
    border-radius: 8px;
    border: 1px solid #ccc;
    width: 90%;
    max-width: 600px;
    font-size: 1rem;
}


    </style>
</head>
<body>
    <header class="navbar">
        <div class="navbar-logo">
            <a href="{{ route('inicio') }}" style="text-decoration: none; color: inherit;">
                <h1>Corre Y Vuela</h1>
            </a>
        </div>
        <nav class="navbar-links">
            <p class="bienvenida">
                @auth
                    @if(Auth::user()->admin)
                        Bienvenido, administrador {{ Auth::user()->name }}
                        <img class="perfil-usuario-header"
                             src="{{ Auth::user()->foto_perfil ? asset('storage/' . Auth::user()->foto_perfil) : asset('images/default-profile.png') }}"
                             alt="Foto de perfil">
                    @else
                        Bienvenido, {{ Auth::user()->name }}
                        <img class="perfil-usuario-header"
                             src="{{ Auth::user()->foto_perfil ? asset('storage/' . Auth::user()->foto_perfil) : asset('images/default-profile.png') }}"
                             alt="Foto de perfil">
                    @endif
                @endauth
            </p>
            @auth
                @if(Auth::user()->admin)
                    <form action="{{ route('registrarCarrera') }}" method="GET" style="display:inline;">
                        <button type="submit" class="btn-admin tooltip-btn">
                            Registrar Carrera
                            <span class="tooltip-text">Registrar Carrera</span>
                        </button>
                    </form>
                @endif
            @endauth

            <a href="{{ url('menuUsuario') }}" class="btn-logout btn-zona-privada" style="margin-top: 10px;">
                <i class="fas fa-user-circle"></i>
                Zona privada
                <span class="tooltip-text">Ver tu perfil y datos</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="logout">
                @csrf
                <button type="submit" class="btn-logout">
                    Cerrar sesión
                    <span class="tooltip-text">Cerrar sesión</span>
                </button>
            </form>
        </nav>
    </header>

    <div class="search-container">
    <input type="text" id="search" placeholder="Buscar carrera por nombre..." onkeyup="buscarCarreras()">
    </div>


    <div class="carreras-container">
        @forelse($carreras as $carrera)
            <div class="carrera-block">
                @if($carrera->cartel)
                    <img src="{{ asset('storage/' . $carrera->cartel) }}" alt="Cartel de la carrera" class="carrera-cartel">
                @endif
                <h1 class="carrera-title">{{ $carrera->nombre }}</h1>
                <p class="carrera-info">{{ $carrera->descripcion }}</p>
                <p class="carrera-info"><strong>Fecha:</strong> {{ $carrera->fecha }}</p>
                <p class="carrera-info"><strong>Hora:</strong> {{ $carrera->hora }}</p>
                <p class="carrera-info"><strong>Ubicación:</strong> {{ $carrera->lugar }}</p>
                <p class="carrera-info"><strong>Distancia:</strong> {{ $carrera->distancia }} Km</p>
                <p class="carrera-info"><strong>Estado:</strong> {{ ucfirst($carrera->estado) }}</p>
                <form action="{{ route('informacionPrueba', $carrera->id) }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn-info" style="color: #2d3540">
                        Información de la prueba
                    </button>
                </form>
            </div>

        @empty
            <h2 style="text-align:center; margin-top:2rem;">Actualmente no tenemos ninguna prueba por realizar</h2>
        @endforelse

        <form action="{{ route('inicio') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem;">
                <span class="tooltip-text">Volver</span>
                Volver
            </button>
        </form>
    </div>
<script>
    function buscarCarreras() {
        var input, filter, container, blocks, title, i, txtValue;
        input = document.getElementById('search');
        filter = input.value.toUpperCase();
        container = document.querySelector('.carreras-container');
        blocks = container.getElementsByClassName('carrera-block');

        for (i = 0; i < blocks.length; i++) {
            title = blocks[i].getElementsByClassName('carrera-title')[0];
            if (title) {
                txtValue = title.textContent || title.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    blocks[i].style.display = "";
                } else {
                    blocks[i].style.display = "none";
                }
            }
        }
    }
</script>

</body>
</html>
