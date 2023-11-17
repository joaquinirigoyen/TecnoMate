<?php

include_once("../../../configuracion.php");
$datos = data_submitted();

$usnombre = $datos['usnombreCrearCuenta'];
$usmail = $datos['usmailCrearCuenta'];

$param['usnombre'] = $usnombre;
$param['usmail'] = $usmail;
$param['idusuario'] = 0;
$param['uspass'] = MD5(123456);
$param['usdeshabilitado'] = NULL;

$objUsuario = new AbmUsuario();
$resultado = $objUsuario->alta($param);

if ($resultado){
    $respuesta = array("resultado" => "exito", "mensaje" => "Su cuenta ha sido creada con éxito.
    \nEspere a que un administrador le asigne un rol para poder ingresar.
    \nLa clave generada por defecto es: 123456
    \nRecuerde cambiarla en su próximo inicio de sesión.");
    
} else {
    $respuesta = array("resultado" => "error", "mensaje" => "No fue posible crear su cuenta.");
    
}

echo json_encode($respuesta);
?>
