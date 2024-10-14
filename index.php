<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['username'])) {
    // Redirigir al login si no está logueado
    header('Location: login1.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explora nuestros destinos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .navbar {
            overflow: hidden;
            background-color: #333;
            padding: 10px;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar-right {
            float: right;
        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 20px;
        }
        .image-grid img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <div class="navbar">
        <a href="#home">Inicio</a>
        <a href="#boletos">Boletos</a>
        <a href="index.php">Destinos</a>
        <a href="#contacto">Contacto</a>
        <a href="#nosotros">Nosotros</a>
        
        <!-- Secciones de Login, Mi Cuenta y Logout -->
        <div class="navbar-right">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="mi_cuenta.php">Mi Cuenta</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login1.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <h2>Explora nuestros destinos</h2>

        <!-- Estructura de imágenes 3x2 con enlaces -->
        <div class="image-grid">
            <a href="ruta1.php"><img src="d1.jpeg" alt="Destino 1"></a>
            <a href="ruta2.php"><img src="d2.jpeg" alt="Destino 2"></a>
            <a href="detalles_destino.php?id=3"><img src="d3.jpeg" alt="Destino 3"></a>
            <a href="detalles_destino.php?id=4"><img src="d4.jpeg" alt="Destino 4"></a>
            <a href="detalles_destino.php?id=5"><img src="d5.jpg" alt="Destino 5"></a>
            <a href="detalles_destino.php?id=6"><img src="d6.jpeg" alt="Destino 6"></a>
        </div>
    </div>

</body>
</html>
