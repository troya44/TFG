<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Galeria de fotos</title>
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .galeria {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 16px;
    margin: 24px auto 0 auto;
    max-width: 700px; /* Limita el ancho de la galería y la centra */
    justify-items: center; /* Centra los elementos en cada celda */
}
.foto {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.foto img {
    width: 90px;  /* Tamaño pequeño */
    height: 90px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    transition: box-shadow 0.2s;
    cursor: pointer;
}
.foto img:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.lightbox {
    display: none; /* oculto por defecto */
    position: fixed;
    z-index: 9999;
    top: 0; left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0,0,0,0.85);
    justify-content: center;
    align-items: center;
    cursor: zoom-out; /* indica que se puede cerrar */
}

.lightbox.active {
    display: flex;
}

.lightbox img {
    max-width: 90vw;
    max-height: 90vh;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0,0,0,0.7);
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

     <h1>Galería de fotos</h1>
    <form method="GET" action="{{ route('galeria.index') }}">
        <label for="carrera_id">Filtrar por carrera:</label>
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
        <button type="button" class="btn-logout" style="width:auto; padding:0.7rem 2.2rem; font-size:1.1rem;">
            <a href="{{ route('galeria.create') }}">Subir fotos</a>
        </button>
    @endif

    <div class="galeria">
        @forelse($fotos as $foto)
            <div class="foto">
                <img src="{{ asset('storage/' . $foto->ruta) }}" data-src="{{ asset('storage/' . $foto->ruta) }}">
            </div>
        @empty
            <p>No hay fotos para esta carrera.</p>
        @endforelse
    </div>

    <div id="lightbox" class="lightbox">
        <img id="lightbox-img" src="" alt="Imagen ampliada">
    </div>

    <script>
        document.querySelectorAll('.foto img').forEach(img => {
            img.addEventListener('click', function() {
                document.getElementById('lightbox-img').src = this.dataset.src;
                document.getElementById('lightbox').classList.add('active');
            });
        });

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
            document.getElementById('lightbox-img').src = '';
        }

        // Cierra el lightbox si se hace clic fuera de la imagen
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) closeLightbox();
        });
    </script>

    <form action="{{ route('inicio') }}" method="GET" style="display:inline;">
        <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem;">
            <span class="tooltip-text">Volver</span>
                Volver
        </button>
    </form>
</body>
</html>
