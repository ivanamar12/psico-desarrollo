@extends('layouts.app')

@section('title', 'Pacientes')

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
			  <h1 class="text-titles"><i class="zmdi zmdi-face zmdi-hc-fw"></i>Pacientes</h1>
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
									<table class="table table-hover text-center" id="tab-paciente">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Nombre</th>
												<th class="text-center">Apellido</th>
												<th class="text-center">Representante</th>
												<th class="text-center">Fechas de Nacimiento</th>
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
											<form id="registro-paciente">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Representante</label>
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="representante_id">
                                                            <option selected>Seleccione su representante</option>
                                                            @foreach ($representantes as $representante)
                                                                <option value="{{ $representante->id }}">{{ $representante->nombre }} {{ $representante->apellido }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                                    <label class="control-label">Genero</label>
                                                                    <select class="form-control select2" required style="width: 100%;" id="genero_id">
                                                                        <option selected>Seleccione su género</option>
                                                                        @foreach ($generos as $genero)
                                                                        <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Fecha de Nacimiento</label>
                                                        <input class="form-control" type="date" name="fecha_nac" id="fecha_nac">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Nombres</label>
                                                        <input class="form-control" id="nombre" name="nombre" type="text">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Apellidos</label>
                                                        <input class="form-control" id="apellido" name="apellido" type="text">
                                                    </div>
                                                    <!-- Información donde nació -->
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Estado donde nació</label>
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="estado_nacimiento_id">
                                                            <option selected>Seleccione su estado</option>
                                                            @foreach ($estados as $estado)
                                                                <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Municipio donde nació</label>
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="municipio_nacimiento_id">
                                                            <option value="0" selected>Seleccione su municipio</option>
                                                            @foreach ($municipios as $municipio)
                                                                <option value="{{ $municipio->id }}">{{ $municipio->municipio }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">Parroquia donde nació</label>
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="parroquia_nacimiento_id">
                                                            <option selected>Seleccione su parroquia</option>
                                                            @foreach ($parroquias as $parroquia)
                                                                <option value="{{ $parroquia->id }}">{{ $parroquia->parroquia }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Lugar donde nació</label>
                                                        <input class="form-control" type="text" id="lugar" name="lugar">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Nombres de la Madre</label>
                                                        <input class="form-control" id="nombre_mama" name="nombre_mama" type="text">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Apellidos de la Madre</label>
                                                        <input class="form-control" id="apellido_mama" name="apellido_mama" type="text">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">CI de la Madre</label>
                                                        <input class="form-control" id="ci_mama" name="ci_mama" type="number" onchange="if(parseInt($(this).val()) < parseInt($('#stock_min').val())){alert('Error, el maximo no puede ser menor al minimo'); $(this).val('');}" onkeypress="var w = event.which == undefined? event.which : event.keyCode; return w>=48 && w <=57 && this.value.length<=7;">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Fecha de Nacimiento de la Madre</label>
                                                        <input class="form-control" type="date" name="fecha_nac_mama" id="fecha_nac_mama">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Grado de la Madre</label>
                                                        <input class="form-control" id="grado_mama" name="grado_mama" type="text">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Telefono de la Madre</label>
                                                        <input class="form-control" type="number" id="telefono_mama" name="telefono_mama" onchange="if(parseInt($(this).val()) < parseInt($('#stock_min').val())){alert('Error, el maximo no puede ser menor al minimo'); $(this).val('');}" onkeypress="var w = event.which == undefined? event.which : event.keyCode; return w>=48 && w <=57 && this.value.length<=10;">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Correo electronico de la Madre</label>
                                                        <input class="form-control" type="email" id="email_mama" name="email_mama">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Nombres del Padre</label>
                                                        <input class="form-control" id="nombre_papa" name="nombre_papa" type="text">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Apellidos del Padre</label>
                                                        <input class="form-control" id="apellido_papa" name="apellido_papa" type="text">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">CI del Padre</label>
                                                        <input class="form-control" id="ci_papa" name="ci_papa" type="number" onchange="if(parseInt($(this).val()) < parseInt($('#stock_min').val())){alert('Error, el maximo no puede ser menor al minimo'); $(this).val('');}" onkeypress="var w = event.which == undefined? event.which : event.keyCode; return w>=48 && w <=57 && this.value.length<=7;">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Fecha de Nacimiento del Padre</label>
                                                        <input class="form-control" type="date" name="fecha_nac_papa" id="fecha_nac_papa">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Grado del Padre</label>
                                                        <input class="form-control" id="grado_papa" name="grado_papa" type="text">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Telefono del Padre</label>
                                                        <input class="form-control" type="number" id="telefono_papa" name="telefono_papa" onchange="if(parseInt($(this).val()) < parseInt($('#stock_min').val())){alert('Error, el maximo no puede ser menor al minimo'); $(this).val('');}" onkeypress="var w = event.which == undefined? event.which : event.keyCode; return w>=48 && w <=57 && this.value.length<=10;">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Correo electronico del Padre</label>
                                                        <input class="form-control" type="email" id="email_papa" name="email_papa">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Estado civil de los padres</label>
                                                        <input class="form-control" type="text" id="estado_civil" name="estado_civil">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Custodia del paciente</label>
                                                        <input class="form-control" type="text" id="custodia_niño" name="custodia_niño">
                                                    </div>
                                                                
                                                    <!-- Información donde vive actualmente -->
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Estado donde vive</label>
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="estado_vive_id">
                                                            <option selected>Seleccione su estado</option>
                                                            @foreach ($estados as $estado)
                                                                <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Municipio donde vive</label>
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="municipio_vive_id">
                                                            <option value="0" selected>Seleccione su municipio</option>
                                                            @foreach ($municipios as $municipio)
                                                                <option value="{{ $municipio->id }}">{{ $municipio->municipio }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">Parroquia donde vive</label>
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="parroquia_vive_id">
                                                            <option selected>Seleccione su parroquia</option>
                                                            @foreach ($parroquias as $parroquia)
                                                                <option value="{{ $parroquia->id }}">{{ $parroquia->parroquia }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Lugar donde vive</label>
                                                        <input class="form-control" type="text" id="sector" name="sector">
                                                    </div>
                                                </div>
                                                <p class="text-center">
                                                    <button type="submit" name="registrar" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i>Registrar</button>			
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
const estados = @json($estados);
const municipios = @json($municipios);
const parroquias = @json($parroquias);

// Elementos de dirección de nacimiento
const selectEstadoNacimiento = $('#estado_nacimiento_id');
const selectMunicipioNacimiento = $('#municipio_nacimiento_id');
const selectParroquiaNacimiento = $('#parroquia_nacimiento_id');

// Elementos de dirección actual
const selectEstadoVive = $('#estado_vive_id');
const selectMunicipioVive = $('#municipio_vive_id');
const selectParroquiaVive = $('#parroquia_vive_id');

const showEstados = (estados, selectEstado) => {
    selectEstado.empty().append('<option selected>Seleccione estado</option>');
    estados.forEach(item => {
        selectEstado.append(`<option value="${item.id}">${item.estado}</option>`);
    });
};

const showMunicipios = (filteredMunicipios, selectMunicipio) => {
    selectMunicipio.empty().append('<option selected>Seleccione municipio</option>');
    filteredMunicipios.forEach(item => {
        selectMunicipio.append(`<option value="${item.id}">${item.municipio}</option>`);
    });
};

const showParroquias = (filteredParroquias, selectParroquia) => {
    selectParroquia.empty().append('<option selected>Seleccione parroquia</option>');
    filteredParroquias.forEach(item => {
        selectParroquia.append(`<option value="${item.id}">${item.parroquia}</option>`);
    });
};

const filterMunicipios = (id, selectMunicipio) => {
    const filteredMunicipios = municipios.filter(item => item.estado_id == id);
    showMunicipios(filteredMunicipios, selectMunicipio);
};

const filterParroquias = (id, selectParroquia) => {
    const filteredParroquias = parroquias.filter(item => item.municipio_id == id);
    showParroquias(filteredParroquias, selectParroquia);
};

// Eventos para dirección de nacimiento
selectEstadoNacimiento.on('change', function() {
    const IdValue = $(this).val();
    filterMunicipios(IdValue, selectMunicipioNacimiento);
});

selectMunicipioNacimiento.on('change', function() {
    const IdValue = $(this).val();
    filterParroquias(IdValue, selectParroquiaNacimiento);
});

// Eventos para dirección actual
selectEstadoVive.on('change', function() {
    const IdValue = $(this).val();
    filterMunicipios(IdValue, selectMunicipioVive);
});

selectMunicipioVive.on('change', function() {
    const IdValue = $(this).val();
    filterParroquias(IdValue, selectParroquiaVive);
});

</script>
<script>
$(document).ready(function(){
    var tablaPaciente = $('#tab-paciente').DataTable({
        
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('paciente.index') }}",
        },
        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'representante', name: 'representante' }, 
            { data: 'fecha_nac' },
            { data: 'action', orderable: false }
        ]
    });
});
</script>

<script>
$(document).ready(function() {
    $('#registro-paciente').submit(function(e) {
        e.preventDefault();
        var representante_id = $('#representante_id').val();
        var genero_id = $('#genero_id').val();
		var fecha_nac = $('#fecha_nac').val();
		var nombre = $('#nombre').val();
		var apellido = $('#apellido').val();
		var estado_nacimiento_id = $('#estado_nacimiento_id').val();
		var municipio_nacimiento_id = $('#municipio_nacimiento_id').val();
		var parroquia_nacimiento_id = $('#parroquia_nacimiento_id').val();
		var lugar = $('#lugar').val();
		var nombre_mama = $('#nombre_mama').val();
		var apellido_mama = $('#apellido_mama').val();
        var ci_mama = $('#ci_mama').val();
        var fecha_nac_mama = $('#fecha_nac_mama').val();
		var grado_mama = $('#grado_mama').val();
		var telefono_mama = $('#telefono_mama').val();
		var email_mama = $('#email_mama').val();
		var nombre_papa = $('#nombre_papa').val();
		var apellido_papa = $('#apellido_papa').val();
		var ci_papa = $('#ci_papa').val();
		var fecha_nac_papa = $('#fecha_nac_papa').val();
		var grado_papa = $('#grado_papa').val();
		var telefono_papa = $('#telefono_papa').val();
        var email_papa = $('#email_papa').val();
		var estado_civil = $('#estado_civil').val();
		var custodia_niño = $('#custodia_niño').val();
		var estado_vive_id = $('#estado_vive_id').val();
		var municipio_vive_id = $('#municipio_vive_id').val();
		var parroquia_vive_id = $('#parroquia_vive_id').val();
		var sector = $('#sector').val();
        var _token = $("input[name=_token]").val();

        console.log({
    representante_id: representante_id,
    ci_mama: ci_mama,
});


        $.ajax({
            url: "{{ route('paciente.store') }}",
            type: "POST",
            data: {
                representante_id: representante_id,
                genero_id: genero_id,
                fecha_nac: fecha_nac,
				nombre: nombre,
				apellido: apellido,
				estado_nacimiento_id: estado_nacimiento_id,
				municipio_nacimiento_id: municipio_nacimiento_id,
				parroquia_nacimiento_id: parroquia_nacimiento_id,
				lugar: lugar,
				nombre_mama: nombre_mama,
				apellido_mama: apellido_mama,
                ci_mama: ci_mama,
                fecha_nac_mama: fecha_nac_mama,
                grado_mama: grado_mama,
                telefono_mama: telefono_mama,
                email_mama: email_mama,
                nombre_papa: nombre_papa,
                apellido_papa: apellido_papa,
                ci_papa: ci_papa,
                fecha_nac_papa: fecha_nac_papa,
                grado_papa: grado_papa,
                telefono_papa: telefono_papa,
                email_papa: email_papa,
                estado_civil: estado_civil,
                custodia_niño: custodia_niño,
                estado_vive_id: estado_vive_id,
                municipio_vive_id: municipio_vive_id,
                parroquia_vive_id: parroquia_vive_id,
				sector: sector,
                _token: _token
            },
            success: function(response) {
                if (response.success) {
                    $('#registro-paciente')[0].reset();
                    toastr.success('El registro se ingresó correctamente', 'Nuevo registro', { timeOut: 5000 });
                    $('#tab-paciente').DataTable().ajax.reload();
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
        url: "/paciente/" + id, 
        type: 'DELETE',
        beforeSend: function(){
            $('#btnEliminar').text('Eliminando...');
        },
        success: function(data){
            $('#confirModal').modal('hide');
            toastr.warning('El registro se eliminó correctamente', 'Eliminar Registro', { timeOut: 5000 });
            $('#tab-paciente').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error al eliminar el registro:', error);
            toastr.error('No se pudo eliminar el registro', 'Error', { timeOut: 5000 });
        }
    });
});

</script>

<script>
function editpaciente(id) {
    $.get('/paciente/' + id + '/edit', function(especialista) {
        // Asignar los datos al modal
        $('#id').val(especialista.id);
        $('#nombre2').val(especialista.nombre);
        $('#apellido2').val(especialista.apellido);
        $('#ci2').val(especialista.ci);
        $('#fecha_nac').val(especialista.fecha_nac);
        $('#especialidad2').val(especialista.especialidad);
        $('#telefono2').val(especialista.telefono);
        $('#email2').val(especialista.email);
        $('#genero_id2').val(especialista.genero_id);
        
        // Asignar los datos de la dirección
		if (especialista.direccion) {
    $('#estado_id').val(especialista.direccion.estado_id);
    $('#municipio_id').val(especialista.direccion.municipio_id);
    $('#parroquia_id').val(especialista.direccion.parroquia_id);
    $('#sector2').val(especialista.direccion.sector);
}

        $("input[name=_token]").val();
        $('#editpaciente').modal('toggle'); // Mostrar el modal
});
}
</script>

@endsection
