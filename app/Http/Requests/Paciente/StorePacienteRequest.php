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
      'observacion' => 'nullable|string|max:500',
    ];
  }

  public function attributes()
  {
    return [
      'nombre' => 'nombre',
      'apellido' => 'apellido',
      'fecha_nac' => 'fecha de nacimiento',
      'representante_id' => 'representante',
      'tipo_vivienda' => 'tipo de vivienda',
      'cantidad_habitaciones' => 'cantidad de habitaciones',
      'cantidad_personas' => 'cantidad de personas',
      'servecio_agua_potable' => 'servicio de agua potable',
      'servecio_gas' => 'servicio de gas',
      'servecio_electricidad' => 'servicio de electricidad',
      'servecio_drenaje' => 'servicio de drenaje',
      'disponibilidad_internet' => 'disponibilidad de internet',
      'tipo_conexion_internet' => 'tipo de conexión a internet',
      'acceso_servcios_publicos' => 'acceso a servicios públicos',
      'fuente_ingreso_familiar' => 'fuente de ingreso familiar',
      'familiares' => 'familiares',
      'familiares.*.nombre' => 'nombre del familiar',
      'familiares.*.apellido' => 'apellido del familiar',
      'familiares.*.fecha_nac' => 'fecha de nacimiento del familiar',
      'familiares.*.parentesco' => 'parentesco del familiar',
      'familiares.*.discapacidad' => 'discapacidad del familiar',
      'familiares.*.tipo_discapacidad' => 'tipo de discapacidad del familiar',
      'familiares.*.enfermedad_cronica' => 'enfermedad crónica del familiar',
      'familiares.*.tipo_enfermedad' => 'tipo de enfermedad del familiar',
      'observacion' => 'observación',
    ];
  }
}
