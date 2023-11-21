<?php
include_once("../../configuracion.php");
$objSesion = new Session();
$idUsuario= $_SESSION['idusuario'] ;



/* Dar e alta una compra*/

$objCompra = new AbmCompra();


$fecha=date('Y-m-d h:i:s');
$param["cofecha"] = $fecha;
$param["idusuario"] = $idUsuario;
$respuesta= $objCompra->alta($param);

/*if($respuesta ==true){
    echo"di de alta una compra";
} else if ($respuesta == false){
    echo"estoy dando falso";
}*/

 //echo $altaComp;
//$paramC["idusuario"] = $idUsuario;
//$compraCliente=$objCompra->buscar($paramC);
//print_r($compraCliente);



foreach ($_SESSION['carrito'] as $indice => $arreglo) {
    $objProducto = new AbmProducto();
    // echo $indice;
    $paramC["idusuario"] = $idUsuario;
    $compraCliente=$objCompra->buscar($paramC);
   // print_r($compraCliente);
    $param['pronombre']= $indice;
    $producto= $objProducto->buscar($param);
  // print_r($producto) ;
    
    $paramI['idproducto']= $producto['idproducto'];
    $paramI['idcompra']= $compraCliente['idcompra'];
    $paramI['cicantidad']=$arreglo['cant'];


    $objCompraItem = new AbmCompraItem();
    $resp=$objCompraItem ->alta($paramI);
    if($resp ==true){
        echo"di de alta una iten";
    } else if ($resp== false){
        echo"estoy dando falso";
    }

  }
/*
  if ( $altaIten) {
    echo "La compra se ha realizado correctamente.";
   $objSesion->eliminarCarrito();
  } else {
    echo "Ha ocurrido un error al realizar la compra.";
  }
*/
?>