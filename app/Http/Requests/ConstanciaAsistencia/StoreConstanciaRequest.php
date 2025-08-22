<?php

namespace App\Http\Requests\ConstanciaAsistencia;

use Illuminate\Foundation\Http\FormRequest;

class StoreConstanciaRequest extends FormRequest
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
      'paciente_id'         => 'required|exists:pacientes,id',
      'especialista_id'     => 'required|exists:especialistas,id',
      'citas_seleccionadas' => 'required|string',
    ];
  }

  public function attributes()
  {
    return [
      'paciente_id' => 'paciente',
      'especialista_id' => 'especialista',
      'citas_seleccionadas' => 'citas seleccionadas',
    ];
  }
}
