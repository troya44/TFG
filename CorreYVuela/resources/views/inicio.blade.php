<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
/* Para que el contenido quede encima */

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

    /* Menú desplegable personalizado */
    .custom-dropdown-container {
      position: relative;
      width: fit-content;
      margin: 2rem auto;
      text-align: center;
    }
    .dropdown-toggle {
      background-color: #ffb76b;
      color: #222;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      cursor: pointer;
      font-weight: bold;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      transition: background-color 0.3s ease;
    }
    .dropdown-toggle:hover {
      background-color: #ff9800;
      color: #fff;
    }
    .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 50%;
      transform: translateX(-50%);
      margin-top: 0.5rem;
      list-style: none;
      background: white;
      border-radius: 12px;
      padding: 0.5rem 0;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
      display: none;
      z-index: 999;
      width: 220px;
      animation: fadeDown 0.3s ease-in-out;
    }
    .dropdown-menu li {
      padding: 0.75rem 1rem;
      cursor: pointer;
      transition: background 0.2s;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .dropdown-menu li:hover {
      background-color: #ffecd2;
    }
    @keyframes fadeDown {
      from {
        opacity: 0;
        transform: translate(-50%, -10px);
      }
      to {
        opacity: 1;
        transform: translate(-50%, 0);
      }
    }

    /* Hacemos que el menú desplegable esté fijo y visible en todo momento */
    .fixed-dropdown {
      position: fixed;
      top: 50px; /* Ajusta este valor según la altura de tu navbar */
      left: 50%;
      transform: translateX(-50%);
      z-index: 1000;
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
    <div class="navbar-links">
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
    </div>
    </nav>
  </header>

  <!-- Menú desplegable de secciones fijado en pantalla -->
  <div class="custom-dropdown-container fixed-dropdown">
    <button class="dropdown-toggle" id="dropdownButton">
      <i class="fas fa-bars"></i> Ir a sección...
    </button>
    <ul class="dropdown-menu" id="dropdownMenu">
      <li data-target="inicio"><i class="fas fa-home"></i> Inicio</li>
      <li data-target="valores"><i class="fas fa-bullseye"></i> Valores y Visión</li>
      <li data-target="articulos"><i class="fas fa-newspaper"></i> Artículos</li>
      <li data-target="testimonios"><i class="fas fa-comments"></i> Testimonios</li>
      <li data-target="quienes"><i class="fas fa-users"></i> Quiénes somos</li>
      <li data-target="equipo"><i class="fas fa-people-group"></i> Nuestro equipo</li>
      <li data-target="eventos"><i class="fas fa-calendar-check"></i> Eventos</li>
      <li data-target="galeria"><i class="fas fa-camera-retro"></i> Galería</li>
      <li data-target="contacto"><i class="fas fa-envelope"></i> Contacto</li>
    </ul>
  </div>

  
  <main>
    <!-- HERO SECTION -->
    <section class="main-content animate-fadein" id="inicio">
      <h1>Bienvenidos a Corre Y Vuela</h1>
      <h3>Organización de eventos deportivos y espectáculos audiovisuales al aire libre</h3>
      <p style="font-size:1.15rem; max-width:700px; margin:auto; margin-bottom:1.5rem; color:#444;">
        En Corre Y Vuela, creemos que el deporte es mucho más que una competición: es una oportunidad para superarse, compartir experiencias y vivir emociones inolvidables. Nuestra misión es ofrecerte eventos únicos que combinan el espíritu deportivo con la magia de la tecnología y el espectáculo.
      </p>
      <h3 style="color:#bfae9c;">"Tu mejor versión te está esperando en la línea de salida. ¿Estás listo para el reto?"</h3>
    </section>

    <!-- SECCIÓN: VALORES Y VISIÓN -->
    <section class="info-section animate-fadein" style="animation-delay: 0.1s;" id="valores">
      <h1>Nuestros Valores y Visión</h1>
      <ul style="margin-left: 1.5rem; margin-bottom: 1.2rem;">
        <li><b>Pasión por el deporte:</b> Fomentamos la actividad física y la vida saludable en todas las edades.</li>
        <li><b>Innovación:</b> Integramos tecnología audiovisual de última generación para crear experiencias memorables.</li>
        <li><b>Inclusividad:</b> Nuestros eventos están abiertos a todos, sin importar edad, condición física o experiencia previa.</li>
        <li><b>Compromiso social:</b> Apoyamos causas solidarias y fomentamos la integración a través del deporte.</li>
        <li><b>Excelencia organizativa:</b> Nos esforzamos por ofrecer la máxima calidad en cada detalle, desde la inscripción hasta la meta.</li>
      </ul>
      <p>Nuestra visión es ser un referente nacional en la organización de eventos deportivos innovadores, donde cada participante y espectador se lleve un recuerdo imborrable.</p>
    </section>

    <!-- SECCIÓN: ARTÍCULOS -->
    <section class="blog-section animate-fadein" style="animation-delay: 0.15s;" id="articulos">
      <h1 style="text-align:center; margin-bottom: 2rem;">Artículos destacados</h1>
      <div class="blog-grid">
        <!-- Artículo 1 -->
        <article class="blog-entry">
          <img src="{{ asset('Miguel.png') }}" alt="Historia de Superación">
          <div class="blog-entry-content">
            <h2>Historias de Superación: Corredor con Discapacidad</h2>
            <p class="excerpt">Corredor con discapacidad dando una lección de vida</p>
            <div class="full-content">
              <p>En la edición de la San Silvestre Olvereña del año pasado, conocimos a Miguel Ángel, un corredor con movilidad reducida que completó el recorrido con una prótesis especial. Su esfuerzo, perseverancia y pasión por el deporte inspiraron a todos los presentes. Miguel nos enseñó que no existen límites cuando hay determinación y apoyo, que con empeño y perseverancia todo se consigue. Su historia es un ejemplo de superación y motivación para toda la comunidad deportiva. Cuando Miguel Ángel cruzó la meta, muchos de los corredores y personas del público se emocionaron y juntos le rindieron un homenaje en forma de aplausos y buenas palabras.</p>
              <p>Todos los años, cuando anunciamos la fecha para el evento, Miguel Ángel es el primero en apuntarse y no perderse nada.</p>
              <p><b>¡Si Miguel Ángel puede, por qué no vas a poder tú!</b></p>
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
              <p>La historia de Corre Y Vuela comenzó en un pequeño pueblo de la Sierra de Cádiz, en Olvera. Un joven apasionado por el deporte y la tecnología decidió unir sus fuerzas para crear eventos únicos. Hoy, esa ilusión se ha convertido en una empresa referente en la organización de eventos deportivos con espectáculos audiovisuales. El creador se llama Guillermo Troya Albarrán y su pasión por el deporte y la tecnología lo llevó a crear una empresa que combina ambas disciplinas. Desde sus inicios, ha trabajado incansablemente para ofrecer eventos de calidad, donde los corredores puedan disfrutar de una experiencia única y emocionante, junto con sus acompañantes y todo el público que se acerque al lugar.</p>
            </div>
            <button class="blog-entry-link">Leer más</button>
          </div>
        </article>
        <!-- Artículo 3 -->
        <article class="blog-entry">
          <img src="{{ asset('reloj.jpg') }}" alt="Tras los Bastidores">
          <div class="blog-entry-content">
            <h2>Tras los Bastidores</h2>
            <p class="excerpt">Un vistazo a las 12-14 horas de trabajo intenso que hacen posible cada evento...</p>
            <div class="full-content">
              <p>Detrás de cada evento de Corre Y Vuela existe un equipo multidisciplinario que dedica entre 12 y 14 horas de trabajo intenso y coordinado. La jornada comienza mucho antes de la llegada de los corredores, con la preparación minuciosa de la logística: montaje de carpas, señalización de rutas, instalación de puntos de hidratación y coordinación con los equipos de seguridad y primeros auxilios. Paralelamente, se supervisa la tecnología audiovisual, pruebas de sonido, pantallas y cronometraje, asegurando que cada detalle esté listo para el espectáculo.</p>
              <p>Durante el evento, el equipo permanece atento a cualquier imprevisto, gestionando desde la entrega de dorsales hasta la atención de los participantes y el público. La comunicación constante entre las distintas áreas es clave para que todo fluya sin contratiempos, permitiendo que corredores y espectadores vivan una experiencia memorable desde el inicio hasta la meta. Al finalizar la jornada, aún queda desmontar, limpiar y evaluar cada aspecto, cerrando un ciclo de esfuerzo y dedicación que muchas veces pasa desapercibido, pero es fundamental para el éxito de cada carrera.</p>
            </div>
            <button class="blog-entry-link">Leer más</button>
          </div>
        </article>
      </div>
    </section>

    <!-- SECCIÓN: TESTIMONIOS -->
    <section class="info-section animate-fadein" style="animation-delay: 0.18s;" id="testimonios">
      <h1>Testimonios de Participantes</h1>
      <blockquote style="font-style:italic; background:#f3f3f3; border-left:5px solid #ffb76b; margin:1.5rem 0; padding:1rem 1.5rem;">
        "Participar en Corre Y Vuela fue una de las mejores experiencias deportivas de mi vida. La organización, el ambiente y el espectáculo audiovisual hicieron que me sintiera como un auténtico protagonista."
        <br>
        <span style="font-weight:bold; color:#8d7964;">- Laura G., corredora</span>
      </blockquote>
      <blockquote style="font-style:italic; background:#f3f3f3; border-left:5px solid #ffb76b; margin:1.5rem 0; padding:1rem 1.5rem;">
        "Nunca había visto una carrera tan bien organizada y con tanta energía positiva. ¡Repetiré sin duda!"
        <br>
        <span style="font-weight:bold; color:#8d7964;">- Manuel R., espectador</span>
      </blockquote>
    </section>

    <!-- SECCIÓN: QUIÉNES SOMOS -->
    <section class="info-section animate-fadein" style="animation-delay: 0.2s;" id="quienes">
      <h1>¿Quiénes somos?</h1>
      <p>Corre Y Vuela es una empresa dedicada a la organización de eventos deportivos con espectáculos audiovisuales. Nos especializamos en crear experiencias únicas que combinan deporte, entretenimiento y tecnología.</p>
      <p>Nuestro objetivo es ofrecer eventos inolvidables que no solo resalten el talento deportivo, sino que también cautiven a la audiencia con impresionantes espectáculos audiovisuales al aire libre.</p>
      <p>Con un equipo de profesionales apasionados por el deporte y la tecnología, nos esforzamos por superar las expectativas de nuestros clientes y participantes en cada evento que organizamos.</p>
      <p>¡Únete a nosotros y vive la emoción de Corre Y Vuela!</p>
      <img src="{{ asset('LogoCorreYVuela.png') }}" alt="Logo Corre Y Vuela" class="logo" style="margin-top: 1.5rem;">
    </section>

    <!-- SECCIÓN: NUESTRO EQUIPO -->
    <section class="info-section animate-fadein" style="animation-delay: 0.3s;" id="equipo">
      <h1>Nuestro Equipo</h1>
      <p>El éxito de Corre Y Vuela se debe al compromiso y profesionalidad de nuestro equipo, formado por especialistas en organización de eventos, técnicos audiovisuales, entrenadores deportivos, voluntarios y colaboradores. Juntos, trabajamos para que cada carrera sea un acontecimiento seguro, divertido y emocionante para todos.</p>
    </section>

    <!-- SECCIÓN: NUESTROS EVENTOS -->
    <section class="info-section animate-fadein" style="animation-delay: 0.4s;" id="eventos">
      <h1>Nuestros eventos</h1>
      <p>En Corre Y Vuela, ofrecemos lo mejor de nosotros para nuestros corredores y público.</p>
      <p>Ofrecemos una amplia gama de servicios, incluyendo:</p>
      <ul style="margin-left: 1.5rem; margin-bottom: 1.2rem;">
        <li>Organización de carreras y maratones</li>
        <li>Espectáculos de luces y sonido</li>
        <li>Actividades deportivas para todas las edades</li>
        <li>Servicio de ocio en nuestras carpas para el público que no quiere participar</li>
        <li>Música en directo y retransmisión de la carrera</li>
        <li>Premios, sorteos y sorpresas para participantes y asistentes</li>
      </ul>
      <p>¿A qué estás esperando para apuntarte? Descubre nuestros próximos eventos y vive la experiencia.</p>
      <div style="text-align:center; margin-top:1.2rem;">
        <a href="{{ route('pruebas') }}">
          <button type="button" class="btn-logout" style="width:auto; padding:0.7rem 2.2rem; font-size:1.1rem;">
            Ver pruebas
          </button>
        </a>
      </div>
    </section>

    <!-- SECCIÓN: GALERIA DE FOTOS -->
    <section class="info-section animate-fadein" style="animation-delay: 0.3s;" id="galeria">
      <h1>Galeria de fotos</h1>
      <p>
        Aqui podrás ver todas las fotos de los eventos que hemos realizado. Puedes verlas y descargarlas para tener un recuerdo de esos momentos tan especiales.
        <br>
        <a href="{{ route('galeria.index') }}">
          <button type="button" class="btn-logout" style="width:auto; padding:0.7rem 2.2rem; font-size:1.1rem;">
            Ver galería
          </button>
        </a>
      </p>
    </section>

    <!-- SECCIÓN: CONTACTO -->
    <section class="info-section animate-fadein" style="animation-delay: 0.5s;" id="contacto">
      <h1>Contacto</h1>
      <p>¿Tienes dudas, sugerencias o quieres colaborar con nosotros? Escríbenos y te responderemos lo antes posible.</p>
      <ul style="margin-left: 1.5rem;">
        <li>Email: <a href="mailto:correyvuela.contacto@gmail.com">correyvuela.contacto@gmail.com</a></li>
        <li>Teléfono: +34 642 777 183</li>
        <li>Redes sociales: <a href="https://www.instagram.com/correyvuela_eventos/">Instagram</a></li>
      </ul>
    </section>
  </main>

  <footer style="text-align:center; margin-top:2rem; color:#888; font-size:0.95rem;">
    &copy; {{ date('Y') }} Corre Y Vuela. Todos los derechos reservados.
  </footer>

  <!-- Script para desplegar contenido completo en artículos -->
  <script>
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

  <!-- Script para el menú desplegable: scroll centrado -->
  <script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', () => {
      dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    window.addEventListener('click', function (e) {
      if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.style.display = 'none';
      }
    });

    dropdownMenu.querySelectorAll('li').forEach(item => {
      item.addEventListener('click', function () {
        const section = document.getElementById(this.getAttribute('data-target'));
        if (section) {
          section.scrollIntoView({
            behavior: 'smooth',
            block: 'center' // La sección se centrará en la pantalla
          });
        }
        dropdownMenu.style.display = 'none';
      });
    });
  </script>
</body>
</html>
