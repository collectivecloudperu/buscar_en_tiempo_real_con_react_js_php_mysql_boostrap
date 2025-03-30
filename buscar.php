<?php
    // Permite que cualquier dominio pueda acceder a la API (CORS)
    header("Access-Control-Allow-Origin: *");

    // Indicamos que la respuesta será en formato JSON
    header("Content-Type: application/json");

    // Datos de conexión a la base de datos
    $servername = "localhost"; // Servidor (localhost si es en local)
    $username = "root"; // Usuario de MySQL
    $password = ""; // Contraseña de MySQL
    $dbname = "test"; // Nombre de la base de datos

    // Conectamos a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificamos si la conexión falló
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener todos los postres de la tabla "productos"
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);

    // Creamos un array para almacenar los postres
    $postres = [];

    // Recorremos los resultados y los agregamos al array
    while ($row = $result->fetch_assoc()) {
        $postres[] = $row;
    }

    // Convertimos el array en formato JSON y lo enviamos como respuesta
    echo json_encode($postres);

    // Cerramos la conexión a la base de datos
    $conn->close();
?>
