<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    $usuario = Auth::user(); // Asegúrate de que Auth usa el modelo Usuario

    if ($carrera->inscritos()->where('usuario_id', $usuario->id)->exists()) {
        return redirect()->back()->with('error', 'Ya estás inscrito en esta prueba.');
    }

    $carrera->inscritos()->attach($usuario->id);

    return redirect()->route('informacionPrueba', $id)->with('success', 'Inscripción realizada correctamente.');
}



}
