<?php

    function palco_productos($conn){
    // Define the array to store the sales per category
    $productos_mas_vendidos = array();

    // SQL query to get the number of sales per category
    $sql = "SELECT c.nombre AS categoria, COUNT(dt.idarticulo) AS total_ventas
            FROM categoria c
            LEFT JOIN articulo a ON c.idcategoria = a.idcategoria
            LEFT JOIN detalle_transaccion dt ON a.idarticulo = dt.idarticulo
            GROUP BY c.nombre";

    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categoria = $row['categoria'];
            $total_ventas = $row['total_ventas'];

            // Add the category and its total sales to the array
            $productos_mas_vendidos[] = array(
                'categoria' => $categoria,
                'total_ventas' => (int)$total_ventas,
            );
        }

        // Free the result set
        $result->free();
    }

    // Devuelve el array con los datos de los productos más vendidos
    return $productos_mas_vendidos;
}


function montos_mes($con){
        //coneccion y datos de usuario
    require_once "Admin/conect.php";

    $conn = connect_sql();


    // Consulta para obtener los montos por mes
    $sql = "SELECT MONTH(fecha_venta) as mes, SUM(total) as monto_mes
    FROM transaccion
    WHERE fecha_venta IS NOT NULL
    GROUP BY mes
    ORDER BY mes;";
    $result = $conn->query($sql);

    $montos_por_mes = array_fill(0, 12, 0); // Inicializa el array con ceros

    // Llena el array con los montos por mes obtenidos de la base de datos
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $mes = (int)$row['mes'];
            $monto_mes = (float)$row['monto_mes'];
            $montos_por_mes[$mes] = $monto_mes; // Los meses están indexados desde 1 poniendo $mes-1
        }
    }

    // Devuelve el array como una respuesta JSON
    //header('Content-Type: application/json');
    return json_encode($montos_por_mes);
}
?>
