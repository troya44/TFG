<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Registrar Carrera</title>
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
    <div class="main-content animate-fadein">
        <h1>Registrar Carrera</h1>
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom:1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('guardarCarrera') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre de la carrera:</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Ej: Carrera del Pavo">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required
                    placeholder="Describe la carrera..."></textarea>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>

            <div class="form-group">
                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>
            </div>

            <div class="form-group">
                <label for="lugar">Ubicación:</label>
                <input type="text" id="lugar" name="lugar" required placeholder="Ej: Cañete la Real">
            </div>

            <div class="form-group">
                <label for="distancia">Distancia (km):</label>
                <input type="number" id="distancia" name="distancia" required min="1" step="0.01" placeholder="Ej: 10">
            </div>

            <label for="cartel">Cartel de la carrera:</label>
            <input type="file" name="cartel" accept="image/*">



            <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1.2rem;">
                Registrar Carrera
                <span class="tooltip-text">Registrar Carrera</span>
            </button>
        </form>

        <form action="{{ route('inicio') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem;">
                <span class="tooltip-text">Volver</span>
                Volver
            </button>
        </form>
    </div>
</body>

</html>


Podría reformularse así para darle más fluidez y naturalidad: ✔ "Corre y Vuela es mucho más que una simple plataforma
para eventos deportivos. Es una manera de vivir el deporte al aire libre con toda la emoción del espectáculo y el
espíritu de comunidad. Nuestra aplicación está diseñada para que cada persona, sin importar su nivel o condición, pueda
inscribirse de manera sencilla y disfrutar de una experiencia inolvidable. Creemos en la inclusión y la sostenibilidad,
porque el deporte debe ser accesible para todos y respetuoso con el entorno."