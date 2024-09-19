<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Inicializar la lista de productos si no existe
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = trim($_POST['product_name']);
    $product_price = trim($_POST['product_price']);

    // Validaciones básicas
    if (empty($product_name) || empty($product_price) || !is_numeric($product_price)) {
        $error = "Nombre del producto y precio son obligatorios, y el precio debe ser un número";
    } else {
        // Agregar el producto a la sesión
        $_SESSION['products'][] = [
            'name' => $product_name,
            'price' => (float) $product_price
        ];

        // Redirigir a la página de bienvenida para ver los cambios
        header('Location: welcome.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="estilos2.css">
</head>
<body>
    <div class="form-container">
        <h2>Agregar Producto</h2>
        <form method="POST" action="add_product.php">
            <input type="text" name="product_name" placeholder="Nombre del producto" required>
            <input type="text" name="product_price" placeholder="Precio" required>
            <button type="submit">Agregar Producto</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <a href="welcome.php">Volver a la página principal</a>
    </div>
</body>
</html>
