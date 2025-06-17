<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados Prueba Koppitz</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, h2, h3 { text-align: center; }
        .container { width: 100%; display: flex; justify-content: space-between; margin-top: 10px; }
        .table-container { width: 48%; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: center; }
        th { background-color: #f0f0f0; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>

    <h1>Resultados Prueba Koppitz</h1>

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

    <!-- Contenedor para las tablas en paralelo -->
    <div class="container">
        <!-- Tabla de Ítems con respuesta "Sí" -->
        <div class="table-container">
            <h3>Ítems con respuesta "Sí"</h3>
            <table>
                <thead>
                    <tr>
                        <th>Ítem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($itemsSi as $item)
                        <tr><td>{{ $item }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabla de Ítems con respuesta "No" -->
        <div class="table-container">
            <h3>Ítems con respuesta "No" (según edad)</h3>
            <table>
                <thead>
                    <tr>
                        <th>Ítem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($itemsNo as $item)
                        <tr><td>{{ $item }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Resultados Finales -->
    <h3>Resumen</h3>
    <table>
        <tr>
            <td class="bold">Total de Puntaje:</td>
            <td>{{ $datos['resultados']['puntajeTotal'] }}</td>
        </tr>
        <tr>
            <td class="bold">Categoría:</td>
            <td>{{ $datos['resultados']['categoria'] }}</td>
        </tr>
        <tr>
            <td class="bold">Ítems Excepcionales:</td>
            <td>{{ $datos['resultados']['itemsExcepcionales'] }}</td>
        </tr>
    </table>

</body>
</html>
