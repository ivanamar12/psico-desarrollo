<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baremos extends Model
{
    use HasFactory;

    protected $fillable = ['sub-escala_id', 'p_c', 'edad_meses','puntos'];

    public function SubEscala(){

        return $this->belongsTo(SubEscala::class);
        
    }
}
