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
            $table->string('foto_perfil')->nullable()->after('email'); // Puedes cambiar 'email' por el campo que prefieras
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn('foto_perfil');
        });
    }

};
