<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $esEmpresa ? 'Nuevo usuario registrado' : '¡Bienvenido a Corre y Vuela!' }}</title>
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <style>
        body {
            background: #f4f6f8;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(180,150,120,0.10);
            padding: 0;
            overflow: hidden;
            animation: fadeIn 1s;
        }
        .email-header {
            background: linear-gradient(90deg, #bfae9c 50%, #8d7964 100%);
            padding: 24px 0 12px 0;
            text-align: center;
        }
        .email-header img {
            max-width: 160px;
            margin-bottom: 6px;
            animation: bounce 2s infinite;
        }
        .email-header h1 {
            color: #fff;
            font-size: 2rem;
            margin: 0;
            letter-spacing: 2px;
        }
        .email-content {
            padding: 32px 28px 24px 28px;
        }
        h2 {
            color: #8d7964;
            font-size: 1.5rem;
            margin-top: 0;
            margin-bottom: 12px;
        }
        ul {
            padding: 0 0 0 10px;
            margin: 18px 0 18px 0;
        }
        ul li {
            background: #f8f5f0;
            margin-bottom: 8px;
            border-radius: 6px;
            padding: 8px 12px;
            color: #4b3d2d;
            font-size: 15px;
            box-shadow: 0 1px 3px rgba(180,150,120,0.04);
            animation: slideIn 0.7s;
        }
        p {
            color: #3d3326;
            font-size: 16px;
            line-height: 1.6;
        }
        .highlight {
            color: #bfae9c;
            font-weight: 600;
        }
        .cta {
            display: inline-block;
            background: #8d7964;
            color: #fff;
            padding: 12px 32px;
            border-radius: 8px;
            margin-top: 18px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 2px 8px rgba(180,150,120,0.08);
            transition: background 0.3s;
        }
        .cta:hover {
            background: #bfae9c;
        }
        .footer {
            background: #f8f5f0;
            color: #8d7964;
            text-align: center;
            padding: 18px 0 10px 0;
            font-size: 13px;
            border-top: 1px solid #eee;
        }
        /* Animations */
        @keyframes bounce {
            0%,100% { transform: translateY(0);}
            50% { transform: translateY(-8px);}
        }
        @keyframes fadeIn {
            from { opacity: 0;}
            to { opacity: 1;}
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-30px);}
            to { opacity: 1; transform: translateX(0);}
        }
        /* Responsive */
        @media (max-width: 700px) {
            .email-container { max-width: 98vw; }
            .email-content { padding: 18px 8vw 18px 8vw;}
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Corre y Vuela</h1>
        </div>
        <div class="email-content">
            @if($esEmpresa)
                <h2>👤 Nuevo usuario registrado</h2>
                <p>Se ha registrado un nuevo usuario en la plataforma:</p>
                <ul>
                    <li><strong>Nombre:</strong> {{ $usuario->name }} {{ $usuario->apellido1 }} {{ $usuario->apellido2 }}</li>
                    <li><strong>Email:</strong> {{ $usuario->email }}</li>
                    <li><strong>Teléfono:</strong> {{ $usuario->telefono }}</li>
                    <li><strong>DNI:</strong> {{ $usuario->dni }}</li>
                    <li><strong>Sexo:</strong> {{ $usuario->sexo }}</li>
                    <li><strong>Fecha de nacimiento:</strong> {{ $usuario->fecha_nacimiento }}</li>
                    <li><strong>Localidad:</strong> {{ $usuario->localidad }}</li>
                </ul>
                <p style="margin-top:24px;">Consulta la plataforma para más detalles.</p>
                <a href="{{ url('/') }}" class="cta">Ir al inicio</a>
            @else
                <h2>¡Bienvenido/a a <span class="highlight">Corre y Vuela</span>!</h2>
                <p>
                    Estimado/a <strong>{{ $usuario->name }}</strong>,
                </p>
                <p>
                    Te damos la bienvenida a la plataforma de <span class="highlight">Corre y Vuela</span>.<br>
                    Ya puedes inscribirte en nuestras carreras y disfrutar del deporte.
                </p>
                <p>
                    Si tienes cualquier duda, contacta con nosotros respondiendo a este correo.<br>
                    <strong>¡Gracias por registrarte!</strong>
                </p>
                <a href="{{ url('/') }}" class="cta">Ir al inicio</a>
                <p style="margin-top: 40px;">
                    Atentamente,<br>
                    El equipo de Corre y Vuela
                </p>
            @endif
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Corre y Vuela. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
