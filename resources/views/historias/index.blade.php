@extends('layouts.root')

@section('title', 'Historias')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Historias" icon="zmdi zmdi-file zmdi-hc-fw" />

    <section class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('crear historia'))
              <li><a href="#new-historia" data-toggle="tab"> Nuevo</a></li>
            @endif
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-historias">
                  <thead>
                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Nombre</th>
                      <th style="text-align: center">Apellido</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <section class="tab-pane fade in" id="new-historia">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-historia">
                      @csrf
                      <section id="paso1">
                        <h3>Datos del paciente</h3>

                        <div class="form-row">
                          <!-- Paciente -->
                          <div class="form-group col-md-6">
                            <label>Paciente <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="paciente_id" name="paciente_id">
                              <option selected disabled>Seleccione el paciente</option>
                            </select>
                            <small class="form-text text-muted">
                              Busque por: <strong>nombre del paciente</strong> o <strong>cédula del
                                representante</strong>.
                              Solo se muestran pacientes que no tienen historia clínica registrada.
                            </small>
                          </div>

                          <!-- Código de Historia -->
                          <div class="form-group col-md-6">
                            <label>Código de Historia <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly id="codigo" name="codigo"
                              placeholder="Código" required value="{{ 'HIS' . substr(str_shuffle('0123456789'), 0, 5) }}">
                            <small class="form-text text-muted">Este código es generado
                              automáticamente por el sistema.</small>
                          </div>

                          <!-- Referencia -->
                          <div class="form-group col-md-6">
                            <label>Referencia <span class="text-danger">*</span></label>
                            <input class="form-control" id="referencia" name="referencia" type="text" required>
                            <small class="form-text text-muted">Indique quién refirió al
                              paciente o si viene por iniciativa propia.</small>
                          </div>

                          <!-- Especialidad que Refirió -->
                          <div class="form-group col-md-6">
                            <label>Especialidad que Refirió <span class="text-danger">*</span></label>
                            <input class="form-control" id="especialista_refirio" name="especialista_refirio"
                              type="text" required>
                            <small class="form-text text-muted">Ingrese la especialidad médica
                              que remitió al paciente (ej. Pediatría, Neurología).</small>
                          </div>

                          <!-- Motivo -->
                          <div class="form-group col-md-6">
                            <label>Motivo <span class="text-danger">*</span></label>
                            <input class="form-control" id="motivo" name="motivo" type="text" required>
                            <small class="form-text text-muted">Describa brevemente el motivo de
                              la evaluación.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Observaciones generales (Opcional)</label>
                            <textarea class="form-control" name="observacion_historia" rows="3"></textarea>
                            <small class="form-text text-muted">
                              Notas adicionales sobre la historia clínica.
                            </small>
                          </div>
                        </div>

                        <p class="centro-texto">
                          <button type="button" id="siguiente1" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </p>
                      </section>

                      <section id="paso2">
                        <h3>Antecedentes Médicos</h3>
                        <p class="text-muted mb-4">
                          Aquí se recopila información sobre enfermedades infecciosas, crónicas,
                          discapacidades u otras condiciones relevantes que el niño haya padecido.
                        </p>

                        <div class="row">
                          <!-- Enfermedad Infecciosa -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿El niño ha sufrido de alguna enfermedad infecciosa? <span class="text-danger">*</span>
                            </h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="enfermedad_infecciosa" value="si" required> Sí
                              </label>
                              <label class="mr-3">
                                <input type="radio" name="enfermedad_infecciosa" value="no"> No
                              </label>
                              <input class="form-control mt-2" id="tipo_enfermedad_infecciosa"
                                name="tipo_enfermedad_infecciosa" type="text"
                                placeholder="Especificar enfermedad infecciosa">
                            </div>
                            <small class="form-text text-muted">Indique si el niño ha tenido enfermedades como varicela,
                              sarampión, etc.</small>
                          </div>

                          <!-- Enfermedad No Infecciosa -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿El niño ha sufrido de alguna enfermedad no infecciosa? <span
                                class="text-danger">*</span></h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="enfermedad_no_infecciosa" value="si" required> Sí
                              </label>
                              <label class="mr-3">
                                <input type="radio" name="enfermedad_no_infecciosa" value="no"> No
                              </label>
                              <input class="form-control mt-2" id="tipo_enfermedad_no_infecciosa"
                                name="tipo_enfermedad_no_infecciosa" type="text"
                                placeholder="Especificar enfermedad no infecciosa">
                            </div>
                            <small class="form-text text-muted">Ejemplos: alergias, epilepsia, asma. Especifique si
                              responde "Sí".</small>
                          </div>

                          <!-- Enfermedad Crónica -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿El niño padece de alguna enfermedad crónica? <span class="text-danger">*</span></h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="enfermedad_cronica" value="si" required> Sí
                              </label>
                              <label class="mr-3">
                                <input type="radio" name="enfermedad_cronica" value="no"> No
                              </label>
                              <input class="form-control mt-2" id="tipo_enfermedad_cronica"
                                name="tipo_enfermedad_cronica" type="text"
                                placeholder="Especificar enfermedad crónica">
                            </div>
                            <small class="form-text text-muted">Ejemplos: diabetes, hipertensión, enfermedades
                              metabólicas.</small>
                          </div>

                          <!-- Discapacidad -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿El niño padece de alguna discapacidad? <span class="text-danger">*</span></h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="discapacidad" value="si" required> Sí
                              </label>
                              <label class="mr-3">
                                <input type="radio" name="discapacidad" value="no"> No
                              </label>
                              <input class="form-control mt-2" id="tipo_discapacidad" name="tipo_discapacidad"
                                type="text" placeholder="Especificar discapacidad">
                            </div>
                            <small class="form-text text-muted">Ejemplos: visual, auditiva, motora, intelectual.</small>
                          </div>

                          <!-- Otros (centrado abajo) -->
                          <div class="form-group col-md-6 mt-3">
                            <label for="otros"><strong>Otros</strong></label>
                            <textarea class="form-control" id="otros" name="otros" rows="3"></textarea>
                            <small class="form-text text-muted">
                              Ingrese cualquier otro antecedente médico relevante que no haya sido mencionado
                              anteriormente.
                            </small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Observaciones médicas (Opcional)</label>
                            <textarea class="form-control" name="observacion_antecedentes" rows="3"></textarea>
                            <small class="form-text text-muted">
                              Ejemplo: alergias no mencionadas, historial familiar relevante, etc.
                            </small>
                          </div>
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
                        <h3>Historia de desarrollo</h3>
                        <h4>Embarazo</h4>
                        <p class="text-muted mb-4">
                          Se refiere a las condiciones que rodearon el embarazo de la madre.
                          Esta información es clave para comprender el desarrollo del niño.
                        </p>

                        <div class="row">
                          <!-- Medicamentos en el embarazo -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿La madre recibió algún tipo de medicamento?<span class="text-danger">*</h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="medicamento_embarazo" value="si"> Sí
                              </label>
                              <label class="mr-3">
                                <input type="radio" name="medicamento_embarazo" value="no"> No
                              </label>
                              <input class="form-control mt-2" id="tipo_medicamento" name="tipo_medicamento"
                                type="text" placeholder="Especificar medicamento">
                            </div>
                            <small class="form-text text-muted">Indique si la madre consumió medicamentos recetados o no
                              durante el embarazo.</small>
                          </div>

                          <!-- Fumó durante el embarazo -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿La madre fumó durante el embarazo?<span class="text-danger">*</h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="fumo_embarazo" value="si"> Sí
                              </label>
                              <label class="mr-3">
                                <input type="radio" name="fumo_embarazo" value="no"> No
                              </label>
                              <input class="form-control mt-2" name="cantidad" id="cantidad" type="text"
                                placeholder="Cantidad que fumaba al día">
                            </div>
                            <small class="form-text text-muted">Ingrese la cantidad estimada que fumaba diariamente si
                              aplica.</small>
                          </div>

                          <!-- Bebidas alcohólicas durante el embarazo -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿La madre tomó bebidas alcohólicas durante el embarazo?<span class="text-danger">*</h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="alcohol_embarazo" value="si"> Sí
                              </label>
                              <label class="mr-3">
                                <input type="radio" name="alcohol_embarazo" value="no"> No
                              </label>
                              <input class="form-control mt-2" name="tipo_alcohol" id="tipo_alcohol" type="text"
                                placeholder="Especificar el tipo de alcohol">
                              <input class="form-control mt-2" name="cantidad_consumia_alcohol"
                                id="cantidad_consumia_alcohol" type="text"
                                placeholder="Especificar cantidad consumida">
                            </div>
                            <small class="form-text text-muted">Indique tipo y frecuencia si la madre consumió alcohol
                              durante el embarazo.</small>
                          </div>

                          <!-- Drogas durante el embarazo -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿La madre utilizó drogas durante el embarazo?<span class="text-danger">*</h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="droga_embarazo" value="si"> Sí
                              </label>
                              <label class="mr-3">
                                <input type="radio" name="droga_embarazo" value="no"> No
                              </label>
                              <input class="form-control mt-2" name="tipo_droga" id="tipo_droga" type="text"
                                placeholder="Especificar la droga utilizada">
                            </div>
                            <small class="form-text text-muted">Mencione el tipo de sustancia y si fue ocasional o
                              continua.</small>
                          </div>
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

                      <section id="paso4">
                        <h3>Historia de desarrollo</h3>
                        <h4>Parto</h4>
                        <p class="text-muted mb-4">
                          Esta sección recopila información sobre el nacimiento del niño,
                          incluyendo condiciones médicas y tipo de parto.
                        </p>

                        <div class="row">
                          <!-- Fórceps -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿Se utilizaron fórceps durante el parto?<span class="text-danger">*</h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="forceps_parto" value="si"> Sí
                              </label>
                              <label>
                                <input type="radio" name="forceps_parto" value="no"> No
                              </label>
                            </div>
                            <small class="form-text text-muted">Indique si fue necesario el uso de fórceps para facilitar
                              el parto.</small>
                          </div>

                          <!-- Cesárea -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿El parto fue por cesárea?<span class="text-danger">*</h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="cesarea" value="si"
                                  onchange="toggleInput('cesarea', 'razon_cesarea')"> Sí
                              </label>
                              <label>
                                <input type="radio" name="cesarea" value="no"
                                  onchange="toggleInput('cesarea', 'razon_cesarea')"> No
                              </label>
                              <input class="form-control mt-2" name="razon_cesarea" id="razon_cesarea" type="text"
                                placeholder="Razón de la cesárea" style="display: none;">
                            </div>
                            <small class="form-text text-muted">Si el parto fue por cesárea, explique el motivo médico o
                              de urgencia.</small>
                          </div>

                          <!-- Prematuro -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿El niño nació prematuro?<span class="text-danger">*</h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="niño_prematuro" value="si"
                                  onchange="toggleInput('niño_prematuro', 'meses_prematuro')"> Sí
                              </label>
                              <label>
                                <input type="radio" name="niño_prematuro" value="no"
                                  onchange="toggleInput('niño_prematuro', 'meses_prematuro')"> No
                              </label>
                              <input class="form-control mt-2" name="meses_prematuro" id="meses_prematuro"
                                type="text" placeholder="¿Cuántos meses prematuro?" style="display: none;">
                            </div>
                            <small class="form-text text-muted">En caso afirmativo, indique la cantidad de semanas o
                              meses de prematuridad.</small>
                          </div>

                          <!-- Complicaciones -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿Hubo complicaciones en el nacimiento?<span class="text-danger">*</h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="complicaciones_nacer" value="si"
                                  onchange="toggleInput('complicaciones_nacer', 'tipo_complicacion')"> Sí
                              </label>
                              <label>
                                <input type="radio" name="complicaciones_nacer" value="no"
                                  onchange="toggleInput('complicaciones_nacer', 'tipo_complicacion')"> No
                              </label>
                              <input class="form-control mt-2" name="tipo_complicacion" id="tipo_complicacion"
                                type="text" placeholder="Especificar la complicación" style="display: none;">
                            </div>
                            <small class="form-text text-muted">Describa cualquier complicación que haya ocurrido durante
                              el nacimiento.</small>
                          </div>

                          <!-- Peso al nacer -->
                          <div class="form-group col-md-6 mb-4">
                            <label>Peso al nacer<span class="text-danger">*</label>
                            <input class="form-control" id="peso_nacer_niño" name="peso_nacer_niño" type="text"
                              placeholder="Ejemplo: 3.2" required>
                            <small class="form-text text-muted">Ingrese el peso del niño al nacer, expresado en
                              kilogramos.</small>
                          </div>
                        </div>

                        <!-- Botones de navegación -->
                        <div class="text-center mt-4">
                          <button type="button" id="regresar3" class="btn btn-regresar mr-3" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="button" id="siguiente4" class="btn btn-regresar"
                            style="color: white;">Siguiente</button>
                        </div>
                      </section>

                      <section id="paso5">
                        <h3>Historia de desarrollo</h3>
                        <h4>Primeros meses del niño</h4>
                        <p class="text-muted mb-4">A continuación, se recopila información sobre las primeras
                          experiencias del niño en cuanto a alimentación, sueño, comportamiento y desarrollo general.</p>

                        <div class="row">
                          <!-- Problema de alimentación -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿Hubo algún tipo de problema de alimentación?<span class="text-danger">*</h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="problema_alimentacion" value="si"
                                  onchange="toggleInput('problema_alimentacion', 'tipo_problema_alimenticio')"> Sí
                              </label>
                              <label>
                                <input type="radio" name="problema_alimentacion" value="no"
                                  onchange="toggleInput('problema_alimentacion', 'tipo_problema_alimenticio')"> No
                              </label>
                              <input class="form-control mt-2 flex-grow-1 ml-md-3" name="tipo_problema_alimenticio"
                                id="tipo_problema_alimenticio" type="text"
                                placeholder="Especificar tipo de problema alimenticio" style="display: none;">
                            </div>
                            <small class="form-text text-muted">Ejemplo: dificultad para succionar, rechazo al alimento,
                              vómitos frecuentes, etc.</small>
                          </div>

                          <!-- Problemas para dormir -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿El niño tenía problemas para dormir?<span class="text-danger">*</h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="problema_dormir" value="si"
                                  onchange="toggleInput('problema_dormir', 'tipo_problema_dormir')"> Sí
                              </label>
                              <label>
                                <input type="radio" name="problema_dormir" value="no"
                                  onchange="toggleInput('problema_dormir', 'tipo_problema_dormir')"> No
                              </label>
                              <input class="form-control mt-2 flex-grow-1 ml-md-3" name="tipo_problema_dormir"
                                id="tipo_problema_dormir" type="text"
                                placeholder="Especificar tipo de problema para dormir" style="display: none;">
                            </div>
                            <small class="form-text text-muted">Ejemplo: insomnio, dificultad para conciliar el sueño,
                              despertares frecuentes, etc.</small>
                          </div>

                          <!-- Tranquilo al nacer -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>Cuando recién nacido, ¿el niño era tranquilo?<span class="text-danger">*</h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="tranquilo_recien_nacido" value="si"> Sí
                              </label>
                              <label>
                                <input type="radio" name="tranquilo_recien_nacido" value="no"> No
                              </label>
                            </div>
                            <small class="form-text text-muted">Responda según su comportamiento general durante los
                              primeros días.</small>
                          </div>

                          <!-- Gustaba que lo cargaran -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>Cuando recién nacido, ¿al niño le gustaba que lo cargaran?<span class="text-danger">*
                            </h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="gustaba_cargaran_recien_nacido" value="si"> Sí
                              </label>
                              <label>
                                <input type="radio" name="gustaba_cargaran_recien_nacido" value="no"> No
                              </label>
                            </div>
                            <small class="form-text text-muted">Indique si mostraba comodidad o rechazo al contacto
                              físico.</small>
                          </div>

                          <!-- Estaba alerta -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>Cuando recién nacido, ¿el niño estaba alerta?<span class="text-danger">*</h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="alerta_recien_nacido" value="si"> Sí
                              </label>
                              <label>
                                <input type="radio" name="alerta_recien_nacido" value="no"> No
                              </label>
                            </div>
                            <small class="form-text text-muted">Observe si el niño reaccionaba a estímulos visuales o
                              auditivos desde los primeros días.</small>
                          </div>

                          <!-- Problemas en el desarrollo -->
                          <div class="form-group col-md-6 mb-4">
                            <h5>¿Hubo algún problema o complicación en el crecimiento y desarrollo del niño en los
                              primeros años de vida?<span class="text-danger">*</h5>
                            <div class="d-flex flex-wrap align-items-center">
                              <label class="mr-3">
                                <input type="radio" name="problemas_desarrollo_primeros_años" value="si"
                                  onchange="toggleInput('problemas_desarrollo_primeros_años', 'cuales_problemas')"> Sí
                              </label>
                              <label>
                                <input type="radio" name="problemas_desarrollo_primeros_años" value="no"
                                  onchange="toggleInput('problemas_desarrollo_primeros_años', 'cuales_problemas')"> No
                              </label>
                              <input class="form-control mt-2 flex-grow-1 ml-md-3" name="cuales_problemas"
                                id="cuales_problemas" type="text"
                                placeholder="Especificar el problema o complicación" style="display: none;">
                            </div>
                            <small class="form-text text-muted">Por ejemplo: retraso en el habla, problemas motores,
                              dificultades sensoriales, etc.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Observaciones del desarrollo (Opcional)</label>
                            <textarea class="form-control" name="observacion_desarrollo" rows="3"></textarea>
                            <small class="form-text text-muted">
                              Ejemplo: hitos del desarrollo alcanzados, comportamientos atípicos, etc.
                            </small>
                          </div>
                        </div>

                        <!-- Botones de navegación -->
                        <div class="text-center mt-4">
                          <button type="button" id="regresar4" class="btn btn-regresar mr-3" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="button" id="siguiente5" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </div>
                      </section>

                      <section id="paso6">
                        <h3>Historia Escolar</h3>
                        <div class="form-row">

                          <!-- ¿Está escolarizado? -->
                          <div class="form-group col-md-6">
                            <h5>¿El niño está escolarizado?<span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="escolarizado" value="si" required>
                                <span>Si</span>
                              </label>
                              <label class="ml-3">
                                <input type="radio" name="escolarizado" value="no">
                                <span>No</span>
                              </label>
                              <select class="form-control ml-3 mt-2" name="tipo_educacion" id="tipo_educacion">
                                <option value="" disabled selected>Seleccione el tipo de educación</option>
                                <option value="pública">Pública</option>
                                <option value="privada">Privada</option>
                                <option value="semi_privada">Semi Privada</option>
                              </select>

                              <!-- Modalidad de educación -->
                              <select class="form-control ml-3 mt-2" name="modalidad_educacion"
                                id="modalidad_educacion">
                                <option value="" disabled selected>Seleccione la modalidad de educación</option>
                                <option value="educacion_inicial">Educación Inicial</option>
                                <option value="educacion_primaria">Educación Primaria</option>
                                <option value="educacion_especial">Educación Especial</option>
                              </select>

                              <input class="form-control ml-3 mt-2" name="nombre_escuela" id="nombre_escuela"
                                type="text" placeholder="Nombre de la escuela">
                            </div>
                            <small class="form-text text-muted">
                              Indique si el niño asiste a preescolar, primaria u otra modalidad educativa.
                            </small>
                          </div>

                          <!-- ¿Recibe terapias o tutoría? -->
                          <div class="form-group col-md-6">
                            <h5>¿Recibe alguna terapia o tutoría?<span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="tutoria_terapias" value="si" required>
                                <span>Si</span>
                              </label>
                              <label class="ml-3">
                                <input type="radio" name="tutoria_terapias" value="no">
                                <span>No</span>
                              </label>
                              <input class="form-control ml-3" name="tutoria_terapias_cuales"
                                id="tutoria_terapias_cuales" type="text"
                                placeholder="Especificar las terapias o tutorías que recibe el niño">
                            </div>
                            <small class="form-text text-muted">
                              Por ejemplo: terapia del lenguaje, psicopedagogía, apoyo escolar, etc.
                            </small>
                          </div>

                          <!-- Dificultad lectura -->
                          <div class="form-group col-md-6">
                            <h5>¿El niño presenta alguna dificultad para la lectura?<span class="text-danger">*</span>
                            </h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="dificultad_lectura" value="si" required>
                                <span>Si</span>
                              </label>
                              <label class="ml-3">
                                <input type="radio" name="dificultad_lectura" value="no">
                                <span>No</span>
                              </label>
                            </div>
                            <small class="form-text text-muted">
                              Considere si el niño tiene problemas para reconocer letras o palabras.
                            </small>
                          </div>

                          <!-- Dificultad aritmética -->
                          <div class="form-group col-md-6">
                            <h5>¿El niño presenta alguna dificultad para la aritmética?<span class="text-danger">*</span>
                            </h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="dificultad_aritmetica" value="si" required>
                                <span>Si</span>
                              </label>
                              <label class="ml-3">
                                <input type="radio" name="dificultad_aritmetica" value="no">
                                <span>No</span>
                              </label>
                            </div>
                            <small class="form-text text-muted">Incluye dificultad para contar, sumar o comprender
                              conceptos numéricos básicos.</small>
                          </div>

                          <!-- Dificultad escritura -->
                          <div class="form-group col-md-6">
                            <h5>¿El niño presenta alguna dificultad para la escritura?<span class="text-danger">*</span>
                            </h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="dificultad_escribir" value="si" required>
                                <span>Si</span>
                              </label>
                              <label class="ml-3">
                                <input type="radio" name="dificultad_escribir" value="no">
                                <span>No</span>
                              </label>
                            </div>
                            <small class="form-text text-muted">
                              Puede tratarse de letra ilegible, errores ortográficos o dificultad para copiar.
                            </small>
                          </div>

                          <!-- ¿Le agrada el ambiente escolar? -->
                          <div class="form-group col-md-6">
                            <h5>¿Le agrada el ambiente escolar?<span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="agrada_escuela" value="si" required>
                                <span>Si</span>
                              </label>
                              <label class="ml-3">
                                <input type="radio" name="agrada_escuela" value="no">
                                <span>No</span>
                              </label>
                            </div>
                            <small class="form-text text-muted">
                              Responda si el niño asiste con entusiasmo, se siente cómodo o expresa agrado por su escuela.
                            </small>
                          </div>

                          <!-- Otro servicio al que asiste -->
                          <div class="form-group col-md-6">
                            <label>¿Asiste a algún otro tipo de servicio? (CAIPA, CDI, UPE, etc.)<span
                                class="text-danger">*</span></label>
                            <input class="form-control" name="otro_servicio" type="text"
                              placeholder="Indique el servicio si aplica">
                          </div>

                          <div class="form-group col-md-6">
                            <label>Observaciones escolares (Opcional)</label>
                            <textarea class="form-control" name="observacion_escolar" rows="3"></textarea>
                            <small class="form-text text-muted">
                              Ejemplo: relación con compañeros, necesidades educativas especiales, etc.
                            </small>
                          </div>
                        </div>

                        <p class="centro-texto">
                          <button type="button" id="regresar5" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="submit" name="registrar" class="btn btn-custom" style="color: white;">
                            <i class="zmdi zmdi-floppy"></i> Registrar
                          </button>
                        </p>
                      </section>
                    </form>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </section>
  </section>

@endsection

@section('js')
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
  <script src="{{ asset('js/select2/es.js') }}"></script>

  {{-- Select de pacientes --}}
  <script>
    $(function() {
      const pacientes = @json($pacientes);

      const pacientesSinHistoria = pacientes.filter(p => {
        const count = typeof p.historias_count === 'string' ?
          parseInt(p.historias_count) :
          p.historias_count;
        return count === 0;
      });

      $('#paciente_id').select2({
        placeholder: 'Seleccione el paciente',
        allowClear: true,
        data: pacientesSinHistoria.map((p) => ({
          id: p.id,
          text: `${p.nombre} ${p.apellido} ${p.representante ? '(CI: ' + p.representante.ci + ')' : '(Sin CI)'}`
        }))
      });
    });
  </script>

  {{-- Validaciones de formularios --}}
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

  <script>
    // Definir la función toggleInput en el contexto global
    function toggleInput(radioName, inputId, defaultValue) {
      if (defaultValue === undefined) defaultValue = 'no aplica';

      var $radioYes = $("input[name='" + radioName + "'][value='si']");
      var $input = $("#" + inputId);

      // Si alguno no existe, salimos para evitar errores.
      if (!$radioYes.length || !$input.length) return;

      var show = $radioYes.prop('checked');
      $input.toggle(show) // mostrar / ocultar
        .prop('required', show) // requerido si está visible
        .val(show ? '' : defaultValue);
    }

    $(function() { // DOM ready (jQuery 3.1.1)
      var toggleConfig = [{
          name: 'enfermedad_infecciosa',
          id: 'tipo_enfermedad_infecciosa'
        },
        {
          name: 'enfermedad_no_infecciosa',
          id: 'tipo_enfermedad_no_infecciosa'
        },
        {
          name: 'enfermedad_cronica',
          id: 'tipo_enfermedad_cronica'
        },
        {
          name: 'discapacidad',
          id: 'tipo_discapacidad'
        },
        {
          name: 'medicamento_embarazo',
          id: 'tipo_medicamento'
        },
        {
          name: 'fumo_embarazo',
          id: 'cantidad'
        },
        {
          name: 'droga_embarazo',
          id: 'tipo_droga'
        },
        {
          name: 'cesarea',
          id: 'razon_cesarea'
        },
        {
          name: 'niño_prematuro',
          id: 'meses_prematuro'
        },
        {
          name: 'complicaciones_nacer',
          id: 'tipo_complicacion'
        },
        {
          name: 'problema_alimentacion',
          id: 'tipo_problema_alimenticio'
        },
        {
          name: 'problema_dormir',
          id: 'tipo_problema_dormir'
        },
        {
          name: 'problemas_desarrollo_primeros_años',
          id: 'cuales_problemas'
        },
        {
          name: 'tutoria_terapias',
          id: 'tutoria_terapias_cuales'
        }
      ];

      /* --------- Radios “sí / no” estándar --------- */
      $.each(toggleConfig, function(i, cfg) {
        var $radios = $("input[name='" + cfg.name + "']");
        if (!$radios.length) return; // si no existe, pasamos al siguiente

        $radios.on('change', function() {
          toggleInput(cfg.name, cfg.id);
        });

        // Estado inicial
        toggleInput(cfg.name, cfg.id);
      });

      /* --------- Caso especial: alcohol (dos campos) --------- */
      var $alcoholRadios = $("input[name='alcohol_embarazo']");
      if ($alcoholRadios.length) {
        var toggleAlcohol = function() {
          var show = $("input[name='alcohol_embarazo'][value='si']").prop('checked');
          var $tipoAlcohol = $('#tipo_alcohol');
          var $cantidadAlcohol = $('#cantidad_consumia_alcohol');

          $tipoAlcohol.toggle(show)
            .prop('required', show)
            .val(show ? '' : 'no aplica');

          $cantidadAlcohol.toggle(show)
            .prop('required', show)
            .val(show ? '' : 'no aplica');
        };
        $alcoholRadios.on('change', toggleAlcohol);
        toggleAlcohol(); // estado inicial
      }
      /* --------- Caso especial: escolarizado (3 campos) --------- */
      var $escolarizadoRadios = $("input[name='escolarizado']");
      if ($escolarizadoRadios.length) {
        var toggleEscolarizado = function() {
          var show = $("input[name='escolarizado'][value='si']").prop('checked');

          var $tipo = $('#tipo_educacion');
          var $modalidad = $('#modalidad_educacion');
          var $escuela = $('#nombre_escuela');

          $tipo.toggle(show)
            .prop('required', show)
            .val(show ? '' : 'no aplica');

          $modalidad.toggle(show)
            .prop('required', show)
            .val(show ? '' : 'no aplica');

          $escuela.toggle(show)
            .prop('required', show)
            .val(show ? '' : 'no aplica');
        };

        $escolarizadoRadios.on('change', toggleEscolarizado);
        toggleEscolarizado(); // estado inicial
      }
    });
  </script>

  <script>
    $(document).ready(function() {
      var tablaHistorias = $('#tab-historias').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('historias.index') }}",
          type: 'GET',
        },
        columns: [{
            data: 'codigo'
          },
          {
            data: 'nombre'
          },
          {
            data: 'apellido'
          },
          {
            data: 'action',
            orderable: false,
            searchable: false
          } // Desactivar orden y búsqueda en la columna de acciones
        ]
      });

      var $peso = $('#peso_nacer_niño');
      $peso.attr('inputmode', 'numeric');

      $peso.on('input', function() {
        var el = this;

        var valorOriginal = el.value;
        var cursorOriginal = el.selectionStart;

        var digitosAntes = 0;
        for (var i = 0; i < cursorOriginal; i++) {
          if (/\d/.test(valorOriginal.charAt(i))) digitosAntes++;
        }

        var raw = valorOriginal.replace(/[^\d]/g, '');
        if (raw.length) {
          var kilos = raw.slice(0, 1);
          var gramos = raw.slice(1, 4).padEnd(3, '0');
          var nuevoValor = kilos + ',' + gramos + ' Kg';
          el.value = nuevoValor;
        } else {
          el.value = '';
        }
        var nuevoCursor = 0,
          vistos = 0;
        while (nuevoCursor < el.value.length && vistos < digitosAntes) {
          if (/\d/.test(el.value.charAt(nuevoCursor))) vistos++;
          nuevoCursor++;
        }
        nuevoCursor = Math.min(nuevoCursor, el.value.length - 3);
        el.setSelectionRange(nuevoCursor, nuevoCursor);
      });

      $peso.on('paste', function(e) {
        e.preventDefault();
      });

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(document).on('submit', '#registro-historia', function(e) {
        e.preventDefault();

        var $campoOtros = $('#otros');
        if ($campoOtros.val().trim() === '') {
          $campoOtros.val('no aplica');
        }

        if ($peso.val().trim() !== '') {
          var limpio = $peso.val().replace(/\s*Kg$/, '').replace(',', '.');
          $peso.val(limpio);
        }

        var formStr = $(this).serialize();
        var formArr = $(this).serializeArray();

        $.ajax({
          url: "{{ route('historias.store') }}",
          type: 'POST',
          data: formStr,
          success: function(resp) {
            $('#registro-historia')[0].reset();

            toastr.success(resp.message || 'Registro creado con éxito');

            // Recargar tabla
            tablaHistorias.ajax.reload();

            // Cambiar a la pestaña de lista
            $('.nav-tabs a[href="#list"]').tab('show');
          },
          error: function(xhr) {
            if (xhr.status === 422) {
              const errors = xhr.responseJSON.errors;
              for (const field in errors) {
                errors[field].forEach(error => {
                  toastr.error(error, 'Error', {
                    timeOut: 5000
                  });
                });
              }
            } else {
              toastr.error('Ocurrió un error al guardar la historia', 'Error');
            }
          }
        });
      });
    });
  </script>

@endsection
