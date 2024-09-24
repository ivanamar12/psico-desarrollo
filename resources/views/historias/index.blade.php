@extends('layouts.app')
@section('title', 'Historias')
@section('content')
<section class="full-box dashboard-contentPage">
<!-- NavBar -->
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
		
		<!-- Content page -->
    <div class="container-fluid">
        <div class="page-header">
            <h1 class="text-titles"><i class="zmdi zmdi-file zmdi-hc-fw"></i>Historias</h1>
        </div>
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
									<table class="table table-hover text-center" id="tab-repre">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Paciente</th>
												<th class="text-center">Código</th>
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
										<form id="miFormulario" method="POST" action="/ruta-de-registro">@csrf
											<h5><b>Información del Paciente</b></h5>
											<div class="form-row">
												<div class="form-group">
													<label class="control-label">Paciente</label>
													<select class="form-control form-control-solid select2" required style="width: 100%;" id="paciente_id" name="paciente_id">
														<option selected>Seleccione un paciente</option>
														@foreach ($pacientes as $paciente)
															<option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group label-floating col-md-6">
														<label class="control-label">Código</label>
														<input type="text" class="form-control" readonly="readonly" id="codigo" name="codigo" title="Código de la historia" placeholder="codigo" required value="{{ 'HIS' . substr(str_shuffle('0123456789'), 0, 5) }}">
													</div>
												<div class="form-group label-floating col-md-6">
													<label class="control -label">Referencia</label>
													<input class="form-control" id="referencia" name="referencia" type="text" required>
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Especialista que Refirió</label>
													<input class="form-control" id="especialista_refirio" name="especialista_refirio" type="text" required>
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Motivo</label>
													<input class="form-control" id="motivo" name="motivo" type="text" required>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Tipo de vivienda</label>
													<select name="tipo_vivienda" class="form-control">
														<option value="" disabled selected>Tipo de Vivienda</option>
														<option value="casa_unifamiliar" title="Vivienda independiente para una sola familia.">Casa Unifamiliar</option>
														<option value="apartamento" title="Unidad de vivienda en un edificio, puede variar en tamaño.">Apartamento</option>
														<option value="vivienda_social" title="Proyectos habitacionales para familias de bajos recursos.">Vivienda Social</option>
														<option value="vivienda_precaria" title="Construcciones informales, a menudo sin servicios básicos.">Vivienda Precaria</option>
													</select>
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Cantidad de Habitaciones</label>
													<input class="form-control" type="number" id="cantidad_habitaciones" name="cantidad_habitaciones" required min="0" oninput="validarNumero(this)">
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Cantidad de Personas</label>
													<input class="form-control" type="number" id="cantidad_personas" name="cantidad_personas" required min="0" oninput="actualizarMiembros()">
												</div>
												
												<div id="miembros-container" class="col-md-6">
													<h5>Personas que viven en la vivienda</h5>
												</div>
												<button type="button" class="btn btn-primary" id="agregar-miembro" onclick="agregarMiembro()">Agregar Miembro</button>
												<!-- Nuevas secciones para servicios -->
												<div class="form-group label-floating col-md-6">
													<h5>¿Servicio de Agua Potable?</h5>
													<div>
														<label><input type="radio" name="servecio_agua_potable" value="si" required> Sí</label>
														<label><input type="radio" name="servecio_agua_potable" value="no"> No</label>
													</div>
												</div>
												<div class="form-group col-md-6">
													<h5>¿Servicio de Gas?</h5>
													<div>
														<label><input type="radio" name="servecio_gas" value="si" required> Sí</label>
														<label><input type="radio" name="servecio_gas" value="no"> No</label>
													</div>
												</div>
												<div class="form-group col-md-6">
													<h5>¿Servicio de Electricidad?</h5>
													<div>
														<label><input type="radio" name="servecio_electricidad" value="si" required> Sí</label>
														<label><input type="radio" name="servecio_electricidad" value="no"> No</label>
													</div>
												</div>
												<div class="form-group col-md-6">
													<h5>¿Servicio de Drenaje?</h5>
													<div>
														<label><input type="radio" name="servecio_drenaje" value="si" required> Sí</label>
														<label><input type="radio" name="servecio_drenaje" value="no"> No</label>
													</div>
												</div>
												<div class="form-group col-md-6">
													<h5>¿Acceso a Servicios Públicos?</h5>
													<div>
														<label><input type="radio" name="acceso_servcios_publicos" value="si" required> Sí</label>
														<label><input type="radio" name="acceso_servcios_publicos" value="no"> No</label>
													</div>
												</div>
												<div class="form-group col-md-6">
													<h5>¿Servicio de Internet?</h5>
													<div>
														<label><input type="radio" name="disponibilidad_internet" value="si" required onclick="toggleInterInput()"> Sí</label>
														<label><input type="radio" name="disponibilidad_internet" value="no" onclick="toggleInterInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" id="tipo_conexion_internet" name="tipo_conexion_internet"  type="text" placeholder="Especificar el tipo de conexion de internet">
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Fuente de Ingreso Familiar</label>
													<input class="form-control" id="fuente_ingreso_familiar" name="fuente_ingreso_familiar" type="text" required>
												</div>
											</div>
											<h5><b>Antecedentes Médicos</b></h5>
											<div class="form-row">
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño ha sufrido de alguna enfermedad infecciosa?</h5>
													<div>
														<label><input type="radio" name="enfermedad_infecciosa" value="si" required onclick="toggleEnfermedadInput()"> Sí</label>
														<label><input type="radio" name="enfermedad_infecciosa" value="no" onclick="toggleEnfermedadInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" id="tipo_enfermedad_infecciosa" name="tipo_enfermedad_infecciosa"  type="text" placeholder="Especificar enfermedad infecciosa">
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño ha sufrido de alguna enfermedad no infecciosa?</h5>
													<div>
														<label><input type="radio" name="enfermedad_no_infecciosa" value="si" required onclick="toggleEnefermedadNoInput()"> Sí</label>
														<label><input type="radio" name="enfermedad_no_infecciosa" value="no" onclick="toggleEnefermedadNoInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
														<input class="form-control" name="tipo_enfermedad_no_infecciosa" id="tipo_enfermedad_no_infecciosa" type="text" placeholder="Especificar enfermedad no infecciosa">
													</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño padece de alguna enfermedad crónica?</h5>
													<div>
														<label><input type="radio" name="enfermedad_cronica" value="si" required onclick="toggleCronicaInput()"> Sí</label>
														<label><input type="radio" name="enfermedad_cronica" value="no" onclick="toggleCronicaInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
														<input class="form-control" name="tipo_enfermedad_cronica" id="tipo_enfermedad_cronica" type="text" placeholder="Especificar enfermedad crónica">
													</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño padece de alguna discapacidad?</h5>
													<div>
														<label><input type="radio" name="discapacidad" value="si" required onclick="toggleDiscapacidadInput()"> Sí</label>
														<label><input type="radio" name="discapacidad" value="no" onclick="toggleDiscapacidadInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" name="tipo_discapacidad" id="tipo_discapacidad" type="text" placeholder="Especificar discapacidad">
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Otras</label>
													<input class="form-control" id="otros" name="otros" type="text" required>
												</div>
											</div>

											<h5><b>Historia de Desarrollo</b></h5>
											<div class="form-row">
											<div class="form-group label-floating col-md-6">
													<h5>Durante el embarazo ¿la madre recibió algun tipo de medicamento?</h5>
													<div>
														<label><input type="radio" name="medicamento_embarazo" value="si" required onclick="toggleMedicamentoInput()"> Sí</label>
														<label><input type="radio" name="medicamento_embarazo" value="no" onclick="toggleMedicamentoInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" id="tipo_medicamento" name="tipo_medicamento"  type="text" placeholder="Especificar medicamento">
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>Durante el embarazo ¿la madre fumo?</h5>
													<div>
														<label><input type="radio" name="fumo_embarazo" value="si" required onclick="toggleFumoInput()"> Sí</label>
														<label><input type="radio" name="fumo_embarazo" value="no" onclick="toggleFumoInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
														<input class="form-control" name="cantidad" id="cantidad" type="text" placeholder="Cantidad que fumaba al dia">
													</div>
												<div class="form-group label-floating col-md-6">
													<h5>Durante el embarazo ¿la madre tomo bebidas alcohólicas?</h5>
													<div>
														<label><input type="radio" name="alcohol_embarazo" value="si" required onclick="toggleAlcoholInput()"> Sí</label>
														<label><input type="radio" name="alcohol_embarazo" value="no" onclick="toggleAlcoholInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
														<input class="form-control" name="tipo_alcohol" id="tipo_alcohol" type="text" placeholder="Especificar el tipo de alcohol">
														<input class="form-control" name="cantidad_consumia_alcohol" id="cantidad_consumia_alcohol" type="text" placeholder="Especificar cantidad consumida de alcohol">
													</div>
												<div class="form-group label-floating col-md-6">
													<h5>Durante el embarazo ¿la madre utilizo drogas?</h5>
													<div>
														<label><input type="radio" name="droga_embarazo" value="si" required onclick="toggleDrogaInput()"> Sí</label>
														<label><input type="radio" name="droga_embarazo" value="no" onclick="toggleDrogaInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" name="tipo_droga" id="tipo_droga" type="text" placeholder="Especificar la dorga utilizada en el embarazo">
												</div>
												<div class="form-group label-floating col-md-6">
													<h5> ¿Se realizaron fórceps durante el parto?</h5>
													<div>
														<label><input type="radio" name="forceps_parto" value="si" required onclick="toggleForcepsInput()"> Sí</label>
														<label><input type="radio" name="forceps_parto" value="no" onclick="toggleForcepsInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<h5> ¿Se realizo cesárea?</h5>
													<div>
														<label><input type="radio" name="cesarea" value="si" required onclick="toggleCesareaInput()"> Sí</label>
														<label><input type="radio" name="cesarea" value="no" onclick="toggleCesareaInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
														<input class="form-control" name="razon_cesarea" id="razon_cesarea" type="text" placeholder="Razón de la cesárea">
													</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño fue prematuro?</h5>
													<div>
														<label><input type="radio" name="niño_prematuro" value="si" required onclick="togglePrematuroInput()"> Sí</label>
														<label><input type="radio" name="niño_prematuro" value="no" onclick="togglePrematuroInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" name="meses_prematuro" id="meses_prematuro" type="text" placeholder="Especificar por cuantos meses">
												</div>
												<div class="form-group label-floating col-md-6">
												<label class="control -label">Peso del niño al nacer</label>
													<input class="form-control" name="peso_nacer_niño" id="peso_nacer_niño" type="number" placeholder="Especificar el peso del niño al nacer">
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿Hubo complicaciones en el nacimiento?</h5>
													<div>
														<label><input type="radio" name="complicaciones_nacer" value="si" required onclick="toggleComplicacionesInput()"> Sí</label>
														<label><input type="radio" name="complicaciones_nacer" value="no" onclick="toggleComplicacionesInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" name="tipo_complicacion" id="tipo_complicacion" type="text" placeholder="Especificar el tipo de complicación">
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿Hubo algun tipo de problema de alimentación?</h5>
													<div>
														<label><input type="radio" name="problema_alimentacion" value="si" required onclick="toggleAlimentacionInput()"> Sí</label>
														<label><input type="radio" name="problema_alimentacion" value="no" onclick="toggleAlimentacionInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" name="tipo_problema_alimenticio" id="tipo_problema_alimenticio" type="text" placeholder="Especificar tipo de problema alimenticio">
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño tenia problemas para dormir?</h5>
													<div>
														<label><input type="radio" name="problema_dormir" value="si" required onclick="toggleDormirInput()"> Sí</label>
														<label><input type="radio" name="problema_dormir" value="no" onclick="toggleDormirInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" name="tipo_problema_dormir" id="tipo_problema_dormir" type="text" placeholder="Especificar tipo de problema para dormir">
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>Cuando recien nacido ¿el niño era tranquilo?</h5>
													<div>
														<label><input type="radio" name="tranquilo_recien_nacido" value="si" required onclick="toggleTranquiloInput()"> Sí</label>
														<label><input type="radio" name="tranquilo_recien_nacido" value="no" onclick="toggleTranquiloInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>Cuando recien nacido ¿el niño le gustaba que lo cargaran?</h5>
													<div>
														<label><input type="radio" name="gustaba_cargaran_recien_nacido" value="si" required onclick="toggleCargarInput()"> Sí</label>
														<label><input type="radio" name="gustaba_cargaran_recien_nacido" value="no" onclick="toggleCargarInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>Cuando recien nacido ¿el niño estaba alerta?</h5>
													<div>
														<label><input type="radio" name="alerta_recien_nacido" value="si" required onclick="toggleAlertaInput()"> Sí</label>
														<label><input type="radio" name="alerta_recien_nacido" value="no" onclick="toggleAlertaInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿Hubo algun problema o complicacion en el crecimiento y desarrollo del niño en los primeros años de vida?</h5>
													<div>
														<label><input type="radio" name="problemas_desarrollo_primeros_años" value="si" required onclick="togglePrimerosInput()"> Sí</label>
														<label><input type="radio" name="problemas_desarrollo_primeros_años" value="no" onclick="togglePrimerosInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" name="cuales_problemas" id="cuales_problemas" type="text" placeholder="Especificar tipo de problema o complicacion en el desarrollo">
												</div>
											</div>

											<h5><b>Historia Escolar</b></h5>
											<div class="form-row">
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño esta escolarizado?</h5>
													<div>
														<label><input type="radio" name="escolarizado" value="si" required onclick="toggleEscolarizadoInput()"> Sí</label>
														<label><input type="radio" name="escolarizado" value="no" onclick="toggleEscolarizadoInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" name="tipo_educaion" id="tipo_educaion" type="text" placeholder="Especificar el tipo de educacion que recibe el niño">
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿Recibe alguna terapia o tutoria?</h5>
													<div>
														<label><input type="radio" name="tutoria_terapias" value="si" required onclick="toggleTerapiaTutoriaInput()"> Sí</label>
														<label><input type="radio" name="tutoria_terapias" value="no" onclick="toggleTerapiaTutoriaInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" name="tutoria_terapias_cuales" id="tutoria_terapias_cuales" type="text" placeholder="Especificar las terapias o tutorias que recibe el niño">
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño presenta alguna dificultad para la lectura?</h5>
													<div>
														<label><input type="radio" name="dificultad_lectura" value="si" required onclick="toggleLecturaInput()"> Sí</label>
														<label><input type="radio" name="dificultad_lectura" value="no" onclick="toggleLecturaInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño presenta alguna dificultad para la aritmetica?</h5>
													<div>
														<label><input type="radio" name="dificultad_aritmetica" value="si" required onclick="toggleAritmeticaInput()"> Sí</label>
														<label><input type="radio" name="dificultad_aritmetica" value="no" onclick="toggleAritmeticaInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño presenta alguna dificultad para la escritura?</h5>
													<div>
														<label><input type="radio" name="dificultad_escribir" value="si" required onclick="toggleEscrituraInput()"> Sí</label>
														<label><input type="radio" name="dificultad_escribir" value="no" onclick="toggleEscrituraInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿le agrada el ambiente escolar?</h5>
													<div>
														<label><input type="radio" name="agrada_escuela" value="si" required onclick="toggleEscolarInput()"> Sí</label>
														<label><input type="radio" name="agrada_escuela" value="no" onclick="toggleEscolarInput()"> No</label>
													</div>
												</div>
											</div>
											<p class="text-center">
												<button type="submit" name="registrar" class="btn btn-primary">
													<i class="zmdi zmdi-floppy"></i> Registrar
												</button>
											</p>
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
@endsection
@section('js')
<script>
function validarNumero(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}
</script>
<script>
function cambiarColor(radio) {
    const label = radio.closest('div').previousElementSibling;
    if (radio.checked) {
        label.classList.add('highlight');
    } else {
        label.classList.remove('highlight');
    }
}
</script>
<script>
function actualizarMiembros() {
    const cantidadPersonas = document.getElementById('cantidad_personas').value;
    const miembrosContainer = document.getElementById('miembros-container');

    miembrosContainer.innerHTML = '<h5>Personas que viven en la vivienda</h5>';

    for (let i = 0; i < cantidadPersonas; i++) {
        const miembroDiv = document.createElement('div');
        miembroDiv.className = 'miembro';

        miembroDiv.innerHTML = `
            <input class="form-control" type="text" name="nombre[]" placeholder="Nombre" required>
            <input class="form-control" type="text" name="apellido[]" placeholder="Apellido" required>
            <input class="form-control" type="date" name="fecha_nac[]" required id="fecha_nac_${i}">
            <input class="form-control" type="text" name="parentesco[]" placeholder="Parentesco" required>
            
            <h5>¿Tiene alguna discapacidad?</h5>
            <div>
                <label><input type="radio" name="discapacidad_${i}" value="si" onclick="toggleTipoDiscapacidad(${i})"> Sí</label>
                <label><input type="radio" name="discapacidad_${i}" value="no" onclick="toggleTipoDiscapacidad(${i})"> No</label>
            </div>
            <div id="tipo-discapacidad-${i}" class="tipo-input" style="display: none;">
                <input class="form-control" type="text" name="tipo_discapacidad[]" placeholder="Tipo de discapacidad" required>
            </div>

            <h5>¿Tiene alguna enfermedad crónica?</h5>
            <div>
                <label><input type="radio" name="enfermedad_cronica_${i}" value="si" onclick="toggleTipoEnfermedad(${i})"> Sí</label>
                <label><input type="radio" name="enfermedad_cronica_${i}" value="no" onclick="toggleTipoEnfermedad(${i})"> No</label>
            </div>
            <div id="tipo-enfermedad-${i}" class="tipo-input" style="display: none;">
                <input class="form-control" type="text" name="tipo_enfermedad[]" placeholder="Tipo de enfermedad crónica" required>
            </div>

            <button type="button" class="eliminar btn btn-primary" onclick="eliminarMiembro(this)">Eliminar</button>
        `;
        miembrosContainer.appendChild(miembroDiv);
        const today = new Date().toISOString().split('T')[0];
        document.getElementById(`fecha_nac_${i}`).setAttribute('max', today);
    }
}

function toggleTipoDiscapacidad(index) {
    const tipoDiscapacidadInput = document.getElementById(`tipo-discapacidad-${index}`);
    const radios = document.getElementsByName(`discapacidad_${index}`);
    tipoDiscapacidadInput.style.display = radios[0].checked ? 'block' : 'none';
}
function toggleTipoEnfermedad(index) {
    const tipoEnfermedadInput = document.getElementById(`tipo-enfermedad-${index}`);
    const radios = document.getElementsByName(`enfermedad_cronica_${index}`);
    tipoEnfermedadInput.style.display = radios[0].checked ? 'block' : 'none';
}
function agregarMiembro() {
    const miembrosContainer = document.getElementById('miembros-container');
    const miembroDiv = document.createElement('div');
    miembroDiv.className = 'miembro';

    const index = miembrosContainer.children.length; 

    miembroDiv.innerHTML = `
        <input class="form-control" type="text" name="nombre[]" placeholder="Nombre" required>
        <input class="form-control" type="text" name="apellido[]" placeholder="Apellido" required>
        <input class="form-control" type="date" name="fecha_nac[]" required id="fecha_nac_${index}">
        <input class="form-control" type="text" name="parentesco[]" placeholder="Parentesco" required>
        
        <h5>¿Tiene alguna discapacidad?</h5>
        <div>
            <label><input type="radio" name="discapacidad_${index}" value="si" onclick="toggleTipoDiscapacidad(${index})"> Sí</label>
            <label><input type="radio" name="discapacidad_${index}" value="no" onclick="toggleTipoDiscapacidad(${index})"> No</label>
        </div>
        <div id="tipo-discapacidad-${index}" class="tipo-input" style="display: none;">
            <input class="form-control" type="text" name="tipo_discapacidad[]" placeholder="Tipo de discapacidad" required>
        </div>

        <h5>¿Tiene alguna enfermedad crónica?</h5>
        <div>
            <label><input type="radio" name="enfermedad_cronica_${index}" value="si" onclick="toggleTipoEnfermedad(${index})"> Sí</label>
            <label><input type="radio" name="enfermedad_cronica_${index}" value="no" onclick="toggleTipoEnfermedad(${index})"> No</label>
        </div>
        <div id="tipo-enfermedad-${index}" class="tipo-input" style="display: none;">
            <input class="form-control" type="text" name="tipo_enfermedad[]" placeholder="Tipo de enfermedad crónica" required>
        </div>

        <button type="button" class="eliminar btn btn-primary" onclick="eliminarMiembro(this)">Eliminar</button>
    `;

    miembrosContainer.appendChild(miembroDiv);
    
    const today = new Date().toISOString().split('T')[0];
    document.getElementById(`fecha_nac_${index}`).setAttribute('max', today);
}

function eliminarMiembro(button) {
    const miembroDiv = button.parentElement;
    miembroDiv.remove();
}
</script>
<script>
function toggleEnfermedadInput() {
    const enfermedad_infecciosaYes = document.querySelector(`input[name="enfermedad_infecciosa"][value="si"]`);
    const tipo_enfermedadinfecciosaInput = document.getElementById('tipo_enfermedad_infecciosa'); 
    if (enfermedad_infecciosaYes.checked) {
        tipo_enfermedadinfecciosaInput.style.display = 'block'; 
    } else {
        tipo_enfermedadinfecciosaInput.style.display = 'none'; 
        tipo_enfermedadinfecciosaInput.value = 'no'; 
    }
}
function toggleEnefermedadNoInput(){
	const enfermedad_no_infecciosaYes = document.querySelector(`input[name="enfermedad_no_infecciosa"][value="si"]`);
    const tipo_enfermedad_noinfecciosaInput = document.getElementById('tipo_enfermedad_no_infecciosa'); 
    if (enfermedad_no_infecciosaYes.checked) {
        tipo_enfermedad_noinfecciosaInput.style.display = 'block'; 
    } else {
        tipo_enfermedad_noinfecciosaInput.style.display = 'none'; 
        tipo_enfermedad_noinfecciosaInput.value = 'no'; 
    }
}
function toggleDiscapacidadInput(){
	const discapacidadYes = document.querySelector(`input[name="discapacidad"][value="si"]`);
    const tipo_discapacidadInput = document.getElementById('tipo_discapacidad'); 
    if (discapacidadYes.checked) {
        tipo_discapacidadInput.style.display = 'block'; 
    } else {
        tipo_discapacidadInput.style.display = 'none'; 
        tipo_discapacidadInput.value = 'no'; 
    }
}
function toggleCronicaInput(){
	const enfermedad_cronicaYes = document.querySelector(`input[name="enfermedad_cronica"][value="si"]`);
    const tipo_enfermedad_cronicaInput = document.getElementById('tipo_enfermedad_cronica'); 
    if (enfermedad_cronicaYes.checked) {
        tipo_enfermedad_cronicaInput.style.display = 'block'; 
    } else {
        tipo_enfermedad_cronicaInput.style.display = 'none'; 
        tipo_enfermedad_cronicaInput.value = 'no'; 
    }
}

function toggleMedicamentoInput(){
	const medicamento_embarazoYes = document.querySelector(`input[name="medicamento_embarazo"][value="si"]`);
    const tipo_medicamentoInput = document.getElementById('tipo_medicamento'); 

    if (medicamento_embarazoYes.checked) {
        tipo_medicamentoInput.style.display = 'block'; 
    } else {
        tipo_medicamentoInput.style.display = 'none'; 
        tipo_medicamentoInput.value = 'no'; 
    }
}
function toggleFumoInput(){
	const fumo_embarazoYes = document.querySelector(`input[name="fumo_embarazo"][value="si"]`);
    const cantidadInput = document.getElementById('cantidad'); 
    if (fumo_embarazoYes.checked) {
        cantidadInput.style.display = 'block'; 
    } else {
        cantidadInput.style.display = 'none'; 
        cantidadInput.value = 'no'; 
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
        tipo_alcoholInput.value = 'no'; 
		cantidad_consumia_alcoholInput.style.display = 'none'; 
        cantidad_consumia_alcoholInput.value = 'no'; 
    }
}
function toggleDrogaInput(){
	const droga_embarazoYes = document.querySelector(`input[name="droga_embarazo"][value="si"]`);
    const tipo_drogaInput = document.getElementById('tipo_droga'); 
    if (droga_embarazoYes.checked) {
        tipo_drogaInput.style.display = 'block'; 
    } else {
        tipo_drogaInput.style.display = 'none'; 
        tipo_drogaInput.value = 'no'; 
    }
}
function toggleCesareaInput(){
	const cesareaYes = document.querySelector(`input[name="cesarea"][value="si"]`);
    const razon_cesareaInput = document.getElementById('razon_cesarea'); 
    if (cesareaYes.checked) {
        razon_cesareaInput.style.display = 'block'; 
    } else {
        razon_cesareaInput.style.display = 'none'; 
        razon_cesareaInput.value = 'no'; 
    }
}
function togglePrematuroInput(){
	const niño_prematuroYes = document.querySelector(`input[name="niño_prematuro"][value="si"]`);
    const meses_prematuroInput = document.getElementById('meses_prematuro'); 
    if (niño_prematuroYes.checked) {
        meses_prematuroInput.style.display = 'block'; 
    } else {
        meses_prematuroInput.style.display = 'none'; 
        meses_prematuroInput.value = 'no'; 
    }
}
function toggleComplicacionesInput(){
	const complicaciones_nacerYes = document.querySelector(`input[name="complicaciones_nacer"][value="si"]`);
    const tipo_complicacionInput = document.getElementById('tipo_complicacion'); 
    if (complicaciones_nacerYes.checked) {
        tipo_complicacionInput.style.display = 'block'; 
    } else {
        tipo_complicacionInput.style.display = 'none'; 
        tipo_complicacionInput.value = 'no'; 
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
        tipo_problema_dormirInput.value = 'no'; 
    }
}
function togglePrimerosInput(){
	const problemas_desarrollo_primeros_añosYes = document.querySelector(`input[name="problemas_desarrollo_primeros_años"][value="si"]`);
    const cuales_problemasInput = document.getElementById('cuales_problemas'); 
    if (problemas_desarrollo_primeros_añosYes.checked) {
        cuales_problemasInput.style.display = 'block'; 
    } else {
        cuales_problemasInput.style.display = 'none'; 
        cuales_problemasInput.value = 'no'; 
    }
}
function toggleEscolarizadoInput(){
	const escolarizadoYes = document.querySelector(`input[name="escolarizado"][value="si"]`);
    const tipo_educaionInput = document.getElementById('tipo_educaion'); 

    if (escolarizadoYes.checked) {
        tipo_educaionInput.style.display = 'block'; 
    } else {
        tipo_educaionInput.style.display = 'none'; 
        tipo_educaionInput.value = 'no'; 
    }
}
function toggleTerapiaTutoriaInput(){
	const tutoria_terapiasYes = document.querySelector(`input[name="tutoria_terapias"][value="si"]`);
    const tutoria_terapias_cualesInput = document.getElementById('tutoria_terapias_cuales'); 
    if (tutoria_terapiasYes.checked) {
        tutoria_terapias_cualesInput.style.display = 'block'; 
    } else {
        tutoria_terapias_cualesInput.style.display = 'none'; 
        tutoria_terapias_cualesInput.value = 'no'; 
    }
}

function toggleInterInput(){
	const disponibilidad_internetYes = document.querySelector(`input[name="disponibilidad_internet"][value="si"]`);
    const tipo_conexionInput = document.getElementById('tipo_conexion_internet'); 
    if (disponibilidad_internetYes.checked) {
        tipo_conexionInput.style.display = 'block'; 
    } else {
        tipo_conexionInput.style.display = 'none'; 
        tipo_conexionInput.value = 'no'; 
    }
}
</script>
<script>
$('#miFormulario').on('submit', function(e) {
    e.preventDefault(); 

    $.ajax({
        url: '{{ route('historias.store') }}', 
        method: 'POST',
        data: $(this).serialize(), 
        success: function(response) {
            alert(response.success); 
        },
        error: function(xhr) {
            alert(xhr.responseJSON.error);
        }
    });
});

</script>
@endsection