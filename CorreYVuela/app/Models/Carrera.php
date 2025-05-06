<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{

    protected $table = 'carreras';

    protected $fillable = [
        'nombre', 'descripcion','fecha','hora','lugar','distancia','estado',
    ];
    protected $attributes = [
        'admin' => false,  
    ];

    public $timestamps = true;

    public function inscritos()
    {
        return $this->belongsToMany(Usuario::class, 'inscripciones', 'carrera_id', 'usuario_id')
        ->withPivot('modalidad','categoria');
    }
    


}
