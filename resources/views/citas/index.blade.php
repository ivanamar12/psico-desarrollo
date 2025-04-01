@extends('layouts.app')
@section('title', 'Citas')
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
						<span class="badge"></span>
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
            <h1 class="text-titles"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i>Citas</h1>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                    <li class="active"><a href="#calendario" data-toggle="tab">Calendario</a></li>
                    <li class=""><a href="#list-1" data-toggle="tab">Lista de citas del dia</a></li>
                    <li class=""><a href="#list-2" data-toggle="tab">Lista</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="calendario">
                        <div id='calendar'></div>
                    </div>
                    <div class="tab-pane fade  in" id="list-1">
                        <div class="table-responsive">
                            <table class="table table-hover text-center" id="tab-citas_hoy">
                                <thead>
                                <div class="data-table-header">
                                    <button onclick="window.open('{{ url('/pdf/citas_hoy') }}', '_blank');" class="btn btn-custom" style="color: white;">
                                        <i class="zmdi zmdi-file-text"></i> Generar PDF Todas las Citas del dia
                                    </button>
                                </div>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Hora</th>
                                        <th class="text-center">Especialista</th>
                                        <th class="text-center">Paciente</th>
                                        <th class="text-center">Asistencia</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade  in" id="list-2">
                        <div class="table-responsive">
                            <table class="table table-hover text-center" id="tab-citas">
                                <thead>
                                <div class="data-table-header">
                                    <button onclick="window.open('{{ url('/pdf/citas') }}', '_blank');" class="btn btn-custom" style="color: white;">
                                        <i class="zmdi zmdi-file-text"></i> Generar PDF Todas las Citas
                                    </button>
                                </div>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Hora</th>
                                        <th class="text-center">Especialista</th>
                                        <th class="text-center">Paciente</th>
                                        <th class="text-center">Asistencia</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- modal para agendar la cita -->
@if(auth()->user()->can('crear citas'))
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title w-100 text-center" style="color: white;">Agendar Cita</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="form-group ">
                        <label class="control-label">Paciente</label>
                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="paciente_id">
                            <option selected>Seleccione un paciente</option>
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Especialista</label>
                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="especialista_id">
                            <option selected>Seleccione un Especialista</option>
                            @foreach ($especialistas as $especialista)
                                <option value="{{ $especialista->id }}">{{ $especialista->nombre }} {{ $especialista->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" class="form-control" id="hora" required onchange="validateHour()">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-regresar" data-dismiss="modal" style="color: white;">Cerrar</button>
                <button type="button" class="btn btn-custom" id="saveEvent" style="color: white;">Agendar Cita </button>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal para editar el estado de la cita -->
@if(auth()->user()->can('cambiar estado citas'))
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title w-100 text-center" style="color: white;">Descripción del estado de la cita</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
</div>
@endif
@endsection
@section('js')
<script>
$(document).ready(function() {
    var tablaCitasHoy = $('#tab-citas_hoy').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('citas.index') }}",
            data: {
                currentDate: "{{ date('Y-m-d') }}"
            }
        },
        columns: [
            { data: 'id' },
            { data: 'fecha_consulta' },
            { data: 'hora' },
            { data: 'especialista', name: 'especialista' },
            { data: 'paciente', name: 'paciente' },
            { data: 'status' },
            { data: 'action', orderable: false }
        ]
    });

    var tablaCitas = $('#tab-citas').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('citas.index') }}"
        },
        columns: [
            { data: 'id' },
            { data: 'fecha_consulta' },
            { data: 'hora' },
            { data: 'especialista', name: 'especialista' },
            { data: 'paciente', name: 'paciente' },
            { data: 'status' },
            { data: 'action', orderable: false }
        ]
    });
});

</script>
<script>
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
            var today = moment().startOf('day');
            if (date.isBefore(today)) {
                cell.addClass('fc-past'); 
            }
        },
        select: function(start, end) {
            var today = moment().startOf('day');
            if (start.isBefore(today)) {
                toastr.warning('No se pueden seleccionar fechas pasadas.');
                $('#calendar').fullCalendar('unselect');
                return;
            }
            var eventCount = $('#calendar').fullCalendar('clientEvents', function(event) {
                return event.start.isSame(start, 'day');
            }).length;
            if (eventCount >= 4) {
                toastr.warning('No se pueden agregar más de 4 citas por día.');
                $('#calendar').fullCalendar('unselect');
                return;
            }
            $('#eventModal').modal('show');
            $('#saveEvent').off('click').on('click', function() {
    validateHour();

    if (document.getElementById('hora').validity.valid) {
        var formData = {
            paciente_id: $('#paciente_id').val(),
            especialista_id: $('#especialista_id').val(),
            fecha: start.format('YYYY-MM-DD'), 
            hora: $('#hora').val(),
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
                console.error(xhr); 
                toastr.error('Error al crear la cita');
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
            <p><strong>Hora:</strong> ${data.hora}</p>
            <p><strong>Representante:</strong> ${data.representante_nombre}</p>
            <p><strong>Paciente:</strong> ${data.paciente_nombre}</p>
            <p><strong>Especialista:</strong> ${data.especialista_nombre}</p>`);

        $('#confirmRadio').prop('checked', false);
        $('#cancelRadio').prop('checked', false);
        $('#asistioRadio').prop('checked', false);
        $('#noAsistioRadio').prop('checked', false);
        $('#errorMessage').hide();

        if (data.status === 'confirmada') {
            $('#confirmRadio').closest('.form-check').hide();
            $('#cancelRadio').closest('.form-check').hide();
            $('#asistioRadio').closest('.form-check').show(); 
            $('#noAsistioRadio').closest('.form-check').show(); 
            $('#saveStatusButton').show(); 
        } else if (data.status === 'pendiente') {
            $('#confirmRadio').closest('.form-check').show();
            $('#cancelRadio').closest('.form-check').show();
            $('#asistioRadio').closest('.form-check').hide();
            $('#noAsistioRadio').closest('.form-check').hide();
            $('#saveStatusButton').show(); 
        } else if (data.status === 'cancelada' || data.status === 'asistio' || data.status === 'no asistio') {
            $('#confirmRadio').closest('.form-check').hide();
            $('#cancelRadio').closest('.form-check').hide();
            $('#asistioRadio').closest('.form-check').hide();
            $('#noAsistioRadio').closest('.form-check').hide();
            $('#statusModal .modal-body').append(`<p><strong>Estado:</strong> ${data.status}</p>`);
            $('#saveStatusButton').hide(); 
        }

        $('#saveStatusButton').off('click').on('click', function() {
            let status = null;
            if ($('#confirmRadio').is(':checked')) {
                status = 'confirmada';
            } else if ($('#cancelRadio').is(':checked')) {
                status = 'cancelada';
            } else if ($('#asistioRadio').is(':checked')) {
                status = 'asistio';
            } else if ($('#noAsistioRadio').is(':checked')) {
                status = 'no asistio';
            } else {
                $('#errorMessage').text('Debes seleccionar un estado.').show();
                return;
            }
            updateCitaStatus(event.id, status);
        });
    },
    error: function(xhr) {
        console.error(xhr);
        toastr.error('Error al obtener los detalles de la cita');
    }
});


}

    });
});

function loadEvents(callback) {
    $.ajax({
        url: '/citas/web',
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
                    title: 'Cita',
                    start: this.fecha_consulta + 'T' + this.hora,
                    color: color
                });
            });
            callback(events);
        },
        error: function(xhr) {
            console.error(xhr);
            toastr.error('Error al cargar las citas.');
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
            console.error(xhr);
            toastr.error('Error al actualizar el estado de la cita');
        }
    });
}
function validateHour() {
    const hourInput = document.getElementById('hora');
    const selectedHour = hourInput.value.split(':').map(Number);
    const submitButton = document.getElementById('saveEvent');

    if ((selectedHour[0] >= 7 && selectedHour[0] < 11) || (selectedHour[0] >= 13 && selectedHour[0] < 15)) {
        hourInput.setCustomValidity('');
        submitButton.disabled = false;
    } else {
        hourInput.setCustomValidity('Por favor, selecciona una hora entre las 7:00 AM y las 11:00 AM, o entre la 1:00 PM y las 3:00 PM.');
        submitButton.disabled = true;
    }
}
</script>
@endsection