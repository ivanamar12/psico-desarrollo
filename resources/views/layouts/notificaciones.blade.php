<section class="full-box Notifications-area">
  <div class="full-box Notifications-bg btn-Notifications-area"></div>
  <div class="full-box Notifications-body">
    <div class="Notifications-body-title text-titles text-center">
      <span>Notificaciones</span>
      <i class="zmdi zmdi-close btn-Notifications-area"></i>
    </div>
    <div onclick="verTodasNotificaciones()"
      style="background: lightgray; border: none; cursor: pointer; font-size: 14px; text-align: center; padding: 3px; transition: background 0.3s ease;"
      onmouseover="this.style.background='#bbb'" onmouseout="this.style.background='lightgray'">
      <span>
        Ver todas las notificaciones
      </span>
      <i class="zmdi zmdi-arrow-right-top" style="font-size: 16px;"></i>
    </div>
    <section id="notifications-container">
      <!-- Las notificaciones se cargarán aquí dinámicamente -->
    </section>
  </div>
</section>

<script>
  function cargarNotificaciones() {
    $.get('/api/notificaciones', function(data) {
      let html = "";

      data.notifications.forEach(notification => {
        const bgStyle = notification.read_at ? 'background: #fff;' : 'background: #e0e0e0;';

        html += `
        <section onclick="marcarLeida('${notification.id}')" style="${bgStyle} padding: 10px; display: flex; align-items: center; gap: 8px; border-bottom: 1px solid lightgray; cursor: pointer">
          <article style="width: 40px !important; height: 40px; display: flex; justify-content: center; align-items: center; border: 2px solid lightgray; border-radius: 50%; background-color: #f0f0f0; margin: 0">
            <i class="zmdi zmdi-notifications-none" style="font-size: 20px; color: gray;"></i>
          </article>
          <article>
            <div style="display: flex; flex-direction: column">
              <span style="font-size: 14px; font-weight: 600">
                ${notification.data.title}
              </span>
              <span style="font-size: 12px;">
                ${notification.data.message}
              </span>
              <span style="font-size: 12px; color: #1abc9c">
                ${notification.created_at}
              </span>
            </div>
          </article>
        </section>`;
      });

      $("#notifications-container").html(html);
    });
  }

  function marcarLeida(id) {
    window.location.href = `/notificaciones/redirigir/${id}`;
  }

  function verTodasNotificaciones() {
    window.location.href = `{{ route('notificaciones.index') }}`;
  }

  $(document).ready(function() {
    cargarNotificaciones();
  });
</script>
