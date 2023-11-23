<?php
include_once '../../../configuracion.php';

$nombre=$_POST['nombreUs'];
$pasword=$_POST['pass'];
$email=$_POST['email'];
$rol=$_POST['rol'];

$objUsuario = new AbmUsuario();
$objUsuarioRol = new AbmUsuarioRol();

//Guardo los parametros del Usuario
$paramUsuario['usnombre'] = $nombre;
$paramUsuario['uspass'] = md5($pasword);
$paramUsuario['usmail'] = $email;
$paramUsuario['usdeshabilitado'] = null;

//Lo cargo a la base de datos
$exito = $objUsuario->alta($paramUsuario);

if($exito){
    $paramUsuario2['usnombre'] =$nombre;
    $nuevoUsuario = $objUsuario->buscar($paramUsuario2);
    $idUsuario = $nuevoUsuario[0]->getIdUsuario();
    $paramUsuarioRol['idusuario'] = $idUsuario;
    $paramUsuarioRol['idrol'] =$rol;
    $objUsuarioRol->alta($paramUsuarioRol);
    
    echo"Usuario cargado correctamente";
} 
else{
   echo"Error al cargar el usuario";
//header('Location: ../gestionMenu.php');
}
    