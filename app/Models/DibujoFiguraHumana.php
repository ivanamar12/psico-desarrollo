<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DibujoFiguraHumana extends Model
{
    use HasFactory;

    protected $fillable = ['sub_escala_id','items', 'nivel','masculino_5_años','femenino_5_años', 'masculino_6_años', 'femenino_6_años'];

    public function subEscala(){

    	return $this->belongsTo(SubEscala::class);
    }
}
