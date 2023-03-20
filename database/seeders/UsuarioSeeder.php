<?php

namespace Database\Seeders;

use App\Models\Profesion;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $idProfesion = Profesion::where('titulo', 'ISmGqCL3lU')->value('id');

        //Usuario::create([
        //  'nombre' => Str::random(5),
        //  'apellidos' => Str::random(10),
        //  'email' => Str::random(5). '@gmail.com',
        //  'fecha' => date('2020-10-04'),
        //  'id_profesion' => $idProfesion,
        //]);

        Usuario::factory()->count(50)->create();
    }
}
