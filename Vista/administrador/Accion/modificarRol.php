<?php
    include_once '../../../configuracion.php';
    session_start();
    $datos = data_submitted();
    $objUsuario = new AbmUsuario();
    $usuario = $objUsuario->buscar($datos);

    $idUsuario = $usuario[0]->getIdUsuario();
    $datos['usdeshabilitado'] ="'0000-00-00 00:00:00'";

    $objUsuarioRol = new AbmUsuarioRol();
    $paramUsuarioRol['idusuario'] = $idUsuario;

    if(array_key_exists('Cliente', $datos)){
        $paramUsuarioRol['idrol'] = 3;
        $objUsuarioRol->alta($paramUsuarioRol);
    } 
    if(array_key_exists('Deposito', $datos)){
        $paramUsuarioRol['idrol'] = 2;
        $objUsuarioRol->alta($paramUsuarioRol);
    } 
    if(array_key_exists('Admin', $datos)){
        $paramUsuarioRol['idrol'] = 1;
        $objUsuarioRol->alta($paramUsuarioRol);
    } 
    if(array_key_exists('NoCliente', $datos)){
        $paramUsuarioRol['idrol'] = 3;
        $objUsuarioRol->baja($paramUsuarioRol);
    } 
    if(array_key_exists('NoDeposito', $datos)){
        $paramUsuarioRol['idrol'] = 2;
        $objUsuarioRol->baja($paramUsuarioRol);
    } 
    if(array_key_exists('NoAdmin', $datos)){
        $paramUsuarioRol['idrol'] = 1;
        $objUsuarioRol->baja($paramUsuarioRol);
    } 
    echo "<script>alert('Rol Modificado');</script>";
    //header ('Location: ../homeAdministrador.php');
    
?>