<?php
    // include_once('../../../configuracion.php'); 
    // $data = data_submitted();
    // verEstructura($data);
    // $objAbmCompraItem= new AbmCompraItem();
    // $data ["accion"] = "borrarItem";
    // $resultado = $objAbmCompraItem -> abm($data);

    // if ($resultado["exito"]) {
    //     echo json_encode(array("success" => true));
    // } else {
    //     echo "no anduvo";
    // }
include_once("../../../configuracion.php");
$datos = data_submitted();//Recibe idcompraitem 

$objCompraItem = new AbmCompraItem();
$agregar = $objCompraItem->baja($datos);
if($agregar){
    echo "Item Borrado del Carrito";
}else{
    echo "Algo Fallo";
}

?>