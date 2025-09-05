<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Resultados Prueba No Estandarizada</title>
  <style>
    body {
      font-family: Arial, sans-serif;
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
      text-align: left;
    }

    th {
      background-color: #f0f0f0;
    }

    .bold {
      font-weight: bold;
    }
  </style>
</head>

<body>

  <h1>Resultados Prueba No Estandarizada</h1>

  <!-- Datos del Paciente -->
  <table>
    <tr>
      <td><strong>Nombre y Apellidos:</strong> {{ $paciente['nombre'] }}</td>
      <td><strong>Edad en meses:</strong> {{ $datos['edad_meses'] }}</td>
      <td><strong>Fecha:</strong> {{ $aplicacion->created_at->format('d/m/Y') }}</td>
    </tr>
    <tr>
      <td><strong>Examinado por:</strong> {{ $usuario['name'] }}</td>
      <td colspan="2"><strong>Centro:</strong> PsicoDesarrollo</td>
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

</body>

</html>
