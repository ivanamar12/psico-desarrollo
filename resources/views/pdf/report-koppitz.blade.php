<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Resultados Prueba Koppitz - Figura Humana</title>
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
      <h1>EVALUACIÓN KOPPITZ - FIGURA HUMANA</h1>
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
        <td><strong>Puntaje Total:</strong></td>
        <td>{{ $resultados['puntajeTotal'] ?? 'N/A' }}</td>

        <td><strong>Categoría:</strong></td>
        <td
          style="font-weight: bold; color: 
            @if (isset($resultados['categoria'])) @if ($resultados['categoria'] == 'Superior') #2ecc71
              @elseif($resultados['categoria'] == 'Normal alto') #27ae60
              @elseif($resultados['categoria'] == 'Normal') #f39c12
              @elseif($resultados['categoria'] == 'Normal bajo') #e67e22
              @elseif($resultados['categoria'] == 'Borderline') #e74c3c
              @elseif($resultados['categoria'] == 'Deficiente') #c0392b
              @else #000 @endif
            @endif">
          {{ $resultados['categoria'] ?? 'N/A' }}
        </td>
      </tr>
      <tr>
        <td><strong>Items Esperados:</strong></td>
        <td>{{ $resultados['itemsEsperados'] ?? 'N/A' }}</td>

        <td><strong>Items Excepcionales:</strong></td>
        <td>{{ $resultados['itemsExcepcionales'] ?? 'N/A' }}</td>
      </tr>
    </table>

    <!-- Contenedor para las tablas en paralelo -->
    <div class="container">
      <!-- Items Presentes (Sí) -->
      <div class="table-container">
        <h3 style="color: #27ae60; text-align: center;">PRESENTES - Items en el Dibujo</h3>
        <table>
          <thead>
            <tr>
              <th style="width: 15%;">#</th>
              <th style="width: 60%;">Item</th>
              <th style="width: 25%;">Tipo</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($itemsSi as $index => $item)
              @php
                $tipoItem = 'Esperado';
                if (isset($resultados['detallesPuntaje'][$item]['tipo'])) {
                    $tipoItem = $resultados['detallesPuntaje'][$item]['tipo'];
                }
              @endphp
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item }}</td>
                <td>{{ ucfirst($tipoItem) }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="3" style="text-align: center">Ninguno</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Items Ausentes (No) -->
      <div class="table-container">
        <h3 style="color: #e74c3c; text-align: center;">AUSENTES - Items en el Dibujo</h3>
        <table>
          <thead>
            <tr>
              <th style="width: 15%;">#</th>
              <th style="width: 60%;">Item</th>
              <th style="width: 25%;">Edad Esperada</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($itemsNo as $index => $item)
              @php
                $edadEsperada = 'N/A';
                if (isset($resultados['detallesPuntaje'][$item]['edad_rango'])) {
                    $edadEsperada = $resultados['detallesPuntaje'][$item]['edad_rango'];
                }
              @endphp
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item }}</td>
                <td>{{ $edadEsperada }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="3" style="text-align: center">Ninguno</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Interpretación de Resultados -->
    @if (isset($resultados['categoria']))
      <table class="summary-table">
        <tr>
          <th>INTERPRETACIÓN DE RESULTADOS</th>
        </tr>
        <tr>
          <td>
            <strong>Clasificación:</strong> {{ $resultados['categoria'] }}<br>
            @if ($resultados['categoria'] == 'Superior')
              El dibujo muestra características excepcionales para la edad, indicando un desarrollo muy avanzado.
            @elseif($resultados['categoria'] == 'Normal alto')
              El dibujo presenta un desarrollo por encima del promedio esperado para la edad.
            @elseif($resultados['categoria'] == 'Normal')
              El desarrollo gráfico se encuentra dentro de lo esperado para la edad.
            @elseif($resultados['categoria'] == 'Normal bajo')
              El dibujo muestra algunas características por debajo del promedio esperado.
            @elseif($resultados['categoria'] == 'Borderline')
              Se observan dificultades significativas en el desarrollo gráfico.
            @elseif($resultados['categoria'] == 'Deficiente')
              El dibujo refleja serias dificultades en el desarrollo gráfico-motor.
            @endif
          </td>
        </tr>
      </table>
    @endif

    <!-- Interpretación de Resultados -->
    @if (isset($datosFinales['observaciones']))
      <table class="summary-table">
        <tr>
          <th>OBSERVACIONES</th>
        </tr>
        <tr>
          <td>
            {{ $datosFinales['observaciones'] }}
          </td>
        </tr>
      </table>
    @endif
  </div>

  <!-- Footer -->
  <div style="background-color: #00869b; color: white; text-align: center; padding: 10px 0;">
    <p style="margin: 0;">© PSICODESARROLLO {{ now()->year }} • Av. Principal, Edificio XYZ • Teléfono: 0212-5555555
    </p>
  </div>

</body>

</html>
