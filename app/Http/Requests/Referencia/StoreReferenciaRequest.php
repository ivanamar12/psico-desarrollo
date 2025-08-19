<?php

namespace App\Http\Requests\Referencia;

use Illuminate\Foundation\Http\FormRequest;

class StoreReferenciaRequest extends FormRequest
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
      'paciente_id' => 'required|exists:pacientes,id',
      'especialista_id' => 'required|exists:especialistas,id',
      'titulo' => 'required|string|min:15|max:255',
      'motivo' => 'required|string|min:30|max:1000',

      'presentacion_caso' => 'required|string|min:30|max:1000',
      'antecedentes' => 'required|string|min:30|max:1000',
      'indicadores_psicologicos' => 'required|string|min:30|max:1000',
      'sugerencias' => 'required|string|min:30|max:1000',
    ];
  }

  public function attributes()
  {
    return [
      'paciente_id' => 'paciente',
      'especialista_id' => 'especialista',
      'titulo' => 'título',
      'motivo' => 'motivo de consulta',

      'presentacion_caso' => 'presentación del caso',
      'antecedentes' => 'antecedentes',
      'indicadores_psicologicos' => 'indicadores psicologicos',
      'sugerencias' => 'sugerencias',
    ];
  }
}
