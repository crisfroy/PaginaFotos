<?php

function mis_productos($conn) {
    // Consulta SQL para obtener los productos
    $sql = "SELECT * FROM productos ORDER BY producto";
    $result = $conn->query($sql);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row["id_producto"];
            $nombre = $row["producto"];
            $precio = $row["precio"];

            // Generar HTML para cada producto
            echo '<div class="product-box" id="product' . $id . '">';
            echo '<div>';
            echo '<h3>' . $nombre . '</h3>';
            echo '<p>Precio: $' . $precio . '</p>';
            echo '</div>';
            echo '<div>';
            echo '<button class="btn-add" onclick="addToCart(' . $precio . ')">Agregar</button>';
            echo '<button class="btn-remove" onclick="removeFromCart(' . $precio . ')">Quitar</button>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "0 resultados";
    }
}

?>
