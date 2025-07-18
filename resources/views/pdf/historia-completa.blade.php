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

    .header,
    .footer {
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

    h1,
    h2 {
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
        <td><span>Código:</span> {{ $historia->codigo }}</td>
        <td><span>Referencia:</span> {{ $historia->referencia }}</td>
      </tr>
      <tr>
        <td colspan="2"><span>Motivo:</span> {{ $historia->motivo }}</td>
      </tr>
      <tr>
        <td colspan="2"><span>Especialista que Refirió:</span> {{ $historia->especialista_refirio }}</td>
      </tr>
      <tr>
        <td colspan="2"><span>Observación:</span> {{ $historia->observacion ?: 'Sin observaciones' }}</td>
      </tr>
    </table>
    <div class="section-title">Información del Paciente</div>
    <table>
      <tr>
        <td><span>Nombre:</span> {{ $historia->paciente->nombre }} {{ $historia->paciente->apellido }}</td>
        <td><span>Fecha de Nacimiento:</span> {{ $historia->paciente->fecha_nac }}</td>
        <td><span>Género:</span> {{ $historia->paciente->genero->genero }}</td>
      </tr>
      <tr>
        <td><span>Nombre:</span> {{ $historia->paciente->representante->nombre }}
          {{ $historia->paciente->representante->apellido }}</td>
        <td><span>Cédula:</span> {{ $historia->paciente->representante->ci }}</td>
        <td><span>Género:</span> {{ $historia->paciente->representante->genero->genero }}</td>
      </tr>
      <tr>
        <td><span>Teléfono:</span> {{ $historia->paciente->representante->telefono }}</td>
        <td><span>Email:</span> {{ $historia->paciente->representante->email }}</td>
      </tr>
      <tr>
        <td><span>Dirección Completa:</span>
          {{ $historia->paciente->representante->direccion->sector }},
          {{ $historia->paciente->representante->direccion->parroquia->parroquia }},
          {{ $historia->paciente->representante->direccion->municipio->municipio }},
          {{ $historia->paciente->representante->direccion->estado->estado }}
        </td>
      </tr>
    </table>
    <!-- Datos Económicos -->
    <div class="section-title">Datos Económicos</div>
    <table>
      <tr>
        <td><span>Tipo de Vivienda:</span> {{ $historia->paciente->datosEconomico->tipo_vivienda }}</td>
        <td><span>Cantidad de Habitaciones:</span> {{ $historia->paciente->datosEconomico->cantidad_habitaciones }}
        </td>
      </tr>
      <tr>
        <td><span>Cantidad de Personas en la Vivienda:</span>
          {{ $historia->paciente->datosEconomico->cantidad_personas }}</td>
        <td><span>Servicio de Agua Potable:</span> {{ $historia->paciente->datosEconomico->servecio_agua_potable }}
        </td>
      </tr>
      <tr>
        <td><span>Servicio de Gas:</span> {{ $historia->paciente->datosEconomico->servecio_gas }}</td>
        <td><span>Servicio de Electricidad:</span> {{ $historia->paciente->datosEconomico->servecio_electricidad }}
        </td>
      </tr>
      <tr>
        <td><span>Servicio de Drenaje:</span> {{ $historia->paciente->datosEconomico->servecio_drenaje }}</td>
        <td><span>Disponibilidad de Internet:</span> {{ $historia->paciente->datosEconomico->disponibilidad_internet }}
        </td>
      </tr>
      <tr>
        <td><span>Tipo de Conexión a Internet:</span> {{ $historia->paciente->datosEconomico->tipo_conexion_internet }}
        </td>
        <td><span>Acceso a Servicios Públicos:</span>
          {{ $historia->paciente->datosEconomico->acceso_servcios_publicos }}</td>
      </tr>
      <tr>
        <td><span>Fuente de Ingreso Familiar:</span> {{ $historia->paciente->datosEconomico->fuente_ingreso_familiar }}
        </td>
        <td><span>Observaciones:</span> {{ $historia->paciente->datosEconomico->observacion ?: 'Sin observaciones' }}
        </td>
      </tr>
    </table>
    <!-- Parentescos -->
    <div class="section-title">Parentescos</div>
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Fecha de Nacimiento</th>
          <th>Parentesco</th>
          <th>Discapacidad</th>
          <th>Tipo de Discapacidad</th>
          <th>Enfermedad Crónica</th>
          <th>Tipo de Enfermedad</th>
        </tr>
      </thead>
      <tbody>
        @if ($historia->paciente->parentescos->isEmpty())
          <tr>
            <td colspan="8">No hay familiares registrados.</td>
          </tr>
        @else
          @foreach ($historia->paciente->parentescos as $parentesco)
            <tr>
              <td>{{ $parentesco->nombre }}</td>
              <td>{{ $parentesco->apellido }}</td>
              <td>{{ $parentesco->fecha_nac }}</td>
              <td>{{ $parentesco->parentesco }}</td>
              <td>{{ $parentesco->discapacidad }}</td>
              <td>{{ $parentesco->tipo_discapacidad }}</td>
              <td>{{ $parentesco->enfermedad_cronica }}</td>
              <td>{{ $parentesco->tipo_enfermedad }}</td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
    <!-- Antecedentes Médicos -->
    <div class="section-title">Antecedentes Médicos</div>
    <table>
      <tr>
        <td><span>Enfermedad Infecciosa:</span> {{ $historia->antecedenteMedico->enfermedad_infecciosa }}</td>
        <td><span>Tipo de Enfermedad Infecciosa:</span> {{ $historia->antecedenteMedico->tipo_enfermedad_infecciosa }}
        </td>
      </tr>
      <tr>
        <td><span>Enfermedad No Infecciosa:</span> {{ $historia->antecedenteMedico->enfermedad_no_infecciosa }}</td>
        <td><span>Tipo de Enfermedad No Infecciosa:</span>
          {{ $historia->antecedenteMedico->tipo_enfermedad_no_infecciosa }}</td>
      </tr>
      <tr>
        <td><span>Enfermedad Crónica:</span> {{ $historia->antecedenteMedico->enfermedad_cronica }}</td>
        <td><span>Tipo de Enfermedad Crónica:</span> {{ $historia->antecedenteMedico->tipo_enfermedad_cronica }}</td>
      </tr>
      <tr>
        <td><span>Discapacidad:</span> {{ $historia->antecedenteMedico->discapacidad }}</td>
        <td><span>Tipo de Discapacidad:</span> {{ $historia->antecedenteMedico->tipo_discapacidad }}</td>
      </tr>
      <tr>
        <td><span>Otros:</span> {{ $historia->antecedenteMedico->otros }}</td>
        <td><span>Observaciones:</span> {{ $historia->antecedenteMedico->observacion ?: 'Sin observaciones' }}</td>
      </tr>
    </table>
    <!-- Historia de Desarrollo -->
    <div class="section-title">Historia de Desarrollo</div>
    <table>
      <tr>
        <td><span>Medicamentos durante el embarazo:</span> {{ $historia->historiaDesarrollo->medicamento_embarazo }}
        </td>
        <td><span>Tipo de Medicamento:</span> {{ $historia->historiaDesarrollo->tipo_medicamento }}</td>
      </tr>
      <tr>
        <td><span>Fumó durante el embarazo:</span> {{ $historia->historiaDesarrollo->fumo_embarazo }}</td>
        <td><span>Cantidad:</span> {{ $historia->historiaDesarrollo->cantidad }}</td>
      </tr>
      <tr>
        <td><span>Consumo de alcohol en el embarazo:</span> {{ $historia->historiaDesarrollo->alcohol_embarazo }}</td>
        <td><span>Tipo de Alcohol:</span> {{ $historia->historiaDesarrollo->tipo_alcohol }}</td>
      </tr>
      <tr>
        <td><span>Cantidad de alcohol consumida:</span> {{ $historia->historiaDesarrollo->cantidad_consumia_alcohol }}
        </td>
        <td><span>Consumo de drogas en el embarazo:</span> {{ $historia->historiaDesarrollo->droga_embarazo }}</td>
      </tr>
      <tr>
        <td><span>Tipo de Droga:</span> {{ $historia->historiaDesarrollo->tipo_droga }}</td>
        <td><span>Forceps en el parto:</span> {{ $historia->historiaDesarrollo->forceps_parto }}</td>
      </tr>
      <tr>
        <td><span>Cesárea:</span> {{ $historia->historiaDesarrollo->cesarea }}</td>
        <td><span>Razón de la Cesárea:</span> {{ $historia->historiaDesarrollo->razon_cesarea }}</td>
      </tr>
      <tr>
        <td><span>Niño prematuro:</span> {{ $historia->historiaDesarrollo->niño_prematuro }}</td>
        <td><span>Meses prematuro:</span> {{ $historia->historiaDesarrollo->meses_prematuro }}</td>
      </tr>
      <tr>
        <td><span>Peso del niño al nacer:</span> {{ $historia->historiaDesarrollo->peso_nacer_niño }}</td>
        <td><span>Complicaciones al nacer:</span> {{ $historia->historiaDesarrollo->complicaciones_nacer }}</td>
      </tr>
      <tr>
        <td><span>Tipo de Complicación:</span> {{ $historia->historiaDesarrollo->tipo_complicacion }}</td>
        <td><span>Problemas de alimentación:</span> {{ $historia->historiaDesarrollo->problema_alimentacion }}</td>
      </tr>
      <tr>
        <td><span>Tipo de Problema de Alimentación:</span>
          {{ $historia->historiaDesarrollo->tipo_problema_alimenticio }}</td>
        <td><span>Problemas para dormir:</span> {{ $historia->historiaDesarrollo->problema_dormir }}</td>
      </tr>
      <tr>
        <td><span>Tipo de Problema para Dormir:</span> {{ $historia->historiaDesarrollo->tipo_problema_dormir }}</td>
        <td><span>El niño era tranquilo recién nacido:</span>
          {{ $historia->historiaDesarrollo->tranquilo_recien_nacido }}</td>
      </tr>
      <tr>
        <td><span>Le gustaba que lo cargaran recién nacido:</span>
          {{ $historia->historiaDesarrollo->gustaba_cargaran_recien_nacido }}</td>
        <td><span>El niño era alerta recién nacido:</span> {{ $historia->historiaDesarrollo->alerta_recien_nacido }}
        </td>
      </tr>
      <tr>
        <td><span>Problemas de desarrollo en los primeros años:</span>
          {{ $historia->historiaDesarrollo->problemas_desarrollo_primeros_años }}</td>
        <td><span>¿Cuáles problemas?:</span> {{ $historia->historiaDesarrollo->cuales_problemas }}</td>
      </tr>
      <tr>
        <td colspan="2"><span>Observaciones:</span>
          {{ $historia->historiaDesarrollo->observacion ?: 'Sin observaciones' }}</td>
      </tr>
    </table>
    <!-- Historia Escolar -->
    <div class="section-title">Historia Escolar</div>
    <table>
      <tr>
        <td><span>Escolarizado:</span> {{ $historia->historiaEscolar->escolarizado }}</td>
        <td><span>Tipo de Educación:</span> {{ $historia->historiaEscolar->tipo_educacion }}</td>
      </tr>
      <tr>
        <td><span>Modalidad de Educación:</span> {{ $historia->historiaEscolar->modalidad_educacion }}</td>
        <td><span>Nombre de la Escuela:</span> {{ $historia->historiaEscolar->nombre_escuela }}</td>
      </tr>
      <tr>
        <td><span>Tutorías o Terapias:</span> {{ $historia->historiaEscolar->tutoria_terapias }}</td>
        <td><span>¿Cuáles Tutorías o Terapias?:</span> {{ $historia->historiaEscolar->tutoria_terapias_cuales }}</td>
      </tr>
      <tr>
        <td><span>Dificultad para la Lectura:</span> {{ $historia->historiaEscolar->dificultad_lectura }}</td>
        <td><span>Dificultad para la Aritmética:</span> {{ $historia->historiaEscolar->dificultad_aritmetica }}</td>
      </tr>
      <tr>
        <td><span>Dificultad para Escribir:</span> {{ $historia->historiaEscolar->dificultad_escribir }}</td>
        <td><span>Le Agrada la Escuela:</span> {{ $historia->historiaEscolar->agrada_escuela }}</td>
      </tr>
      <tr>
        <td><span>Otro Servicio:</span> {{ $historia->historiaEscolar->otro_servicio }}</td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2"><span>Observaciones:</span>
          {{ $historia->historiaEscolar->observacion ?: 'Sin observaciones' }}</td>
      </tr>
    </table>
  </div>
</body>
