<?php
    include_once '../../../configuracion.php';
    $datos = data_submitted();

    $objRol= new AbmRol();
        
    if($objRol->modificar($datos)){
        //echo "modifico";
    header('Location: ../listarRol.php');

    } else {
      header('Location: ../gestionMenu.php');
    //  echo " no modifico";
    }
?>