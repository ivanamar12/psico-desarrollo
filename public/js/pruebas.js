$(document).ready(function () {
    let subescalas = [];
    let currentStep = 0;
    let respuestasTotales = {}; 
    function iniciarPruebaCumanin(subescalasData) {
        subescalas = subescalasData.filter(subescala => subescala.items && subescala.items.length > 0);
        
        if (subescalas.length === 0) {
            alert("No hay subescalas con ítems disponibles.");
            return;
        }

        currentStep = 0;
        respuestasTotales = {}; 
        mostrarSubescalaCumanin(currentStep);
    }

    function mostrarSubescalaCumanin(step) {
        if (step < 0 || step >= subescalas.length) return;

        let subescala = subescalas[step];
        let contenido = `<h4>${subescala.sub_escala}</h4><p>${subescala.descripcion}</p>`;
        
        contenido += `<table class="table table-bordered">`;
        contenido += `<thead><tr><th>Ítem</th>`;

        if (["Psicomotricidad", "Escritura", "Estructuración espacial", "Ritmo"].includes(subescala.sub_escala)) {
            contenido += `<th>Lateralidad</th>`;
        } 
        
        if (subescala.sub_escala === "Atencion") {
            contenido += `<th>Número de cuadros marcados</th>`;
        }

        contenido += `<th>Respuesta</th></tr></thead><tbody>`;

        subescala.items.forEach((item) => {
            contenido += `<tr><td>${item.item}</td>`;

            if (["Psicomotricidad", "Escritura", "Estructuración espacial", "Ritmo"].includes(subescala.sub_escala)) {
                contenido += `<td>
                    <label>Derecha <input type="checkbox" name="lateralidad_${item.id}" value="derecha"></label>
                    <label>Izquierda <input type="checkbox" name="lateralidad_${item.id}" value="izquierda"></label>
                </td>`;
            } 
            
            if (subescala.sub_escala === "Atencion") {
                contenido += `<td><input class="form-control" type="number" name="atencion_${item.id}"></td>`;
            }

            contenido += `<td>
                <label>Sí <input type="radio" name="respuesta_${item.id}" value="si"></label>
                <label>No <input type="radio" name="respuesta_${item.id}" value="no"></label>
            </td></tr>`;
        });

        contenido += `</tbody></table>`;
        $("#contenidoPrueba").html(contenido);
        actualizarBotonesC(step);
    }

    function actualizarBotonesC(step) {
        $("#btnAnterior").toggle(step > 0);
        $("#btnSiguiente").toggle(step < subescalas.length - 1);
        $("#btnFinalizar").toggle(step === subescalas.length - 1);
    }

    function guardarRespuestasActuales() {
        let respuestas = {};
        let lateralidad = {};

        $(`input[type=radio]:checked`).each(function () {
            let name = $(this).attr("name");
            respuestas[name] = $(this).val();
        });

        $(`input[name^='lateralidad_']`).each(function () {
            let itemId = $(this).attr("name").split("_")[1];
            if (!lateralidad[itemId]) {
                lateralidad[itemId] = [];
            }
            if ($(this).is(":checked")) {
                lateralidad[itemId].push($(this).val());
            }
        });

        $(`input[type=number]`).each(function () {
            let name = $(this).attr("name");
            respuestas[name] = $(this).val();
        });

        respuestasTotales[subescalas[currentStep].sub_escala] = {
            respuestas: respuestas,
            lateralidad: lateralidad
        };

        console.log("Respuestas guardadas:", respuestasTotales); 
    }
    $("#btnSiguiente").click(function () {
        guardarRespuestasActuales(); 
        currentStep++;
        mostrarSubescalaCumanin(currentStep);
    });
    $("#btnAnterior").click(function () {
        guardarRespuestasActuales(); 
        currentStep--;
        mostrarSubescalaCumanin(currentStep);
    });
    $("#btnFinalizar").click(function () {
        guardarRespuestasActuales(); 
        console.log("Respuestas finales:", respuestasTotales); 
    
        $.ajax({
            url: "/aplicar-prueba/guardar",
            method: "POST",
            data: {
                paciente_id: $("#paciente_id").val(),
                prueba_id: $("#prueba_id").val(),
                respuestas: respuestasTotales, 
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                toastr.success("Prueba guardada correctamente.");
                $("#modalPrueba").modal("hide");
    
                window.location.reload(); 
            },
            error: function (xhr, status, error) {
                console.error("Error al guardar la prueba:", error);
                toastr.error("Hubo un error al guardar la prueba.");
            }
        });
    });
    window.iniciarPruebaCumanin = iniciarPruebaCumanin;
});