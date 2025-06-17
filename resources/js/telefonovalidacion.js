document.getElementById('telefono').addEventListener('input', function() {
    const telefonoInput = this.value;
    const validPrefixes = ['0412', '0424', '0414', '0416', '0426'];

    if (telefonoInput.length > 11) {
        this.value = telefonoInput.slice(0, 11); 
    }

    const isValidPrefix = validPrefixes.some(prefix => telefonoInput.startsWith(prefix));

    if (telefonoInput.length === 11 && !isValidPrefix) {
        toastr.warning('El número debe comenzar con 0412, 0424, 0414, 0416 o 0426.', 'Advertencia', { timeOut: 5000 });
        this.value = ''; 
    }
});
