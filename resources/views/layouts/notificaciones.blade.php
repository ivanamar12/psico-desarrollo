<section class="full-box Notifications-area">
		<div class="full-box Notifications-bg btn-Notifications-area"></div>
		<div class="full-box Notifications-body">
			<div class="Notifications-body-title text-titles text-center">
				Notifications <i class="zmdi zmdi-close btn-Notifications-area"></i>
			</div>
			<div class="list-group">
				@foreach (Auth::user()->unreadNotifications as $notification)
					<div class="list-group-item">
						<div class="row-action-primary">
							<i class="zmdi zmdi-alert-triangle"></i>
						</div>
						<div class="row-content">
							<div class="least-content">{{ $notification->created_at->diffForHumans() }}</div>
							<h4 class="list-group-item-heading">{{ $notification->data['title'] }}</h4>
							<p class="list-group-item-text">{{ $notification->data['message'] }}</p>
							<button onclick="markAsRead('{{ $notification->id }}')" class="btn btn-sm btn-danger">Marcar como leída</button>
						</div>
					</div>
				@endforeach
			</div>

		</div>
	</section>
<script>
// Cargar notificaciones en la barra de notificaciones
function cargarNotificaciones() {
    $.get('/notificaciones', function(data) {
        let html = "";
        data.notifications.forEach(noti => {
            html += `
                <div class="list-group-item">
                    <div class="row-content">
                        <div class="least-content">${new Date(noti.created_at).toLocaleString()}</div>
                        <h4 class="list-group-item-heading">${noti.data.titulo}</h4>
                        <p class="list-group-item-text">${noti.data.mensaje}</p>
                        <button onclick="marcarLeida('${noti.id}')" class="btn btn-sm btn-primary">Leída</button>
                        <button onclick="eliminarNotificacion('${noti.id}')" class="btn btn-sm btn-danger">Eliminar</button>
                    </div>
                </div>`;
        });
        $(".list-group").html(html);
    });
}

// Marcar una notificación como leída
function marcarLeida(id) {
    $.post(`/notificaciones/leer/${id}`, {_token: "{{ csrf_token() }}"}, function() {
        cargarNotificaciones(); // Recargar notificaciones
    });
}

// Eliminar una notificación
function eliminarNotificacion(id) {
    $.ajax({
        url: `/notificaciones/eliminar/${id}`,
        type: 'DELETE',
        data: {_token: "{{ csrf_token() }}"},
        success: function() {
            cargarNotificaciones(); // Recargar notificaciones
        }
    });
}

// Cargar notificaciones al cargar la página
$(document).ready(function() {
    cargarNotificaciones();
});
</script>