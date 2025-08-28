/******/ (() => { // webpackBootstrap
/*!****************************************!*\
  !*** ./resources/js/notificaciones.js ***!
  \****************************************/
// Este script necesita jquery
$(document).ready(function () {
  function cargarNotificaciones() {
    $.get("/api/notificaciones", function (data) {
      var html = "";
      updateNotificationCount(data.unread_count);
      if (data.notifications.length === 0) {
        html = "\n          <section style=\"padding: 20px; text-align: center; color: #666;\">\n            <i class=\"zmdi zmdi-notifications-off\" style=\"font-size: 40px; display: block; margin-bottom: 10px;\"></i>\n            <span style=\"font-size: 16px;\">No tienes notificaciones</span>\n          </section>\n        ";
      } else {
        data.notifications.forEach(function (notification) {
          var bgStyle = notification.read_at ? "background: #fff;" : "background: #e0e0e0;";
          html += "\n            <section onclick=\"window.location.href = '/notificaciones/redirigir/".concat(notification.id, "'\" style=\"").concat(bgStyle, " padding: 10px; display: flex; align-items: center; gap: 8px; border-bottom: 1px solid lightgray; cursor: pointer\">\n              <article style=\"width: 40px !important; height: 40px; display: flex; justify-content: center; align-items: center; border: 2px solid lightgray; border-radius: 50%; background-color: #f0f0f0; margin: 0\">\n                <i class=\"zmdi zmdi-notifications-none\" style=\"font-size: 20px; color: gray;\"></i>\n              </article>\n              <article>\n                <div style=\"display: flex; flex-direction: column\">\n                  <span style=\"font-size: 14px; font-weight: 600\">\n                    ").concat(notification.data.title, "\n                  </span>\n                  <span style=\"font-size: 12px;\">\n                    ").concat(notification.data.message, "\n                  </span>\n                  <span style=\"font-size: 12px; color: #1abc9c\">\n                    ").concat(notification.created_at, "\n                  </span>\n                </div>\n              </article>\n            </section>\n          ");
        });
      }
      $("#notifications-container").html(html);
    }).fail(function () {
      $("#notifications-container").html("\n        <section style=\"padding: 20px; text-align: center; color: #666;\">\n          <i class=\"zmdi zmdi-alert-circle\" style=\"font-size: 40px; display: block; margin-bottom: 10px;\"></i>\n          <span style=\"font-size: 16px;\">Error al cargar las notificaciones</span>\n        </section>\n      ");
    });
  }
  function updateNotificationCount(count) {
    var badgeElement = $(".btn-Notifications-count .badge");
    if (count > 0) {
      if (badgeElement.length === 0) {
        $(".btn-Notifications-count").append("<span class=\"badge\">".concat(count, "</span>"));
      } else {
        badgeElement.text(count);
      }
    } else {
      badgeElement.remove();
    }
  }
  cargarNotificaciones();
});
/******/ })()
;