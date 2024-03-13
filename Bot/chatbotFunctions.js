
// Función para enviar mensajes
function sendMessage() {
    var userInput = document.getElementById('userInput').value;
    var chatArea = document.getElementById('chatArea');
    var message = 'Usuario: ' + userInput + '<br>';

    // Agregar mensaje del usuario al área de chat
    chatArea.innerHTML += message;

    // Obtener respuesta del bot
    var botResponse = getBotResponse(userInput);

    // Agregar la respuesta del bot al área de chat
    chatArea.innerHTML += 'Hespi: ' + botResponse + '<br>';

    // Limpiar el campo de entrada después de enviar el mensaje
    document.getElementById('userInput').value = '';
}

// Asignar evento clic al botón "Enviar" después de que se cargue todo el contenido
document.addEventListener('DOMContentLoaded', function() {
    // Asignar evento clic al botón "Enviar"
    document.getElementById('sendButton').addEventListener('click', function() {
        sendMessage(); // Llamar a la función sendMessage() al hacer clic en el botón "Enviar"
    });
});

// Función para obtener la respuesta del bot
function getBotResponse(userInput) {
    var responses = {
        "hello": "Hi",
        "hola": "Hola buen día, ¿en qué puedo ayudarte?",
        "que puedo hacer": "Puedes usar las siguientes funciones: quiero ir al menu (te movera al menu) quiero un servicio (te movera a los servicios)",
        "como funciona":"Puedes usar las siguientes funciones: quiero ir al menu (te movera al menu) quiero un servicio (te movera a los servicios)",
        "como agendo una cita":"Puedes visitar nuestra pagina web con la informacion necesaria, si quieres que te lleve alli escribeme 'Lleveme al menu'",
        "como saco una cita":"Puedes visitar nuestra pagina web con la informacion necesaria, si quieres que te lleve alli escribeme 'Lleveme al menu'",
        "sacar cita":"Puedes visitar nuestra pagina web con la informacion necesaria, si quieres que te lleve alli escribeme 'Lleveme al menu'",
        "quiero ir al menu": redirectTo('/', "¡Te llevaré al menú!"),
        "menu": redirectTo('/', "¡Te llevaré al menú!"),
        "interfaz principal": redirectTo('/', "¡Te llevaré al menú!"),
        "quiero ir a los pedidos": redirectTo('/Repositorio', "¡Te llevaré a los pedidos!"),
        "quiero rentar un toro": redirectTo('/Repositorio', "¡Te llevaré a los pedidos!"),
        "quiero un toro": redirectTo('/Repositorio', "¡Te llevaré a los pedidos!"),
        "toro": redirectTo('/Repositorio', "¡Te llevaré a los pedidos!"),
        "quiero toro": redirectTo('/Repositorio', "¡Te llevaré a los pedidos!"),
        "como te llamas": "Me llamo Hespi. Estoy aquí para ayudarte.",
        "cuál es tu función": "Soy un asistente virtual diseñado para responder preguntas y ayudarte a navegar por el sistema.",
        "hay alguien ahí": "¡Sí! Estoy aquí para ayudarte. ¿En qué puedo asistirte hoy?",
        "qué haces": "Estoy aquí para responder preguntas y brindarte ayuda con el sistema.",
        "eres humano": "No, soy un bot diseñado para ayudarte con el sistema.",
        "eres real": "Soy un programa informático creado para asistirte en tus consultas.",
        "adiós": "¡Adiós! Si necesitas ayuda en el futuro, no dudes en volver.",
        "hasta luego": "¡Hasta luego! Que tengas un buen día.",
        "gracias": "¡De nada! Estoy aquí para ayudar en lo que pueda.",
        "qué tal": "Estoy bien, gracias por preguntar. ¿En qué puedo ayudarte hoy?",
        "cuál es tu objetivo": "Mi objetivo es ayudarte a resolver tus consultas y brindarte la mejor experiencia posible.",
        "cómo estás": "¡Estoy en línea y listo para ayudarte! ¿Cómo puedo asistirte hoy?",
        "cuál es tu propósito": "Mi propósito es ayudarte a navegar y utilizar eficazmente el sistema.",
        "cómo puedo contactarte": "Puedes contactarme a través de este chat o utilizando la información de contacto proporcionada en la página de soporte.",
        "qué tipo de preguntas puedes responder": "Puedo responder preguntas sobre funciones del sistema, resolver problemas comunes y proporcionar asistencia general.",
        "dónde puedo encontrar más ayuda": "Puedes encontrar más ayuda en la sección de preguntas frecuentes del sitio web o contactando al equipo de soporte.",
    // Agrega más preguntas y respuestas aquí...
    };

    userInput = userInput.toLowerCase();

    // Implementación de la distancia de Levenshtein
    function levenshteinDistance(s1, s2) {
        if (s1.length === 0) return s2.length;
        if (s2.length === 0) return s1.length;

        var matrix = [];
        var i, j;

        // Inicializar la matriz
        for (i = 0; i <= s2.length; i++) {
            matrix[i] = [i];
        }

        for (j = 0; j <= s1.length; j++) {
            matrix[0][j] = j;
        }

        // Calcular la distancia de Levenshtein
        for (i = 1; i <= s2.length; i++) {
            for (j = 1; j <= s1.length; j++) {
                if (s2.charAt(i - 1) === s1.charAt(j - 1)) {
                    matrix[i][j] = matrix[i - 1][j - 1];
                } else {
                    matrix[i][j] = Math.min(
                        matrix[i - 1][j - 1] + 1,
                        Math.min(matrix[i][j - 1] + 1, matrix[i - 1][j] + 1)
                    );
                }
            }
        }

        return matrix[s2.length][s1.length];
    }

    var bestMatch = { word: "", distance: Infinity };

    // Buscar la mejor coincidencia
    for (var key in responses) {
        var distance = levenshteinDistance(userInput, key);
        if (distance < bestMatch.distance) {
            bestMatch.word = key;
            bestMatch.distance = distance;
        }
    }

    // Obtener la respuesta asociada
    var response = responses[bestMatch.word];

    if (response) {
        if (typeof response === 'function') {
            return response();
        } else {
            return response;
        }
    } else {
        return "No entendí tu pregunta. ¿Puedes reformularla?";
    }
}

// Función para redirigir a una URL
function redirectTo(url, message) {
    return function() {
        window.location.href = url;
        return message;
    };
}

