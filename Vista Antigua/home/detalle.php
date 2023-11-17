<?php
include_once '../../configuracion.php';
include_once '../estructura/secciones/head.php';
$cod=$_REQUEST['codigo'];

$param['idproducto']=$cod;

$carrito = [];
//echo $cod;
$objProducto= new AbmProducto();

$listaProd=$objProducto->buscar($param);
//print_r($listaProd);
 
    $nombre=$listaProd[0]->getProNombre();
    $precio=$listaProd[0]->getProDetalle();
    $imagen=$listaProd [0]->getImagenProducto();

?>
<form  method="POST" name="formProductos" action="../cliente/carrito.php">
<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img id="imagenProd" name="imagenProd"  src="<?php echo $imagen?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
         <label  class="col-form-label">Nombre Producto</label>
         <input class="form-control form-control-sm " type='hidden' name='id' id='id' value="<?php echo $cod ?>">
       
         <input class="form-control form-control-sm" type='text' name=' nombre' id='nombre' value="<?php echo $nombre ?>">
         <label  class="col-form-label">Precio</label>
         <input class="form-control form-control-sm" type='text' name='precio' id='precio'  value="<?php echo $precio ?>">

         <label for="cantidad"  name="cantidad" class="col-form-label">seleccione Cantidad</label>
         <input type="number" id="cantidad"  name="cantidad" value="" class="form-control form-control-sm">
        <p class="card-text"><small class="text-body-secondary">Si esta seguro puede continuar</small></p>
        <button class="btn btn-dark" type="submit" >Agregar al carrito</button>
     </div>
  </div>
  </div>
</div>
</form>

