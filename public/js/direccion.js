

$(document).ready(function() {
    const municipios = @json($municipios); // Asegúrate de que esto esté bien definido
    const parroquias = @json($parroquias); // Asegúrate de que esto esté bien definido

    // Inicializar Select2 para municipio y parroquia
    $('#municipio_id').select2({
        placeholder: "Seleccione su municipio",
        allowClear: true
    });

    $('#parroquia_id').select2({
        placeholder: "Seleccione su parroquia",
        allowClear: true
    });

    const showMunicipios = (filteredMunicipios) => {
        $('#municipio_id').empty().append('<option selected disabled>Seleccione su municipio</option>');

        filteredMunicipios.forEach(item => {
            const option = new Option(item.municipio, item.id, false, false);
            $('#municipio_id').append(option);
        });

        $('#municipio_id').trigger('change');
    };

    const filterMunicipios = (id) => {
        const filteredMunicipios = municipios.filter(item => item.estado_id == id);
        showMunicipios(filteredMunicipios);
    };

    const showParroquias = (filteredParroquias) => {
        $('#parroquia_id').empty().append('<option selected disabled>Seleccione su parroquia</option>');

        filteredParroquias.forEach(item => {
            const option = new Option(item.parroquia, item.id, false, false);
            $('#parroquia_id').append(option);
        });

        $('#parroquia_id').trigger('change');
    };

    const filterParroquias = (id) => {
        const filteredParroquias = parroquias.filter(item => item.municipio_id == id);
        showParroquias(filteredParroquias);
    };

    $('#estado_id').on('change', function(e) {
        const estadoId = $(this).val();
        filterMunicipios(estadoId);
        // Limpiar parroquias al cambiar de estado
        $('#parroquia_id').empty().append('<option selected disabled>Seleccione su parroquia</option>');
    });

    $('#municipio_id').on('change', function(e) {
        const municipioId = $(this).val();
        filterParroquias(municipioId);
    });
});
