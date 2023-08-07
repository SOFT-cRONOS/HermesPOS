<?php

function init_home($conn) { //completa mensajes, graficos y datos de usuario
    //<!-- Modulo constructor datos Home -->

    //detras se ejecuta chart-area-demo.js para el grafico lineal

    //obtener suma de ventas del mes actual
        // Obtener el mes actual en formato numérico (1 a 12)
        $mes_actual = date('n');

        // Consulta para obtener el total de ventas del mes actual con estado "finalizada" y "pagado"
        $sql = "SELECT SUM(total) as total_mes_actual FROM transaccion
                WHERE estado = 'finalizada' AND estado_pago = 'pagado' AND MONTH(fecha_venta) = $mes_actual";
        $result = $conn->query($sql);

        $total_mes_actual = 0; // Inicializa el total en caso de que no haya registros

        // Obtener el total del mes actual
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_mes_actual = (float)$row['total_mes_actual'];
        }

    //obtener suma de ventas del dia actual
        // Obtener la fecha actual en formato Y-m-d
        $fecha_actual = date('Y-m-d');

        // Consulta para obtener el total de ventas del día actual con estado "finalizada" y "pagado"
        $sql = "SELECT SUM(total) as total_dia_actual FROM transaccion
                WHERE estado = 'finalizada' AND estado_pago = 'pagado' AND DATE(fecha_venta) = '$fecha_actual'";
        $result = $conn->query($sql);

        $total_dia_actual = 0; // Inicializa el total en caso de que no haya registros

        // Obtener el total del día actual
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_dia_actual = (float)$row['total_dia_actual'];
        }
    
    //calculo porcentaje de pedidos pendientes
        // Consulta para obtener el número de transacciones en "pendiente"
        $sql = "SELECT COUNT(*) as pendientes FROM transaccion WHERE estado = 'pendiente'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Obtenemos el resultado de la consulta y cargamos el número de pedidos pendientes en la variable $pedidos_pendientes
            $row = $result->fetch_assoc();
            $pedidos_pendientes = $row["pendientes"];
        } else {
            // Si no hay resultados, establecemos $pedidos_pendientes en 0
            $pedidos_pendientes = 0;
        }
        // Consulta para obtener el número de transacciones totales "terminado"
        $sql = "SELECT COUNT(*) as total_pedidos FROM transaccion WHERE estado = 'terminado' OR estado = 'pendiente'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Obtenemos el resultado de la consulta y cargamos el número de pedidos terminados en la variable $pedidos_terminados
            $row = $result->fetch_assoc();
            $total_pedidos = $row["total_pedidos"];
        } else {
            // Si no hay resultados, establecemos $pedidos_terminados en 0
            $total_pedidos = 0;
        };
        $porc_pedidos_pend = 100-(($pedidos_pendientes * 100) /$total_pedidos);


    $valores = array($total_mes_actual, $total_dia_actual, intval($porc_pedidos_pend) );
    return $valores;
}



?>