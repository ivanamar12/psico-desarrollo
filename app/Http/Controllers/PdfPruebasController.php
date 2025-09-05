<?php

namespace App\Http\Controllers;

use App\Models\AplicacionPrueba;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfPruebasController extends Controller
{
  public function reportCumanin($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'especialista.user'])
      ->findOrFail($id);

    $datos = json_decode($aplicacion->resultados_finales, true);
    $resultados = $datos['resultados'] ?? [];

    // Convertir percentiles strings a números
    foreach ($resultados as $key => &$resultado) {
      if (isset($resultado['percentil']) && is_numeric($resultado['percentil'])) {
        $resultado['percentil'] = (int)$resultado['percentil'];
      } else {
        $resultado['percentil'] = 0;
      }
    }

    $pdf = Pdf::loadView('pdf.report-cumanin', compact('aplicacion', 'datos', 'resultados'))
      ->setPaper('a4', 'portrait');

    return $pdf->stream("resultados_cumanin_{$aplicacion->paciente->nombre}_{$aplicacion->created_at->format('Y-m-d')}.pdf");
  }

  // public function reportCumanin($id)
  // {
  //   $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'user'])
  //     ->findOrFail($id);

  //   $paciente = $aplicacion->paciente;
  //   if (!$paciente) {
  //     return response()->json(['error' => 'Paciente no encontrado'], 404);
  //   }

  //   $especialista = $aplicacion->especialista;
  //   if (!$especialista) {
  //     return response()->json(['error' => 'Especialista no encontrado'], 404);
  //   }

  //   $datos = json_decode($aplicacion->resultados_finales, true);
  //   $resultados = $datos['resultados'] ?? [];

  //   // Generar el PDF
  //   $pdf = Pdf::loadView('pdf.report-cumanin', compact('aplicacion', 'datos', 'resultados', 'paciente', 'usuario'))
  //     ->setPaper('a4', 'portrait');

  //   // Definir la ruta donde se guardará el PDF
  //   $pdfPath = storage_path("app/public/resultados/resultados_{$id}.pdf");

  //   // Guardar el PDF en el servidor
  //   $pdf->save($pdfPath);

  //   // Devolver el PDF para descarga
  //   return $pdf->download("resultados_cumanin_{$paciente->nombre}_{$aplicacion->created_at->format('Y-m-d')}.pdf");
  // }

  public function reportKoppitz($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'user'])
      ->findOrFail($id);

    $paciente = $aplicacion->paciente;
    if (!$paciente) {
      return response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    $especialista = $aplicacion->especialista;
    if (!$especialista) {
      return response()->json(['error' => 'Especialista no encontrado'], 404);
    }

    $respuestasAplicacion = json_decode($aplicacion->resultados, true);
    $respuestasItems = $respuestasAplicacion['Dibujo de Figura Humana']['respuestas'] ?? [];

    $datos = json_decode($aplicacion->resultados_finales, true);
    $resultados = $datos['resultados'] ?? [];

    $itemsSi = [];
    $itemsNo = [];

    foreach ($respuestasItems as $item => $respuesta) {
      if ($respuesta === "si") {
        $itemsSi[] = $item;
      } else {
        $itemsNo[] = $item;
      }
    }

    // Generar el PDF
    $pdf = Pdf::loadView('pdf.report-koppitz', compact(
      'aplicacion',
      'datos',
      'resultados',
      'paciente',
      'usuario',
      'itemsSi',
      'itemsNo'
    ))
      ->setPaper('a4', 'portrait');

    // Definir la ruta donde se guardará el PDF
    $pdfPath = storage_path("app/public/resultados/resultados_{$id}.pdf");

    // Guardar el PDF en el servidor
    $pdf->save($pdfPath);

    // Devolver el PDF para descarga
    return $pdf->download("resultados_koppitz_{$paciente->nombre}_{$aplicacion->created_at->format('Y-m-d')}.pdf");
  }

  public function reportNoEstandarizada($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'user'])
      ->findOrFail($id);

    $paciente = $aplicacion->paciente;
    if (!$paciente) {
      return response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    $especialista = $aplicacion->especialista;
    if (!$especialista) {
      return response()->json(['error' => 'Especialista no encontrado'], 404);
    }

    $datos = json_decode($aplicacion->resultados_finales, true);
    $resultados = $datos['resultados'] ?? [];

    // Generar el PDF
    $pdf = Pdf::loadView('pdf.report-no-estandarizada', compact('aplicacion', 'datos', 'resultados', 'paciente', 'usuario'))
      ->setPaper('a4', 'portrait');

    // Definir la ruta donde se guardará el PDF
    $pdfPath = storage_path("app/public/resultados/resultados_{$id}.pdf");

    // Guardar el PDF en el servidor
    $pdf->save($pdfPath);

    // Devolver el PDF para descarga
    return $pdf->download("resultados_no_estandarizada_{$paciente->nombre}_{$aplicacion->created_at->format('Y-m-d')}.pdf");
  }
}
