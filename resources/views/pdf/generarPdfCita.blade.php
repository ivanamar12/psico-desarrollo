<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Cita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .cita-detalle {
            background: white;
            margin: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background-color: #007bff;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PsicoDesarrollo</h1>
    </div>
    
    <div class="cita-detalle">
        <h2>Detalles de la Cita</h2>
        <p><strong>ID de Cita:</strong> {{ $cita->id }}</p>
        <p><strong>Paciente:</strong> {{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</p>
        <p><strong>Especialista:</strong> {{ $cita->especialista->nombre }} {{ $cita->especialista->apellido }}</p>
        <p><strong>Fecha de Consulta:</strong> {{ $cita->fecha_consulta }}</p>
        <p><strong>Estado:</strong> {{ $cita->status }}</p>
    </div>

    <div class="footer">
        <p>&copy; consultorio Psicologico infantil Psico desarrollo</p>
    </div>
</body>
</html>
