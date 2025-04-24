<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'name', 'apellido1','apellido2','dni', 'localidad', 'telefono', 'sexo', 'admin','email','fecha_nacimiento','password'
    ];
    protected $attributes = [
        'admin' => false,  
    ];

    public $timestamps = true;

    // Relación de un usuario con muchos reportes
    
}


