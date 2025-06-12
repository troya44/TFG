<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Subir fotos</title>
  <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  <style>
    body {
      background-color: #fefbf1;
      color: #2d3540;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }






    main {
      flex-grow: 1;
      max-width: 540px;
      margin: 3rem auto;
      background: white;
      padding: 2.5rem 2rem;
      border-radius: 15px;
      box-shadow: 0 12px 40px rgba(226, 194, 117, 0.25);
    }

    main h1 {
      text-align: center;
      margin-bottom: 2rem;
      color: #e2c275;
      font-weight: 700;
      text-shadow: 1px 1px 6px #f5e6b2;
    }

    label {
      font-weight: 600;
      color: #6c757d;
      display: block;
      margin-bottom: 0.5rem;
      margin-top: 1rem;
    }

    select,
    input[type="file"] {
      width: 100%;
      padding: 0.5rem 1rem;
      border-radius: 12px;
      border: 1px solid #e2c275;
      background-color: #f9f6f2;
      font-weight: 600;
      color: #2d3540;
      font-size: 1rem;
      transition: box-shadow 0.3s ease;
      cursor: pointer;
    }

    select:focus,
    input[type="file"]:focus {
      outline: none;
      box-shadow: 0 0 10px #e2c275;
      background-color: #fffbe0;
    }

    button[type="submit"] {
      width: 100%;
      margin-top: 2.2rem;
      background: linear-gradient(90deg, #f5e6b2, #f9f6f2);
      border: none;
      border-radius: 30px;
      padding: 0.75rem;
      font-weight: 700;
      font-size: 1.1rem;
      color: #2d3540;
      box-shadow: 0 7px 20px rgba(226, 194, 117, 0.35);
      cursor: pointer;
      transition: background 0.3s ease, transform 0.15s ease;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0.5rem;
    }

    button[type="submit"]:hover {
      background: linear-gradient(90deg, #f9f6f2, #f5e6b2);
      transform: scale(1.04);
    }

    form.btn-admin {
      max-width: 540px;
      margin: 2rem auto 0 auto;
      text-align: center;
    }

    .btn-admin button {
      background: linear-gradient(90deg, #f9f6f2, #f5e6b2);
      border: none;
      border-radius: 30px;
      padding: 0.7rem 2rem;
      font-weight: 700;
      font-size: 1rem;
      color: #2d3540;
      box-shadow: 0 4px 15px rgba(226, 194, 117, 0.3);
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .btn-admin button:hover {
      background: linear-gradient(90deg, #f5e6b2, #f9f6f2);
      transform: scale(1.05);
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
        alt="Foto de perfil" />
      @else
        Bienvenido, {{ Auth::user()->name }}
        <img class="perfil-usuario-header"
        src="{{ Auth::user()->foto_perfil ? asset('storage/' . Auth::user()->foto_perfil) : asset('images/default-profile.png') }}"
        alt="Foto de perfil" />
      @endif
    @endauth
      </p>

      <a href="{{ url('menuUsuario') }}" class="btn-logout btn-zona-privada" style="margin-top: 35px;">
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

  <main>
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

      <button type="submit" class="fas fa-upload">Subir</button>
    </form>

    <form action="{{ route('inicio') }}" method="GET" class="btn-admin">
      <button type="submit" class="tooltip-btn">
        <span class="tooltip-text">Volver</span> Volver
      </button>
    </form>
  </main>
</body>

</html>