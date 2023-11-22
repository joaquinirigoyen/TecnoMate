<?php
include_once '../../configuracion.php';
include_once '../estructura/headSeguro.php';
include_once("../estructura/navSeguro.php");

$cod=$_GET["codigo"];
//echo $cod;
$param['idproducto']=$cod;

//echo$param;

$objProducto= new AbmProducto();

$listaProd=$objProducto->buscar($param);
//print_r($listaProd);
 
    $nombre=$listaProd[0]->getProNombre();
    $precio=$listaProd[0]->getProDetalle();
    $imagen=$listaProd [0]->getImagenProducto();
    $tipo=$listaProd [0]->getImagenProducto();
    $stock = $listaProd[0]->getProCantstock();

?>
<div class="container p-3 " style="display: flex; justify-content: center; align-items: center;">

<form  method='post' action="detalleProducto.php?codigo=<?php echo $cod?>">
<div class="card w-75 mb-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img id="imagenProd" name="imagenProd"  src="<?php echo $imagen?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
         <label  class="col-form-label"><strong>Nombre Producto</strong></label>
         <input class="form-control form-control-sm " type='hidden' name='id' value="<?php echo $cod ?>">

         <input class="form-control form-control-sm" type='text'  name='nombre'  value="<?php echo $nombre ?>" readonly>

         <label  class="col-form-label"><strong>Precio</strong></label>
         <input class="form-control form-control-sm" type='text'  name='precio'  value="<?php echo $precio ?>" readonly>

         <label  class="col-form-label"><strong>Stock</strong></label>
         <input class="form-control form-control-sm" type='text'  name='stock'  value="<?php echo $stock ?>" readonly>

         <label for="cantidad"  class="col-form-label"><strong>Selecione Cantidad</strong></label>
         <input type="number"  name="cant"  value="1" min="1" max="<?php echo $stock ?>" class="form-control form-control-sm">

         <p class="card-text"><small class="text-body-secondary">Si esta seguro puede continuar</small></p>
         <button class="btn btn-dark"><input type="submit" value="Agregar Producto" name="btnAgregar"></button>
     </div>
  </div>
  </div>
</div>
</form>
</div>
<?php
    include_once("../estructura/footer.php");

  if(isset($_REQUEST["btnAgregar"])){
        $id= $_REQUEST["id"];
        $producto= $_REQUEST["nombre"];
        $precio= $_REQUEST["precio"];
        $stock = $_REQUEST["stock"];
        $cantidad= $_REQUEST["cant"];
    
        if (isset($_SESSION['carrito'][$producto]['cant'])) {
			$cantidad=$_REQUEST['cant']+$_SESSION['carrito'][$producto]['cant'];
			} else {
				$cantidad=$_REQUEST['cant'];
			}
      $_SESSION["carrito"][$producto]["id"]=  $id;
      $_SESSION["carrito"][$producto]["precio"]=  $precio;
      $_SESSION["carrito"][$producto]["stock"]=  $stock;
      $_SESSION["carrito"][$producto]["cant"]= $cantidad;

   echo "<script>alert('Producto cargado con exito');</script>";
  header("location: homeCliente.php");

    }
?>

