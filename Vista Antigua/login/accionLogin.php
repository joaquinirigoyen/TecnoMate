<?php

include_once "../../configuracion.php";
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
    //header('Location:../sesionIniciada.php');
    //hacia donde redirige?

}else{
    //header('Location:../login.php'); 
    echo "No Inicio sesion <br>";
    //como colocamos el mensaje de usuario invalido?
    
}
?>