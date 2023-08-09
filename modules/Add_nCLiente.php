<?php
// Conexión a la base de datos (asegúrate de tener la conexión aquí)
require_once "../Admin/conect.php";
$conn = connect_sql();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $documento = $_POST["documento"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $empresa = $_POST["empresa"];

    // Consulta SQL para insertar los datos en la tabla variante_articulo
    $sql = "INSERT INTO cliente (nombre, documento, direccion, telefono, email, empresa)
            VALUES ( '$nombre', '$documento', '$direccion', '$telefono', '$email', '$empresa')";
    if ($nombre == ''){
        header("Location: ../pages/nuevo_cliente.php?estado=nodata");
    } else {
        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/nuevo_cliente.php?estado=correct");
        } else {
            header("Location: ../pages/nuevo_cliente.php?estado=invalid " . $conn->error);
        }
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
