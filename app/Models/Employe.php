<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    public function conges(): HasMany
    {
        return $this->hasMany(Conge::class, 'employe_id');
    }

}
