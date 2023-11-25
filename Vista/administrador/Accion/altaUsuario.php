<?php
include_once '../../../configuracion.php';
$datos = data_submitted();
$objUsuario = new AbmUsuario();
$objUsuarioRol = new AbmUsuarioRol();

//Guardo los parametros del Usuario
$paramUsuario['usnombre'] = $datos['nombreUs'];
$paramUsuario['uspass'] = md5($datos['pass']);
$paramUsuario['usmail'] = $datos['email'];
$paramUsuario['usdeshabilitado'] = null;

//Lo cargo a la base de datos
$exito = $objUsuario->alta($paramUsuario);

if($exito){
    $paramUsuario2['usnombre'] =$datos['nombreUs'];
    $nuevoUsuario = $objUsuario->buscar($paramUsuario2);
    $idUsuario = $nuevoUsuario[0]->getIdUsuario();
    $paramUsuarioRol['idusuario'] = $idUsuario;
    $paramUsuarioRol['idrol'] =$datos['rol'];
    $objUsuarioRol->alta($paramUsuarioRol);
    
    echo"Usuario cargado correctamente";
} 
else{
   echo"Error al cargar el usuario";
//header('Location: ../gestionMenu.php');
}
    