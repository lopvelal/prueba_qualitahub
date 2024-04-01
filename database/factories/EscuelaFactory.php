<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Escuela>
 */
class EscuelaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company(),
            'direccion' => $this->faker->address(),
            'logotipo' => '/storage/logos/default_logo.png',
            'email' => $this->faker->safeEmail(),
            'telefono' => $this->faker->numerify('#########'),
            'web' => $this->faker->safeEmailDomain(),
        ];
    }
}
