<?php

namespace App\Http\Requests\Secretaria;

use Illuminate\Foundation\Http\FormRequest;

class StoreSecretariaRequest extends FormRequest
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
      'ci' => [
        'required',
        'string',
        'max:30',
        'unique:secretarias,ci'
      ],
      'fecha_nac' => ['required', 'date', 'max:10'],
      'grado' => ['required', 'string', 'max:120'],
      'telefono' => [
        'required',
        'string',
        'max:12',
        'unique:secretarias,telefono'
      ],
      'email' => [
        'required',
        'string',
        'email',
        'max:255',
        'unique:secretarias,email',
        'unique:users,email'
      ],
      'genero_id' => ['required', 'exists:generos,id'],
      'estado_id' => ['required', 'exists:estados,id'],
      'municipio_id' => ['required', 'exists:municipios,id'],
      'parroquia_id' => ['required', 'exists:parroquias,id'],
      'sector' => ['required', 'string', 'min:10', 'max:150'],
    ];
  }

  public function attributes()
  {
    return [
      'nombre' => 'nombre',
      'apellido' => 'apellido',
      'ci' => 'cédula de identidad',
      'fecha_nac' => 'fecha de nacimiento',
      'grado' => 'grado',
      'telefono' => 'teléfono',
      'email' => 'correo electrónico',
      'genero_id' => 'género',
      'estado_id' => 'estado',
      'municipio_id' => 'municipio',
      'parroquia_id' => 'parroquia',
      'sector' => 'sector',
    ];
  }
}
