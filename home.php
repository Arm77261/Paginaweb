<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

include('db.php');

// Mostrar carrito y boletos anteriores
$username = $_SESSION['username'];
$carrito = $conn->query("SELECT * FROM carrito WHERE username = '$username'");
$boletos = $conn->query("SELECT * FROM compras WHERE username = '$username'");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservación de Autobuses</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>
    <a href="logout.php">Cerrar sesión</a>
    <h2>Selecciona tus asientos</h2>
    
    <div>
        <h3>Autobús</h3>
        <div>
            <span>Conductor</span><br>
            <table>
                <!-- Generar asientos en una tabla -->
                <?php for ($row = 1; $row <= 9; $row++): ?>
                    <tr>
                        <?php for ($col = 1; $col <= 5; $col++): ?>
                            <td>
                                <button onclick="seleccionarAsiento(<?php echo ($row - 1) * 5 + $col; ?>)">
                                    <?php echo ($row - 1) * 5 + $col; ?>
                                </button>
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </table>
            <span>Salida</span>
        </div>
    </div>

    <h2>Carrito de compras</h2>
    <div id="carrito">
        <!-- Mostrar asientos seleccionados -->
    </div>

    <h2>Mis boletos</h2>
    <div>
        <?php while ($boleto = $boletos->fetch_assoc()): ?>
            <p>Boleto para: <?php echo $boleto['destino']; ?> - Asiento: <?php echo $boleto['asiento']; ?></p>
        <?php endwhile; ?>
    </div>
    
    <button onclick="finalizarCompra()">Finalizar compra</button>

    <script>
        function seleccionarAsiento(asiento) {
            // Enviar selección de asiento a la base de datos y añadir al carrito
            fetch('seleccionar_asiento.php', {
                method: 'POST',
                body: new URLSearchParams('asiento=' + asiento)
            }).then(response => response.text())
              .then(data => document.getElementById('carrito').innerHTML = data);
        }

        function finalizarCompra() {
            window.location.href = 'finalizar_compra.php';
        }
    </script>
</body>
</html>
