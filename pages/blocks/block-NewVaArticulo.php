
<!-- Menu Nueva Variante articulo-->
<div class="row mt-4">                                
    <div class="col-sm-2 pb-3">
        <label for="exampleAccount">Codigo Variante</label> 
        <input class="form-control" id="codigovariante" placeholder="XXXXX" type="text">
    </div>
    <div class="col-sm-2 pb-3">
        <label for="exampleFirst">Nombre</label> 
        <input class="form-control" id="exampleFirst" type="text">
        <small class="text-muted">Texto 0/100%.</small>
    </div>
    <div class="col-sm-2 pb-3">
        <label for="exampleLast">Imagen</label> 
        <div class="custom-file">
            
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Ruta/Link</label>
        </div>
    </div>
</div>
<div class="row mt-4"> 
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
        <label for="exampleAmount">Stock</label>
        <div class="input-group">
        <div class="input-group-addon">m2</div>
            <input class="form-control" id="exampleAmount" placeholder="Amount" type="number">
        </div>
    </div>
</div>
<!-- Botones guardar -->
<div class="row mb-4 justify-content-end"> 
    <div class="col-sm-2">
        <input class="btn btn-secondary btn-block" type="reset" value="Cancelar"> 
    </div>
    <div class="col-sm-2">
        <input class="btn btn-primary btn-block" type="button" value="Guardar">
    </div>
</div>
<!-- Divider -->
<hr class="sidebar-divider my-0">
<script>
    cantvariantes = <?php echo cantReg($pdo, 'variante_articulo'); ?>;
</script>