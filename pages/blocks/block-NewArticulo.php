<!-- Código de acordeón para Bootstrap 4 -->
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Articulos simple (sin variante)
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
        <!-- Form con POST -->
            <!-- Primer fila -->
            <div class="row mt-4">                                 
                <div class="col-sm-3 pb-3">
                    <label for="codigo">Codigo</label> 
                    <input class="form-control" id="codigo" name="codigo" placeholder="XXXXX" type="text">
                    <a class="btn btn-primary btn-sm" href="Lector_codigo_barras/test.html" role="button" style="margin-top:3px">Escanear</a>
                </div>
                <div class="col-sm-2 pb-3">
                    <!-- combobox  -->                                        
                    <label for="idcategoria">Categoria</label> 
                    <select class="form-control custom-select" id="idcategoria" name="idcategoria" > 
                        <option class="text-white bg-warning">                   
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
                    <select class="form-control custom-select" id="um" onchange="updateAddonText()">
                        <option class="text-white bg-warning">
                            unidad
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
                        <div id="addonText" class="input-group-addon">m2</div>
                        <input class="form-control" id="exampleAmount" placeholder="0" type="number">
                    </div>
                </div>
            </div>
            <!-- Botones guardar -->
            <div class="row mt-8 justify-content-end">
                <div class="col-sm-2">
                    <input class="btn btn-secondary btn-block" type="reset" value="Cancelar"> 
                </div>
                <div class="col-sm-2">
                    <input class="btn btn-primary btn-block" type="button" name="addArtiucloSimple" value="Guardar">
                </div>
            </div>
        <!-- Fin Form -->
        </div>
    </div>
  </div>
  
  <!-- Repite el patrón para más elementos de acordeón -->
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseCv" aria-expanded="false" aria-controls="collapseCv">
          Articulos con Variantes
        </button>
      </h2>
    </div>

    <div id="collapseCv" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
        <!-- Form con POST -->
            <!-- Primer fila -->
            <div class="row mt-4">                                 
                <div class="col-sm-3 pb-3">
                    <label for="exampleAccount">Codigo</label> 
                    <input class="form-control" id="exampleAccount" placeholder="XXXXX" type="text">
                </div>
                <div class="col-sm-3 pb-3">
                    <label for="Btn-scan"></label><br>
                    <a class="btn btn-primary btn-sm" id="Btn-scan"  href="Lector_codigo_barras/test.html" role="button" style="margin-top:3px">Escanear</a>
                </div>
            </div>

            <!-- Segunda fila -->
            <div class="row mt-4">
                <div class="col-sm-2 pb-3">
                    <!-- combobox  -->                                        
                    <label for="exampleSt">Categoria</label> 
                    <select class="form-control custom-select" id="exampleSt">
                        <option class="text-white bg-warning">
                            
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
                    <label for="exampleLast">Descripcion general</label> 
                    <input class="form-control" id="exampleLast" type="text">
                    <small class="text-muted">Texto 0/100%</small>
                </div>
                <div class="col-sm-2 pb-3">
                    <!-- -->
                    <!-- combobox  -->                                        
                    <label for="um">Forma de venta</label> 
                    <select class="form-control custom-select" id="um" onchange="updateAddonText()">
                        <option class="text-white bg-warning">
                            unidad
                        </option>
                        <?php 
                            foreach ($categorias as $id => $nombre) {
                                echo "<option> $nombre </option>";
                            } 
                        ?>
                    </select>
                    <!-- -->
                </div>
            </div>
            <!-- Botones guardar -->
            <div class="row mt-4">
                <div class="float-right">
                    <input class="btn btn-secondary" type="reset" value="Cancel"> 
                    <input class="btn btn-primary" type="button" value="Send">
                </div>
            </div>
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

