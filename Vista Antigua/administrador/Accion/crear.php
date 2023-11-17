<?php
include_once '../../../configuracion.php';

// Encapsulo los datos para crear usuario nuevo
$datos = data_submitted();
print_r($datos);

// Extraigo datos necesarios para la creación de usuario
$usuario = $datos['nombreUsuario'];
$email = $datos['emailUsuario'];
$passEncriptada= md5($datos['passUsuario']);

$objUsuario = new AbmUsuario();

$parametros = array(
    'idusuario' => 5,
    'usnombre' => 'gise',
    'uspass' => 'si',
    'usmail' => 'gise@gmail.com',
    'usdeshabilitado' => NULL
);

$exito = $objUsuario->alta($parametros);

if ($exito) {
    echo "<p>PUDISTE</p>";
} else{
    echo "<p>no pudistexd</p>";
}

include_once '../../estructura/secciones/footer.php';