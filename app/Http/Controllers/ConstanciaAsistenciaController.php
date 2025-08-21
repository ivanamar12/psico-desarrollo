<?php

namespace App\Http\Controllers;

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

  public function store(Request $request)
  {
    $request->validate([
      'paciente_id'         => 'required|exists:pacientes,id',
      'especialista_id'     => 'required|exists:especialistas,id',
      'citas_seleccionadas' => 'required|string',
    ]);

    $citasId = json_decode($request->input('citas_seleccionadas'));

    if (json_last_error() !== JSON_ERROR_NONE) {
      return back()->withErrors(['citas_seleccionadas' => 'Formato de JSON inválido.']);
    }

    Carbon::setLocale('es');
    $now = Carbon::now();

    $pdf = Pdf::loadView('pdf.constancia-asistencia', [
      'paciente' => Paciente::find($request->paciente_id),
      'especialista' => Especialista::find($request->especialista_id),
      'citas' => Cita::whereIn('id', $citasId)->get(),
      'constancia' => [
        'issueDate' => Carbon::parse($now)->isoFormat('DD \d\e MMMM \d\e YYYY'),
        'issueDateLong' => $now->day === 1
          ? "al primer día" : "a los {$now->day} días" . " del mes de {$now->monthName} del año {$now->year}"
      ]
    ])
      ->setPaper('letter', 'portrait');

    return $pdf->stream();
  }
}
