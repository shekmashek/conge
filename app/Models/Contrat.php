<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contrat extends Model
{
    use HasFactory;

    protected $table = 'pers_contrats';

    /**
     * Get the employe that owns the Contrat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }
}
