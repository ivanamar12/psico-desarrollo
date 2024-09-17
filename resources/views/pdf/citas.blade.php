<!DOCTYPE html>
<html>
<head>
    <title>Citas</title>
    <style>
        /* Estilos adicionales para la tabla */
        table {
            width: 100%; /* Ancho completo de la tabla */
            border-collapse: collapse; /* Colapsar bordes */
        }
        th, td {
            border: 1px solid #ccc; /* Bordes de las celdas */
            padding: 8px; /* Espaciado interno */
            text-align: left; /* Alinear texto a la izquierda */
        }
        th {
            background-color: #f0f0f0; /* Color de fondo para encabezados de tabla */
        }
        /* Estilos generales del cuerpo */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Estilo del encabezado */
        header {
            background-color: #f0f0f0; /* Color de fondo del encabezado */
            padding: 20px; /* Espaciado interno */
            text-align: center; /* Centrar el texto */
            border-bottom: 2px solid #ccc; /* Línea inferior */
        }

        /* Agregar el ícono al encabezado */
        header img {
            width: 50px; /* Ajusta el tamaño del ícono */
            vertical-align: middle; /* Alinear verticalmente */
            margin-right: 10px; /* Espacio entre el ícono y el texto */
        }

        /* Estilo del pie de página */
        footer {
            background-color: #f0f0f0; /* Color de fondo del pie de página */
            padding: 10px; /* Espaciado interno */
            text-align: center; /* Centrar el texto */
            border-top: 2px solid #ccc; /* Línea superior */
            position: fixed; /* Fijar el pie de página */
            bottom: 0; /* Posición en la parte inferior */
            width: 100%; /* Ancho completo */
        }

        /* Estilo para el contenido principal */
        main {
            padding: 20px; /* Espaciado interno */
            margin: 60px 0; /* Margen superior para evitar que el contenido se superponga con el encabezado */
        }
    </style>
</head>
<body>
    <header>
        <h1>Consultorio Psicologico Infantil PsicoDesarrollo</h1>
    </header>
    <p><h3><b>Listado de citas del consultorio</b></h3></p>
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
