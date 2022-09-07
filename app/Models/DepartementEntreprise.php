<?php

namespace App\Models;

use App\Models\Entreprise;
use App\Models\ServiceEntreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartementEntreprise extends Model
{
    use HasFactory;

    protected $table = 'departement_entreprises';

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function services()
    {
        return $this->hasMany(ServiceEntreprise::class, 'departement_id');
    }


}
