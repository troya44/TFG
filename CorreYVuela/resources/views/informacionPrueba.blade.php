<h1>{{ $carrera->nombre }}</h1>
<p>{{ $carrera->descripcion }}</p>
<p>Fecha: {{ $carrera->fecha }}</p>
<p>Hora: {{ $carrera->hora }}</p>
<p>Ubicación: {{ $carrera->lugar }}</p>
<p>Distancia: {{ $carrera->distancia }} Km</p>
<p>Estado: {{ $carrera->estado }}</p>

<!-- Botón para ver listado de inscritos -->
<form action="{{ route('listadoInscritos', $carrera->id) }}" method="GET" style="display:inline;">
    <button type="submit" class="btn-listado">
        Ver listado de inscritos
    </button>
</form>

<!-- Botón para inscribirse -->
<button type="button" class="btn-inscribirme" onclick="document.getElementById('form-inscripcion').style.display='block'">
    Inscribirme
</button>

<!-- Formulario de inscripción oculto por defecto -->
<div id="form-inscripcion" style="display:none; margin-top:20px;">
    <form action="{{ route('inscribirse', $carrera->id) }}" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ Auth::user()->nombre }}" ><br>
        <label>Primer apellido:</label>
        <input type="text" name="apellido1" value="{{ Auth::user()->apellido1 }}" ><br>
        <label>Segundo apellido:</label>
        <input type="text" name="apellido2" value="{{ Auth::user()->apellido2 }}" ><br>
        <label>DNI:</label>
        <input type="text" name="dni" value="{{ Auth::user()->dni }}" ><br>
        <label>Email:</label>
        <input type="email" name="email" value="{{ Auth::user()->email }}" ><br>
        <!-- Añade aquí más campos si lo necesitas -->
        <button type="submit">Confirmar inscripción</button>
    </form>
</div>
<form action="{{ route('inicio') }}" method="GET" style="display:inline;">
    <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem;">
        <span class="tooltip-text">Volver</span>
    </button>
</form>