<?php

include_once("../../../configuracion.php");
$datos = data_submitted();

$captcha = sha1($datos["captchaLogin"]);

if (isset($_COOKIE['captchaLogin'])) {
    $cookieCaptcha = $_COOKIE["captchaLogin"];
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