<?php

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imagenescano";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$producto = $_POST['producto'] ?? '';
$precio = $_POST['precio'] ?? '';

// Verificar si se enviaron todos los datos necesarios
if (empty($producto) || empty($precio)) {
    die("Error: Todos los campos del formulario son obligatorios.");
}

// Preparar la consulta SQL para insertar datos en la base de datos
$sql = "INSERT INTO productos (producto, precio) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

// Verificar si la preparación de la consulta fue exitosa
if ($stmt === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

// Enlazar parámetros a la consulta preparada
$stmt->bind_param("ss", $producto, $precio);

// Ejecutar la consulta preparada
if ($stmt->execute()) {
    echo "Producto agregado correctamente.";
} else {
    echo "Error al agregar el producto: " . $stmt->error;
}

// Cerrar la declaración y la conexión a la base de datos
$stmt->close();
$conn->close();

?>
