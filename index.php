<?php
//configurar todos los graficos al pie y eliminar archivos originales.

//graficador
//coneccion y datos de usuario
require_once "Admin/conect.php";

$conn = connect_sql();

$datos = verificar_init();

$_SESSION['username'] = $datos['UserName_init'];
$nombre_completo = $datos['UserDataName'];
$username = $_SESSION['username'];

// Cerrar la conexión
$conn->close();


header("Location: pages/home.php");


?>

