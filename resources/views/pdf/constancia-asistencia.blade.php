<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Constancia de Asistencia</title>
</head>

<body
  style="font-family: Arial, sans-serif; font-size: 14px; margin: 0; padding: 0; background-color: #f4f4f4; color: #333;">

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
      <h4>Fecha: {{ $constancia['issueDate'] }}</h4>
    </section>

    <!-- Título de la referencia (centrado) -->
    <section style="width: 100%; text-align: center; margin: 16px 0;">
      <h3 style="margin: 0; font-size: 16px; font-weight: bold; font-style: italic;">
        CONSTANCIA
      </h3>
    </section>

    <section style="text-align: justify; line-height: 1.6">
      <p>
        <span>Se hace constar que el(la) Niño(a): </span><span
          style="text-decoration: underline; font-weight: bold">{{ "{$paciente->nombre} {$paciente->apellido} de {$paciente->tiempo_transcurrido} de edad," }}</span><span>
          cursante de </span><span style="text-decoration: underline; font-weight: bold">
          {{ $paciente->historiaclinicas[0]->historiaEscolar->modalidad_educacion }},</span>
        {{ "en el {$paciente->historiaclinicas[0]->historiaEscolar->nombre_escuela}" }}, en calidad de estudiante
        regular. Ha asistido a evaluación e Intervención Psicológica los días: <span
          style="text-decoration: underline; font-weight: bold">
          @foreach ($citas as $year)
            {{ $year->map(fn($cita) => format_long_date($cita->fecha_consulta))->implode(', ', ' y ') }}
          @endforeach
        </span>.
      </p>

      <p>
        Constancia que se expide a la parte interesada <strong>{{ $constancia['issueDateLong'] }}</strong>.
      </p>

      <p>Sin más que añadir, se despide atentamente en espera de una pronta y positiva respuesta.</p>
    </section>

    <!-- Firma -->
    <div style="text-align: right; margin-top: 90px;">
      <p style="border-top: 1px solid #333; display: inline-block; padding-top: 5px; margin: 0;">
        <strong>Esp. {{ $especialista->nombre . ' ' . $especialista->apellido }}</strong>
        <br>
        <span>
          C.I. {{ $especialista->ci }}
        </span>
        <br>
        <span>
          F.V.P. {{ $especialista->fvp }}
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
