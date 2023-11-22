<?php
//asi todos los accion
include_once "../../configuracion.php";

$datos = data_submitted();

    $objProducto = new AbmProducto();
  
        $respuesta = $objProducto->alta($datos);

        if($respuesta == true){
            $respuesta = array("resultado" => "exito", "mensaje" => "Carga de datos exitosa");
        } else{
            $respuesta = array("resultado" => "falla", "mensaje" => "No se puede cargar Producto");
        }

       echo json_encode($respuesta);

?> 