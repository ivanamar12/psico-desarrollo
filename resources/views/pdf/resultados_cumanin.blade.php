<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados CUMANIN</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, h2, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: center; }
        th { background-color: #f0f0f0; }
        .profile-table { margin-bottom: 20px; }
        .circle { font-size: 14px; position: relative; }
        .bold { font-weight: bold; }
        .connected { border-top: 2px solid black; } /* Línea de conexión */
        .graph-line { position: absolute; height: 2px; background-color: black; }

        
    </style>
</head>
<body>
    <h1>PERFIL</h1>

    <!-- Datos del Paciente -->
    <table class="profile-table">
        <tr>
            <td><strong>Nombre y Apellidos:</strong> {{ $paciente->nombre }}</td>
            <td><strong>Edad en meses:</strong> {{ $datos['edad_meses'] }}</td>
            <td><strong>Fecha:</strong> {{ $aplicacion->created_at->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td><strong>Examinado por:</strong> {{ $aplicacion->user->name }}</td>
            <td colspan="2"><strong>Centro:</strong> PsicoDesarrollo</td>
        </tr>
    </table>

    <!-- Tabla de Resultados de Subescalas -->
    <h3>Resultados por Subescala</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2">Prueba</th>
                <th rowspan="2">PD</th>
                <th rowspan="2">Centil</th>
                <th colspan="10">Distribución Percentil</th>
            </tr>
            <tr>
                <th>1</th><th>10</th><th>20</th><th>30</th><th>40</th>
                <th>50</th><th>60</th><th>70</th><th>80</th><th>90</th><th>99</th>
            </tr>
        </thead>
        <tbody>
            @php
                $rangoPercentiles = [1, 10, 20, 30, 40, 50, 60, 70, 80, 90, 99];
            @endphp
            @foreach($resultados as $area => $datosArea)
                @if (!in_array($area, ['Desarrollo Verbal', 'Desarrollo No Verbal', 'Desarrollo Global'])) 
                    <tr>
                        <td>{{ $area }}</td>
                        <td>{{ $datosArea['puntaje'] }}</td>
                        <td>{{ $datosArea['percentil'] }}</td>
                        @php $prevPercentil = null; @endphp
                        @foreach($rangoPercentiles as $rango)
                            @php
                                $isDarkCircle = ($datosArea['percentil'] >= $rango && $datosArea['percentil'] < ($rango + 9));
                                $isConnected = $isDarkCircle && $prevPercentil !== null;
                            @endphp
                            <td class="circle {{ $isConnected ? 'connected' : '' }}">
                                {{ $isDarkCircle ? '●' : '◯' }}
                            </td>
                            @php $prevPercentil = $isDarkCircle ? $rango : $prevPercentil; @endphp
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <!-- Desarrollo Verbal, No Verbal y Global -->
    <h3>Resumen de Desarrollo</h3>
    <table>
        <tr>
            <th rowspan="2">Categoría</th>
            <th rowspan="2">PD</th>
            <th rowspan="2">Centil</th>
            <th colspan="10">Distribución Percentil</th>
        </tr>
        <tr>
            <th>1</th><th>10</th><th>20</th><th>30</th><th>40</th>
            <th>50</th><th>60</th><th>70</th><th>80</th><th>90</th><th>99</th>
        </tr>
        @foreach(['Desarrollo Verbal', 'Desarrollo no Verbal', 'Desarrollo Global'] as $categoria)
        <tr>
            <td class="bold">{{ $categoria }}</td>
            <td>{{ $resultados[$categoria]['puntaje'] }}</td>
            <td>{{ $resultados[$categoria]['percentil'] }}</td>
            @php $prevPercentil = null; @endphp
            @foreach($rangoPercentiles as $rango)
                @php
                    $isDarkCircle = ($resultados[$categoria]['percentil'] >= $rango && $resultados[$categoria]['percentil'] < ($rango + 9));
                    $isConnected = $isDarkCircle && $prevPercentil !== null;
                @endphp
                <td class="circle {{ $isConnected ? 'connected' : '' }}">
                    {{ $isDarkCircle ? '●' : '◯' }}
                </td>
                @php $prevPercentil = $isDarkCircle ? $rango : $prevPercentil; @endphp
            @endforeach
        </tr>
        @endforeach
    </table>

    <!-- Pie de Página -->
    <div class="footer">
        Fecha de impresión: {{ date('d/m/Y') }} | PsicoDesarrollo | Tel: +58 412-358-12-79 | Email: psicodesarrollo@gmail.com
    </div>

    <script>
        // JavaScript para dibujar las líneas entre los puntos
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const circles = row.querySelectorAll('.circle');
                let prevCircle = null;

                circles.forEach((circle, index) => {
                    if (circle.textContent === '●') {
                        if (prevCircle !== null) {
                            const line = document.createElement('div');
                            line.classList.add('graph-line');

                            const rect1 = prevCircle.getBoundingClientRect();
                            const rect2 = circle.getBoundingClientRect();

                            const x1 = rect1.left + rect1.width / 2;
                            const y1 = rect1.top + rect1.height / 2;
                            const x2 = rect2.left + rect2.width / 2;
                            const y2 = rect2.top + rect2.height / 2;

                            const length = Math.sqrt((x2 - x1) ** 2 + (y2 - y1) ** 2);
                            const angle = Math.atan2(y2 - y1, x2 - x1) * 180 / Math.PI;

                            line.style.width = `${length}px`;
                            line.style.transform = `rotate(${angle}deg)`;
                            line.style.left = `${x1}px`;
                            line.style.top = `${y1}px`;

                            document.body.appendChild(line);
                        }
                        prevCircle = circle;
                    } else {
                        prevCircle = null;
                    }
                });
            });
        });
    </script>
</body>
</html>