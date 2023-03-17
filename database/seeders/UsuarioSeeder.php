<?php

namespace Database\Seeders;

use App\Usuario as Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::create([
            'nombre' => Str::random(5),
            'apellidos' => Str::random(10),
            'email' => Str::random(5). '@gmail.com',
        ]);

         
        //DB::table('usuarios')->insert([
          //  'nombre' => Str::random(5),
            //'apellidos' => Str::random(10),
            //'email' => Str::random(5). '@gmail.com',
        //]);
    }
}
