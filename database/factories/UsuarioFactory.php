<?php

namespace Database\Factories;

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
            'nombre' => fake()->name('es-ES'),
            'email' => fake()->unique()->safeEmail(),
            'fecha' => fake()->date(),
            'id_profesion' => random_int(1, 9),
            'password' => bcrypt('abc123'),
        ];
    }
}
