<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar inscripción</title>
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
                    @else
                        Bienvenido, {{ Auth::user()->name }}
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

    <div class="main-content animate-fadein">
        <h2 style="text-align:center; color:#8d7964; margin-bottom:1.5rem;">Editar inscripción en <span style="color:#bfae9c;">{{ $carrera->nombre }}</span></h2>

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div style="color: #c0392b; margin-bottom: 1rem; text-align:center;">
                <ul style="list-style:none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario de edición --}}
        <form action="{{ route('inscripcion.update', [$carrera->id, $usuario->id]) }}" method="POST" class="form-inscripcion-box">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required>
            </div>
            <div class="form-group">
                <label>Primer Apellido</label>
                <input type="text" name="apellido1" value="{{ old('apellido1', $usuario->apellido1) }}" required>
            </div>
            <div class="form-group">
                <label>Segundo Apellido</label>
                <input type="text" name="apellido2" value="{{ old('apellido2', $usuario->apellido2) }}">
            </div>
            <div class="form-group">
                <label>DNI</label>
                <input type="text" name="dni" value="{{ old('dni', $usuario->dni) }}" required>
            </div>
            <div class="form-group">
                <label>Localidad</label>
                <input type="text" name="localidad" value="{{ old('localidad', $usuario->localidad) }}" required>
            </div>
            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento) }}" required>
            </div>
            <div class="form-group">
                <label for="modalidad">Modalidad:</label>
                <select id="modalidad" name="modalidad" required>
                    <option value="" disabled {{ old('modalidad', $inscripcion->pivot->modalidad ?? '') == '' ? 'selected' : '' }}>Selecciona la modalidad</option>
                    <option value="Senderismo" {{ old('modalidad', $inscripcion->pivot->modalidad ?? '') == 'Senderismo' ? 'selected' : '' }}>Senderismo</option>
                    <option value="Ciclismo" {{ old('modalidad', $inscripcion->pivot->modalidad ?? '') == 'Ciclismo' ? 'selected' : '' }}>Ciclismo</option>
                    <option value="Trail" {{ old('modalidad', $inscripcion->pivot->modalidad ?? '') == 'Trail' ? 'selected' : '' }}>Trail</option>
                </select>
            </div>
            <div class="form-group">
                <label>Categoría:</label>
                <input type="text" name="categoria" value="{{ old('categoria', $inscripcion->pivot->categoria ?? 'Sin categoría') }}" readonly>
            </div>
            <button type="submit" class="btn-admin">Guardar Cambios</button>
        </form>

        {{-- Formulario para borrar inscripción --}}
        <form action="{{ route('inscripcion.destroy', [$carrera->id, $usuario->id]) }}" method="POST" class="form-inscripcion-box" style="margin-top: 1.5rem;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-admin" style="background-color: #c0392b;"
                onclick="return confirm('¿Seguro que quieres borrar tu inscripción?');">
                Borrar Inscripción
            </button>
        </form>

        <form action="{{ route('pruebas') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn-admin" style="margin-top:1rem;">
                Volver
            </button>
        </form>
    </div>
</body>
</html>
