<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Note;
use Illuminate\Http\Request;

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


        $etudiant = new Etudiant();
        $etudiant->numero_etudiant = $etudiant->genererNumeroEtudiant();
        $etudiant->nom = strtoupper($request->nom);
        $etudiant->prenom = ucwords(strtolower($request->prenom));
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

        $etudiant->nom = strtoupper($request->nom);
        $etudiant->prenom = ucwords(strtolower($request->prenom));
        $etudiant->niveau = $request->niveau;
        $etudiant->save();

        return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function showStats(Etudiant $etudiant)
    {
        $notes = $etudiant->notes()->with(['elementsConstitutifs.uniteEnseignement'])->get();

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

            $moyenneUE = $totalCoefficient > 0 ? round($somme / $totalCoefficient, 2) : null;
            $validated = $moyenneUE >= 10;

            return [
                'ue' => $ue,
                'elementsConstitutifs' => $ue->elementsConstitutifs,
                'notes' => $notesParUE,
                'moyenne' => $moyenneUE,
                'status' => $validated,
                'credits' => $ue->credits_ects,
                'validé' => $validated
            ];
        });

        $moyenneGenerale = round($stats->filter(fn($stat) => $stat['moyenne'] !== null)->avg('moyenne'), 2);

        $totalCredits = $stats->sum('credits');
        $creditsValidés = $stats->filter(fn($stat) => $stat['validé'])->sum('credits');

        $pourcentageValidé = ($totalCredits > 0) ? round(($creditsValidés / $totalCredits) * 100, 2) : 0;
        $passeEnAnneeSuivante = $pourcentageValidé >= 80;

        return view('Etudiants.stats', compact('etudiant', 'stats', 'moyenneGenerale', 'passeEnAnneeSuivante', 'pourcentageValidé'));
    }

    public function afficherResultatsParSemestre(Etudiant $etudiant)
    {
        $notes = $etudiant->notes()->with(['elementsConstitutifs.uniteEnseignement'])->get();

        $resultatsParSemestre = $notes->groupBy(function ($note) {
            return $note->elementsConstitutifs->uniteEnseignement->semestre;
        })->map(function ($notesParSemestre, $semestre) {
            
            $ues = $notesParSemestre->groupBy(function ($note) {
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

                $moyenneUE = $totalCoefficient > 0 ? round($somme / $totalCoefficient, 2) : null;

                return [
                    'ue' => $ue->nom,
                    'moyenne' => $moyenneUE,
                ];
            });

            return [
                'semestre' => $semestre,
                'ues' => $ues->values(),
            ];
        });

        $moyenneGenerale = $resultatsParSemestre->flatMap(fn($resultat) => $resultat['ues'])
            ->filter(fn($ue) => $ue['moyenne'] !== null)
            ->avg('moyenne');

        $moyenneGenerale = round($moyenneGenerale, 2);

        return view('Etudiants.semestre', compact('etudiant', 'resultatsParSemestre', 'moyenneGenerale'));
    }

}
