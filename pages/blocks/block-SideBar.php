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
                        <a class="collapse-item" href="clientes.php">Lista de Clientes</a>
                        <a class="collapse-item" href="nuevo_cliente.php">Nuevo Cliente</a>
                        <a class="collapse-item" href="reportes_clientes.php">Reportes</a>
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
                        <a class="collapse-item" href="productos.php">Lista de Productos</a>
                        <a class="collapse-item" href="nuevo_producto.php">Nuevo Producto</a>
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