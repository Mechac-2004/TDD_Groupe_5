<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{

    use HasFactory;

    protected $table = 'note';


    protected $fillable = ['etudiant_id', 'ec_id', 'note', 'session', 'date_evaluation'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function elementsConstitutifs()
    {
        return $this->belongsTo(ECs::class, 'ec_id');
    }
}
