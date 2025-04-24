<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Usuario</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="shortcut icon" type="image/ico" href="{{ asset('faviconV2.png') }}">
    <style>
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

        input, select, button {
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
<div class="divlog">

    <h1>Crear Nuevo Usuario</h1>

    <form action="{{ route('auth.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required>
            @error('name') <span>{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="apellido1">Primer apellido:</label>
            <input type="text" name="apellido1" id="apellido1" required>
            @error('apellido1') <span>{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="apellido2">Segundo apellido:</label>
            <input type="text" name="apellido2" id="apellido2">
            @error('apellido2') <span>{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="dni">Dni:</label>
            <input type="text" name="dni" id="dni">
            @error('dni') <span>{{ $message }}</span> @enderror
        </div>
        
        <div class="form-group">
            <label for="localidad">Localidad:</label>
            <input type="text" name="localidad" id="localidad">
            @error('localidad') <span>{{ $message }}</span> @enderror
        </div>
        
        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" id="email" required>
            @error('email') <span>{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="number" name="telefono" id="telefono">
            @error('telefono') <span>{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="sexo">sexo:</label>
            <select name="sexo" id="sexo">
                <option value="Hombre">Hombre</option>
                <option value="Mujer">Mujer</option>
            </select>
            @error('sexo') <span>{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
            @error('fecha_nacimiento') <span>{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            @error('password') <span>{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <div>
            <button type="submit">Crear usuario</button>
        </div>
    </form>

</div>
</body>
</html>
