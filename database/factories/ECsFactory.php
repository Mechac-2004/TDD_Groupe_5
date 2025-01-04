<?php

namespace Database\Factories;

use App\Models\ECs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ECs>
 */
class ECsFactory extends Factory
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
            'nom' => $this->faker->unique()->sentence(4),
            'coefficient' => $this->faker->numberBetween(1, 5),
            'ue_id' => null,
        ];
    }
}
