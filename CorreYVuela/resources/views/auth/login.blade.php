<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="shortcut icon" type="image/ico" href="{{ asset('faviconV2.png') }}">
    <style>
        /* Estilo general */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Verdana, sans-serif;
            margin: 0;
            background-color: #000; /* Fallback para navegadores sin soporte de imágenes */
        }

        /* Slideshow container */
        .slideshow-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Colocar detrás del contenido principal */
            overflow: hidden;
        }

        .mySlides {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0; /* Ocultar por defecto */
            transition: opacity 1.5s ease-in-out; /* Transición suave */
        }

        .mySlides img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ajustar las imágenes al tamaño del contenedor */
        }

        .active {
            opacity: 1; /* Mostrar solo la diapositiva activa */
        }

        /* Contenido principal */
        .divlog {
            position: relative;
            z-index: 1; /* Colocar sobre el fondo */
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semitransparente */
            padding: 20px;
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
        }

        .logo {
            display: block;
            margin: auto;
            width: 150px; /* Ajusta el tamaño del logo */
        }

        h1 {
            text-align: center;
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
            background-color: #0198f7; /* Color del botón */
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #017dc6; /* Color del botón al pasar el cursor */
        }

        p {
            text-align: center;
        }

        a {
            color: #0198f7; /* Color del enlace */
        }
    </style>
</head>
<body>

<!-- Contenido principal -->
<div class="divlog">
    <img src="{{ asset('LogoCorreYVuela.png') }}" alt="Logo" class="logo">

    <h1>Iniciar sesión</h1>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <!-- Campo de correo electrónico -->
        <div class="form-group">
            <label for="email">Introduzca su Dni:</label>
            <input type="text" name="dni" id="dni" value="{{ old('email') }}" required autofocus placeholder="Introduce su Dni"
            >
            @error('dni')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Campo de contraseña -->
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required placeholder="Introduce tu contraseña"
            >
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

</body>
</html>
