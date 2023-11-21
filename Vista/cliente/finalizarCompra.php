<?php
include_once("../../configuracion.php");
$objSesion = new Session();
$idUsuario= $_SESSION['idusuario'] ;
$colDatos = $_SESSION['carrito'];
$objCompraItem = new AbmCompraItem();
$objCompraEstado = new AbmCompraEstado();

foreach ($_SESSION['carrito'] as $indice => $arreglo){
  foreach($arreglo as $key => $value){
    $nuevoArray = [];
    array_push($nuevoArray,$key);
  }
}

foreach ($colDatos as $producto => $detalles) {
  $arregloProductos[] = $detalles;
}

$objSesion->finalizarCompra($arregloProductos , $idUsuario);

if($objSesion){
  header ('Location: homeCliente.php');
}else{
  echo "hubo un error";
}



/* Dar e alta una compra*/

// $objCompra = new AbmCompra();


// $fecha=date('Y-m-d h:i:s');
// $param["cofecha"] = $fecha;
// $param["idusuario"] = $idUsuario;
// $respuesta= $objCompra->alta($param);

/*if($respuesta ==true){
    echo"di de alta una compra";
} else if ($respuesta == false){
    echo"estoy dando falso";
}*/

 //echo $altaComp;
//$paramC["idusuario"] = $idUsuario;
//$compraCliente=$objCompra->buscar($paramC);
//print_r($compraCliente);



// foreach ($_SESSION['carrito'] as $indice => $arreglo) {
//     $objProducto = new AbmProducto();
//     // echo $indice;
//     $paramC["idusuario"] = $idUsuario;
//     $compraCliente=$objCompra->buscar($paramC);
//    //print_r($compraCliente);
//     $param['idproducto'] = $indice;
//     $producto= $objProducto->buscar($param);
//     print_r($producto) ;
    
//     $arrayParamI = [];
//     $arrayParamI['idproducto']= $producto;
//     $arrayParamI['idcompra']= $compraCliente['idcompra'];
//     $pararrayParamIamI['cicantidad']=$arreglo['cant'];


//     $objCompraItem = new AbmCompraItem();
//     $resp=$objCompraItem ->alta($arrayParamI);
//     if($resp ==true){
//         echo"di de alta una iten";
//     } else if ($resp== false){
//         echo"estoy dando falso";
//     }

//   }
/*
  if ( $altaIten) {
    echo "La compra se ha realizado correctamente.";
   $objSesion->eliminarCarrito();
  } else {
    echo "Ha ocurrido un error al realizar la compra.";
  }
*/
?>