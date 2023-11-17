<?php
include_once '../../../configuracion.php';

// Encapsulo los datos para crear usuario nuevo
$datos = data_submitted();
verEstructura($datos);

$objRol = new AbmRol();
$exito = $objRol->alta($datos);

if($exito){
    echo "Rol Creado";
}else{
    echo "Rol NO Creado";
}

?>