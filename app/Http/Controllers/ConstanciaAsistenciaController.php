<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConstanciaAsistencia\StoreConstanciaRequest;
use App\Models\Cita;
use App\Models\Especialista;
use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ConstanciaAsistenciaController extends Controller
{
  public function index(): View
  {
    $especialista = Especialista::where('user_id', Auth::id())->first();
    $pacientes = Paciente::with(['citas' => function ($q) {
      $q->where('status', 'asistio');
    }])->get();

    return view('constancias-asistencia.index', [
      'especialista' => $especialista,
      'pacientes' => $pacientes
    ]);
  }

  public function store(StoreConstanciaRequest $request)
  {
    Carbon::setLocale('es');
    $now = Carbon::now();

    $citasId = json_decode($request->input('citas_seleccionadas'));
    if (json_last_error() !== JSON_ERROR_NONE) return back()->withErrors(['citas_seleccionadas' => 'Formato de JSON inválido.']);

    $citas = Cita::whereIn('id', $citasId)->get();
    $citasByYear = $citas->groupBy(fn($cita) => Carbon::parse($cita->fecha_consulta)->year);

    $pdf = Pdf::loadView('pdf.constancia-asistencia', [
      'paciente' => Paciente::find($request->paciente_id),
      'especialista' => Especialista::find($request->especialista_id),
      'citas' => $citasByYear,
      'constancia' => [
        'issueDate' => format_long_date($now),
        'issueDateLong' => $now->day === 1
          ? "al primer día"
          : "a los {$now->day} días" . " del mes de {$now->monthName} del año {$now->year}"
      ]
    ])
      ->setPaper('letter', 'portrait');

    return $pdf->stream();
  }
}
