<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_motif_conge extends Model
{
    use HasFactory;
    protected $fillable=['nom_motif'];

    public function getAllTypeMotifConges()
    {
        return type_motif_conge::all();
    }
}
