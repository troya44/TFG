<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{

        protected $fillable = ['ruta', 'carrera_id'];


    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }


}
