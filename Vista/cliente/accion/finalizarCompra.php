<?php
include_once("../../../configuracion.php");
$objSesion = new Session();
$idUsuario= $_SESSION['idusuario'] ;
$colDatos = $_SESSION['carrito'];
$abmCompraItem = new AbmCompraItem();
$abmCompra = new AbmCompra();
$param['idusuario']=$idUsuario;

foreach ($colDatos as $producto => $detalles) {
  $arregloProductos[] = $detalles;
}

$abmCompra->finalizarCompra($arregloProductos , $idUsuario);

if($abmCompra ){
  echo "<script>alert('Compra iniciada');</script>";
  header ('Location: ../homeCliente.php');
}else{
  echo "<script>alert('Hubo un error');</script>";
}

?>