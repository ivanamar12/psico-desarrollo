function sanitizarNombreSubescala(nombre) {
    return nombre.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
}

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

        await analizarPrueba(pruebaId, tipoPrueba, nombrePrueba);

    } catch (error) {
        console.error("❌ Error verificando nueva prueba:", error);
    }
}

document.addEventListener("DOMContentLoaded", verificarNuevaPrueba);

setInterval(verificarNuevaPrueba, 10000);

async function obtenerBaremos() {
    try {
        let response = await fetch('/api/baremos'); 
        let data = await response.json();
        return data;
    } catch (error) {
        console.error("❌ Error obteniendo los baremos:", error);
        return [];
    }
}

async function obtenerSubescalas() {
    try {
        let response = await fetch('/api/subescalas'); 
        let data = await response.json();

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

async function analizarPrueba(pruebaId, tipoPrueba, nombrePrueba) {
    try {
        let response = await fetch(`/api/obtener-respuestas-prueba/${pruebaId}`);
        let data = await response.json();

        if (!data.prueba) throw new Error("⚠️ No se encontraron datos de la prueba.");

        let paciente = data.paciente;
        let edadMeses = calcularEdadEnMeses(paciente.fecha_nac);
        let generoId = paciente.genero_id;

        console.log(`📊 Analizando prueba ${nombrePrueba} (${tipoPrueba}) para paciente con ${edadMeses} meses y género ID ${generoId}`);

        let resultadosFinales = {};
        let observacionesGenerales = data.prueba.observaciones || ""; 
        let observacionesPorSubescala = {};

        let respuestas = data.prueba.resultados; 

        for (let subescala in respuestas) {
            if (respuestas[subescala].observaciones) {
                observacionesPorSubescala[subescala] = respuestas[subescala].observaciones;
            }
        }

        if (tipoPrueba === "Estandarizada") {
            if (nombrePrueba === "CUMANIN") {
                resultadosFinales = await analizarCumanin(respuestas, edadMeses, observacionesPorSubescala);
            } else if (nombrePrueba === "Koppitz") {
                resultadosFinales = await analizarKoppitz(respuestas, edadMeses, generoId, observacionesPorSubescala);
            }
        } else if (tipoPrueba === "NO-Estandarizada") {
            resultadosFinales = {
                edad_meses: edadMeses,
                resultados: respuestas, 
                lateralidad: null, 
                observaciones: observacionesGenerales
            };
        }

        await guardarResultados(pruebaId, resultadosFinales, null, observacionesGenerales);

    } catch (error) {
        console.error("❌ Error analizando la prueba:", error);
    }
}

async function analizarCumanin(respuestas, edadMeses, observacionesPorSubescala) {
    let baremos = await obtenerBaremos();
    let puntajes = {};
    let lateralidad = { izquierda: 0, derecha: 0 };

    console.log("📋 Respuestas recibidas:", respuestas); 

    for (let subescala in respuestas) {
        let respuestasSubescala = respuestas[subescala];

        if (subescala === "lateralidad") {
            respuestasSubescala.forEach(resp => {
                if (resp === "Izquierda") lateralidad.izquierda++;
                if (resp === "Derecha") lateralidad.derecha++;
            });
        } else if (
            !(edadMeses < 60 && (subescala === "Lectura" || subescala === "Escritura")) 
        ) {
            if (subescala === "Atencion" || subescala === "Fluidez Verbal") {
                let sumaTotal = 0;
                for (let key in respuestasSubescala.respuestas) {
                    let valor = parseInt(respuestasSubescala.respuestas[key]);
                    if (!isNaN(valor)) {
                        sumaTotal += valor;
                    }
                }
                puntajes[subescala] = sumaTotal;
                console.log(`📊 ${subescala}: ${sumaTotal}`);
            } else {
                let puntaje = Object.values(respuestasSubescala.respuestas).filter(resp => resp === "si").length;
                puntajes[subescala] = puntaje;
            }
        }
    }

    let desarrolloVerbal =
        (puntajes["Lenguaje Articulatorio"] || 0) +
        (puntajes["Lenguaje Expresivo"] || 0) +
        (puntajes["Lenguaje Comprensivo"] || 0);

    let desarrolloNoVerbal =
        (puntajes["Psicomotricidad"] || 0) +
        (puntajes["Estructuración Espacial"] || 0) +
        (puntajes["Visopercepción"] || 0) +
        (puntajes["Memoria Iconica"] || 0) +
        (puntajes["Ritmo"] || 0);

    let desarrolloGlobal = desarrolloVerbal + desarrolloNoVerbal;

    puntajes["Desarrollo Verbal"] = desarrolloVerbal;
    puntajes["Desarrollo no Verbal"] = desarrolloNoVerbal;
    puntajes["Desarrollo Global"] = desarrolloGlobal;

    let resultadoLateralidad = null;
    if (lateralidad.izquierda > lateralidad.derecha) {
        resultadoLateralidad = "Izquierda";
    } else if (lateralidad.derecha > lateralidad.izquierda) {
        resultadoLateralidad = "Derecha";
    } else {
        resultadoLateralidad = "Indefinida";
    }

    let resultadosFinales = {};
    
    for (let subescala in puntajes) {
        let puntaje = puntajes[subescala];

        let baremosCoincidentes = baremos.filter(b => {
            if (b.sub_escala !== subescala) return false;

            let rangoEdad = b.edad_meses.split('-').map(n => parseInt(n.trim()));
            let minEdad = rangoEdad[0];
            let maxEdad = rangoEdad[1] || minEdad;

            let rangoPuntos = b.puntos.includes('-') 
                ? b.puntos.split('-').map(n => parseInt(n.trim()))
                : [parseInt(b.puntos.trim())];

            let minPuntaje = Math.min(...rangoPuntos);
            let maxPuntaje = Math.max(...rangoPuntos);

            return (
                edadMeses >= minEdad && edadMeses <= maxEdad &&
                puntaje >= minPuntaje && puntaje <= maxPuntaje
            );
        });

        if (baremosCoincidentes.length > 0) {
            resultadosFinales[subescala] = {
                puntaje: puntaje,
                percentil: baremosCoincidentes[0].p_c,
                observaciones: observacionesPorSubescala[subescala] || "Sin observaciones"
            };
        } else {
            resultadosFinales[subescala] = {
                puntaje: puntaje,
                percentil: "No disponible",
                observaciones: observacionesPorSubescala[subescala] || "Sin observaciones"
            };
        }
    }

    return {
        edad_meses: edadMeses,
        resultados: resultadosFinales,
        lateralidad: resultadoLateralidad,
        observaciones: observacionesPorSubescala
    };
}

async function analizarKoppitz(respuestas, edadMeses, generoId, observacionesPorSubescala) {
    let baremos = await obtenerBaremos();
    let subescalaNombre = "Dibujo de Figura Humana";

    if (respuestas[subescalaNombre]) {
        observacionesPorSubescala[subescalaNombre] = respuestas[subescalaNombre].observaciones || "Sin observaciones";
    }

    let puntajeTotal = 8; 
    let detallesPuntaje = {};
    let itemsExcepcionales = 0; 

    if (!respuestas[subescalaNombre] || !respuestas[subescalaNombre].respuestas) {
        console.error(`⚠️ No se encontraron respuestas para la subescala '${subescalaNombre}'`);
        return { error: "No se encontraron respuestas para la subescala" };
    }

    for (let itemNombre in respuestas[subescalaNombre].respuestas) {
        let respuesta = respuestas[subescalaNombre].respuestas[itemNombre]; 

        let baremo = baremos.find(b => {
            if (b.sub_escala !== subescalaNombre) return false;

            let rangoEdad = b.edad_meses.split('-').map(n => parseInt(n));
            let minEdad = rangoEdad[0];
            let maxEdad = rangoEdad[1] || minEdad;

            let esMasculino = b.p_c.includes("masculino");
            let esFemenino = b.p_c.includes("femenino");

            let esParaAmbosGeneros = !esMasculino && !esFemenino;
            let generoCoincide = (esMasculino && generoId === 1) || (esFemenino && generoId === 2);

            return (
                edadMeses >= minEdad && edadMeses <= maxEdad &&
                b.p_c === itemNombre &&
                (esParaAmbosGeneros || generoCoincide) 
            );
        });

        if (baremo) {
            detallesPuntaje[itemNombre] = baremo.p_c;

            if (baremo.puntos === "esperado" && respuesta === "no") {
                puntajeTotal--; 
            } else if (baremo.puntos === "excepcional" && respuesta === "si") {
                itemsExcepcionales++; 
            }
        }
    }

    let categoria = "";
    if (puntajeTotal >= 7) categoria = "Normal alto a superior (CI de 110 o más)";
    else if (puntajeTotal === 6) categoria = "Normal a superior (CI 90 - 135)";
    else if (puntajeTotal === 5) categoria = "Normal a normal alto (CI 85 - 120)";
    else if (puntajeTotal === 4) categoria = "Normal a normal bajo (CI 80 - 110)";
    else if (puntajeTotal === 3) categoria = "Normal bajo (CI 70 - 90)";
    else if (puntajeTotal === 2) categoria = "Bordeline (CI 60 - 80)";
    else categoria = "Mentalmente deficiente por posibles problemas emocionales";

    return {
        edad_meses: edadMeses, 
        resultados: {
            puntajeTotal: puntajeTotal,
            detallesPuntaje: detallesPuntaje,
            categoria: categoria,
            itemsExcepcionales: itemsExcepcionales,
            observaciones: observacionesPorSubescala[subescalaNombre] || "Sin observaciones"
        }
    };
}

async function guardarResultados(pruebaId, resultados, lateralidad, observacionesGenerales) {
    try {
        let resultadosConObservaciones = {};

        if (resultados.resultados) {
            for (let subescala in resultados.resultados) {
                resultadosConObservaciones[subescala] = {
                    ...resultados.resultados[subescala],
                    observaciones: resultados.observaciones[subescala] || "Sin observaciones"
                };
            }
        } else {
            resultadosConObservaciones = resultados.resultados;
        }

        let response = await fetch('/api/guardar-resultados', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                prueba_id: pruebaId,
                resultados: resultadosConObservaciones,
                edad_meses: resultados.edad_meses,
                lateralidad: resultados.lateralidad,
                observaciones: observacionesGenerales
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