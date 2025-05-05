<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        /* Estilos para la sección de artículos */
        .blog-section {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 2rem;
            background: #f9f9f9;
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.10);
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .blog-entry {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s;
        }

        .blog-entry:hover {
            transform: translateY(-4px) scale(1.02);
        }

        .blog-entry img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .blog-entry-content {
            padding: 22px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-entry h2 {
            margin-top: 0;
            font-size: 1.35rem;
            color: #2e2e2e;
        }

        .blog-entry .excerpt {
            margin-bottom: 1rem;
            color: #444;
        }

        .blog-entry .full-content {
            display: none;
            color: #555;
            margin-bottom: 1rem;
        }

        .blog-entry .blog-entry-link {
            background: #ffb76b;
            color: #222;
            padding: 8px 18px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: background 0.2s;
        }

        .blog-entry .blog-entry-link:hover {
            background: #ff9800;
            color: #fff;
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
            <h3>Empresa de eventos deportivos con espectáculos audiovisuales al aire libre</h3>
            <h3>"Tu mejor versión te está esperando en la línea de salida. ¿Estás listo para el reto?"</h3>
        </section>




        <section class="blog-section animate-fadein" style="animation-delay: 0.15s;">
            <h1 style="text-align:center; margin-bottom: 2rem;">Artículos destacados</h1>
            <div class="blog-grid">
                <!-- Artículo 1 -->
                <article class="blog-entry">
                    <img src="{{ asset('Miguel.png') }}" alt="Historia de Superación">
                    <div class="blog-entry-content">
                        <h2>Historias de Superación: Corredor con Discapacidad</h2>
                        <p class="excerpt">Corredor con discapacidad dando una lección de vida</p>
                        <div class="full-content">
                            <p>En la edición de la San Silvestre Olvereña del año pasado, conocimos a Miguel Ángel, un
                                corredor con movilidad reducida que completó el recorrido con una prótesis especial. Su
                                esfuerzo, perseverancia y pasión por el deporte inspiraron a todos los presentes. Miguel
                                nos enseñó que no existen límites cuando hay determinación y apoyo, que con empeño y
                                perseverancia todo se consigue. Su historia es un
                                ejemplo de superación y motivación para toda la comunidad deportiva, de ahi que cuando
                                Miguel Angel cruzó la meta, muchos de los corredores y personas del publico se
                                emocionaron y juntos le rindieron un homenaje en forma de aplausos y buenas palabras.
                            </p>
                            <p>Todos los años, cuando anunciamos la fecha para el evento, Miguel Angel es el primero en
                                apuntarse y no perderse nada.</p>
                            <p><b>¡Si Miguel Angel puede, porque no vas a poder tú!</b></p>
                        </div>
                        <button class="blog-entry-link">Leer más</button>
                    </div>
                </article>
                <!-- Artículo 2 -->
                <article class="blog-entry">
                    <img src="{{ asset('work-1162083_640.jpg') }}" alt="Nacimiento de un Sueño">
                    <div class="blog-entry-content">
                        <h2>El Nacimiento de un Sueño</h2>
                        <p class="excerpt">El momento en el que nace Corre Y Vuela</p>
                        <div class="full-content">
                            <p>La historia de Corre Y Vuela comenzó en un pequeño pueblo de la Sierra de Cádiz, en
                                Olvera. Un joven apasionado por el deporte y la tecnología decidió unir sus fuerzas para
                                crear eventos únicos. Hoy, esa ilusión se ha convertido en una empresa referente en la
                                organización de eventos deportivos con espectáculos audiovisuales.
                                El creador se llama Guillermo Troya Albarrán y su pasión por el deporte y la tecnología
                                lo llevó a crear una empresa que combina ambas disciplinas. Desde sus inicios, ha
                                trabajado incansablemente para ofrecer eventos de calidad, donde los corredores puedan
                                disfrutar de una experiencia única y emocionante, junto con sus acompañantes y todo el
                                publico que se acerque al lugar.</p>
                            </p>
                        </div>
                        <button class="blog-entry-link">Leer más</button>
                    </div>
                </article>
                <!-- Artículo 3 -->
                <article class="blog-entry">
                    <img src="{{ asset('reloj.jpg') }}" alt="Tras los Bastidores">
                    <div class="blog-entry-content">
                        <h2>Tras los Bastidores</h2>
                        <p class="excerpt">Un vistazo a las 12-14 horas de trabajo intenso que hacen posible cada
                            evento...</p>
                        <div class="full-content">
                            <p>Detrás de cada evento de Corre Y Vuela existe un equipo multidisciplinario que dedica
                                entre 12 y 14 horas de trabajo intenso y coordinado. La jornada comienza mucho antes de
                                la llegada de los corredores, con la preparación minuciosa de la logística: montaje de
                                carpas, señalización de rutas, instalación de puntos de hidratación y coordinación con
                                los equipos de seguridad y primeros auxilios. Paralelamente, se supervisa la tecnología
                                audiovisual, pruebas de sonido, pantallas y cronometraje, asegurando que cada detalle
                                esté listo para el espectáculo.
                            </p>
                            <p>
                                Durante el evento, el equipo permanece atento a cualquier imprevisto, gestionando desde
                                la entrega de dorsales hasta la atención de los participantes y el público. La
                                comunicación constante entre las distintas áreas es clave para que todo fluya sin
                                contratiempos, permitiendo que corredores y espectadores vivan una experiencia memorable
                                desde el inicio hasta la meta. Al finalizar la jornada, aún queda desmontar, limpiar y
                                evaluar cada aspecto, cerrando un ciclo de esfuerzo y dedicación que muchas veces pasa
                                desapercibido, pero es fundamental para el éxito de cada carrera.

                            </p>
                        </div>
                        <button class="blog-entry-link">Leer más</button>
                    </div>
                </article>
            </div>
        </section>
        <section class="info-section animate-fadein" style="animation-delay: 0.2s;">
            <h1>¿Quiénes somos?</h1>
            <p>Corre y Vuela es una empresa dedicada a la organización de eventos deportivos con espectáculos
                audiovisuales. Nos especializamos en crear experiencias únicas que combinan deporte, entretenimiento y
                tecnología.</p>
            <p>Nuestro objetivo es ofrecer eventos inolvidables que no solo resalten el talento deportivo, sino que
                también cautiven a la audiencia con impresionantes espectáculos audiovisuales al aire libre.</p>
            <p>Con un equipo de profesionales apasionados por el deporte y la tecnología, nos esforzamos por superar las
                expectativas de nuestros clientes y participantes en cada evento que organizamos.</p>
            <p>¡Únete a nosotros y vive la emoción de Corre y Vuela!</p>
            <img src="{{ asset('LogoCorreYVuela.png') }}" alt="Logo Corre Y Vuela" class="logo"
                style="margin-top: 1.5rem;">
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
                    <button type="button" class="btn-logout"
                        style="width:auto; padding:0.7rem 2.2rem; font-size:1.1rem;">
                        Ver pruebas
                    </button>
                </a>
            </div>
        </section>
    </main>
    <script>
        //función para desplegar y ocultar parte del texto de los articulos
        document.querySelectorAll('.blog-entry-link').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const content = this.parentElement.querySelector('.full-content');
                if (content.style.display === 'block') {
                    content.style.display = 'none';
                    this.textContent = 'Leer más';
                } else {
                    content.style.display = 'block';
                    this.textContent = 'Leer menos';
                }
            });
        });
    </script>
</body>

</html>