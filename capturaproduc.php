
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

// Eliminar producto
if (isset($_GET['delete'])) {
    $index = intval($_GET['delete']);
    if (isset($_SESSION['products'][$index])) {
        unset($_SESSION['products'][$index]);
        // Reindexar el array para que los índices sean consecutivos
        $_SESSION['products'] = array_values($_SESSION['products']);
    }
    header('Location: login.php');
    exit();
}

$products = $_SESSION['products'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="estilos3.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <h2>Lista de Productos</h2>
        <ul>
            <?php foreach ($products as $index => $product): ?>
                <li>
                    <?php echo htmlspecialchars($product['name']) . ' - $' . number_format($product['price'], 2); ?>
                    <a href="welcome.php?delete=<?php echo $index; ?>" class="delete-button">Eliminar</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="button-container">
            <a href="add_product.php" class="add-button">Agregar Producto</a>
            <a href="registro.php" class="logout-button">Cerrar sesión</a>
        </div>
    </div>
</body>
</html>
