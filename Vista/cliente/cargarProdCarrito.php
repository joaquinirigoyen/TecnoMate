<?php
include_once("../../configuracion.php");
include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");


$datos = data_submitted();
$parametros["idusuario"] = $_SESSION['idusuario'];


//print_r($datos);
 $param['idproducto']=$datos['id'];
 $objAbmProducto = new AbmProducto(); 

 $arregloProd=$objAbmProducto->buscar($param);
 //print_r($arregloProd);

 $objUsuario = new AbmUsuario(); 
 $usuario =$objUsuario->buscar($parametros);
 //print_r($usuario);

 $objetoCompra = new AbmCompra();
 $fechaAlta = date('Y-m-d H:i:s');

 $param2["cofecha"] =$fechaAlta;
 $param2['idusuario']= $datos['id'];
 $objalta = $objetoCompra->alta($param2);
 echo   $objalta;
 if($objalta== true){
       echo "di alta producto";
 }
   /*$param['idusuario']=$datos['id'];

   $compra= $objetoCompra->buscar($paramComp); 
   print_r($compra);

   $paramit['idcompra']=$compra['idcompra']; 

   $objItem = new AbmCompraItem();
   $objItem->alta($paramit);
 }
 /*
 $comprActiva = $objetoCompra->buscarCarritoAbierto($parametros);
 echo $comprActiva;
 $paramIte['idusuario']=$datos['id'];
 $paramIte['idcompra']=$comprActiva;
 $paramIte['cicantidad']=$datos['cantidad'];

  if(  $comprActiva != null){
    $objItem = new AbmCompraItem();
    $altaItem =$objItem->alta($paramIte);
  }else{

      $fechaAlta = date('Y-m-d H:i:s');
      $param['idusuario']=$datos['id'];
      $param["cofecha"] =$fechaAlta;
      $objalta=$objetoCompra->alta($param);
      echo   $objalta;
      if($objalta== true){

        $param['idusuario']=$datos['id'];

        $compra= $objetoCompra->buscar($paramComp); 
        print_r($compra);
   
        $paramit['idcompra']=$compra['idcompra']; 
   
        $objItem = new AbmCompraItem();
        $objItem->alta($paramit);
      }
*/
   
  

  include_once("../estructura/footer.php");
?>

