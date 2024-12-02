<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'status', 'tipo_prueba_id', 'area_desarrollo_id', 'rango_prueba_id'];

    public function areaDesarrollo(){

        return $this->belongsTo(AreaDesarrollo::class);
        
    }

    public function tipoPrueba(){

        return $this->belongsTo(TipoPrueba::class);
        
    }

    public function rangoPrueba(){

        return $this->belongsTo(RangoPrueba::class);
        
    }

    public function itemPruebas(){

    	return $this->hasMany(ItemPrueba::class);
    	 
    }
}
