<!DOCTYPE html>
<html>

<head>
  <title>Citas</title>
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
  </style>
</head>

<body>
  <header>
    <h1>Consultorio Psicologico Infantil PsicoDesarrollo</h1>
  </header>
  <p>
  <h3><b>Listado de citas del dia de hoy del consultorio</b></h3>
  </p>
  <main>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Paciente</th>
          <th>Especialista</th>
          <th>Fecha</th>
          <th>Estado</th>
          <th>Hora</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($citas as $cita)
          <tr>
            <td>{{ $cita->id }}</td>
            <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</td>
            <td>{{ $cita->especialista->nombre }} {{ $cita->especialista->apellido }}</td>
            <td>{{ $cita->fecha_consulta }}</td>
            <td>{{ $cita->status }}</td>
            <td>{{ $cita->hora }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </main>
  <footer>
    <p>Consultorio Psicologico PsicoDesarrollo</p>
  </footer>
</body>

</html>
