<?php
session_start();
include('db.php'); // Asegúrate de que el archivo db.php esté correctamente configurado y conectado a la base de datos.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificación de contraseña
        if (password_verify($password, $user['password'])) {
            // Login exitoso, crear sesión
            $_SESSION['username'] = $user['username'];
            header('Location: index.php'); // Redirigir al contenido protegido
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El usuario no existe.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
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
        .container h2 {
            margin-bottom: 20px;
        }
        .container input[type="text"], .container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .container input[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #555;
        }
        .container p {
            margin-top: 20px;
        }
        .container a {
            color: #333;
        }

    </style>
</head>
<body>


    <div class="container">
        <h2>Iniciar sesión</h2>
        <form method="POST" action="login1.php">
            <label for="username">Usuario:</label>
            <input type="text" name="username" required><br>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required><br>

            <input type="submit" value="Iniciar sesión">
        </form>

        <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a>.</p>
    </div>

</body>
</html>
