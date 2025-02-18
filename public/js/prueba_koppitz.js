$(document).ready(function () {
    let subescala = {};
    let currentStep = 0;

    function iniciarPruebaKoppitz(subescalaData) {
        if (!subescalaData || subescalaData.items.length === 0) {
            alert("No hay ítems disponibles para esta prueba.");
            return;
        }

        subescala = subescalaData;
        currentStep = 0;
        mostrarItemKoppitz(currentStep);
    }

    function mostrarItemKoppitz(step) {
        if (step < 0 || step >= subescala.items.length) return;

        let item = subescala.items[step];
        let contenido = `<h4>Prueba Koppitz</h4><p>${subescala.descripcion}</p>`;
        contenido += `<p><strong>${item.item}</strong></p>`;
        contenido += `
            <input type="radio" name="respuesta_${item.id}" value="si"> Sí 
            <input type="radio" name="respuesta_${item.id}" value="no"> No
        `;

        $("#contenidoPrueba").html(contenido);
        actualizarBotones(step);
    }

    function actualizarBotones(step) {
        $("#btnAnterior").toggle(step > 0);
        $("#btnSiguiente").toggle(step < subescala.items.length - 1);
        $("#btnFinalizar").toggle(step === subescala.items.length - 1);
    }

    $("#btnSiguiente").click(function () {
        currentStep++;
        mostrarItemKoppitz(currentStep);
    });

    $("#btnAnterior").click(function () {
        currentStep--;
        mostrarItemKoppitz(currentStep);
    });

    $("#btnFinalizar").click(function () {
        let respuestas = {};

        $("input[type=radio]:checked").each(function () {
            let name = $(this).attr("name");
            respuestas[name] = $(this).val();
        });

        $.ajax({
            url: "/aplicar-prueba/guardar",
            method: "POST",
            data: {
                paciente_id: $("#paciente_id").val(),
                prueba_id: $("#prueba_id").val(),
                respuestas: respuestas,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                alert("Prueba Koppitz guardada correctamente.");
                $("#modalPrueba").modal("hide");
            }
        });
    });

    window.iniciarPruebaKoppitz = iniciarPruebaKoppitz;
});
