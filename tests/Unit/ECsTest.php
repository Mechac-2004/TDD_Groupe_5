<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\UEs;
use App\Models\ECs;

class ECsTest extends TestCase
{
    use RefreshDatabase;

    public function test_creation_ec_avec_coefficient()
    {
        // Créer une UE
        $ue = UEs::create([
            'code' => 'UE01',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 3
        ]);

        // Créer un EC avec un coefficient spécifique
        $ec = ECs::create([
            'code' => 'EC01',
            'nom' => 'Introduction à la Programmation',
            'coefficient' => 3,
            'ue_id' => $ue->id,  // Associer cet EC à l'UE
        ]);

        // Vérifier que l'EC est bien créé avec le bon coefficient dans la base de données
        $this->assertDatabaseHas('elements_constitutifs', [
            'code' => 'EC01',
            'nom' => 'Introduction à la Programmation',
            'coefficient' => 3,
            'ue_id' => $ue->id,  
        ]);
    }



    public function test_un_ec_est_correctement_rattache_a_une_ue()
    {
        // Créer une UE
        $ue = UEs::create([
            'code' => 'UE1',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        // Créer un EC rattaché à l'UE
        $ec = ECs::create([
            'code' => 'EC01',
            'nom' => 'HTML et CSS',
            'ue_id' => $ue->id,
            'coefficient' => 2,
        ]);

        // Vérifier que l'EC est bien rattaché à l'UE
        $this->assertEquals($ue->id, $ec->uniteEnseignement->id);

        // Vérifier que l'UE a bien cet EC
        $this->assertTrue($ue->elementsConstitutifs->contains($ec));

        // Vérifier que les données sont correctes dans la base
        $this->assertDatabaseHas('elements_constitutifs', [
            'code' => 'EC01',
            'nom' => 'HTML et CSS',
            'ue_id' => $ue->id,
        ]);

        $this->assertDatabaseHas('unites_enseignement', [
            'code' => 'UE1',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);
    }



    public function test_modification_ec()
{
    // Créer une UE
    $ue = UEs::create([
        'code' => 'UE01',
        'nom' => 'Programmation Web',
        'credits_ects' => 6,
        'semestre' => 1,
    ]);

    // Créer un EC lié à l'UE
    $ec = ECs::create([
        'code' => 'EC01',
        'nom' => 'HTML et CSS',
        'coefficient' => 2,
        'ue_id' => $ue->id,
    ]);

    // Modifier les informations de l'EC
    $ec->update([
        'nom' => 'HTML, CSS et JavaScript',
        'coefficient' => 3,
    ]);

    // Vérifier que les données dans la base sont correctement mises à jour
    $this->assertDatabaseHas('elements_constitutifs', [
        'id' => $ec->id,
        'code' => 'EC01',
        'nom' => 'HTML, CSS et JavaScript',
        'coefficient' => 3,
        'ue_id' => $ue->id,
    ]);

    // Vérifier que l'ancienne valeur n'existe plus
    $this->assertDatabaseMissing('elements_constitutifs', [
        'nom' => 'HTML et CSS',
        'coefficient' => 2,
    ]);
}



public function test_validation_du_coefficient_ec()
{
    // Créer une UE pour rattacher l'EC
    $ue = UEs::create([
        'code' => 'UE01',
        'nom' => 'Programmation Web',
        'credits_ects' => 6,
        'semestre' => 1,
    ]);

    // Créer un EC avec un coefficient valide
    $ec = ECs::create([
        'code' => 'EC03',
        'nom' => 'PHP',
        'coefficient' => 3, // Coefficient valide
        'ue_id' => $ue->id,
    ]);

    // Vérifier que l'EC est bien créé
    $this->assertNotNull($ec);
    $this->assertDatabaseHas('elements_constitutifs', [
        'code' => 'EC03',
        'nom' => 'PHP',
        'coefficient' => 3,
        'ue_id' => $ue->id,
    ]);
}

public function test_suppression_ec()
{
    // Créer une UE pour rattacher l'EC
    $ue = UEs::create([
        'code' => 'UE01',
        'nom' => 'Programmation Web',
        'credits_ects' => 6,
        'semestre' => 1,
    ]);

    // Créer un EC rattaché à l'UE
    $ec = ECs::create([
        'code' => 'EC01',
        'nom' => 'HTML et CSS',
        'coefficient' => 2,
        'ue_id' => $ue->id,
    ]);

    // Vérifier que l'EC est bien créé dans la base de données
    $this->assertDatabaseHas('elements_constitutifs', [
        'code' => 'EC01',
        'nom' => 'HTML et CSS',
        'coefficient' => 2,
        'ue_id' => $ue->id,
    ]);

    // Supprimer l'EC
    $ec->delete();

    // Vérifier que l'EC n'existe plus dans la base de données
    $this->assertDatabaseMissing('elements_constitutifs', [
        'code' => 'EC01',
        'nom' => 'HTML et CSS',
        'coefficient' => 2,
        'ue_id' => $ue->id,
    ]);

}


}
