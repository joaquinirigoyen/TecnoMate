<?php
//accion de las interfaces
include_once "../../configuracion.php";
$datos = data_submitted();

$usnombre = $datos['usnombre'];

$param['usnombre'] = $usnombre;

$objUsuario = new AbmUsuario();
$colUsuarios = $objUsuario->buscar($param);

if (count($colUsuarios) == 0){
    $respuesta = array("validacion" => "exito");
    
} else {
    $respuesta = array("validacion" => "error", "error" => "Nombre de usuario en uso");
    
}

echo json_encode($respuesta);
?>