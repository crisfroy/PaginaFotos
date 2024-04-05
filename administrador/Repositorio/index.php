<?php
// Obtener el id del evento de la URL
if(isset($_GET['id'])) {
    $id_evento = $_GET['id'];
} else {
    $id_evento = "";
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<header>
  <h1>Subir Imagenes</h1>
  <link rel="stylesheet" href="style.css">
</header>
<body>

<div id="contenido">
    <div>
      <h3>Usa esta opción para subir una sola imagen:</h3>
      <form action="guardar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="id_evento" name="id_evento" value="<?php echo $id_evento; ?>">
        <input type="file" id="singleFile" name="singleFile" accept=".JPEG,.PNG,.JPG, .jpg, .jpeg, .png">
        <br><br>
        <input type="submit" value="Aceptar">
      </form>
    </div>
    <div>
    <h3>Usa esta opción para subir múltiples imágenes:</h3>
      <form action="guardar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="id_evento" name="id_evento" value="<?php echo $id_evento; ?>">
        <input type="file" id="multiFiles" name="multiFiles[]" multiple accept=".JPEG,.PNG,.JPG">
        <br><br>
        <input type="submit" value="Aceptar">
      </form>
    </div>
</div>
  <div id="imagenes">
    <?php
      $conn = new PDO('mysql:host=localhost;dbname=imagenescano', 'root', '');

      $stmt = $conn->prepare('SELECT imagenn FROM imagen');
      $stmt->execute();

      echo '<ul id="lista_fotos">';
      while ($imagen = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<li><img class="imagen" src="data:image/jpeg;base64,' . base64_encode($imagen['imagenn']) . '" alt=""></li>';
      }
      echo '</ul>';
    ?>
  </div>
</body>
</html>
