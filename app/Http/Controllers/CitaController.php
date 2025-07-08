<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Paciente;
use App\Models\Especialista;
use App\Models\Cita;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CitaController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $query = Cita::with(['especialista', 'paciente'])
        ->select('citas.*')
        ->leftJoin('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
        ->leftJoin('pacientes', 'citas.paciente_id', '=', 'pacientes.id');

      if (auth()->user()->hasRole(Role::ESPECIALISTA->value)) {
        $especialistaId = Especialista::where('user_id', auth()->id())->value('id');
        $query->where('citas.especialista_id', $especialistaId);
      } elseif (auth()->user()->hasRole(Role::SECRETARIA->value)) {
        // Secretarias ven todas las citas pero con acciones limitadas
        // agregar filtros adicionales si se necesita
      }

      if ($request->input('currentDate')) {
        $currentDate = $request->input('currentDate');
        $query->whereDate('citas.fecha_consulta', $currentDate);
      }

      return DataTables::eloquent($query)
        ->addColumn('especialista', function ($cita) {
          return $cita->especialista->nombre . ' ' . $cita->especialista->apellido;
        })
        ->addColumn('paciente', function ($cita) {
          return $cita->paciente->nombre . ' ' . $cita->paciente->apellido;
        })
        ->addColumn('action', function ($cita) {
          $acciones = '<a href="' . route('pdf.generar-pdf-cita', $cita->id) . '" class="btn btn-primary btn-raised btn-xs"><i class="zmdi zmdi-file-text"></i> PDF</a>';
          return $acciones;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    $especialistas = Especialista::all();
    $pacientes = Paciente::all();

    $citasQuery = Cita::query();

    if (auth()->user()->hasRole(Role::ESPECIALISTA->value)) {
      $especialistaId = Especialista::where('user_id', auth()->id())->value('id');
      $citasQuery->where('especialista_id', $especialistaId);
    }

    $citasCount = $citasQuery->count();
    $citasHoyCount = $citasQuery->clone()->whereDate('fecha_consulta', now()->format('Y-m-d'))->count();

    return view('citas.index', [
      'especialistas' => $especialistas,
      'pacientes' => $pacientes,
      'citasCount' => $citasCount,
      'citasHoyCount' => $citasHoyCount,
    ]);
  }

  public function calendario()
  {
    $query = Cita::with(['especialista', 'paciente']);

    if (auth()->user()->hasRole(Role::ESPECIALISTA->value)) {
      $especialistaId = Especialista::where('user_id', auth()->id())->value('id');
      $query->where('especialista_id', $especialistaId);
    }

    $citas = $query->get();

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

  /**
   * Admin and secretary PDFs
   */

  public function generarPdfTodasLasCitas(Request $request)
  {
    try {
      $citas = Cita::with(['paciente', 'especialista'])
        ->orderBy('fecha_consulta', 'desc')
        ->orderBy('hora', 'desc')
        ->get();

      if ($citas->isEmpty()) {
        return redirect()->back()->with('error', 'No hay citas disponibles para generar PDF');
      }

      $pdf = Pdf::loadView('pdf.citas', ['citas' => $citas]);

      return $pdf->download('citas-generales-' . now()->format('Y-m-d') . '.pdf');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error al generar PDF: ' . $e->getMessage());
    }
  }

  public function citasDeHoy(Request $request)
  {
    try {
      $fechaHoy = now()->format('Y-m-d');

      $citas = Cita::with(['paciente', 'especialista'])
        ->whereDate('fecha_consulta', $fechaHoy)
        ->orderBy('hora', 'asc')
        ->get();

      if ($citas->isEmpty()) {
        return redirect()->back()->with('error', 'No hay citas disponibles para hoy');
      }

      $pdf = Pdf::loadView('pdf.citas', ['citas' => $citas]);

      return $pdf->download('citas-hoy-' . $fechaHoy . '.pdf');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error al generar PDF: ' . $e->getMessage());
    }
  }

  /**
   * Specialist PDFs
   */

  public function citasDeHoyEspecialista()
  {
    try {
      $especialista = Especialista::where('user_id', auth()->id())->first();
      $fechaHoy = now()->format('Y-m-d');

      if (!$especialista) {
        return redirect()->back()->with('error', 'Especialista no encontrado');
      }

      $citas = Cita::with(['paciente', 'especialista'])
        ->where('especialista_id', $especialista->id)
        ->whereDate('fecha_consulta', $fechaHoy)
        ->orderBy('hora', 'asc')
        ->get();

      $pdf = Pdf::loadView('pdf.citas-especialista', [
        'citas' => $citas,
        'nombreEspecialista' => $especialista->nombre . ' ' . $especialista->apellido,
        'fechaEspecifica' => 'Citas de hoy - ' . now()->format('d/m/Y')
      ]);

      return $pdf->download('mis-citas-hoy-' . $fechaHoy . '.pdf');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error al generar PDF: ' . $e->getMessage());
    }
  }

  public function citasEspecialista()
  {
    try {
      $especialista = Especialista::where('user_id', auth()->id())->first();

      if (!$especialista) {
        return redirect()->back()->with('error', 'Especialista no encontrado');
      }

      $citas = Cita::with(['paciente', 'especialista'])
        ->where('especialista_id', $especialista->id)
        ->orderBy('fecha_consulta', 'desc')
        ->orderBy('hora', 'desc')
        ->get();

      $pdf = Pdf::loadView('pdf.citas-especialista', [
        'citas' => $citas,
        'nombreEspecialista' => $especialista->nombre . ' ' . $especialista->apellido,
        'fechaEspecifica' => 'Historial completo - ' . now()->format('d/m/Y')
      ]);

      return $pdf->download('mis-citas-' . now()->format('Y-m-d') . '.pdf');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error al generar PDF: ' . $e->getMessage());
    }
  }

  public function generarPdfCita($id)
  {
    try {
      $cita = Cita::with(['paciente.representante', 'especialista'])->find($id);

      if (!$cita) {
        return response()->json(['error' => 'Cita no encontrada'], 404);
      }

      $pdf = Pdf::loadView('pdf.generarPdfCita', compact('cita'));

      return $pdf->download('cita-' . $id . '.pdf');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error al generar PDF: ' . $e->getMessage());
    }
  }
}
