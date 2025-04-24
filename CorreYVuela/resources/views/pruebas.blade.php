<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <title>Pruebas</title>
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
                    <!-- Puedes poner aquí un icono si tienes FontAwesome -->
                </button>
            </form>
        </nav>
    </header>
    @forelse($carreras as $carrera)
        <h1>{{ $carrera->nombre }}</h1>
        <p>{{ $carrera->descripcion }}</p>
        <p>Fecha: {{ $carrera->fecha }}</p>
        <p>Hora: {{ $carrera->hora }}</p>
        <p>Ubicación: {{ $carrera->lugar }}</p>
        <p>Distancia: {{ $carrera->distancia }}</p>
        <p>Estado: {{ $carrera->estado }}</p>
        <hr>
    @empty
        <h2>actualmente no tenemos ninguna prueba por realizar</h2>
    @endforelse
</body>
</html>
