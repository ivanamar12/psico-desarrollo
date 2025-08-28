<section class="full-box Notifications-area">
  <div class="full-box Notifications-bg btn-Notifications-area"></div>
  <div class="full-box Notifications-body">
    <div class="Notifications-body-title text-titles text-center">
      <span>Notificaciones</span>
      <i class="zmdi zmdi-close btn-Notifications-area"></i>
    </div>
    <div onclick="verTodasNotificaciones()"
      style="background: lightgray; border: none; cursor: pointer; font-size: 14px; text-align: center; padding: 8px; transition: background 0.3s ease;"
      onmouseover="this.style.background='#bbb'" onmouseout="this.style.background='lightgray'">
      <span>
        Ver todas las notificaciones
      </span>
      <i class="zmdi zmdi-arrow-right-top" style="font-size: 16px;"></i>
    </div>
    <section id="notifications-container" style="overflow: auto">
      <!-- Las notificaciones se cargarán aquí dinámicamente -->
    </section>
  </div>
</section>
