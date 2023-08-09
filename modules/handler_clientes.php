<?php

function getAllclient($conn){
    $sql = "SELECT
                c.idcliente,
                c.nombre,
                c.documento,
                c.direccion,
                c.telefono,
                c.email,
                c.empresa,
                COUNT(t.idtransaccion) AS total_compras,
                SUM(t.total) AS total_dinero
            FROM
                cliente c
            LEFT JOIN
                transaccion t ON c.idcliente = t.idcliente
            GROUP BY
                c.idcliente, c.nombre, c.documento";
    
    $result = $conn->query($sql);

    // Verificar si se obtuvieron resultados
    if ($result->num_rows > 0) {
        // Inicializar un array para almacenar los resultados
        $clientes = array();

        // Obtener cada fila como un array asociativo y almacenarlos en el array $articulos
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
    } else {
        array_push($clientes,"No se encontraron resultados.");
    }
    return $clientes;
}

?>