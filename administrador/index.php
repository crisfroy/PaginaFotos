<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz de Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            background-color: #d9534f; /* Color rojo */
            color: white;
            padding: 15px;
            text-align: center;
        }

        div {
            background-color: #d9534f; /* Color rojo */
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            text-align: center;
        }

        button {
            background-color: #c9302c; /* Color rojo oscuro */
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #a52a25; /* Color rojo más oscuro al pasar el mouse */
        }
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
            background-color: #fd7b77;
        }
    </style>
</head>
<body>

<h1>Panel de Administrador</h1>

<div>
    <button onclick="agregarProducto()">Agregar Producto</button>
    <button onclick="verProductos()">Ver Productos</button>
    <button onclick="agregarEvento()">Agregar Evento</button>
</div>
<div>
    
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

</div>

<script>
    function agregarProducto() {
        window.location.href = "AgregarProductos.html";
    }
    function verProductos() {
        window.location.href = "catalogo.php";
    }
    function agregarEvento() {
        window.location.href = "Evento/";
    }
</script>

</body>
</html>
