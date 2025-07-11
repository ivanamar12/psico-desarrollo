@extends('layouts.app')

@section('title', 'Informes')

@section('content')
  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Informes" icon="zmdi zmdi-assignment-o zmdi-hc-fw" />

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('generar informes'))
              <li><a href="#new-informe" data-toggle="tab"> Nuevo</a></li>
            @endif
          </ul>

          <section id="myTabContent" class="tab-content">
            <!-- Pestaña Lista -->
            <div class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-especialidad">
                  <thead>
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

            <!-- Pestaña Nuevo -->
            <div class="tab-pane fade" id="new-informe">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-informes">
                      @csrf
                      <section id="paso1">
                        <h3>I. Datos de identificación</h3>
                        <div class="form-row">

                          <!-- Paciente -->
                          <div class="form-group col-md-6">
                            <label>Paciente <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="paciente_id" name="paciente_id">
                              <option selected disabled>Seleccione el paciente</option>
                            </select>
                            <small class="form-text text-muted">Seleccione al paciente
                              registrado previamente en el sistema.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Especialista Responsable <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" readonly
                                   value="{{ $especialista_actual ? $especialista_actual->nombre . ' ' . $especialista_actual->apellido . ' - FVP: ' . $especialista_actual->fvp : 'No asignado' }}">

                            <input type="hidden" name="especialista_id" value="{{ $especialista_actual ? $especialista_actual->id : '' }}">

                            <small class="form-text text-muted">Este especialista ha sido asignado automáticamente por el sistema.</small>
                        </div>
                        <p class="text-center mt-3">
                          <button type="button" id="siguiente1" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </p>
                      </section>
                      <section id="paso2">
                          <div class="form-group col-md-12">
                            <h3>II. Motivo de Consulta</h3>
                            <p class="text-muted mb-4" id="motivo_completo_texto">
                            Seleccione un paciente para ver la información...
                            </p>
                            <label>Motivo <span class="text-danger">*</span></label>
                            <input class="form-control" id="motivo" name="motivo" type="textarea" required>
                            <small class="form-text text-muted">Redacte para el informe el motivo de la evaluacion.</small>
                          </div>

                           <div class="form-group col-md-12">
                              <h3>III. Instrumentos y Recursos</h3>
                              <h4>Instrumentos</h4>
                              <p class="text-muted mb-4" id="instrumentos_texto">
                                Seleccione un paciente para ver la información...
                              </p>
                              <label>Instrumentos <span class="text-danger">*</span></label>
                              <input class="form-control" id="motivo" name="motivo" type="textarea" required>
                              <small class="form-text text-muted">Redacte para el informe el como se aplicaron los instrumentos.</small>
                              <h4>Recursos</h4>
                              <p class="text-muted mb-4" id="recursos_texto">
                                Seleccione un paciente para ver la información...
                              </p>
                              <label>Recursos <span class="text-danger">*</span></label>
                              <input class="form-control" id="motivo" name="motivo" type="textarea" required>
                              <small class="form-text text-muted">Redacte para el informe como se aplicaron los recursos.</small>
                            </div>
                            <!-- Botones centrados -->
                          <div class="text-center mt-4">
                            <button type="button" id="regresar1" class="btn btn-regresar mr-3" style="color: white;">
                              <i class="zmdi zmdi-arrow-back"></i> Regresar
                            </button>
                            <button type="button" id="siguiente2" class="btn btn-regresar" style="color: white;">
                              Siguiente
                            </button>
                          </div>
                      </section>
                      <section id="paso3">
                        <h3>IV. Consideraciones Generales</h3>
                          <p class="text-muted mb-4" id="consideraciones_texto">
                            Seleccione un paciente para ver la información...
                          </p>
                        <div class="form-group col-md-12"><label>Consideraciones Generales <span class="text-danger">*</span></label>
                            <input class="form-control" id="motivo" name="motivo" type="textarea" required>
                            <small class="form-text text-muted">Redacte para el informe las concideraciones generales del paciente en la evaluacion.</small>
                          </div>
                        <!-- Botones centrados -->
                        <div class="text-center mt-4">
                          <button type="button" id="regresar2" class="btn btn-regresar mr-3" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="button" id="siguiente3" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </div>
                      </section>
                    <form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal editar -->
  
@endsection

@section('js')
<script>
  $(function () {
    const pacientes = @json($pacientes);
    const aplicaciones = @json($aplicaciones);

    $('#paciente_id').select2({
      placeholder: 'Seleccione paciente',
      allowClear: true,
      minimumInputLength: 1,
      ajax: {
        transport: function (params, success) {
          const term = (params.data.term || '').toLowerCase().trim();

          const filtrados = pacientes.filter(p =>
            p.nombre.toLowerCase().includes(term) ||
            p.apellido.toLowerCase().includes(term)
          );

          const results = filtrados.map(p => {
            const historia = p.historia_clinicas?.[0] || null;
            return {
              id: p.id,
              text: `${p.nombre} ${p.apellido} - Código: ${historia ? historia.codigo : 'Sin historia'}`,
              historia: historia
            };
          });

          success({ results });
        }
      }
    });

    $('#paciente_id').on('select2:select', function (e) {
  const pacienteId = e.params.data.id;
  const historia = e.params.data.historia;
  const paciente = pacientes.find(p => p.id === pacienteId);
  const historiaClinica = paciente.historia_clinicas?.[0];

  // Motivo de consulta
  const motivo = historia?.motivo || 'sin motivo';
  const referencia = historia?.referencia || 'sin referencia';
  const especialista = historia?.especialista_refirio || 'no especificado';
  $('#motivo_completo_texto').text(`Motivo: ${motivo}. Referido por: ${especialista}. Referencia: ${referencia}.`);

  // Instrumentos y Recursos
  const pruebasPaciente = aplicaciones[pacienteId] || [];
  let estructuradas = 0;
  let noEstructuradas = 0;
  let recursosTexto = '';

  pruebasPaciente.forEach(ap => {
    const prueba = ap.prueba;
    if (!prueba) return;
    if (prueba.tipo === 'Estandarizada') estructuradas++;
    else if (prueba.tipo === 'NO-Estandarizada') noEstructuradas++;
    recursosTexto += `• ${prueba.nombre} (${prueba.tipo})\n`;
  });

  $('#instrumentos_texto').text(`Se aplicaron ${estructuradas} pruebas Estandarizadas y ${noEstructuradas} NO-Estandarizadas.`);
  $('#recursos_texto').text(recursosTexto.trim());

  // -------- Consideraciones Generales organizadas por párrafos --------
  let consideraciones = '';

  // 1. Datos Socioeconómicos
  if (paciente.datos_economico) {
    const de = paciente.datos_economico;

    consideraciones += `<p><strong>Datos Socioeconómicos:</strong><br>`;

    consideraciones += `• Tipo de vivienda: ${de.tipo_vivienda}.<br>`;
    consideraciones += `• Número de habitaciones: ${de.cantidad_habitaciones}.<br>`;
    consideraciones += `• Número de personas que habitan: ${de.cantidad_personas}.<br>`;

    consideraciones += `• Servicios básicos disponibles:<br>`;
    consideraciones += `&nbsp;&nbsp;- Agua potable: ${de.servecio_agua_potable ? 'sí' : 'no'}<br>`;
    consideraciones += `&nbsp;&nbsp;- Gas: ${de.servecio_gas ? 'sí' : 'no'}<br>`;
    consideraciones += `&nbsp;&nbsp;- Electricidad: ${de.servecio_electricidad ? 'sí' : 'no'}<br>`;
    consideraciones += `&nbsp;&nbsp;- Drenaje: ${de.servecio_drenaje ? 'sí' : 'no'}<br>`;

    consideraciones += `• Acceso a servicios públicos: ${de.acceso_servcios_publicos ?? 'no especificado'}<br>`;

    consideraciones += `• Acceso a internet: ${de.disponibilidad_internet ? 'sí' : 'no'}`;
    if (de.tipo_conexion_internet) {
      consideraciones += ` (Tipo: ${de.tipo_conexion_internet})`;
    }
    consideraciones += '.<br>';

    consideraciones += `• Fuente principal de ingreso familiar: ${de.fuente_ingreso_familiar}.<br>`;

    if (de.observacion) {
      consideraciones += `• Observaciones adicionales: ${de.observacion}<br>`;
    }

    consideraciones += `</p>`;
  }

  // 2. Datos Familiares
  if (paciente.parentescos?.length > 0 || paciente.representante) {
    let familiares = '';
    paciente.parentescos?.forEach(fam => {
      familiares += `• ${fam.nombre} ${fam.apellido}, ${fam.parentesco}, nacido(a) el ${fam.fecha_nac}`;
      if (fam.discapacidad) familiares += `, discapacidad: ${fam.tipo_discapacidad}`;
      if (fam.enfermedad_cronica) familiares += `, enfermedad crónica: ${fam.tipo_enfermedad}`;
      familiares += '.<br>';
    });

    const rep = paciente.representante;
    if (rep) {
      familiares += `• Representante: ${rep.nombre} ${rep.apellido}, CI: ${rep.ci}, Teléfono: ${rep.telefono}, Email: ${rep.email}.<br>`;
    }

    consideraciones += `<p><strong>Datos Familiares:</strong><br>${familiares}</p>`;
  }

  // 3. Historia de Desarrollo
  if (historiaClinica?.historia_desarrollo) {
    const hd = historiaClinica.historia_desarrollo;

    consideraciones += `<p><strong>Historia de Desarrollo:</strong><br>`;

    // Embarazo
    consideraciones += `• Medicamentos durante el embarazo: ${hd.medicamento_embarazo ? 'sí' : 'no'}`;
    if (hd.tipo_medicamento) consideraciones += ` (${hd.tipo_medicamento})`;
    consideraciones += '.<br>';

    consideraciones += `• Fumó durante el embarazo: ${hd.fumo_embarazo ? 'sí' : 'no'}`;
    if (hd.cantidad) consideraciones += ` (Cantidad: ${hd.cantidad})`;
    consideraciones += '.<br>';

    consideraciones += `• Consumo de alcohol durante el embarazo: ${hd.alcohol_embarazo ? 'sí' : 'no'}`;
    if (hd.tipo_alcohol) consideraciones += ` (${hd.tipo_alcohol})`;
    if (hd.cantidad_consumia_alcohol) consideraciones += ` (Cantidad: ${hd.cantidad_consumia_alcohol})`;
    consideraciones += '.<br>';

    consideraciones += `• Consumo de drogas durante el embarazo: ${hd.droga_embarazo ? 'sí' : 'no'}`;
    if (hd.tipo_droga) consideraciones += ` (${hd.tipo_droga})`;
    consideraciones += '.<br>';

    // Nacimiento
    consideraciones += `• Nacimiento por fórceps: ${hd.forceps_parto ? 'sí' : 'no'}.<br>`;
    consideraciones += `• Nacimiento por cesárea: ${hd.cesarea ? 'sí' : 'no'}`;
    if (hd.razon_cesarea) consideraciones += ` (Razón: ${hd.razon_cesarea})`;
    consideraciones += '.<br>';
    consideraciones += `• Prematuro: ${hd.niño_prematuro ? 'sí' : 'no'}`;
    if (hd.meses_prematuro) consideraciones += ` (${hd.meses_prematuro} meses antes)`;
    consideraciones += '.<br>';
    consideraciones += `• Peso al nacer: ${hd.peso_nacer_niño} gramos.<br>`;
    consideraciones += `• Complicaciones al nacer: ${hd.complicaciones_nacer ? 'sí' : 'no'}`;
    if (hd.tipo_complicacion) consideraciones += ` (${hd.tipo_complicacion})`;
    consideraciones += '.<br>';

    // Lactancia y sueño
    consideraciones += `• Problemas de alimentación: ${hd.problema_alimentacion ? 'sí' : 'no'}`;
    if (hd.tipo_problema_alimenticio) consideraciones += ` (${hd.tipo_problema_alimenticio})`;
    consideraciones += '.<br>';

    consideraciones += `• Problemas para dormir: ${hd.problema_dormir ? 'sí' : 'no'}`;
    if (hd.tipo_problema_dormir) consideraciones += ` (${hd.tipo_problema_dormir})`;
    consideraciones += '.<br>';

    consideraciones += `• Tranquilo como recién nacido: ${hd.tranquilo_recien_nacido ? 'sí' : 'no'}.<br>`;
    consideraciones += `• Le gustaba que lo cargaran: ${hd.gustaba_cargaran_recien_nacido ? 'sí' : 'no'}.<br>`;
    consideraciones += `• Estaba alerta como recién nacido: ${hd.alerta_recien_nacido ? 'sí' : 'no'}.<br>`;

    // Desarrollo temprano
    consideraciones += `• Problemas en el desarrollo en los primeros años: ${hd.problemas_desarrollo_primeros_años ? 'sí' : 'no'}`;
    if (hd.cuales_problemas) consideraciones += ` (${hd.cuales_problemas})`;
    consideraciones += '.<br>';

    if (hd.observacion) {
      consideraciones += `• Observaciones: ${hd.observacion}<br>`;
    }

    consideraciones += `</p>`;
  }


  // 4. Historia Escolar
  if (historiaClinica?.historia_escolar) {
    const he = historiaClinica.historia_escolar;
    consideraciones += `<p><strong>Historia Escolar:</strong> Escolarizado: ${he.escolarizado ? 'sí' : 'no'}. Tipo de educación: ${he.tipo_educaion}. `
      + `Tutorías o terapias: ${he.tutoria_terapias ? `sí (${he.tutoria_terapias_cuales})` : 'no'}. `
      + `Dificultades: lectura (${he.dificultad_lectura}), escritura (${he.dificultad_escribir}), aritmética (${he.dificultad_aritmetica}).</p>`;
  }

  // 5. Antecedentes Médicos
  if (historiaClinica?.antecedente_medico) {
    const am = historiaClinica.antecedente_medico;

    consideraciones += `<p><strong>Antecedentes Médicos:</strong><br>`;

    consideraciones += `• Enfermedades infecciosas: ${am.enfermedad_infecciosa ? 'sí' : 'no'}${am.tipo_enfermedad_infecciosa ? ` (${am.tipo_enfermedad_infecciosa})` : ''}.<br>`;
    consideraciones += `• Enfermedades no infecciosas: ${am.enfermedad_no_infecciosa ? 'sí' : 'no'}${am.tipo_enfermedad_no_infecciosa ? ` (${am.tipo_enfermedad_no_infecciosa})` : ''}.<br>`;
    consideraciones += `• Enfermedades crónicas: ${am.enfermedad_cronica ? 'sí' : 'no'}${am.tipo_enfermedad_cronica ? ` (${am.tipo_enfermedad_cronica})` : ''}.<br>`;
    consideraciones += `• Discapacidad: ${am.discapacidad ? 'sí' : 'no'}${am.tipo_discapacidad ? ` (${am.tipo_discapacidad})` : ''}.<br>`;

    if (am.otros) {
      consideraciones += `• Otros: ${am.otros}<br>`;
    }

    if (am.observacion) {
      consideraciones += `• Observaciones: ${am.observacion}<br>`;
    }

    consideraciones += `</p>`;
  }


  // Mostrar en el HTML con saltos de línea y párrafos
  $('#consideraciones_texto').html(consideraciones);
});
    $('#paciente_id').on('select2:clear', function () {
      $('#motivo_completo_texto').text('Seleccione un paciente para ver la información...');
      $('#instrumentos_texto').text('Seleccione un paciente para ver la información...');
      $('#recursos_texto').text('Seleccione un paciente para ver la información...');
      $('#consideraciones_texto').text('Seleccione un paciente para ver la información...');
    });
  });
</script>

<script>
    $(document).ready(function() {
      $("#paso1").show();
      $("#paso2, #paso3, #paso4, #paso5, #paso6").hide();

      function setupRealTimeValidation(pasoId) {
        $(`${pasoId} :input[type="text"], ${pasoId} :input[type="textarea"]`).on('input', function() {
          const maxLength = 50;
          const currentValue = $(this).val();
          if (currentValue.length > maxLength) {
            $(this).val(currentValue.substring(0, maxLength));
            toastr.error(
              `El campo ${$(this).attr("name")} no debe superar los ${maxLength} caracteres.`);
          }
        });
      }
      setupRealTimeValidation("#paso1");
      setupRealTimeValidation("#paso2");
      setupRealTimeValidation("#paso3");
      setupRealTimeValidation("#paso4");
      setupRealTimeValidation("#paso5");
      setupRealTimeValidation("#paso6");

      function validarPaso(pasoId) {
        let valid = true;
        $(`${pasoId} :input[required]`).each(function() {
          if ($(this).is(':radio')) {
            const name = $(this).attr('name');
            if (!$(`${pasoId} input[name="${name}"]:checked`).length) {
              $(`${pasoId} input[name="${name}"]`).addClass("is-invalid");
              valid = false;
            } else {
              $(`${pasoId} input[name="${name}"]`).removeClass("is-invalid");
            }
          } else if ($(this).val() === '' || $(this).val() === null) {
            $(this).addClass("is-invalid");
            valid = false;
          } else {
            $(this).removeClass("is-invalid");
          }
        });

        // Validación de longitud para campos de descripción
        $(`${pasoId} :input[type="text"], ${pasoId} :input[type="textarea"]`).each(function() {
          if ($(this).val().length > 50) {
            $(this).addClass("is-invalid");
            toastr.error(`El campo ${$(this).attr("name")} no debe superar los 50 caracteres.`);
            valid = false;
          } else {
            $(this).removeClass("is-invalid");
          }
        });

        return valid;
      }

      $("#siguiente1").click(function() {
        if (validarPaso("#paso1")) {
          $("#paso1").hide();
          $("#paso2").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 1.");
        }
      });

      $("#siguiente2").click(function() {
        if (validarPaso("#paso2")) {
          $("#paso2").hide();
          $("#paso3").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 2.");
        }
      });

      $("#siguiente3").click(function() {
        if (validarPaso("#paso3")) {
          $("#paso3").hide();
          $("#paso4").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 3.");
        }
      });

      $("#siguiente4").click(function() {
        if (validarPaso("#paso4")) {
          $("#paso4").hide();
          $("#paso5").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 4.");
        }
      });

      $("#siguiente5").click(function() {
        if (validarPaso("#paso5")) {
          $("#paso5").hide();
          $("#paso6").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 5.");
        }
      });

      // Botones de regresar
      $("#regresar1").click(function() {
        $("#paso2").hide();
        $("#paso1").show();
      });

      $("#regresar2").click(function() {
        $("#paso3").hide();
        $("#paso2").show();
      });

      $("#regresar3").click(function() {
        $("#paso4").hide();
        $("#paso3").show();
      });

      $("#regresar4").click(function() {
        $("#paso5").hide();
        $("#paso4").show();
      });

      $("#regresar5").click(function() {
        $("#paso6").hide();
        $("#paso5").show();
      });
    });
</script>
@endsection
