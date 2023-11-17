<?php 
include_once '../../../configuracion.php';
$datos = data_submitted();
$arrayDatos['idmenu']=0;//el idmenu tiene autoincrement
$arrayDatos['menombre'] = $datos['menombre'];
$arrayDatos['medescripcion'] = $datos['medescripcion'];
$arrayDatos['idpadre'] = $datos['idpadre'];
$arrayDatos['medeshabilitado'] = $datos['medeshabilitado'];
verEstructura($datos);
$objMenu = new AbmMenu();

$exito = $objMenu->alta($datos);
if($exito){
    echo "Item Menu Creado";
}else{
    echo "Item Menu NO Creado";
}

?>