<?php
    include_once '../../../configuracion.php';
    include_once '../../../Control/AbmMenu.php';
    
    $datos = data_submitted();

    $objMenu = new AbmMenu();

    if($objMenu->borradoLogico($datos)){
      header('Location: ../gestionMenu.php');
    } else {
      header('Location: ../gestionMenu.php');
    }
?>