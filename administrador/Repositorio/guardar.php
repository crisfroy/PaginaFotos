<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Manejar subida de una sola imagen
    if (!empty($_FILES['singleFile']['name'])) {
        $imagenTemp = addslashes(file_get_contents($_FILES['singleFile']['tmp_name']));
        $query = "INSERT INTO imagen (nombre, imagenn) VALUES ('$nombre', '$imagenTemp')";
        $resultado = $conexion->query($query);

        if ($resultado) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error al subir la imagen.<br>";
        }
    }

    // Manejar subida de múltiples imágenes
    if (!empty($_FILES["multiFiles"]["name"])) {
        foreach ($_FILES["multiFiles"]["tmp_name"] as $key => $tmp_name) {
            $imagenTemp = addslashes(file_get_contents($_FILES['multiFiles']['tmp_name'][$key]));
            $query = "INSERT INTO imagen (nombre, imagenn) VALUES ('$nombre', '$imagenTemp')";
            $resultado = $conexion->query($query);

            if ($resultado) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error al subir imagen.<br>";
            }
        }
    } elseif (empty($_FILES['singleFile']['name'])) {
        echo "No se han seleccionado imágenes.<br>";
    }
} else {
    echo "Error en la solicitud.<br>";
}
?>
