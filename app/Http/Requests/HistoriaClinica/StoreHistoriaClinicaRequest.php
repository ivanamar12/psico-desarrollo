<?php

namespace App\Http\Requests\HistoriaClinica;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistoriaClinicaRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'medicamento_embarazo' => ['required', 'string'],
      'tipo_medicamento' => ['required', 'string', 'max:800'],
      'fumo_embarazo' => ['required', 'string'],
      'cantidad' => ['required', 'string'],
      'alcohol_embarazo' => ['required', 'string'],
      'tipo_alcohol' => ['required', 'string'],
      'cantidad_consumia_alcohol' => ['required', 'string'],
      'droga_embarazo' => ['required', 'string'],
      'tipo_droga' => ['required', 'string'],
      'forceps_parto' => ['required', 'string'],
      'cesarea' => ['required', 'string'],
      'razon_cesarea' => ['required', 'string', 'max:900'],
      'niño_prematuro' => ['required', 'string'],
      'meses_prematuro' => ['required', 'string'],
      'peso_nacer_niño' => ['required', 'string'],
      'complicaciones_nacer' => ['required', 'string'],
      'tipo_complicacion' => ['required', 'string', 'max:900'],
      'problema_alimentacion' => ['required', 'string'],
      'tipo_problema_alimenticio' => ['required', 'string', 'max:900'],
      'problema_dormir' => ['required', 'string'],
      'tipo_problema_dormir' => ['required', 'string', 'max:900'],
      'tranquilo_recien_nacido' => ['required', 'string'],
      'gustaba_cargaran_recien_nacido' => ['required', 'string'],
      'alerta_recien_nacido' => ['required', 'string'],
      'problemas_desarrollo_primeros_años' => ['required', 'string'],
      'cuales_problemas' => ['required', 'string', 'max:1000'],
      'enfermedad_infecciosa' => ['required', 'string'],
      'tipo_enfermedad_infecciosa' => ['required', 'string'],
      'enfermedad_no_infecciosa' => ['required', 'string'],
      'tipo_enfermedad_no_infecciosa' => ['required', 'string'],
      'enfermedad_cronica' => ['required', 'string'],
      'tipo_enfermedad_cronica' => ['required', 'string'],
      'discapacidad' => ['required', 'string'],
      'tipo_discapacidad' => ['required', 'string'],
      'otros' => ['required', 'string'],
      'escolarizado' => ['required', 'string'],
      'modalidad_educacion' => ['required', 'string'],
      'tipo_educacion' => ['required', 'string'],
      'nombre_escuela' => ['required', 'string'],
      'tutoria_terapias' => ['required', 'string'],
      'tutoria_terapias_cuales' => ['required', 'string'],
      'dificultad_lectura' => ['required', 'string'],
      'dificultad_aritmetica' => ['required', 'string'],
      'dificultad_escribir' => ['required', 'string'],
      'agrada_escuela' => ['required', 'string'],
      'otro_servicio' => ['required', 'string'],
      'paciente_id' => ['required', 'exists:pacientes,id'],
      'codigo' => ['required', 'string'],
      'referencia' => ['required', 'string'],
      'especialista_refirio' => ['required', 'string'],
      'motivo' => ['required', 'string'],
      // Campos de observación 
      'observacion_historia' =>  ['nullable', 'string', 'max:500'],
      'observacion_antecedentes' => ['nullable', 'string', 'max:500'],
      'observacion_desarrollo' => ['nullable', 'string', 'max:500'],
      'observacion_escolar' => ['nullable', 'string', 'max:500'],
    ];
  }

  public function attributes()
  {
    return [
      // Datos básicos
      'paciente_id' => 'paciente',
      'codigo' => 'código de historia',
      'referencia' => 'referencia',
      'especialista_refirio' => 'especialidad que refirió',
      'motivo' => 'motivo de consulta',

      // Antecedentes médicos
      'enfermedad_infecciosa' => 'enfermedad infecciosa',
      'tipo_enfermedad_infecciosa' => 'tipo de enfermedad infecciosa',
      'enfermedad_no_infecciosa' => 'enfermedad no infecciosa',
      'tipo_enfermedad_no_infecciosa' => 'tipo de enfermedad no infecciosa',
      'enfermedad_cronica' => 'enfermedad crónica',
      'tipo_enfermedad_cronica' => 'tipo de enfermedad crónica',
      'discapacidad' => 'discapacidad',
      'tipo_discapacidad' => 'tipo de discapacidad',
      'otros' => 'otros antecedentes',

      // Embarazo
      'medicamento_embarazo' => 'medicamento durante el embarazo',
      'tipo_medicamento' => 'tipo de medicamento',
      'fumo_embarazo' => 'fumó durante el embarazo',
      'cantidad' => 'cantidad de cigarrillos',
      'alcohol_embarazo' => 'alcohol durante el embarazo',
      'tipo_alcohol' => 'tipo de alcohol',
      'cantidad_consumia_alcohol' => 'cantidad de alcohol consumida',
      'droga_embarazo' => 'drogas durante el embarazo',
      'tipo_droga' => 'tipo de droga',

      // Parto
      'forceps_parto' => 'uso de fórceps en el parto',
      'cesarea' => 'cesárea',
      'razon_cesarea' => 'razón de la cesárea',
      'niño_prematuro' => 'niño prematuro',
      'meses_prematuro' => 'meses de prematuridad',
      'peso_nacer_niño' => 'peso al nacer',
      'complicaciones_nacer' => 'complicaciones al nacer',
      'tipo_complicacion' => 'tipo de complicación',

      // Primeros meses
      'problema_alimentacion' => 'problema de alimentación',
      'tipo_problema_alimenticio' => 'tipo de problema alimenticio',
      'problema_dormir' => 'problema para dormir',
      'tipo_problema_dormir' => 'tipo de problema para dormir',
      'tranquilo_recien_nacido' => 'tranquilo al nacer',
      'gustaba_cargaran_recien_nacido' => 'gustaba que lo cargaran',
      'alerta_recien_nacido' => 'alerta al nacer',
      'problemas_desarrollo_primeros_años' => 'problemas en el desarrollo',
      'cuales_problemas' => 'cuáles problemas',

      // Historia escolar
      'escolarizado' => 'escolarizado',
      'modalidad_educacion' => 'modalidad de educación',
      'tipo_educacion' => 'tipo de educación',
      'nombre_escuela' => 'nombre de la escuela',
      'tutoria_terapias' => 'tutoría o terapias',
      'tutoria_terapias_cuales' => 'cuáles tutorías o terapias',
      'dificultad_lectura' => 'dificultad de lectura',
      'dificultad_aritmetica' => 'dificultad aritmética',
      'dificultad_escribir' => 'dificultad de escritura',
      'agrada_escuela' => 'agrada el ambiente escolar',
      'otro_servicio' => 'otro servicio',

      // Observaciones
      'observacion_historia' => 'observación de historia',
      'observacion_antecedentes' => 'observación de antecedentes',
      'observacion_desarrollo' => 'observación de desarrollo',
      'observacion_escolar' => 'observación escolar',
    ];
  }
}
