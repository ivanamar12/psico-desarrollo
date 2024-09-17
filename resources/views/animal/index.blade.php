<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/dt-2.1.4/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.1.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Laravel 8 con Ajax</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Animales</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mantenimiento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Propietarios</a>
          <a class="dropdown-item" href="#">Medicos</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Citas</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de animales</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Nuevo Animal</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h3>Lista Animales</h3>
            <table id="tab-animal" class="tabla table-hover">
                <thead>
                    <td>ID</td>
                    <td>NOMBRE</td>
                    <td>ANIMAL</td>
                    <td>GENERO</td>
                    <td>ACCIONES</td>
                </thead>

            </table>

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h3>Nuevo Animal</h3>

            <form id="registro-animal">
            @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre </label>
                    <input type="text" class="form-control" id="textNombre" name="textnombre" aria-describedby="emailHelp">
                    <small id="textnombre" class="form-text text-muted">Aqui igresar el nombre de su mascota</small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" id="selEspecie" name="selEspecie">
                    <option value="Gato">Gato</option>
                    <option value="Perro">Perro</option>
                    <option value="Ave">Ave</option>
                    <option value="Pez">Pez</option>
                    <option value="Otros">Otros</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Genero </label>
                
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="rbGenero" id="rbGeneroMacho" value="macho" checked>
                    <label class="form-check-label" for="rbGeneroMacho">Macho</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rbGenero" id="rbGeneroHembra" value="hembra">
                        <label class="form-check-label" for="rbGeneroHembra">Hembra</label>
                    </div>

                </div>
                <button type="submit" name="registrar" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>   

    <!-- modal editar -->
    <div class="modal fade" id="animalEditModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Actualizar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-animal-form">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="textId2" name="textId2">
                        <div class="form-group">
                            <label for="textNombre2">Nombre</label>
                            <input type="text" class="form-control" id="textNombre2" name="textnombre2" aria-describedby="emailHelp">
                            <small id="textnombre" class="form-text text-muted">Aquí ingresar el nombre de su mascota</small>
                        </div>
                        <div class="form-group">
                            <label for="selEspecie2">Especie</label>
                            <select class="form-control" id="selEspecie2" name="selEspecie2">
                                <option value="Gato">Gato</option>
                                <option value="Perro">Perro</option>
                                <option value="Ave">Ave</option>
                                <option value="Pez">Pez</option>
                                <option value="Otros">Otros</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Género</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rbGenero2" id="rbGeneroMacho" value="macho" checked>
                                <label class="form-check-label" for="rbGeneroMacho">Macho</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rbGenero2" id="rbGeneroHembra2" value="hembra">
                                <label class="form-check-label" for="rbGeneroHembra2">Hembra</label>
                            </div>
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

</div><!-- fin continer -->

<script>
$(document).ready(function(){
    var tablaAnimal = $('#tab-animal').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
            url: "{{ route('animal.index')}}",
        },
        columns:[
            {data: 'id'},
            {data: 'nombre'},
            {data: 'animal'},
            {data: 'genero'},
            {data: 'action', orderable: false}
        ]
    });
});


</script>

<script>
$(document).ready(function() {
    $('#registro-animal').submit(function(e) {
        e.preventDefault();
        var nombre = $('#textNombre').val();
        var especie = $('#selEspecie').val();
        var genero = $("input[name='rbGenero']:checked").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('animal.store') }}",
            type: "POST",
            data: {
                nombre: nombre,
                especie: especie,
                genero: genero,
                _token: _token
            },
            success: function(response) {
                if (response.success) {
                    $('#registro-animal')[0].reset();
                    toastr.success('El registro se ingresó correctamente', 'Nuevo registro', { timeOut: 5000 });
                    $('#tab-animal').DataTable().ajax.reload();
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                toastr.error('Ocurrió un error al registrar el animal', 'Error', { timeOut: 5000 });
            }
        });
    });
});
</script>

<script>
var id;
$(document).on('click', '.delete', function(){
    id = $(this).attr('id');
    $('#confirModal').modal('show');
});

$('#btnEliminar').click(function(){
    $.ajax({
        url: "animal/destroy/" + id,
        type: 'GET',
        beforeSend: function(){
            $('#btnEliminar').text('Eliminando...');
        },
        success: function(data){
            $('#confirModal').modal('hide');
            toastr.warning('El registro se eliminó correctamente', 'Eliminar Registro', { timeOut: 5000 });
            $('#tab-animal').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error al eliminar el registro:', error);
            toastr.error('No se pudo eliminar el registro', 'Error', { timeOut: 5000 });
        }
    });
});
</script>

<script>
function editAnimal(id) {
    $.get('/animal/edit/' + id, function(animal) {
        // Asignar los datos al modal
        $('#textId2').val(animal.id);
        $('#textNombre2').val(animal.nombre);
        $('#selEspecie2').val(animal.especie);
        $('#rbGenero2').val(animal.genero);
        $("input[name=_token]").val();
        $('#animalEditModal').modal('toggle'); // Mostrar el modal

    });
}
</script>

<script>
$('#edit-animal-form').submit(function(e) {
    e.preventDefault(); // Evita el envío normal del formulario

    var id2 = $('#textId2').val();
    var nombre2 = $('#textNombre2').val();
    var especie2 = $('#selEspecie2').val();
    var genero2 = $("input[name='rbGenero2']:checked").val();
    var _token2 = $("input[name=_token]").val();

    $.ajax({
        url: "{{ route('animal.update') }}",
        type: "POST",
        data: {
            id: id2,
            nombre: nombre2,
            especie: especie2,
            genero: genero2,
            _token: _token2
        },
        success: function(response) {
            if (response) {
                $('#animalEditModal').modal('hide');
                toastr.info('El registro se actualizó correctamente', 'Actualizar registro', { timeOut: 5000 });
                $('#tab-animal').DataTable().ajax.reload();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la actualización:', textStatus, errorThrown);
            alert('Ocurrió un error al actualizar el registro. Intenta nuevamente.');
        }
    });
});
</script>

</body>
</html>
