<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UEs extends Model
{
    use HasFactory;

    protected $table = 'unites_enseignement';


    protected $fillable = [
        'code',
        'nom',
        'credits_ects',
        'semestre',
    ];

    // Relation avec les éléments constitutifs 
    public function elementsConstitutifs()
    {
        return $this->hasMany(ElementConstitutif::class, 'ue_id');
    }
}
