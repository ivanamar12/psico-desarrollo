<?php

namespace App\Http\Requests\Especialista;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEspecialistaRequest extends FormRequest
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
      'ci' => [
        'required',
        'string',
        'max:255',
        'unique:especialistas,ci,' . $this->route('especialista')->id
      ],
      'fecha_nac' => ['required', 'date', 'max:10'],
      'especialidad_id' => ['required', 'exists:especialidads,id'],
      'telefono' => [
        'required',
        'string',
        'max:255',
        'unique:especialistas,telefono,' . $this->route('especialista')->id
      ],
      'email' => [
        'required',
        'string',
        'email',
        'max:255',
        'unique:especialistas,email,' . $this->route('especialista')->id,
        'unique:users,email,' . $this->route('especialista')->user_id
      ],
      'fvp' => ['required', 'string', 'max:255'],
      'genero_id' => ['required', 'exists:generos,id'],
      'estado_id' => ['required', 'exists:estados,id'],
      'municipio_id' => ['required', 'exists:municipios,id'],
      'parroquia_id' => ['required', 'exists:parroquias,id'],
      'sector' => ['required', 'string', 'min:10', 'max:80'],
    ];
  }

  public function attributes()
  {
    return [
      'nombre' => 'nombre',
      'apellido' => 'apellido',
      'ci' => 'cédula de identidad',
      'fecha_nac' => 'fecha de nacimiento',
      'especialidad_id' => 'especialidad',
      'telefono' => 'teléfono',
      'email' => 'correo electrónico',
      'fvp' => 'número FPV',
      'genero_id' => 'género',
      'estado_id' => 'estado',
      'municipio_id' => 'municipio',
      'parroquia_id' => 'parroquia',
      'sector' => 'sector',
    ];
  }
}
