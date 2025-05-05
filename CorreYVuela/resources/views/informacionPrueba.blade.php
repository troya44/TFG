<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información Pruebas</title>
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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

<h1>{{ $carrera->nombre }}</h1>
<p>{{ $carrera->descripcion }}</p>
<p>Fecha: {{ $carrera->fecha }}</p>
<p>Hora: {{ $carrera->hora }}</p>
<p>Ubicación: {{ $carrera->lugar }}</p>
<p>Distancia: {{ $carrera->distancia }} Km</p>
<p>Estado: {{ $carrera->estado }}</p>

<!-- Botón para ver listado de inscritos -->
<form action="{{ route('listadoInscritos', $carrera->id) }}" method="GET" style="display:inline;">
    <button type="submit" class="btn-listado">
        Ver listado de inscritos
    </button>
</form>

<!-- Botón para inscribirse -->
<button type="button" class="btn-inscribirme" onclick="document.getElementById('form-inscripcion').style.display='flex'">
    Inscribirme
</button>

<!-- Formulario de inscripción oculto por defecto -->
<div id="form-inscripcion" class="form-inscripcion-box" style="display:none;">
    <form action="{{ route('inscribirse', $carrera->id) }}" method="POST" style="width:100%;">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ Auth::user()->name }}" required>
        <label>Primer apellido:</label>
        <input type="text" name="apellido1" value="{{ Auth::user()->apellido1 }}" required>
        <label>Segundo apellido:</label>
        <input type="text" name="apellido2" value="{{ Auth::user()->apellido2 }}">
        <label>DNI:</label>
        <input type="text" name="dni" value="{{ Auth::user()->dni }}" required>
        <label>Email:</label>
        <input type="email" name="email" value="{{ Auth::user()->email }}" required>
        <!-- Añade aquí más campos si lo necesitas -->
        <button type="submit">Confirmar inscripción</button>
    </form>
    <form action="{{ route('inicio') }}" method="GET" style="display:inline;">
    <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem;">
        Volver
        <span class="tooltip-text">Volver</span>
    </button>
</form>
</div>



</body>
</html>