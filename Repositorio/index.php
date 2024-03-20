<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<header>
  <h1>Prototipo</h1>
  <link rel="stylesheet" href="style.css">
</header>
<body>

  <div id="contenido">
    <div>
      <h3>Usa esta opcion para subir una sola imagen:</h3>
      <form action="guardar.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre..." value=""/>
        <label for="singleFile">Selecciona la imagen:</label>
        <input type="file" id="singleFile" name="singleFile" accept=".JPEG,.PNG,.JPG, .jpg, .jpeg, .png">
        <br><br>
        <input type="submit" value="Aceptar">
      </form>
    </div>
    <div>
    <h3>Usa esta opcion para subir multiples imagenes:</h3>
      <form action="guardar.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre..." value=""/>
        <label for="multiFiles">Selecciona las imagenes:</label>
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
