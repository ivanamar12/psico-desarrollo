$(document).ready(function () {
    let subescalas = [];
    let respuestasTotales = {}; 
    let currentStep = 0;
    let tipoPrueba = ""; // Se inicializa correctamente
    let nombrePrueba = ""; // Variable para almacenar el nombre de la prueba

    function iniciarPruebaCumanin(subescalasData, tipo, nombre) {
        subescalas = subescalasData.filter(subescala => subescala.items && subescala.items.length > 0);
        tipoPrueba = tipo; // Se recibe el tipo de prueba como parámetro
        nombrePrueba = nombre; // Se recibe el nombre de la prueba como parámetro
        
        if (subescalas.length === 0) {
            alert("No hay subescalas con ítems disponibles.");
            return;
        }

        currentStep = 0;
        respuestasTotales = {}; 
        mostrarSubescala(currentStep);
    }

    function mostrarSubescala(step) {
        if (step < 0 || step >= subescalas.length) return;

        let subescala = subescalas[step];
        let contenido = `<h4>${subescala.sub_escala}</h4><p>${subescala.descripcion}</p>`;
        
        contenido += `<table class="table table-bordered">`;
        contenido += `<thead><tr><th>Ítem</th>`;

        if (["Psicomotricidad", "Escritura", "Estructuración espacial", "Ritmo"].includes(subescala.sub_escala)) {
            contenido += `<th>Lateralidad</th>`;
        } 
        
        if (subescala.sub_escala === "Atencion" || subescala.sub_escala === "Fluidez Verbal") {
            contenido += `<th>Valor</th>`;
        }

        contenido += `<th>Respuesta</th></tr></thead><tbody>`;

        subescala.items.forEach((item) => {
            let respuestaGuardada = respuestasTotales[subescala.sub_escala]?.respuestas?.[item.item] || "";
            let lateralidadGuardada = respuestasTotales[subescala.sub_escala]?.lateralidad?.[item.item] || [];

            contenido += `<tr><td>${item.item}</td>`;

            if (["Psicomotricidad", "Escritura", "Estructuración espacial", "Ritmo"].includes(subescala.sub_escala)) {
                contenido += `<td>
                    <label>Derecha <input type="checkbox" name="lateralidad_${item.id}" value="derecha" ${lateralidadGuardada.includes("derecha") ? "checked" : ""}></label>
                    <label>Izquierda <input type="checkbox" name="lateralidad_${item.id}" value="izquierda" ${lateralidadGuardada.includes("izquierda") ? "checked" : ""}></label>
                </td>`;
            } 
            
            if (subescala.sub_escala === "Atencion" || subescala.sub_escala === "Fluidez Verbal") {
                contenido += `<td><input class="form-control input-numerico" type="number" name="respuesta_${item.id}" min="0" value="${respuestaGuardada}"></td>`;
            } else {
                contenido += `<td>
                    <label>Sí <input type="radio" name="respuesta_${item.id}" value="si" ${respuestaGuardada === "si" ? "checked" : ""}></label>
                    <label>No <input type="radio" name="respuesta_${item.id}" value="no" ${respuestaGuardada === "no" ? "checked" : ""}></label>
                </td>`;
            }

            contenido += `</tr>`;
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
        let respuestas = {};
        let lateralidad = {};
        let subescala = subescalas[currentStep]; 

        let esCumanin = nombrePrueba === "CUMANIN"; // Verifica si la prueba es CUMANIN

        $(`input[type=radio]:checked`).each(function () {
            let name = $(this).attr("name");
            let itemId = name.split("_")[1];
            let itemNombre = subescala.items.find(i => i.id == itemId)?.item;

            if (!esCumanin && itemNombre) {
                respuestas[itemNombre] = $(this).val(); // Guarda el nombre del ítem si no es CUMANIN
            } else {
                respuestas[`respuesta_${itemId}`] = $(this).val(); // Guarda el ID si es CUMANIN
            }
        });

        $(`input[name^='lateralidad_']`).each(function () {
            let itemId = $(this).attr("name").split("_")[1];
            let itemNombre = subescala.items.find(i => i.id == itemId)?.item;

            if (!lateralidad[itemNombre]) {
                lateralidad[itemNombre] = [];
            }
            if ($(this).is(":checked")) {
                lateralidad[itemNombre].push($(this).val());
            }
        });

        $(`input[type=number]`).each(function () {
            let name = $(this).attr("name");
            let itemId = name.split("_")[1];
            let itemNombre = subescala.items.find(i => i.id == itemId)?.item;

            if (!esCumanin && itemNombre) {
                respuestas[itemNombre] = $(this).val(); // Guarda el nombre del ítem si no es CUMANIN
            } else {
                respuestas[`respuesta_${itemId}`] = $(this).val(); // Guarda el ID si es CUMANIN
            }
        });

        respuestasTotales[subescala.sub_escala] = {
            respuestas: respuestas,
            lateralidad: lateralidad
        };

        console.log("✅ Respuestas guardadas:", respuestasTotales);
    }
    
    $("#btnSiguiente").click(function () {
        guardarRespuestasActuales(); 
        currentStep++;
        mostrarSubescala(currentStep);
    });

    $("#btnAnterior").click(function () {
        guardarRespuestasActuales(); 
        currentStep--;
        mostrarSubescala(currentStep);
    });

    $("#btnFinalizar").off("click").on("click", function () {
        guardarRespuestasActuales(); 
    
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
                console.error("❌ Error al guardar la prueba:", error);
                toastr.error("Hubo un error al guardar la prueba.");
            }
        });
    });

    window.iniciarPruebaCumanin = iniciarPruebaCumanin;
});