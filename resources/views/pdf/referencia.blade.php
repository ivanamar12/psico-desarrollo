<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Referencia</title>
</head>

<body
  style="font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 0; background-color: #f4f4f4; color: #333;">

  <!-- Header -->
  <div style="background-color: #00869b; color: white; text-align: center; padding: 15px 0; margin-bottom: 20px;">
    <img src="{{ public_path('img/logo.png') }}" alt="Logo de PSICODESARROLLO"
      style="width: 70px; height: 70px; border-radius: 50%; border: 2px solid #fff; margin-bottom: 3px">
    <h1 style="margin: 0; font-size: 20px;">PSICODESARROLLO</h1>
  </div>

  <!-- Contenido principal -->
  <div
    style="max-width: 900px; margin: 0 auto; background: white; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

    <section style="text-align: right;">
      <h4>Fecha: {{ $referencia->getFormattedLongDateAttribute('fecha_emision') }}</h4>
    </section>

    <!-- Título de la referencia (centrado) -->
    <section style="width: 100%; text-align: center; margin: 16px 0;">
      <h3 style="margin: 0; font-size: 16px; font-weight: bold; font-style: italic;">{{ $referencia->titulo }}</h3>
    </section>

    <!-- Sección I: Datos de Identificación -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #00869b; border-bottom: 2px solid #00869b; padding-bottom: 5px; font-size: 14px; margin-bottom: 15px;">
        I. Datos de Identificación</h2>
      <table style="width: 100%; border-collapse: collapse;">
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Nombre:</strong> {{ $referencia->paciente->nombre . ' ' . $referencia->paciente->apellido }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Fecha de Nacimiento:</strong> {{ $referencia->paciente->fecha_formateada_ddmmyyyy }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Grado:</strong>
            {{ $referencia->paciente->historiaclinicas[0]->historiaEscolar->modalidad_educacion }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Sexo:</strong> {{ $referencia->paciente->genero->genero }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Edad:</strong> {{ $referencia->paciente->tiempo_transcurrido }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Escuela:</strong> {{ $referencia->paciente->historiaclinicas[0]->historiaEscolar->nombre_escuela }}
          </td>
        </tr>
      </table>
    </div>

    <!-- Sección II: Motivo de Consulta -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #00869b; border-bottom: 2px solid #00869b; padding-bottom: 5px; font-size: 14px; margin-bottom: 15px;">
        II. Motivo de Consulta</h2>
      <p style="text-align: justify; line-height: 1.6; margin: 0;">
        {{ $referencia->motivo }}
      </p>
    </div>

    <section style="margin-bottom: 104px">
      <p style="text-align: justify;line-height: 1.6;">
        <strong> (Presentación del caso) </strong>{{ $referencia->presentacion_caso }}
      </p>
      <p style="text-align: justify;line-height: 1.6;">
        <strong>(Antecedentes) </strong>{{ $referencia->antecedentes }}
      </p>
      <p style="text-align: justify;line-height: 1.6;">
        <strong>(Indicadores psicológicos) </strong>{{ $referencia->indicadores_psicologicos }}
      </p>
      <p style="text-align: justify; line-height: 1.6; margin: 0;">
        {{ $referencia->sugerencias }}
      </p>
      <p>Sin más que añadir, en espera de una pronta y positiva repuesta se despide de usted</p>
    </section>

    <!-- Firma -->
    <div style="text-align: right; margin-top: 50px;">
      <p style="border-top: 1px solid #333; display: inline-block; padding-top: 5px; margin: 0;">
        <strong>Esp. {{ $referencia->especialista->nombre . ' ' . $referencia->especialista->apellido }}</strong>
        <br>
        <span>
          C.I. {{ $referencia->especialista->ci }}
        </span>
        <br>
        <span>
          F.V.P. {{ $referencia->especialista->fvp }}
        </span>
      </p>
    </div>

  </div>

  <!-- Footer -->
  <div style="background-color: #00869b; color: white; text-align: center; padding: 10px 0;">
    <p style="margin: 0;">© PSICODESARROLLO {{ now()->year }} • Av. Principal, Edificio XYZ • Teléfono: 0212-5555555
    </p>
  </div>

</body>

</html>
