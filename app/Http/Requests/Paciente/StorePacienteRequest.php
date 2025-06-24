<?php

namespace App\Http\Requests\Paciente;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
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
      'nombre' => 'required|string|max:120',
      'apellido' => 'required|string|max:120',
      'fecha_nac' => 'required|date',
      'representante_id' => 'nullable|exists:representantes,id',
      'tipo_vivienda' => 'required|string',
      'cantidad_habitaciones' => 'required|integer|min:0',
      'cantidad_personas' => 'required|integer|min:0',
      'servecio_agua_potable' => 'required|string',
      'servecio_gas' => 'required|string',
      'servecio_electricidad' => 'required|string',
      'servecio_drenaje' => 'required|string',
      'disponibilidad_internet' => 'required|string',
      'tipo_conexion_internet' => 'nullable|string',
      'acceso_servcios_publicos' => 'required|string',
      'fuente_ingreso_familiar' => 'required|string',
      'familiares' => 'array',
      'familiares.*.nombre' => 'required|string|max:120',
      'familiares.*.apellido' => 'required|string|max:120',
      'familiares.*.fecha_nac' => 'required|date',
      'familiares.*.parentesco' => 'required|string|max:120',
      'familiares.*.discapacidad' => 'nullable|string|max:120',
      'familiares.*.tipo_discapacidad' => 'nullable|string|max:120',
      'familiares.*.enfermedad_cronica' => 'nullable|string|max:120',
      'familiares.*.tipo_enfermedad' => 'nullable|string|max:120',
      'tiene_observacion' => 'required|in:si,no',
      'observacion' => 'nullable|string|max:500',
    ];
  }
}
