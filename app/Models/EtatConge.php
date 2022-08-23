<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EtatConge extends Model
{
    use HasFactory;

    protected $table = 'conges_etats_conge';

    /**
     * Get all of the conges for the EtatConge
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conges(): HasMany
    {
        return $this->hasMany(Conge::class, 'etat_conge_id');
    }

}
