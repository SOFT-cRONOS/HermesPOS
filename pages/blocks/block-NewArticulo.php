<?php
if (isset($_GET['most_repeated_code'])) {
    $BarCode = $_GET['most_repeated_code'];
} else {
    $BarCode = ""; // Valor por defecto si el parámetro no está presente
}
?>
<!-- Código de acordeón para Bootstrap 4 -->

<!-- Form con POST -->
        <!-- Primer fila -->
        <div class="row mt-4">                                 
            <div class="col-sm-3 pb-3">
                <label for="codigo">Codigo</label> 
                <input class="form-control" value='<?php echo $BarCode ?>' id="codigo" name="codigo" placeholder="XXXXX" type="text">
                <a class="btn btn-primary btn-sm" href="barcode/lector.html" role="button" style="margin-top:3px">Escanear</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#EscanModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Salir
                </a>
            </div>
            <div class="col-sm-2 pb-3">
                <!-- combobox  -->                                        
                <label for="idcategoria">Categoria</label> 
                <select class="form-control custom-select" id="idcategoria" name="idcategoria" > 
                    <option class="text-white bg-warning">                   
                    </option>
                    <?php 
                        foreach ($categorias as $id => $nombre) {
                            echo "<option value=\"$id\">$nombre</option>";
                        } 
                    ?>
                </select>
                <!-- -->
            </div>
            <div class="col-sm-3 pb-3">
                <label for="clnombre">Nombre</label> 
                <input class="form-control" id="clnombre" name="clnombre"  type="text">
                <small class="text-muted">Texto 0/100%.</small>
            </div>
            <div class="col-sm-4 pb-3">
                <label for="descripcion">Descripcion</label> 
                <input class="form-control" id="descripcion" name="descripcion"  type="text">
                <small class="text-muted">Texto 0/100%</small>
            </div>
        </div>
        <!-- Segunda fila -->
        <div class="row mt-4">
            <div class="col-sm-2 pb-3">
                <label for="imagen">Imagen</label> 
                <input class="form-control" id="imagen" name="imagen" placeholder="Link"  type="text">
                <small class="text-muted">Texto 0/100%</small>
            </div>          
            <div class="col-sm-2 pb-3">
                <label for="precio_compra">Precio Compra</label>
                <div class="input-group">
                <div class="input-group-addon">$</div>
                    <input class="form-control" id="precio_compra" name="precio_compra" placeholder="0" type="number">
                </div>
            </div>
            <div class="col-sm-2 pb-3">
                <label for="precio_venta">Precio Venta</label>
                <div class="input-group">
                <div class="input-group-addon">$</div>
                    <input class="form-control" id="precio_venta" name="precio_venta" placeholder="0" type="number">
                </div>
            </div>
            <div class="col-sm-2 pb-3">
                <label for="ganancia">Ganancia</label>
                <div class="input-group">
                <div class="input-group-addon">%</div>
                    <input class="form-control" id="ganancia" name="ganancia" placeholder="0" type="number">
                </div>
            </div>
            <div class="col-sm-2 pb-3">
                <!-- -->
                <!-- combobox  -->                                        
                <label for="um">Forma de venta</label> 
                <select class="form-control custom-select" id="um" name="um" onchange="updateAddonText()">
                    <option class="text-white bg-warning">
                        unidad
                    </option>
                    <?php 
                        foreach ($categorias as $id => $nombre) {
                            echo "<option value=\"$id\">$nombre</option>";
                        } 
                    ?>
                </select>
                <!-- -->
            </div>
            <div class="col-sm-2 pb-3">
                <label for="stock">Stock</label>
                <div class="input-group">
                    <div id="addonText" class="input-group-addon">m2</div>
                    <input class="form-control" id="stock" name="stock" placeholder="0" type="number">
                </div>
            </div>
        </div>
        <!-- Botones guardar -->
        <div class="row mt-8 justify-content-end">
            <div class="col-sm-2">
                <input class="btn btn-secondary btn-block" type="reset" value="Cancelar"> 
            </div>
            <div class="col-sm-2">
                <input class="btn btn-primary btn-block" type="submit" name="addArtiucloSimple" value="Guardar">
            </div>
        </div>
<!-- Fin Form -->

<div class="accordion mt-4" id="accordionExample">
    <!-- Tarjeta 1 -->
    <div class="card">
        <!-- Encabezado -->
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseCv" aria-expanded="false" aria-controls="collapseCv">
            Variantes de articulo
            </button>
            </h2>
        </div>
        <!-- Contenido -->
        <div id="collapseCv" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
            <!-- Form con POST -->
                <!-- Primer fila -->

                <!-- Tercer fila -->
                <div class="row mt-4" >
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
                                //incorporacion de block nueva variante articulo
                                    include "blocks/block-NewVaArticulo.php";
                                ?>
                            </div>
                        </div>
                        <!-- FinMenu desplegable de variantes -->
                    </div>
                </div>
            <!-- Fin Form -->
            </div>
        </div>
    </div>
    <!-- Tarjeta 2 -->
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseCmbo" aria-expanded="false" aria-controls="collapseCmbo">
                Combo de Articulos (Producto compuesto)
            </button>
            </h2>
        </div>

        <div id="collapseCmbo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                Proximamente
            </div>
        </div>

    </div>
</div>

<script>
    function updateAddonText() {
        var select = document.getElementById("um");
        var selectedValue = select.options[select.selectedIndex].value;
        var addonText = document.getElementById("addonText");

        if (selectedValue === "varios") {
            addonText.innerHTML = "U"; // Cambiar a "U" si es "varios"
        } else if (selectedValue === "") {
            addonText.innerHTML = "m2"; // Cambiar a "m2" si es vacío
        } else {
            addonText.innerHTML = "m2"; // Por defecto, cambiar a "m2"
        }
    }
</script>

    <!-- Escaneo Producto Modal-->
    <div class="modal fade" id="EscanModal" tabindex="-1" role="dialog" aria-labelledby="EscaneoCodigo"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <!-- Bloque escaneo -->  
                        <?php
                            include "blocks/block-LectorCodigo.php";
                        ?>
                        <!-- Fin Bloque escaneo -->  
                    </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../Admin/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
