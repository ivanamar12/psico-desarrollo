<?php

namespace App\Http\Requests\Especialista;

use Illuminate\Foundation\Http\FormRequest;

class StoreEspecialistaRequest extends FormRequest
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
      'nombre' => ['required', 'string', 'max:255'],
      'apellido' => ['required', 'string', 'max:255'],
      'ci' => ['required', 'string', 'max:255'],
      'fecha_nac' => ['required', 'date', 'max:10'],
      'especialidad_id' => ['required', 'string', 'max:255'],
      'telefono' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:especialistas,email', 'unique:users,email'],
      'fvp' => ['required', 'string', 'max:255'],
      'genero_id' => ['required', 'exists:generos,id'],
      'estado_id' => ['required', 'exists:estados,id'],
      'municipio_id' => ['required', 'exists:municipios,id'],
      'parroquia_id' => ['required', 'exists:parroquias,id'],
      'sector' => ['required', 'string', 'max:255'],
    ];
  }
}
