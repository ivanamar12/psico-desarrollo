@extends('layouts.root')

@section('title', 'Citas')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Citas" icon="zmdi zmdi-calendar zmdi-hc-fw" />

    <section class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#calendario" data-toggle="tab">Calendario</a></li>
            <li class=""><a href="#citas-dia" data-toggle="tab">Lista de citas del dia</a></li>
            <li class=""><a href="#citas-todas" data-toggle="tab">Lista</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="calendario">
              <div id='calendar'></div>
            </div>
            <div class="tab-pane fade in" id="citas-dia">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-citas_hoy">
                  <thead>
                    <!-- Citas del día -->
                    <div class="data-table-header">
                      @if (auth()->user()->hasRole(App\Enums\Role::ADMIN->value) || auth()->user()->hasRole(App\Enums\Role::SECRETARIA->value))
                        <button onclick="window.open('{{ route('citas.report.today') }}', '_blank');"
                          class="btn btn-custom"
                          @if ($citasHoyCount == 0) disabled title="No hay citas para hoy" @endif>
                          <i class="zmdi zmdi-file-text"></i> PDF Todas las Citas del día
                        </button>
                      @elseif(auth()->user()->hasRole(App\Enums\Role::ESPECIALISTA->value))
                        <button onclick="window.open('{{ route('citas.report.today.specialist') }}', '_blank');"
                          class="btn btn-custom"
                          @if ($citasHoyCount == 0) disabled title="No hay citas para hoy" @endif>
                          <i class="zmdi zmdi-file-text"></i> PDF Mis Citas del día
                        </button>
                      @endif

                      @if ($citasHoyCount == 0)
                        <p class="text-muted">No hay citas para hoy</p>
                      @endif
                    </div>

                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Fecha</th>
                      <th style="text-align: center">Hora</th>
                      <th style="text-align: center">Especialista</th>
                      <th style="text-align: center">Paciente</th>
                      <th style="text-align: center">Asistencia</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

            <div class="tab-pane fade  in" id="citas-todas">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-citas">
                  <thead>
                    <!-- Todas las citas -->
                    <div class="data-table-header">
                      @if (auth()->user()->hasRole(App\Enums\Role::ADMIN->value) || auth()->user()->hasRole(App\Enums\Role::SECRETARIA->value))
                        <button onclick="window.open('{{ route('citas.report.all') }}', '_blank');" class="btn btn-custom"
                          @if ($citasCount == 0) disabled title="No hay citas registradas" @endif>
                          <i class="zmdi zmdi-file-text"></i> PDF Todas las Citas
                        </button>
                      @elseif(auth()->user()->hasRole(App\Enums\Role::ESPECIALISTA->value))
                        <button onclick="window.open('{{ route('citas.report.all.specialist') }}', '_blank');"
                          class="btn btn-custom"
                          @if ($citasCount == 0) disabled title="No hay citas registradas" @endif>
                          <i class="zmdi zmdi-file-text"></i> PDF Mis Citas
                        </button>
                      @endif

                      @if ($citasCount == 0)
                        <p class="text-muted">No hay citas registradas</p>
                      @endif
                    </div>

                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Fecha</th>
                      <th style="text-align: center">Hora</th>
                      <th style="text-align: center">Especialista</th>
                      <th style="text-align: center">Paciente</th>
                      <th style="text-align: center">Asistencia</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>

  <!-- modal para agendar la cita -->
  @if (auth()->user()->can('crear citas'))
    <section class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div style="width: 100%; display: flex; justify-content: end">
              <button type="button" class="no-shadow-on-click" data-dismiss="modal"
                style="color: black; background: #aeadad; border: none; border-radius: 20%; width: 22px; height: 22px; padding: 0;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <h3 class="modal-title w-100 text-center" style="color: white; margin-bottom: 12px;">
              Agendar Cita
            </h3>
          </div>

          <div class="modal-body">
            <form id="eventForm">

              <!-- Paciente -->
              <div class="form-group">
                <label>Paciente <span class="text-danger">*</span></label>
                <select class="form-control form-control-solid select2" required style="width: 100%;" id="paciente_id"
                  name="paciente_id">
                  <option selected disabled>Seleccione el paciente</option>
                  @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id }}">
                      {{ "P: {$paciente->nombre} {$paciente->apellido}" }} |
                      {{ "R: {$paciente->representante->nombre} {$paciente->representante->apellido} {$paciente->representante->ci}" }}
                    </option>
                  @endforeach
                </select>
                <small class="form-text text-muted">Busque al paciente por su nombre.</small>
              </div>

              <!-- Especialista -->
              <div class="form-group">
                <label>Especialista <span class="text-danger">*</span></label>
                <select class="form-control form-control-solid select2" required style="width: 100%;"
                  id="especialista_id" name="especialista_id">
                  <option selected disabled>Seleccione el especialista</option>
                  @foreach ($especialistas as $especialista)
                    <option value="{{ $especialista->id }}">{{ $especialista->nombre }} {{ $especialista->apellido }}
                    </option>
                  @endforeach
                </select>
                <small class="form-text text-muted">Busque al especialista por su nombre.</small>
              </div>

              <!-- Hora -->
              <div class="form-group">
                <label for="hora">Hora <span class="text-danger">*</span></label>
                <input type="time" class="form-control" id="hora" name="hora" required
                  onchange="validateHour()">
                <small class="form-text text-muted">
                  El horario disponible es de <strong>7:30 a.m. a 11:00 p.m.</strong> y de <strong>1:00 p.m. a 3:00
                    p.m.</strong>
                </small>
              </div>

            </form>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-regresar" data-dismiss="modal" style="color: white;">Cerrar</button>
            <button type="button" class="btn btn-custom" id="saveEvent" style="color: white;">Agendar Cita</button>
          </div>

        </div>
      </div>
    </section>
  @endif

  <!-- Modal para editar el estado de la cita -->
  @if (auth()->user()->can('cambiar estado citas'))
    <section class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div style="width: 100%; display: flex; justify-content: end">
              <button type="button" class="no-shadow-on-click" data-dismiss="modal"
                style="color: black; background: #aeadad; border: none; border-radius: 20%; width: 22px; height: 22px; padding: 0;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <h3 class="modal-title w-100 text-center" style="color: white; margin-bottom: 12px;">
              Descripción del estado de la cita
            </h3>
          </div>

          <div class="modal-body">
            <p>Selecciona el estado de la cita:</p>
            <div class="form-check">
              <input type="radio" class="form-check-input" name="status" id="confirmRadio" value="confirmada">
              <label class="form-check-label" for="confirmRadio">Confirmar Cita</label>
            </div>
            <div class="form-check">
              <input type="radio" class="form-check-input" name="status" id="cancelRadio" value="cancelada">
              <label class="form-check-label" for="cancelRadio">Cancelar Cita</label>
            </div>
            <div class="form-check">
              <input type="radio" class="form-check-input" name="status" id="asistioRadio" value="asistio">
              <label class="form-check-label" for="asistioRadio">Asistió</label>
            </div>
            <div class="form-check">
              <input type="radio" class="form-check-input" name="status" id="noAsistioRadio" value="no asistio">
              <label class="form-check-label" for="noAsistioRadio">No Asistió</label>
            </div>
            <p class="text-danger" id="errorMessage" style="display:none;"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-regresar" data-dismiss="modal" style="color: white;">Cerrar</button>
            <button id="saveStatusButton" class="btn btn-custom" style="color: white;">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </section>
  @endif

@endsection

@section('js')
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
  <script src="{{ asset('js/select2/es.js') }}"></script>

  <script src="{{ asset('js/moment/moment.min.js') }}"></script>
  <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('js/fullcalendar/es.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#paciente_id').select2({
        dropdownParent: $('#eventModal')
      });
      $('#especialista_id').select2({
        dropdownParent: $('#eventModal')
      });

      var tablaCitasHoy = $('#tab-citas_hoy').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('citas.index') }}",
          data: {
            currentDate: "{{ date('Y-m-d') }}"
          }
        },
        columns: [{
            data: 'id'
          },
          {
            data: 'fecha_consulta'
          },
          {
            data: 'hora'
          },
          {
            data: 'especialista',
            name: 'especialista'
          },
          {
            data: 'paciente',
            name: 'paciente'
          },
          {
            data: 'status'
          },
          {
            data: 'action',
            orderable: false
          }
        ]
      });

      var tablaCitas = $('#tab-citas').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('citas.index') }}"
        },
        columns: [{
            data: 'id'
          },
          {
            data: 'fecha_consulta'
          },
          {
            data: 'hora'
          },
          {
            data: 'especialista',
            name: 'especialista'
          },
          {
            data: 'paciente',
            name: 'paciente'
          },
          {
            data: 'status'
          },
          {
            data: 'action',
            orderable: false
          }
        ]
      });
    });
  </script>

  <script>
    function validateHour() {
      const hourInput = document.getElementById('hora');
      const selectedHour = hourInput.value.split(':').map(Number);
      const submitButton = document.getElementById('saveEvent');

      if ((selectedHour[0] >= 7 && selectedHour[0] < 11) || (selectedHour[0] >= 13 && selectedHour[0] < 15)) {
        hourInput.setCustomValidity('');
        submitButton.disabled = false;
      } else {
        hourInput.setCustomValidity(
          'Por favor, selecciona una hora entre las 7:00 AM y las 11:00 AM, o entre la 1:00 PM y las 3:00 PM.');
        submitButton.disabled = true;
      }
    }

    $(document).ready(function() {
      $('#calendar').fullCalendar({
        lang: 'es',
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        selectHelper: true,
        hiddenDays: [0, 6],
        events: function(start, end, timezone, callback) {
          loadEvents(callback);
        },

        dayRender: function(date, cell) {
          const today = moment().startOf('day');
          if (date.isBefore(today)) {
            cell.addClass('fc-past');
          }
        },

        select: function(start, end) {
          const today = moment().startOf('day');
          if (start.isBefore(today)) {
            toastr.warning('No se pueden seleccionar fechas pasadas.');
            $('#calendar').fullCalendar('unselect');
            return;
          }

          $('#eventModal').modal('show');

          $('#saveEvent').off('click').on('click', function() {
            validateHour(); // validar el rango horario (7:30–12 y 13–16)

            if (document.getElementById('hora').validity.valid) {
              const fecha = start.format('YYYY-MM-DD');
              const hora = $('#hora').val();
              const pacienteId = $('#paciente_id').val();
              const especialistaId = $('#especialista_id').val();
              const nuevaHora = moment(`${fecha} ${hora}`, 'YYYY-MM-DD HH:mm');

              const citasDelDia = $('#calendar').fullCalendar('clientEvents', function(event) {
                return event.start.format('YYYY-MM-DD') === fecha;
              });

              // ✅ Validar que el paciente no tenga otra cita el mismo día
              const pacienteTieneCita = citasDelDia.some(event => {
                if (!event.extendedProps || !event.extendedProps.paciente_id) {
                  return false;
                }
                return event.extendedProps.paciente_id == pacienteId;
              });

              if (pacienteTieneCita) {
                toastr.warning('Este paciente ya tiene una cita registrada para este día.');
                $('#calendar').fullCalendar('unselect');
                return;
              }

              // ✅ Obtener todas las citas del especialista ese día
              const citasEspecialista = citasDelDia.filter(event =>
                event.extendedProps && event.extendedProps.especialista_id == especialistaId
              );

              // ✅ Verificar si ya tiene 3 citas
              if (citasEspecialista.length >= 3) {
                toastr.warning('Este especialista ya tiene 3 citas para este día.');
                $('#calendar').fullCalendar('unselect');
                return;
              }

              // ✅ Verificar si hay una cita a la misma hora o muy cercana (menos de 90 minutos)
              const conflictoHora = citasEspecialista.some(event => {
                const eventHora = moment(event.start);
                const diferencia = Math.abs(nuevaHora.diff(eventHora, 'minutes'));

                const mismaHora = nuevaHora.format('HH:mm') === eventHora.format('HH:mm');
                return mismaHora || diferencia < 90;
              });

              if (conflictoHora) {
                toastr.warning(
                  'Este especialista ya tiene una cita en esta hora o muy cercana. Deben pasar al menos 1h30 entre sus citas.'
                );
                $('#calendar').fullCalendar('unselect');
                return;
              }

              // ✅ Si pasa todas las validaciones, enviar al servidor
              const formData = {
                paciente_id: pacienteId,
                especialista_id: especialistaId,
                fecha: fecha,
                hora: hora,
                _token: '{{ csrf_token() }}'
              };

              $.ajax({
                url: "{{ route('citas.store') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                  toastr.success(response.message);
                  $('#eventModal').modal('hide');
                  $('#eventForm')[0].reset();
                  reloadEvents();
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
                    toastr.error('Error al crear la cita');
                  }
                }
              });
            }
          });
        },

        eventClick: function(event) {
          $('#statusModal').modal('show');
          $('#statusModal .modal-body').find('p').remove();

          $.ajax({
            url: '/citas/' + event.id + '/edit',
            type: 'GET',
            success: function(data) {
              $('#statusModal .modal-body').prepend(`
                <p><strong>Fecha y Hora:</strong> ${event.start.format('DD/MM/YYYY')} ${data.hora}</p>
                <p><strong>Representante:</strong> ${data.representante_nombre}</p>
                <p><strong>Paciente:</strong> ${data.paciente_nombre}</p>
                <p><strong>Especialista:</strong> ${data.especialista_nombre}</p>
            `);

              // Reset radios y mostrar todos inicialmente
              $('#confirmRadio, #cancelRadio, #asistioRadio, #noAsistioRadio').prop('checked', false);
              $('.form-check').show();
              $('#errorMessage').hide();

              const ahora = moment();
              const fechaHoraCita = moment(event.start);
              const citaYaPaso = fechaHoraCita.isBefore(ahora);

              // Mostrar/ocultar opciones según estado y tiempo
              if (data.status === 'confirmada') {
                $('#confirmRadio, #cancelRadio').closest('.form-check').hide();
                if (!citaYaPaso) {
                  $('#asistioRadio').closest('.form-check').hide();
                  $('#statusModal .modal-body').append(
                    '<p class="text-info"><small>La opción "Asistió" estará disponible después de la fecha y hora de la cita.</small></p>'
                  );
                }
                $('#saveStatusButton').show();
              } else if (data.status === 'pendiente') {
                $('#asistioRadio, #noAsistioRadio').closest('.form-check').hide();
                if (!citaYaPaso) {
                  $('#statusModal .modal-body').append(
                    '<p class="text-info"><small>La opción "Asistió" estará disponible después de la fecha y hora de la cita.</small></p>'
                  );
                }
                $('#saveStatusButton').show();
              } else {
                $('.form-check').hide();
                $('#statusModal .modal-body').append(`<p><strong>Estado:</strong> ${data.status}</p>`);
                $('#saveStatusButton').hide();
              }

              $('#saveStatusButton').off('click').on('click', function() {
                let status = null;
                if ($('#confirmRadio').is(':checked')) status = 'confirmada';
                else if ($('#cancelRadio').is(':checked')) status = 'cancelada';
                else if ($('#asistioRadio').is(':checked')) status = 'asistio';
                else if ($('#noAsistioRadio').is(':checked')) status = 'no asistio';
                else {
                  $('#errorMessage').text('Debes seleccionar un estado.').show();
                  return;
                }
                updateCitaStatus(event.id, status);
              });
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
                toastr.error('Error al obtener los detalles de la cita');
              }
            }
          });
        }
      });
    });

    function loadEvents(callback) {
      $.ajax({
        url: '{{ route('citas.calendario') }}',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          var events = [];
          $(data).each(function() {
            var color = 'gray';
            if (this.status === 'confirmada') {
              color = 'green';
            } else if (this.status === 'cancelada') {
              color = 'orange';
            } else if (this.status === 'asistio') {
              color = 'info';
            } else if (this.status === 'no asistio') {
              color = 'red';
            }
            events.push({
              id: this.id,
              title: 'Cita con ' + this.paciente.nombre + ' ' + this.paciente.apellido,
              start: this.fecha_consulta + 'T' + this.hora,
              color: color
            });
          });
          callback(events);
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
            toastr.error('Error al cargar las citas.');
          }
        }
      });
    }

    function reloadEvents() {
      $('#calendar').fullCalendar('removeEvents');
      loadEvents(function(events) {
        $('#calendar').fullCalendar('addEventSource', events);
      });
    }

    function updateCitaStatus(citaId, status) {
      $.ajax({
        url: '/citas/' + citaId,
        type: 'PUT',
        data: {
          status: status,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          toastr.success(response.message);
          $('#statusModal').modal('hide');
          reloadEvents();
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
            toastr.error('Error al actualizar el estado de la cita');
          }
        }
      });
    }
  </script>
@endsection
