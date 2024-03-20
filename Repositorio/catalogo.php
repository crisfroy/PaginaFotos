<?php
function mis_productos($conn) {
    // Consulta SQL para obtener los productos
    $sql = "SELECT * FROM productos ORDER BY nombre";
    $result = $conn->query($sql);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $nombre = $row["nombre"];
            $precio = $row["precio"];
            $modelo_ruta = $row["modelo_ruta"];

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
            echo '<div class="curso__imagen">';
            echo '<model-viewer src="' . $modelo_ruta . '" alt="' . $nombre . '" camera-controls></model-viewer>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "0 resultados";
    }
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imagenescano";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #242323;
        }
        header {
            background-color: #4CAF50;
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            position: relative; 
        }
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 50%; 
            cursor: pointer;
            position: absolute; 
            top: 10px; 
            right: 70px; 
            z-index: 1; 
            transition: transform 0.3s ease; 
        }
        .cart-button:hover {
            transform: scale(1.1); 
        }
        main {
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .product-box {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 300px;
            margin-right: 20px;
        }
        .product-box h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }
        .btn-add, .btn-remove {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease; 
            margin-top: 10px;
        }
        .btn-remove {
            background-color: #f44336;
        }
        .btn-add:hover, .btn-remove:hover {
            background-color: #45a049; 
            transform: scale(1.1); 
        }
        .cart {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            display: none; 
            position: fixed; 
            top: 50%; 
            right: 20px; 
            transform: translateY(-50%); 
            z-index: 2; 
        }
        .cart-total {
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<header>
    <div class="toolbar">
        <a href="inicio.html" class="product-link">Inicio</a>
        <button class="cart-button" onclick="toggleCart()">🛒</button>
    </div>
</header>

<main>
    <?php
    // Llamada a la función para mostrar los productos
    mis_productos($conn);
    ?>
</main>

<div class="cart" id="cart">
    <h2>Carrito</h2>
    <div class="cart-total" id="cartTotal">Total: $0</div>
    <button id="checkoutBtn">Ir a pagar</button>
</div>

<script>
    let total = 0;

    function addToCart(price) {
        total += price;
        updateCart();
    }

    function removeFromCart(price) {
        if (total >= price) {
            total -= price;
            updateCart();
        }
    }

    function updateCart() {
        const cartTotalElement = document.getElementById("cartTotal");
        cartTotalElement.textContent = "Total: $" + total;
    }

    function toggleCart() {
        const cart = document.getElementById("cart");
        cart.style.display = cart.style.display === "block" ? "none" : "block";
    }

    function goToCheckout() {
        alert("Redirigiendo al pago. Monto a pagar: $" + total);
        // Aquí puedes redirigir al usuario a la página de pago
    }
</script>

</body>
</html>

<?php
// Cierre de la conexión a la base de datos
$conn->close();
?>
