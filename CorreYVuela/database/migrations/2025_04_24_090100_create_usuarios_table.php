<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /** * Run the migrations. */ public function up()
    {
        if (!Schema::hasTable("usuarios")) {
            Schema::create('usuarios', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('apellido1');
                $table->string('apellido2');
                $table->string('dni')->unique();
                $table->string('localidad');
                $table->integer('telefono');
                $table->enum('sexo', ['Hombre', 'Mujer']);
                $table->boolean('admin')->default(false);
                $table->string('email');
                $table->date('fecha_nacimiento');
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
