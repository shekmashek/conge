<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeConge extends Model
{
    use HasFactory;

    protected $table = 'conges_types_conge';

    public function getAll(){
        $result = TypeConge::all();
        return $result;
    }

}
