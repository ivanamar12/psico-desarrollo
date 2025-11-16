<?php

namespace App\Http\Requests\Paciente;

use Carbon\Carbon;
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
      'nombre' => ['required', 'string', 'max:120'],
      'apellido' => ['required', 'string', 'max:120'],
      'fecha_nac' => [
        'required',
        'date',
        function ($attribute, $value, $fail) {
          $fechaNac = Carbon::parse($value);
          $edadMinima = now()->subMonths(3);
          $edadMaxima = now()->subYears(6)->subMonths(6);

          if ($fechaNac->gt($edadMinima)) {
            $fail('El paciente debe tener al menos 3 meses de edad.');
          }

          if ($fechaNac->lt($edadMaxima)) {
            $fail('El paciente no puede tener más de 6 años y medio de edad.');
          }
        },
      ],
      'representante_id' => ['required', 'exists:representantes,id'],
      'genero_id' => ['required', 'exists:generos,id'],
      'tipo_vivienda' => ['required', 'string', 'max:50'],
      'cantidad_habitaciones' => ['required', 'integer', 'min:1', 'max:20'],
      'cantidad_personas' => ['required', 'integer', 'min:1', 'max:50'],
      'servecio_agua_potable' => ['required', 'in:si,no'],
      'servecio_gas' => ['required', 'in:si,no'],
      'servecio_electricidad' => ['required', 'in:si,no'],
      'servecio_drenaje' => ['required', 'in:si,no'],
      'disponibilidad_internet' => ['required', 'in:si,no'],
      'tipo_conexion_internet' => ['nullable', 'string', 'max:100'],
      'acceso_servcios_publicos' => ['required', 'in:si,no'],
      'fuente_ingreso_familiar' => ['required', 'string', 'max:255'],
      'observacion' => ['nullable', 'string', 'max:500'],

      'familiares' => ['sometimes', 'array'],
      'familiares.*.nombre' => ['required', 'string', 'max:120'],
      'familiares.*.apellido' => ['required', 'string', 'max:120'],
      'familiares.*.fecha_nac' => ['required', 'date'],
      'familiares.*.parentesco' => ['required', 'string', 'max:120'],
      'familiares.*.discapacidad' => ['required', 'in:si,no'],
      'familiares.*.tipo_discapacidad' => ['nullable', 'required_if:familiares.*.discapacidad,si', 'string', 'max:120'],
      'familiares.*.enfermedad_cronica' => ['required', 'in:si,no'],
      'familiares.*.tipo_enfermedad' => ['nullable', 'required_if:familiares.*.enfermedad_cronica,si', 'string', 'max:120'],
      'familiares.*.genero_id' => ['required', 'exists:generos,id'],
    ];
  }

  public function attributes()
  {
    return [
      'nombre' => 'nombre',
      'apellido' => 'apellido',
      'fecha_nac' => 'fecha de nacimiento',
      'representante_id' => 'representante',
      'genero_id' => 'género',
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
      'observacion' => 'observación',

      'familiares.*.nombre' => 'nombre del familiar',
      'familiares.*.apellido' => 'apellido del familiar',
      'familiares.*.fecha_nac' => 'fecha de nacimiento del familiar',
      'familiares.*.parentesco' => 'parentesco del familiar',
      'familiares.*.discapacidad' => 'discapacidad del familiar',
      'familiares.*.tipo_discapacidad' => 'tipo de discapacidad del familiar',
      'familiares.*.enfermedad_cronica' => 'enfermedad crónica del familiar',
      'familiares.*.tipo_enfermedad' => 'tipo de enfermedad del familiar',
      'familiares.*.genero_id' => 'género del familiar',
    ];
  }

  public function messages()
  {
    return [
      'familiares.*.tipo_discapacidad.required_if' => 'El campo tipo de discapacidad es requerido cuando el familiar tiene discapacidad.',
      'familiares.*.tipo_enfermedad.required_if' => 'El campo tipo de enfermedad es requerido cuando el familiar tiene enfermedad crónica.',
    ];
  }
}
