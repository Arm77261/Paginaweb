<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Destino</title>
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
        .table-container {
            max-height: 300px;
            overflow-y: auto;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
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
        /* Estilos para las dos secciones */
        .two-sections {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            padding: 20px;
        }
        .left-section, .right-section {
            width: 40%;
        }
        .left-section-content {
            padding: 20px;
            text-align: center;
            color: #333;
        }
        .right-section img {
            width: 40%;
            height: auto;
            border-radius: 10px;
        }
        /* Estilos para los asientos */
        .seat-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin-top: 20px;
        }
        .seat {
            width: 50px;
            height: 50px;
            background-color: #ddd;
            border-radius: 5px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
        }
        .seat.selected {
            background-color: #28a745;
            color: white;
        }
        .seat.occupied {
            background-color: #ff6347;
            cursor: not-allowed;
        }
        /* Estilos para el carrito y el temporizador */
        .cart {
            margin-top: 20px;
            background-color: #f8f8f8;
            padding: 15px;
            border: 1px solid #ddd;
        }
        .cart h3 {
            margin-top: 0;
        }
        .timer {
            font-size: 18px;
            font-weight: bold;
            color: red;
        }
        .cart-items {
            list-style-type: none;
            padding: 0;
        }
        .cart-items li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <div class="navbar">
        <a href="#home">Inicio</a>
        <a href="boletos.php">Boletos</a>
        <a href="index.php">Destinos</a>
        <a href="#contacto">Contacto</a>
        <a href="#nosotros">Nosotros</a>

        <!-- Secciones de Login, Logout y Mi Cuenta -->
        <div class="navbar-right">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="mi_cuenta.php">Mi Cuenta</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <h2>Detalles del Destino</h2>
        
        <!-- Contenedor de la tabla -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Destino</th>
                        <th>Hora de Salida</th>
                        <th>Nombre del Chofer</th>
                        <th>Tipo de Autobús</th>
                        <th>Costo Normal</th>
                        <th>Costo VIP</th>
                        <th>Asientos Disponibles</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Conexión a la base de datos
                    $conexion = new mysqli("localhost", "root", "Admin", "bus");

                    // Comprobar conexión
                    if ($conexion->connect_error) {
                        die("Conexión fallida: " . $conexion->connect_error);
                    }

                    // Verificar si se recibió el destinoId
                    if (isset($_GET['destinoId'])) {
                        $destinoId = $_GET['destinoId'];

                        // Consulta para obtener los detalles del destino
                        $sqlDestino = "SELECT * FROM destino WHERE id = $destinoId";
                        $resultadoDestino = $conexion->query($sqlDestino);

                        // Consulta para obtener los asientos del destino seleccionado
                        $sqlAsientos = "SELECT * FROM asientos WHERE id = $destinoId";
                        $resultadoAsientos = $conexion->query($sqlAsientos);

                        // Mostrar los datos en la tabla
                        if ($resultadoDestino->num_rows > 0 && $resultadoAsientos->num_rows > 0) {
                            $filaDestino = $resultadoDestino->fetch_assoc();
                            $filaAsientos = $resultadoAsientos->fetch_assoc();
                            
                            // Calcular los asientos disponibles
                            $asientos_disponibles = 0;
                            for ($i = 1; $i <= 45; $i++) {
                                $asientoKey = "asiento" . $i;
                                if (isset($filaAsientos[$asientoKey]) && $filaAsientos[$asientoKey] == 0) {
                                    $asientos_disponibles++;
                                }
                            }

                            echo "<tr>";
                            echo "<td>" . $filaDestino['id'] . "</td>";
                            echo "<td>" . $filaDestino['nombre_destino'] . "</td>";
                            echo "<td>" . $filaDestino['hora_salida'] . "</td>";
                            echo "<td>" . $filaDestino['nombre_chofer'] . "</td>";
                            echo "<td>" . $filaDestino['tipo_autobus'] . "</td>";
                            echo "<td>" . $filaDestino['costo_normal'] . "</td>";
                            echo "<td>" . $filaDestino['costo_vip'] . "</td>";
                            echo "<td>" . $asientos_disponibles . "</td>";
                            echo "<td>" . $filaDestino['fecha'] . "</td>";
                            echo "</tr>";
                        } else {
                            echo "<tr><td colspan='9'>No hay resultados para este destino.</td></tr>";
                        }

                    } else {
                        echo "<tr><td colspan='9'>No se ha recibido ningún ID de destino.</td></tr>";
                    }

                    // Cerrar conexión
                    $conexion->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Secciones izquierda y derecha -->
    <section>
        <div class="two-sections">
            <!-- Sección izquierda -->
            <div class="left-section">
                <div class="left-section-content">
                    <h2>Selecciona tus asientos</h2>
                    <!-- Simulación de selección de asientos -->
                    <div class="seat-grid">
                        <?php
                        // Generar asientos
                        if (isset($filaAsientos)) {
                            for ($i = 1; $i <= 45; $i++) {
                                // Verifica que el índice "asientoX" exista antes de acceder
                                $asientoKey = "asiento" . $i;
                                $asientoEstado = isset($filaAsientos[$asientoKey]) && $filaAsientos[$asientoKey] == 1 ? "occupied" : "";
                                echo "<div class='seat $asientoEstado' data-asiento='$i'>$i</div>";
                            }
                        } else {
                            echo "<p>No hay datos de asientos disponibles.</p>";
                        }
                        ?>
                    </div>

                    <!-- Botón para reservar -->
                    <button id="reservarBtn">Reservar y proceder al pago</button>

                    <!-- Carrito de compras -->
                    <div class="cart" id="carrito">
                        <h3>Carrito de Compras</h3>
                        <ul class="cart-items" id="cartItems"></ul>
                        <div class="timer" id="timer"></div>
                    </div>
                </div>
            </div>

            <!-- Sección derecha -->
            <div class="right-section">
                <img src="bos.jpeg" alt="Imagen de ejemplo">
            </div>
        </div>
    </section>

    <script>
        let selectedSeats = [];
        const cartItems = document.getElementById('cartItems');
        const seats = document.querySelectorAll('.seat:not(.occupied)');
        const timerElement = document.getElementById('timer');
        let timerInterval;

        // Script para seleccionar asientos
        seats.forEach(seat => {
            seat.addEventListener('click', function() {
                const asiento = this.getAttribute('data-asiento');

                if (this.classList.contains('selected')) {
                    this.classList.remove('selected');
                    selectedSeats = selectedSeats.filter(s => s !== asiento);
                } else {
                    this.classList.add('selected');
                    selectedSeats.push(asiento);
                }

                actualizarCarrito();
            });
        });

        // Actualizar carrito
        function actualizarCarrito() {
            cartItems.innerHTML = '';
            selectedSeats.forEach(asiento => {
                const li = document.createElement('li');
                li.textContent = `Asiento ${asiento}`;
                cartItems.appendChild(li);
            });
        }

        // Temporizador de 5 minutos
        function iniciarTemporizador() {
            let timeLeft = 300;
            timerElement.textContent = `Tiempo restante para pagar: ${formatTime(timeLeft)}`;

            timerInterval = setInterval(() => {
                timeLeft--;
                timerElement.textContent = `Tiempo restante para pagar: ${formatTime(timeLeft)}`;

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    alert('El tiempo ha expirado. Los asientos han sido liberados.');
                    liberarAsientos();
                }
            }, 1000);
        }

        // Formatear el tiempo
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }

        // Liberar los asientos después de que expire el tiempo
        function liberarAsientos() {
            selectedSeats.forEach(asiento => {
                document.querySelector(`.seat[data-asiento="${asiento}"]`).classList.remove('selected');
            });
            selectedSeats = [];
            actualizarCarrito();
            timerElement.textContent = '';
        }

        // Evento al hacer clic en el botón de "Reservar"
        document.getElementById('reservarBtn').addEventListener('click', function() {
            if (selectedSeats.length > 0) {
                iniciarTemporizador();
                // Enviar datos de los asientos seleccionados al servidor para reservarlos temporalmente
                fetch('reservar_asientos.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `asientos=${selectedSeats.join(',')}&destino_id=<?php echo $destinoId; ?>`
                }).then(response => response.text())
                  .then(data => console.log(data));
            } else {
                alert('Selecciona al menos un asiento.');
            }
        });
    </script>

</body>
</html>
