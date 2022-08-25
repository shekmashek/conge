<?php

namespace App\Models;

use Aws\Api\Service;
use App\Models\Employe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartementEntreprise extends Model
{
    use HasFactory;
    protected $table = 'departement_entreprises';


    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class,'entreprise_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'departement_entreprise_id');
    }

    public function employes(): HasMany
    {
        return $this->hasMany(Employe::class, 'departement_entreprises_id');
    }
}
