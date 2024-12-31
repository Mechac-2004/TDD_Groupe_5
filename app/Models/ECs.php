<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\UEs;


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

    public function uniteEnseignement()
    {
        return $this->belongsTo(UEs::class, 'ue_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}