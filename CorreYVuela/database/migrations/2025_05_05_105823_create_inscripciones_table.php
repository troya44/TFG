<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('inscripciones', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('usuario_id');
        $table->unsignedBigInteger('carrera_id');
        $table->timestamps();
    
        $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
        $table->unique(['usuario_id', 'carrera_id']);
    });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
