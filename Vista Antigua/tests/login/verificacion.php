<?php
//este recibe los datos del login y los compara con todos los usuarios.(se debe verificar usuario repetido?)
//si coincide con 1 usuario redirecciona a pagina segura
//si no redirecciona a login
//usar la funcion de session validar?
//enla base de datos la password va estar encriptada
include_once "../../../configuracion.php";
/*include_once "../../Modelo/conector/BaseDatos.php";
include_once "../../Control/AmbUsuario.php";
include_once "../../Modelo/Usuario.php";*/
$datos = data_submitted();
//verEstructura($datos);
//encripto la pass para poder verificarla en la bd
$passEncript= md5($datos['uspass']);
$datos['uspass']=$passEncript;
//verEstructura($datos);
$objSession = new Session();
//colocamos las variables con las que inica la sesion
$objSession->iniciar($datos['usnombre'],$datos['uspass']);
//echo "Objeto sesion <br>";
print_r($objSession);
//las validamos
$validUser=$objSession->validar();
//redireccion
if($validUser){
    header('Location:../sesionIniciada.php');

}else{
    //header('Location:../login.php'); //usar este para redirigir
    echo "No Inicio sesion <br>";
    //verEstructura($objSession);
    
}


?>