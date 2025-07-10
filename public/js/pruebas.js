$(document).ready(function () {
    let subescalas = [];
    let respuestasTotales = {}; 
    let currentStep = 0;
    let tipoPrueba = ""; 
    let nombrePrueba = ""; 

    function sanitizarNombreSubescala(nombre) {
        return nombre.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
    }

    function iniciarPruebaCumanin(subescalasData, tipo, nombre) {
        subescalas = subescalasData.filter(subescala => subescala.items && subescala.items.length > 0);
        tipoPrueba = tipo;
        nombrePrueba = nombre;
        
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
        let idSanitizado = sanitizarNombreSubescala(subescala.sub_escala);
        
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
        
        // Agregar campo de observaciones con ID sanitizado
        let observacionesGuardadas = respuestasTotales[subescala.sub_escala]?.observaciones || "";
        contenido += `<div class="form-group">
            <label for="observaciones_${idSanitizado}">Observaciones: <span class="text-danger">*</span></label>
            <textarea class="form-control observaciones" id="observaciones_${idSanitizado}" name="observaciones_${idSanitizado}" rows="3" required>${observacionesGuardadas}</textarea>
        </div>`;
        
        $("#contenidoPrueba").html(contenido);
        actualizarBotones(step);
    }

    function actualizarBotones(step) {
        $("#btnAnterior").toggle(step > 0);
        $("#btnSiguiente").toggle(step < subescalas.length - 1);
        $("#btnFinalizar").toggle(step === subescalas.length - 1);

        // Actualizar barra de progreso
        let progreso = ((step + 1) / subescalas.length) * 100;
        $("#barraProgreso").css("width", progreso + "%").attr("aria-valuenow", progreso);
        $("#progresoTexto").text(`Paso ${step + 1} de ${subescalas.length}`);
    }

    function validarObservaciones() {
        let subescala = subescalas[currentStep];
        let idSanitizado = sanitizarNombreSubescala(subescala.sub_escala);
        let campoObservaciones = $(`#observaciones_${idSanitizado}`);
        
        if (campoObservaciones.length === 0) {
            console.warn("Campo de observaciones no encontrado:", `observaciones_${idSanitizado}`);
            return true;
        }
        
        let observaciones = campoObservaciones.val().trim();
        
        if (!observaciones) {
            toastr.error("Por favor, complete las observaciones antes de continuar.", "Campo obligatorio");
            return false;
        } else {
            return true;
        }
    }

    function guardarRespuestasActuales() {
        let respuestas = {};
        let lateralidad = {};
        let observaciones = "";
        let subescala = subescalas[currentStep]; 

        let esCumanin = nombrePrueba === "CUMANIN";

        $(`input[type=radio]:checked`).each(function () {
            let name = $(this).attr("name");
            let itemId = name.split("_")[1];
            let itemNombre = subescala.items.find(i => i.id == itemId)?.item;

            if (!esCumanin && itemNombre) {
                respuestas[itemNombre] = $(this).val();
            } else {
                respuestas[`respuesta_${itemId}`] = $(this).val();
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
                respuestas[itemNombre] = $(this).val();
            } else {
                respuestas[`respuesta_${itemId}`] = $(this).val();
            }
        });

        // Guardar observaciones con ID sanitizado
        let idSanitizado = sanitizarNombreSubescala(subescala.sub_escala);
        let campoObservaciones = $(`#observaciones_${idSanitizado}`);
        if (campoObservaciones.length > 0) {
            observaciones = campoObservaciones.val().trim();
        }

        respuestasTotales[subescala.sub_escala] = {
            respuestas: respuestas,
            lateralidad: lateralidad,
            observaciones: observaciones
        };

        console.log("✅ Respuestas y observaciones guardadas:", respuestasTotales);
    }
    
    $("#btnSiguiente").click(function () {
        if (validarObservaciones()) {
            guardarRespuestasActuales(); 
            currentStep++;
            mostrarSubescala(currentStep);
        }
    });

    $("#btnAnterior").click(function () {
        if (validarObservaciones()) {
            guardarRespuestasActuales(); 
            currentStep--;
            mostrarSubescala(currentStep);
        }
    });

    $("#btnFinalizar").off("click").on("click", function () {
        if (validarObservaciones()) {
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
        }
    });

    window.iniciarPruebaCumanin = iniciarPruebaCumanin;
});