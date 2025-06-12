<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
            <form action="{{ route('logout') }}" method="POST" class="logout">
                @csrf
                <button type="submit" class="btn-logout">
                    Cerrar sesión
                    <span class="tooltip-text">Cerrar sesión</span>
                </button>
            </form>
        </nav>
    </header>

    <main class="container my-4">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <section class="mb-4">
            <h2>Foto de Perfil</h2>
            <img src="{{ $usuario->foto_perfil ? asset('storage/' . $usuario->foto_perfil) : asset('images/default-profile.png') }}"
                alt="Foto de perfil" width="120" class="rounded-circle mb-3 d-block">

            <form action="{{ route('auth.actualizarFoto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="foto_perfil" required>
                @error('foto_perfil')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary btn-sm mt-2"
                    style="color: #2d3540; font-size: 16px; font-weight: 800;">Actualizar foto</button>
            </form>
        </section>

        <section class="mb-5">
            <h2>Editar Datos</h2>
            <form action="{{ route('auth.actualizarPerfil') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}"
                        class="form-control" required>
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="apellido1" class="form-label">Primer Apellido</label>
                    <input type="text" name="apellido1" id="apellido1"
                        value="{{ old('apellido1', $usuario->apellido1) }}" class="form-control" required>
                    @error('apellido1')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="apellido2" class="form-label">Segundo Apellido</label>
                    <input type="text" name="apellido2" id="apellido2"
                        value="{{ old('apellido2', $usuario->apellido2) }}" class="form-control" required>
                    @error('apellido2')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="localidad" class="form-label">Localidad</label>
                    <input type="text" name="localidad" id="localidad"
                        value="{{ old('localidad', $usuario->localidad) }}" class="form-control" required>
                    @error('localidad')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                        class="form-control" required>
                    @error('telefono')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}"
                        class="form-control" required>
                    @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-success"
                    style="color: #2d3540; font-size: 16px; font-weight: 800;">Guardar cambios</button>
            </form>
        </section>

        <section>
            <h2>Mis Carreras</h2>
            @if($carreras->isEmpty())
                <p>No has realizado ninguna carrera.</p>
            @else
                <ul class="list-group">
                    @foreach($carreras as $carrera)
                        <li class="list-group-item">
                            <strong>{{ $carrera->nombre }}</strong> -
                            {{ \Carbon\Carbon::parse($carrera->fecha)->format('d/m/Y') }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>