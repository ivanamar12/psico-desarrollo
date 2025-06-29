<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriaClinica extends Model
{
  use HasFactory;

  protected $fillable = [
    'paciente_id',
    'historia_desarrollo_id',
    'antecedente_medico_id',
    'historia_escolar_id',
    'codigo',
    'referencia',
    'especialista_refirio',
    'motivo',
    'observacion'
  ];

  // Relación con el modelo Paciente
  public function paciente(): BelongsTo
  {
    return $this->belongsTo(Paciente::class);
  }

  // Relación con el modelo HistoriaDesarrollo
  public function historiaDesarrollo(): BelongsTo
  {
    return $this->belongsTo(HistoriaDesarrollo::class);
  }

  // Relación con el modelo AntecedenteMedico
  public function antecedenteMedico(): BelongsTo
  {
    return $this->belongsTo(AntecedenteMedico::class);
  }

  // Relación con el modelo HistoriaEscolar
  public function historiaEscolar(): BelongsTo
  {
    return $this->belongsTo(HistoriaEscolar::class);
  }

  public function getDatosPdf()
  {
    return [
      'nombrePaciente' => $this->paciente->nombre,
      'apellidoPaciente' => $this->paciente->apellido,
      'fechaNacPaciente' => $this->paciente->fecha_nac,
      'generoPaciente' => optional($this->paciente->genero)->genero,
      'nombreRepresentante' => optional($this->paciente->representante)->nombre,
      'apellidoRepresentante' => optional($this->paciente->representante)->apellido,
      'ciRepresentante' => optional($this->paciente->representante)->ci,
      'telefonoRepresentante' => optional($this->paciente->representante)->telefono,
      'emailRepresentante' => optional($this->paciente->representante)->email,
      'generoRepresentante' => optional($this->paciente->representante->genero)->genero,
      'estadoDireccion' => optional($this->paciente->representante->direccion->estado)->estado,
      'municipioDireccion' => optional($this->paciente->representante->direccion->municipio)->municipio,
      'parroquiaDireccion' => optional($this->paciente->representante->direccion->parroquia)->parroquia,
      'sectorDireccion' => optional($this->paciente->representante->direccion)->sector,
      'codigoHistoria' => $this->codigo,
      'referenciaHistoria' => $this->referencia,
      'motivoHistoria' => $this->motivo,
      'medicamento_embarazo' => optional($this->historiaDesarrollo)->medicamento_embarazo,
      'tipo_medicamento' => optional($this->historiaDesarrollo)->tipo_medicamento,
      'fumo_embarazo' => optional($this->historiaDesarrollo)->fumo_embarazo,
      'cantidad' => optional($this->historiaDesarrollo)->cantidad,
      'alcohol_embarazo' => optional($this->historiaDesarrollo)->alcohol_embarazo,
      'tipo_alcohol' => optional($this->historiaDesarrollo)->tipo_alcohol,
      'cantidad_consumia_alcohol' => optional($this->historiaDesarrollo)->cantidad_consumia_alcohol,
      'droga_embarazo' => optional($this->historiaDesarrollo)->droga_embarazo,
      'tipo_droga' => optional($this->historiaDesarrollo)->tipo_droga,
      'forceps_parto' => optional($this->historiaDesarrollo)->forceps_parto,
      'cesarea' => optional($this->historiaDesarrollo)->cesarea,
      'razon_cesarea' => optional($this->historiaDesarrollo)->razon_cesarea,
      'niño_prematuro' => optional($this->historiaDesarrollo)->niño_prematuro,
      'meses_prematuro' => optional($this->historiaDesarrollo)->meses_prematuro,
      'peso_nacer_niño' => optional($this->historiaDesarrollo)->peso_nacer_niño,
      'complicaciones_nacer' => optional($this->historiaDesarrollo)->complicaciones_nacer,
      'tipo_complicacion' => optional($this->historiaDesarrollo)->tipo_complicacion,
      'problema_alimentacion' => optional($this->historiaDesarrollo)->problema_alimentacion,
      'tipo_problema_alimenticio' => optional($this->historiaDesarrollo)->tipo_problema_alimenticio,
      'problema_dormir' => optional($this->historiaDesarrollo)->problema_dormir,
      'tipo_problema_dormir' => optional($this->historiaDesarrollo)->tipo_problema_dormir,
      'tranquilo_recien_nacido' => optional($this->historiaDesarrollo)->tranquilo_recien_nacido,
      'gustaba_cargaran_recien_nacido' => optional($this->historiaDesarrollo)->gustaba_cargaran_recien_nacido,
      'alerta_recien_nacido' => optional($this->historiaDesarrollo)->alerta_recien_nacido,
      'problemas_desarrollo_primeros_años' => optional($this->historiaDesarrollo)->problemas_desarrollo_primeros_años,
      'cuales_problemas' => optional($this->historiaDesarrollo)->cuales_problemas,
      'escolarizado' => optional($this->historiaEscolar)->escolarizado,
      'tipo_educaion' => optional($this->historiaEscolar)->tipo_educaion,
      'tutoria_terapias' => optional($this->historiaEscolar)->tutoria_terapias,
      'tutoria_terapias_cuales' => optional($this->historiaEscolar)->tutoria_terapias_cuales,
      'dificultad_lectura' => optional($this->historiaEscolar)->dificultad_lectura,
      'dificultad_aritmetica' => optional($this->historiaEscolar)->dificultad_aritmetica,
      'dificultad_escribir' => optional($this->historiaEscolar)->dificultad_escribir,
      'agrada_escuela' => optional($this->historiaEscolar)->agrada_escuela,
      'enfermedad_infecciosa' => optional($this->antecedenteMedico)->enfermedad_infecciosa,
      'tipo_enfermedad_infecciosa' => optional($this->antecedenteMedico)->tipo_enfermedad_infecciosa,
      'enfermedad_no_infecciosa' => optional($this->antecedenteMedico)->enfermedad_no_infecciosa,
      'tipo_enfermedad_no_infecciosa' => optional($this->antecedenteMedico)->tipo_enfermedad_no_infecciosa,
      'enfermedad_cronica' => optional($this->antecedenteMedico)->enfermedad_cronica,
      'tipo_enfermedad_cronica' => optional($this->antecedenteMedico)->tipo_enfermedad_cronica,
      'discapacidad' => optional($this->antecedenteMedico)->discapacidad,
      'tipo_discapacidad' => optional($this->antecedenteMedico)->tipo_discapacidad,
      'otros' => optional($this->antecedenteMedico)->otros,
    ];
  }

  public static function obtenerHistoriaCompleta($id)
  {
    return self::with([
      // Relaciones principales
      'paciente.representante.direccion.estado',
      'paciente.representante.direccion.municipio',
      'paciente.representante.direccion.parroquia',
      'paciente.datosEconomico',
      'paciente.parentescos',
      'antecedenteMedico',
      'historiaDesarrollo'
    ])
      ->where('id', $id)
      ->firstOrFail();
  }
}
