document.addEventListener("DOMContentLoaded", function () {
    // Lista base de pasos (siempre visibles)
    const steps = [
      {
        title: 'Bienvenido',
        intro: 'Esta es una ayuda interactiva para entender el sistema.',
      },
      {
        element: document.querySelector('.btn-menu-dashboard'),
        title: 'Menú lateral',
        intro: 'Haz clic aquí para abrir el menú de navegación.',
      },
      {
        element: document.querySelector('.btn-Notifications-area'),
        title: 'Notificaciones',
        intro: 'Aquí verás tus notificaciones importantes.',
      },
      {
        element: document.querySelector('.btn-dropdown'),
        title: 'Perfil de usuario',
        intro: 'Accede a tu perfil y opciones personales.',
      },
      {
        element: document.querySelector('.btn-ayuda-interactiva'),
        title: 'Ayuda interactiva',
        intro: 'Vuelve a iniciar esta guía cuando quieras.',
      },
      
    ];

    const epecialidadBtn = document.querySelector('.btn-especialidad');
    if (epecialidadBtn) {
        steps.push({
          element: epecialidadBtn,
          title: 'Nueva Especialidad',
          intro: 'Haz clic aquí para registrar una nueva especialidad.',
        });
    }

    // Paso del botón NUEVO (si existe)
    const nuevoBtn = document.querySelector('a[href="#new"]');
    if (nuevoBtn) {
      steps.push({
        element: nuevoBtn,
        title: 'Nuevo registro',
        intro: 'Haz clic aquí para registrar un nuevo especialista.',
      });
    }
  
    // Opcionalmente agrega los de la tabla solo si están listos
    const verBtn = document.querySelector('.btn-ver-especialista');
    if (verBtn) {
      steps.push({
        element: verBtn,
        title: 'Ver especialista',
        intro: 'Haz clic aquí para ver los detalles del especialista.',
      });
    }
  
    const editarBtn = document.querySelector('.btn-editar-especialista');
    if (editarBtn) {
      steps.push({
        element: editarBtn,
        title: 'Editar especialista',
        intro: 'Haz clic aquí para editar la información del especialista.',
      });
    }
  
    const eliminarBtn = document.querySelector('.btn-eliminar-especialista');
    if (eliminarBtn) {
      steps.push({
        element: eliminarBtn,
        title: 'Eliminar especialista',
        intro: 'Haz clic aquí para eliminar al especialista.',
      });
    }
  
    // Ejecuta el tour con los pasos que sí existen
    introJs()
      .setOptions({
        steps: steps,
        showProgress: true,
        showBullets: false,
        nextLabel: 'Siguiente',
        prevLabel: 'Anterior',
        skipLabel: 'Saltar',
        doneLabel: 'Finalizar',
        tooltipClass: 'customTooltip',
        highlightClass: 'customHighlight'
      })
      .start();
  });
  