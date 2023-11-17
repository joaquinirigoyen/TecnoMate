<?php

include_once("../../../configuracion.php");
$datos = data_submitted();

$captcha = sha1($datos["captchaCrearCuenta"]);

if (isset($_COOKIE['captchaCrearCuenta'])) {
    $cookieCaptcha = $_COOKIE["captchaCrearCuenta"];
} else {
    $cookieCaptcha = "expiro";
}

if ($captcha == $cookieCaptcha) {
    $respuesta = array("validacion" => "exito", "error" => "Ningun error");

} else {
    $respuesta = array("validacion" => "incorrecto", "error" => "Captcha incorrecto");

}

echo json_encode($respuesta);

?>