<?php
session_start();

// Verificar si el usuario está logueado
if (isset($_SESSION['username'])) {
    // Si el usuario ya está logueado, redirigir al contenido protegido
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
        }
        .container img {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }
        .container h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .container a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .container a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="welcome.png" alt="Bienvenido">
        <h1>Bienvenido</h1>
        <p>Por favor, créate una cuenta o inicia sesión para continuar.</p>
        <a href="login1.php">Iniciar Sesión</a>
        <a href="register.php">Crear Cuenta</a>
    </div>

</body>
</html>
