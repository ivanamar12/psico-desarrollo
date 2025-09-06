<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Resultados Prueba No Estandarizada</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      font-size: 14px;
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
      width: 48%;
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

    /* Estilos específicos para PDF */
    @media print {
      .container {
        page-break-inside: avoid;
      }

      .table-container {
        width: 48% !important;
      }
    }
  </style>
</head>

<body>
  <!-- Header -->
  <div style="background-color: #00869b; color: white; text-align: center; padding: 15px 0; margin-bottom: 20px;">
    <img src="{{ public_path('img/logo.png') }}" alt="Logo de PSICODESARROLLO"
      style="width: 70px; height: 70px; border-radius: 50%; border: 2px solid #fff; margin-bottom: 3px">
    <h1 style="margin: 0; font-size: 20px;">PSICODESARROLLO</h1>
  </div>

  <!-- Contenido principal -->
  <div class="content-wrapper">
    <div class="header-content">
      <div style="text-align: center;margin-top: 30px;font-size: 12px;color: #666;">
        Fecha: {{ date('d/m/Y g:i A') }}
      </div>
      <h1>EVALUACIÓN NO ESTANDARIZADA</h1>
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

    <!-- Resultados -->
    <h3>Resultados</h3>
    <table>
      <thead>
        <tr>
          <th>Area de Desarrollo</th>
          <th>Ítem</th>
          <th>Respuesta</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($resultados as $subescala => $datosSubescala)
          @foreach ($datosSubescala['respuestas'] as $item => $respuesta)
            <tr>
              <td>{{ $subescala }}</td>
              <td>{{ $item }}</td>
              <td>{{ $respuesta }}</td>
            </tr>
          @endforeach
        @endforeach
      </tbody>
    </table>

    <!-- Interpretación de Resultados -->
    <table class="summary-table">
      <tr>
        <th>INTERPRETACIÓN DE RESULTADOS</th>
      </tr>
      <tr>
        <td>
          <strong>Observaciones:</strong>
          {{ $datosFinales['observaciones'] }}
        </td>
      </tr>
    </table>
  </div>

  <!-- Footer -->
  <div style="background-color: #00869b; color: white; text-align: center; padding: 10px 0;">
    <p style="margin: 0;">© PSICODESARROLLO {{ now()->year }} • Av. Principal, Edificio XYZ • Teléfono: 0212-5555555
    </p>
  </div>

</body>

</html>
