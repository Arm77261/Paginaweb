<?php
session_start();
include('db.php');

$username = $_SESSION['username'];
$carrito = $conn->query("SELECT * FROM carrito WHERE username = '$username'");

while ($item = $carrito->fetch_assoc()) {
    $asiento = $item['asiento'];
    // Aquí puedes incluir la lógica de destino
    $destino = "Destino Ejemplo";
    $conn->query("INSERT INTO compras (username, asiento, destino) VALUES ('$username', '$asiento', '$destino')");
}

// Vaciar carrito después de la compra
$conn->query("DELETE FROM carrito WHERE username = '$username'");

echo "Compra finalizada. Se han generado tus boletos.";
?>
