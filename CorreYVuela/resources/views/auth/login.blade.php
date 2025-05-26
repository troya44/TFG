<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Verdana, sans-serif;
            min-height: 100vh;
            min-width: 100vw;
            margin: 0;
            background: #000;
            overflow: hidden;
            position: relative;
        }

        /* Carrusel de fondo */
        .slideshow-container {
            position: fixed;
            top: 0; left: 0;
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

        /* Centrado absoluto del formulario */
        .center-container {
            position: fixed;
            left: 0; top: 0;
            width: 100vw; height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }
        .divlog {
            background-color: rgba(255, 255, 255, 0.93);
            padding: 30px 30px 20px 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0,0,0,0.25);
            max-width: 400px;
            width: 100%;
        }
        .logo {
            display: block;
            margin: 0 auto 15px auto;
            width: 130px;
        }
        h1 {
            text-align: center;
            margin-bottom: 18px;
        }
        form {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #0198f7;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }
        button:hover {
            background-color: #017dc6;
            transform: scale(1.03);
        }
        p {
            text-align: center;
        }
        a {
            color: #0198f7;
        }
        /* Responsive */
        @media (max-width: 600px) {
            .divlog {
                max-width: 95vw;
                padding: 18px 5vw;
            }
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

<div class="center-container">
    <div class="divlog">
        <img src="{{ asset('LogoCorreYVuela.png') }}" alt="Logo" class="logo">
        <h1>Iniciar sesión</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Campo de DNI -->
            <div class="form-group">
                <label for="dni">Introduzca su Dni:</label>
                <input type="text" name="dni" id="dni" value="{{ old('dni') }}" required autofocus placeholder="Introduce su Dni">
                @error('dni')
                <span style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <!-- Campo de contraseña -->
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required placeholder="Introduce tu contraseña">
                @error('password')
                <span style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <!-- Botón de envío -->
            <div class="form-group">
                <button type="submit">Iniciar sesión</button>
            </div>
        </form>
        <!-- Enlace para registro -->
        <p>¿No tienes una cuenta?
            <a href="{{ route('register') }}">Regístrate aquí</a></p>
    </div>
</div>

<!-- Carrusel JS -->
<script>
    let slideIndex = 0;
    const slides = document.querySelectorAll('.mySlides');
    function showSlides() {
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
        });
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex-1].classList.add('active');
        setTimeout(showSlides, 8000); // Cambia cada 4 segundos
    }
    if (slides.length > 1) {
        setTimeout(showSlides, 8000);
    }
</script>

</body>
</html>
