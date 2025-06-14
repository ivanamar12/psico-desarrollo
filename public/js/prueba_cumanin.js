$(document).ready(function () {
    let subescalas = [];
    let currentStep = 0;
    let respuestasCompletas = {}; 

    function iniciarPruebaCumanin(subescalasData, edadEnMeses) {
        if (!subescalasData || subescalasData.length === 0) {
            alert("No se recibieron datos de subescalas.");
            return;
        }

        subescalas = subescalasData.filter(subescala => subescala.items && subescala.items.length > 0);
        
        if (subescalas.length === 0) {
            alert("No hay subescalas con ítems disponibles.");
            return;
        }

        currentStep = 0; 
        respuestasCompletas = {}; 
        mostrarSubescalaCumanin(currentStep, edadEnMeses); 
    }

    function mostrarSubescalaCumanin(step, edadEnMeses) {
        if (step < 0 || step >= subescalas.length) {
            console.error("El paso está fuera de los límites:", step);
            return;
        }
    
        let subescala = subescalas[step];
        if (!subescala) {
            console.error("Subescala no encontrada para el paso:", step);
            return;
        }

        let contenido = `<h4>${subescala.sub_escala}</h4><p>${subescala.descripcion}</p>`;
        contenido += `<table class="table table-bordered"><thead><tr><th>Ítem</th><th>Opciones</th><th>¿Con qué mano realizó la actividad?</th></tr></thead><tbody>`;
    
        subescala.items.forEach((item) => {
            contenido += `<tr><td>${item.item}</td><td>`;
            contenido += `
                <input type="radio" name="respuesta_${item.id}" value="si"> Sí 
                <input type="radio" name="respuesta_${item.id}" value="no"> No
                </td><td>`;
    
            if (["Psicomotricidad", "Escritura", "Estructuración espacial", "Ritmo"].includes(subescala.sub_escala)) {
                contenido += `
                    <input type="checkbox" name="lateralidad_${item.id}" value="derecha"> Derecha
                    <input type="checkbox" name="lateralidad_${item.id}" value="izquierda"> Izquierda
                `;
            } else {
                contenido += "N/A"; 
            }
    
            contenido += `</td></tr>`;
        });
    
        contenido += `</tbody></table>`;
        $("#contenidoPrueba").html(contenido);
        actualizarBotones(step);
    }

    function actualizarBotones(step) {
        $("#btnAnterior").toggle(step > 0);
        $("#btnSiguiente").toggle(step < subescalas.length - 1);
        $("#btnFinalizar").toggle(step === subescalas.length - 1);
    }

    function guardarRespuestasActuales() {
        console.log("Guardando respuestas. Current Step:", currentStep);
        console.log("Subescalas:", subescalas);
        
        if (currentStep < 0 || currentStep >= subescalas.length) {
            console.error("No se puede guardar respuestas, paso fuera de los límites:", currentStep);
            return;
        }

        let subescala = subescalas[currentStep];
        if (!subescala) {
            console.error("No se puede guardar respuestas, subescala no encontrada para el paso:", currentStep);
            return;
        }

        let subescalaId = subescala.id; 
        if (!respuestasCompletas[subescalaId]) {
            respuestasCompletas[subescalaId] = { sub_escala: subescala.sub_escala, respuestas: {} };
        }

        let respuestas = respuestasCompletas[subescalaId].respuestas || {};
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
        respuestasCompletas[subescalaId].respuestas = respuestas;

        console.log("Respuestas completas hasta ahora:", respuestasCompletas);
    }

    $("#btnSiguiente").off("click").on("click", function () {
        guardarRespuestasActuales(); 
        if (currentStep < subescalas.length - 1) {
            currentStep++;
            console.log("Current Step (Siguiente):", currentStep);
            mostrarSubescalaCumanin(currentStep, sharedData.edadEnMeses); 
        }
    });

    $("#btnAnterior").off("click").on("click", function () {
        guardarRespuestasActuales(); 
        if (currentStep > 0) {
            currentStep--;
            console.log("Current Step (Anterior):", currentStep); 
            mostrarSubescalaCumanin(currentStep, sharedData.edadEnMeses); 
        }
    });

    $("#btnFinalizar").off("click").on("click", function () {
        guardarRespuestasActuales();
        console.log("Enviando respuestas al servidor:", respuestasCompletas);
    
        $.ajax({
            url: "/aplicar-prueba/guardar",
            method: "POST",
            data: {
                paciente_id: $("#paciente_id").val(),
                prueba_id: $("#prueba_id").val(),
                respuestas: respuestasCompletas,
                edad_en_meses: sharedData.edadEnMeses,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $("#modalPrueba").modal("hide");
                $("#contenidoPrueba").html("");
                $("#paciente_id").val("");
                $("#prueba_id").val("");
                toastr.success("Prueba guardada correctamente.");
                setTimeout(function () {
                    location.reload();
                }, 1500);
            },
            error: function (xhr, status, error) {
                console.error("Error al guardar la prueba:", error);
                toastr.error("Hubo un error al guardar la prueba.");
            }
        });
    });    

    window.iniciarPruebaCumanin = iniciarPruebaCumanin;
});