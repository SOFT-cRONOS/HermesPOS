
<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "hermespos";
$password = "Cronos71@";
$dbname = "hermespos";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}
?>