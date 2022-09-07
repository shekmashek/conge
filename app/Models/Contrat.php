<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $table = 'pers_contrats';

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employer_id');
    }


}
