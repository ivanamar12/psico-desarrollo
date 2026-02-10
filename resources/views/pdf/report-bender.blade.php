<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Resultados Prueba Bender - Integración Visomotriz</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      font-size: 12px;
    }

    .content-wrapper {
      max-width: 900px;
      margin: 0 auto;
      background: white;
      padding: 16px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1,
    h2,
    h3 {
      text-align: center;
    }

    .container {
      display: flex;
      justify-content: space-between;
      margin: 20px 0;
      width: 100%;
    }

    .table-container {
      width: 100%;
      box-sizing: border-box;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 10px 0;
      table-layout: fixed;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 6px;
      text-align: left;
      word-wrap: break-word;
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    .summary-table {
      width: 100%;
      margin: 20px 0;
    }

    .header-content {
      text-align: center;
      margin-bottom: 20px;
    }

    .page-break {
      page-break-before: always;
    }

    /* Estilos específicos para PDF */
    @media print {
      .container {
        page-break-inside: avoid;
      }

      .table-container {
        width: 100% !important;
      }

      .no-break {
        page-break-inside: avoid;
      }
    }
  </style>
</head>

<body>
  <!-- Header -->
  <div style="background-color: #8e44ad; color: white; text-align: center; padding: 15px 0; margin-bottom: 20px;">
    <img src="{{ public_path('img/logo.png') }}" alt="Logo de PSICODESARROLLO"
      style="width: 70px; height: 70px; border-radius: 50%; border: 2px solid #fff; margin-bottom: 3px">
    <h1 style="margin: 0; font-size: 20px;">PSICODESARROLLO</h1>
  </div>

  <!-- Contenido principal -->
  <div class="content-wrapper">
    <div class="header-content">
      <div style="text-align: center;margin-top: 30px;font-size: 11px;color: #666;">
        Fecha: {{ date('d/m/Y g:i A') }}
      </div>
      <h1>EVALUACIÓN BENDER - INTEGRACIÓN VISOMOTRIZ</h1>
      <h2>Resultados de la Aplicación</h2>
    </div>

    <!-- Datos del Paciente y Evaluación -->
    <table>
      <tr>
        <th colspan="2">INFORMACIÓN GENERAL</th>
      </tr>
      <tr>
        <td><strong>Paciente:</strong> {{ $aplicacion->paciente->nombre }} {{ $aplicacion->paciente->apellido }}</td>
        <td><strong>Edad:</strong> {{ $datosFinales['edad_meses'] ?? 'N/A' }} meses</td>
      </tr>
      <tr>
        <td><strong>Fecha:</strong> {{ $aplicacion->created_at->format('d/m/Y') }}</td>
        <td><strong>Género:</strong> {{ $aplicacion->paciente->genero_id == 1 ? 'Masculino' : 'Femenino' }}</td>
      </tr>
      <tr>
        <td><strong>Evaluador:</strong> {{ $aplicacion->especialista->user->name }}</td>
        <td><strong>Prueba:</strong> {{ $aplicacion->prueba->nombre }}</td>
      </tr>
    </table>

    <!-- Resumen de Resultados -->
    <table class="summary-table">
      <tr>
        <th colspan="4">RESUMEN DE RESULTADOS</th>
      </tr>
      <tr>
        <td><strong>Puntaje de Desarrollo:</strong></td>
        <td style="font-weight: bold; font-size: 14px;">
          {{ $resultados['puntaje_desarrollo'] ?? 'N/A' }}
        </td>
        <td><strong>Indicadores Significativos:</strong></td>
        <td
          style="font-weight: bold;
          color: {{ ($resultados['indicadores_significativos'] ?? 0) > 3 ? '#e74c3c' : '#27ae60' }};">
          {{ $resultados['indicadores_significativos'] ?? 'N/A' }}
        </td>
      </tr>
      <tr>
        <td><strong>Altamente Significativos:</strong></td>
        <td
          style="font-weight: bold;
          color: {{ ($resultados['altamente_significativos'] ?? 0) > 2 ? '#e74c3c' : '#27ae60' }};">
          {{ $resultados['altamente_significativos'] ?? 'N/A' }}
        </td>
        <td><strong>Puntaje de Daño Cerebral:</strong></td>
        <td
          style="font-weight: bold;
          color: {{ ($resultados['puntaje_dano_cerebral'] ?? 0) >= 5 ? '#e74c3c' :
                   (($resultados['puntaje_dano_cerebral'] ?? 0) >= 3 ? '#f39c12' : '#27ae60') }};">
          {{ $resultados['puntaje_dano_cerebral'] ?? 'N/A' }}
        </td>
      </tr>
    </table>

    <!-- Detalles por Figura -->
    <div class="no-break">
      <h3 style="text-align: center; color: #2c3e50; margin: 25px 0 15px 0;">
        DETALLES POR FIGURA
      </h3>

      @foreach($figurasDetalles as $subescala => $datosFigura)
        <div style="margin-bottom: 25px; border: 1px solid #ddd; padding: 15px; border-radius: 5px;">
          <h4 style="background-color: #3498db; color: white; padding: 8px; border-radius: 3px; margin: 0 0 10px 0;">
            {{ $subescala }}
          </h4>

          <!-- Ítems de esta figura -->
          <table style="margin-bottom: 10px;">
            <thead>
              <tr>
                <th style="width: 60%;">Ítem</th>
                <th style="width: 15%;">Respuesta</th>
                <th style="width: 25%;">Tipo</th>
              </tr>
            </thead>
            <tbody>
              @foreach($datosFigura['items'] as $item)
                <tr>
                  <td>{{ $item['item'] }}</td>
                  <td style="text-align: center; font-weight: bold;
                    color: {{ $item['respuesta'] == 'si' ? '#27ae60' : '#e74c3c' }};">
                    {{ strtoupper($item['respuesta']) }}
                  </td>
                  <td style="text-align: center;">
                    @if($item['es_altamente_significativo'])
                      <span style="color: #e74c3c; font-weight: bold;">Altamente Significativo</span>
                    @elseif($item['es_indicador_significativo'])
                      <span style="color: #f39c12; font-weight: bold;">Significativo</span>
                    @else
                      <span style="color: #7f8c8d;">Regular</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Observaciones de esta figura -->
          <div style="background-color: #f9f9f9; padding: 10px; border-left: 4px solid #3498db; margin-top: 10px;">
            <strong>Observaciones {{ $subescala }}:</strong>
            {{ $datosFigura['observaciones'] ?? 'Sin observaciones específicas' }}
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Footer -->
  <div style="background-color: #8e44ad; color: white; text-align: center; padding: 10px 0; margin-top: 30px;">
    <p style="margin: 0; font-size: 11px;">
      © PSICODESARROLLO {{ now()->year }} • Evaluación Neuropsicológica Infantil • www.psicodesarrollo.com
    </p>
  </div>

</body>

</html>
