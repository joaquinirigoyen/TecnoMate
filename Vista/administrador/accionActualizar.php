<?php
    include_once '../../configuracion.php';
    session_start();
    $datos = data_submitted();

    $objUsuario = new AbmUsuario();

    $passEncriptada= md5($datos['uspass']);
    $datos['uspass'] = $passEncriptada;
    $datos['usdeshabilitado'] = null;

    $param['idusuario'] = $datos['idusuario'];

    $usuario = $objUsuario->buscar($param);
    // print_r($usuario);

    if (!empty($usuario)){
        if ($objUsuario->modificar($datos)){
            $_SESSION['usnombre'] = $datos['usnombre'];
            //echo "si";
            header ('Location: ../actInfoUsuarios/listarUsuarios.php?exito='.$datos['usnombre']);
        }
    } else {
        //echo "no";
        header ('Location: ../actInfoUsuarios/formActualizar.php?idusuario='.$datos['idusuario']);
    }
?>