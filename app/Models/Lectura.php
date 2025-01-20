<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lectura extends Model
{
    use HasFactory;

    protected $fillable = ['sub_escala_id','percentil', '61-66 meses','67-72 meses','73-78 meses'];

    public function subEscala(){

    	return $this->belongsTo(SubEscala::class);
    }
}
