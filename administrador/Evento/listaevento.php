<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Eventos</title>
<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}
</style>
</head>
<body>

<h1>Lista de Eventos</h1>

<table>
  <tr>
    <th>ID Evento</th>
    <th>Nombre</th>
    <th>Fecha</th>
    <th>Matrícula</th>
    <th>Dirección</th>
  </tr>

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

  // Consulta para obtener los eventos
  $sql = "SELECT id_evento, nombre, fecha, matricula, direccion FROM evento";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Mostrar los eventos en la tabla
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["id_evento"] . "</td>";
      echo "<td>" . $row["nombre"] . "</td>";
      echo "<td>" . $row["fecha"] . "</td>";
      echo "<td>" . $row["matricula"] . "</td>";
      echo "<td>" . $row["direccion"] . "</td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='5'>No hay eventos registrados</td></tr>";
  }

  $conn->close();
  ?>
</table>

</body>
</html>
