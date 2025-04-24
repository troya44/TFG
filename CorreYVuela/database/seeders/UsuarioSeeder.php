<?php
namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usamos Faker para generar datos aleatorios
        \Faker\Factory::create();

        // Crear 10 usuarios con la misma contraseña
        for ($i = 0; $i < 10; $i++) {
            Usuario::create([
                'name' => 'Usuario ' . ($i + 1),  // Nombre del usuario
                'email' => 'usuario' . ($i + 1) . '@example.com',  // Correo electrónico único
                'password' => ('1')
            ]);
        }

        // Opcional: Mostrar un mensaje de éxito en la consola
        $this->command->info('10 usuarios con la misma contraseña fueron creados correctamente.');
    }
}
