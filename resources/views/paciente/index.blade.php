@extends('layouts.root')

@section('title', 'Pacientes')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Pacientes" icon="zmdi zmdi-male-female zmdi-hc-fw" />

    <section class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list-paciente" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('registrar paciente'))
              <li><a href="#new-paciente" data-toggle="tab"> Nuevo</a></li>
            @endif
          </ul>
          <section id="myTabContent" class="tab-content">
            <section class="tab-pane fade active in" id="list-paciente">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-paciente">
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
            </section>

            <section class="tab-pane fade in" id="new-paciente">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-paciente">
                      @csrf
                      <!-- paso 1 -->
                      <section id="paso1">
                        <h3>Datos Personales</h3>
                        <div class="fila-formulario row">
                          <!-- Fila 1 -->
                          <div class="form-group col-md-6">
                            <label>Representante <span style="color: red;">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="representante_id" name="representante_id">
                              <option selected disabled>Seleccione el representante</option>
                            </select>
                            <small class="form-text text-muted">
                              Escriba el número de cédula, nombre o apellido del representante. Se mostrarán todos los
                              representantes disponibles.
                            </small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Nombre <span style="color: red;">*</span></label>
                            <input class="form-control" id="nombre" name="nombre" type="text" required
                              oninput="validarTexto(this)">
                            <small class="form-text text-muted">Ingrese el nombre Ej: Carlos.</small>
                          </div>

                          <!-- Fila 2 -->
                          <div class="form-group col-md-6">
                            <label>Apellido <span style="color: red;">*</span></label>
                            <input class="form-control" id="apellido" name="apellido" type="text" required
                              oninput="validarTexto(this)">
                            <small class="form-text text-muted">Ingrese el apellido Ej: Garcia.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Fecha de Nacimiento <span style="color: red;">*</span></label>
                            <input class="form-control" type="date" name="fecha_nac" id="fecha_nac" required>
                            <small class="form-text text-muted">Ingrese la fecha de nacimiento, máximo 6 años y medio,
                              mínimo 3 meses.</small>
                          </div>

                          <!-- Fila 3 -->
                          <div class="form-group col-md-6">
                            <label>Género <span style="color: red;">*</span></label>
                            <select class="form-control select2" required style="width: 100%;" id="genero_id"
                              name="genero_id">
                              <option selected disabled>Seleccione su género</option>
                              @foreach ($generos as $genero)
                                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                              @endforeach
                            </select>
                            <small class="form-text text-muted">Seleccione su genero.</small>
                          </div>
                        </div>

                        <p class="text-center mt-3">
                          <button type="button" id="siguiente1" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </p>
                      </section>
                      <!-- paso 2 -->
                      <section id="paso2">
                        <h3>Datos Familiares</h3>
                        <h4>Familiares que vivan en el hogar</h4>
                        <div id="miembrosContainer"></div>

                        <p class="text-center mt-3">
                          <button type="button" id="agregarFamiliar" class="btn btn-custom" style="color: white;">
                            Agregar Familiar
                          </button>
                          <button type="button" id="siguiente2" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </p>
                      </section>
                      <!-- paso 3 -->
                      <section id="paso3">
                        <h3>Datos Socioeconómicos</h3>
                        <div class="fila-formulario row">

                          <!-- Tipo de Vivienda -->
                          <div class="form-group  col-md-6">
                            <label>Tipo de Vivienda <span style="color:red">*</span></label>
                            <select name="tipo_vivienda" class="form-control" required>
                              <option value="" disabled selected>Seleccione un tipo</option>
                              <option value="casa_unifamiliar">Casa Unifamiliar</option>
                              <option value="apartamento">Apartamento</option>
                              <option value="vivienda_social">Vivienda Social</option>
                              <option value="vivienda_precaria">Vivienda Precaria</option>
                            </select>
                            <small class="form-text text-muted">Seleccione el tipo de vivienda que habita la
                              familia.</small>
                          </div>

                          <!-- Cantidad de Habitaciones -->
                          <div class="form-group  col-md-6">
                            <label>Cantidad de Habitaciones <span style="color:red">*</span></label>
                            <input class="form-control" type="number" id="cantidad_habitaciones"
                              name="cantidad_habitaciones" required min="0"
                              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            <small class="form-text text-muted">Ingrese solo números. Número total de habitaciones en la
                              vivienda.</small>
                          </div>

                          <!-- Cantidad de Personas -->
                          <div class="form-group col-md-6">
                            <label>Cantidad de Personas en la Vivienda <span style="color:red">*</span></label>
                            <input class="form-control" type="number" id="cantidad_personas" name="cantidad_personas"
                              required min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            <small class="form-text text-muted">Ingrese solo números. Total de personas que viven en la
                              vivienda.</small>
                          </div>

                          <!-- Servicios -->
                          <div class="form-group  col-md-6">
                            <label>¿Servicio de Agua Potable? <span style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_agua_potable" value="si" required>
                                Sí</label>
                              <label><input type="radio" name="servecio_agua_potable" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Indique si la vivienda cuenta con acceso a agua
                              potable.</small>
                          </div>

                          <div class="form-group  col-md-6">
                            <label>¿Servicio de Gas? <span style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_gas" value="si" required> Sí</label>
                              <label><input type="radio" name="servecio_gas" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si dispone de servicio de gas en la
                              vivienda.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>¿Servicio de Electricidad? <span style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_electricidad" value="si" required>
                                Sí</label>
                              <label><input type="radio" name="servecio_electricidad" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si cuenta con servicio eléctrico.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>¿Servicio de Drenaje? <span style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_drenaje" value="si" required> Sí</label>
                              <label><input type="radio" name="servecio_drenaje" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si tiene sistema de drenaje sanitario.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>¿Acceso a Servicios Públicos? <span style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="acceso_servcios_publicos" value="si" required>
                                Sí</label>
                              <label><input type="radio" name="acceso_servcios_publicos" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Indique si la vivienda está conectada a servicios
                              básicos.</small>
                          </div>

                          <!-- Internet -->
                          <div class="form-group col-md-6">
                            <label>¿Tiene servicio de Internet en casa? <span style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="disponibilidad_internet" value="si" required
                                  onclick="toggleInterInput()"> Sí</label>
                              <label><input type="radio" name="disponibilidad_internet" value="no"
                                  onclick="toggleInterInput()"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si tiene acceso a Internet en el
                              hogar.</small>
                          </div>

                          <div class="form-group col-md-6" id="tipo_conexion_internet" style="display: none;">
                            <label>Tipo de conexión de Internet</label>
                            <input class="form-control" name="tipo_conexion_internet" type="text"
                              placeholder="Especifique si aplica">
                            <small class="form-text text-muted">Ejemplo: Fibra óptica, datos móviles, ADSL, etc.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Fuente de Ingreso Familiar <span style="color:red">*</span></label>
                            <input class="form-control" id="fuente_ingreso_familiar" name="fuente_ingreso_familiar"
                              type="text" required>
                            <small class="form-text text-muted">Indique la principal fuente de ingreso económico del
                              hogar.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Observaciones (Opcional)</label>
                            <textarea class="form-control" name="observacion" rows="3"></textarea>
                            <small class="form-text text-muted">
                              Ingrese cualquier observación adicional sobre el paciente.
                            </small>
                          </div>
                        </div>

                        <p class="text-center mt-3">
                          <button type="button" id="regresar" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="submit" name="registrar" class="btn btn-custom" style="color: white;">
                            <i class="zmdi zmdi-floppy" style="color: white;"></i> Registrar
                          </button>
                        </p>
                      </section>
                    </form>
                  </div>
                </div>
              </div>
            </section>
          </section>
        </div>
      </div>
    </section>
  </section>

  <!-- modal mostrar paciente -->
  <section id="pacienteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Paciente</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><strong>Nombre y Apellido:</strong> <span id="nombre"></span></p>
          <p><strong>Fecha de Nacimiento:</strong> <span id="fecha_nac"></span></p>
          <p><strong>Genero:</strong> <span id="genero"></span></p>
          <p><strong>Representante:</strong> <span id="representante_nombre"></span></p>
          <p><strong>Cedula de Identidad:</strong> <span id="representante_ci"></span></p>
          <p><strong>Telefono:</strong> <span id="representante_telefono"></span></p>
          <p><strong>Correo Electronico:</strong> <span id="representante_email"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cerrar</button>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
  <script src="{{ asset('js/select2/es.js') }}"></script>
  <script src="{{ asset('js/app/validaciones.js') }}"></script>

  <script>
    $(document).ready(function() {
      const representantes = @json($representantes);

      const representantesData = representantes.map(representante => ({
        id: representante.id,
        text: `${representante.nombre} ${representante.apellido} (CI: ${representante.ci})`
      }));

      $('#representante_id').select2({
        placeholder: "Seleccione el representante",
        allowClear: true,
        data: representantesData,
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      var tablaPaciente = $('#tab-paciente').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('pacientes.index') }}",
        },
        columns: [{
            data: 'id'
          },
          {
            data: 'nombre'
          },
          {
            data: 'apellido'
          },
          {
            data: 'action',
            orderable: false
          }
        ]
      });

      $("#paso1").show();
      $("#paso2").hide();
      $("#paso3").hide();

      function establecerFechaMaximaFamiliares() {
        const fechaNacFamiliarInputs = document.querySelectorAll('input[type="date"][name*="[fecha_nac]"]');
        const fechaActual = new Date();
        fechaActual.setDate(fechaActual.getDate() - 1);
        const anio = fechaActual.getFullYear();
        const mes = String(fechaActual.getMonth() + 1).padStart(2, '0');
        const dia = String(fechaActual.getDate()).padStart(2, '0');
        const maxFecha = `${anio}-${mes}-${dia}`;

        fechaNacFamiliarInputs.forEach(input => {
          input.max = maxFecha;
        });
      }

      $("#siguiente1").click(function() {
        if ($("#representante_id").val() &&
          $("#nombre").val() &&
          $("#apellido").val() &&
          $("#fecha_nac").val() &&
          $("#genero_id").val()) {
          $("#paso1").hide();
          $("#paso2").show();
        } else {
          toastr.error("Por favor, complete todos los campos requeridos en este paso.");
        }
      });

      let contadorFamiliares = 1;

      $("#agregarFamiliar").click(function() {
        const nuevoFormulario = `
          <div class="fila-formulario row" id="formulario-familiar-${contadorFamiliares}">
            <div class="form-group col-md-6">
              <label>Nombre <span style="color: red;">*</span></label>
              <input class="form-control" name="familiares[${contadorFamiliares}][nombre]" type="text" required maxlength="50" oninput="validarTexto(this)">
              <small class="form-text text-muted">Ingrese el nombre del familiar.</small>
            </div>

            <div class="form-group col-md-6">
              <label>Apellido <span style="color: red;">*</span></label>
              <input class="form-control" name="familiares[${contadorFamiliares}][apellido]" type="text" required maxlength="50" oninput="validarTexto(this)">
              <small class="form-text text-muted">Ingrese el apellido del familiar.</small>
            </div>

            <div class="form-group col-md-6">
              <label>Fecha de Nacimiento <span style="color: red;">*</span></label>
              <input class="form-control" type="date" name="familiares[${contadorFamiliares}][fecha_nac]" required>
              <small class="form-text text-muted">Ingrese la fecha de nacimiento.</small>
            </div>

            <div class="form-group col-md-6">
              <label>Parentesco <span style="color: red;">*</span></label>
              <input class="form-control" name="familiares[${contadorFamiliares}][parentesco]" type="text" required maxlength="50" oninput="validarTexto(this)">
              <small class="form-text text-muted">Ejemplo: madre, padre, hermano(a), etc.</small>
            </div>

            <div class="form-group col-md-6">
              <label>Género <span style="color: red;">*</span></label>
              <select class="form-control select2" required style="width: 100%;" name="familiares[${contadorFamiliares}][genero_id]">
                <option selected disabled>Seleccione su género</option>
                @foreach ($generos as $genero)
                  <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                @endforeach
              </select>
              <small class="form-text text-muted">Seleccione el género del familiar.</small>
            </div>

            <div class="form-group col-md-6">
              <h5>¿Tiene alguna discapacidad? <span style="color: red;">*</span></h5>
              <div>
                <label><input type="radio" name="familiares[${contadorFamiliares}][discapacidad]" value="si" required onclick="toggleTipoDiscapacidad(${contadorFamiliares})"> Sí</label>
                <label><input type="radio" name="familiares[${contadorFamiliares}][discapacidad]" value="no" onclick="toggleTipoDiscapacidad(${contadorFamiliares})"> No</label>
              </div>
              <small class="form-text text-muted">Indique si tiene alguna discapacidad.</small>
            </div>

            <div class="form-group col-md-6" id="tipo-discapacidad-container-${contadorFamiliares}" style="display: none;">
              <label>Tipo de discapacidad</label>
              <input class="form-control" id="tipo-discapacidad-${contadorFamiliares}" name="familiares[${contadorFamiliares}][tipo_discapacidad]" type="text" placeholder="Describa el tipo de discapacidad">
              <small class="form-text text-muted">Describa la discapacidad si aplica.</small>
            </div>

            <div class="form-group col-md-6">
              <h5>¿Tiene alguna enfermedad crónica? <span style="color: red;">*</span></h5>
              <div>
                <label><input type="radio" name="familiares[${contadorFamiliares}][enfermedad_cronica]" value="si" required onclick="toggleTipoEnfermedad(${contadorFamiliares})"> Sí</label>
                <label><input type="radio" name="familiares[${contadorFamiliares}][enfermedad_cronica]" value="no" onclick="toggleTipoEnfermedad(${contadorFamiliares})"> No</label>
              </div>
              <small class="form-text text-muted">Indique si tiene alguna enfermedad crónica.</small>
            </div>

            <div class="form-group col-md-6" id="tipo-enfermedad-container-${contadorFamiliares}" style="display: none;">
              <label>Tipo de enfermedad</label>
              <input class="form-control" id="tipo-enfermedad-${contadorFamiliares}" name="familiares[${contadorFamiliares}][tipo_enfermedad]" type="text" placeholder="Describa el tipo de Enfermedad">
              <small class="form-text text-muted">Describa la enfermedad si aplica.</small>
            </div>

            <div class="col-md-12 text-right">
              <button type="button" class="btn btn-danger" onclick="eliminarMiembro(${contadorFamiliares})">
                <i class="zmdi zmdi-delete"></i> Eliminar
              </button>
            </div>
          </div>
        `;

        $("#miembrosContainer").append(nuevoFormulario);

        // Inicializar Select2 para el nuevo select
        $(`select[name="familiares[${contadorFamiliares}][genero_id]"]`).select2();

        // Establecer el rango de fechas para el nuevo campo
        establecerFechaMaximaFamiliares();

        contadorFamiliares++;
      });

      // Función para eliminar un familiar
      window.eliminarMiembro = function(id) {
        $(`#formulario-familiar-${id}`).remove();
      };

      $("#siguiente2").click(function() {
        $("#paso2").hide();
        $("#paso3").show();
      });

      $("#regresar").click(function() {
        $("#paso3").hide();
        $("#paso2").show();
      });

      $("#registro-paciente").on("submit", function(event) {
        event.preventDefault();

        $.ajax({
          url: "{{ route('pacientes.store') }}",
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
            if (response.success) {
              $("#registro-paciente")[0].reset();

              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });

              tablaPaciente.ajax.reload();

              $("#paso3").hide();
              $("#paso1").show();

              $('.nav-tabs a[href="#list-paciente"]').tab('show');
            }
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
              toastr.error('Ocurrió un error al guardar el paciente.', 'Error');
            }
          }
        });
      });

      $(document).on('click', 'input[name^="enfermedad_cronica_"]', function() {
        const index = $(this).attr('name').split('_')[2];
        toggleTipoEnfermedad(index);
      });

      establecerFechaMaximaFamiliares();
    });

    // Funciones para mostrar/ocultar campos condicionales
    window.toggleTipoDiscapacidad = function(index) {
      const discapacidadSi = $(`input[name="familiares[${index}][discapacidad]"][value="si"]`).is(':checked');
      if (discapacidadSi) {
        $(`#tipo-discapacidad-container-${index}`).show();
        $(`#tipo-discapacidad-${index}`).prop('required', true);
      } else {
        $(`#tipo-discapacidad-container-${index}`).hide();
        $(`#tipo-discapacidad-${index}`).prop('required', false);
        $(`#tipo-discapacidad-${index}`).val('');
      }
    };

    window.toggleTipoEnfermedad = function(index) {
      const enfermedadSi = $(`input[name="familiares[${index}][enfermedad_cronica]"][value="si"]`).is(':checked');
      if (enfermedadSi) {
        $(`#tipo-enfermedad-container-${index}`).show();
        $(`#tipo-enfermedad-${index}`).prop('required', true);
      } else {
        $(`#tipo-enfermedad-container-${index}`).hide();
        $(`#tipo-enfermedad-${index}`).prop('required', false);
        $(`#tipo-enfermedad-${index}`).val('');
      }
    };

    function toggleInterInput() {
      const disponibilidad_internetYes = document.querySelector(`input[name="disponibilidad_internet"][value="si"]`);
      const tipo_conexionContainer = document.getElementById('tipo_conexion_internet');
      const tipo_conexionInput = document.querySelector('#tipo_conexion_internet input')

      if (disponibilidad_internetYes.checked) {
        tipo_conexionContainer.style.display = 'block';
        tipo_conexionInput.value = '';
      } else {
        tipo_conexionContainer.style.display = 'none';
        tipo_conexionInput.value = 'no';
      }
    }
  </script>

  <script>
    function establecerRangoFechas() {
      const fechaNacInputs = document.querySelectorAll('input[name="fecha_nac"]');
      const fechaActual = new Date();

      const fechaMinima = new Date(fechaActual);
      fechaMinima.setMonth(fechaMinima.getMonth() - 78);

      const fechaMaxima = new Date(fechaActual);
      fechaMaxima.setMonth(fechaMaxima.getMonth() - 3);

      const formatoFecha = (fecha) => {
        const anio = fecha.getFullYear();
        const mes = String(fecha.getMonth() + 1).padStart(2, '0');
        const dia = String(fecha.getDate()).padStart(2, '0');
        return `${anio}-${mes}-${dia}`;
      };

      fechaNacInputs.forEach(input => {
        input.min = formatoFecha(fechaMinima);
        input.max = formatoFecha(fechaMaxima);
      });
    }

    document.addEventListener('DOMContentLoaded', establecerRangoFechas);
  </script>

  <script>
    $(document).on('click', '.ver-paciente', function() {
      let pacienteId = $(this).data('id');

      $.ajax({
        url: '/pacientes/' + pacienteId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          let nombreApellido = data.nombre + " " + data.apellido;
          let fechaNacimiento = data.fecha_nac;
          let genero = data.genero ? data.genero.genero : "No disponible";

          let representanteNombre = data.representante ? data.representante.nombre + " " + data.representante
            .apellido : "No disponible";
          let representanteCedula = data.representante ? data.representante.ci : "No disponible";
          let representanteTelefono = data.representante ? data.representante.telefono : "No disponible";
          let representanteEmail = data.representante ? data.representante.email : "No disponible";

          $('#pacienteModal #nombre').text(nombreApellido);
          $('#pacienteModal #fecha_nac').text(fechaNacimiento);
          $('#pacienteModal #genero').text(genero);
          $('#pacienteModal #representante_nombre').text(representanteNombre);
          $('#pacienteModal #representante_ci').text(representanteCedula);
          $('#pacienteModal #representante_telefono').text(representanteTelefono);
          $('#pacienteModal #representante_email').text(representanteEmail);

          $('#pacienteModal').modal('show');
        },
        error: function(xhr, status, error) {
          alert("Hubo un problema al obtener la información del paciente.");
        }
      });
    });
  </script>
  <script>
    document.getElementById('cantidad_habitaciones').addEventListener('keypress', function(e) {
      if (e.key < '0' || e.key > '9') e.preventDefault();
    });
    document.getElementById('cantidad_personas').addEventListener('keypress', function(e) {
      if (e.key < '0' || e.key > '9') e.preventDefault();
    });
  </script>
@endsection
