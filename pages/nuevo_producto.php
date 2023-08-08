
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
//obtengo categorias
$categorias = getCategorias($conn);

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
    <!-- Custom styles para formulario nuevo producto -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Comienzo Sidebar - Menu-->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand - Marca del programa -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon "><!--rotate-n-15-->
                    <img class="im-profile"  src="img/logo100x.png" width="50"> <!--rounded - circle-->
                </div>
                <div class="sidebar-brand-text mx-3">HERMES <sup>POS</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading Encabezado de seccion -->
            <div class="sidebar-heading">
                Punto de Venta
            </div>

            <!-- Nav Item - Vender -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-cart-plus"></i>
                <span>Vender</span></a>
            </li>


            <!-- Nav Item - Clientes Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClient"
                    aria-expanded="true" aria-controls="collapseClient">
                    <!-- Icono de boton -->
                    <i class="fas fa-fw fa-user"></i> 
                    <span>Clientes</span>
                </a>
                <div id="collapseClient" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- subtitulo <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="pages/productos.php">Lista de Clientes</a>
                        <a class="collapse-item" href="pages/cards.html">Nuevo Cliente</a>
                        <a class="collapse-item" href="pages/cards.html">Reportes</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Inventario
            </div>

            <!-- Nav Item - Articulos Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <!-- Icono de boton -->
                    <i class="fas fa-fw fa-archive"></i> 
                    <span>Articulos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- subtitulo <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="pages/productos.php">Lista de Productos</a>
                        <a class="collapse-item" href="pages/cards.html">Nuevo Producto</a>
                        <a class="collapse-item" href="pages/cards.html">Descuentos</a>
                        <a class="collapse-item" href="pages/cards.html">Historial de Inventario</a>
                        <a class="collapse-item" href="pages/cards.html">Categorias</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Vender -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-users"></i>
                <span>Proveedores</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            
            <!-- Heading -->
            <div class="sidebar-heading">
                Configuracion
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseUsers">
                    <i class="fas fa-fw fa-user-circle"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Nuevo Usuario</h6>
                        <a class="collapse-item" href="login.php">Chat</a>
                        <a class="collapse-item" href="register.html">Mensajes</a>
                        <!-- <div class="collapse-divider"></div> -->
                        <!-- <h6 class="collapse-header">Other Pages:</h6> -->
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Preferencias</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Ocultar sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="">Ver ahora!</a>
            </div>

        </ul>
        <!-- End of Sidebar - Fin Sidebar Menu -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar - Barra superior -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts - Alertas-->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts - contador de alerta-->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alertas
                                </h6>
                                <!-- Formato de alerta -->
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Diciembre 12, 2023</div>
                                        <span class="font-weight-bold">Un nuevo reporte fue generado.</span>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Ver todas</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages - icono mensajes -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages - Contador de mensajes -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages - mensajes -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Mis mensajes
                                </h6>
                                <!-- resumen de mensaje mensaje -->
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <!-- Fin resumen de mensaje mensaje -->
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $nombre_completo; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information - Menu usuario -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuracion
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar - Barra superior -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Mis productos</h1>
                    <p class="mb-4">Listado de todos los productos ingresados <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales (tabla de Productos) -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>categoria</th>
                                            <th>Codigo</th>
                                            <th>Producto</th>
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Stock</th>
                                            <th>Ganancia</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>categoria</th>
                                            <th>Codigo</th>
                                            <th>Producto</th>
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Stock</th>
                                            <th>Ganancia</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($result as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['nombre_categoria']; ?></td>
                                            <td><?php echo $row['codigo']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo "$" . number_format($row['precio_compra'], 2, '.', ','); ?></td>
                                            <td><?php echo "$" . number_format($row['precio_venta'], 2, '.', ','); ?></td>
                                            <td><?php echo $row['stock']; ?></td>
                                            <td><?php echo $row['ganancia']; ?></td>
                                        </tr>
                                        <?php } ?>                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        </div>
                        <!-- test combobox -->
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <form method="post">
                                        <label for="cmbOpciones">Selecciona una categoría:</label>
                                        <select class="form-control" id="cmbOpciones" name="cmbOpciones">
                                            <?php 
                                                foreach ($categorias as $id => $nombre) {
                                                    echo "<option> $nombre </option>";
                                                } 
                                            ?>
                                        </select>
                                        <br>
                                        <input type="submit" class="btn btn-primary" value="Guardar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    <!-- Formulario Nuevo Producto -->  
                         <!-- https://getbootstrap.com/docs/4.0/components/forms/ -->
                        <!-- ver mas en https://getbootstrap.com/docs/4.0/components/buttons/ -->
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h3 class="mb-0">Cargando un nuevo artiuclo</h3>
                            </div>
                            <div class="card-body">
                                <!-- Contenido formulario -->
                                <div class="row mt-4">
                                    <!-- Inicio controles -->
                                    <div class="col-sm-3 pb-3">
                                        <label for="exampleAccount">Codigo</label> 
                                        <input class="form-control" id="exampleAccount" placeholder="XXXXX" type="text">
                                        <a class="btn btn-primary btn-sm" href="Lector_codigo_barras/test.html" role="button" style="margin-top:3px">Escanear</a>
                                    </div>
                                    <div class="col-sm-2 pb-3">
                                        <!-- -->
                                        <!-- combobox  -->                                        
                                        <label for="exampleSt">Categoria</label> 
                                        <select class="form-control custom-select" id="exampleSt">
                                            <option class="text-white bg-warning">
                                                Pick a state
                                            </option>
                                            <?php 
                                                foreach ($categorias as $id => $nombre) {
                                                    echo "<option> $nombre </option>";
                                                } 
                                            ?>
                                        </select>
                                        <!-- -->
                                    </div>
                                    <div class="col-sm-3 pb-3">
                                        <label for="exampleFirst">Nombre</label> 
                                        <input class="form-control" id="exampleFirst" type="text">
                                        <small class="text-muted">Texto 0/100%.</small>
                                    </div>
                                    <div class="col-sm-4 pb-3">
                                        <label for="exampleLast">Descripcion</label> 
                                        <input class="form-control" id="exampleLast" type="text">
                                        <small class="text-muted">Texto 0/100%</small>
                                    </div>
                                    <div class="col-sm-2 pb-3">
                                        <label for="exampleAmount">Precio Compra</label>
                                        <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                            <input class="form-control" id="exampleAmount" placeholder="Amount" type="number">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 pb-3">
                                        <label for="exampleAmount">Precio Venta</label>
                                        <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                            <input class="form-control" id="exampleAmount" placeholder="Amount" type="number">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 pb-3">
                                        <label for="exampleAmount">Ganancia</label>
                                        <div class="input-group">
                                        <div class="input-group-addon">%</div>
                                            <input class="form-control" id="exampleAmount" placeholder="Amount" type="number">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 pb-3">
                                        <!-- -->
                                        <!-- combobox  -->                                        
                                        <label for="exampleSt">Unidad Medida</label> 
                                        <select class="form-control custom-select" id="exampleSt">
                                            <option class="text-white bg-warning">
                                                Pick a state
                                            </option>
                                            <?php 
                                                foreach ($categorias as $id => $nombre) {
                                                    echo "<option> $nombre </option>";
                                                } 
                                            ?>
                                        </select>
                                        <!-- -->
                                    </div>
                                    <div class="col-sm-2 pb-3">
                                        <label for="exampleAmount">Stock</label>
                                        <div class="input-group">
                                        <div class="input-group-addon">m2</div>
                                            <input class="form-control" id="exampleAmount" placeholder="Amount" type="number">
                                        </div>
                                    </div>
                                </div>
                                <!-- segunda fila -->
                                <div class="row mt-4">
                                    <div class="card border-light mb-4">
                                        <p>
                                            <!-- agruegar disabled a la clase para deshabilitar-->
                                            <a class="btn btn-primary " aria-disabled="false" data-toggle="collapse" href="#collapseExample" role="button"  aria-expanded="false" aria-controls="collapseExample" >
                                                Configurar Variantes
                                            </a>
                                        </p>
                                        <!-- Menu desplegable de variantes -->
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <?php 
                                                //incorporacion de block nueva variante prodcutos
                                                    include "blocks/block-productos.php";
                                                ?>
                                            </div>
                                        </div>
                                        <!-- FinMenu desplegable de variantes -->
                                    </div>
                                </div>
                                    <!-- tercer fila -->
                                <div class="row mt-4">
                                    <div class="col-sm-4 pb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Default checkbox
                                            </label>
                                        </div>                                       
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                <input class="btn btn-secondary" type="reset" value="Cancel"> 
                                                    <input class="btn btn-primary" type="button" value="Send">
                                </div>
                            </div>
                        </div>
                        <!--/card-->
                    <!-- Fin Formulario Nuevo Producto -->                       

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; HermesPOS 2023</span>
                    </div>
                </div>
            </footer>
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