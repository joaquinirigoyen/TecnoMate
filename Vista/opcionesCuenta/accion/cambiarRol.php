<?php
include_once ("../../../configuracion.php");
$datos = data_submitted();

session_start();

/*if (array_key_exists('opcion1', $datos)){
    if ($datos['opcion1'] == 1){
        $_SESSION['rol'] = 1;
        header('Location: ../administrador/homeAdministrador.php');
    }
} else if(array_key_exists('opcion2', $datos)){
    if ($datos['opcion2'] == 2){
        $_SESSION['rol'] = 2;
        header('Location: ../deposito/homeDeposito.php');
    }
} else if (array_key_exists('opcion3', $datos)){
    if ($datos['opcion3'] == 2){
        $_SESSION['rol'] = 2;
        header('Location: ../deposito/homeDeposito.php');
    }
    $respuesta = array("resultado" => "exito", "mensaje" => "consulta exitosa");
    echo json_encode();
}*/

if ($datos['opcion'] == 1){
    $_SESSION['rol'] = 1;
    $respuesta = array("resultado" => "exito", "mensaje" => "1");
     //header('Location: ../administrador/homeAdministrador.php');

} else if ($datos['opcion'] == 2){
    $_SESSION['rol'] = 2;
    $respuesta = array("resultado" => "exito", "mensaje" => "2");
    //header('Location: ../deposito/homeDeposito.php');

} else if ($datos['opcion'] == 3){
    $_SESSION['rol'] = 3;
    $respuesta = array("resultado" => "exito", "mensaje" => "3");
    //header('Location: ../deposito/homeDeposito.php');
}

echo json_encode($respuesta);
?>