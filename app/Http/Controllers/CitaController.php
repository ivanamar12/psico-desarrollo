<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Especialista;
use App\Models\Cita;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class CitaController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      if ($request->input('currentDate')) {
        $currentDate = $request->input('currentDate');
        $citasDelDia = DB::select("
                    SELECT citas.*, especialistas.nombre AS especialista_nombre, especialistas.apellido AS especialista_apellido, pacientes.nombre AS paciente_nombre, pacientes.apellido AS paciente_apellido
                    FROM citas
                    LEFT JOIN especialistas ON citas.especialista_id = especialistas.id
                    LEFT JOIN pacientes ON citas.paciente_id = pacientes.id
                    WHERE DATE(citas.fecha_consulta) = '$currentDate'
                ");

        return DataTables::of($citasDelDia)
          ->addColumn('especialista', function ($cita) {
            return $cita->especialista_nombre . ' ' . $cita->especialista_apellido;
          })
          ->addColumn('paciente', function ($cita) {
            return $cita->paciente_nombre . ' ' . $cita->paciente_apellido;
          })
          ->addColumn('action', function ($cita) {
            $acciones = '<a href="' . route('pdf.generarPdfCita', $cita->id) . '" class="btn btn-primary btn-raised btn-xs"><i class="zmdi zmdi-file-text"></i> Generar PDF</a>'; // Botón para generar PDF
            return $acciones;
          })
          ->rawColumns(['action'])
          ->make(true);
      }

      $todasLasCitas = DB::select("
                SELECT citas.*, especialistas.nombre AS especialista_nombre, especialistas.apellido AS especialista_apellido, pacientes.nombre AS paciente_nombre, pacientes.apellido AS paciente_apellido
                FROM citas
                LEFT JOIN especialistas ON citas.especialista_id = especialistas.id
                LEFT JOIN pacientes ON citas.paciente_id = pacientes.id
            ");

      return DataTables::of($todasLasCitas)
        ->addColumn('especialista', function ($cita) {
          return $cita->especialista_nombre . ' ' . $cita->especialista_apellido;
        })
        ->addColumn('paciente', function ($cita) {
          return $cita->paciente_nombre . ' ' . $cita->paciente_apellido;
        })
        ->addColumn('action', function ($cita) {
          $acciones = '<a href="' . route('pdf.generarPdfCita', $cita->id) . '" class="btn btn-primary btn-raised btn-xs"><i class="zmdi zmdi-file-text"></i>PDF</a>';
          return $acciones;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    $especialistas = Especialista::all();
    $pacientes = Paciente::all();

    // Obtener conteo de citas
    $citasCount = Cita::count();
    $citasHoyCount = Cita::whereDate('fecha_consulta', now()->format('Y-m-d'))->count();

    return view('citas.index', [
      'especialistas' => $especialistas,
      'pacientes' => $pacientes,
      'citasCount' => $citasCount,
      'citasHoyCount' => $citasHoyCount
    ]);
  }

  public function indexWeb()
  {
    $citas = Cita::all();
    return response()->json($citas);
  }

  public function store(Request $request)
  {
    try {
      $request->validate([
        'paciente_id' => 'required|exists:pacientes,id',
        'especialista_id' => 'required|exists:especialistas,id',
        'fecha' => 'required|date',
        'hora' => 'required|string',
      ]);

      $status = 'pendiente';
      $cita = Cita::create([
        'paciente_id' => $request->paciente_id,
        'especialista_id' => $request->especialista_id,
        'fecha_consulta' => $request->fecha,
        'hora' => $request->hora,
        'status' => $status,
      ]);

      return response()->json(['message' => 'Cita creada con éxito', 'cita' => $cita]);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Error al crear la cita: ' . $e->getMessage()], 500);
    }
  }

  public function edit($id)
  {
    try {
      $cita = Cita::with(['paciente.representante', 'especialista'])->findOrFail($id);
      return response()->json([
        'id' => $cita->id,
        'hora' => $cita->hora,
        'paciente_nombre' => $cita->paciente->nombre . ' ' . $cita->paciente->apellido,
        'especialista_nombre' => $cita->especialista->nombre . ' ' . $cita->especialista->apellido,
        'representante_nombre' => $cita->paciente->representante
          ? $cita->paciente->representante->nombre . ' ' . $cita->paciente->representante->apellido
          : 'No registrado',
        'status' => $cita->status,
      ]);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Cita no encontrada'], 404);
    }
  }

  public function update(Request $request, $id)
  {
    try {
      $request->validate([
        'status' => 'required|string|in:confirmada,cancelada,asistio,no asistio',
      ]);
      $cita = Cita::findOrFail($id);

      $cita->status = $request->status;
      $cita->save();

      return response()->json(['message' => 'Estado de la cita actualizado con éxito']);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Error al actualizar el estado de la cita: ' . $e->getMessage()], 500);
    }
  }

  public function generarPdfTodasLasCitas(Request $request)
  {
    $citas = Cita::with(['paciente', 'especialista'])->get();

    if ($citas->isEmpty()) {
      return response()->json(['error' => 'No hay citas disponibles'], 404);
    }

    $pdf = PDF::loadView('pdf.citas', compact('citas'));
    return $pdf->download('citas.pdf');
  }

  public function citasDeHoy(Request $request)
  {
    $fechaHoy = now()->format('Y-m-d');

    $citas = Cita::with(['paciente', 'especialista'])
      ->whereDate('fecha_consulta', $fechaHoy)
      ->get();

    if ($citas->isEmpty()) {
      return response()->json(['error' => 'No hay citas disponibles para hoy'], 404);
    }

    $pdf = PDF::loadView('pdf.citas', compact('citas'));
    return $pdf->download('citas_de_hoy.pdf');
  }

  public function generarPdfCita($id)
  {
    $cita = Cita::with(['paciente.representante', 'especialista'])->find($id);

    if (!$cita) {
      return response()->json(['error' => 'Cita no encontrada'], 404);
    }

    $pdf = PDF::loadView('pdf.generarPdfCita', compact('cita'));
    return $pdf->download('cita_' . $id . '.pdf');
  }
}
