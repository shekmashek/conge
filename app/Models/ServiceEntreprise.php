<?php

namespace App\Models;

use App\Models\Employe;
use App\Models\DepartementEntreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceEntreprise extends Model
{
    use HasFactory;

    protected $table = 'services';

    public function departement()
    {
        return $this->belongsTo(DepartementEntreprise::class, 'departement_id');
    }

    public function employes()
    {
        return $this->hasMany(Employe::class, 'service_id');
    }
}
