<?php

namespace App\Models;

use App\Models\Conge;
use App\Models\ServiceEntreprise;
use Illuminate\Foundation\Auth\User;
use App\Models\DepartementEntreprise;
use Illuminate\Database\Eloquent\Model;
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(ServiceEntreprise::class, 'service_id');
    }

    public function departement()
    {
        return $this->belongsTo(DepartementEntreprise::class, 'departement_id');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function contrat ()
    {
        return $this->hasOne(Contrat::class, 'employer_id');
    }

}
