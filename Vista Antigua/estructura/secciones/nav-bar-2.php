<?php
//VALIDAR ACA LA SESIÓN
    include_once("../../configuracion.php");
    

    $objSession = new Session();
    $rol = $_SESSION['rol'];

    $menu = new AbmMenu();
    $param['idpadre'] = $rol;/* el 3corresponde a clientes,2 a deposito,1 a administrador*/
    $listaMenu = $menu->buscar($param);
    //print_r($listaMenu);
    require_once("cargarMenues.php");

//}
?>







