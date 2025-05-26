<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subir fotos</title>
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

    <h1>Subir foto a la galería</h1>

    <form action="{{ route('galeria.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="carrera_id">Carrera:</label>
        <select name="carrera_id" required>
            @foreach($carreras as $carrera)
                <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
            @endforeach
        </select>

        <label for="imagenes">Imágenes:</label>
        <input type="file" name="imagenes[]" multiple accept="image/*" required>

        <button type="submit">Subir</button>
    </form>

    <form action="{{ route('inicio') }}" method="GET" style="display:inline;">
        <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem;">
            <span class="tooltip-text">Volver</span>
                Volver
        </button>
    </form>

</body>
</html>
