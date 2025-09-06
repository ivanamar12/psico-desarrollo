<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Resultados CUMANIN</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
    }

    h1,
    h2,
    h3 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th,
    td {
      border: 1px solid black;
      padding: 5px;
      text-align: center;
    }

    th {
      background-color: #f0f0f0;
    }

    .bold {
      font-weight: bold;
    }

    .footer {
      margin-top: 30px;
      text-align: center;
      font-size: 12px;
    }

    .content-container {
      max-width: 900px;
      margin: 0 auto;
      background: white;
      padding: 16px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      background-color: #00869b;
      color: white;
      text-align: center;
      padding: 15px 0;
      margin-bottom: 20px;
    }

    .header img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      border: 2px solid #fff;
      margin-bottom: 3px;
    }

    .footer-section {
      background-color: #00869b;
      color: white;
      text-align: center;
      padding: 10px 0;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <div class="header">
    <img src="{{ public_path('img/logo.png') }}" alt="Logo de PSICODESARROLLO">
    <h1 style="margin: 0; font-size: 20px;">PSICODESARROLLO</h1>
  </div>

  <!-- Contenido principal -->
  <div class="content-container">
    <div style="text-align: center;margin-top: 30px;font-size: 12px;color: #666;">
      Fecha: {{ date('d/m/Y g:i A') }}
    </div>
    <h1>PERFIL DE DESARROLLO CUMANIN</h1>
    <h2>Resultados de la Aplicación</h2>

    <!-- Datos del Paciente -->
    <table>
      <tr>
        <th colspan="3">INFORMACIÓN GENERAL</th>
      </tr>
      <tr>
        <td><strong>Paciente:</strong> {{ $aplicacion->paciente->nombre }} {{ $aplicacion->paciente->apellido }}</td>
        <td><strong>Edad:</strong> {{ $datos['edad_meses'] }} meses</td>
        <td><strong>Fecha:</strong> {{ $aplicacion->created_at->format('d/m/Y') }}</td>
      </tr>
      <tr>
        <td><strong>Especialista:</strong> {{ $aplicacion->especialista->user->name }}</td>
        <td><strong>Lateralidad:</strong> {{ $datos['lateralidad'] }}</td>
        <td><strong>Prueba:</strong> {{ $aplicacion->prueba->nombre }}</td>
      </tr>
    </table>

    <!-- Resultados por Subescala -->
    <h3>Resultados por Subescala</h3>
    <table>
      <thead>
        <tr>
          <th>Subescala</th>
          <th>Puntaje</th>
          <th>Percentil</th>
          <th>Interpretación</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($resultados as $area => $datosArea)
          <tr>
            <td>{{ $area }}</td>
            <td>{{ $datosArea['puntaje'] }}</td>
            <td>{{ $datosArea['percentil'] }}</td>
            <td>
              @php
                $percentil = intval($datosArea['percentil']);
                if ($percentil >= 75) {
                    echo 'Superior';
                } elseif ($percentil >= 25) {
                    echo 'Normal';
                } else {
                    echo 'Inferior';
                }
              @endphp
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <h3>Perfil Percentilar</h3>
    <table>
      <thead>
        <tr>
          <th style="white-space: nowrap;">Subescala</th>
          <th style="white-space: nowrap;font-size: 10px">1 - 10</th>
          <th style="white-space: nowrap;font-size: 10px">11 - 20</th>
          <th style="white-space: nowrap;font-size: 10px">21 - 30</th>
          <th style="white-space: nowrap;font-size: 10px">31 - 40</th>
          <th style="white-space: nowrap;font-size: 10px">41 - 50</th>
          <th style="white-space: nowrap;font-size: 10px">51 - 60</th>
          <th style="white-space: nowrap;font-size: 10px">61 - 70</th>
          <th style="white-space: nowrap;font-size: 10px">71 - 80</th>
          <th style="white-space: nowrap;font-size: 10px">81 - 90</th>
          <th style="white-space: nowrap;font-size: 10px">91 - 99</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($resultados as $area => $datosArea)
          <tr>
            <td>{{ $area }}</td>
            @php
              $percentil = (int) $datosArea['percentil'];
              $rangos = [
                  [1, 10],
                  [11, 20],
                  [21, 30],
                  [31, 40],
                  [41, 50],
                  [51, 60],
                  [61, 70],
                  [71, 80],
                  [81, 90],
                  [91, 99],
              ];
            @endphp

            @foreach ($rangos as $rango)
              <td>
                @if ($percentil >= $rango[0] && $percentil <= $rango[1])
                  <strong style="color: black;">X</strong>
                @else
                  <span style="color: lightgray;">O</span>
                @endif
              </td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Observaciones -->
    @if (!empty($resultados))
      <h3>Observaciones</h3>
      <table>
        @foreach ($resultados as $area => $datosArea)
          @if (!empty($datosArea['observaciones']) && $datosArea['observaciones'] != 'Sin observaciones')
            <tr>
              <td><strong>{{ $area }}:</strong> {{ $datosArea['observaciones'] }}</td>
            </tr>
          @endif
        @endforeach
      </table>
    @endif
  </div>

  <!-- Footer -->
  <div class="footer-section">
    <p style="margin: 0;">© PSICODESARROLLO {{ now()->year }} • Av. Principal, Edificio XYZ • Teléfono: 0212-5555555
    </p>
  </div>
</body>

</html>
