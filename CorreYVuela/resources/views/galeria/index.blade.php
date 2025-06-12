<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Galería de fotos</title>
  <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  <style>
    .galeria {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      gap: 20px;
      max-width: 720px;
      margin: 2rem auto 4rem auto;
      padding: 0 1rem;
    }
    .foto {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.08);
      overflow: hidden;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 120px;
      width: 120px;
      margin: auto;
    }
    .foto img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 12px;
      display: block;
      user-select: none;
      pointer-events: none;
    }
    .foto:hover {
      transform: scale(1.05);
      box-shadow: 0 12px 24px rgba(0,0,0,0.12);
    }

    .controls {
      max-width: 720px;
      margin: 1.5rem auto 0 auto;
      padding: 0 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;
    }
    .controls form {
      flex-grow: 1;
      min-width: 180px;
    }
    .controls select {
      width: 100%;
      padding: 0.5rem 0.75rem;
      border-radius: 8px;
      border: 1px solid #e2c275;
      background: #f9f6f2;
      font-weight: 600;
      font-size: 1rem;
      color: #2d3540;
      transition: box-shadow 0.2s ease;
      cursor: pointer;
    }
    .controls select:hover,
    .controls select:focus {
      box-shadow: 0 0 6px #e2c275;
      outline: none;
    }
    .btn-subir-fotos {
      background: linear-gradient(90deg, #f5e6b2, #f9f6f2);
      border: none;
      padding: 0.7rem 1.6rem;
      border-radius: 30px;
      font-weight: 700;
      font-size: 1.1rem;
      color: #2d3540;
      box-shadow: 0 4px 12px rgba(226, 194, 117, 0.25);
      transition: background 0.3s ease, transform 0.2s ease;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
    }
    .btn-subir-fotos:hover {
      background: linear-gradient(90deg, #f9f6f2, #f5e6b2);
      transform: scale(1.05);
    }

    .lightbox {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100vw; height: 100vh;
      background: rgba(0, 0, 0, 0.9);
      justify-content: center;
      align-items: center;
      cursor: zoom-out;
      z-index: 9999;
      padding: 1rem;
    }
    .lightbox.active {
      display: flex;
    }
    .lightbox img {
      max-width: 90vw;
      max-height: 90vh;
      border-radius: 12px;
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.4);
      user-select: none;
    }

    h1.page-title {
      text-align: center;
      font-family: 'Georgia', serif;
      font-weight: 700;
      font-size: 2.4rem;
      margin: 2rem 0 1rem 0;
      color: #2d3540;
      text-shadow: 1px 1px 6px #f5e6b2;
    }

    form.volver {
      max-width: 720px;
      margin: 0 auto 3rem auto;
      padding: 0 1rem;
      text-align: center;
    }
    form.volver button {
      padding: 0.6rem 2rem;
      border-radius: 30px;
      border: none;
      background: linear-gradient(90deg, #f9f6f2, #f5e6b2);
      font-weight: 700;
      font-size: 1rem;
      color: #2d3540;
      cursor: pointer;
      box-shadow: 0 3px 10px rgba(226, 194, 117, 0.3);
      transition: background 0.3s ease, transform 0.2s ease;
    }
    form.volver button:hover {
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

  <main>
    <h1 class="page-title">Galería de fotos</h1>

    <div class="controls">
      <form method="GET" action="{{ route('galeria.index') }}">
        <label for="carrera_id" class="visually-hidden">Filtrar por carrera:</label>
        <select name="carrera_id" id="carrera_id" onchange="this.form.submit()">
          <option value="">Todas</option>
          @foreach($carreras as $carrera)
            <option value="{{ $carrera->id }}" {{ $carreraId == $carrera->id ? 'selected' : '' }}>
              {{ $carrera->nombre }}
            </option>
          @endforeach
        </select>
      </form>

      @if(Auth::user()->admin)
      <a href="{{ route('galeria.create') }}" class="btn-subir-fotos" title="Subir fotos">
        <i class="fas fa-upload"></i> Subir fotos
      </a>
      @endif
    </div>

    <section class="galeria" aria-label="Galería de fotos">
      @forelse($fotos as $foto)
        <div class="foto" tabindex="0" role="button" aria-pressed="false" aria-label="Abrir foto ampliada">
          <img src="{{ asset('storage/' . $foto->ruta) }}" data-src="{{ asset('storage/' . $foto->ruta) }}" alt="Foto de galería" />
        </div>
      @empty
        <p style="text-align:center; margin-top:2rem; color:#a0a0a0;">No hay fotos para esta carrera.</p>
      @endforelse
    </section>

    <form action="{{ route('galeria.index') }}" method="GET" class="volver">
      <button type="submit">
        Volver a galería completa
      </button>
    </form>
  </main>

  <div class="lightbox" aria-hidden="true" role="dialog" aria-modal="true">
    <img src="" alt="Foto ampliada" />
  </div>

  <script>
    const fotos = document.querySelectorAll('.foto');
    const lightbox = document.querySelector('.lightbox');
    const lightboxImg = lightbox.querySelector('img');

    fotos.forEach(foto => {
      foto.addEventListener('click', () => {
        const img = foto.querySelector('img');
        lightboxImg.src = img.dataset.src || img.src;
        lightbox.setAttribute('aria-hidden', 'false');
        lightbox.classList.add('active');
        lightboxImg.focus();
      });
      foto.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          foto.click();
        }
      });
    });

    lightbox.addEventListener('click', () => {
      lightbox.classList.remove('active');
      lightbox.setAttribute('aria-hidden', 'true');
      lightboxImg.src = '';
    });

    lightboxImg.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        lightbox.classList.remove('active');
        lightbox.setAttribute('aria-hidden', 'true');
        lightboxImg.src = '';
      }
    });
  </script>
</body>
</html>
