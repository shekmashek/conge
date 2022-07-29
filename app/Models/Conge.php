<?php

namespace App\Models;

use App\Models\Employe;
use App\Models\EtatConge;
use App\Models\TypeConge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conge extends Model
{
    use HasFactory;

    protected $table = 'conges';

    protected $filable = ['type_conge_id','employe_id', 'debut', 'fin', 'intervale', 'duree_conge', 'motif', 'etat_conge_id ', 'cumul_perso', 'j_utilise', 'restant'];

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
}
