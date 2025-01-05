<?php

namespace Tests\Feature;

use App\Models\ECs;
use App\Models\Etudiant;
use App\Models\Note;
use App\Models\UEs;
use Tests\TestCase;

class ValidationDesUEsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_validation_d_une_ue()
    {
        $etudiant = Etudiant::factory()->create();

        $ue = UEs::factory()->create([
            'nom' => 'Mathématiques',
            'credits_ects' => 6,
        ]);

        $ec1 = ECs::factory()->create([
            'nom' => 'EC1',
            'coefficient' => 2,
            'ue_id' => $ue->id,
        ]);

        $ec2 = ECs::factory()->create([
            'nom' => 'EC2',
            'coefficient' => 3,
            'ue_id' => $ue->id,
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec1->id,
            'note' => 8,
            'date_evaluation' => now()->toDateString()
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec2->id,
            'note' => 7,
            'date_evaluation' => now()->toDateString()
        ]);

        $response = $this->get(route('etudiants.stats', $etudiant));

        $response->assertStatus(200);
        $response->assertSee('Non validée');

        Note::where('ec_id', $ec1->id)->update(['note' => 12]);
        Note::where('ec_id', $ec2->id)->update(['note' => 15]);

        $response = $this->get(route('etudiants.stats', $etudiant));

        $response->assertStatus(200);
        $response->assertSee('Validée');
    }


    public function test_compensation_entre_ues_du_meme_semestre()
    {
        $etudiant = Etudiant::factory()->create();

        $ueMath = UEs::factory()->create([
            'nom' => 'Mathématiques',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $ueInfo = UEs::factory()->create([
            'nom' => 'Informatique',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $ecMath1 = ECs::factory()->create([
            'nom' => 'EC Math 1',
            'coefficient' => 2,
            'ue_id' => $ueMath->id,
        ]);

        $ecMath2 = ECs::factory()->create([
            'nom' => 'EC Math 2',
            'coefficient' => 4,
            'ue_id' => $ueMath->id,
        ]);

        $ecInfo1 = ECs::factory()->create([
            'nom' => 'EC Info 1',
            'coefficient' => 3,
            'ue_id' => $ueInfo->id,
        ]);

        $ecInfo2 = ECs::factory()->create([
            'nom' => 'EC Info 2',
            'coefficient' => 3,
            'ue_id' => $ueInfo->id,
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ecMath1->id,
            'note' => 5,
            'date_evaluation' => now()->toDateString(),
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ecMath2->id,
            'note' => 6,
            'date_evaluation' => now()->toDateString(),
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ecInfo1->id,
            'note' => 15,
            'date_evaluation' => now()->toDateString(),
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ecInfo2->id,
            'note' => 14,
            'date_evaluation' => now()->toDateString(),
        ]);

        $response = $this->get(route('etudiants.stats', $etudiant));

        $response->assertStatus(200);

        // Vérification du texte dans le HTML
        $response->assertSee('Passe en classe supérieure');
    }

}
