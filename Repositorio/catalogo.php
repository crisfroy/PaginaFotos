<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Estilos CSS (copia los estilos CSS proporcionados) */
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
    include '../consultaproductos.php';
    
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
    // JavaScript (copia el JavaScript proporcionado)
</script>

</body>
</html>
