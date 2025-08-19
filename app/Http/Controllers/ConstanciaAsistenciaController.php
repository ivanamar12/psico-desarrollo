<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ConstanciaAsistenciaController extends Controller
{
  public function index(): View
  {
    return view('constancias-asistencia.index');
  }
}
