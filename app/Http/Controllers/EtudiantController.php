<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
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
