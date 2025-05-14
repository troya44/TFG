<?php
namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Foto;
use Illuminate\Http\Request;

class GaleriaController extends Controller {
    public function index(Request $request)
    {
        $carreras = Carrera::all();
        $carreraId = $request->input('carrera_id');
        $fotos = Foto::when($carreraId, function ($query) use ($carreraId) {
            return $query->where('carrera_id', $carreraId);
        })->get();

        return view('galeria.index', compact('carreras', 'fotos', 'carreraId'));
    }

    public function create()
    {
        $carreras = Carrera::all();
        return view('galeria.create', compact('carreras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'carrera_id' => 'required|exists:carreras,id',
            'imagenes.*' => 'required|image|max:2048', // Valida cada imagen
        ]);

        if($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $ruta = $imagen->store('fotos', 'public');
                Foto::create([
                    'ruta' => $ruta,
                    'carrera_id' => $request->carrera_id,
                ]);
            }
        }

        return redirect()->route('galeria.index')->with('success', 'Fotos subidas correctamente');
    }
}
