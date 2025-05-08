<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'name', 'apellido1','apellido2','dni', 'localidad', 'telefono', 'sexo', 'admin','email','fecha_nacimiento','password'
    ];
    protected $attributes = [
        'admin' => false,  
    ];

    public $timestamps = true;

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'inscripciones', 'usuario_id', 'carrera_id');
    }
}
