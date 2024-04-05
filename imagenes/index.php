<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<header>
  <h1>Imágenes</h1>
  <link rel="stylesheet" href="../administrador/Repositorio/style.css">
</header>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div id="selector">
  <form action="" method="post">
    <label for="id_evento">Selecciona un evento:</label>
    <select name="id_evento" id="id_evento">
      <?php
        $conn = new PDO('mysql:host=localhost;dbname=imagenescano', 'root', '');

        $stmt = $conn->prepare('SELECT DISTINCT id_evento FROM imagen');
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<option value="' . $row['id_evento'] . '">' . $row['id_evento'] . '</option>';
        }
      ?>
    </select>
    <input type="submit" value="Consultar">
  </form>
</div>

<div id="imagenes">
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_evento'])) {
      $id_evento = $_POST['id_evento'];
      $stmt = $conn->prepare('SELECT imagenn FROM imagen WHERE id_evento = :id_evento');
      $stmt->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
      $stmt->execute();
    } else {
      $stmt = $conn->prepare('SELECT imagenn FROM imagen');
      $stmt->execute();
    }

    echo '<ul id="lista_fotos">';
    while ($imagen = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo '<li><img class="imagen" src="data:image/jpeg;base64,' . base64_encode($imagen['imagenn']) . '" alt=""></li>';
    }
    echo '</ul>';
  ?>
</div>

</body>
</html>
