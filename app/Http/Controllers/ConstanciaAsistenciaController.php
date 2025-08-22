<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConstanciaAsistencia\StoreConstanciaRequest;
use App\Models\Cita;
use App\Models\Especialista;
use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ConstanciaAsistenciaController extends Controller
{
  public function index(): View
  {
    $especialista = Especialista::where('user_id', Auth::id())->first();

    $pacientes =  Paciente::with(['citas' => function ($q) use ($especialista) {
      $q->where('status', 'asistio');
      if ($especialista) {
        $q->where('especialista_id', $especialista->id);
      }
    }, 'historiaclinicas'])->get();

    return view('constancias-asistencia.index', [
      'especialista' => $especialista,
      'pacientes' => $pacientes
    ]);
  }

  public function store(StoreConstanciaRequest $request)
  {
    try {
      Carbon::setLocale('es');
      $now = Carbon::now();

      $citasId = json_decode($request->input('citas_seleccionadas'));
      if (json_last_error() !== JSON_ERROR_NONE) return back()->withErrors(['citas_seleccionadas' => 'Formato de JSON inválido.']);

      $citas = Cita::whereIn('id', $citasId)->get();
      $paciente = Paciente::find($request->paciente_id);

      $citasGrouped = $citas->groupBy(fn($cita) => Carbon::parse($cita->fecha_consulta)->year)
        ->map(
          fn($year, $key) =>
          $year->groupBy(fn($cita) => Carbon::parse($cita->fecha_consulta)->monthName)
            ->map(
              fn($month, $key) =>
              $month->map(fn($cita) => $cita->fecha_consulta = Carbon::parse($cita->fecha_consulta)->day)
                ->join(', ', ' y ') . " de $key"
            )->join(', ', ', y ') . " del año $key"
        )->join('. ');

      $pdf = Pdf::loadView('pdf.constancia-asistencia', [
        'paciente' => [
          'nombre_edad' => "{$paciente->nombre} {$paciente->apellido} de {$paciente->tiempo_transcurrido} de edad",
          'modalidad_educacion' => $paciente->historiaclinicas[0]->historiaEscolar->modalidad_educacion,
          'nombre_escuela' => $paciente->historiaclinicas[0]->historiaEscolar->nombre_escuela
        ],
        'especialista' => Especialista::find($request->especialista_id),
        'citas' => $citasGrouped,
        'constancia' => [
          'issueDate' => format_long_date($now),
          'issueDateLong' => get_formal_date($now)
        ]
      ])
        ->setPaper('letter', 'portrait');

      return $pdf->stream();
    } catch (\Exception $e) {
      return back()->withErrors(['citas_seleccionadas' => 'Error al generar reporte.']);
    }
  }
}
