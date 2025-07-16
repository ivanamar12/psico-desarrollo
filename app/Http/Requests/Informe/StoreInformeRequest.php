<?php

namespace App\Http\Requests\Informe;

use Illuminate\Foundation\Http\FormRequest;

class StoreInformeRequest extends FormRequest
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
      'motivo' => 'required|string|max:1000',
      'instrumentos' => 'required|string|max:1000',
      'recursos' => 'required|string|max:1000',
      'condiciones_generales' => 'required|string|max:1000',
      'fisica_salud' => 'required|string|max:1000',
      'perceptivo_motriz' => 'required|string|max:1000',
      'coeficiente_intelectual' => 'required|string|max:1000',
      'afectiva_social' => 'required|string|max:1000',
      'conclusion' => 'required|string|max:1000',
      'recomendaciones' => 'required|string|max:1000',
    ];
  }

  public function attributes()
  {
    return [
      'paciente_id' => 'paciente',
      'especialista_id' => 'especialista',
      'motivo' => 'motivo de consulta',
      'instrumentos' => 'instrumentos utilizados',
      'recursos' => 'recursos utilizados',
      'condiciones_generales' => 'consideraciones generales',
      'fisica_salud' => 'área física y salud',
      'perceptivo_motriz' => 'área perceptivo motriz',
      'coeficiente_intelectual' => 'coeficiente intelectual',
      'afectiva_social' => 'área afectiva social',
    ];
  }
}
