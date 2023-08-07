<?php
    //coneccion y datos de usuario
    require_once "Admin/conect.php";

    function palco_productos($conn){
    // Realiza la consulta SQL para obtener los 3 productos más vendidos
    $sql = "SELECT idarticulo, COUNT(*) AS total_ventas FROM detalle_transaccion GROUP BY idarticulo ORDER BY total_ventas DESC LIMIT 3";

    // Ejecuta la consulta
    $result = $conn->query($sql);

    // Crea un array para almacenar los datos de los productos más vendidos
    $productos_mas_vendidos = array();

    // Inicializa una variable para almacenar el total de productos vendidos
    $total_productos_vendidos = 0;

    // Verifica si hay resultados y calcula el total de productos vendidos
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $total_productos_vendidos += $row['total_ventas'];
        }
    }

    // Verifica si el total de productos vendidos es mayor que cero (para evitar división por cero)
    if ($total_productos_vendidos > 0) {
        // Itera a través de los resultados y almacena los datos de los productos más vendidos en el array
        while ($row = $result->fetch_assoc()) {
            $idarticulo = $row['idarticulo'];
            $total_ventas = $row['total_ventas'];

            // Consulta para obtener los detalles del producto
            $sql_producto = "SELECT * FROM articulo WHERE idarticulo = $idarticulo";
            $result_producto = $conn->query($sql_producto);

            // Verifica si hay resultados y obtén los detalles del producto
            if ($result_producto->num_rows > 0) {
                $producto = $result_producto->fetch_assoc();
                $nombre_producto = $producto['nombre'];
                $precio_venta = $producto['precio_venta'];

                // Calcula el porcentaje de ventas del producto sobre el total
                $porcentaje_ventas = ($total_ventas / $total_productos_vendidos) * 100;

                // Almacena los datos en el array de productos más vendidos
                $productos_mas_vendidos[] = array(
                    'nombre' => $nombre_producto,
                    'total_ventas' => $total_ventas,
                    'ingresos' => $total_ventas * $precio_venta,
                    'porcentaje_ventas' => $porcentaje_ventas
                );
            }
        }
    }

    // Devuelve el array con los datos de los productos más vendidos
    return $productos_mas_vendidos;
}
?>
