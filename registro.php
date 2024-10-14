<?php
include('db.php');

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar la contraseña

    $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro exitoso. <a href='index.php'>Iniciar sesión</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
</head>
<body>
    <h1>Registro de usuario</h1>
    <form method="POST" action="registro.php">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>

        <input type="submit" name="register" value="Registrar">
    </form>
</body>
</html>
