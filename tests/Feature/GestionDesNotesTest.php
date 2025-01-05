<?php

namespace Tests\Feature;

use App\Http\Controllers\EtudiantController;
use App\Models\ECs;
use App\Models\Etudiant;
use App\Models\Note;
use App\Models\UEs;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class GestionDesNotesTest extends TestCase
{

    use WithoutMiddleware;
    /**
     * Test pour vajouter une note valide
     */
    public function test_ajout_une_note_valide()
    {
        $etudiant = Etudiant::factory()->create();

        $ue = UEs::factory()->create([
            'semestre' => 6, 
        ]);
        $ec = ECs::factory()->create([
            'ue_id' => $ue->id,
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 8,
            'date_evaluation' => now()->toDateString()
        ]);

        $this->assertDatabaseHas('notes', [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 8,
            'date_evaluation' => now()->toDateString()
        ]);
    }

     /**
     * Test pour vérifier le calcul de la moyenne
     */
    public function test_calcul_moyenne_ue()
    {
        $ue = UEs::factory()->create([
            'semestre' => 6,
        ]);
        $ec1 = ECs::factory()->create(['ue_id' => $ue->id, 'coefficient' => 2]);
        $ec2 = ECs::factory()->create(['ue_id' => $ue->id, 'coefficient' => 3]);

        $etudiant = Etudiant::factory()->create();

        $note1 = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec1->id,
            'note' => 14,
            'session' => 'normale',
            'date_evaluation' => now()->toDateString(),
        ]);

        $note2 = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec2->id,
            'note' => 16,
            'session' => 'normale',
            'date_evaluation' => now()->toDateString(),
        ]);

        $stats = (new EtudiantController())->showStats($etudiant);

        $moyenneUE = $stats['stats']->firstWhere('ue.id', $ue->id)['moyenne'];

        $moyenneAttendue = (14 * 2 + 16 * 3) / (2 + 3);

        $this->assertEquals($moyenneAttendue, $moyenneUE);
    }

    /**
    * Test pour vérifier si la section lors de la saisie d'une note est normale ou rattrapage
    */
    public function test_la_session_est_valide_uniquement_si_normale_ou_rattrapage()
    {
        $etudiant = Etudiant::factory()->create();
        $ue = UEs::factory()->create([
            'semestre' => 6, 
        ]);
        $ec = ECs::factory()->create(['ue_id' => $ue->id]);

        $donneesSessionNormale = [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15,
            'session' => 'normale',
            'date_evaluation' => now()->toDateString(),
        ];

        $donneesSessionRattrapage = [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 12,
            'session' => 'rattrapage',
            'date_evaluation' => now()->toDateString(),
        ];

        $donneesInvalides = [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15,
            'session' => 'autre',
            'date_evaluation' => now()->toDateString(),
        ];

        $response = $this->post(route('notes.store'), $donneesSessionNormale);
        $response->assertRedirect(route('notes.index'));
        $this->assertDatabaseHas('notes', $donneesSessionNormale);

        $response = $this->post(route('notes.store'), $donneesSessionRattrapage);
        $response->assertRedirect(route('notes.index'));
        $this->assertDatabaseHas('notes', $donneesSessionRattrapage);

        $response = $this->post(route('notes.store'), $donneesInvalides);
        $response->assertSessionHasErrors(['session']);
        $this->assertDatabaseMissing('notes', $donneesInvalides);
    }

    /**
    * Test pour empecher de soumettre le formulaire de note sans mettre de note
    */

    public function test_validation_des_notes_manquantes()
    {
        $etudiant = Etudiant::factory()->create();
        $ue = UEs::factory()->create([
            'semestre' => 6,
        ]);
        $ec = ECs::factory()->create(['ue_id' => $ue->id]);

        $response = $this->post(route('notes.store'), [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => null,
            'date_evaluation' => now()->toDateString(),
        ]);
        
        $this->assertDatabaseMissing('notes', [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
        ]);

        $response->assertSessionHasErrors('note');
        
        $response = $this->post(route('notes.store'), [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => '',
            'date_evaluation' => now()->toDateString(),
        ]);
        
        $this->assertDatabaseMissing('notes', [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
        ]);

        $response->assertSessionHasErrors('note');
    }

}
