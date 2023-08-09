    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Mis Clientes</h1>
                    <p class="mb-4">Listado de compradores . Para mas info ver la documentacion en la seccion <a target="_blank"
                            href="https://datatables.net">"listado de clientes"</a>.</p>

                    <!-- DataTales (tabla de Clientes) -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Empresa</th>
                                            <th>Compras</th>
                                            <th>Gastado</th>
                                            <th>Control</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Empresa</th>
                                            <th>Compras</th>
                                            <th>Gastado</th>
                                            <th>Control</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($result as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $row['empresa']; ?></td>
                                            <td><?php echo "" . number_format($row['total_compras'], 0, '.', ','); ?></td>
                                            <td><?php echo "$" . number_format($row['total_dinero'], 2, '.', ','); ?></td>
                                            <td><a class="btn btn-primary" href="editar_registro.php?id=<?php echo $row['idcliente']; ?>" role="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>                                            
                                            </td>
                                        </tr>
                                        <?php } ?>                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>