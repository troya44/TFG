<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
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
                    @else
                        Bienvenido, {{ Auth::user()->name }}
                    @endif
                @endauth
            </p>
            <form action="{{ route('logout') }}" method="POST" class="logout">
                @csrf
                <button type="submit" class="btn-logout">
                    <span class="tooltip">Cerrar sesión</span>
                </button>
            </form>
        </nav>
    </header>

    <main>
        <section class="main-content animate-fadein">
            <h1>Bienvenidos a Corre Y Vuela</h1>
            <h3>La mejor empresa de eventos deportivos con espectáculos audiovisuales</h3>
        </section>

        <section class="info-section animate-fadein" style="animation-delay: 0.2s;">
            <h1>¿Quiénes somos?</h1>
            <p>Corre y Vuela es una empresa dedicada a la organización de eventos deportivos con espectáculos audiovisuales. Nos especializamos en crear experiencias únicas que combinan deporte, entretenimiento y tecnología.</p>
            <p>Nuestro objetivo es ofrecer eventos inolvidables que no solo resalten el talento deportivo, sino que también cautiven a la audiencia con impresionantes espectáculos audiovisuales al aire libre.</p>
            <p>Con un equipo de profesionales apasionados por el deporte y la tecnología, nos esforzamos por superar las expectativas de nuestros clientes y participantes en cada evento que organizamos.</p>
            <p>¡Únete a nosotros y vive la emoción de Corre y Vuela!</p>
            <img src="{{ asset('LogoCorreYVuela.png') }}" alt="Logo Corre Y Vuela" class="logo" style="margin-top: 1.5rem;">
        </section>

        <section class="info-section animate-fadein" style="animation-delay: 0.4s;">
            <h1>Nuestros eventos</h1>
            <p>En Corre y Vuela, ofrecemos lo mejor de nosotros para nuestros corredores y público.</p>
            <p>Ofrecemos una amplia gama de servicios, incluyendo:</p>
            <ul style="margin-left: 1.5rem; margin-bottom: 1.2rem;">
                <li>Organización de carreras y maratones</li>
                <li>Espectáculos de luces y sonido</li>
                <li>Actividades deportivas para todas las edades</li>
                <li>Servicio de ocio en nuestras carpas para el público que no quiere participar</li>
                <li>Música en directo, junto a la retransmisión de la carrera</li>
            </ul>
            <p>¿A qué estás esperando para apuntarte?</p>
            <p>Aquí podrás ver y apuntarte a nuestros próximos eventos</p>
            <div style="text-align:center; margin-top:1.2rem;">
                <a href="{{ route('pruebas') }}">
                    <button type="button" class="btn-logout" style="width:auto; padding:0.7rem 2.2rem; font-size:1.1rem;">
                        Ver pruebas
                    </button>
                </a>
            </div>
        </section>
    </main>
</body>
</html>
