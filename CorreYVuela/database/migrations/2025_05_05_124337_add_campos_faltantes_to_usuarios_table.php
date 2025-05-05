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
    Schema::table('usuarios', function (Blueprint $table) {
        $table->string('apellido1')->after('name');
        $table->string('apellido2')->after('apellido1');
        $table->string('dni')->unique()->after('apellido2');
        $table->string('localidad')->after('dni');
        $table->integer('telefono')->after('localidad');
        $table->enum('sexo',allowed:['Hombre', 'Mujer'])->after('telefono');
        $table->date('fecha_nacimiento')->after('sexo');        
        $table->boolean('admin')->default(false);

        // ...añade los demás campos que faltan
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            //
        });
    }
};
