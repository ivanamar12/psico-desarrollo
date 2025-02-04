<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubEscala extends Model
{
    use HasFactory;

    protected $fillable = ['prueba_id', 'sub_escala', 'descripcion'];

    public function prueba(){

        return $this->belongsTo(Prueba::class);
        
    }

    public function Items(){

    	return $this->hasMany(Item::class);
    	
    }

    public function Baremos(){

    	return $this->hasMany(Baremos::class);
    	
    }
}
