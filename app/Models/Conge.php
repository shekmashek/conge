<?php

namespace App\Models;

use App\Models\Employe;
use App\Models\EtatConge;
use App\Models\TypeConge;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conge extends Model
{
    use HasFactory;

    protected $table = 'conges';

    protected $fillable = [
        'type_conge_id',
        'employe_id',
        'debut',
        'fin',
        'intervalle',
        'duree_conge',
        'motif',
        'etat_conge_id ',
        'cumul_perso',
        'j_utilise',
        'restant'
    ];

    /**
     * Get the employe that owns the Conge
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }


    /**
     * Get the type_conge that owns the Conge
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type_conge(): BelongsTo
    {
        return $this->belongsTo(TypeConge::class, 'type_conge_id');
    }

    /**
     * Get the etat_conge that owns the Conge
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function etat_conge(): BelongsTo
    {
        // 1 validé, 2 refusé, 3 en attente
        return $this->belongsTo(EtatConge::class, 'etat_conge_id');
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////

    // A NE PAS FAIRE
    public function getAll()
    {
        $query = Conge::all();
        return $query;
    }

    public function insert($data)
    {
        DB::table('conges')->insert($data);
        // Conge::create($data);
        return 1;
    }
    public function getListCongesByEmpId($id_emp){
        $conges = DB::table('conges')
            ->join('conges_etats_conge', 'etat_conge_id', '=', 'conges_etats_conge.id')
            ->join('conges_types_conge', 'type_conge_id', '=', 'conges_types_conge.id')
            ->join('conges_frequences_solde', 'conges_types_conge.frequence_solde_id', '=', 'conges_frequences_solde.id')
            ->join('employes', 'employe_id', '=', 'employes.id')
            ->where('employe_id', '=', $id_emp)
            ->limit(100)
            ->get();
        return $conges;
    }




}
