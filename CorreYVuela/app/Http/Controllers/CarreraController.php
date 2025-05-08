<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\InscripcionRealizada;
use Illuminate\Support\Facades\Notification;




class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carreras = Carrera::all();
        return view('pruebas', compact('carreras'));
    }


    

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        return view('registrarCarrera');
    }



    public function guardar(Request $request)
{
    // Validar los datos
    $request->validate([
        'nombre' => 'required|string',
        'descripcion' => 'required|string',
        'fecha' => 'required|date',
        'hora' => 'required',
        'lugar' => 'required|string',
        'distancia' => 'required|numeric',
    ]);

    // Guardar la carrera (ajusta el modelo si es necesario)
    Carrera::create($request->all());

    // Redirigir o mostrar mensaje
    return redirect()->route('pruebas')->with('success', 'Carrera registrada correctamente');
}

public function informacionPrueba($id)
{
    $carrera = Carrera::findOrFail($id);
    return view('informacionPrueba', compact('carrera'));
}

public function listadoInscritos($id)
{
    $carrera = Carrera::findOrFail($id);
    $inscritos = $carrera->inscritos; // Colección de usuarios inscritos
    return view('listadoInscritos', compact('carrera', 'inscritos'));
}

public function inscribirse(Request $request, $id)
{
    $carrera = Carrera::findOrFail($id);
    $usuario = Auth::user();

    if ($carrera->inscritos()->where('usuario_id', $usuario->id)->exists()) {
        return redirect()->back()->with('error', 'Ya estás inscrito en esta prueba.');
    }

    $fechaNacimiento = $usuario->fecha_nacimiento;
    $edad = Carbon::parse($fechaNacimiento)->age;

    // Asignar categoría según edad
    if ($edad >= 15 && $edad <= 16) {
        $categoria = 'Cadete';
    } elseif ($edad >= 17 && $edad <= 18) {
        $categoria = 'Juvenil';
    } elseif ($edad >= 19 && $edad <= 23) {
        $categoria = 'Sub-23';
    } elseif ($edad >= 24 && $edad <= 30) {
        $categoria = 'Elite';
    } elseif ($edad >= 31 && $edad <= 40) {
        $categoria = 'Master 30';
    } elseif ($edad >= 41 && $edad <= 50) {
        $categoria = 'Master 40';
    } elseif ($edad >= 51 && $edad <= 60) {
        $categoria = 'Master 50';
    } elseif ($edad >= 61) {
        $categoria = 'Master 60+';
    } else {
        $categoria = 'Sin categoría';
    }

    // Primero attach
    $carrera->inscritos()->attach($usuario->id, [
        'modalidad' => $request->input('modalidad'),
        'categoria' => $categoria,
    ]);

    // Ahora recupera el usuario con los datos de la inscripción (pivote)
    $usuarioPivot = $carrera->inscritos()->where('usuario_id', $usuario->id)->first();

    // Notificar al usuario
    if ($usuarioPivot) {
        $usuarioPivot->notify(new InscripcionRealizada($carrera, $usuarioPivot));
    }

    // Notificar a la empresa (correo desde .env)
    $correoEmpresa = config('mail.from.address', 'correyvuela.contacto@gmail.com');
    \Illuminate\Support\Facades\Notification::route('mail', $correoEmpresa)
        ->notify(new InscripcionRealizada($carrera, $usuarioPivot));

    return redirect()->route('informacionPrueba', $id)->with('success', 'Inscripción realizada correctamente.');
}




public function edit($carreraId, $usuarioId)
    {
        $carrera = Carrera::findOrFail($carreraId);
        $usuario = Usuario::findOrFail($usuarioId);

        // Solo el usuario puede editar su inscripción
        if (Auth::id() !== $usuario->id) {
            abort(403, 'No autorizado');
        }

        // Busca la inscripción del usuario en la carrera (tabla pivote)
        $inscripcion = $carrera->inscritos()->where('usuario_id', $usuario->id)->first();

        if (!$inscripcion) {
            return redirect()->back()->with('error', 'No tienes inscripción en esta carrera.');
        }

        return view('inscripcion.edit', [
            'carrera' => $carrera,
            'usuario' => $usuario,
            'inscripcion' => $inscripcion
        ]);
    }

    public function update(Request $request, $carreraId, $usuarioId)
{
    $carrera = Carrera::findOrFail($carreraId);
    $usuario = Usuario::findOrFail($usuarioId);

    if (Auth::id() !== $usuario->id) {
        abort(403, 'No autorizado');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'apellido1' => 'required|string|max:255',
        'apellido2' => 'nullable|string|max:255',
        'dni' => 'required|string|max:20',
        'localidad' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'modalidad' => 'required|string|max:255',
        'categoria' => 'required|string|max:255',
    ]);

    $usuario->update($request->only(['name', 'apellido1', 'apellido2', 'dni', 'localidad', 'fecha_nacimiento']));

    $carrera->inscritos()->updateExistingPivot($usuario->id, [
        'modalidad' => $request->modalidad,
        'categoria' => $request->categoria,
    ]);

    return redirect()->route('informacionPrueba', $carrera->id)
        ->with('success', 'Inscripción actualizada correctamente');
}

public function destroy($carreraId, $usuarioId)
{
    $carrera = Carrera::findOrFail($carreraId);
    $usuario = Usuario::findOrFail($usuarioId);

    if (Auth::id() !== $usuario->id) {
        abort(403, 'No autorizado');
    }

    $carrera->inscritos()->detach($usuario->id);

    return redirect()->route('informacionPrueba', $carrera->id)
        ->with('success', 'Inscripción eliminada correctamente');
}



}
