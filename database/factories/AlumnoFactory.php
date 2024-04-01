<?php

namespace Database\Factories;

use App\Models\Escuela;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName . ' ' . $this->faker->lastName,
            'fecha_nacimiento' => $this->faker->date(),
            'ciudad_natal' => $this->faker->city(),
            'escuela_id' => Escuela::inRandomOrder()->value('id'),
        ];
    }
}
