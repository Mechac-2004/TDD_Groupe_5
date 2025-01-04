<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'numero_etudiant' => (new Etudiant())->genererNumeroEtudiant(),
            'nom' => $this->faker->unique()->lastName,
            'prenom' => $this->faker->unique()->firstName,
            'niveau' => $this->faker->randomElement(['L1', 'L2', 'L3']),
        ];
    }
}
