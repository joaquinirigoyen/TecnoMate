<?php
include_once ("../../../configuracion.php");

session_start();

if(array_key_exists('usnombre', $_SESSION) && array_key_exists('usmail', $_SESSION)){
    $usnombre = $_SESSION['usnombre'];
    $usmail = $_SESSION['usmail'];
} else {
    $usnombre = "Null";
    $usmail = "Null";
}

$respuesta = array("resultado" => "exito", "mensaje" => "consulta exitosa",
"usnombre" => $usnombre, "usmail" => $usmail);

echo json_encode($respuesta);
?>