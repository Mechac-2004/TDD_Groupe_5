<?php

namespace Database\Factories;

use App\Models\UEs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UEs>
 */
class UEsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'nom' => $this->faker->unique()->sentence(3),
            'credits_ects' => $this->faker->numberBetween(1, 12),
            'semestre' => $this->faker->numberBetween(1, 6),
        ];
    }
}
