<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaDesarrollo extends Model
{
    use HasFactory;

    protected $fillable = ['medicamento_embarazo', 'tipo_medicamento', 'fumo_embarazo', 'cantidad','alcohol_embarazo', 'tipo_alcohol', 'cantidad_consumia_alcohol', 'droga_embarazo', 'tipo_droga', 'forceps_parto', 'cesarea', 'razon_cesarea', 'niño_prematuro', 'meses_prematuro', 'peso_nacer_niño', 'complicaciones_nacer', 'tipo_complicacion', 'problema_alimentacion', 'tipo_problema_alimenticio', 'problema_dormir', 'tipo_problema_dormir', 'tranquilo_recien_nacido', 'gustaba_cargaran_recien_nacido', 'alerta_recien_nacido', 'problemas_desarrollo_primeros_años', 'cuales_problemas'];


    public function historiaclinicas(){

    	return $this->hasMany(HistoriaClinica::class);
    	 
    }
}
