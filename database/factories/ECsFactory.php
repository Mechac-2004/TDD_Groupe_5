<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ECs;
use App\Models\UEs;

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
    protected $model = ECs::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('EC##'),
            'nom' => fake()->name() ,
            'coefficient' => fake()->numberBetween(1, 5),
            'ue_id' => UEs::factory(), // Relation avec une UE
        ];
    }
}
