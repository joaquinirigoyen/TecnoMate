<?php
    include_once '../../../configuracion.php';
    $datos = data_submitted();

    $objMenu = new AbmMenu();
        
    if($objMenu->modificar($datos)){
      header('Location: ../gestionMenu.php');

    } else {
      header('Location: ../gestionMenu.php');
    }
?>