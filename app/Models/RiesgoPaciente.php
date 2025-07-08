<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiesgoPaciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'historia_clinica_id',
        'riesgo_social',
        'riesgo_biologico',
        'riesgo_global',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class);
    }
}
