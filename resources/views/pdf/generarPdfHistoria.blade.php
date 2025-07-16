<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Historia Clínica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .header, .footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            margin: 0;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        table td span {
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PsicoDesarrollo</h1>
    </div>
    <div class="container">
        <h2>Historia Clinica</h2>
        <table>
            <tr>
                <td><span>Código:</span> {{ $datos['codigoHistoria'] }}</td>
                <td><span>Referencia:</span> {{ $datos['referenciaHistoria'] }}</td>
            </tr>
            <tr>
                <td colspan="2"><span>Motivo:</span> {{ $datos['motivoHistoria'] }}</td>
            </tr>
        </table>
        <div class="section-title">Información del Paciente</div>
            <table>
                <tr>
                    <td><span>Nombre:</span> {{ $datos['nombrePaciente'] }} {{ $datos['apellidoPaciente'] }}</td>
                    <td><span>Fecha de Nacimiento:</span> {{ $datos['fechaNacPaciente'] }}</td>
                    <td><span>Género:</span> {{ $datos['generoPaciente'] }}</td>
                </tr>
            </table>
        <div class="section-title">Información del Representante</div>
            <table>
                <tr>
                    <td><span>Nombre:</span> {{ $datos['nombreRepresentante'] }} {{ $datos['apellidoRepresentante'] }}</td>
                    <td><span>Cédula:</span> {{ $datos['ciRepresentante'] }}</td>
                </tr>
                <tr>
                    <td><span>Teléfono:</span> {{ $datos['telefonoRepresentante'] }}</td>
                    <td><span>Email:</span> {{ $datos['emailRepresentante'] }}</td>
                </tr>
                <tr>
                    <td colspan="2"><span>Dirección:</span> {{ $datos['sectorDireccion'] }}, {{ $datos['parroquiaDireccion'] }}, {{ $datos['municipioDireccion'] }}, {{ $datos['estadoDireccion'] }}</td>
                </tr>
            </table>
        <div class="section-title">Historia de Desarrollo</div>
            <table>
                <tr>
                    <td><span>Medicamentos durante el embarazo:</span> {{ $datos['medicamento_embarazo'] }}</td>
                    <td><span>Tipo de Medicamento:</span> {{ $datos['tipo_medicamento'] }}</td>
                </tr>
                <tr>
                    <td><span>Fumó durante el embarazo:</span> {{ $datos['fumo_embarazo'] }}</td>
                    <td><span>Consumo de alcohol en el Embarazo:</span> {{ $datos['alcohol_embarazo'] }}</td>
                </tr>
                <tr>
                    <td><span>Tipo de Alcohol:</span> {{ $datos['tipo_alcohol'] }}</td>
                    <td><span>Cantidad Consumida de Alcohol:</span> {{ $datos['cantidad_consumia_alcohol'] }}</td>
                </tr>
                <tr>
                    <td><span>Consumio Droga en el Embarazo:</span> {{ $datos['droga_embarazo'] }}</td>
                    <td><span>Tipo de Droga:</span> {{ $datos['tipo_droga'] }}</td>
                </tr>
                <tr>
                    <td><span>Forceps en el Parto:</span> {{ $datos['forceps_parto'] }}</td>
                    <td><span>Cesarea:</span> {{ $datos['cesarea'] }}</td>
                </tr>
                <tr>
                    <td><span>Razón de la Cesarea:</span> {{ $datos['razon_cesarea'] }}</td>
                    <td><span>Niño prematuro:</span> {{ $datos['niño_prematuro'] }}</td>
                </tr>
                <tr>
                    <td><span>Meses Prematuro:</span> {{ $datos['meses_prematuro'] }}</td>
                    <td><span>Peso del Niño al nacer:</span> {{ $datos['peso_nacer_niño'] }}</td>
                </tr>
                <tr>
                    <td><span>Complicaciones al Nacer:</span> {{ $datos['complicaciones_nacer'] }}</td>
                    <td><span>Tipo de Complicación:</span> {{ $datos['tipo_complicacion'] }}</td>
                </tr>
                <tr>
                    <td><span>Problemas de Alimentación:</span> {{ $datos['problema_alimentacion'] }}</td>
                    <td><span>Tipo de Problema de Alimentación:</span> {{ $datos['tipo_problema_alimenticio'] }}</td>
                </tr>
                <tr>
                    <td><span>Problemas para Dormir:</span> {{ $datos['problema_dormir'] }}</td>
                    <td><span>Tipo de Problema para Dormir:</span> {{ $datos['tipo_problema_dormir'] }}</td>
                </tr>
                <tr>
                    <td><span>El Niño era Tranquilo Recien Nacido:</span> {{ $datos['tranquilo_recien_nacido'] }}</td>
                    <td><span>Le Gustaba que lo Cargaran Recien Nacido:</span> {{ $datos['gustaba_cargaran_recien_nacido'] }}</td>
                </tr>
                <tr>
                    <td><span>El Niño era Alerta Recien Nacido:</span> {{ $datos['alerta_recien_nacido'] }}</td>
                    <td><span>El Niño Tuvo Problemas de Desarrollo los Primeros Años:</span> {{ $datos['problemas_desarrollo_primeros_años'] }}</td>
                </tr>
                <tr>
                    <td><span>Cuales Problemas:</span> {{ $datos['cuales_problemas'] }}</td>
                </tr>
            </table>
        <div class="section-title">Antecedentes Médicos</div>
            <table>
                <tr>
                    <td><span>Enfermedades Infecciosas:</span> {{ $datos['enfermedad_infecciosa'] }}</td>
                    <td><span>Tipo:</span> {{ $datos['tipo_enfermedad_infecciosa'] }}</td>
                </tr>
                <tr>
                    <td><span>Enfermedades No Infecciosas:</span> {{ $datos['enfermedad_no_infecciosa'] }}</td>
                    <td><span>Tipo:</span> {{ $datos['tipo_enfermedad_infecciosa'] }}</td>
                </tr>
                <tr>
                    <td><span>Enfermedades Crónicas:</span> {{ $datos['enfermedad_cronica'] }}</td>
                    <td><span>Tipo:</span> {{ $datos['tipo_enfermedad_no_infecciosa'] }}</td>
                </tr>
                <tr>
                    <td><span>Discapacidad:</span> {{ $datos['discapacidad'] }}</td>
                    <td><span>Tipo de Discapacidad:</span> {{ $datos['tipo_discapacidad'] }}</td>
                </tr>
                <tr>
                    <td><span>Otros:</span> {{ $datos['otros'] }}</td>
                </tr>
            </table>
        </div>
        <div class="section-title">Historia Escolar</div>
            <table>
                <tr>
                    <td><span>El Niño Esta Escolarizado:</span> {{ $datos['escolarizado'] }}</td>
                    <td><span>Tipo de Educación:</span> {{ $datos['tipo_educaion'] }}</td>
                </tr>
                <tr>
                    <td><span>El Niño Recibe Algún Tipo de Terapias o Tutorias:</span> {{ $datos['tutoria_terapias'] }}</td>
                    <td><span>Cuales:</span> {{ $datos['tutoria_terapias_cuales'] }}</td>
                </tr>
                <tr>
                    <td><span>Dificultad para la lectura:</span> {{ $datos['dificultad_lectura'] }}</td>
                    <td><span>Dificultad Aritmetica:</span> {{ $datos['dificultad_aritmetica'] }}</td>
                </tr>
                <tr>
                    <td><span>Dificultad Para Escribir:</span> {{ $datos['dificultad_escribir'] }}</td>
                    <td><span>Le Agrada la Escuela o La Guarderia:</span> {{ $datos['agrada_escuela'] }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>&copy; Consultorio Psicológico Infantil PsicoDesarrollo</p>
        </div>
    </div>
</body>
</html>
