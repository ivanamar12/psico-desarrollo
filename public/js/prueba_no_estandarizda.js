$(document).ready(function () {
    let items = [];
    let currentStep = 0;
    
    function iniciarPruebaNoEstandarizada(itemsData) {
        items = itemsData;
        if (items.length === 0) {
            alert("No hay ítems disponibles para esta prueba.");
            return;
        }
        currentStep = 0;
        mostrarItem(currentStep);
    }
    
    function mostrarItem(step) {
        if (step < 0 || step >= items.length) return;
        
        let item = items[step];
        let contenido = `<h4>Pregunta ${step + 1}:</h4><p>${item.item}</p>`;
        contenido += `
            <input type="radio" name="respuesta_${item.id}" value="si"> Sí 
            <input type="radio" name="respuesta_${item.id}" value="no"> No
        `;
        
        $("#contenidoPrueba").html(contenido);
        actualizarBotones(step);
    }
    
    function actualizarBotones(step) {
        $("#btnAnterior").toggle(step > 0);
        $("#btnSiguiente").toggle(step < items.length - 1);
        $("#btnFinalizar").toggle(step === items.length - 1);
    }
    
    $("#btnSiguiente").click(function () {
        currentStep++;
        mostrarItem(currentStep);
    });
    
    $("#btnAnterior").click(function () {
        currentStep--;
        mostrarItem(currentStep);
    });
    
    $("#btnFinalizar").click(function () {
        let respuestas = {};
        $("input[type=radio]:checked").each(function () {
            let name = $(this).attr("name");
            respuestas[name] = $(this).val();
        });
        
        let pacienteId = $("#paciente_id").val();
        let pruebaId = $("#prueba_id").val();
        
        $.ajax({
            url: "/aplicar-prueba/guardar",
            method: "POST",
            data :  { 
                paciente_id :  pacienteId , 
                prueba_id :  pruebaId , 
                respuestas :  respuestas , 
                _token :  $ ( "meta[name='csrf-token']" ) . attr ( "content" ) 
            } , 
            success :  function  ( response )  { 
                alert ( "Prueba guardada correctamente." );
                $("#modalPrueba").modal("hide");
            },
            error: function (xhr) {
                alert("Error al guardar la prueba.");
            }
        });
    });
    
    window.iniciarPruebaNoEstandarizada = iniciarPruebaNoEstandarizada;
});
