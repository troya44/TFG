<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de contraseña</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
  display: flex;
  justify-content: center; /* Centra horizontalmente */
  align-items: center;     /* Centra verticalmente */
  height: 100vh;           /* Para que tome toda la altura visible */
  margin: 0;               /* Quitar margenes predeterminados */
  position: relative;      /* Para que el slideshow quede debajo */
  z-index: 1;              /* Para que esté encima del slideshow */
}

.main-content {
  z-index: 10;             /* Para que esté siempre encima del slideshow */
  background-color: rgba(255, 255, 255, 0.85); /* Fondo blanco semitransparente para legibilidad */
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 0 15px rgba(0,0,0,0.3);
}
        /* Carrusel de fondo */
        .slideshow-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
            overflow: hidden;
        }

        .mySlides {
            position: absolute;
            width: 100vw;
            height: 100vh;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .mySlides img {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
        }

        .mySlides.active {
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="slideshow-container">
        <div class="mySlides active">
            <img src="{{ asset('images/fotoCorriendo.jpg') }}" alt="Fondo 1">
        </div>
        <div class="mySlides">
            <img src="{{ asset('images/fotoBici1.jpg') }}" alt="Fondo 2">
        </div>
        <div class="mySlides">
            <img src="{{ asset('images/fotoSenderismo.webp') }}" alt="Fondo 3">
        </div>
    </div>

    <div class="main-content" style="max-width: 400px;">
    <h1 style="margin-bottom: 1.5rem;">Restablecer contraseña</h1>

    <form action="{{ route('password.update') }}" method="POST" autocomplete="off">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ request('email', $email ?? '') }}">

        <div class="form-group">
            <label for="password">Nueva contraseña:</label>
            <input
                type="password"
                name="password"
                id="password"
                required
                placeholder="Introduce tu nueva contraseña"
                autocomplete="new-password"
            >
            @error('password')
                <div style="color: #c0392b; font-size: 0.97em; margin-top: 0.3em;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar contraseña:</label>
            <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                required
                placeholder="Repite la nueva contraseña"
                autocomplete="new-password"
            >
        </div>

        <div class="form-group" style="margin-top: 1.2rem;">
            <button type="submit">
                Cambiar contraseña
            </button>
        </div>
    </form>

    <p style="margin-top: 2rem;">
        <a href="{{ route('login') }}">Volver al inicio de sesión</a>
    </p>
</div>



</body>

</html>