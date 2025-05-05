<h2>Listado de inscritos en {{ $carrera->nombre }}</h2>
<ul>
    @if ($inscritos->isEmpty())
        No hay inscritos en esta carrera.
        @else
        @foreach($inscritos as $inscrito)
        <li>{{ $inscrito->nombre }} {{ $inscrito->apellido1 }} {{ $inscrito->apellido2 }}</li>
    @endforeach
    @endif
</ul>
<form action="{{ route('inicio') }}" method="GET" style="display:inline;">
    <button type="submit" class="btn-admin tooltip-btn" style="margin-top:1rem;">
        <span class="tooltip-text">Volver</span>
    </button>
</form>

