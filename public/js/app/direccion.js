$(document).ready(function () {
  $("#estado_id").select2({
    placeholder: "Seleccione su estado",
    allowClear: true,
    minimumInputLength: 1,
    ajax: {
      transport: function (params, success, failure) {
        const searchTerm = params.data.term.toLowerCase().trim();
        const filteredEstados = estados.filter((estado) =>
          estado.estado.toLowerCase().includes(searchTerm)
        );
        const results = filteredEstados.map((estado) => ({
          id: estado.id,
          text: estado.estado,
        }));
        success({
          results: results,
        });
      },
    },
  });

  $("#municipio_id").select2({
    placeholder: "Seleccione su municipio",
    allowClear: true,
  });

  $("#parroquia_id").select2({
    placeholder: "Seleccione su parroquia",
    allowClear: true,
  });

  const showMunicipios = (filteredMunicipios) => {
    $("#municipio_id")
      .empty()
      .append("<option selected disabled>Seleccione su municipio</option>");
    filteredMunicipios.forEach((item) => {
      const option = new Option(item.municipio, item.id, false, false);
      $("#municipio_id").append(option);
    });
    $("#municipio_id").trigger("change");
  };

  const filterMunicipios = (id) => {
    const filteredMunicipios = municipios.filter(
      (item) => item.estado_id == id
    );
    showMunicipios(filteredMunicipios);
  };

  const showParroquias = (filteredParroquias) => {
    $("#parroquia_id")
      .empty()
      .append("<option selected disabled>Seleccione su parroquia</option>");
    filteredParroquias.forEach((item) => {
      const option = new Option(item.parroquia, item.id, false, false);
      $("#parroquia_id").append(option);
    });
    $("#parroquia_id").trigger("change");
  };

  const filterParroquias = (id) => {
    const filteredParroquias = parroquias.filter(
      (item) => item.municipio_id == id
    );
    showParroquias(filteredParroquias);
  };

  $("#estado_id").on("change", function (e) {
    const estadoId = $(this).val();
    filterMunicipios(estadoId);
    $("#parroquia_id")
      .empty()
      .append("<option selected disabled>Seleccione su parroquia</option>");
  });

  $("#municipio_id").on("change", function (e) {
    const municipioId = $(this).val();
    filterParroquias(municipioId);
  });
});
