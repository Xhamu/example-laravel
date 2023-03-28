<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'saldo'=> random_int(50, 5000),
            'fecha' => fake()->date(),
            'id_profesion' => random_int(1, 10),
            'password' => bcrypt('abc123'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Usuario $user) {
            $user->assignRole('admin');
        });
    }
}
