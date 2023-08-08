                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Mis productos</h1>
                    <p class="mb-4">Listado de todos los productos ingresados <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales (tabla de Clientes) -->
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
                                            <th>detalle</th>
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Ganancia</th>
                                            <th>Stock</th>
                                            <th>Imagen</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>categoria</th>
                                            <th>Codigo</th>
                                            <th>Producto</th>
                                            <th>detalle</th>
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Ganancia</th>
                                            <th>Stock</th>
                                            <th>Imagen</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($result as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['nombre_categoria']; ?></td>
                                            <td><?php echo $row['codigo']; ?></td>
                                            <td><?php echo $row['producto']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo "$" . number_format($row['precio_compra'], 2, '.', ','); ?></td>
                                            <td><?php echo "$" . number_format($row['precio_venta'], 2, '.', ','); ?></td>
                                            <td><?php echo $row['ganancia']; ?></td>
                                            <td><?php echo $row['stock']; ?></td>
                                            <td><img src=<?php echo $row['imagen']; ?> width="50"></td>
                                        </tr>
                                        <?php } ?>                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>