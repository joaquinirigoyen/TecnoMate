<?php
include_once "../../../configuracion.php";

$datos = data_submitted();
//print_r($datos);

    $objProducto = new AbmProducto();
  
        $respuesta = $objProducto->alta($datos);

        if($respuesta == true){
          $mensaje = "Datos modificados correctamente";
          echo"modifa";
          //header('Location: ../../home/homeDeposito.php');
        }  else {
            $mensaje= "No fue posible modificar datos.";
           // header('Location: ../../home/homeDeposito.php');
          } 

?>