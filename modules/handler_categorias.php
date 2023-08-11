<?php

function getAllcat($pdo){
    $sql = "SELECT * FROM categoria";
    
    // Preparar la consulta
    $stmt = $pdo->prepare($sql);
    // Ejecutar la consulta
    $stmt->execute();

    // Obtener resultados
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($clientes) > 0) {
        return $clientes;
    } else {
        return array("No se encontraron resultados.");
    }
}

function addNCat($pdo, $nombre, $detalle){

    // Consulta preparada
    $sql = "INSERT INTO categoria (nombre, detalle) VALUES (:nombre, :detalle)";

    // Valores a insertar
    $values = array(
    ':nombre' => $nombre,
    ':detalle' => $detalle,
    );

    // Preparar la consulta
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta con los valores
    $success = $stmt->execute($values);

    // Verificar si ocurrieron errores
    if (!$success) {
        $errorInfo = $stmt->errorInfo();
        echo $errorInfo[2];
        return $errorInfo[2]; // Mensaje de error
    } else {
        echo "success";
        return "Success"; // Indicador de éxito
    }
}

// Conexión a la base de datos (asegúrate de tener la conexión aquí)
require_once "../Admin/conect.php";
$pdo = connect_sql_pdo();


// Manejar el formulario de agregar artículo simple
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addNCategoria"])) {  
    
    $nombre = $_POST["cat_nombre"];
    $detalle = $_POST["cat_detalle"];

    $consulta = addNCat($pdo, $nombre, $detalle);

    if ($consulta[0] !== '00000') {
        header("Location: ../pages/nuevo_producto.php?estado=correct"); // El mensaje de error se encuentra en el índice 2 del array
        exit;
    } else {
       header("Location: ../pages/nuevo_producto.php?estado=invalid");
       exit;
    }
    
}




?>