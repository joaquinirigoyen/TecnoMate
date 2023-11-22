<?php
include_once ('../../configuracion.php');

$cod=$_REQUEST['codigo'];

$param['idproducto']=$cod;

$objProducto= new AbmProducto();

$producto=$objProducto->buscar($param);

?>
<!-- Crea un modal con un formulario para actualizar productos -->


        <form name="formCrearProducto" id="formCrearProducto" method="POST" class="needs-validation" novalidate>
          
          <div class="contenedor-dato">
          <label class="form-label">ID de producto</label>
          <input class="form-control" type="text" name="idproducto" id="idproducto" value="<?php echo $producto[0]->getIdProducto() ?>" readonly></input><br>
          </div>
          <br>
          <div class="contenedor-dato">
          <label class="form-label">Nombre</label>
          <input  class="form-control" type="text" name="pronombre" id="pronombre" value="<?php echo $producto[0]->getProNombre() ?>" ></input><br>
          </div>
          <br>

          <div class="contenedor-dato">
          <label class="form-label">Precio</label>
          <input  class="form-control" type="text" name="prodetalle" id="prodetalle" value="<?php echo $producto[0]->getProDetalle() ?>"></input>
          </div>
          <br>
          <div class="contenedor-dato">
          <label for="procantstock"  class="form-label">Cantidad de Stock</label>
                <input type="number" class="form-control" min="0" id="procantstock" name="procantstock" placeholder="" required>
          </div>
          <br>
          <div class="contenedor-dato">
          <label class="form-label">Tipo</label>
           <input  class="form-control" type="text" name="tipo" id="tipo" value="<?php echo $producto[0]->getTipo() ?>" ></input>
          </div>
          <br>
          <div class="d-grid mb-3 gap-2">
          <button  type="submit" class="btn text-white  btn-dark">Actualizar datos</button>
          </div>
        </form>
    
<script src="../js/modifarProducto.js"></script>