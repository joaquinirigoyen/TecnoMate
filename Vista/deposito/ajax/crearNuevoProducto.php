<?php
include_once "../../configuracion.php";
$datos = data_submitted();
$param['idproducto'] = $datos[''];//rellenar con los ids del formulario
$param['pronombre'] = $datos[''];
$param['prodetalle'] = $datos[''];
$param['procantstock'] = $datos[''];

$objProducto = new AbmProducto();
$resultado = $objProducto->alta($param);

if ($resultado){
    $respuesta = array("resultado" => "exito", "mensaje" => "Producto agregado con exito.");
    
} else {
    $respuesta = array("resultado" => "error", "mensaje" => "No fue posible agregar el producto.");
    
}

echo json_encode($respuesta);

?>