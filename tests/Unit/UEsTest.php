<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\UEs;
use App\Models\Etudiant;
use App\Models\ECs;
use App\Models\Note;

class UEsTest extends TestCase
{
    use RefreshDatabase;

    public function test_creation_ue()
    {
        $ue = UEs::create([
            'code' => 'UE1',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 1
        ]);

        $this->assertDatabaseHas('unites_enseignement', [
            'code' => 'UE1',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 1
        ]);
    }

    public function test_validation_ue()
    {
        // Créer une UE avec un semestre comme entier
        $ue = UEs::create([
            'code' => 'UE1',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 6 // Semestre en entier
        ]);

        // Créer un étudiant
        $etudiant = Etudiant::create([
            'numero_etudiant' => 'ETD12345',
            'nom' => 'Doe',
            'prenom' => 'John',
            'niveau' => 'L3'
        ]);
        

        // Créer un EC associé à l'UE
        $ec = ECs::create([
            'ue_id' => $ue->id,
            'code' => 'EC01',
            'nom' => 'Introduction à la Programmation',
            'coefficient' => 2,
        ]);

        // Créer une note pour l'étudiant dans l'EC
        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 12,
            'session' => 'normale',
            'date_evaluation' => now(),
        ]);

        // Vérifier que l'UE est validée pour l'étudiant
        $this->assertTrue($ue->estValidee($etudiant));

        // Vérifier que l'UE existe dans la base avec le semestre correct
        $this->assertDatabaseHas('unites_enseignement', [
            'code' => 'UE1',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 6, // Vérification correcte
        ]);
    }

    public function test_ue_peut_avoir_des_ec()
    {
        // Créer une UE
        $ue = UEs::create([
            'code' => 'UE01',
            'nom' => 'Unité d\'Enseignement 1',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        // Créer des ECs associés à l'UE
        $ec1 = ECs::create([
            'code' => 'EC01',
            'nom' => 'Élément Constitutif 1',
            'coefficient' => 3,
            'ue_id' => $ue->id,  // Associer à l'UE
        ]);

        $ec2 = ECs::create([
            'code' => 'EC02',
            'nom' => 'Élément Constitutif 2',
            'coefficient' => 2,
            'ue_id' => $ue->id,  // Associer à l'UE
        ]);

        // Vérifier que l'UE a les ECs associés
        $this->assertCount(2, $ue->elementsConstitutifs);

        // Vérifier que les ECs appartiennent bien à l'UE
        $this->assertTrue($ue->elementsConstitutifs->contains($ec1));
        $this->assertTrue($ue->elementsConstitutifs->contains($ec2));
    }



    public function test_validation_code_ue_format_UExx()
    {
        // Test code valide
        $validUE = new UEs([
            'code' => 'UE01',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 1
        ]);
        $this->assertTrue($validUE->hasValidCode());

    }


    public function test_validation_semestre()
    {
        // Test semestre valide (entre 1 et 6)
        $validUE1 = new UEs([
            'code' => 'UE01',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 3
        ]);
        $this->assertTrue($validUE1->hasValidSemester());

        $validUE2 = new UEs([
            'code' => 'UE02',
            'nom' => 'Mathématiques',
            'credits_ects' => 4,
            'semestre' => 6
        ]);
        $this->assertTrue($validUE2->hasValidSemester());
        }
}
