<?php

namespace App\Http\Controllers;

use App\Models\ECs;
use App\Models\Etudiant;
use App\Models\Note;
use App\Models\UEs;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $notes = Note::select(
            'notes.*',
            'etudiants.numero_etudiant as etudiant_matricule',
            'etudiants.niveau as etudiant_niveau',
            'etudiants.nom as etudiant_nom',
            'etudiants.prenom as etudiant_prenom',
            'elements_constitutifs.nom as ec_nom',
            'elements_constitutifs.coefficient as ec_coeff',
            'unites_enseignement.nom as ue_nom'
        )
        ->join('etudiants', 'notes.etudiant_id', '=', 'etudiants.id')
        ->join('elements_constitutifs', 'notes.ec_id', '=', 'elements_constitutifs.id')
        ->join('unites_enseignement', 'elements_constitutifs.ue_id', '=', 'unites_enseignement.id')
        ->get();

        return view('Notes.index', compact('notes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etudiants = Etudiant::all();
        $ues = UEs::all();
        return view('Notes.create', compact('etudiants', 'ues'));
    }

    public function getEcsByUe($ueId)
    {
        $ue = UEs::find($ueId);
        if (!$ue) {
            return response()->json(['error' => 'UE not found'], 404);
        }

        $ecs = ECs::where('ue_id', $ueId)->get(['id', 'nom']);
        return response()->json($ecs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
                'etudiant_id' => 'required|exists:etudiants,id',
                'ec_id' => 'required|exists:elements_constitutifs,id',
                'note' => 'required|numeric|min:0|max:20',
                'session' => 'required|in:normale,rattrapage',
                'date_evaluation' => 'required|date|before_or_equal:' . now()->toDateString(),
            ]);
        
            $note = new Note();
            $note->create($validated);
        
            return redirect()->route('notes.index')->with('success', 'Note enregistrée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $note = Note::select(
            'notes.*',
            'etudiants.id as etudiant_id',
            'etudiants.niveau as etudiant_niveau',
            'elements_constitutifs.id as ec_id',
            'unites_enseignement.id as ue_id'
        )
        ->join('etudiants', 'notes.etudiant_id', '=', 'etudiants.id')
        ->join('elements_constitutifs', 'notes.ec_id', '=', 'elements_constitutifs.id')
        ->join('unites_enseignement', 'elements_constitutifs.ue_id', '=', 'unites_enseignement.id')
        ->where('notes.id', $id)
        ->firstOrFail();

        $ues = UEs::all();
        $ecs = ECs::where('ue_id', $note->ue_id)->get();
        $etudiants = Etudiant::where('niveau', $note->etudiant_niveau)->get();

        return view('Notes.edit', compact('note', 'ues', 'ecs', 'etudiants'));
    }

    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'ec_id' => 'required|exists:elements_constitutifs,id',
            'note' => 'required|numeric|min:0|max:20',
            'session' => 'required|in:normale,rattrapage',
            'date_evaluation' => 'required|date|before_or_equal:' . now()->toDateString(),
        ]);
    
        $note = Note::findOrFail($id);
        $note->update($validated);
    
        return redirect()->route('notes.index')->with('success', 'Note mise à jour avec succès');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
