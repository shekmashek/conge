<?php

namespace App\Models;

use App\Models\Contrat;
use App\Models\Entreprise;
use App\Models\HeureDeTravail;
use App\Models\ServiceEntreprise;
use Illuminate\Support\Facades\DB;
use App\Models\DepartementEntreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employe extends Model
{
    use HasFactory;

    protected $table = 'employes';
    // protected $table = 'employers';


    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class,'entreprise_id');
    }


    public function service(): BelongsTo
    {
        return $this->belongsTo(ServiceEntreprise::class, 'service_id');
    }

    public function departement(): BelongsTo
    {
        return $this->belongsTo(DepartementEntreprise::class, 'departement_entreprises_id');
    }

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

    public function contrats() : HasMany
    {
        return $this->hasMany(Contrat::class, 'employe_id');
    }

    public function contratStage()
    {
        return $this->hasOne(Contrat::class, 'employer_id')->ofMany([
            'id' => 'max',
        ], function ($query) {
            $query->where('type_contrat_id', '==', '3');
        });
    }

    // relation to get the latest contrat related to the employe
    public function contrat()
    {
        return $this->hasOne(Contrat::class, 'employer_id')->ofMany([
            'id' => 'min',
        ], function ($query) {
            $query->where('type_contrat_id', '!=', '3');
        });
    }




    //////////////////////////////////////////////////////////////////
    // A NE PAS FAIRE
    public function getEmployeByUserId($id){
        // dd(gettype($id));
        $result =  DB::select('select * from employes where user_id = ?', $id);
        return $result;
    }

}
