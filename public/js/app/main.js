$(document).ready(function () {
  $(".btn-sideBar-SubMenu").on("click", function () {
    var SubMenu = $(this).next("ul");
    var iconBtn = $(this).children(".zmdi-caret-down");
    if (SubMenu.hasClass("show-sideBar-SubMenu")) {
      iconBtn.removeClass("zmdi-hc-rotate-180");
      SubMenu.removeClass("show-sideBar-SubMenu");
    } else {
      iconBtn.addClass("zmdi-hc-rotate-180");
      SubMenu.addClass("show-sideBar-SubMenu");
    }
  });

  $(".btn-menu-dashboard").on("click", function (e) {
    e.preventDefault();
    var body = $(".dashboard-contentPage");
    var sidebar = $(".dashboard-sideBar");

    // Para dispositivos móviles (ancho menor a 768px)
    if ($(window).width() < 768) {
      if (sidebar.hasClass("show-sidebar")) {
        sidebar.removeClass("show-sidebar");
      } else {
        sidebar.addClass("show-sidebar");
      }
    }
    // Para desktop (ancho mayor o igual a 768px)
    else {
      if (sidebar.css("pointer-events") == "none") {
        body.removeClass("no-paddin-left");
        sidebar.removeClass("hide-sidebar");
      } else {
        body.addClass("no-paddin-left");
        sidebar.addClass("hide-sidebar");
      }
    }
  });

  // Cerrar sidebar al hacer clic en el botón de cerrar (para móviles)
  $(".dashboard-sideBar-title .zmdi-close").on("click", function (e) {
    e.preventDefault();
    $(".dashboard-sideBar").removeClass("show-sidebar");
  });

  // Cerrar sidebar al hacer clic fuera del contenido (para móviles)
  $(document).on("click", function (e) {
    if (
      $(window).width() < 768 &&
      !$(e.target).closest(".dashboard-sideBar-ct").length &&
      !$(e.target).closest(".btn-menu-dashboard").length &&
      $(".dashboard-sideBar").hasClass("show-sidebar")
    ) {
      $(".dashboard-sideBar").removeClass("show-sidebar");
    }
  });

  // Asegurar que el sidebar se cierre al cambiar a pantalla grande
  $(window).on("resize", function () {
    if ($(window).width() >= 768) {
      $(".dashboard-sideBar").removeClass("show-sidebar");
    }
  });

  $(".btn-Notifications-area").on("click", function () {
    var NotificationsArea = $(".Notifications-area");
    if (NotificationsArea.css("opacity") == "0") {
      NotificationsArea.addClass("show-Notification-area");
    } else {
      NotificationsArea.removeClass("show-Notification-area");
    }
  });
});

(function ($) {
  $(window).on("load", function () {
    $(".dashboard-sideBar-ct").mCustomScrollbar({
      theme: "light-thin",
      scrollbarPosition: "inside",
      autoHideScrollbar: true,
      scrollButtons: { enable: true },
    });
    $(".dashboard-contentPage, .Notifications-body").mCustomScrollbar({
      theme: "dark-thin",
      scrollbarPosition: "inside",
      autoHideScrollbar: true,
      scrollButtons: { enable: true },
    });
  });
})(jQuery);
