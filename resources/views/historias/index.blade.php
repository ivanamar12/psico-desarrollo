@extends('layouts.app')

@section('title', 'Historias')

@section('content')
  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Historias" icon="zmdi zmdi-file zmdi-hc-fw" />

    <div class="container-fluid">
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
                      <th class="text-center">#</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Apellido</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

            <section class="tab-pane fade in" id="new-historia">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-hitoria">@csrf
                      <section id="paso1">
                        <h3>Datos del paciente</h3>
                        <div class="form-row">
                          
                          <!-- Paciente -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Paciente <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;" id="paciente_id" name="paciente_id">
                              <option selected disabled>Seleccione el paciente</option>
                            </select>
                            <small class="form-text text-muted">Seleccione al paciente registrado previamente en el sistema.</small>
                          </div>
                      
                          <!-- Código de Historia -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Código de Historia <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly id="codigo" name="codigo" placeholder="Código" required
                              value="{{ 'HIS' . substr(str_shuffle('0123456789'), 0, 5) }}">
                            <small class="form-text text-muted">Este código es generado automáticamente por el sistema.</small>
                          </div>
                      
                          <!-- Referencia -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Referencia <span class="text-danger">*</span></label>
                            <input class="form-control" id="referencia" name="referencia" type="text" required>
                            <small class="form-text text-muted">Indique quién refirió al paciente o si viene por iniciativa propia.</small>
                          </div>
                      
                          <!-- Especialidad que Refirió -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Especialidad que Refirió <span class="text-danger">*</span></label>
                            <input class="form-control" id="especialista_refirio" name="especialista_refirio" type="text" required>
                            <small class="form-text text-muted">Ingrese la especialidad médica que remitió al paciente (ej. Pediatría, Neurología).</small>
                          </div>
                      
                          <!-- Motivo -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Motivo <span class="text-danger">*</span></label>
                            <input class="form-control" id="motivo" name="motivo" type="text" required>
                            <small class="form-text text-muted">Describa brevemente el motivo de la evaluación.</small>
                          </div>
                      
                        </div>
                        <p class="centro-texto">
                          <button type="button" id="siguiente1" class="btn btn-regresar" style="color: white;">Siguiente</button>
                        </p>
                      </section>
                      
                      <section id="paso2">
                        <h3>Antecedentes Médicos</h3>
                        <div class="form-row">
                      
                          <!-- Enfermedad Infecciosa -->
                          <div class="form-group label-floating col-md-6">
                            <h5>¿El niño ha sufrido de alguna enfermedad infecciosa? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="enfermedad_infecciosa" value="si" required> <span>Sí</span>
                              </label>
                              <label class="ml-3">
                                <input type="radio" name="enfermedad_infecciosa" value="no"> <span>No</span>
                              </label>
                              <input class="form-control ml-3" id="tipo_enfermedad_infecciosa" name="tipo_enfermedad_infecciosa" type="text" placeholder="Especificar enfermedad infecciosa">
                            </div>
                            <small class="form-text text-muted">Indique si el niño ha tenido enfermedades como varicela, sarampión, etc. Especifique si responde "Sí".</small>
                          </div>
                      
                          <!-- Enfermedad No Infecciosa -->
                          <div class="form-group label-floating col-md-6">
                            <h5>¿El niño ha sufrido de alguna enfermedad no infecciosa? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="enfermedad_no_infecciosa" value="si" required> <span>Sí</span>
                              </label>
                              <label class="ml-3">
                                <input type="radio" name="enfermedad_no_infecciosa" value="no"> <span>No</span>
                              </label>
                              <input class="form-control ml-3" name="tipo_enfermedad_no_infecciosa" id="tipo_enfermedad_no_infecciosa" type="text" placeholder="Especificar enfermedad no infecciosa">
                            </div>
                            <small class="form-text text-muted">Ejemplos: alergias, epilepsia, asma. Especifique si responde "Sí".</small>
                          </div>
                      
                          <!-- Enfermedad Crónica -->
                          <div class="form-group label-floating col-md-6">
                            <h5>¿El niño padece de alguna enfermedad crónica? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="enfermedad_cronica" value="si" required> <span>Sí</span>
                              </label>
                              <label class="ml-3">
                                <input type="radio" name="enfermedad_cronica" value="no"> <span>No</span>
                              </label>
                              <input class="form-control ml-3" name="tipo_enfermedad_cronica" id="tipo_enfermedad_cronica" type="text" placeholder="Especificar enfermedad crónica">
                            </div>
                            <small class="form-text text-muted">Ejemplos: diabetes, hipertensión, enfermedades metabólicas. Especifique si responde "Sí".</small>
                          </div>
                      
                          <!-- Discapacidad -->
                          <div class="form-group label-floating col-md-6">
                            <h5>¿El niño padece de alguna discapacidad? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="discapacidad" value="si" required> <span>Sí</span>
                              </label>
                              <label class="ml-3">
                                <input type="radio" name="discapacidad" value="no"> <span>No</span>
                              </label>
                              <input class="form-control ml-3" name="tipo_discapacidad" id="tipo_discapacidad" type="text" placeholder="Especificar discapacidad">
                            </div>
                            <small class="form-text text-muted">Ejemplos: visual, auditiva, motora, intelectual. Especifique si responde "Sí".</small>
                          </div>
                      
                          <!-- Otros -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Otros <span class="text-danger">*</span></label>
                            <input class="form-control" id="otros" name="otros" type="text" required>
                            <small class="form-text text-muted">Ingrese cualquier otro antecedente médico relevante que no haya sido mencionado anteriormente.</small>
                          </div>
                      
                        </div>
                        <p class="centro-texto">
                          <button type="button" id="regresar1" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="button" id="siguiente2" class="btn btn-regresar" style="color: white;">Siguiente</button>
                        </p>
                      </section>                      

                      <section id="paso3">
                        <h3>Historia de desarrollo</h3>
                        <h4>Embarazo</h4>
                        <div class="form-row">
                          <div class="form-group label-floating col-md-6">
                            <h5>Durante el embarazo ¿la madre recibió algún tipo de medicamento? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="medicamento_embarazo" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="medicamento_embarazo" value="no">
                                <span>No</span>
                              </label>
                              <input class="form-control ml-3" id="tipo_medicamento" name="tipo_medicamento" type="text" placeholder="Especificar medicamento">
                            </div>
                            <small class="text-danger">Este campo es requerido</small>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>Durante el embarazo ¿la madre fumó? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="fumo_embarazo" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="fumo_embarazo" value="no">
                                <span>No</span>
                              </label>
                              <input class="form-control ml-3" name="cantidad" id="cantidad" type="text" placeholder="Cantidad que fumaba al día">
                            </div>
                            <small class="text-danger">Este campo es requerido</small>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>Durante el embarazo ¿la madre tomó bebidas alcohólicas? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center flex-wrap">
                              <label class="mr-2">
                                <input type="radio" name="alcohol_embarazo" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="alcohol_embarazo" value="no">
                                <span>No</span>
                              </label>
                              <input class="form-control ml-3 mt-2" style="display: none;" name="tipo_alcohol" id="tipo_alcohol" type="text" placeholder="Especificar el tipo de alcohol">
                              <input class="form-control ml-3 mt-2" style="display: none;" name="cantidad_consumia_alcohol" id="cantidad_consumia_alcohol" type="text" placeholder="Especificar cantidad consumida de alcohol">
                            </div>
                            <small class="text-danger">Este campo es requerido</small>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>Durante el embarazo ¿la madre utilizó drogas? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="droga_embarazo" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="droga_embarazo" value="no">
                                <span>No</span>
                              </label>
                              <input class="form-control ml-3" name="tipo_droga" id="tipo_droga" type="text" placeholder="Especificar la droga utilizada en el embarazo">
                            </div>
                            <small class="text-danger">Este campo es requerido</small>
                          </div>
                        </div>
                      
                        <p class="centro-texto">
                          <button type="button" id="regresar2" class="btn btn-regresar" style="color: white;"><i class="zmdi zmdi-arrow-back"></i> Regresar</button>
                          <button type="button" id="siguiente3" class="btn btn-regresar" style="color: white;">Siguiente</button>
                        </p>
                      </section>
                      
                      <section id="paso4">
                        <h3>Historia de desarrollo</h3>
                        <h4>Parto</h4>
                        <div class="form-row">
                      
                          <!-- Fórceps -->
                          <div class="form-group label-floating col-md-6">
                            <h5>¿Se realizaron fórceps durante el parto? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="forceps_parto" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="forceps_parto" value="no">
                                <span>No</span>
                              </label>
                            </div>
                            <small class="text-danger">Campo requerido</small>
                          </div>
                      
                          <!-- Cesárea -->
                          <div class="form-group label-floating col-md-6">
                            <h5>¿Se realizó cesárea? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="cesarea" value="si" required onchange="toggleInput('cesarea', 'razon_cesarea')">
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="cesarea" value="no" onchange="toggleInput('cesarea', 'razon_cesarea')">
                                <span>No</span>
                              </label>
                              <input class="form-control ml-3" name="razon_cesarea" id="razon_cesarea" type="text"
                                placeholder="Razón de la cesárea" style="display: none;">
                            </div>
                            <small class="text-danger">Campo requerido</small>
                          </div>
                      
                          <!-- Prematuro -->
                          <div class="form-group label-floating col-md-6">
                            <h5>¿El niño fue prematuro? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="niño_prematuro" value="si" required onchange="toggleInput('niño_prematuro', 'meses_prematuro')">
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="niño_prematuro" value="no" onchange="toggleInput('niño_prematuro', 'meses_prematuro')">
                                <span>No</span>
                              </label>
                              <input class="form-control ml-3" name="meses_prematuro" id="meses_prematuro" type="text"
                                placeholder="¿Cuántos meses prematuro?" style="display: none;">
                            </div>
                            <small class="text-danger">Campo requerido</small>
                          </div>
                      
                          <!-- Complicaciones -->
                          <div class="form-group label-floating col-md-6">
                            <h5>¿Hubo complicaciones en el nacimiento? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label class="mr-2">
                                <input type="radio" name="complicaciones_nacer" value="si" required onchange="toggleInput('complicaciones_nacer', 'tipo_complicacion')">
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="complicaciones_nacer" value="no" onchange="toggleInput('complicaciones_nacer', 'tipo_complicacion')">
                                <span>No</span>
                              </label>
                              <input class="form-control ml-3" name="tipo_complicacion" id="tipo_complicacion" type="text"
                                placeholder="Especificar la complicación" style="display: none;">
                            </div>
                            <small class="text-danger">Campo requerido</small>
                          </div>
                      
                          <!-- Peso -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Peso al nacer <span class="text-danger">*</span></label>
                            <input class="form-control" id="peso_nacer_niño" name="peso_nacer_niño" type="text" required>
                            <small class="text-danger">Campo requerido</small>
                          </div>
                        </div>
                      
                        <p class="centro-texto">
                          <button type="button" id="regresar3" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="button" id="siguiente4" class="btn btn-regresar" style="color: white;">Siguiente</button>
                        </p>
                      </section>
                      
                      <section id="paso5">
                        <h3>Historia de desarrollo</h3>
                        <h4>Primeros meses del niño</h4>
                        <div class="form-row">
                          <div class="form-group label-floating col-md-6">
                            <h5>¿Hubo algún tipo de problema de alimentación? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="problema_alimentacion" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="problema_alimentacion" value="no">
                                <span>No</span>
                              </label>
                              <input class="form-control mt-2" name="tipo_problema_alimenticio" id="tipo_problema_alimenticio" type="text"
                                placeholder="Especificar tipo de problema alimenticio">
                            </div>
                            <span class="invalid-feedback">Este campo es obligatorio.</span>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>¿El niño tenía problemas para dormir? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="problema_dormir" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="problema_dormir" value="no">
                                <span>No</span>
                              </label>
                              <input class="form-control mt-2" name="tipo_problema_dormir" id="tipo_problema_dormir" type="text"
                                placeholder="Especificar tipo de problema para dormir">
                            </div>
                            <span class="invalid-feedback">Este campo es obligatorio.</span>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>Cuando recién nacido, ¿el niño era tranquilo? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="tranquilo_recien_nacido" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="tranquilo_recien_nacido" value="no">
                                <span>No</span>
                              </label>
                            </div>
                            <span class="invalid-feedback">Este campo es obligatorio.</span>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>Cuando recién nacido, ¿al niño le gustaba que lo cargaran? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="gustaba_cargaran_recien_nacido" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="gustaba_cargaran_recien_nacido" value="no">
                                <span>No</span>
                              </label>
                            </div>
                            <span class="invalid-feedback">Este campo es obligatorio.</span>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>Cuando recién nacido, ¿el niño estaba alerta? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="alerta_recien_nacido" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="alerta_recien_nacido" value="no">
                                <span>No</span>
                              </label>
                            </div>
                            <span class="invalid-feedback">Este campo es obligatorio.</span>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>¿Hubo algún problema o complicación en el crecimiento y desarrollo del niño en los primeros años de vida? <span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="problemas_desarrollo_primeros_años" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="problemas_desarrollo_primeros_años" value="no">
                                <span>No</span>
                              </label>
                              <input class="form-control mt-2" name="cuales_problemas" id="cuales_problemas" type="text"
                                placeholder="Especificar tipo de problema o complicación en el desarrollo">
                            </div>
                            <span class="invalid-feedback">Este campo es obligatorio.</span>
                          </div>
                        </div>
                      
                        <p class="centro-texto">
                          <button type="button" id="regresar4" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="button" id="siguiente5" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </p>
                      </section>
                      

                      <section id="paso6">
                        <h3>Historia Escolar</h3>
                        <div class="form-row">
                          <div class="form-group label-floating col-md-6">
                            <h5>¿El niño está escolarizado?<span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="escolarizado" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="escolarizado" value="no">
                                <span>No</span>
                              </label>
                              <input class="form-control" name="tipo_educaion" id="tipo_educaion" type="text"
                                placeholder="Especificar el tipo de educación que recibe el niño">
                            </div>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>¿Recibe alguna terapia o tutoría?<span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="tutoria_terapias" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="tutoria_terapias" value="no">
                                <span>No</span>
                              </label>
                              <input class="form-control" name="tutoria_terapias_cuales" id="tutoria_terapias_cuales" type="text"
                                placeholder="Especificar las terapias o tutorías que recibe el niño">
                            </div>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>¿El niño presenta alguna dificultad para la lectura?<span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="dificultad_lectura" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="dificultad_lectura" value="no">
                                <span>No</span>
                              </label>
                            </div>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>¿El niño presenta alguna dificultad para la aritmética?<span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="dificultad_aritmetica" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="dificultad_aritmetica" value="no">
                                <span>No</span>
                              </label>
                            </div>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>¿El niño presenta alguna dificultad para la escritura?<span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="dificultad_escribir" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="dificultad_escribir" value="no">
                                <span>No</span>
                              </label>
                            </div>
                          </div>
                      
                          <div class="form-group label-floating col-md-6">
                            <h5>¿Le agrada el ambiente escolar?<span class="text-danger">*</span></h5>
                            <div class="d-flex align-items-center">
                              <label>
                                <input type="radio" name="agrada_escuela" value="si" required>
                                <span>Si</span>
                              </label>
                              <label>
                                <input type="radio" name="agrada_escuela" value="no">
                                <span>No</span>
                              </label>
                            </div>
                          </div>
                        </div>
                      
                        <p class="centro-texto">
                          <button type="button" id="regresar5" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="submit" name="registrar" class="btn btn-custom" style="color: white;">
                            <i class="zmdi zmdi-floppy"></i>Registrar
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
    </div>
  </section>
  <!-- Modal de Confirmación -->
  <section class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Confirmación</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Desea eliminar el registro seleccionado?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cancelar</button>
          <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-eliminar"
            style="color: white;">Eliminar</button>
        </div>
      </div>
    </div>
  </section>
  <section class="modal fade" id="modalVerHistoria" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Detalles de la Historia</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><strong>Código:</strong> <span id="codigoV"></span></p>
          <p><strong>Referencia:</strong> <span id="referenciaV"></span></p>
          <p><strong>Motivo:</strong> <span id="motivoV"></span></p>
          <p><strong>Paciente:</strong> <span id="pacienteV"></span></p>
          <p><strong>Fecha de Nacimiento:</strong> <span id="fechaNacimiento"></span></p>
          <p><strong>Representante:</strong> <span id="representanteV"></span></p>
          <p><strong>Dirección:</strong> <span id="direccion"></span></p>
          <p><strong>Riesgo Social:</strong> <span id="riesgoSocial"></span>Pts.</p>
          <p><strong>Riesgo Biológico:</strong> <span id="riesgoBiologico"></span>Pts.</p>
          <p><strong>Riesgo Global:</strong> <span id="riesgoGlobal"></span></p>
          <p><strong>Peso al Nacer:</strong> <span id="peso"></span>.Kg</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cerrar</button>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('js')
  <script>
    $(document).ready(function() {
      const pacientes = @json($pacientes);
      console.log(pacientes);
      $('#paciente_id').select2({
        placeholder: "Seleccione el paciente",
        allowClear: true,
        minimumInputLength: 1,
        ajax: {
          transport: function(params, success, failure) {
            const searchTerm = params.data.term.toLowerCase().trim();
            const filteredPacientes = pacientes.filter(paciente =>
              paciente.nombre.toLowerCase().includes(searchTerm) ||
              paciente.apellido.toLowerCase().includes(searchTerm)
            );

            console.log(filteredPacientes);

            const results = filteredPacientes.map(paciente => ({
              id: paciente.id,
              text: `${paciente.nombre} ${paciente.apellido}`
            }));

            success({
              results: results
            });
          }
        }
      });
    });
  </script>
  <script>
    $(document).ready(function () {
  // Mostrar solo el primer paso al inicio
  $("#paso1").show();
  $("#paso2, #paso3, #paso4, #paso5, #paso6").hide();

  function validarPaso(pasoId) {
    let valid = true;
    $(`${pasoId} :input[required]`).each(function () {
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
    return valid;
  }

  $("#siguiente1").click(function () {
    if (validarPaso("#paso1")) {
      $("#paso1").hide();
      $("#paso2").show();
    } else {
      toastr.error("Debe completar todos los campos requeridos del paso 1.");
    }
  });

  $("#siguiente2").click(function () {
    if (validarPaso("#paso2")) {
      $("#paso2").hide();
      $("#paso3").show();
    } else {
      toastr.error("Debe completar todos los campos requeridos del paso 2.");
    }
  });

  $("#siguiente3").click(function () {
    if (validarPaso("#paso3")) {
      $("#paso3").hide();
      $("#paso4").show();
    } else {
      toastr.error("Debe completar todos los campos requeridos del paso 3.");
    }
  });

  $("#siguiente4").click(function () {
    if (validarPaso("#paso4")) {
      $("#paso4").hide();
      $("#paso5").show();
    } else {
      toastr.error("Debe completar todos los campos requeridos del paso 4.");
    }
  });

  $("#siguiente5").click(function () {
    if (validarPaso("#paso5")) {
      $("#paso5").hide();
      $("#paso6").show();
    } else {
      toastr.error("Debe completar todos los campos requeridos del paso 5.");
    }
  });

  // Botones de regresar
  $("#regresar1").click(function () {
    $("#paso2").hide();
    $("#paso1").show();
  });

  $("#regresar2").click(function () {
    $("#paso3").hide();
    $("#paso2").show();
  });

  $("#regresar3").click(function () {
    $("#paso4").hide();
    $("#paso3").show();
  });

  $("#regresar4").click(function () {
    $("#paso5").hide();
    $("#paso4").show();
  });

  $("#regresar5").click(function () {
    $("#paso6").hide();
    $("#paso5").show();
  });
});

  </script>
  <script>
    $(document).ready(function() {

      // Función para manejar todos los toggles
      function toggleInput(radioName, inputId, defaultValue = '') {
        const show = document.querySelector(`input[name="${radioName}"][value="si"]`).checked;
        const input = document.getElementById(inputId);

        input.style.display = show ? 'block' : 'none';
        input.required = show;

        if (!show) {
          input.value = defaultValue;
        }
      }

      // Configuración de todos los toggles
      const toggleConfig = [{
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
          id: 'tipo_problema_alimenticio',
          defaultValue: 'no'
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
          name: 'escolarizado',
          id: 'tipo_educaion'
        },
        {
          name: 'tutoria_terapias',
          id: 'tutoria_terapias_cuales'
        }
      ];

      // Configurar eventos para cada toggle
      toggleConfig.forEach(config => {
        const radios = document.querySelectorAll(`input[name="${config.name}"]`);
        radios.forEach(radio => {
          radio.addEventListener('click', () => {
            toggleInput(config.name, config.id, config.defaultValue);
          });
        });

        // Inicializar estado
        toggleInput(config.name, config.id, config.defaultValue);
      });

      // Configuración especial para el alcohol (que tiene dos campos)
      const alcoholRadios = document.querySelectorAll('input[name="alcohol_embarazo"]');
      alcoholRadios.forEach(radio => {
        radio.addEventListener('click', () => {
          const show = document.querySelector('input[name="alcohol_embarazo"][value="si"]').checked;
          document.getElementById('tipo_alcohol').style.display = show ? 'block' : 'none';
          document.getElementById('cantidad_consumia_alcohol').style.display = show ? 'block' : 'none';
          document.getElementById('tipo_alcohol').required = show;
          document.getElementById('cantidad_consumia_alcohol').required = show;

          if (!show) {
            document.getElementById('tipo_alcohol').value = '';
            document.getElementById('cantidad_consumia_alcohol').value = '';
          }
        });
      });
    });
  </script>
  <script>
    $('#registro-hitoria').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        url: "{{ route('historias.store') }}",
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          toastr.success(response.message);
          $('#registro-hitoria')[0].reset();
          setTimeout(function() {
            location.reload();
          }, 2000);
        },
        error: function(xhr) {
          toastr.error(xhr.responseJSON.error || 'Ocurrió un error inesperado.');
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      var tablaSecretaria = $('#tab-historias').DataTable({
        language: {
          url: './js/datatables/es-ES.json',
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
    });
  </script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var id;
    $(document).on('click', '.delete', function() {
      id = $(this).attr('id');
      $('#confirModal').modal('show');
    });

    $('#btnEliminar').click(function() {
      $.ajax({
        url: "/historias/" + id,
        type: 'DELETE',
        beforeSend: function() {
          $('#btnEliminar').text('Eliminando...');
        },
        success: function(data) {
          $('#confirModal').modal('hide');
          toastr.warning('El registro se eliminó correctamente', 'Eliminar Registro', {
            timeOut: 5000
          });
          $('#tab-historias').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
          console.error('Error al eliminar el registro:', error);
          toastr.error('No se pudo eliminar el registro', 'Error', {
            timeOut: 5000
          });
        }
      });
    });
  </script>
  <script>
    $(document).on('click', '.verHistoria', function() {
      const id = $(this).data('id');
      if (!id) {
        alert('No se encontró el ID de la historia.');
        return;
      }

      $('#modalVerHistoria').modal('show');

      $.ajax({
        url: `/api/historia/${id}`,
        type: 'GET',
        success: function(data) {
          console.log(data);

          if (!data.historia) {
            $('#modalVerHistoria .modal-body').html('<p>No se encontraron datos para esta historia.</p>');
            return;
          }

          const historia = data.historia;
          const paciente = historia.paciente || {};
          const representante = paciente.representante || {};
          const direccion = representante.direccion || {};
          const historiaDesarrollo = historia.historia_desarrollo || {};

          $('#codigoV').text(historia.codigo || 'N/A');
          $('#referenciaV').text(historia.referencia || 'N/A');
          $('#motivoV').text(historia.motivo || 'N/A');
          $('#pacienteV').text(`${paciente.nombre || 'N/A'} ${paciente.apellido || 'N/A'}`);
          $('#fechaNacimiento').text(paciente.fecha_nac || 'N/A');
          $('#representanteV').text(`${representante.nombre || 'N/A'} ${representante.apellido || 'N/A'}`);
          $('#direccion').text(
            `${direccion.estado?.estado || 'N/A'}, ${direccion.municipio?.municipio || 'N/A'}, ${direccion.parroquia?.parroquia || 'N/A'}, ${direccion.sector || 'N/A'}`
          );
          $('#riesgoSocial').text(data.riesgoSocial ?? 'N/A');
          $('#riesgoBiologico').text(data.riesgoBiologico ?? 'N/A');
          $('#riesgoGlobal').text(data.riesgoGlobal ?? 'N/A');
          $('#peso').text(historiaDesarrollo.peso_nacer_niño ?? 'N/A');
        },
        error: function(xhr) {
          const errorMessage = xhr.status === 404 ? 'Historia no encontrada.' : 'Error al cargar los datos.';
          $('#modalVerHistoria .modal-body').html(`<p>${errorMessage}</p>`);
          console.error('Error en la solicitud:', xhr);
        }
      });
    });
  </script>

@endsection
