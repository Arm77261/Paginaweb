<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de Boletos de Autobuses</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
        .hero-section {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, auto);
            gap: 10px;
            padding: 20px;
            justify-items: center;
            align-items: center;
        }
        .image-box {
            text-align: center;
            position: relative;
        }
        .image-box img {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }
        .image-box p {
            font-size: 16px;
            color: #333;
            margin-top: 10px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        @media screen and (max-width: 768px) {
            .hero-section {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media screen and (max-width: 480px) {
            .hero-section {
                grid-template-columns: 1fr;
            }
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
    </div>




    <title>Destinos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .destination-selection {
            margin-top: 20px;
        }
        input[type="text"] {
            padding: 5px;
            font-size: 16px;
        }
        .custom-button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background: linear-gradient(180deg, #d3d3d3 0%, #2e2e2e 100%);
            border: none;
            border-radius: 25px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .custom-button:hover {
            background: linear-gradient(180deg, #2e2e2e 0%, #d3d3d3 100%);
        }
    </style>
</head>
<body>

<h2>Lista de Destinos</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del Destino</th>
            <th>Hora de Salida</th>
            <th>Nombre del Chofer</th>
            <th>Tipo de Autobús</th>
            <th>Costo Usuario Normal</th>
            <th>Costo Usuario VIP</th>
            <th>Asientos Disponibles</th>
            <th>Fecha</th> <!-- Nueva columna de fecha -->
        </tr>
    </thead>
    <tbody>
<?php
$servername = "localhost";
$username = "root";
$password = "Admin";
$dbname = "bus";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de la fila con id = 1
$sql = "SELECT destino.id, destino.nombre_destino, destino.hora_salida, destino.nombre_chofer, destino.tipo_autobus, destino.costo_normal, destino.costo_vip, destino.fecha, 
        (45 - (asientos.asiento1 + asientos.asiento2 + asientos.asiento3 + asientos.asiento4 + asientos.asiento5 +
        asientos.asiento6 + asientos.asiento7 + asientos.asiento8 + asientos.asiento9 + asientos.asiento10 +
        asientos.asiento11 + asientos.asiento12 + asientos.asiento13 + asientos.asiento14 + asientos.asiento15 +
        asientos.asiento16 + asientos.asiento17 + asientos.asiento18 + asientos.asiento19 + asientos.asiento20 +
        asientos.asiento21 + asientos.asiento22 + asientos.asiento23 + asientos.asiento24 + asientos.asiento25 +
        asientos.asiento26 + asientos.asiento27 + asientos.asiento28 + asientos.asiento29 + asientos.asiento30 +
        asientos.asiento31 + asientos.asiento32 + asientos.asiento33 + asientos.asiento34 + asientos.asiento35 +
        asientos.asiento36 + asientos.asiento37 + asientos.asiento38 + asientos.asiento39 + asientos.asiento40 +
        asientos.asiento41 + asientos.asiento42 + asientos.asiento43 + asientos.asiento44 + asientos.asiento45)) 
        AS asientos_disponibles
        FROM destino 
        JOIN asientos ON destino.id = asientos.id
        WHERE destino.nombre_destino = 'XALAPA'";  // Corregido, 'CDMX' entre comillas simples

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos de la fila con id = 1
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["nombre_destino"]. "</td><td>" . $row["hora_salida"]. "</td><td>" . $row["nombre_chofer"]. "</td><td>" . $row["tipo_autobus"]. "</td><td>" . $row["costo_normal"]. "</td><td>" . $row["costo_vip"]. "</td><td>" . $row["asientos_disponibles"]. "</td><td>" . $row["fecha"]. "</td></tr>";
    }
} else {
    echo "<tr><td colspan='9'>No hay resultados</td></tr>";
}

$conn->close();
?>

    </tbody>
</table>

<div class="destination-selection">
    <label for="destinoId">ID del Destino: </label>
    <input type="text" id="destinoId" name="destinoId" placeholder="Ingresa el ID del destino">
    <input type="button" value="Seleccionar destino" class="custom-button" onclick="seleccionarDestino()">
</div>

<script>
    function seleccionarDestino() {
        var destinoId = document.getElementById("destinoId").value;
        if(destinoId) {
            // Enviar destinoId a boletos.php mediante GET
            window.location.href = "boletos.php?destinoId=" + destinoId;
        } else {
            alert("Por favor ingresa un ID de destino válido.");
        }
    }
</script>

</body>
</html>
