<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>{{ $title }}</title>
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
  <div class="content-container" style="padding-bottom: 300px">
    <div style="text-align: center;margin-top: 30px;font-size: 12px;color: #666;">
      Fecha: {{ date('d/m/Y g:i A') }}
    </div>
    <h1>{{ $title }}</h1>
    <h2>Detalles de las citas</h2>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Representante</th>
          <th>Paciente</th>
          <th>Fecha</th>
          <th>Estado</th>
          <th>Hora</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($citas as $cita)
          <tr>
            <td>{{ $cita->id }}</td>
            <td>
              @if ($cita->paciente && $cita->paciente->representante)
                {{ $cita->paciente->representante->nombre }} {{ $cita->paciente->representante->apellido }}
              @else
                No registrado
              @endif
            </td>
            <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</td>
            <td>{{ $cita->fecha_consulta_short }}</td>
            <td><strong>{{ ucfirst($cita->status) }}</strong></td>
            <td>{{ $cita->hora }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center">Sin citas</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <!-- Firma -->
    <div style="text-align: right; margin-top: 90px;">
      <strong>Esp. {{ $especialista->nombre . ' ' . $especialista->apellido }}</strong>
      <br>
      <span>
        C.I. {{ $especialista->ci }}
      </span>
      <br>
      <span>
        F.V.P. {{ $especialista->fvp }}
      </span>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer-section">
    <p style="margin: 0;">© PSICODESARROLLO {{ now()->year }} • Av. Principal, Edificio XYZ • Teléfono: 0212-5555555
    </p>
  </div>
</body>

</html>
