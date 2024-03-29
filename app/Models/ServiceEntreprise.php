<?php

namespace App\Models;

use App\Models\DepartementEntreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceEntreprise extends Model
{
    use HasFactory;

    protected $table = 'services';

    public function departement(): BelongsTo
    {
        return $this->belongsTo(DepartementEntreprise::class, 'departement_entreprise_id');
    }

    public function employes(): HasMany
    {
        return $this->hasMany(Employe::class, 'service_id');
    }

}
