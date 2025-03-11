async function verificarNuevaPrueba() {
    try {
        let response = await fetch('/api/ultima-prueba'); 
        let data = await response.json();

        if (data.prueba) {
            let pruebaId = data.prueba.id;
            let tipoPrueba = data.prueba.tipo;
            let nombrePrueba = data.prueba.nombre;

            console.log(`🔍 Nueva prueba detectada: ID ${pruebaId}, Tipo: ${tipoPrueba}, Nombre: ${nombrePrueba}`);

            analizarPrueba(pruebaId, tipoPrueba, nombrePrueba);
        }
    } catch (error) {
        console.error("❌ Error verificando nueva prueba:", error);
    }
}

setInterval(verificarNuevaPrueba, 10000);

async function analizarPrueba(pruebaId, tipoPrueba, nombrePrueba) {
    try {
        let response = await fetch(`/api/ver-respuestas-prueba/${pruebaId}`);
        let data = await response.json();

        if (!data.prueba) throw new Error("⚠️ No se encontraron datos de la prueba.");

        let paciente = data.paciente;
        let respuestas = data.prueba.resultados;
        let edadMeses = calcularEdadEnMeses(paciente.fecha_nacimiento);

        console.log(`📊 Analizando prueba ${nombrePrueba} (${tipoPrueba}) para paciente con ${edadMeses} meses`);

        let resultadosFinales = {};
        let lateralidad = null;
        let observaciones = respuestas.observaciones || "";

        if (tipoPrueba === "Estandarizada") {
            if (nombrePrueba === "CUMANIN") {
                resultadosFinales = await analizarCumanin(respuestas, edadMeses);
            } else if (nombrePrueba === "Koppitz") {
                resultadosFinales = await analizarKoppitz(respuestas, edadMeses);
            }
        } else if (tipoPrueba === "No Estandarizada") {
            resultadosFinales = respuestas; 
        }

        await guardarResultados(pruebaId, resultadosFinales, lateralidad, observaciones);

    } catch (error) {
        console.error("❌ Error analizando la prueba:", error);
    }
}
