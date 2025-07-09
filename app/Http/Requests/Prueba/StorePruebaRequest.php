<?php

namespace App\Http\Requests\Prueba;

use Illuminate\Foundation\Http\FormRequest;

class StorePruebaRequest extends FormRequest
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
      'nombre' => 'required|string|max:255',
      'descripcion' => 'required|string|max:600',
      'area_desarrollo' => 'required|string|max:255',
      'rango_edad' => 'required|string|max:255',
      'items' => 'required|array',
      'items.*.nombre' => 'required|string|max:700',
    ];
  }
}
