<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPrueba extends Model
{
    use HasFactory;

    protected $fillable = ['item', 'prueba_id'];

    public function prueba(){

        return $this->belongsTo(Prueba::class);
        
    }

    public function valorItems(){

    	return $this->hasMany(ValorItem::class);
    	 
    }
}
