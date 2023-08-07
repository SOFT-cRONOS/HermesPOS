<?php
    // Configuración de la conexión a la base de datos
    $servername = "databases-auth.000webhost.com";
    $username = "admin";
    $password = "Cronos71@";
    $dbname = "id20652880_hermespos";

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>

    Ejecuta consultas: Una vez que tienes la conexión establecida, puedes utilizar consultas SQL para interactuar con la base de datos. Por ejemplo:

php

<?php
// Consulta de ejemplo para obtener datos de una tabla
$sql = "SELECT * FROM mi_tabla";
$resultado = mysqli_query($conn, $sql);

// Verificar si la consulta fue exitosa
if (mysqli_num_rows($resultado) > 0) {
    // Procesar los datos obtenidos
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Realizar operaciones con los datos
        echo "ID: " . $fila["id"] . " - Nombre: " . $fila["nombre"] . "<br>";
    }
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
mysqli_close($conn);
?>

Recuerda que en tu caso deberás reemplazar "nombre_del_servidor", "nombre_de_usuario", "contraseña" y "nombre_de_la_base_de_datos" con los valores proporcionados por tu hosting.

Además, es importante que tomes medidas de seguridad, como escapar y validar los datos ingresados por los usuarios para evitar ataques de inyección de SQL. Puedes utilizar sentencias preparadas (prepared statements) para realizar consultas seguras.
