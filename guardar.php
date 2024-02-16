<?php 
include("conexion.php");

$nombre = $_POST['nombre'];
$Imagen = addslashes(file_get_contents($_FILES['myfile']['tmp_name']));

$query = "INSERT INTO imagen(nombre, imagenn) VALUES('$nombre', '$Imagen')" ;
$resultado = $conexion -> query($query);
if($resultado){
echo "si se inserto";
}else{
    echo "no se inserto";
}

?>