<?php

namespace Database\Seeders;

use App\Models\Profesion;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Usuario::create([
        //  'nombre' => Str::random(5),
        //  'apellidos' => Str::random(10),
        //  'email' => Str::random(5). '@gmail.com',
        //  'fecha' => date('2020-10-04'),
        //  'id_profesion' => $idProfesion,
        //]);
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);

        $adminRole->givePermissionTo(['create-users', 'edit-users', 'delete-users']);
        $editorRole->givePermissionTo(['edit-users']);

        Usuario::factory()->count(25)->create()->each(function ($user) use ($adminRole) {
            $user->assignRole($adminRole);
        });
    }
}
