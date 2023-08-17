<?php

function palco_productos($conn) {
    // Define the array to store the sales per category
    $productos_mas_vendidos = array();

    // SQL query to get the number of sales per category
    $sql = "SELECT c.idcategoria, c.nombre AS categoria, IFNULL(SUM(dt.cantidad), 0) AS total_ventas
            FROM categoria c
            LEFT JOIN clase_articulo ca ON c.idcategoria = ca.idcategoria
            LEFT JOIN variante_articulo va ON ca.idarticulo = va.idarticulo
            LEFT JOIN detalle_transaccion dt ON va.id_variante = dt.id_variante
            GROUP BY c.idcategoria, c.nombre
            ORDER BY c.idcategoria";

    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categoria = $row['categoria'];
            $total_ventas = (int)$row['total_ventas'];

            // Add the category and its total sales to the array
            $productos_mas_vendidos[] = array(
                'categoria' => $categoria,
                'total_ventas' => $total_ventas,
            );
        }

        // Free the result set
        $result->free();
    } else {
        // Handle the case where the query fails
        // You might want to log an error or return an error message
    }

    // Fill remaining rows with 0 if less than 3 rows
    while (count($productos_mas_vendidos) < 3) {
        $productos_mas_vendidos[] = array(
            'categoria' => 'no hay productos',
            'total_ventas' => 0,
        );
    }

    // Devuelve el array con los datos de los productos más vendidos
    return $productos_mas_vendidos;
}


function montos_mes($conn){
        //coneccion y datos de usuario
    require_once "../Admin/conect.php";

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
