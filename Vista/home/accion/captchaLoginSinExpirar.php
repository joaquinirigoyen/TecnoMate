<?php

include_once("../../../configuracion.php");
$datos = data_submitted();

if (isset($_COOKIE['captchaLogin'])) {
    $cookieCaptcha = $_COOKIE["captchaLogin"];
} else {
    $cookieCaptcha = "expiro";
}

if ($cookieCaptcha != "expiro") {
    $respuesta = array("validacion" => "exito", "error" => "Ningun error");

} else {
    $respuesta = array("validacion" => "expiro", "error" => "Se excedio el tiempo del captcha");

}

echo json_encode($respuesta);
?>