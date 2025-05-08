<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Inscritos</title>
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
                    Cerrar sesión
                    <span class="tooltip-text">Cerrar sesión</span>
                </button>
            </form>
        </nav>
    </header>

    <div class="main-content animate-fadein">
        <h2 style="text-align:center; margin-bottom:1.2rem; color:#8d7964; letter-spacing:1px;">
            <span style="font-size:1.7rem; vertical-align:middle;">&#128101;</span>
            Listado de inscritos en <span style="color:#bfae9c;">{{ $carrera->nombre }}</span>
        </h2>

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
                                            <td>{{ $inscrito->pivot->modalidad ?? 'Sin modalidad'}}</td>
                                            <td>{{ $inscrito->pivot->categoria ?? 'Sin categoría' }}</td>
                                            <td>
                                                @if(Auth::id() === $inscrito->id)
                                                    <a href="{{ route('inscripcion.edit', [$carrera->id, $inscrito->id]) }}" class="btn-admin tooltip-btn">
                                                        Editar Usuario
                                                    </a>
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
                                <li style="background:rgba(250,247,240,0.93); margin-bottom:0.7rem; border-radius:10px; padding:0.8rem 1rem; box-shadow:0 2px 8px rgba(200,180,150,0.07); display:flex; align-items:center;">
                                    <span style="font-size:1.3rem; margin-right:0.7rem;">&#128100;</span>
                                    <strong>
                                        {{ $inscrito->name }} {{ $inscrito->apellido1 }} {{ $inscrito->apellido2 }}
                                        <span style="color:#bfae9c; font-size:0.95em; margin-left:1em;">
                                            ({{ $inscrito->pivot->categoria ?? 'Sin categoría' }})
                                            @if(Auth::id() === $inscrito->id)
                                                <a href="{{ route('inscripcion.edit', [$carrera->id, $inscrito->id]) }}" class="btn-admin tooltip-btn" style="margin-left:1em;">
                                                    Editar Usuario
                                                </a>
                                            @endif
                                        </span>
                                    </strong>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endif
            @endforeach
        @endif

        <form action="{{ route('pruebas') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem; position:relative;">
                <span class="tooltip-text">Volver</span>
                Volver
            </button>
        </form>
    </div>
</body>
</html>
