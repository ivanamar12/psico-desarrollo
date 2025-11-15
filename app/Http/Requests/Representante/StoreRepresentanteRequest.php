<?php

namespace App\Http\Requests\Representante;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepresentanteRequest extends FormRequest
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
        'unique:representantes,ci'
      ],
      'telefono' => [
        'required',
        'string',
        'max:12',
        'unique:representantes,telefono'
      ],
      'email' => [
        'required',
        'string',
        'email',
        'max:255',
        'unique:representantes,email',
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
