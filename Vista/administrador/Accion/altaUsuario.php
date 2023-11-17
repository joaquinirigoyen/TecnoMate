<?php
include_once '../../../configuracion.php';

// Encapsulo los datos para crear usuario nuevo
$datos = data_submitted();
verEstructura($datos);

// Extraigo datos necesarios para la creación de usuario
$usuario = $datos['nombreUsuario'];
$email = $datos['emailUsuario'];
$passEncriptada= md5($datos['passUsuario']);

//creo los objetos Usuario y objeto UsuarioRol
$objUsuario = new AbmUsuario();

$objUsuarioRol = new AbmUsuarioRol();

//Guardo los parametros del Usuario
$paramUsuario['idusuario'] = 0;
$paramUsuario['usnombre'] = $usuario;
$paramUsuario['uspass'] = $passEncriptada;
$paramUsuario['usmail'] = $email;
$paramUsuario['usdeshabilitado'] = null;

//Lo cargo a la base de datos
$exito = $objUsuario->alta($paramUsuario);


if($exito){
    $paramUsuario2['usnombre'] = $usuario;
    $nuevoUsuario = $objUsuario->buscar($paramUsuario2);
    $idUsuario = $nuevoUsuario[0]->getIdUsuario();
    $paramUsuarioRol['idusuario'] = $idUsuario;
    //
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
    

    header('Location: ../gestionMenu.php');

}else{
    header('Location: ../gestionMenu.php');
}


include_once '../../estructura/footer.php';

?>