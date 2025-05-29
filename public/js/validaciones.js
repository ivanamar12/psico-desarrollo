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
    const fechaNacInput = document.getElementById('fecha_nac');

    const today = new Date();

    const yearEighteen = today.getFullYear() - 22;

    const minDate = `${yearEighteen}-01-01`;
    fechaNacInput.setAttribute('min', '1900-01-01');
    fechaNacInput.setAttribute('max', `${yearEighteen}-12-31`);
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
