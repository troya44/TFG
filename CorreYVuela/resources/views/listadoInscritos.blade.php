<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Inscritos</title>
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        /* Estilos generales */
        .carrera-cartel {
            display: block;
            margin: 2rem auto 1.5rem auto;
            max-width: 450px;
            max-height: 450px;
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            object-fit: contain;
        }

        .main-content {
            padding: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .tabla-inscritos {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }

        .tabla-inscritos th, .tabla-inscritos td {
            padding: 1rem;
            text-align: center;
            border: 1px solid #e0e0e0;
        }

        .tabla-inscritos th {
            background-color: #bfae9c;
            color: white;
        }

        /* Estilo para botones */
        .btn-admin {
            padding: 0.6rem 1.2rem;
            background-color: #8d7964;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn-admin:hover {
            background-color: #bfae9c;
        }

        /* Estilo para la lista de inscritos cuando no es administrador */
        .inscrito-item {
            background: rgba(250, 247, 240, 0.93);
            margin-bottom: 0.7rem;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            box-shadow: 0 2px 8px rgba(200, 180, 150, 0.07);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .inscrito-item strong {
            font-size: 1.1rem;
        }

        .inscrito-item span {
            font-size: 0.9rem;
            color: #bfae9c;
            margin-left: 1em;
        }

        /* Estilo para el botón de "Editar Usuario" */
        .btn-edit {
            background-color: #8d7964;
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 5px;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #bfae9c;
        }

        .btn-edit i {
            margin-right: 0.5rem;
        }

        /* Ajuste de icono y espaciado */
        .inscrito-item .btn-container {
            display: flex;
            align-items: center;
        }

        .inscrito-item .btn-container a {
            margin-left: 1rem;
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
                    Cerrar sesión
                </button>
            </form>
        </nav>
    </header>

    <div class="main-content animate-fadein">
        <h2 style="text-align:center; margin-bottom:1.2rem; color:#8d7964; letter-spacing:1px;">
            <span style="font-size:1.7rem; vertical-align:middle;">&#128101;</span>
            Listado de inscritos en <span style="color:#bfae9c;">{{ $carrera->nombre }}</span>
        </h2>
        @if($carrera->cartel)
            <img src="{{ asset('storage/' . $carrera->cartel) }}" alt="Cartel de la carrera" class="carrera-cartel">
        @endif
        @php
            $modalidades = ['Senderismo', 'Ciclismo', 'Trail'];
            $inscritosPorModalidad = $inscritos->groupBy(function($inscrito) {
                return $inscrito->pivot->modalidad ?? 'Sin modalidad';
            });
        @endphp

        @if ($inscritos->isEmpty())
            <p style="text-align:center; font-size:1.1rem; color:#bfae9c;">No hay inscritos en esta carrera.</p>
        @else
            @foreach($modalidades as $modalidad)
                <h2 style="color:#8d7964; margin-top:2rem;">
                    <span style="font-size:1.5rem; vertical-align:middle;">&#128692;</span>
                    Modalidad: <span style="color:#bfae9c;">{{ $modalidad }}</span>
                </h2>
                @php
                    $inscritosEnModalidad = $inscritosPorModalidad->get($modalidad, collect());
                @endphp

                @if($inscritosEnModalidad->isEmpty())
                    <p style="text-align:center; font-size:1.1rem; color:#bfae9c;">No hay inscritos en esta modalidad.</p>
                @else
                    @if (Auth::user()->admin == 1)
                        <div style="overflow-x:auto;">
                            <table class="tabla-inscritos">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido 1</th>
                                        <th>Apellido 2</th>
                                        <th>DNI</th>
                                        <th>Localidad</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>Email</th>
                                        <th>Fecha Inscripción</th>
                                        <th>Modalidad</th>
                                        <th>Categoría</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inscritosEnModalidad as $inscrito)
                                        <tr>
                                            <td>{{ $inscrito->name }}</td>
                                            <td>{{ $inscrito->apellido1 }}</td>
                                            <td>{{ $inscrito->apellido2 }}</td>
                                            <td>{{ $inscrito->dni }}</td>
                                            <td>{{ $inscrito->localidad }}</td>
                                            <td>{{ $inscrito->fecha_nacimiento }}</td>
                                            <td>{{ $inscrito->email }}</td>
                                            <td>{{ \Carbon\Carbon::parse($inscrito->created_at)->format('d/m/Y H:i') }}</td>
                                            <td>{{ $inscrito->pivot->modalidad ?? 'Sin modalidad' }}</td>
                                            <td>{{ $inscrito->pivot->categoria ?? 'Sin categoría' }}</td>
                                            <td>
                                                @if(Auth::id() === $inscrito->id)
                                                    <div class="btn-container">
                                                        <a href="{{ route('inscripcion.edit', [$carrera->id, $inscrito->id]) }}" class="btn-edit">
                                                            <i class="fa fa-pencil-alt"></i> Editar Usuario
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <ul style="list-style:none; padding-left:0;">
                            @foreach($inscritosEnModalidad as $inscrito)
                                <li class="inscrito-item">
                                    <strong>
                                        {{ $inscrito->name }} {{ $inscrito->apellido1 }} {{ $inscrito->apellido2 }}
                                        <span style="color:#bfae9c; font-size:0.95em; margin-left:1em;">
                                            ({{ $inscrito->pivot->categoria ?? 'Sin categoría' }})
                                        </span>
                                    </strong>
                                    @if(Auth::id() === $inscrito->id)
                                        <div class="btn-container">
                                            <a href="{{ route('inscripcion.edit', [$carrera->id, $inscrito->id]) }}" class="btn-edit">
                                                <i class="fa fa-pencil-alt"></i> Editar Usuario
                                            </a>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endif
            @endforeach
        @endif

        <form action="{{ route('pruebas') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn-admin" style="margin-top:1rem;">
                Volver
            </button>
        </form>
    </div>
</body>
</html>
