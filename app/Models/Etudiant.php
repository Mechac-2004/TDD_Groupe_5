<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Etudiant extends Model
{

    use HasFactory;

    protected $table = 'etudiants';


    protected $fillable = [
        'numero_etudiant', 
        'nom', 
        'prenom', 
        'niveau'
    ];


    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function genererNumeroEtudiant()
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
