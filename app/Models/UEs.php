<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class UEs extends Model
{
    use HasFactory;

    protected $table = 'unites_enseignement';

    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'nom',
        'credits_ects',
        'semestre',
    ];

    /**
     * Vérifie si le semestre est valide (compris entre 1 et 6).
     */
    public function hasValidSemester(): bool
    {
        return $this->semestre >= 1 && $this->semestre <= 6;
    }

    /**
     * Vérifie si le code de l'UE est valide (format UExx).
     */
    public function hasValidCode(): bool
    {
        return preg_match('/^UE\d{2}$/', $this->code);
    }

    // Relation avec les éléments constitutifs 
    public function elementsConstitutifs()
    {
        return $this->hasMany(ECs::class, 'ue_id');
    }

    /**
     * Vérifie si les crédits ECTS sont valides.
     */
    public function hasValidCredits(): bool
    {
        return $this->credits_ects >= 1 && $this->credits_ects <= 30;
    }

     /**
     * Vérifie si l'UE est validée pour un étudiant.
     */
    public function estValidee($etudiant): bool
    {
        // Exemple : Vérification basée sur les notes ou autres critères
        $totalCoefficient = $this->elementsConstitutifs()->sum('coefficient');
        $totalNotes = $this->elementsConstitutifs()
            ->join('notes', 'notes.ec_id', '=', 'elements_constitutifs.id')
            ->where('notes.etudiant_id', $etudiant->id)
            ->sum(DB::raw('notes.note * elements_constitutifs.coefficient'));

        $moyenne = $totalNotes / ($totalCoefficient ?: 1);

        return $moyenne >= 10 && $this->hasValidCredits(); // Crédits et validation de l'étudiant
    }
}
