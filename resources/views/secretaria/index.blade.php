@extends('layouts.app')

@section('title', 'Secretarias')

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
			  <h1 class="text-titles"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i>Secratarias</h1>
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
									<table class="table table-hover text-center" id="tab-secretaria">
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
												<form id="registro-secretaria">
												@csrf
												<div class="form-row">
													<div class="form-group label-floating col-md-6">
														<label class="control-label">Nombre</label>
														<input class="form-control" id="nombre" name="nombre" type="text">
													</div>
													<div class="form-group label-floating col-md-6">
														<label class="control-label">Apellido</label>
														<input class="form-control" id="apellido" name="apellido" type="text">
													</div>
													<div class="form-group label-floating col-md-6">
														<label class="control-label">CI</label>
														<input class="form-control" id="ci" name="ci" type="number" onchange="if(parseInt($(this).val()) < parseInt($('#stock_min').val())){alert('Error, el maximo no puede ser menor al minimo'); $(this).val('');}" onkeypress="var w = event.which == undefined? event.which : event.keyCode; return w>=48 && w <=57 && this.value.length<=7;">
													</div>
													<div class="form-group label-floating col-md-6">
														<label class="control-label">Fecha de Nacimiento</label>
														<input class="form-control" type="date" name="fecha_nac" id="fecha_nac">
													</div>
													<div class="form-group label-floating col-md-6">
														<label class="control-label">Grado</label>
														<input class="form-control" id="grado" name="grado" type="text">
													</div>
													<div class="form-group label-floating col-md-6">
														<label class="control-label">Telefono</label>
														<input class="form-control" type="number" id="telefono" name="telefono" onchange="if(parseInt($(this).val()) < parseInt($('#stock_min').val())){alert('Error, el maximo no puede ser menor al minimo'); $(this).val('');}" onkeypress="var w = event.which == undefined? event.which : event.keyCode; return w>=48 && w <=57 && this.value.length<=10;">
													</div>
													<div class="form-group label-floating col-md-6">
														<label class="control-label">Correo electronico</label>
														<input class="form-control" type="text" id="email" name="email">
													</div>
													<div class="form-group col-md-6">
														<label class="control-label">Genero</label>
														<select class="form-control select2" required style="width: 100%;" id="genero_id">
															<option selected>Seleccione su género</option>
															@foreach ($generos as $genero)
															<option value="{{ $genero->id }}">{{ $genero->genero }}</option>
															@endforeach
														</select>
													</div>
													<div class="form-group col-md-6">
														<label class="control-label">Estado</label>
														<select class="form-control form-control-solid select2" required style="width: 100%;" id="estado_id">
															<option selected>Seleccione su estado</option>
															@foreach ($estados as $estado)
															<option value="{{ $estado->id }}">{{ $estado->estado }}</option>
															@endforeach
														</select>
													</div>
													<div class="form-group col-md-6">
														<label class="control-label">Municipio</label>
														<select class="form-control form-control-solid select2" required style="width: 100%;" id="municipio_id">
															<option selected>Seleccione su municipio</option>
															@foreach ($municipios as $municipio)
															<option value="{{ $municipio->id }}">{{ $municipio->municipio }}</option>
															@endforeach
														</select>
													</div>
													<div class="form-group col-md-6">
														<label class="control-label">Parroquia</label>
														<select class="form-control form-control-solid select2" required style="width: 100%;" id="parroquia_id">
															<option selected>Seleccione su parroquia</option>
															@foreach ($parroquias as $parroquia)
															<option value="{{ $parroquia->id }}">{{ $parroquia->parroquia }}</option>
															@endforeach
														</select>
													</div>
													<div class="form-group col-md-6">
														<label class="control-label">Sector</label>
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
		 <!-- modal editar -->
		<div class="modal fade" id="secretariaEditModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Actualizar Secretaria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-secretaria-form">
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
														<input class="form-control" type="date" name="fecha_nac" id="fecha_nac">
													</div>
													<div class="form-group label-floating">
														<label class="control-label">Especialidad</label>
														<input class="form-control" id="grado2" name="grado2" type="text">
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
<!-- Modal show -->
<div class="modal fade" id="especialistaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Especialista</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="col-lg-4 col-12">
    <h6>Nombre y Apellido</h6>
				<h4 id="nombre"></h4>
			</div>
			<div class="col-lg-4 col-12">
				<h6>Cédula de Identidad</h6>
				<h4 id="ci"></h4>
			</div>
			<div class="col-lg-4 col-12">
				<h6>Fecha de Nacimiento</h6>
				<h4 id="fecha_nac"></h4>
			</div>
			<div class="col-lg-4 col-12">
				<h6>Especialidad</h6>
				<h4 id="especialidad"></h4>
			</div>
			<div class="col-lg-4 col-12">
				<h6>Teléfono</h6>
				<h4 id="telefono"></h4>
			</div>
			<div class="col-lg-4 col-12">
				<h6>Email</h6>
				<h4 id="email"></h4>
			</div>
			<div class="col-lg-4 col-12">
				<h6>Género</h6>
				<h4 id="genero"></h4>
			</div>
			<div class="col-lg-4 col-12">
				<h6>Estado</h6>
				<h4 id="estado"></h4>
			</div>
			<div class="col-lg-4 col-12">
				<h6>Municipio</h6>
				<h4 id="municipio"></h4>
			</div>
			<div class="col-lg-4 col-12">
				<h6>Parroquia</h6>
				<h4 id="parroquia"></h4>
			</div>
			<div class="col-lg-4 col-12">
				<h6>Sector</h6>
				<h4 id="sector"></h4>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
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
</script>
<script>
$(document).ready(function(){
    var tablaSecretaria = $('#tab-secretaria').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
            url: "{{ route('secretaria.index')}}",
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
    $('#registro-secretaria').submit(function(e) {
        e.preventDefault();
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
		var ci = $('#ci').val();
		var fecha_nac = $('#fecha_nac').val();
		var grado = $('#grado').val();
		var telefono = $('#telefono').val();
		var email = $('#email').val();
		var genero_id = $('#genero_id').val();
		var estado_id = $('#estado_id').val();
		var municipio_id = $('#municipio_id').val();
		var parroquia_id = $('#parroquia_id').val();
		var sector = $('#sector').val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('secretaria.store') }}",
            type: "POST",
            data: {
                nombre: nombre,
                apellido: apellido,
                ci: ci,
				fecha_nac: fecha_nac,
				grado: grado,
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
                    $('#registro-secretaria')[0].reset();
                    toastr.success('El registro se ingresó correctamente', 'Nuevo registro', { timeOut: 5000 });
                    $('#tab-secretaria').DataTable().ajax.reload();
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                toastr.error('Ocurrió un error al registrar el secretaria', 'Error', { timeOut: 5000 });
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
        url: "/secretaria/" + id, 
        type: 'DELETE',
        beforeSend: function(){
            $('#btnEliminar').text('Eliminando...');
        },
        success: function(data){
            $('#confirModal').modal('hide');
            toastr.warning('El registro se eliminó correctamente', 'Eliminar Registro', { timeOut: 5000 });
            $('#tab-secretaria').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error al eliminar el registro:', error);
            toastr.error('No se pudo eliminar el registro', 'Error', { timeOut: 5000 });
        }
    });
});
</script>
<script>
function editsecretaria(id) {
    $.get('/secretaria/' + id + '/edit', function(secretaria) {
        // Asignar los datos al modal
        $('#id').val(secretaria.id);
        $('#nombre2').val(secretaria.nombre);
        $('#apellido2').val(secretaria.apellido);
        $('#ci2').val(secretaria.ci);
        $('#fecha_nac').val(secretaria.fecha_nac);
        $('#grado2').val(secretaria.grado);
        $('#telefono2').val(secretaria.telefono);
        $('#email2').val(secretaria.email);
        $('#genero_id2').val(secretaria.genero_id);
        
        // Asignar los datos de la dirección
		if (secretaria.direccion) {
    $('#estado_id').val(secretaria.direccion.estado_id);
    $('#municipio_id').val(secretaria.direccion.municipio_id);
    $('#parroquia_id').val(secretaria.direccion.parroquia_id);
    $('#sector2').val(secretaria.direccion.sector);
}


        $("input[name=_token]").val();
        $('#secretariaEditModal').modal('toggle'); // Mostrar el modal
    });
}
</script>

<script>
$('#edit-secretaria-form').submit(function(e) {
    e.preventDefault(); // Evita el envío normal del formulario

    var id = $('#id').val(); // Usa el ID correcto
    var nombre2 = $('#nombre2').val();
    var apellido2 = $('#apellido2').val();
    var ci2 = $('#ci2').val();
    var fecha_nac = $('#fecha_nac').val();
    var grado2 = $('#grado2').val();
    var telefono2 = $('#telefono2').val();
    var email2 = $('#email2').val();
    var genero_id2 = $('#genero_id2').val();
    var estado_id = $('#estado_id').val();
    var municipio_id = $('#municipio_id').val();
    var parroquia_id = $('#parroquia_id').val();
    var sector2 = $('#sector2').val();
    var _token2 = $("input[name=_token]").val();

    console.log({
        id: id,
        nombre: nombre2,
        apellido: apellido2,
        ci: ci2,
        fecha_nac: fecha_nac,
        grado: grado2,
        telefono: telefono2,
        email: email2,
        genero_id: genero_id2,
        estado_id: estado_id,
        municipio_id: municipio_id,
        parroquia_id: parroquia_id,
        sector: sector2
    });

    $.ajax({
        url: "/secretaria/" + id,
        type: "PUT",
        data: {
            id: id,
            nombre: nombre2,
            apellido: apellido2,
            ci: ci2,
            fecha_nac: fecha_nac,
            grado: grado2,
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
                $('#secretariaEditModal').modal('hide');
                toastr.info('El registro se actualizó correctamente', 'Actualizar registro', { timeOut: 5000 });
                $('#tab-secretaria').DataTable().ajax.reload();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la actualización:', textStatus, errorThrown);
            alert('Ocurrió un error al actualizar el registro. Intenta nuevamente.');
        }
    });
});
</script>
@endsection