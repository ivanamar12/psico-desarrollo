<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id', 'historia_desarrollo_id', 'antecedente_medico_id','historia_escolar_id', 'codigo', 'referencia', 'especialista_refirio', 'motivo'];

    public function paciente(){

    	return $this->belongsTo(Paciente::class);
    	
    }
    
    public function historiadesarrollo(){

        return $this->belongsTo(HistoriaDesarrollo::class);
        
    }

    public function antecedentemedico(){

        return $this->belongsTo(AntecedenteMedico::class);
        
    }

    public function historiaescolar(){

        return $this->belongsTo(HistoriaEscolar::class);
        
    }
}
