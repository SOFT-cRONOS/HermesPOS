<?php
function getProductos($conn){
    // Consulta SQL para obtener los datos de la tabla articulo
    $sql = "SELECT 
                ca.nombre AS nombre_categoria,
                va.codigo AS codigo,
                cl.nombre AS producto,
                va.nombre AS nombre,
                va.descripcion AS detalle,
                va.precio_venta,
                va.precio_compra,
                va.ganancia,
                va.stock,
                va.imagen
            FROM
                variante_articulo va
            INNER JOIN
                clase_articulo cl ON va.idarticulo = cl.idarticulo
            INNER JOIN
                categoria ca ON cl.idcategoria = ca.idcategoria";
                
    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si se obtuvieron resultados
    if ($result->num_rows > 0) {
        // Inicializar un array para almacenar los resultados
        $articulos = array();

        // Obtener cada fila como un array asociativo y almacenarlos en el array $articulos
        while ($row = $result->fetch_assoc()) {
            $articulos[] = $row;
        }
    } else {
        array_push($articulos,"No se encontraron resultados.");
    }
    return $articulos;
}

function getCategorias($conn){
    $sql = "SELECT idcategoria, nombre FROM categoria";
    $result = $conn->query($sql);
    $categorias = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categorias[$row['idcategoria']] = $row['nombre'];
        }
    }
    
    // Comprobar si se ha seleccionado una categoría y guardarla en $idcategoria
    if (isset($_POST['cmbOpciones'])) {
        $idcategoria = $_POST['cmbOpciones'];
    } else {
        $idcategoria = 0; // Opción predeterminada si no se ha seleccionado nada
    }

    return $categorias;
}

function addArticulo($conn,$valores){
    $sql = "INSERT INTO articulo (idcategoria, codigo, nombre, precio_venta, 
    precio_compraganancia, stock, descripcion, imagen, estado, compuesto)
    VALUES ($valores)";

    $result = $conn->query($sql);

}

function addStock($conn){
    echo '';
}

function descStock($conn){
    echo '';
}


?>


