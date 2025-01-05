<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Etudiant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Etudiant::class;

    public function definition(): array
    {
        return [
            'numero_etudiant' => fake()->unique()->randomNumber(8),
            'nom' => fake()->name() ,
            'prenom' => fake()->name() ,
            'niveau' => fake()->randomElement(['L1', 'L2', 'L3',]),
        ];
    }
}
