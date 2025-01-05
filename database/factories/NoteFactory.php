<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Note;
use App\Models\Etudiant;
use App\Models\ECs;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Note::class;

    public function definition(): array
    {
        return [
            'etudiant_id' => Etudiant::factory(),
            'ec_id' => ECs::factory(),
            'note' => fake()->numberBetween(0, 20),
            'session' => fake()->randomElement(['normale', 'rattrapage']),
        ];
    }
}
