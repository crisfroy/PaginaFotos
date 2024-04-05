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
    echo "<img src='https://api.qrserver.com/v1/create-qr-code/?data=$url&size=200x200' alt='Código QR'>";
  } else {
    echo "Error al agregar el evento: " . $conn->error;
  }
}

$conn->close();
?>
