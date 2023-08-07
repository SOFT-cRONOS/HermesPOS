<?php
//coneccion y datos de usuario
require_once "Admin/conect.php";

$conn = connect_sql();


// Consulta para obtener los montos por mes
$sql = "SELECT MONTH(fecha_venta) as mes, SUM(total) as monto_mes FROM transaccion GROUP BY mes ORDER BY mes";
$result = $conn->query($sql);

$montos_por_mes = array_fill(0, 12, 0); // Inicializa el array con ceros

// Llena el array con los montos por mes obtenidos de la base de datos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mes = (int)$row['mes'];
        $monto_mes = (float)$row['monto_mes'];
        $montos_por_mes[$mes - 1] = $monto_mes; // Los meses están indexados desde 1
    }
}

// Devuelve el array como una respuesta JSON
//header('Content-Type: application/json');
echo json_encode($montos_por_mes);

// Cierra la conexión
$conn->close();
?>