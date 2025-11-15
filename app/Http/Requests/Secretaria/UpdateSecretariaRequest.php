<?php

namespace App\Http\Requests\Secretaria;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSecretariaRequest extends FormRequest
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
        'unique:secretarias,ci,' . $this->route('secretaria')->id
      ],
      'fecha_nac' => ['required', 'date', 'max:10'],
      'grado' => ['required', 'string', 'max:120'],
      'telefono' => [
        'required',
        'string',
        'max:12',
        'unique:secretarias,telefono,' . $this->route('secretaria')->id
      ],
      'email' => [
        'required',
        'string',
        'email',
        'max:255',
        'unique:secretarias,email,' . $this->route('secretaria')->id,
        'unique:users,email,' . $this->route('secretaria')->user_id
      ],
      'genero_id' => ['required', 'exists:generos,id'],
      'estado_id' => ['required', 'exists:estados,id'],
      'municipio_id' => ['required', 'exists:municipios,id'],
      'parroquia_id' => ['required', 'exists:parroquias,id'],
      'sector' => ['required', 'string', 'min:10', 'max:150'],
    ];
  }
}
