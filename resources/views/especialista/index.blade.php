@extends('layouts.app')
@section('title', 'Especialistas')
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
			  <h1 class="text-titles"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i>Especialistas</h1>
			</div>
			<p class="lead">
			</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
					  	<li><a href="#new" data-toggle="tab" ><i class="zmdi zmdi-plus ">Nuevo</i></a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						
					  	<div class="tab-pane fade active in" id="list">
								<div class="table-responsive">
									<table class="table table-hover text-center" id="tab-especialista">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Nombre</th>
												<th class="text-center">Apellido</th>
												<th class="text-center">CI</th>
												<th class="text-center">Correo</th>
												<th class="text-center">Telefono</th>
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
                                    <form id="registro-especialista">@csrf
                                            <div id="paso1">
                                                <h3>Datos Personales</h3>
                                                <div class="fila-formulario">
                                                <div class="form-group label-floating col-md-6">
														<label class="control-label">Nombre</label>
														<input class="form-control" id="nombre" name="nombre" type="text">
													</div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Apellido</label>
                                                        <input class="form-control" id="apellido" name="apellido" type="text" required>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">CI</label>
                                                        <input class="form-control" id="ci" name="ci" type="number" required max="34000000" oninput="validateInput(this)">
                                                    </div>
                                                    <div class="form-group  col-md-6">
                                                        <label class="control-label">Fecha de Nacimiento</label>
                                                        <input class="form-control" type="date" name="fecha_nac" id="fecha_nac" required>
                                                    </div>
                                                    <div class="form-grup col-md-6">
                                                        <label class="control-label">Especialidad</label>
                                                        <select class="form-control select2" required style="width: 100%;" id="especialidad_id" name="especialidad_id">
                                                            <option selected disabled>Seleccione su especialidad</option>
                                                            @foreach ($especialidades as $especialidad)
                                                                <option value="{{ $especialidad->id }}">{{ $especialidad->especialidad }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Teléfono</label>
                                                        <input class="form-control" type="tel" id="telefono" name="telefono" required>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Correo electrónico</label>
                                                        <input class="form-control" type="email" id="email" name="email" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">Género</label>
                                                        <select class="form-control select2" required style="width: 100%;" id="genero_id" name="genero_id">
                                                            <option selected disabled>Seleccione su género</option>
                                                            @foreach ($generos as $genero)
                                                                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <p class="centro-texto">
                                                    <button type="button" id="siguiente1" class="btn btn-primary">Siguiente</button>
                                                </p>
                                            </div>
                                            <div id="paso2" style="display: none;">
                                                <h3>Datos de Dirección</h3>
                                                <div class="fila-formulario">
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Estado</label>
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="estado_id" name="estado_id">
                                                            <option selected disabled>Seleccione su estado</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">Municipio</label>
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="municipio_id" name="municipio_id">
                                                            <option selected disabled>Seleccione su municipio</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">Parroquia</label>
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="parroquia_id" name="parroquia_id">
                                                            <option selected disabled>Seleccione su parroquia</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Sector</label>
                                                        <input class="form-control" type="text" id="sector" name="sector" required>
                                                    </div>
                                                </div>
                                                <p class="centro-texto">
                                                    <button type="button" id="regresar" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> Regresar</button>
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
		
</section>
 <!-- modal editar -->
 <div class="modal fade" id="especialistaEditModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Actualizar Especialista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-especialista-form">
                    <div class="modal-body">
					@csrf
					<input type="hidden" id="id" name="id">
													<div class="form-group label-floating">
														<label class="control-label">Nombre</label>
														<input class="form-control" id="nombre2" name="nombre2" type="text">
													</div>
													<div class="form-group label-floating">
														<label class="control-label">Apellido</label>
														<input class="form-control" id="apellido2" name="apellido2" type="text">
													</div>
													<div class="form-group label-floating">
														<label class="control-label">CI</label>
														<input class="form-control" id="ci2" name="ci2" type="number">
													</div>
													<div class="form-group label-floating">
														<label class="control-label">Fecha de Nacimiento</label>
														<input class="form-control" type="date" name="fecha_nac_edit" id="fecha_nac_edit">
													</div>
													<div class="form-group label-floating">
														<label class="control-label">Especialidad</label>
														<input class="form-control" id="especialidad_id2" name="especialidad_id2" type="text">
													</div>
													<div class="form-group label-floating">
														<label class="control-label">Telefono</label>
														<input class="form-control" type="text" id="telefono2" name="telefono2">
													</div>
													<div class="form-group label-floating">
														<label class="control-label">Correo electronico</label>
														<input class="form-control" type="text" id="email2" name="email2">
													</div>
													<div class="form-group">
																<label class="control-label">Genero</label>
																<select class="form-control  select2" required style="width: 100%;" id="genero_id2">
																<option selected>Seleccione su género</option>
																@foreach ($generos as $genero)
																<option value="{{ $genero->id }}">{{ $genero->genero }}</option>
																@endforeach
															</select>
													</div>
														<div class="form-group">
														<label class="">Dirección</label>
													</div>
													<div class="form-group">
																<label class="control-label">Estado</label>
																<select class="form-control form-control-solid select2" required style="width: 100%;" id="estado_id">
																<option selected>Seleccione su estado</option>
																@foreach ($estados as $estado)
																<option value="{{ $estado->id }}">{{ $estado->estado }}</option>
																@endforeach
															</select>
														</div>
														<div class="form-group">
																<label class="control-label">Munucipio</label>
																<select class="form-control form-control-solid select2" required style="width: 100%;" id="municipio_id">
																<option selected>Seleccione su municipio</option>
																@foreach ($municipios as $municipio)
																<option value="{{ $municipio->id }}">{{ $municipio->municipio }}</option>
																@endforeach
															</select>
														</div>
														<div class="form-group">
																<label class="control-label">Parroquia</label>
																<select class="form-control form-control-solid select2" required style="width: 100%;" id="parroquia_id">
																<option selected>Seleccione su parroquia</option>
																@foreach ($parroquias as $parroquia)
																<option value="{{ $parroquia->id }}">{{ $parroquia->parroquia }}</option>
																@endforeach
															</select>
														</div>
														<div class="form-group">
														<label class="control-label">Sector</label>
														<input class="form-control" type="text" id="sector2" name="sector2">
													</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal eliminar -->
<div class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro seleccionado?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-danger">Eliminar</button>
            </div>
            </div>
        </div>
    </div> 
@endsection
@section('js')
<script>
$(document).ready(function(){
    var tablaEspecialista = $('#tab-especialista').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
            url: "{{ route('especialista.index')}}",
        },
        columns:[
            {data: 'id'},
            {data: 'nombre'},
            {data: 'apellido'},
            {data: 'ci'},
			{data: 'email'},
            {data: 'telefono'},
            {data: 'action', orderable: false}
        ]
    });
});
</script>
<script>
    $(document).ready(function() {
        $("#paso1").show();

        $("#siguiente1").click(function() {
            $("#paso1").hide(); 
            $("#paso2").show(); 
        });

        $("#regresar").click(function() {
        $("#paso2").hide(); 
        $("#paso1").show(); 
    });

        $("#registro-especialista").submit(function(event) {
            event.preventDefault(); 
            var nombre = $('#nombre').val();
            var apellido = $('#apellido').val();
            var ci = $('#ci').val();
            var fecha_nac = $('#fecha_nac').val();
            var especialidad_id = $('#especialidad_id').val(); 
            var telefono = $('#telefono').val();
            var email = $('#email').val();
            var genero_id = $('#genero_id').val();
            var estado_id = $('#estado_id').val();
            var municipio_id = $('#municipio_id').val();
            var parroquia_id = $('#parroquia_id').val();
            var sector = $('#sector').val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('especialista.store') }}", 
                type: "POST",
                data: {
                    nombre: nombre,
                    apellido: apellido,
                    ci: ci,
                    fecha_nac: fecha_nac,
                    especialidad_id: especialidad_id,
                    telefono: telefono,
                    email: email,
                    genero_id: genero_id,
                    estado_id: estado_id,
                    municipio_id: municipio_id,
                    parroquia_id: parroquia_id,
                    sector: sector,
                    _token: _token
                },
                success: function(response) {
                    if (response.success) {
                        $('#registro-especialista')[0].reset(); 
                        toastr.success('El registro se ingresó correctamente', 'Nuevo registro', { timeOut: 5000 });
                        $('#tab-especialista').DataTable().ajax.reload(); 
                        $("#paso1").show(); 
                        $("#paso2").hide();
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error('Ocurrió un error al registrar el especialista', 'Error', { timeOut: 5000 });
                }
            });
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
        url: "/especialista/" + id, 
        type: 'DELETE',
        beforeSend: function(){
            $('#btnEliminar').text('Eliminando...');
        },
        success: function(data){
            $('#confirModal').modal('hide');
            toastr.warning('El registro se eliminó correctamente', 'Eliminar Registro', { timeOut: 5000 });
            $('#tab-especialista').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error al eliminar el registro:', error);
            toastr.error('No se pudo eliminar el registro', 'Error', { timeOut: 5000 });
        }
    });
});
</script>
<script>
document.getElementById('telefono').addEventListener('input', function() {
    const telefonoInput = this.value;
    const validPrefixes = ['0412', '0424', '0414', '0416', '0426'];

    if (telefonoInput.length > 11) {
        this.value = telefonoInput.slice(0, 11); 
    }

    const isValidPrefix = validPrefixes.some(prefix => telefonoInput.startsWith(prefix));

    if (telefonoInput.length === 11 && !isValidPrefix) {
        toastr.warning('El número debe comenzar con 0412, 0424, 0414, 0416 o 0426.', 'Advertencia', { timeOut: 5000 });
        this.value = ''; 
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fechaNacInput = document.getElementById('fecha_nac');
    
    const today = new Date();
    
    const yearEighteen = today.getFullYear() - 18;

    const minDate = `${yearEighteen}-01-01`;
    fechaNacInput.setAttribute('min', '1900-01-01'); 
    fechaNacInput.setAttribute('max', `${yearEighteen}-12-31`); 
});
</script>
<script>
function validateInput(input) {
    const value = input.value.toString();
    
    if (parseInt(value) > 34000000 || value.length > 8) {
        toastr.warning('El número de cédula es incorrecto. Debe ser un número de hasta 8 dígitos y no mayor a 34,000,000.', 'Advertencia', { timeOut: 5000 });
        input.value = '';
    }
}
</script>
<script>
$(document).ready(function() {
    const estados = @json($estados); 

    $('#estado_id').select2({
        placeholder: "Seleccione su estado",
        allowClear: true,
        minimumInputLength: 1, 
        ajax: {
            transport: function(params, success, failure) {
                const searchTerm = params.data.term.toLowerCase().trim(); 
                const filteredEstados = estados.filter(estado => 
                    estado.estado.toLowerCase().includes(searchTerm)
                );

                const results = filteredEstados.map(estado => ({
                    id: estado.id,
                    text: estado.estado
                }));

                success({ results: results });
            }
        }
    });
});
</script>
<script>
$(document).ready(function() {
    const municipios = @json($municipios); 
    const parroquias = @json($parroquias); 

    $('#municipio_id').select2({
        placeholder: "Seleccione su municipio",
        allowClear: true
    });

    $('#parroquia_id').select2({
        placeholder: "Seleccione su parroquia",
        allowClear: true
    });

    const showMunicipios = (filteredMunicipios) => {
        $('#municipio_id').empty().append('<option selected disabled>Seleccione su municipio</option>');

        filteredMunicipios.forEach(item => {
            const option = new Option(item.municipio, item.id, false, false);
            $('#municipio_id').append(option);
        });

        $('#municipio_id').trigger('change');
    };

    const filterMunicipios = (id) => {
        const filteredMunicipios = municipios.filter(item => item.estado_id == id);
        showMunicipios(filteredMunicipios);
    };

    const showParroquias = (filteredParroquias) => {
        $('#parroquia_id').empty().append('<option selected disabled>Seleccione su parroquia</option>');

        filteredParroquias.forEach(item => {
            const option = new Option(item.parroquia, item.id, false, false);
            $('#parroquia_id').append(option);
        });

        $('#parroquia_id').trigger('change');
    };

    const filterParroquias = (id) => {
        const filteredParroquias = parroquias.filter(item => item.municipio_id == id);
        showParroquias(filteredParroquias);
    };

    $('#estado_id').on('change', function(e) {
        const estadoId = $(this).val();
        filterMunicipios(estadoId);
        $('#parroquia_id').empty().append('<option selected disabled>Seleccione su parroquia</option>');
    });

    $('#municipio_id').on('change', function(e) {
        const municipioId = $(this).val();
        filterParroquias(municipioId);
    });
});
</script>
<script>
function editespecialista(id) {
    $.get('/especialista/' + id + '/edit', function(especialista) {
        $('#id').val(especialista.id);
        $('#nombre2').val(especialista.nombre);
        $('#apellido2').val(especialista.apellido);
        $('#ci2').val(especialista.ci);
        $('#fecha_nac_edit').val(especialista.fecha_nac);
        $('#especialidad2').val(especialista.especialidad);
        $('#telefono2').val(especialista.telefono);
        $('#email2').val(especialista.email);
        $('#genero_id2').val(especialista.genero_id);
        
		if (especialista.direccion) {
    $('#estado_id').val(especialista.direccion.estado_id);
    $('#municipio_id').val(especialista.direccion.municipio_id);
    $('#parroquia_id').val(especialista.direccion.parroquia_id);
    $('#sector2').val(especialista.direccion.sector);
}


        $("input[name=_token]").val();
        $('#especialistaEditModal').modal('toggle'); 
    });
}
</script>
<script>
$(document).ready(function() {
    // Establecer la fecha máxima para el campo de fecha de nacimiento
    var hoy = new Date();
    var dd = String(hoy.getDate()).padStart(2, '0');
    var mm = String(hoy.getMonth() + 1).padStart(2, '0'); 
    var yyyy = hoy.getFullYear();
    hoy = yyyy + '-' + mm + '-' + dd; 
    $('#fecha_nac_edit').attr('max', hoy); // Establece la fecha máxima

    // Validación al enviar el formulario
    $('#edit-especialista-form').submit(function(e) {
        var fecha_nacSeleccionada = $('#fecha_nac_edit').val();
        if (fecha_nacSeleccionada > hoy) {
            e.preventDefault(); // Evita el envío del formulario
            $('#mensaje').text('Por favor, selecciona una fecha que no sea futura.').show();
        } else {
            $('#mensaje').hide(); // Oculta el mensaje si la fecha es válida

            // Continuar con la recolección de datos del formulario
            var id = $('#id').val(); 
            var nombre2 = $('#nombre2').val();
            var apellido2 = $('#apellido2').val();
            var ci2 = $('#ci2').val();
            var especialidad_id2 = $('#especialidad_id2').val();
            var telefono2 = $('#telefono2').val();
            var email2 = $('#email2').val();
            var genero_id2 = $('#genero_id2').val();
            var estado_id = $('#estado_id').val();
            var municipio_id = $('#municipio_id').val();
            var parroquia_id = $('#parroquia_id').val();
            var sector2 = $('#sector2').val();
            var _token2 = $("input[name=_token]").val();

            // Envío de la solicitud AJAX
            $.ajax({
                url: "/especialista/" + id,
                type: "PUT",
                data: {
                    id: id,
                    nombre: nombre2,
                    apellido: apellido2,
                    ci: ci2,
                    fecha_nac: fecha_nacSeleccionada, // Usa la fecha seleccionada
                    especialidad_id: especialidad_id2,
                    telefono: telefono2,
                    email: email2,
                    genero_id: genero_id2,
                    estado_id: estado_id,
                    municipio_id: municipio_id,
                    parroquia_id: parroquia_id,
                    sector: sector2,
                    _token: _token2
                },
                success: function(response) {
                    if (response.success) {
                        $('#especialistaEditModal').modal('hide');
                        toastr.info('El registro se actualizó correctamente', 'Actualizar registro', { timeOut: 5000 });
                        $('#tab-especialista').DataTable().ajax.reload();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la actualización:', textStatus, errorThrown);
                    alert('Ocurrió un error al actualizar el registro. Intenta nuevamente.');
                }
            });
        }
    });
});

</script>
@endsection
