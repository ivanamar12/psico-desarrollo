function validarDatos(datos) {
    if (!datos.paciente || !datos.prueba) {
        throw new Error('Faltan campos obligatorios en los datos.');
    }
    if (!datos.prueba.resultados) {
        throw new Error('Faltan resultados en los datos de la prueba.');
    }
    // Agrega más validaciones según sea necesario
}

async function verificarNuevaPrueba() {
    try {
        // Obtener la última prueba
        let response = await fetch('/api/ultima-prueba'); 
        if (!response.ok) {
            throw new Error('Error al obtener la última prueba: ' + response.statusText);
        }
        let data = await response.json();

        if (!data.prueba) {
            console.log("ℹ️ No hay nuevas pruebas registradas.");
            return;
        }

        // Datos de la prueba
        let pruebaId = data.prueba.id;
        let tipoPrueba = data.prueba.tipo;
        let nombrePrueba = data.prueba.nombre;

        console.log(`🔍 Nueva prueba detectada: ID ${pruebaId}, Tipo: ${tipoPrueba}, Nombre: ${nombrePrueba}`);

        // Construir los datos a enviar
        let datosEnviar = {
            paciente: {
                id: 1, // Ajusta según la estructura de tus datos
                nombre: "Bgfhg",
                fecha_nac: "2020-06-11",
                genero_id: 1
            },
            prueba: {
                id: pruebaId,
                nombre: nombrePrueba,
                resultados: data.prueba.resultados // Asegúrate de que esto esté en el formato correcto
            },
            fecha_aplicacion: "15/07/2025" // Ajusta según la estructura de tus datos
        };

        // Validar los datos antes de enviar
        validarDatos(datosEnviar);

        // Procesar la nueva prueba
        let procesarResponse = await fetch('/api/verificar-nueva-prueba', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datosEnviar)
        });

        // Verificar la respuesta del servidor
        if (!procesarResponse.ok) {
            throw new Error('La respuesta del servidor no es válida: ' + procesarResponse.statusText);
        }

        let procesarResultado = await procesarResponse.json();
        console.log(procesarResultado.mensaje);

    } catch (error) {
        console.error("❌ Error verificando nueva prueba:", error);
    }
}

// Ejecutar la función cada 10 segundos
document.addEventListener("DOMContentLoaded", verificarNuevaPrueba);
setInterval(verificarNuevaPrueba, 10000);