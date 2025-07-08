<!DOCTYPE html>
<html>

<head>
  <title>Mis Citas</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f0f0f0;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #f0f0f0;
      padding: 20px;
      text-align: center;
      border-bottom: 2px solid #ccc;
    }

    header img {
      width: 50px;
      vertical-align: middle;
      margin-right: 10px;
    }

    footer {
      background-color: #f0f0f0;
      padding: 10px;
      text-align: center;
      border-top: 2px solid #ccc;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    main {
      padding: 20px;
      margin: 60px 0;
    }

    .titulo-especialista {
      color: #2c6aa0;
      border-bottom: 2px solid #2c6aa0;
      padding-bottom: 10px;
    }
  </style>
</head>

<body>
  <header>
    <img width="30" height="30" src="{{ public_path('assets/img/logo.webp') }}" alt="Logo PsicoDesarrollo">
    <h1>Consultorio Psicologico Infantil PsicoDesarrollo</h1>
  </header>
  <p>
  <h3 class="titulo-especialista">
    <b>Mis Citas - {{ $nombreEspecialista }}</b>
    @if (isset($fechaEspecifica))
      <br><span style="font-size: 0.8em;">{{ $fechaEspecifica }}</span>
    @endif
  </h3>
  </p>
  <main>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Representante</th>
          <th>Paciente</th>
          <th>Fecha</th>
          <th>Estado</th>
          <th>Hora</th>
          <th>Observaciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($citas as $cita)
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
            <td>{{ $cita->fecha_consulta }}</td>
            <td><strong>{{ ucfirst($cita->status) }}</strong></td>
            <td>{{ $cita->hora }}</td>
            <td>{{ $cita->observaciones ?? 'Sin observaciones' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </main>
  <footer>
    <p>Consultorio Psicologico PsicoDesarrollo - {{ $nombreEspecialista }}</p>
  </footer>
</body>

</html>
