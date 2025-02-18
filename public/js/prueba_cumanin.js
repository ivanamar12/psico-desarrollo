$(document).ready(function () {
    let subescalas = [];
    let currentStep = 0;

    function iniciarPruebaCumanin(subescalasData) {
        subescalas = subescalasData.filter(subescala => subescala.items && subescala.items.length > 0);
        
        if (subescalas.length === 0) {
            alert("No hay subescalas con ítems disponibles.");
            return;
        }

        currentStep = 0;
        mostrarSubescalaCumanin(currentStep);
    }

    function mostrarSubescalaCumanin(step) {
        if (step < 0 || step >= subescalas.length) return;

        let subescala = subescalas[step];
        let contenido = `<h4>${subescala.sub_escala}</h4><p>${subescala.descripcion}</p><ul>`;

        subescala.items.forEach((item) => {
            contenido += `<li>${item.item}`;

            if (["Psicomotricidad", "Escritura", "Estructuración espacial", "Ritmo"].includes(subescala.sub_escala)) {
                contenido += `
                    <label>¿Con qué mano realizó la actividad?</label>
                    <input type="checkbox" name="lateralidad_${item.id}" value="derecha"> Derecha
                    <input type="checkbox" name="lateralidad_${item.id}" value="izquierda"> Izquierda
                `;
            } 
            
            if (subescala.sub_escala === "Atencion") {
                contenido += `
                    <input class="form-control" type="number" name="atencion_${item.id}">
                `;
            }

            contenido += `
                <input type="radio" name="respuesta_${item.id}" value="si"> Sí 
                <input type="radio" name="respuesta_${item.id}" value="no"> No
                </li>`;
        });

        contenido += `</ul>`;
        $("#contenidoPrueba").html(contenido);
        actualizarBotones(step);
    }

    function actualizarBotones(step) {
        $("#btnAnterior").toggle(step > 0);
        $("#btnSiguiente").toggle(step < subescalas.length - 1);
        $("#btnFinalizar").toggle(step === subescalas.length - 1);
    }

    $("#btnSiguiente").click(function () {
        currentStep++;
        mostrarSubescalaCumanin(currentStep);
    });

    $("#btnAnterior").click(function () {
        currentStep--;
        mostrarSubescalaCumanin(currentStep);
    });

    $("#btnFinalizar").click(function () {
        let respuestas = {};
        let lateralidad = {};

        $("input[type=radio]:checked").each(function () {
            let name = $(this).attr("name");
            respuestas[name] = $(this).val();
        });

        $("input[name^='lateralidad_']").each(function () {
            let itemId = $(this).attr("name").split("_")[1];
            if (!lateralidad[itemId]) {
                lateralidad[itemId] = [];
            }
            if ($(this).is(":checked")) {
                lateralidad[itemId].push($(this).val());
            }
        });

        $("input[type=number]").each(function () {
            let name = $(this).attr("name");
            respuestas[name] = $(this).val();
        });

        respuestas["lateralidad"] = lateralidad;

        // Enviar datos al backend
        $.ajax({
            url: "/aplicar-prueba/guardar",
            method: "POST",
            data: {
                paciente_id: $("#paciente_id").val(),
                prueba_id: $("#prueba_id").val(),
                respuestas: respuestas,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert("Prueba guardada correctamente.");
                $("#modalPrueba").modal("hide");
            },
            error: function (xhr, status, error) {
                console.error("Error al guardar la prueba:", error);
                alert("Hubo un error al guardar la prueba.");
            }
        });
    });

    window.iniciarPruebaCumanin = iniciarPruebaCumanin;
});

