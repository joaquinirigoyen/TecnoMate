<?php
//ACCIONES DE LA VISTA
include_once "../../configuracion.php";

session_start();

if(array_key_exists('usnombre', $_SESSION) && array_key_exists('usmail', $_SESSION)){
    $usnombre = $_SESSION['usnombre'];
    $usmail = $_SESSION['usmail'];
} else {
    $usnombre = "Null";
    $usmail = "Null";
}

//Este arreglo respuesta se puede armar segun como espere las respuestas
$respuesta = array("resultado" => "exito", "mensaje" => "consulta exitosa",
"usnombre" => $usnombre, "usmail" => $usmail);


//json es una especie de arreglo y la funcion json_encode($param) transforma los 
//arreglos php en formato json
//el echo imprime en pantalla el json y el javascript lee lo imprimido en pantalla
echo json_encode($respuesta);
?>