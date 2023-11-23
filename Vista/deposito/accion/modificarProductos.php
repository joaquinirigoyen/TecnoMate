<?php
    include_once '../../../configuracion.php';
    $datos = data_submitted();

    $objProducto = new AbmProducto();
 
    $respuesta =$objProducto->modificar($datos);

    if($respuesta == true){
        echo "mofique producto";
        header('Location: ../listarProductos.php');

    } else{
        echo "Error modificar";
    }



?>