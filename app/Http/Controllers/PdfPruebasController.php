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

  public function reportKoppitz($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'especialista.user'])
      ->findOrFail($id);

    // Decodificar resultados
    $respuestasAplicacion = json_decode($aplicacion->resultados, true);
    $datosFinales = json_decode($aplicacion->resultados_finales, true);

    $respuestasItems = $respuestasAplicacion['Dibujo de Figura Humana']['respuestas'] ?? [];
    $resultados = $datosFinales['resultados'] ?? [];

    // Separar items por respuesta
    $itemsSi = [];
    $itemsNo = [];

    foreach ($respuestasItems as $item => $respuesta) {
      if ($respuesta === "si") {
        $itemsSi[] = $item;
      } else {
        $itemsNo[] = $item;
      }
    }

    $pdf = Pdf::loadView('pdf.report-koppitz', compact(
      'aplicacion',
      'datosFinales',
      'resultados',
      'itemsSi',
      'itemsNo'
    ))->setPaper('a4', 'portrait');

    return $pdf->stream("resultados_koppitz_{$aplicacion->paciente->nombre}_{$aplicacion->created_at->format('Y-m-d')}.pdf");
  }

  public function reportBender($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'especialista.user'])
      ->findOrFail($id);

    $datosFinales = json_decode($aplicacion->resultados_finales, true);
    $resultados = $datosFinales['resultados'] ?? [];

    $figurasDetalles = [];
    $detallesItems = $resultados['detalles_items'] ?? [];
    $observacionesPorSubescala = $resultados['observaciones_por_subescala'] ?? [];

    // Agrupar ítems por subescala
    foreach ($detallesItems as $item) {
      $subescala = $item['subescala'];

      if (!isset($figurasDetalles[$subescala])) {
        $figurasDetalles[$subescala] = [
          'items' => [],
          'observaciones' => $observacionesPorSubescala[$subescala] ?? 'Sin observaciones'
        ];
      }

      $figurasDetalles[$subescala]['items'][] = $item;
    }

    $pdf = Pdf::loadView('pdf.report-bender', compact(
      'aplicacion',
      'datosFinales',
      'resultados',
      'figurasDetalles'
    ))->setPaper('a4', 'portrait');

    return $pdf->stream("resultados_bender_{$aplicacion->paciente->nombre}_{$aplicacion->created_at->format('Y-m-d')}.pdf");
  }

  public function reportNoEstandarizada($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'especialista.user'])
      ->findOrFail($id);

    $datosFinales = json_decode($aplicacion->resultados_finales, true);
    $resultados = $datosFinales['resultados'] ?? [];

    $pdf = Pdf::loadView('pdf.report-no-estandarizada', compact('aplicacion', 'datosFinales', 'resultados'))
      ->setPaper('a4', 'portrait');

    return $pdf->stream("resultados_no_estandarizada_{$aplicacion->paciente->nombre}_{$aplicacion->created_at->format('Y-m-d')}.pdf");
  }

  // public function reportCumanin($id)
  // {
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
}
