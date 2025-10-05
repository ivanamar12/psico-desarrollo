document.addEventListener("DOMContentLoaded", function () {
  function startGuide() {
    const steps = [
      {
        title: "Bienvenido",
        intro: "Esta es una guía interactiva para entender el sistema.",
      },
      {
        element: document.querySelector(".btn-menu-dashboard"),
        title: "Menú lateral",
        intro: "Haz clic aquí para Abrir/Cerrar el menú de navegación.",
      },
      {
        element: document.querySelector(".btn-Notifications-area"),
        title: "Notificaciones",
        intro: "Aquí verás tus notificaciones importantes.",
      },
      {
        element: document.querySelector(".btn-dropdown"),
        title: "Perfil de usuario",
        intro: "Accede a tu perfil y opciones personales.",
      },
      {
        element: document.querySelector(".btn-ayuda-interactiva"),
        title: "Guía interactiva",
        intro: "Vuelve a iniciar esta guía cuando quieras.",
      },
    ];

    // Perfil
    const btnEditProfile = document.querySelector(".editar-perfil");
    if (btnEditProfile) {
      steps.push({
        element: btnEditProfile,
        title: "Editar Perfil",
        intro:
          "Haz clic aquí para cambiar contraseña y registrar/cambiar pregunta de seguridad.",
      });
    }

    const btnUsersList = document.querySelector('a[href="#list-usuarios"]');
    if (btnUsersList) {
      steps.push({
        element: btnUsersList,
        title: "Listado Usuarios",
        intro: "Haz clic aquí para ver el listado de los usuarios y su estado.",
      });
    }

    const btnProfile = document.querySelector('a[href="#new-perfil"]');
    if (btnProfile) {
      steps.push({
        element: btnProfile,
        title: "Perfil de Usuario",
        intro: "Información del perfil.",
      });
    }

    // Notificaciones
    const btnNotificationsList = document.querySelector(
      'a[href="#list-notificaciones"]'
    );
    if (btnNotificationsList) {
      steps.push({
        element: btnNotificationsList,
        title: "Listado Notificaciones",
        intro: "Haz clic aquí para ver el listado de las notificaciones.",
      });
    }

    // Especialidad
    const btnListEspecialidad = document.querySelector(
      'a[href="#list-especialidad"]'
    );
    if (btnListEspecialidad) {
      steps.push({
        element: btnListEspecialidad,
        title: "Listado de Especialidades",
        intro: "Haz clic aquí para ver el listado de las especialidades.",
      });
    }

    const btnNewEspecialidad = document.querySelector(
      'a[href="#new-especialidad"]'
    );
    if (btnNewEspecialidad) {
      steps.push({
        element: btnNewEspecialidad,
        title: "Nueva Especialidad",
        intro: "Haz clic aquí para registrar una nueva especialidad.",
      });
    }

    // Especialista
    const btnListEspecialista = document.querySelector(
      'a[href="#list-especialista"]'
    );
    if (btnListEspecialista) {
      steps.push({
        element: btnListEspecialista,
        title: "Listado de Especialistas",
        intro: "Haz clic aquí para ver el listado de los especialistas.",
      });
    }

    const btnNewEspecialista = document.querySelector(
      'a[href="#new-especialista"]'
    );
    if (btnNewEspecialista) {
      steps.push({
        element: btnNewEspecialista,
        title: "Nuevo Especialista",
        intro: "Haz clic aquí para registrar un nuevo especialista.",
      });
    }

    // Secretaria
    const btnListSecretaria = document.querySelector(
      'a[href="#list-secretaria"]'
    );
    if (btnListSecretaria) {
      steps.push({
        element: btnListSecretaria,
        title: "Listado Secretarias",
        intro: "Haz clic aquí para ver el listado de las secretarias.",
      });
    }

    const btnNewSecretaria = document.querySelector(
      'a[href="#new-secretaria"]'
    );
    if (btnNewSecretaria) {
      steps.push({
        element: btnNewSecretaria,
        title: "Nueva Secretaria",
        intro: "Haz clic aquí para registrar una nueva secretaria.",
      });
    }

    // Representante
    const btnListRepresentante = document.querySelector(
      'a[href="#list-representante"]'
    );
    if (btnListRepresentante) {
      steps.push({
        element: btnListRepresentante,
        title: "Listado Representantes",
        intro: "Haz clic aquí para ver el listado de los representantes.",
      });
    }

    const btnNewRepresentante = document.querySelector(
      'a[href="#new-representante"]'
    );
    if (btnNewRepresentante) {
      steps.push({
        element: btnNewRepresentante,
        title: "Nuevo Representante",
        intro: "Haz clic aquí para registrar un nuevo representante.",
      });
    }

    // Paciente
    const btnListPaciente = document.querySelector('a[href="#list-paciente"]');
    if (btnListPaciente) {
      steps.push({
        element: btnListPaciente,
        title: "Listado Pacientes",
        intro: "Haz clic aquí para ver el listado de los pacientes.",
      });
    }

    const btnNewPaciente = document.querySelector('a[href="#new-paciente"]');
    if (btnNewPaciente) {
      steps.push({
        element: btnNewPaciente,
        title: "Nuevo Paciente",
        intro: "Haz clic aquí para registrar un nuevo paciente.",
      });
    }

    const pruebaBtn = document.querySelector('a[href="#new-prueba"]');
    if (pruebaBtn) {
      steps.push({
        element: pruebaBtn,
        title: "Registrar Pruebas",
        intro: "Haz clic aquí para registrar una nueva prueba no estructurada.",
      });
    }

    const historiaBtn = document.querySelector('a[href="#new-historia"]');
    if (historiaBtn) {
      steps.push({
        element: historiaBtn,
        title: "Registrar Historias",
        intro:
          "Haz clic aquí para registrar una nueva historia clinica de un paciente.",
      });
    }

    const diasBtn = document.querySelector('a[href="#calendario"]');
    if (diasBtn) {
      steps.push({
        element: diasBtn,
        title: "Seleccionar Dia",
        intro: "Haz clic para seleccionar un dia disponible para la cita.",
      });
    }

    const cdBtn = document.querySelector('a[href="#citas-dia"]');
    if (cdBtn) {
      steps.push({
        element: cdBtn,
        title: "Lista de las citas del dia",
        intro: "Haz clic para ver la lista de las citas del dia.",
      });
    }

    const ctBtn = document.querySelector('a[href="#citas-todas"]');
    if (ctBtn) {
      steps.push({
        element: ctBtn,
        title: "Lista de todas las citas del consultorio",
        intro: "Haz clic para ver la lista de todas las citas del consultorio.",
      });
    }

    const aplicarBtn = document.querySelector('a[href="#new-aplicar"]');
    if (aplicarBtn) {
      steps.push({
        element: aplicarBtn,
        title: "Aplicar Pruebas",
        intro:
          "Haz clic aquí para aplicar las pruebas psicologicas a los pacientes.",
      });
    }

    const verBtn = document.querySelector(".btn-ver-especialista");
    if (verBtn) {
      steps.push({
        element: verBtn,
        title: "Ver especialista",
        intro: "Haz clic aquí para ver los detalles del especialista.",
      });
    }

    const editarBtn = document.querySelector(".btn-editar-especialista");
    if (editarBtn) {
      steps.push({
        element: editarBtn,
        title: "Editar especialista",
        intro: "Haz clic aquí para editar la información del especialista.",
      });
    }

    const eliminarBtn = document.querySelector(".btn-eliminar-especialista");
    if (eliminarBtn) {
      steps.push({
        element: eliminarBtn,
        title: "Eliminar especialista",
        intro: "Haz clic aquí para eliminar al especialista.",
      });
    }

    introJs()
      .setOptions({
        steps: steps,
        showProgress: true,
        showBullets: false,
        nextLabel: "Siguiente",
        prevLabel: "Anterior",
        skipLabel: "Saltar",
        doneLabel: "Finalizar",
        tooltipClass: "customTooltip",
        highlightClass: "customHighlight",
      })
      .start();
  }

  if (window.show_guide) startGuide();

  const botonAyuda = document.querySelector(".btn-ayuda-interactiva");
  if (botonAyuda) {
    botonAyuda.addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      startGuide();
    });
  }
});
