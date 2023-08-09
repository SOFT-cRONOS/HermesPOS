
<!-- Inicio modulo de base de php -->
<?php

//coneccion y datos de usuario
require_once "../Admin/conect.php";

//modulos
require_once "../modules/handler_productos.php";


// Iniciar la sesión para acceder a las variables de sesión
session_start();

$conn = connect_sql();

$datos = verificar_init();

//obtengo los productos
$result = getProductos($conn);

// Cerrar la conexión
$conn->close();
?>
<!--fin consulta productos-->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HermesPOS - Productos</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Comienzo Sidebar - Menu-->
        <?php 
        //incorporacion del navbar
            include "blocks/block-SideBar.php";
        ?>
        <!-- End of Sidebar - Fin Sidebar Menu -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar - Barra superior -->
                <?php 
                //incorporacion del navbar
                    include "blocks/block-TopBar.php";
                ?>
                <!-- End of Topbar - Barra superior -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Registro de Nuevo cliente</h1>
                    <p class="mb-4">Estamos por registrar a un nuevo cliente. Para mas info ver  <a target="_blank"
                            href="https://datatables.net">Documentacion de Clientes</a>.</p>
                    <!-- Formulario Nuevo Cliente -->  
                    <!-- https://getbootstrap.com/docs/4.0/components/forms/ -->
                    <!-- ver mas en https://getbootstrap.com/docs/4.0/components/buttons/ -->
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h3 class="mb-0">Ingreso de datos</h3>
                            </div>
                            <form action="../modules/Add_nCLiente.php" method="POST">
                                <div class="card-body">
                                    <!-- Contenido formulario -->
                                    
                                        <div class="row mt-4">
                                            <!-- Inicio controles -->
                                            <div class="col-sm-3 pb-3">
                                                <label for="nombre">Nombre</label> 
                                                <input class="form-control" id="nombre" name="nombre" placeholder="" type="text">
                                            </div>
                                            <div class="col-sm-3 pb-3">
                                                <label for="doc">Documento</label> 
                                                <input class="form-control" id="documento" name="documento"type="text">                            
                                            </div>
                                            <div class="col-sm-4 pb-3">
                                                <label for="direccion">Direccion</label>
                                                <input class="form-control" id="direccion" name="direccion" type="text">
                                            </div>
                                            <div class="col-sm-4 pb-3">
                                                <label for="telefono">Telefono</label> 
                                                <input class="form-control" id="telefono" name="telefono" type="text">                                        
                                            </div>
                                            <div class="col-sm-4 pb-3">
                                                <label for="email">Email</label> 
                                                <input class="form-control" id="email" name="email" type="text">                                        
                                            </div>
                                            <div class="col-sm-4 pb-3">
                                                <label for="empresa">Empresa</label> 
                                                <input class="form-control" id="empresa" name="empresa" type="text">                                    
                                            </div>                                    
                                        </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="float-right">
                                        <?php if (isset($_GET['estado']) && $_GET['error'] === 'invalid'): ?>
                                            <p class="alert alert-danger">El cliente no se pudo cargar</p>
                                        <?php endif; ?>
                                        <?php if (isset($_GET['estado']) && $_GET['error'] === 'correct'): ?>
                                            <p class="alert alert-danger">El cliente se cargo correctamente</p>
                                        <?php endif; ?>
        
                                        <input class="btn btn-secondary" type="reset" value="Cancelar"> 
                                        <input class="btn btn-primary" type="submit" value="Guardar">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/card-->
                    <!-- Fin Formulario Nuevo Producto -->                       

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php 
            //incorporacion del navbar
                include "blocks/block-Footer.php";
            ?>               
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- deslogeo Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Exit" si usted cree que esta listo para cerrar el programa, en caso contrario seleccione "Cancel".</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../Admin/logout.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>