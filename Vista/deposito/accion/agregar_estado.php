<?php
include_once "../../../configuracion.php";

$datos = data_submitted();
$datos ["accion"] = "actualizarEstado";

$abmCompraEstado = new AbmCompraEstado();
$respuesta = $abmCompraEstado->abm($datos);

if ($respuesta["exito"]) {
    echo json_encode(array("success" => true));
} else {
    echo "no anduvo";
}
?>

