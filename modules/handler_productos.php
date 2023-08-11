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


function addCArticuloS($pdo, $idcategoria, $codigo, $nombre, $stock, $descripcion, $um, $estado){
    $sql = "INSERT INTO clase_articulo (idcategoria, codigo, nombre, stock, descripcion, um, estado)
            VALUES (:idcategoria, :codigo, :nombre, :stock, :descripcion, :um, :estado)";

    $params = array(
        ':codigo' => $codigo,
        ':idcategoria' => $idcategoria,
        ':nombre' => $nombre,
        ':stock' => $stock,
        ':descripcion' => $descripcion,
        ':um' => $um,
        ':estado' => $estado
    );

    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute($params);

    if (!$success) {
        $errorInfo = $stmt->errorInfo();
        echo $errorInfo[2];
        throw new Exception($errorInfo[2]);
    }

    return $pdo->lastInsertId();
}

function addVarArticulo($pdo, $idArticulo, $acodigo, $anombre, $precio_compra, $precio_venta, $ganancia, $stock, $adescripcion, $imagen, $compuesto, $estado){
    
    // Consulta preparada
    $sql = "INSERT INTO variante_articulo (idarticulo, codigo, nombre, precio_compra, precio_venta, ganancia, stock, descripcion, imagen, compuesto, estado)
             VALUES (:idarticulo, :codigo, :nombre, :precio_compra, :precio_venta, :ganancia, :stock, :descripcion, :imagen, :compuesto, :estado)";

    // Valores a insertar
    $values = array(
        ':idarticulo' => $idArticulo,
        ':codigo' => $acodigo,
        ':nombre' => $anombre,
        ':precio_compra' => intval($precio_compra),
        ':precio_venta' => intval($precio_venta),
        ':ganancia' => intval($ganancia),
        ':stock' => intval($stock),
        ':descripcion' => $adescripcion,
        ':imagen' => $imagen,
        ':compuesto' => $compuesto,
        ':estado' => $estado
    );

    foreach ($values as $valor) {
        echo $valor . "<br>";
    }
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

function cantReg($pdo, $nombretabla){
    try {
        // Habilita el modo de errores para PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Consulta SQL para obtener la cantidad de registros en la tabla
        $sql = "SELECT COUNT(*) as total FROM $nombretabla";
    
        // Preparar la consulta
        $stmt = $pdo->prepare($sql);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Mostrar el total de registros
        return $resultado['total'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Conexión a la base de datos (asegúrate de tener la conexión aquí)
require_once "../Admin/conect.php";
$pdo = connect_sql_pdo();


// Manejar el formulario de agregar artículo simple
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addArtiucloSimple"])) {  
    //clase articulo
    $idcategoria = $_POST["idcategoria"];
    $codigo = $_POST["codigo"];
    $nombre = $_POST["clnombre"]; 
    $descripcion = $_POST["descripcion"]; 
    $um = $_POST["um"];
    $estado = false;
    $stock = 0; 


    //articulo
    //agrego la clase de producto y me devuelvo el id
    $idArticulo = intval(addCArticuloS($pdo, $idcategoria, $codigo, $nombre, $stock, $descripcion, $um, $estado));
    //cuento cuantas variantes hay y le sumo el codigo para generar el codigo de la variante
    $acodigo = $codigo . '_' . cantReg($pdo, 'variante_articulo');
    $anombre = $nombre;
    $precio_compra = $_POST["precio_compra"]; 
    $precio_venta = $_POST["precio_venta"]; 
    $ganancia = $_POST["ganancia"]; 
    $stock = $_POST["stock"];
    $adescripcion = $descripcion;
    $imagen = $_POST["imagen"];
    $compuesto = false;
    $aestado = false;

    // Llamar a la función para agregar artículo
    $consulta = addVarArticulo($pdo, $idArticulo, $acodigo, $anombre, $precio_compra, $precio_venta, $ganancia, $stock, $adescripcion, $imagen, $compuesto, $aestado);

    if ($consulta[0] !== '00000') {
        header("Location: ../pages/nuevo_producto.php?estado=correct"); // El mensaje de error se encuentra en el índice 2 del array
        exit;
    } else {
       header("Location: ../pages/nuevo_producto.php?estado=invalid");
       exit;
    }
    
}

// Manejar el formulario de actualizar artículo
//if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["actualizar_articulo"])) {
    //$idArticulo = $_POST["id_articulo"];
    //$nuevoNombre = $_POST["nuevo_nombre"];
    // Obtener otros valores del formulario

    // Llamar a la función para actualizar artículo
    //actualizarArticulo($pdo, $idArticulo, $nuevoNombre, /* otros parámetros */);

    // Redirigir a una página de éxito o hacer lo que necesites
    //header("Location: exito.php");
    //exit;
//}

// Aquí puedes seguir agregando más bloques if para otros formularios o acciones

// ... Resto del código ...

?>
