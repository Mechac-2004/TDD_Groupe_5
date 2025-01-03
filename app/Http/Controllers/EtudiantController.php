<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\UEs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::all();
        return view('Etudiants.index', compact('etudiants'));
    }

    public function parNiveau($niveau)
    {
        $etudiants = Etudiant::where('niveau', $niveau)->get(['id', 'nom', 'prenom']);
        return response()->json($etudiants);
    }

    public function create()
    {
        return view('Etudiants.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'niveau' => 'required|in:L1,L2,L3',
        ]);

        $numeroEtudiant = $this->genererNumeroEtudiant();

        $etudiant = new Etudiant();
        $etudiant->numero_etudiant = $numeroEtudiant;
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->niveau = $request->niveau;
        $etudiant->save();

        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès.');
    }


    public function edit(Etudiant $etudiant)
    {
        return view('Etudiants.edit', compact('etudiant'));
    }

    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'niveau' => 'required|in:L1,L2,L3',
        ]);

        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->niveau = $request->niveau;
        $etudiant->save();

        return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function showStats(Etudiant $etudiant)
    {
        // Récupérer les notes de l'étudiant avec leurs EC et leurs UE
        $notes = $etudiant->notes()->with(['elementsConstitutifs.uniteEnseignement'])->get();
    
        // Organiser les données pour chaque UE
        $stats = $notes->groupBy(function ($note) {
            return $note->elementsConstitutifs->uniteEnseignement->id;
        })->map(function ($notesParUE) {
            $ue = $notesParUE->first()->elementsConstitutifs->uniteEnseignement;
    
            $somme = 0;
            $totalCoefficient = 0;
    
            foreach ($ue->elementsConstitutifs as $ec) {
                $noteEC = $notesParUE->firstWhere('ec_id', $ec->id);
                if ($noteEC) {
                    $somme += $noteEC->note * $ec->coefficient;
                    $totalCoefficient += $ec->coefficient;
                }
            }
    
            $moyenneUE = $totalCoefficient > 0 ? $somme / $totalCoefficient : null;
    
            return [
                'ue' => $ue,
                'elementsConstitutifs' => $ue->elementsConstitutifs,
                'notes' => $notesParUE,
                'moyenne' => $moyenneUE,
            ];
        });
    
        // Calcul de la moyenne générale
        $moyenneGenerale = $stats->filter(fn($stat) => $stat['moyenne'] !== null)->avg('moyenne');
    
        return view('Etudiants.stats', compact('etudiant', 'stats', 'moyenneGenerale'));
    }    


    // Méthode pour générer le Matricule de l'étudiant
    private function genererNumeroEtudiant()
    {
        $countryID = 'BJ';
        $schoolID = 'ESGIS';
        $currentYear = date('Y');
    
        do {
            $sequence = Str::lower(Str::random(5));
            $matricule = "$sequence$schoolID$currentYear$countryID";
        } while (Etudiant::where('numero_etudiant', $matricule)->exists());
    
        return $matricule;
    }
}