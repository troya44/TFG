<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar inscripción</title>
    <link rel="shortcut icon" href="{{ asset('LogoCorreYVuela.png') }}" type="image/png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Editar inscripción en {{ $carrera->nombre }}</h2>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario de edición --}}
    <form action="{{ route('inscripcion.update', [$carrera->id, $usuario->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required>
        </div>
        <div>
            <label>Primer Apellido</label>
            <input type="text" name="apellido1" value="{{ old('apellido1', $usuario->apellido1) }}" required>
        </div>
        <div>
            <label>Segundo Apellido</label>
            <input type="text" name="apellido2" value="{{ old('apellido2', $usuario->apellido2) }}">
        </div>
        <div>
            <label>DNI</label>
            <input type="text" name="dni" value="{{ old('dni', $usuario->dni) }}" required>
        </div>
        <div>
            <label>Localidad</label>
            <input type="text" name="localidad" value="{{ old('localidad', $usuario->localidad) }}" required>
        </div>
        <div>
            <label>Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento) }}" required>
        </div>
        <div>
            <label for="modalidad">Modalidad:</label>
            <select id="modalidad" name="modalidad" required>
                <option value="" disabled {{ old('modalidad', $inscripcion->pivot->modalidad ?? '') == '' ? 'selected' : '' }}>Selecciona la modalidad</option>
                <option value="Senderismo" {{ old('modalidad', $inscripcion->pivot->modalidad ?? '') == 'Senderismo' ? 'selected' : '' }}>Senderismo</option>
                <option value="Ciclismo" {{ old('modalidad', $inscripcion->pivot->modalidad ?? '') == 'Ciclismo' ? 'selected' : '' }}>Ciclismo</option>
                <option value="Trail" {{ old('modalidad', $inscripcion->pivot->modalidad ?? '') == 'Trail' ? 'selected' : '' }}>Trail</option>
            </select>
        </div>
        <div>
            <label>Categoría:</label>
            <span>{{ old('categoria', $inscripcion->pivot->categoria ?? 'Sin categoría') }}</span>
            <input type="hidden" name="categoria" value="{{ old('categoria', $inscripcion->pivot->categoria ?? 'Sin categoría') }}">
        </div>
        <button type="submit" class="btn-admin">Guardar Cambios</button>
    </form>

    {{-- Formulario para borrar inscripción --}}
    <form action="{{ route('inscripcion.destroy', [$carrera->id, $usuario->id]) }}" method="POST" style="margin-top: 1rem;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-admin" style="background-color: #c0392b;"
            onclick="return confirm('¿Seguro que quieres borrar tu inscripción?');">
            Borrar Inscripción
        </button>
    </form>
</div>
</body>
</html>
