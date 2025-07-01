function validarTexto(input) {
  let texto = input.value.replace(/[^a-zA-ZÁÉÍÓÚÑáéíóúñ\s]/g, "");
  texto = texto.toLowerCase().replace(/\b\w/g, letra => letra.toUpperCase());
  if (texto.length > 50) texto = texto.slice(0, 50);
  input.value = texto;
}

function validarCedulaInput(input) {
  let valor = input.value.toUpperCase();
  
  // Permitimos escribir V, E o P al inicio, con o sin guion
  const match = valor.match(/^([VEP])\-?(\d{0,8})$/);

  if (match) {
    let tipo = match[1];
    let numero = match[2].replace(/\D/g, "");
    if (numero.length > 8) numero = numero.slice(0, 8);
    input.value = `${tipo}-${numero}`;
  } else {
    // Limpieza si no cumple con patrón
    input.value = "";
  }
}

function validarCedulaRango(input) {
  const valor = input.value.toUpperCase().trim();
  const match = valor.match(/^([VEP])-?(\d{1,8})$/); // V-, E-, P- y hasta 8 números

  if (!match) {
    toastr.warning("Debe ingresar una cédula válida (V-, E- o P- seguido de números).", "Advertencia", {
      timeOut: 5000
    });
    input.value = "V-";
    return;
  }

  const tipo = match[1];
  const numero = parseInt(match[2]);

  if (isNaN(numero) || match[2].length < 6 || match[2].length > 8 || numero < 100000 || numero > 34000000) {
    toastr.warning("La cédula debe tener entre 6 y 8 dígitos y estar entre 100.000 y 34.000.000.", "Advertencia", {
      timeOut: 5000
    });
    input.value = `${tipo}-`;
    return;
  }

  input.value = `${tipo}-${match[2]}`;
}



function validarTelefonoInput(input) {
  let telefono = input.value.replace(/\D/g, "");
  const validPrefixes = ["0412", "0424", "0414", "0416", "0426", "0422"];

  if (telefono.length > 11) {
    telefono = telefono.slice(0, 11);
  }

  const isValidPrefix = validPrefixes.some(prefix => telefono.startsWith(prefix));

  if (isValidPrefix && telefono.length >= 4) {
    telefono = telefono.slice(0, 4) + "-" + telefono.slice(4);
  }

  input.value = telefono;

  if (telefono.replace("-", "").length === 11 && !isValidPrefix) {
    toastr.warning("El número debe comenzar con 0412, 0424, 0414, 0416, 0426 o 0422.", "Advertencia", {
      timeOut: 5000
    });
    input.value = "";
  }
}

function validarTelefonoRango(input) {
  const numero = input.value.replace(/\D/g, "");
  if (numero.length !== 11) {
    toastr.warning("El número de teléfono debe tener exactamente 11 dígitos.", "Advertencia", {
      timeOut: 5000
    });
    input.value = "";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const today = new Date();
  const yearEighteen = today.getFullYear() - 22;
  const minDate = "1900-01-01";
  const maxDate = `${yearEighteen}-12-31`;

  const ids = ["fecha_nac", "fecha_nac2"];
  ids.forEach(id => {
    const input = document.getElementById(id);
    if (input) {
      input.setAttribute("min", minDate);
      input.setAttribute("max", maxDate);
    }
  });

  // Teléfonos
  const tel1 = document.getElementById("telefono");
  const tel2 = document.getElementById("telefono2");
  tel1.addEventListener("input", function () { validarTelefonoInput(this); });
  tel1.addEventListener("blur", function () { validarTelefonoRango(this); });

  tel2.addEventListener("input", function () { validarTelefonoInput(this); });
  tel2.addEventListener("blur", function () { validarTelefonoRango(this); });

  // Cédula
const cedulas = ["ci", "ci2"];

cedulas.forEach(function (id) {
  const input = document.getElementById(id);
  if (input) {
    input.addEventListener("input", function () {
      validarCedulaInput(this);
    });
    input.addEventListener("blur", function () {
      validarCedulaRango(this);
    });
  }
});



  // Solo números para FVP
  document.getElementById("fvp").addEventListener("keypress", function (e) {
    if (e.key < "0" || e.key > "9") e.preventDefault();
  });
});

// Email
$(document).ready(function () {
  console.log("JS cargado");

  $(".email-verificar").on("blur", function () {
    const input = $(this);
    const email = input.val().trim();
    if (email === "") return;

    $.ajax({
      url: "/verificar-email",
      method: "GET",
      data: { email: email },
      success: function (response) {
        if (response.exists) {
          toastr.error("Este correo ya está registrado en el sistema.");
          input.val("").focus();
          input.removeClass("is-valid").addClass("is-invalid");
          input.data("valid", false);
        } else {
          input.removeClass("is-invalid").addClass("is-valid");
          input.data("valid", true);
        }
      },
      error: function () {
        toastr.error("El correo ya está en el sistema.");
      }
    });
  });

  $("form").on("submit", function (e) {
    let valid = true;
    $(".email-verificar").each(function () {
      const isValid = $(this).data("valid");
      if (isValid === false || typeof isValid === "undefined") {
        toastr.error("Uno de los correos ingresados ya está en uso o no ha sido validado.");
        valid = false;
      }
    });
    if (!valid) e.preventDefault();
  });
});
