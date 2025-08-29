// ========== VALIDACIÓN DE EMAIL ==========

function validarEmail(input) {
  let email = input.value.trim().toLowerCase();
  input.value = email;

  const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;

  if (email === "") {
    input.classList.remove("is-valid", "is-invalid");
    return false;
  }

  if (!emailRegex.test(email)) {
    toastr.warning(
      "Por favor ingrese un email válido (ejemplo: usuario@dominio.com).",
      "Formato incorrecto",
      { timeOut: 5000 }
    );
    input.classList.add("is-invalid");
    input.classList.remove("is-valid");
    return false;
  }

  input.classList.remove("is-invalid");
  input.classList.add("is-valid");
  return true;
}

document.addEventListener("DOMContentLoaded", function () {
  const emailInputs = document.querySelectorAll(".email-verificar");
  emailInputs.forEach((input) => {
    input.addEventListener("input", function () {
      this.value = this.value.toLowerCase();
    });

    input.addEventListener("blur", function () {
      validarEmail(this);
    });
  });
});

// ========== VALIDACIONES DE TEXTO ==========

function validarTexto(input) {
  let texto = input.value.replace(/[^a-zA-ZÁÉÍÓÚÑáéíóúñ\s]/g, "");
  texto = texto.toLowerCase().replace(/\b\w/g, (letra) => letra.toUpperCase());
  if (texto.length > 50) texto = texto.slice(0, 50);
  input.value = texto;
}

// ========== CÉDULA ==========

function validarCedulaInput(input) {
  let valor = input.value.toUpperCase();
  const match = valor.match(/^([VEP])\-?(\d{0,9})$/);

  if (match) {
    let tipo = match[1];
    let numero = match[2].replace(/\D/g, "");
    if (numero.length > 9) numero = numero.slice(0, 9);
    input.value = `${tipo}-${numero}`;
  } else {
    input.value = "";
  }
}

function validarCedulaRango(input) {
  const valor = input.value.toUpperCase().trim();
  const match = valor.match(/^([VEP])-?(\d{1,9})$/);

  if (!match) {
    toastr.warning(
      "Debe ingresar una cédula válida (V-, E- o P- seguido de números).",
      "Advertencia",
      { timeOut: 5000 }
    );
    input.value = "V-";
    return;
  }

  const tipo = match[1];
  const numero = parseInt(match[2]);

  if (
    isNaN(numero) ||
    match[2].length < 6 ||
    match[2].length > 9 ||
    numero < 100000 ||
    numero > 9999999999
  ) {
    toastr.warning(
      "La cédula debe tener entre 6 y 8 dígitos y estar entre 100.000 y 34.000.000.",
      "Advertencia",
      { timeOut: 5000 }
    );
    input.value = `${tipo}-`;
    return;
  }

  input.value = `${tipo}-${match[2]}`;
}

// ========== TELÉFONO ==========

function validarTelefonoInput(input) {
  let telefono = input.value.replace(/\D/g, "");
  const validPrefixes = ["0412", "0424", "0414", "0416", "0426", "0422"];

  if (telefono.length > 11) {
    telefono = telefono.slice(0, 11);
  }

  const isValidPrefix = validPrefixes.some((prefix) =>
    telefono.startsWith(prefix)
  );

  if (isValidPrefix && telefono.length >= 4) {
    telefono = telefono.slice(0, 4) + "-" + telefono.slice(4);
  }

  input.value = telefono;

  if (telefono.replace("-", "").length === 11 && !isValidPrefix) {
    toastr.warning(
      "El número debe comenzar con 0412, 0422, 0424, 0414, 0416, o 0426.",
      "Advertencia",
      { timeOut: 5000 }
    );
    input.value = "";
  }
}

function validarTelefonoRango(input) {
  const numero = input.value.replace(/\D/g, "");
  if (numero.length !== 11) {
    toastr.warning(
      "El número de teléfono debe tener exactamente 11 dígitos.",
      "Advertencia",
      { timeOut: 5000 }
    );
    input.value = "";
  }
}

// ========== FVP ==========

document.addEventListener("DOMContentLoaded", function () {
  const today = new Date();
  const yearEighteen = today.getFullYear() - 22;
  const minDate = "1900-01-01";
  const maxDate = `${yearEighteen}-12-31`;

  const ids = ["fecha_nac", "fecha_nac2"];
  ids.forEach((id) => {
    const input = document.getElementById(id);
    if (input) {
      input.setAttribute("min", minDate);
      input.setAttribute("max", maxDate);
    }
  });

  // Teléfonos
  const tel1 = document.getElementById("telefono");
  const tel2 = document.getElementById("telefono2");

  if (tel1) {
    tel1.addEventListener("input", function () {
      validarTelefonoInput(this);
    });
    tel1.addEventListener("blur", function () {
      validarTelefonoRango(this);
    });
  }

  if (tel2) {
    tel2.addEventListener("input", function () {
      validarTelefonoInput(this);
    });
    tel2.addEventListener("blur", function () {
      validarTelefonoRango(this);
    });
  }

  // Cédulas
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

  // FVP solo números
  if (document.getElementById("fvp")) {
    document.getElementById("fvp").addEventListener("keypress", function (e) {
      if (e.key < "0" || e.key > "9") e.preventDefault();
    });
  }
});

// ========== VALIDACIONES REMOTAS (GLOBALES) ==========

window.emailValidated = false;
window.telefonoValidated = false;
window.cedulaValidated = false;

$(document).ready(function () {
  function validateField(input, url, validationVar) {
    const value = input.val().trim();

    if (value === "") {
      input.removeClass("is-valid is-invalid");
      window[validationVar] = false;
      return;
    }

    input.prop("disabled", true);

    $.ajax({
      url: url,
      method: "GET",
      data: { [input.attr("name")]: value },
      success: function (response) {
        if (response.exists) {
          toastr.error("Este " + input.attr("name") + " ya está registrado.");
          input.val("").removeClass("is-valid").addClass("is-invalid");
          window[validationVar] = false;
        } else {
          input.removeClass("is-invalid").addClass("is-valid");
          window[validationVar] = true;
        }
      },
      error: function (xhr) {
        console.error(
          "Error en validación de " + input.attr("name"),
          xhr.responseText
        );
        toastr.error("Error al verificar el " + input.attr("name") + ".");
        window[validationVar] = false;
      },
      complete: function () {
        input.prop("disabled", false);
      },
    });
  }

  // Validación de email
  $(document).on("blur", ".email-verificar", function () {
    validateField($(this), "/verificar-email", "emailValidated");
  });

  // Validación de teléfono
  $(document).on("blur", ".telefono-verificar", function () {
    validateField($(this), "/verificar-telefono", "telefonoValidated");
  });

  // Validación de cédula
  $(document).on("blur", ".ci-verificar", function () {
    validateField($(this), "/verificar-cedula", "cedulaValidated");
  });
});
