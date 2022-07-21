<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conge extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','type_motif_conge_id','start','end','descriptions','dure_conge'
    ];
}
