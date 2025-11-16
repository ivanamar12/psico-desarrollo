<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Historia Clínica</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; color: #333;">

  <!-- Header -->
  <div style="background-color: #00869b; color: white; text-align: center; padding: 15px 0; margin-bottom: 20px;">
    <img src="{{ public_path('img/logo.png') }}" alt="Logo de PSICODESARROLLO"
      style="width: 70px; height: 70px; border-radius: 50%; border: 2px solid #fff; margin-bottom: 3px">
    <h1 style="margin: 0; font-size: 24px;">PsicoDesarrollo</h1>
    <p style="margin: 5px 0 0; font-size: 16px;">Historia Clínica</p>
  </div>

  <!-- Contenido principal -->
  <section
    style="max-width: 900px; margin: 0 auto; background: white; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

    <section style="text-align: right;">
      <h4>Fecha: {{ now()->format('d/m/Y') }}</h4>
    </section>

    <h2
      style="color: #00869b; border-bottom: 2px solid #00869b; padding-bottom: 5px; font-size: 14px; margin-bottom: 15px;">
      Historia Clinica
    </h2>

    <table style="width: 100%; border-collapse: collapse; font-size: 12px; margin-bottom: 20px;">
      <tr>
        <td style="padding: 8px; border: 1px solid #ddd;">
          <strong>Código:</strong> {{ $historia->codigo }}
        </td>
        <td style="padding: 8px; border: 1px solid #ddd;">
          <strong>Referencia:</strong> {{ $historia->referencia }}
        </td>
      </tr>
      <tr>
        <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">
          <strong>Motivo:</strong> {{ $historia->motivo }}
        </td>
      </tr>
      <tr>
        <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">
          <strong>Especialista que Refirió:</strong> {{ $historia->especialista_refirio }}
        </td>
      </tr>
      <tr>
        <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">
          <strong>Observación:</strong> {{ $historia->observacion ?: 'Sin observaciones' }}
        </td>
      </tr>
    </table>

    <!-- Sección I: Información del Paciente -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #00869b; border-bottom: 2px solid #00869b; padding-bottom: 5px; font-size: 14px; margin-bottom: 15px;">
        I. Información del Paciente
      </h2>

      <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Nombre:</strong> {{ $historia->paciente->nombre }} {{ $historia->paciente->apellido }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Fecha de Nacimiento:</strong> {{ $historia->paciente->fecha_nac }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Género:</strong> {{ $historia->paciente->genero->genero }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Representante:</strong> {{ $historia->paciente->representante->nombre }}
            {{ $historia->paciente->representante->apellido }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Cédula:</strong> {{ $historia->paciente->representante->ci }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Género:</strong> {{ $historia->paciente->representante->genero->genero }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Teléfono:</strong> {{ $historia->paciente->representante->telefono }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Email:</strong> {{ $historia->paciente->representante->email }}
          </td>
        </tr>
        <tr>
          <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">
            <strong>Dirección Completa:</strong>
            {{ $historia->paciente->representante->direccion->sector }},
            {{ $historia->paciente->representante->direccion->parroquia->parroquia }},
            {{ $historia->paciente->representante->direccion->municipio->municipio }},
            {{ $historia->paciente->representante->direccion->estado->estado }}
          </td>
        </tr>
      </table>
    </div>

    <!-- Sección II: Datos Económicos -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #00869b; border-bottom: 2px solid #00869b; padding-bottom: 5px; font-size: 14px; margin-bottom: 15px;">
        II. Datos Económicos
      </h2>

      <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Vivienda:</strong> {{ $historia->paciente->datosEconomico->tipo_vivienda }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Cantidad de Habitaciones:</strong> {{ $historia->paciente->datosEconomico->cantidad_habitaciones }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Cantidad de Personas en la Vivienda:</strong>
            {{ $historia->paciente->datosEconomico->cantidad_personas }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Servicio de Agua Potable:</strong> {{ $historia->paciente->datosEconomico->servecio_agua_potable }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Servicio de Gas:</strong> {{ $historia->paciente->datosEconomico->servecio_gas }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Servicio de Electricidad:</strong> {{ $historia->paciente->datosEconomico->servecio_electricidad }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Servicio de Drenaje:</strong> {{ $historia->paciente->datosEconomico->servecio_drenaje }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Disponibilidad de Internet:</strong>
            {{ $historia->paciente->datosEconomico->disponibilidad_internet }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Conexión a Internet:</strong>
            {{ $historia->paciente->datosEconomico->tipo_conexion_internet }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Acceso a Servicios Públicos:</strong>
            {{ $historia->paciente->datosEconomico->acceso_servcios_publicos }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Fuente de Ingreso Familiar:</strong>
            {{ $historia->paciente->datosEconomico->fuente_ingreso_familiar }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Observaciones:</strong>
            {{ $historia->paciente->datosEconomico->observacion ?: 'Sin observaciones' }}
          </td>
        </tr>
      </table>
    </div>

    <!-- Sección III: Parentescos -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #00869b; border-bottom: 2px solid #00869b; padding-bottom: 5px; font-size: 14px; margin-bottom: 15px;">
        III. Parentescos
      </h2>

      <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
        <thead>
          <tr>
            <th style="padding: 8px; border: 1px solid #ddd; background-color: #f4f4f4;">Nombre</th>
            <th style="padding: 8px; border: 1px solid #ddd; background-color: #f4f4f4;">Apellido</th>
            <th style="padding: 8px; border: 1px solid #ddd; background-color: #f4f4f4;">Fecha de Nacimiento</th>
            <th style="padding: 8px; border: 1px solid #ddd; background-color: #f4f4f4;">Parentesco</th>
            <th style="padding: 8px; border: 1px solid #ddd; background-color: #f4f4f4;">Discapacidad</th>
            <th style="padding: 8px; border: 1px solid #ddd; background-color: #f4f4f4;">Tipo de Discapacidad</th>
            <th style="padding: 8px; border: 1px solid #ddd; background-color: #f4f4f4;">Enfermedad Crónica</th>
            <th style="padding: 8px; border: 1px solid #ddd; background-color: #f4f4f4;">Tipo de Enfermedad</th>
          </tr>
        </thead>
        <tbody>
          @if ($historia->paciente->parentescos->isEmpty())
            <tr>
              <td colspan="8" style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                No hay familiares registrados.
              </td>
            </tr>
          @else
            @foreach ($historia->paciente->parentescos as $parentesco)
              <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $parentesco->nombre }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $parentesco->apellido }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $parentesco->fecha_nac }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $parentesco->parentesco }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $parentesco->discapacidad }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $parentesco->tipo_discapacidad }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $parentesco->enfermedad_cronica }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $parentesco->tipo_enfermedad }}</td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>

    <!-- Sección IV: Antecedentes Médicos -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #00869b; border-bottom: 2px solid #00869b; padding-bottom: 5px; font-size: 14px; margin-bottom: 15px;">
        IV. Antecedentes Médicos
      </h2>

      <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Enfermedad Infecciosa:</strong> {{ $historia->antecedenteMedico->enfermedad_infecciosa }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Enfermedad Infecciosa:</strong>
            {{ $historia->antecedenteMedico->tipo_enfermedad_infecciosa }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Enfermedad No Infecciosa:</strong> {{ $historia->antecedenteMedico->enfermedad_no_infecciosa }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Enfermedad No Infecciosa:</strong>
            {{ $historia->antecedenteMedico->tipo_enfermedad_no_infecciosa }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Enfermedad Crónica:</strong> {{ $historia->antecedenteMedico->enfermedad_cronica }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Enfermedad Crónica:</strong> {{ $historia->antecedenteMedico->tipo_enfermedad_cronica }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Discapacidad:</strong> {{ $historia->antecedenteMedico->discapacidad }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Discapacidad:</strong> {{ $historia->antecedenteMedico->tipo_discapacidad }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Otros:</strong> {{ $historia->antecedenteMedico->otros }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Observaciones:</strong> {{ $historia->antecedenteMedico->observacion ?: 'Sin observaciones' }}
          </td>
        </tr>
      </table>
    </div>

    <!-- Sección V: Historia de Desarrollo -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #00869b; border-bottom: 2px solid #00869b; padding-bottom: 5px; font-size: 14px; margin-bottom: 15px;">
        V. Historia de Desarrollo
      </h2>

      <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Medicamentos durante el embarazo:</strong>
            {{ $historia->historiaDesarrollo->medicamento_embarazo }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Medicamento:</strong> {{ $historia->historiaDesarrollo->tipo_medicamento }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Fumó durante el embarazo:</strong> {{ $historia->historiaDesarrollo->fumo_embarazo }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Cantidad:</strong> {{ $historia->historiaDesarrollo->cantidad }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Consumo de alcohol en el embarazo:</strong> {{ $historia->historiaDesarrollo->alcohol_embarazo }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Alcohol:</strong> {{ $historia->historiaDesarrollo->tipo_alcohol }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Cantidad de alcohol consumida:</strong>
            {{ $historia->historiaDesarrollo->cantidad_consumia_alcohol }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Consumo de drogas en el embarazo:</strong> {{ $historia->historiaDesarrollo->droga_embarazo }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Droga:</strong> {{ $historia->historiaDesarrollo->tipo_droga }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Forceps en el parto:</strong> {{ $historia->historiaDesarrollo->forceps_parto }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Cesárea:</strong> {{ $historia->historiaDesarrollo->cesarea }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Razón de la Cesárea:</strong> {{ $historia->historiaDesarrollo->razon_cesarea }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Niño prematuro:</strong> {{ $historia->historiaDesarrollo->niño_prematuro }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Meses prematuro:</strong> {{ $historia->historiaDesarrollo->meses_prematuro }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Peso del niño al nacer:</strong> {{ $historia->historiaDesarrollo->peso_nacer_niño }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Complicaciones al nacer:</strong> {{ $historia->historiaDesarrollo->complicaciones_nacer }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Complicación:</strong> {{ $historia->historiaDesarrollo->tipo_complicacion }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Problemas de alimentación:</strong> {{ $historia->historiaDesarrollo->problema_alimentacion }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Problema de Alimentación:</strong>
            {{ $historia->historiaDesarrollo->tipo_problema_alimenticio }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Problemas para dormir:</strong> {{ $historia->historiaDesarrollo->problema_dormir }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Problema para Dormir:</strong> {{ $historia->historiaDesarrollo->tipo_problema_dormir }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>El niño era tranquilo recién nacido:</strong>
            {{ $historia->historiaDesarrollo->tranquilo_recien_nacido }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Le gustaba que lo cargaran recién nacido:</strong>
            {{ $historia->historiaDesarrollo->gustaba_cargaran_recien_nacido }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>El niño era alerta recién nacido:</strong>
            {{ $historia->historiaDesarrollo->alerta_recien_nacido }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Problemas de desarrollo en los primeros años:</strong>
            {{ $historia->historiaDesarrollo->problemas_desarrollo_primeros_años }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>¿Cuáles problemas?:</strong> {{ $historia->historiaDesarrollo->cuales_problemas }}
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">
            <strong>Observaciones:</strong> {{ $historia->historiaDesarrollo->observacion ?: 'Sin observaciones' }}
          </td>
        </tr>
      </table>
    </div>

    <!-- Sección VI: Historia Escolar -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #00869b; border-bottom: 2px solid #00869b; padding-bottom: 5px; font-size: 14px; margin-bottom: 15px;">
        VI. Historia Escolar
      </h2>

      <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Escolarizado:</strong> {{ $historia->historiaEscolar->escolarizado }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tipo de Educación:</strong> {{ $historia->historiaEscolar->tipo_educacion }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Modalidad de Educación:</strong> {{ $historia->historiaEscolar->modalidad_educacion }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Nombre de la Escuela:</strong> {{ $historia->historiaEscolar->nombre_escuela }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Tutorías o Terapias:</strong> {{ $historia->historiaEscolar->tutoria_terapias }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>¿Cuáles Tutorías o Terapias?:</strong> {{ $historia->historiaEscolar->tutoria_terapias_cuales }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Dificultad para la Lectura:</strong> {{ $historia->historiaEscolar->dificultad_lectura }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Dificultad para la Aritmética:</strong> {{ $historia->historiaEscolar->dificultad_aritmetica }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Dificultad para Escribir:</strong> {{ $historia->historiaEscolar->dificultad_escribir }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Le Agrada la Escuela:</strong> {{ $historia->historiaEscolar->agrada_escuela }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Otro Servicio:</strong> {{ $historia->historiaEscolar->otro_servicio }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;"></td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">
            <strong>Observaciones:</strong> {{ $historia->historiaEscolar->observacion ?: 'Sin observaciones' }}
          </td>
        </tr>
      </table>
    </div>
  </section>

  <!-- Footer -->
  <div style="background-color: #00869b; color: white; text-align: center; padding: 10px 0;">
    <p style="margin: 0;">© PsicoDesarrollo {{ now()->year }} • Av. Principal, Edificio XYZ • Teléfono: 0212-5555555
    </p>
  </div>

</body>

</html>
