<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Código QR</title>
    <style>
        /* Copia y pega aquí el bloque de estilo CSS que tienes en la página del formulario */
                *{
            margin: 0%;
            padding: 0%;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: #ffffff; /* Cambiar color del texto a blanco */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 400px;
            padding: 20px;
            background-color: #da3a34;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .navbar {
            background-color: #571515;
            padding: 0;
            margin: 0;
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }

        h1 {
            background-color: #da3a34; /* Color rojo */
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #e72f29;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            background-color: #c9302c; /* Color rojo oscuro */
            color: white;
            background-color: #c70b05;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #a52a25; /* Color rojo más oscuro al pasar el mouse */
        }

        .idioma-btn {
            background-color: #e91e17; /* Color rojo oscuro */
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #qrcode {
          margin-top: 50px; /* Ajustar el margen superior según sea necesario */
        }
        /* Fin del bloque de estilo CSS */
    </style>
</head>
<body>

<div class="navbar">

  <button type="button" onclick="redirectToAdminPage()" data-translate="volver">Volver</button>

</div>


<!-- Contenido de la página de generación de códigos QR -->
<!-- Añade tu código PHP para generar el QR aquí -->


<?php
// Conectar a la base de datos (cambiar los datos según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imagenescano";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario para agregar un evento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recibir los datos del formulario
  $nombre = $_POST["nombre"];
  $fecha = $_POST["fecha"];
  $matricula = $_POST["matricula"];
  $direccion = $_POST["direccion"];

  // Preparar la consulta SQL para la inserción
  $sql_insert = "INSERT INTO evento (nombre, fecha, matricula, direccion) VALUES ('$nombre', '$fecha', '$matricula', '$direccion')";

  // Ejecutar la consulta de inserción
  if ($conn->query($sql_insert) === TRUE) {
    // Obtener el ID del evento recién insertado
    $last_id = $conn->insert_id;

    // Construir la URL completa con el ID del evento
    $url = "/imagenes/index.php?id=$last_id";

    // Mensaje específico con la URL del evento para el usuario
    echo "<p>Nuevo evento agregado correctamente. Para descargar las imágenes de tu evento, espera 24 horas después del evento y escanea el siguiente código QR:</p>";

    // Generar el contenido de la URL a la que se redirigirá el código QR
    echo "<img src='https://api.qrserver.com/v1/create-qr-code/?data=$url&size=200x200' alt='Código QR' style='margin-top: 150px; width: 300px; height: 300px;'>";
  } else {
    echo "Error al agregar el evento: " . $conn->error;
  }
}

$conn->close();
?>

<script>

  function redirectToAdminPage() {
      // Reemplaza 'url-de-tu-pagina-administrador' con la URL real de tu página de administrador
      window.location.href = '../';
  }

</script>Z

</body>
</html>