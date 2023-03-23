<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $adminRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'admin'
        ]);
        $userRole = Role::create([
            'name' => 'user',
            'guard_name' => 'user'
        ]);
        $this->call(UsuarioSeeder::class);
        $this->call(ProfesionSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
