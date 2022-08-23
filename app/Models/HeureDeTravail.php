<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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


    /**
     * Get all of the employes for the HeureDeTravail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employes(): HasMany
    {
        return $this->hasMany(Employe::class, 'heure_de_travail_id');
    }

}
