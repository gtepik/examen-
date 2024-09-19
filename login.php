<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Verificar si el usuario existe en la sesión
    $users = $_SESSION['users'] ?? [];

    $found = false;
    foreach ($users as $user) {
        if ($user['username'] == $username && $user['password'] == $password) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header('Location:capturaproduc.php'); // Redirigir a la página de bienvenida
            exit();
        }
    }

    $error = "Nombre de usuario o contraseña incorrectos";
}
?>
