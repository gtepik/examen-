<?php
session_start();

// Inicializa el arreglo de usuarios si no existe en la sesión
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $email = trim($_POST['email']);
    $lastname = trim($_POST['lastname']);

    // Validaciones básicas
    if (empty($username) || empty($password) || empty($email)) {
        $error = "Todos los campos son obligatorios";
    } elseif ($password != $confirm_password) {
        $error = "Las contraseñas no coinciden";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato del email no es válido";
    } else {
        // Almacenar nuevo usuario en la sesión (simulación de base de datos)
        $_SESSION['users'][] = [
            'username' => $username, 
            'password' => $password, 
            'email' => $email,
            'lastname' => $lastname
        ];

        // Redirigir a la página de inicio de sesión
        header('Location: loginvista.php');
        exit(); // Asegura que no se ejecute más código
    }
}
?>
