// Este script necesita jquery
$(document).ready(function () {
  function cargarNotificaciones() {
    $.get("/api/notificaciones", function (data) {
      let html = "";

      updateNotificationCount(data.unread_count);

      if (data.notifications.length === 0) {
        html = `
          <section style="padding: 20px; text-align: center; color: #666;">
            <i class="zmdi zmdi-notifications-off" style="font-size: 40px; display: block; margin-bottom: 10px;"></i>
            <span style="font-size: 16px;">No tienes notificaciones</span>
          </section>
        `;
      } else {
        data.notifications.forEach((notification) => {
          const bgStyle = notification.read_at
            ? "background: #fff;"
            : "background: #e0e0e0;";

          html += `
            <section onclick="window.location.href = '/notificaciones/redirigir/${notification.id}'" style="${bgStyle} padding: 10px; display: flex; align-items: center; gap: 8px; border-bottom: 1px solid lightgray; cursor: pointer">
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
            </section>
          `;
        });
      }

      $("#notifications-container").html(html);
    }).fail(function () {
      $("#notifications-container").html(`
        <section style="padding: 20px; text-align: center; color: #666;">
          <i class="zmdi zmdi-alert-circle" style="font-size: 40px; display: block; margin-bottom: 10px;"></i>
          <span style="font-size: 16px;">Error al cargar las notificaciones</span>
        </section>
      `);
    });
  }

  function updateNotificationCount(count) {
    const badgeElement = $(".btn-Notifications-count .badge");

    if (count > 0) {
      if (badgeElement.length === 0) {
        $(".btn-Notifications-count").append(
          `<span class="badge">${count}</span>`
        );
      } else {
        badgeElement.text(count);
      }
    } else {
      badgeElement.remove();
    }
  }

  cargarNotificaciones();
});
