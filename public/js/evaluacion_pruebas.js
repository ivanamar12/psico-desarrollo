function calcularEdadEnMeses(fechaNacimiento) {
    let fechaNac = new Date(fechaNacimiento);
    let hoy = new Date();

    let edadAnios = hoy.getFullYear() - fechaNac.getFullYear();
    let edadMeses = hoy.getMonth() - fechaNac.getMonth();

    if (hoy.getDate() < fechaNac.getDate()) {
        edadMeses--; 
    }

    edadMeses += edadAnios * 12; 
    return edadMeses;
}

async function verificarNuevaPrueba() {
    try {
        let response = await fetch('/api/ultima-prueba'); 
        let data = await response.json();

        if (!data.prueba) {
            console.log("ℹ️ No hay nuevas pruebas registradas.");
            return;
        }

        let pruebaId = data.prueba.id;
        let tipoPrueba = data.prueba.tipo;
        let nombrePrueba = data.prueba.nombre;

        console.log(`🔍 Nueva prueba detectada: ID ${pruebaId}, Tipo: ${tipoPrueba}, Nombre: ${nombrePrueba}`);

        // 📌 Iniciar el análisis automáticamente
        await analizarPrueba(pruebaId, tipoPrueba, nombrePrueba);

    } catch (error) {
        console.error("❌ Error verificando nueva prueba:", error);
    }
}

// 📌 Llamar a `verificarNuevaPrueba()` solo cuando sea necesario
document.addEventListener("DOMContentLoaded", verificarNuevaPrueba);


setInterval(verificarNuevaPrueba, 10000);

async function obtenerBaremos() {
    try {
        let response = await fetch('/api/baremos'); // 📌 Asegúrate de que esta API existe en Laravel
        let data = await response.json();
        return data;
    } catch (error) {
        console.error("❌ Error obteniendo los baremos:", error);
        return [];
    }
}

async function analizarPrueba(pruebaId, tipoPrueba, nombrePrueba) {
    try {
        let response = await fetch(`/api/ver-respuestas-prueba/${pruebaId}`);
        let data = await response.json();

        if (!data.prueba) throw new Error("⚠️ No se encontraron datos de la prueba.");

        let paciente = data.paciente;
        let respuestas = data.prueba.resultados;
        let edadMeses = calcularEdadEnMeses(paciente.fecha_nac);
        let generoId = paciente.genero_id; 

        console.log(`📊 Analizando prueba ${nombrePrueba} (${tipoPrueba}) para paciente con ${edadMeses} meses y género ID ${generoId}`);

        let resultadosFinales = {};
        let lateralidad = null;
        let observaciones = respuestas.observaciones || "";

        if (tipoPrueba === "Estandarizada") {
            if (nombrePrueba === "CUMANIN") {
                resultadosFinales = await analizarCumanin(respuestas, edadMeses);
            } else if (nombrePrueba === "Koppitz") {
                resultadosFinales = await analizarKoppitz(respuestas, edadMeses, generoId);
            }
        } else if (tipoPrueba === "NO-Estandarizada") {
            resultadosFinales = respuestas; 
        }

        await guardarResultados(pruebaId, resultadosFinales, lateralidad, observaciones);

    } catch (error) {
        console.error("❌ Error analizando la prueba:", error);
    }
}
// 📌 Agregar esta función antes de `analizarCumanin()`
async function obtenerSubescalas() {
    try {
        let response = await fetch('/api/subescalas'); // 📌 Asegúrate de que esta API existe en Laravel
        let data = await response.json();

        // 📌 Convertir la lista de subescalas en un diccionario { nombre: id }
        let subescalasMap = {};
        data.forEach(subescala => {
            subescalasMap[subescala.sub_escala] = subescala.id;
        });

        return subescalasMap;
    } catch (error) {
        console.error("❌ Error obteniendo las subescalas:", error);
        return {};
    }
}

// 📌 `obtenerSubescalas()` debe ir antes de `analizarCumanin()`
async function analizarCumanin(respuestas, edadMeses) {
    let baremos = await obtenerBaremos();
    let subescalasMap = await obtenerSubescalas(); 
    let puntajes = {};
    let lateralidad = { izquierda: 0, derecha: 0 };

    for (let subescala in respuestas) {
        let respuestasSubescala = respuestas[subescala];

        if (subescala === "lateralidad") {
            respuestasSubescala.forEach(resp => {
                if (resp === "Izquierda") lateralidad.izquierda++;
                if (resp === "Derecha") lateralidad.derecha++;
            });
        } else if (
            !(edadMeses < 60 && (subescala === "Lectura" || subescala === "Escritura")) // 📌 Excluir lectura y escritura si < 60 meses
        ) {
            let puntaje = Object.values(respuestasSubescala.respuestas).filter(resp => resp === "si").length;
            puntajes[subescala] = puntaje;
        }
    }

    // 📌 Determinar la lateralidad final
    let resultadoLateralidad = null;
    if (lateralidad.izquierda > lateralidad.derecha) {
        resultadoLateralidad = "Izquierda";
    } else if (lateralidad.derecha > lateralidad.izquierda) {
        resultadoLateralidad = "Derecha";
    } else {
        resultadoLateralidad = "Indefinida"; // En caso de empate
    }

    // 📌 Comparar con los baremos
    let resultadosFinales = {};
    for (let subescala in puntajes) {
        let puntaje = puntajes[subescala];

        let baremo = baremos.find(b => {
            if (b.sub_escala !== subescala) return false;

            let rangoEdad = b.edad_meses.split('-').map(n => parseInt(n));
            let minEdad = rangoEdad[0];
            let maxEdad = rangoEdad[1] || minEdad;

            let rangoPuntos = b.puntos.split('-').map(n => parseInt(n));
            let minPuntaje = Math.min(...rangoPuntos);
            let maxPuntaje = Math.max(...rangoPuntos);

            return (
                edadMeses >= minEdad && edadMeses <= maxEdad &&
                puntaje >= minPuntaje && puntaje <= maxPuntaje
            );
        });

        resultadosFinales[subescala] = baremo ? {
            puntaje: puntaje,
            percentil: baremo.p_c
        } : { puntaje: puntaje, error: "Baremo no encontrado" };
    }

    return { 
        edad_meses: edadMeses,
        resultados: resultadosFinales,
        lateralidad: resultadoLateralidad  // 📌 Ahora sí se enviará la lateralidad correctamente
    };
}

async function analizarKoppitz(respuestas, edadMeses, generoId) {
    let baremos = await obtenerBaremos();
    let subescalaNombre = "Dibujo de Figura Humana";

    let puntajeTotal = 0;
    let detallesPuntaje = {};

    // 📌 Verificar que la subescala existe en las respuestas
    if (!respuestas[subescalaNombre] || !respuestas[subescalaNombre].respuestas) {
        console.error(`⚠️ No se encontraron respuestas para la subescala '${subescalaNombre}'`);
        return { error: "No se encontraron respuestas para la subescala" };
    }

    for (let caracteristica in respuestas[subescalaNombre].respuestas) {
        let respuesta = respuestas[subescalaNombre].respuestas[caracteristica];

        let baremo = baremos.find(b => {
            if (b.sub_escala !== subescalaNombre) return false;

            let rangoEdad = b.edad_meses.split('-').map(n => parseInt(n));
            let minEdad = rangoEdad[0];
            let maxEdad = rangoEdad[1] || minEdad;

            return (
                edadMeses >= minEdad && edadMeses <= maxEdad &&
                b.puntos === respuesta &&
                (b.p_c.includes("masculino") ? generoId === 1 : generoId === 2)
            );
        });

        if (baremo) {
            detallesPuntaje[caracteristica] = baremo.p_c;
            puntajeTotal++;
        }
    }

    // 📌 Determinar la categoría según el puntaje total
    let categoria = "";
    if (puntajeTotal >= 7) categoria = "Normal alto a superior (CI de 110 o más)";
    else if (puntajeTotal === 6) categoria = "Normal a superior (CI 90 - 135)";
    else if (puntajeTotal === 5) categoria = "Normal a normal alto (CI 85 - 120)";
    else if (puntajeTotal === 4) categoria = "Normal a normal bajo (CI 80 - 110)";
    else if (puntajeTotal === 3) categoria = "Normal bajo (CI 70 - 90)";
    else if (puntajeTotal === 2) categoria = "Bordeline (CI 60 - 80)";
    else categoria = "Mentalmente deficiente por posibles problemas emocionales";

    return {
        edad_meses: edadMeses, // 📌 Ahora sí se envía correctamente
        resultados: {
            puntajeTotal: puntajeTotal,
            detallesPuntaje: detallesPuntaje,
            categoria: categoria
        }
    };
}

async function guardarResultados(pruebaId, resultados, lateralidad, observaciones) {
    try {
        let response = await fetch('/api/guardar-resultados', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                prueba_id: pruebaId,
                resultados: resultados.resultados,  // 📌 Solo enviamos los resultados
                edad_meses: resultados.edad_meses, // 📌 Enviamos la edad en meses
                lateralidad: resultados.lateralidad, 
                observaciones: observaciones
            })
        });

        let data = await response.json();
        if (data.error) {
            console.error("❌ Error al guardar resultados:", data.error);
        } else {
            console.log("✅ Resultados guardados correctamente:", data.mensaje);
        }

    } catch (error) {
        console.error("❌ Error en la solicitud al backend:", error);
    }
}

