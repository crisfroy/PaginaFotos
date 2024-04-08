<?php
// Establecer la conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imagenescano";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$fecha = date("Y-m-d H:i:s"); // Obtener la fecha y hora actual en formato MySQL
$direccion = $_POST['direccion'];

// Preparar la consulta SQL para insertar los datos en la tabla
$sql = "INSERT INTO contacto (nombre, apellidos, email, telefono, fecha, direccion)
VALUES ('$nombre', '$apellidos', '$email', '$telefono', '$fecha', '$direccion')";

if ($conn->query($sql) === TRUE) {
  // Redireccionar a una página después de insertar el registro
  header("Location: index.html");
  exit(); // Importante para evitar que el código siga ejecutándose después de la redirección
} else {
  echo "Error al agregar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
