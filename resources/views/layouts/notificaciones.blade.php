<section class="full-box Notifications-area">
  <div class="full-box Notifications-bg btn-Notifications-area"></div>
  <div class="full-box Notifications-body">
    <div class="Notifications-body-title text-titles text-center">
      <span>Notificaciones</span>
      <i class="zmdi zmdi-close btn-Notifications-area"></i>
    </div>
    <section>
      @foreach (Auth::user()->unreadNotifications as $notification)
        <section style="padding: 10px; display: flex; align-items: center; gap: 8px; border-bottom: 1px solid lightgray">
          <article
            style="width: 40px !important; height: 40px; display: flex; justify-content: center; align-items: center; border: 2px solid lightgray; border-radius: 50%; background-color: #f0f0f0; margin: 0">
            <i class="zmdi zmdi-notifications-none" style="font-size: 20px; color: gray;"></i>
          </article>
          <article>
            <div style="display: flex; flex-direction: column">
              <span style="font-size: 14px; font-weight: 600">
                {{ $notification->data['title'] }}
              </span>
              <span style="font-size: 12px;">
                {{ $notification->data['message'] }}
              </span>
              <span style="font-size: 12px; color: #1abc9c">
                {{ $notification->created_at->diffForHumans() }}
              </span>
            </div>

            {{-- <button onclick="markAsRead('{{ $notification->id }}')" class="btn btn-sm btn-danger">
              Marcar como leída
            </button> --}}
          </article>
        </section>
        <section
          style="background: #f0f0f0; padding: 10px; display: flex; align-items: center; gap: 8px; border-bottom: 1px solid lightgray">
          <article
            style="width: 40px !important; height: 40px; display: flex; justify-content: center; align-items: center; border: 2px solid lightgray; border-radius: 50%; background-color: #f0f0f0; margin: 0; padding: 0">
            <i class="zmdi zmdi-notifications-none" style="font-size: 20px; color: gray;"></i>
          </article>
          <article>
            <div style="display: flex; flex-direction: column">
              <span style="font-size: 14px; font-weight: 600">
                {{ $notification->data['title'] }}
              </span>
              <span style="font-size: 12px;">
                {{ $notification->data['message'] }}
              </span>
              <span style="font-size: 12px; color: #1abc9c">
                {{ $notification->created_at->diffForHumans() }}
              </span>
            </div>

            {{-- <button onclick="markAsRead('{{ $notification->id }}')" class="btn btn-sm btn-danger">
              Marcar como leída
            </button> --}}
          </article>
        </section>
      @endforeach
    </section>
  </div>
</section>

<script>
  // Cargar notificaciones en la barra de notificaciones
  function cargarNotificaciones() {
    $.get('/notificaciones', function(data) {
      console.log(data);

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
    $.post(`/notificaciones/leer/${id}`, {
      _token: "{{ csrf_token() }}"
    }, function() {
      cargarNotificaciones(); // Recargar notificaciones
    });
  }

  // Eliminar una notificación
  function eliminarNotificacion(id) {
    $.ajax({
      url: `/notificaciones/eliminar/${id}`,
      type: 'DELETE',
      data: {
        _token: "{{ csrf_token() }}"
      },
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
