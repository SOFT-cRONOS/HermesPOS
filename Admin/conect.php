
<?php
function connect_sql() { //conexion a sql
    // Configuración de la conexión a la base de datos
    $servername = "localhost";
    $username = "admin";
    $password = "Cronos71@";
    $dbname = "hermespos";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error al conectar con la base de datos: " . $conn->connect_error);
        return "Error al conectar con la base de datos: " . $conn->connect_error;
    }
    else {
        return $conn;
    }
}

function verificar_usuario($username, $password) { //seguridad de login
    
    $conn = connect_sql();
    
    //$sql = "CALL GetLogUser('$username', '$password')";
    $sql = "SELECT * FROM usuario WHERE nick = '$username' AND contrasena = '$password'";
        
    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si el usuario y la contraseña son válidos
    if ($result->num_rows === 1) {
        // Iniciar sesión para guardar el nombre de usuario
        session_start();
        $_SESSION['username'] = $username;

        //Busco el nombre completo del usuario
        $sql = "SELECT nombre FROM usuario WHERE nick = '$username'";
        $result = $conn->query($sql);

        // Verificar si se obtuvieron resultados
        if ($result->num_rows > 0) {
            // Obtener el resultado de la consulta y cargar el nombre en la variable $nombre_completo
            $row = $result->fetch_assoc();
            $nombre_completo = $row["nombre"];
        } else {
            echo "No se encontró ningún usuario con el nick ' . $username . ''.";
        }

        // Guardar información del usuario en una cookie
        // Establecer el tiempo de expiración de la cookie (en segundos desde el momento actual)
        $expiracion = time() + (86400 * 30); // la cookie expirará en 30 días

        // Valores a guardar en la cookie
        $datos = array(
            'UserName_init' => $username,
            'UserDataName' => $nombre_completo
        );
        
        // Convertir el array en formato JSON
        $datos_json = json_encode($datos);
        
        // Crear la cookie con los datos en formato JSON
        setcookie("login_data", $datos_json, $expiracion, "/");
                        // metodo solo nombre
                        // Convertir el array en formato JSON
                        //$datos_json = json_encode($datos);
                        //setcookie('UserName_init', $username, time() + (86400 * 30), '/'); // Caduca en 30 días

        // Redirigir a la página home"
        header("Location: ../index.php");
        exit;
    } else {
        // Inicio de sesión fallido, redirigir de vuelta a login.php con mensaje de error por query string
        header("Location: login.php?error=invalid&username=". urlencode($username) );
        exit;
    }

    //cierro coneccion
    $conn->close();
}

function verificar_init(){ //da los datos de usuario o manda al login
    // Si no se inicio, Iniciar la sesión para acceder a las variables de sesión
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Si el usuario no ha iniciado sesión, redirigir al login
    if (!isset($_COOKIE['login_data']) && !isset($_SESSION['username'])) {
        header("Location: pages/login.php");
        exit;
    }
    else {
        // Obtener el valor de la cookie en formato JSON
        $datos_json = $_COOKIE['login_data'];

        // Convertir el JSON a un array asociativo
        $datos = json_decode($datos_json, true);

        return $datos;
        // Usar los valores
        //$_SESSION['username'] = $datos['UserName_init'];
        //$nombre_completo = $datos['UserDataName'];
        //$username = $_SESSION['username'];
    }
}

?>