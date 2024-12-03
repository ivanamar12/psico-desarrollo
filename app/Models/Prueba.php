<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'status', 'tipo_prueba_id', 'area_desarrollo_id', 'rango_prueba_id'];

    public function areaDesarrollo()
    {
        return $this->belongsTo(AreaDesarrollo::class);
    }

    public function tipoPrueba()
    {
        return $this->belongsTo(TipoPrueba::class);
    }

    public function rangoPrueba()
    {
        return $this->belongsTo(RangoPrueba::class);
    }

    public function itemPruebas()
    {
        return $this->hasMany(ItemPrueba::class, 'prueba_id');
    }

    public function obtenerConItems($id)
    {
        return self::with(['areaDesarrollo', 'tipoPrueba', 'rangoPrueba', 'itemPruebas'])
            ->find($id);
    }

    public function obtenerPruebasPorRango($rangoId)
    {
        return self::with(['areaDesarrollo', 'tipoPrueba', 'rangoPrueba', 'itemPruebas'])
            ->where('rango_prueba_id', $rangoId)
            ->get();
    }

    public function obtenerDatosFormato($id)
    {
        $prueba = $this->with(['areaDesarrollo', 'tipoPrueba', 'rangoPrueba', 'itemPruebas'])->find($id);

        if (!$prueba) {
            return null;
        }

        return [
            'id' => $prueba->id,
            'nombre' => $prueba->nombre,
            'descripcion' => $prueba->descripcion,
            'status' => $prueba->status,
            'areaDesarrollo' => $prueba->areaDesarrollo->area_desarrollo ?? 'Área no definida',
            'tipo' => $prueba->tipoPrueba->tipo ?? 'Tipo no definido',
            'rangoEdad' => $prueba->rangoPrueba->rango_edad ?? 'Rango no definido',
            'items' => $prueba->itemPruebas->pluck('item')->toArray() // Convertir a array
        ];
    }
}

