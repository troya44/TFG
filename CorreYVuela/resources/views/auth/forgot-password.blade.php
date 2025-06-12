<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de contraseña</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .main-content {
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.85);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

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
        <h1 style="margin-bottom: 1.5rem;">Recuperar contraseña</h1>

        @if (session('status'))
            <div
                style="background: #e2c27533; color: #2d3540; border-radius: 7px; padding: 0.8rem 1rem; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" autocomplete="off">
            @csrf

            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" id="email" required placeholder="Introduce tu correo"
                    value="{{ old('email') }}" autocomplete="email">
                @error('email')
                    <div style="color: #c0392b; font-size: 0.97em; margin-top: 0.3em;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="margin-top: 1.2rem;">
                <button type="submit">
                    Enviar enlace de recuperación
                </button>
            </div>
        </form>

        <p style="margin-top: 2rem;">
            <a href="{{ route('login') }}">Volver al inicio de sesión</a>
        </p>
    </div>




</body>

</html>