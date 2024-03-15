<?php
$conexion = new mysqli("localhost", "root", "", "imagenescano");

if ($conexion) {
    echo "Conexion exitosa";
} else {
    echo "Conexion no exitosa";
}
?>
