<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeureTravail extends Model
{
    use HasFactory;

    protected $table = 'heures_de_travail';
    protected $fillable = [
        'designation',
        'heure_debut',
        'heure_fin',
        'debut_pause',
        'fin_pause',
    ];

}
