<?php

namespace App\Models;

use App\Models\Contrat;
use App\Models\HeureDeTravail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employe extends Model
{
    use HasFactory;

    protected $table = 'employes';

    /**
     * Get all of the conges for the Employe
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conges()
    {
        return $this->hasMany(Conge::class, 'employe_id');
    }

    /**

     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function heure_de_travail(): BelongsTo
    {
        return $this->belongsTo(HeureDeTravail::class, 'heure_de_travail_id');
    }


    /**
     * Get all of the contrats for the Employe
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function contrats(): HasMany
    // {
    //     return $this->hasMany(Contrat::class, 'employe_id');
    // }

    // relation to get the latest contrat related to the employe
    public function contrat()
    {
        return $this->hasOne(Contrat::class, 'employer_id')->ofMany([
            'id' => 'min',
        ], function ($query) {
            $query->where('type_contrat_id', '!=', '3');
        });
    }

}
