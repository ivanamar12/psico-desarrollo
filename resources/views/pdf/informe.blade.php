<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Informe Psicoeducativo</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; color: #333;">

  <!-- Header -->
  <div style="background-color: #007bff; color: white; text-align: center; padding: 15px 0; margin-bottom: 20px;">
    <h1 style="margin: 0; font-size: 24px;">PsicoDesarrollo</h1>
    <p style="margin: 5px 0 0; font-size: 16px;">Informe Psicoeducativo</p>
  </div>

  <!-- Contenido principal -->
  <div
    style="max-width: 900px; margin: 0 auto; background: white; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

    <section style="text-align: right;">
      <h4>Fecha: {{ $informe->fecha_emision_larga }}</h4>
    </section>

    <!-- Sección I: Datos de Identificación -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 5px; font-size: 18px; margin-bottom: 15px;">
        I. Datos de Identificación</h2>
      <table style="width: 100%; border-collapse: collapse;">
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Nombre:</strong> {{ $informe->paciente->nombre . ' ' . $informe->paciente->apellido }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Fecha de Nacimiento:</strong> {{ $informe->paciente->fecha_formateada_ddmmyyyy }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Grado:</strong> Cortesía
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Sexo:</strong> {{ $informe->paciente->genero->genero }}
          </td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Edad:</strong> {{ $informe->paciente->tiempo_transcurrido }}
          </td>
          <td style="padding: 8px; border: 1px solid #ddd;">
            <strong>Escuela:</strong> Por Precisar
          </td>
        </tr>
      </table>
    </div>

    <!-- Sección II: Motivo de Consulta -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 5px; font-size: 18px; margin-bottom: 15px;">
        II. Motivo de Consulta</h2>
      <p style="text-align: justify; line-height: 1.6; margin: 0;">
        {{ $informe->motivo }}
      </p>
    </div>

    <!-- Sección III: Instrumentos y Recursos -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 5px; font-size: 18px; margin-bottom: 15px;">
        III. Instrumentos y Recursos
      </h2>

      <p style="margin: 0 0 10px 0;"><strong>Recursos:</strong></p>
      <p style="text-align: justify; line-height: 1.6; margin: 12px 0px;">
        {{ $informe->recursos }}
      </p>

      <p style="margin: 0 0 10px 0;"><strong>Instrumentos:</strong></p>
      <p style="text-align: justify; line-height: 1.6; margin: 12px 0px;">
        {{ $informe->instrumentos }}
      </p>
    </div>

    <!-- Sección IV: Consideraciones Generales -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 5px; font-size: 18px; margin-bottom: 15px;">
        IV. Consideraciones Generales</h2>
      <p style="text-align: justify; line-height: 1.6; margin: 0;">
        {{ $informe->condiciones_generales }}
      </p>
    </div>

    <!-- Sección V: Resultados Por Área -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 5px; font-size: 18px; margin-bottom: 15px;">
        V. Resultados Por Área</h2>

      <p style="margin: 0 0 10px 0;"><strong>• Física y Salud:</strong></p>
      <p style="text-align: justify; line-height: 1.6; margin: 0 0 15px 15px;">
        {{ $informe->fisica_salud }}
      </p>

      <p style="margin: 0 0 10px 0;"><strong>• Perceptivo motriz:</strong></p>
      <p style="text-align: justify; line-height: 1.6; margin: 0 0 15px 15px;">
        {{ $informe->perceptivo_motriz }}
      </p>

      <p style="margin: 0 0 10px 0;"><strong>• Coeficiente Intelectual:</strong></p>
      <p style="text-align: justify; line-height: 1.6; margin: 0 0 15px 15px;">
        {{ $informe->coeficiente_intelectual }}
      </p>

      <p style="margin: 0 0 10px 0;"><strong>• Afectiva Social:</strong></p>
      <p style="text-align: justify; line-height: 1.6; margin: 0 0 15px 15px;">
        {{ $informe->afectiva_social }}
      </p>
    </div>

    <!-- Sección VI: Conclusión -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 5px; font-size: 18px; margin-bottom: 15px;">
        VI. Conclusión</h2>
      <p style="text-align: justify; line-height: 1.6; margin: 0;">
        {{ $informe->conclusion }}
      </p>
    </div>

    <!-- Sección VII: Recomendaciones -->
    <div style="margin-bottom: 25px;">
      <h2
        style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 5px; font-size: 18px; margin-bottom: 15px;">
        VII. Recomendaciones</h2>
      <p style="text-align: justify; line-height: 1.6; margin: 0;">
        {{ $informe->recomendaciones }}
      </p>
    </div>

    <!-- Firma -->
    <div style="text-align: right; margin-top: 50px;">
      <p style="border-top: 1px solid #333; display: inline-block; padding-top: 5px; margin: 0;">
        <strong>Esp. {{ $informe->especialista->nombre . ' ' . $informe->especialista->apellido }}</strong>
        <br>
        <span>
          C.I. {{ $informe->especialista->ci }}
        </span>
        <br>
        <span>
          F.V.P. {{ $informe->especialista->fvp }}
        </span>
      </p>
    </div>

  </div>

  <!-- Footer -->
  <div style="background-color: #007bff; color: white; text-align: center; padding: 10px 0;">
    <p style="margin: 0;">© PsicoDesarrollo {{ now()->year }} • Av. Principal, Edificio XYZ • Teléfono: 0212-5555555
    </p>
  </div>

</body>

</html>
