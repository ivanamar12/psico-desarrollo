function validarTexto(input) {
    let texto = input.value.replace(/[^a-zA-ZÁÉÍÓÚÑáéíóúñ\s]/g, '');
  
    texto = texto.toLowerCase().replace(/\b\w/g, function(letra) {
      return letra.toUpperCase();
    });
  
    if (texto.length > 50) {
      texto = texto.slice(0, 50);
    }
  
    input.value = texto;
  }

  function validateInput(input) {
    let value = input.value.toUpperCase().replace(/[^0-9]/g, ''); 
    if (value.length > 8) {
      value = value.slice(0, 8);
    }
  
    const numericValue = parseInt(value);
    if (numericValue > 34000000) {
      toastr.warning(
        'El número de cédula es incorrecto. Debe ser un número de hasta 8 dígitos y no mayor a 34.000.000.',
        'Advertencia', {
          timeOut: 5000
        }
      );
      input.value = 'V-';
      return;
    }
  
    input.value = value ? `V-${value}` : '';
  }

  document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    const yearEighteen = today.getFullYear() - 22;
  
    const minDate = '1900-01-01';
    const maxDate = `${yearEighteen}-12-31`;
  
    const ids = ['fecha_nac', 'fecha_nac2'];
  
    ids.forEach(id => {
      const input = document.getElementById(id);
      if (input) {
        input.setAttribute('min', minDate);
        input.setAttribute('max', maxDate);
      }
    });
  });
  
  document.getElementById('telefono').addEventListener('input', function () {
    let telefonoInput = this.value.replace(/\D/g, ''); 
    const validPrefixes = ['0412', '0424', '0414', '0416', '0426', '0422'];
  
    if (telefonoInput.length > 11) {
      telefonoInput = telefonoInput.slice(0, 11);
    }
  
    const isValidPrefix = validPrefixes.some(prefix => telefonoInput.startsWith(prefix));
  
    if (isValidPrefix && telefonoInput.length >= 4) {
      telefonoInput = telefonoInput.slice(0, 4) + '-' + telefonoInput.slice(4);
    }
  
    this.value = telefonoInput;
  
    if (telefonoInput.replace('-', '').length === 11 && !isValidPrefix) {
      toastr.warning('El número debe comenzar con 0412, 0424, 0414, 0416, 0426 o 0422.', 'Advertencia', {
        timeOut: 5000
      });
      this.value = '';
    }
  });

  document.getElementById('fvp').addEventListener('keypress', function (e) {
    if (e.key < '0' || e.key > '9') e.preventDefault();
  });

  document.getElementById('telefono2').addEventListener('input', function () {
    let telefonoInput2 = this.value.replace(/\D/g, ''); 
    const validPrefixes = ['0412', '0424', '0414', '0416', '0426', '0422'];
  
    if (telefonoInput2.length > 11) {
      telefonoInput2 = telefonoInput2.slice(0, 11);
    }
  
    const isValidPrefix = validPrefixes.some(prefix => telefonoInput2.startsWith(prefix));
  
    if (isValidPrefix && telefonoInput2.length >= 4) {
      telefonoInput2 = telefonoInput2.slice(0, 4) + '-' + telefonoInput2.slice(4);
    }
  
    this.value = telefonoInput2;
  
    if (telefonoInput2.replace('-', '').length === 11 && !isValidPrefix) {
      toastr.warning('El número debe comenzar con 0412, 0424, 0414, 0416, 0426 o 0422.', 'Advertencia', {
        timeOut: 5000
      });
      this.value = '';
    }
  });

  $(document).ready(function() {
    $('.email-verificar').on('blur', function() {
      const input = $(this);
      const email = input.val().trim();
  
      if (email === '') return;
  
      $.ajax({
        url: '/verificar-email',
        method: 'GET',
        data: { email: email },
        success: function(response) {
          if (response.exists) {
            toastr.error('Este correo ya está registrado en el sistema.');
            input.val('').focus();
            input.removeClass('is-valid').addClass('is-invalid');
            input.data('valid', false);
          } else {
            input.removeClass('is-invalid').addClass('is-valid');
            input.data('valid', true);
          }
        },
        error: function() {
          toastr.error('El correo ya esta en el sistema.');
        }
      });
    });
  
    $('form').on('submit', function(e) {
      let valid = true;
      $('.email-verificar').each(function() {
        const isValid = $(this).data('valid');
        if (isValid === false || typeof isValid === 'undefined') {
          toastr.error('Uno de los correos ingresados ya está en uso o no ha sido validado.');
          valid = false;
        }
      });
  
      if (!valid) e.preventDefault();
    });
  });
  

