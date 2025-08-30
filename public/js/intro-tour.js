document.addEventListener("DOMContentLoaded", function () {
  if (!window.mostrarAyuda) {
    return; // ❌ No se muestra la ayuda si ya se ha visto antes
  }

  const steps = [
    {
      title: "Bienvenido",
      intro: "Esta es una ayuda interactiva para entender el sistema.",
    },
    {
      element: document.querySelector(".btn-menu-dashboard"),
      title: "Menú lateral",
      intro: "Haz clic aquí para abrir el menú de navegación.",
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
      title: "Ayuda interactiva",
      intro: "Vuelve a iniciar esta guía cuando quieras.",
    },
  ];

  // Agrega pasos opcionales si existen los elementos
  const especialidadBtn = document.querySelector(".btn-especialidad");
  if (especialidadBtn) {
    steps.push({
      element: especialidadBtn,
      title: "Nueva Especialidad",
      intro: "Haz clic aquí para registrar una nueva especialidad.",
    });
  }

  const editarperfilBtn = document.querySelector(".editar-perfil");
  if (editarperfilBtn) {
    steps.push({
      element: editarperfilBtn,
      title: "Editar Perfil",
      intro:
        "Haz clic aquí para cambiar contraseña e ingresar preguntas de seguridad.",
    });
  }

  const nuevoBtn = document.querySelector('a[href="#new"]');
  if (nuevoBtn) {
    steps.push({
      element: nuevoBtn,
      title: "Nuevo registro de Especialista",
      intro: "Haz clic aquí para registrar un nuevo especialista.",
    });
  }

  const pacienteBtn = document.querySelector('a[href="#new-paciente"]');
  if (pacienteBtn) {
    steps.push({
      element: pacienteBtn,
      title: "Nuevo registro",
      intro: "Haz clic aquí para registrar un nuevo paciente.",
    });
  }

  const listusuariosBtn = document.querySelector('a[href="#list-usuarios"]');
  if (listusuariosBtn) {
    steps.push({
      element: listusuariosBtn,
      title: "Lista de usuarios del sistema",
      intro:
        "Haz clic aquí para ver la lista de los usuarios del sistema y su estado.",
    });
  }

  const perfilBtn = document.querySelector('a[href="#new-perfil"]');
  if (perfilBtn) {
    steps.push({
      element: perfilBtn,
      title: "Perfil",
      intro: "Información del perfil",
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

  const secretariaBtn = document.querySelector('a[href="#new-secretaria"]');
  if (secretariaBtn) {
    steps.push({
      element: secretariaBtn,
      title: "Registrar Secretaria",
      intro: "Haz clic aquí para registrar una nueva secretaria.",
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

  // ✅ Iniciar intro solo si mostrarAyuda es true
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
});
