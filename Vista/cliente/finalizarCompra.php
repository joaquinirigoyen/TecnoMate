<?php
include_once("../../configuracion.php");
$objSesion = new Session();
$idUsuario= $_SESSION['idusuario'] ;
$colDatos = $_SESSION['carrito'];
$abmCompraItem = new AbmCompraItem();
$param['idusuario']=$idUsuario;


foreach ($colDatos as $producto => $detalles) {
  $arregloProductos[] = $detalles;
}

$objSesion->finalizarCompra($arregloProductos , $idUsuario);

if($objSesion){
  echo "<script>alert('Compra iniciada');</script>";
  header ('Location: homeCliente.php');
}else{
  echo "hubo un error";
}

?>