/******/ (() => { // webpackBootstrap
/*!**********************************************!*\
  !*** ./resources/js/registroespecialista.js ***!
  \**********************************************/
$(document).ready(function () {
  $("#paso1").show();
  $("#siguiente1").click(function () {
    $("#paso1").hide();
    $("#paso2").show();
  });
  $("#regresar").click(function () {
    $("#paso2").hide();
    $("#paso1").show();
  });
  $("#registro-especialista").submit(function (event) {
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
      success: function success(response) {
        if (response.success) {
          $('#registro-especialista')[0].reset();
          toastr.success('El registro se ingresó correctamente', 'Nuevo registro', {
            timeOut: 5000
          });
          $('#tab-especialista').DataTable().ajax.reload();
          $("#paso1").show();
          $("#paso2").hide();
        }
      },
      error: function error(xhr) {
        console.error(xhr.responseText);
        toastr.error('Ocurrió un error al registrar el especialista', 'Error', {
          timeOut: 5000
        });
      }
    });
  });
});
/******/ })()
;