<?php

namespace App\Http\Controllers;

use App\Models\AplicacionPrueba;
use App\Models\ResultadosPruebas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfPruebasController extends Controller
{

  public function generarPDFCumanin($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'user'])
      ->findOrFail($id);

    $paciente = $aplicacion->paciente;
    if (!$paciente) {
      return response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    $usuario = $aplicacion->user;
    if (!$usuario) {
      return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    $resultado = ResultadosPruebas::where('aplicacion_pruebas_id', $id)->first();
    if (!$resultado) {
      return response()->json(['error' => 'Resultados no encontrados'], 404);
    }

    $datos = json_decode($resultado->resultados_finales, true);
    $resultados = $datos['resultados'] ?? [];

    // Generar el PDF y guardarlo en el servidor
    $pdf = Pdf::loadView('pdf.resultados_cumanin', compact('aplicacion', 'datos', 'resultados', 'paciente', 'usuario'))
      ->setPaper('a4', 'portrait')
      ->output();

    // Definir la ruta donde se guardará el PDF
    $pdfPath = storage_path("app/public/resultados/resultados_{$id}.pdf");

    // Guardar el PDF en el servidor
    file_put_contents($pdfPath, $pdf);

    // Devolver la ruta del PDF guardado
    return $pdfPath;
  }

  public function generarPDFKoppitz($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'user'])
      ->findOrFail($id);

    $paciente = $aplicacion->paciente;
    if (!$paciente) {
      return response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    $usuario = $aplicacion->user;
    if (!$usuario) {
      return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    $respuestasAplicacion = json_decode($aplicacion->resultados, true);
    $respuestasItems = $respuestasAplicacion['Dibujo de Figura Humana']['respuestas'] ?? [];

    $resultado = ResultadosPruebas::where('aplicacion_pruebas_id', $id)->first();
    if (!$resultado) {
      return response()->json(['error' => 'Resultados no encontrados'], 404);
    }

    $datos = json_decode($resultado->resultados_finales, true);
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

    // Generar el PDF y guardarlo en el servidor
    $pdf = Pdf::loadView('pdf.resultados_koppitz', compact(
      'aplicacion',
      'datos',
      'resultados',
      'paciente',
      'usuario',
      'itemsSi',
      'itemsNo'
    ))
      ->setPaper('a4', 'portrait')
      ->output();

    // Definir la ruta donde se guardará el PDF
    $pdfPath = storage_path("app/public/resultados/resultados_{$id}.pdf");

    // Guardar el PDF en el servidor
    file_put_contents($pdfPath, $pdf);

    // Devolver la ruta del PDF guardado
    return $pdfPath;
  }

  public function generarPDFNoEstandarizada($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'user'])
      ->findOrFail($id);

    $paciente = $aplicacion->paciente;
    if (!$paciente) {
      return response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    $usuario = $aplicacion->user;
    if (!$usuario) {
      return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    $resultado = ResultadosPruebas::where('aplicacion_pruebas_id', $id)->first();
    if (!$resultado) {
      return response()->json(['error' => 'Resultados no encontrados'], 404);
    }

    $datos = json_decode($resultado->resultados_finales, true);
    $resultados = $datos['resultados'] ?? [];

    // Generar el PDF y guardarlo en el servidor
    $pdf = Pdf::loadView('pdf.resultados_no_estandarizada', compact('aplicacion', 'datos', 'resultados', 'paciente', 'usuario'))
      ->setPaper('a4', 'portrait')
      ->output();

    // Definir la ruta donde se guardará el PDF
    $pdfPath = storage_path("app/public/resultados/resultados_{$id}.pdf");

    // Guardar el PDF en el servidor
    file_put_contents($pdfPath, $pdf);

    // Devolver la ruta del PDF guardado
    return $pdfPath;
  }
}
