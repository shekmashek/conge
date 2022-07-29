<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtatConge extends Model
{
    use HasFactory;

    protected $table = 'etats_conge';

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
