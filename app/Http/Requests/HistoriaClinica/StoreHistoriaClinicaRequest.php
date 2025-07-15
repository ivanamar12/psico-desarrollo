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
}
