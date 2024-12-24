<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ECs extends Model
{
    use HasFactory;

    protected $table = 'elements_constitutifs';
    

    protected $fillable = [
        'code',
        'nom',
        'coefficient',
        'ue_id',
    ];


    // Relation avec l'unité d'enseignement
    public function uniteEnseignement()
    {
        return $this->belongsTo(UniteEnseignement::class, 'ue_id');
    }
}
