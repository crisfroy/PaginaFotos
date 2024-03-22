<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #d9534f; /* Color rojo */
            padding: 10px 0;
            text-align: center;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .product-link {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .cart-button {
            background-color: #c9302c; /* Color rojo oscuro */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cart-button:hover {
            background-color: #a52a25; /* Color rojo más oscuro al pasar el mouse */
        }

        main {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-name {
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .product-price {
            padding: 10px;
            font-size: 14px;
        }

        .cart {
            position: fixed;
            right: 20px;
            top: 70px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 250px;
        }

        .cart h2 {
            margin-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
        }

        .cart-total {
            font-size: 16px;
            margin-bottom: 10px;
        }

        #checkoutBtn {
            background-color: #c9302c; /* Color rojo oscuro */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #checkoutBtn:hover {
            background-color: #a52a25; /* Color rojo más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>

<header>
    <div class="toolbar">
        <a href="index.php" class="product-link">Inicio</a>
        <button class="cart-button" onclick="toggleCart()">🛒</button>
    </div>
</header>

<main>
    <?php
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "imagenescano";
    
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Incluir la función para mostrar los productos
    include 'consultaproductos.php';
    
    // Llamada a la función para mostrar los productos
    mis_productos($conn);
    
    // Cierre de la conexión a la base de datos
    $conn->close();
    ?>
</main>

<div class="cart" id="cart">
    <h2>Carrito</h2>
    <div class="cart-total" id="cartTotal">Total: $0</div>
    <button id="checkoutBtn">Ir a pagar</button>
</div>

<script>
    function toggleCart() {
        var cart = document.getElementById("cart");
        cart.style.display = cart.style.display === "none" ? "block" : "none";
    }
</script>

</body>
</html>
