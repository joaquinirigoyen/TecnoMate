<?php
include_once ("../../../configuracion.php");

session_start();

$nombre = $_SESSION['usnombre'];

$respuesta = array ("nombre" => $nombre);

echo json_encode($respuesta);
?>