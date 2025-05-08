<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <title>Registrar Carrera</title>
</head>
<body>
    <header class="navbar">
        <div class="navbar-logo">
            <a href="{{ route('inicio') }}">
                <h1>Corre Y Vuela</h1>
            </a>
        </div>
        <nav class="navbar-links">
            <p class="bienvenida">
                @auth
                    @if(Auth::user()->admin)
                        Bienvenido, administrador {{ Auth::user()->name }}
                    @else
                        Bienvenido, {{ Auth::user()->name }}
                    @endif
                @endauth
            </p>
            <form action="{{ route('logout') }}" method="POST" class="logout">
                @csrf
                <button type="submit" class="btn-logout">
                    <span class="tooltip">Cerrar sesión</span>
                </button>
            </form>
        </nav>
    </header>
    <div class="main-content animate-fadein">
        <h1>Registrar Carrera</h1>
        <form action="{{ route('guardarCarrera') }}" method="POST" autocomplete="off">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre de la carrera:</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Ej: Carrera del Pavo">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required placeholder="Describe la carrera..."></textarea>
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

            

            <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1.2rem;">
                Registrar Carrera
                <span class="tooltip-text">Registrar Carrera</span>
            </button>
        </form>

        <form action="{{ route('inicio') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem;">
                <span class="tooltip-text">Volver</span>
            </button>
        </form>
    </div>
</body>
</html>
