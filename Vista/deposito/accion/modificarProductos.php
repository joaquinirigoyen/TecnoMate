<?php
    include_once '../../configuracion.php';
    $datos = data_submitted();

    $objProducto = new AbmProducto();
        
    if($objProducto->modificar($datos)){
        echo "pudo";
    } else {
        echo "no pudo";
    }
?>