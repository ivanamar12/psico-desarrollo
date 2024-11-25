@extends('layouts.app')

@section('title', 'Historias')

@section('content')
<section class="full-box dashboard-contentPage">
    <nav class="full-box dashboard-Navbar">
		<ul class="full-box list-unstyled text-right">
			<li class="pull-left">
				<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
			</li>
			<li>
				<a href="#!" class="btn-Notifications-area">
					<i class="zmdi zmdi-notifications-none"></i>
					<span class="badge">7</span>
				</a>
			</li>
			<li>
				<a href="#!" class="btn-search">
					<i class="zmdi zmdi-search"></i>
				</a>
			</li>
			<li>
				<a href="#!" class="btn-modal-help">
					<i class="zmdi zmdi-help-outline"></i>
				</a>
			</li>
		</ul>
	</nav>
	<div class="container-fluid">
		<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-file zmdi-hc-fw"></i>Historias</h1>
		</div>
		<p class="lead">
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					<li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
					<li><a href="#new" data-toggle="tab">Nuevo</a></li>
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
                    <div class="tab-pane fade in" id="new">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-md-10 col-md-offset-1">
                                    <form id="registro-hitoria">@csrf
                                        <div id= "paso1">
                                            <h3>Datos del paciente</h3>
                                            <div class="form-row">
                                                <div class="form-group label-floating col-md-6">
                                                    <select class="form-control form-control-solid select2" required style="width: 100%;" id="paciente_id" name="paciente_id" require>
                                                        <option selected disabled>Seleccione el paciente</option>
                                                    </select>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <label class="control-label">Código de Historia</label>
                                                    <input type="text" class="form-control" readonly="readonly" id="codigo" name="codigo" title="Código de la historia" placeholder="codigo" required value="{{ 'HIS' . substr(str_shuffle('0123456789'), 0, 5) }}">
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <label class="control-label">Referencia</label>
                                                    <input class="form-control" id="referencia" name="referencia" type="text" required>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <label class="control-label">Especialidad que Refirió</label>
                                                    <input class="form-control" id="especialista_refirio" name="especialista_refirio" type="text" required>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <label class="control-label">Motivo</label>
                                                    <input class="form-control" id="motivo" name="motivo" type="text" required>
                                                </div>
                                            </div>
                                            <p class="centro-texto"><button type="button" id="siguiente1" class="btn btn-primary">Siguiente</button></p>
                                        </div>
                                        <div id="paso2">
                                            <h3>Antecedentes Médicos</h3>
                                            <div class="form-row">
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿El niño ha sufrido de alguna enfermedad infecciosa?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-2"><input type="radio" name="enfermedad_infecciosa" value="si" required onclick="toggleEnfermedadInput()"> Sí</label>
                                                        <label><input type="radio" name="enfermedad_infecciosa" value="no" onclick="toggleEnfermedadInput()"> No</label>
                                                        <input class="form-control ml-3" id="tipo_enfermedad_infecciosa" name="tipo_enfermedad_infecciosa" type="text" placeholder="Especificar enfermedad infecciosa">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿El niño ha sufrido de alguna enfermedad no infecciosa?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-2"><input type="radio" name="enfermedad_no_infecciosa" value="si" required onclick="toggleEnefermedadNoInput()"> Sí</label>
                                                        <label><input type="radio" name="enfermedad_no_infecciosa" value="no" onclick="toggleEnefermedadNoInput()"> No</label>
                                                        <input class="form-control ml-3" name="tipo_enfermedad_no_infecciosa" id="tipo_enfermedad_no_infecciosa" type="text" placeholder="Especificar enfermedad no infecciosa">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿El niño padece de alguna enfermedad crónica?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-2"><input type="radio" name="enfermedad_cronica" value="si" required onclick="toggleCronicaInput()"> Sí</label>
                                                        <label><input type="radio" name="enfermedad_cronica" value="no" onclick="toggleCronicaInput()"> No</label>
                                                        <input class="form-control ml-3" name="tipo_enfermedad_cronica" id="tipo_enfermedad_cronica" type="text" placeholder="Especificar enfermedad crónica">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿El niño padece de alguna discapacidad?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-2"><input type="radio" name="discapacidad" value="si" required onclick="toggleDiscapacidadInput()"> Sí</label>
                                                        <label><input type="radio" name="discapacidad" value="no" onclick="toggleDiscapacidadInput()"> No</label>
                                                        <input class="form-control ml-3" name="tipo_discapacidad" id="tipo_discapacidad" type="text" placeholder="Especificar discapacidad">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <label class="control-label">Otros</label>
                                                    <input class="form-control" id="otros" name="otros" type="text" required>
                                                </div> 
                                            </div>
                                            <p class="centro-texto">
                                                <button type="button" id="regresar1" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> Regresar</button>
                                                <button type="button" id="siguiente2" class="btn btn-primary">Siguiente</button>
                                            </p>
                                        </div>
                                        <div id="paso3">
                                            <h3>Historia de desarrollo</h3>
                                            <h4>Embarazo</h4>
                                            <div class="form-row">
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>Durante el embarazo ¿la madre recibió algún tipo de medicamento?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-2"><input type="radio" name="medicamento_embarazo" value="si" required onclick="toggleMedicamentoInput()"> Sí</label>
                                                        <label><input type="radio" name="medicamento_embarazo" value="no" onclick="toggleMedicamentoInput()"> No</label>
                                                        <input class="form-control ml-3" id="tipo_medicamento" name="tipo_medicamento" type="text" placeholder="Especificar medicamento">
                                                    </div>
                                                </div>         
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>Durante el embarazo ¿la madre fumó?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-2"><input type="radio" name="fumo_embarazo" value="si" required onclick="toggleFumoInput()"> Sí</label>
                                                        <label><input type="radio" name="fumo_embarazo" value="no" onclick="toggleFumoInput()"> No</label>
                                                        <input class="form-control ml-3" name="cantidad" id="cantidad" type="text" placeholder="Cantidad que fumaba al día">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>Durante el embarazo ¿la madre tomó bebidas alcohólicas?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-2"><input type="radio" name="alcohol_embarazo" value="si" required onclick="toggleAlcoholInput()"> Sí</label>
                                                        <label><input type="radio" name="alcohol_embarazo" value="no" onclick="toggleAlcoholInput()"> No</label>
                                                        <input class="form-control ml-3" name="tipo_alcohol" id="tipo_alcohol" type="text" placeholder="Especificar el tipo de alcohol">
                                                        <input class="form-control ml-3" name="cantidad_consumia_alcohol" id="cantidad_consumia_alcohol" type="text" placeholder="Especificar cantidad consumida de alcohol">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>Durante el embarazo ¿la madre utilizó drogas?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-2"><input type="radio" name="droga_embarazo" value="si" required onclick="toggleDrogaInput()"> Sí</label>
                                                        <label><input type="radio" name="droga_embarazo" value="no" onclick="toggleDrogaInput()"> No</label>
                                                        <input class="form-control ml-3" name="tipo_droga" id="tipo_droga" type="text" placeholder="Especificar la droga utilizada en el embarazo">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="centro-texto">
                                                <button type="button" id="regresar2" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> Regresar</button>
                                                <button type="button" id="siguiente3" class="btn btn-primary">Siguiente</button>
                                            </p>
                                        </div>
                                        <div id ="paso4">
                                            <h3>Historia de desarrollo</h3>
                                            <h4>Parto</h4>
                                            <div class="form-row">
                                                <div class="form-group label-floating col-md-6">
                                                    <h5> ¿Se realizaron fórceps durante el parto?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="forceps_parto" value="si" required onclick="toggleForcepsInput()"> Sí</label>
														<label><input type="radio" name="forceps_parto" value="no" onclick="toggleForcepsInput()"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5> ¿Se realizo cesárea?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="cesarea" value="si" required onclick="toggleCesareaInput()"> Sí</label>
														<label><input type="radio" name="cesarea" value="no" onclick="toggleCesareaInput()"> No</label>
                                                        <input class="form-control" name="razon_cesarea" id="razon_cesarea" type="text" placeholder="Razón de la cesárea">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿El niño fue prematuro?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="niño_prematuro" value="si" required onclick="togglePrematuroInput()"> Sí</label>
														<label><input type="radio" name="niño_prematuro" value="no" onclick="togglePrematuroInput()"> No</label>
                                                        <input class="form-control" name="meses_prematuro" id="meses_prematuro" type="text" placeholder="Especificar por cuantos meses">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿Hubo complicaciones en el nacimiento?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="complicaciones_nacer" value="si" required onclick="toggleComplicacionesInput()"> Sí</label>
														<label><input type="radio" name="complicaciones_nacer" value="no" onclick="toggleComplicacionesInput()"> No</label>
                                                        <input class="form-control" name="tipo_complicacion" id="tipo_complicacion" type="text" placeholder="Especificar el tipo de complicación">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <label class="control-label">Peso al nacer</label>
                                                    <input class="form-control" id="peso_nacer_niño" name="peso_nacer_niño" type="text" required>
                                                </div>  
                                            </div>
                                            <p class="centro-texto">
                                                <button type="button" id="regresar3" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> Regresar</button>
                                                <button type="button" id="siguiente4" class="btn btn-primary">Siguiente</button>
                                            </p>
                                        </div>
                                        <div id="paso5">
                                            <h3>Historia de desarrollo</h3>
                                            <h4>Primeros meses del niño</h4>
                                            <div class="form-row">
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿Hubo algun tipo de problema de alimentación?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="problema_alimentacion" value="si" required onclick="toggleAlimentacionInput()"> Sí</label>
														<label><input type="radio" name="problema_alimentacion" value="no" onclick="toggleAlimentacionInput()"> No</label>
                                                        <input class="form-control" name="tipo_problema_alimenticio" id="tipo_problema_alimenticio" type="text" placeholder="Especificar tipo de problema alimenticio">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿El niño tenia problemas para dormir?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="problema_dormir" value="si" required onclick="toggleDormirInput()"> Sí</label>
														<label><input type="radio" name="problema_dormir" value="no" onclick="toggleDormirInput()"> No</label>
                                                        <input class="form-control" name="tipo_problema_dormir" id="tipo_problema_dormir" type="text" placeholder="Especificar tipo de problema para dormir">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>Cuando recien nacido ¿el niño era tranquilo?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="tranquilo_recien_nacido" value="si" required onclick="toggleTranquiloInput()"> Sí</label>
														<label><input type="radio" name="tranquilo_recien_nacido" value="no" onclick="toggleTranquiloInput()"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>Cuando recien nacido ¿el niño le gustaba que lo cargaran?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="gustaba_cargaran_recien_nacido" value="si" required onclick="toggleCargarInput()"> Sí</label>
														<label><input type="radio" name="gustaba_cargaran_recien_nacido" value="no" onclick="toggleCargarInput()"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>Cuando recien nacido ¿el niño estaba alerta?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="alerta_recien_nacido" value="si" required onclick="toggleAlertaInput()"> Sí</label>
														<label><input type="radio" name="alerta_recien_nacido" value="no" onclick="toggleAlertaInput()"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                <h5>¿Hubo algun problema o complicacion en el crecimiento y desarrollo del niño en los primeros años de vida?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="problemas_desarrollo_primeros_años" value="si" required onclick="togglePrimerosInput()"> Sí</label>
														<label><input type="radio" name="problemas_desarrollo_primeros_años" value="no" onclick="togglePrimerosInput()"> No</label>
                                                        <input class="form-control" name="cuales_problemas" id="cuales_problemas" type="text" placeholder="Especificar tipo de problema o complicacion en el desarrollo">
                                                    </div>
                                                </div>   
                                            </div>
                                            <p class="centro-texto">
                                                <button type="button" id="regresar4" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> Regresar</button>
                                                <button type="button" id="siguiente5" class="btn btn-primary">Siguiente</button>
                                            </p>
                                        </div>
                                        <div id="paso6">
                                            <h3>Historia Escolar</h3>
                                            <div class="form-row">
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿El niño esta escolarizado?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="escolarizado" value="si" required onclick="toggleEscolarizadoInput()"> Sí</label>
														<label><input type="radio" name="escolarizado" value="no" onclick="toggleEscolarizadoInput()"> No</label>
                                                        <input class="form-control" name="tipo_educaion" id="tipo_educaion" type="text" placeholder="Especificar el tipo de educacion que recibe el niño">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿Recibe alguna terapia o tutoria?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="tutoria_terapias" value="si" required onclick="toggleTerapiaTutoriaInput()"> Sí</label>
														<label><input type="radio" name="tutoria_terapias" value="no" onclick="toggleTerapiaTutoriaInput()"> No</label>
                                                        <input class="form-control" name="tutoria_terapias_cuales" id="tutoria_terapias_cuales" type="text" placeholder="Especificar las terapias o tutorias que recibe el niño">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿El niño presenta alguna dificultad para la lectura?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="dificultad_lectura" value="si" required onclick="toggleLecturaInput()"> Sí</label>
														<label><input type="radio" name="dificultad_lectura" value="no" onclick="toggleLecturaInput()"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿El niño presenta alguna dificultad para la aritmetica?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="dificultad_aritmetica" value="si" required onclick="toggleAritmeticaInput()"> Sí</label>
														<label><input type="radio" name="dificultad_aritmetica" value="no" onclick="toggleAritmeticaInput()"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿El niño presenta alguna dificultad para la escritura?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="dificultad_escribir" value="si" required onclick="toggleEscrituraInput()"> Sí</label>
														<label><input type="radio" name="dificultad_escribir" value="no" onclick="toggleEscrituraInput()"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿le agrada el ambiente escolar?</h5>
                                                    <div class="d-flex align-items-center">
                                                        <label><input type="radio" name="agrada_escuela" value="si" required onclick="toggleEscolarInput()"> Sí</label>
														<label><input type="radio" name="agrada_escuela" value="no" onclick="toggleEscolarInput()"> No</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="centro-texto">
                                                <button type="button" id="regresar5" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> Regresar</button>
                                                <button type="submit" name="registrar" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i>Registrar</button>
                                            </p>
                                        </div>  
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal de Confirmación -->
<div class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro seleccionado?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>  
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

                success({ results: results });
            }
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $("#paso1").show();
    $("#paso2").hide();
    $("#paso3").hide();
    $("#paso4").hide();
    $("#paso5").hide();
    $("#paso6").hide();

    $("#siguiente1").click(function() {
        if ($("#paciente_id").val()) {
            $("#paso1").hide();
            $("#paso2").show();
        } else {
            toastr.error("Por favor, complete todos los campos requeridos en este paso.");
        }
    });

    $("#siguiente2").click(function() {
        $("#paso2").hide();
        $("#paso3").show();
    });

    $("#siguiente3").click(function() {
        $("#paso3").hide();
        $("#paso4").show();
    });

    $("#siguiente4").click(function() {
        $("#paso4").hide();
        $("#paso5").show();
    });

    $("#siguiente5").click(function() {
        $("#paso5").hide();
        $("#paso6").show();
    });

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

})

function toggleEnfermedadInput() {
    const enfermedad_infecciosaYes = document.querySelector(`input[name="enfermedad_infecciosa"][value="si"]`);
    const tipo_enfermedadinfecciosaInput = document.getElementById('tipo_enfermedad_infecciosa'); 
    if (enfermedad_infecciosaYes.checked) {
        tipo_enfermedadinfecciosaInput.style.display = 'block'; 
    } else {
        tipo_enfermedadinfecciosaInput.style.display = 'none'; 
        tipo_enfermedadinfecciosaInput.value = 'no aplica'; 
    }
}

function toggleEnefermedadNoInput(){
	const enfermedad_no_infecciosaYes = document.querySelector(`input[name="enfermedad_no_infecciosa"][value="si"]`);
    const tipo_enfermedad_noinfecciosaInput = document.getElementById('tipo_enfermedad_no_infecciosa'); 
    if (enfermedad_no_infecciosaYes.checked) {
        tipo_enfermedad_noinfecciosaInput.style.display = 'block'; 
    } else {
        tipo_enfermedad_noinfecciosaInput.style.display = 'none'; 
        tipo_enfermedad_noinfecciosaInput.value = 'no aplica'; 
    }
}

function toggleCronicaInput(){
	const enfermedad_cronicaYes = document.querySelector(`input[name="enfermedad_cronica"][value="si"]`);
    const tipo_enfermedad_cronicaInput = document.getElementById('tipo_enfermedad_cronica'); 
    if (enfermedad_cronicaYes.checked) {
        tipo_enfermedad_cronicaInput.style.display = 'block'; 
    } else {
        tipo_enfermedad_cronicaInput.style.display = 'none'; 
        tipo_enfermedad_cronicaInput.value = 'no aplica'; 
    }
}

function toggleDiscapacidadInput(){
	const discapacidadYes = document.querySelector(`input[name="discapacidad"][value="si"]`);
    const tipo_discapacidadInput = document.getElementById('tipo_discapacidad'); 
    if (discapacidadYes.checked) {
        tipo_discapacidadInput.style.display = 'block'; 
    } else {
        tipo_discapacidadInput.style.display = 'none'; 
        tipo_discapacidadInput.value = 'no aplica'; 
    }
}

function toggleMedicamentoInput(){
	const medicamento_embarazoYes = document.querySelector(`input[name="medicamento_embarazo"][value="si"]`);
    const tipo_medicamentoInput = document.getElementById('tipo_medicamento'); 

    if (medicamento_embarazoYes.checked) {
        tipo_medicamentoInput.style.display = 'block'; 
    } else {
        tipo_medicamentoInput.style.display = 'none'; 
        tipo_medicamentoInput.value = 'no aplica'; 
    }
}

function toggleFumoInput(){
	const fumo_embarazoYes = document.querySelector(`input[name="fumo_embarazo"][value="si"]`);
    const cantidadInput = document.getElementById('cantidad'); 
    if (fumo_embarazoYes.checked) {
        cantidadInput.style.display = 'block'; 
    } else {
        cantidadInput.style.display = 'none'; 
        cantidadInput.value = 'no aplica'; 
    }
}

function toggleAlcoholInput(){
	const alcohol_embarazoYes = document.querySelector(`input[name="alcohol_embarazo"][value="si"]`);
    const tipo_alcoholInput = document.getElementById('tipo_alcohol');
	const cantidad_consumia_alcoholInput = document.getElementById('cantidad_consumia_alcohol'); 

    if (alcohol_embarazoYes.checked) {
        tipo_alcoholInput.style.display = 'block'; 
		cantidad_consumia_alcoholInput.style.display = 'block'; 
    } else {
        tipo_alcoholInput.style.display = 'none'; 
        tipo_alcoholInput.value = 'no aplica'; 
		cantidad_consumia_alcoholInput.style.display = 'none'; 
        cantidad_consumia_alcoholInput.value = 'no aplica'; 
    }
}
function toggleDrogaInput(){
	const droga_embarazoYes = document.querySelector(`input[name="droga_embarazo"][value="si"]`);
    const tipo_drogaInput = document.getElementById('tipo_droga'); 
    if (droga_embarazoYes.checked) {
        tipo_drogaInput.style.display = 'block'; 
    } else {
        tipo_drogaInput.style.display = 'none'; 
        tipo_drogaInput.value = 'no aplica'; 
    }
}
function toggleCesareaInput(){
	const cesareaYes = document.querySelector(`input[name="cesarea"][value="si"]`);
    const razon_cesareaInput = document.getElementById('razon_cesarea'); 
    if (cesareaYes.checked) {
        razon_cesareaInput.style.display = 'block'; 
    } else {
        razon_cesareaInput.style.display = 'none'; 
        razon_cesareaInput.value = 'no aplica'; 
    }
}
function togglePrematuroInput(){
	const niño_prematuroYes = document.querySelector(`input[name="niño_prematuro"][value="si"]`);
    const meses_prematuroInput = document.getElementById('meses_prematuro'); 
    if (niño_prematuroYes.checked) {
        meses_prematuroInput.style.display = 'block'; 
    } else {
        meses_prematuroInput.style.display = 'none'; 
        meses_prematuroInput.value = 'no aplica'; 
    }
}
function toggleComplicacionesInput(){
	const complicaciones_nacerYes = document.querySelector(`input[name="complicaciones_nacer"][value="si"]`);
    const tipo_complicacionInput = document.getElementById('tipo_complicacion'); 
    if (complicaciones_nacerYes.checked) {
        tipo_complicacionInput.style.display = 'block'; 
    } else {
        tipo_complicacionInput.style.display = 'none'; 
        tipo_complicacionInput.value = 'no aplica'; 
    }
}
function toggleAlimentacionInput(){
	const problema_alimentacionYes = document.querySelector(`input[name="problema_alimentacion"][value="si"]`);
    const tipo_problema_alimenticioInput = document.getElementById('tipo_problema_alimenticio'); 
    if (problema_alimentacionYes.checked) {
        tipo_problema_alimenticioInput.style.display = 'block'; 
    } else {
        tipo_problema_alimenticioInput.style.display = 'none'; 
        tipo_problema_alimenticioInput.value = 'no'; 
    }
}
function toggleDormirInput(){
	const problema_dormirYes = document.querySelector(`input[name="problema_dormir"][value="si"]`);
    const tipo_problema_dormirInput = document.getElementById('tipo_problema_dormir'); 
    if (problema_dormirYes.checked) {
        tipo_problema_dormirInput.style.display = 'block'; 
    } else {
        tipo_problema_dormirInput.style.display = 'none'; 
        tipo_problema_dormirInput.value = 'no aplica'; 
    }
}
function togglePrimerosInput(){
	const problemas_desarrollo_primeros_añosYes = document.querySelector(`input[name="problemas_desarrollo_primeros_años"][value="si"]`);
    const cuales_problemasInput = document.getElementById('cuales_problemas'); 
    if (problemas_desarrollo_primeros_añosYes.checked) {
        cuales_problemasInput.style.display = 'block'; 
    } else {
        cuales_problemasInput.style.display = 'none'; 
        cuales_problemasInput.value = 'no aplica'; 
    }
}
function toggleEscolarizadoInput(){
	const escolarizadoYes = document.querySelector(`input[name="escolarizado"][value="si"]`);
    const tipo_educaionInput = document.getElementById('tipo_educaion'); 

    if (escolarizadoYes.checked) {
        tipo_educaionInput.style.display = 'block'; 
    } else {
        tipo_educaionInput.style.display = 'none'; 
        tipo_educaionInput.value = 'no aplica'; 
    }
}
function toggleTerapiaTutoriaInput(){
	const tutoria_terapiasYes = document.querySelector(`input[name="tutoria_terapias"][value="si"]`);
    const tutoria_terapias_cualesInput = document.getElementById('tutoria_terapias_cuales'); 
    if (tutoria_terapiasYes.checked) {
        tutoria_terapias_cualesInput.style.display = 'block'; 
    } else {
        tutoria_terapias_cualesInput.style.display = 'none'; 
        tutoria_terapias_cualesInput.value = 'no aplica'; 
    }
}
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
$(document).ready(function(){
    var tablaSecretaria = $('#tab-historias').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('historias.index') }}",
            type: 'GET', 
        },
        columns: [
            { data: 'codigo' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'action', orderable: false, searchable: false } // Desactivar orden y búsqueda en la columna de acciones
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
$(document).on('click', '.delete', function(){
    id = $(this).attr('id');
    $('#confirModal').modal('show');
});

$('#btnEliminar').click(function(){
    $.ajax({
        url: "/historias/" + id, 
        type: 'DELETE',
        beforeSend: function(){
            $('#btnEliminar').text('Eliminando...');
        },
        success: function(data){
            $('#confirModal').modal('hide');
            toastr.warning('El registro se eliminó correctamente', 'Eliminar Registro', { timeOut: 5000 });
            $('#tab-historias').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error al eliminar el registro:', error);
            toastr.error('No se pudo eliminar el registro', 'Error', { timeOut: 5000 });
        }
    });
});
</script>
@endsection