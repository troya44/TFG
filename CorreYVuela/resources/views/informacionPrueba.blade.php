<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información Pruebas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
.carrera-cartel {
    display: block;
    margin: 2rem auto 1.5rem auto;
    max-width: 450px;
    max-height: 450px;
    width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    object-fit: contain;
}
</style>

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

            <a href="menuUsuario" class="logout">Zona privada</a>
            <form action="{{ route('logout') }}" method="POST" class="logout">
                @csrf
                <button type="submit" class="btn-logout">
                    Cerrar sesión
                    <span class="tooltip-text">Cerrar sesión</span>
                </button>
            </form>
        </nav>
    </header>
    @if($carrera->cartel)
        <img src="{{ asset('storage/' . $carrera->cartel) }}" alt="Cartel de la carrera" class="carrera-cartel">
    @endif
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
    <button type="button" class="btn-inscribirme"
        onclick="document.getElementById('form-inscripcion').style.display='flex'">
        Inscribirme
    </button>

    <form action="{{ route('pruebas') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem; position:relative;">
                <span class="tooltip-text">Volver</span>
                Volver
            </button>
        </form>

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
            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" value="{{ Auth::user()->categoria }}" readonly>
            <label for="modalidad">Modalidad:</label>
            <select id="modalidad" name="modalidad" required>
                <option value="" disabled selected>Selecciona la modalidad</option>
                <option value="Senderismo">Senderismo</option>
                <option value="Ciclismo">Ciclismo</option>
                <option value="Trail">Trail</option>
            </select>
            <!-- Añade aquí más campos si lo necesitas -->
            <button type="submit">Confirmar inscripción</button>
        </form>
        <form action="{{ route('pruebas') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem; position:relative;">
                <span class="tooltip-text">Volver</span>
                Volver
            </button>
        </form>
    </div>



</body>

</html>
