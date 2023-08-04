<?php
// Obtener la ruta absoluta del directorio actual
$dir = __DIR__;


// Construir la ruta completa al archivo de conexión
$connection_file = '../Admin/conect.php';

// Verificar si el archivo existe antes de incluirlo
if (file_exists($connection_file)) {
    require_once $connection_file;
} else {
    die("Archivo de conexión no encontrado en $dir/Admin/conect.php.");
}


// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario de inicio de sesión
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario y la contraseña de la tabla usuarios que coincidan con lo ingresado
    
    $sql = "SELECT * FROM usuario WHERE nick = '$username' AND contrasena = '$password'";
    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si el usuario y la contraseña son válidos
    if ($result->num_rows === 1) {
        // Iniciar sesión para guardar el nombre de usuario
        session_start();
        $_SESSION['username'] = $username;

        //Busco el nombre completo del usuario
        $sql = "SELECT nombre FROM usuario WHERE nick = 'admin'";
        $result = $conn->query($sql);

        // Verificar si se obtuvieron resultados
        if ($result->num_rows > 0) {
            // Obtener el resultado de la consulta y cargar el nombre en la variable $nombre_completo
            $row = $result->fetch_assoc();
            $nombre_completo = $row["nombre"];
        } else {
            echo "No se encontró ningún usuario con el nick 'admin'.";
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
}
//cierro coneccion
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="login.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="username" aria-describedby="emailHelp"
                                                placeholder="Ingrese nombre de Usuario..."
                                                value=<?php echo isset($_GET['username']) ? htmlspecialchars($_GET['username']) : ''; ?>>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name= "password" class="form-control form-control-user"
                                                id="password" placeholder="Ingrese el Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <!--boton logeo -->
                                        <input type="submit" class= "btn btn-primary btn-user btn-block" value="Iniciar sesión">
                                        <hr>
                                        <!--
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                        -->
                                    </form>
                                    
                                    <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid'): ?>
                                        <p class="alert alert-danger">Contraseña inválida. Inténtalo nuevamente.</p>
                                    <?php endif; ?>

                                    
                                    <!--
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>