<?php

include_once "../../configuracion.php";

$datos = data_submitted();
$objProducto = new AbmProducto();

$param["idproducto"] = $datos['idproducto'];
$listaProd = $objProducto->buscar($param);

$param["pronombre"] = $datos['pronombre'];
$param["prodetalle"] = $datos['prodetalle'];
$param["procantstock"] = $datos['procantstock'];
$param["tipo"] = $datos['tipo'];
$param["imagenproducto"] =  $listaprod[0]->getImagenProducto();

        $respuesta = $objProducto->modificar($param);

        if($respuesta == true){
            $respuesta = array("resultado" => "exito", "mensaje" => "Actualizacion de datos exitosa");
        } else{
            $respuesta = array("resultado" => "falla", "mensaje" => "No se puede ceditar Producto");
        }

       echo json_encode($respuesta);

?> 
