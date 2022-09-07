<?php

namespace App\Models;

use App\Models\Conge;
use App\Models\Employe;
use App\Models\ServiceEntreprise;
use App\Models\DepartementEntreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entreprise extends Model
{
    use HasFactory;

    protected $table = 'entreprises';

    public function departements()
    {
        return $this->hasMany(DepartementEntreprise::class, 'entreprise_id');
    }

    public function employes()
    {
        return $this->hasManyThrough(Employe::class, DepartementEntreprise::class, 'entreprise_id', 'departement_id');
    }

    public function services()
    {
        return $this->hasManyThrough(ServiceEntreprise::class, DepartementEntreprise::class, 'entreprise_id', 'departement_id');
    }

    public function conges()
    {
        return $this->hasManyThrough(Conge::class, Employe::class, 'entreprise_id', 'employe_id');
    }

}
