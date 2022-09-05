<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeureDeTravail extends Model
{
    use HasFactory;

    protected $table = 'conges_heures_de_travail';
    protected $fillable = [
        'designation',
        'heure_debut',
        'heure_fin',
        'debut_pause',
        'fin_pause',
    ];

}
