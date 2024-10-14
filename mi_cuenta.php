<?php
session_start();
include('db.php'); // Asegúrate de tener la conexión a la base de datos aquí

// Verificar si el usuario está logueado
if (!isset($_SESSION['username'])) {
    header('Location: login1.php');
    exit();
}

$username = $_SESSION['username'];

// Consulta para obtener los datos personales del usuario y los boletos que ha comprado
$sql = "SELECT usuarios.nombre, usuarios.email, usuarios.telefono, boletos.destino, boletos.fecha, boletos.asiento 
        FROM usuarios 
        JOIN boletos ON usuarios.username = boletos.username 
        WHERE usuarios.username = '$username'";

$result = $conexion->query($sql);

// Consultar los datos personales del usuario
$sqlDatosPersonales = "SELECT nombre, email, telefono FROM usuarios WHERE username = '$username'";
$datosPersonales = $conexion->query($sqlDatosPersonales)->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta</title>
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
        h2 {
            margin-bottom: 20px;
        }
        .personal-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .personal-info h3 {
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
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
        <h2>Mi Cuenta</h2>

        <!-- Información Personal -->
        <div class="personal-info">
            <h3>Información Personal</h3>
            <p><strong>Nombre:</strong> <?php echo $datosPersonales['nombre']; ?></p>
            <p><strong>Email:</strong> <?php echo $datosPersonales['email']; ?></p>
            <p><strong>Teléfono:</strong> <?php echo $datosPersonales['telefono']; ?></p>
        </div>

        <!-- Boletos comprados -->
        <h3>Mis Boletos</h3>
        <table>
            <thead>
                <tr>
                    <th>Destino</th>
                    <th>Fecha</th>
                    <th>Asiento</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['destino']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($row['asiento']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No has comprado boletos todavía.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

</body>
</html>
