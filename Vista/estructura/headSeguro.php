<?php
//VALIDAR ACA LA SESIÓN
include_once("../../configuracion.php");
    
$objSession = new Session();
$rol = $_SESSION['rol'];

//$rol = $_SESSION['rol'];//guarda el rol de la session
/* $menu = new AbmMenu();//se crea un objeto menu
$param['idpadre'] = $rol;/* el 3 corresponde a clientes, 2 a deposito, 1 a administrador
$listaMenu = $menu->buscar($param);//se busca el menu segun el idpadre */
$listaMenu = $objSession->vericarPermisos();
if($listaMenu){
    $ruta = $objSession->rutaCarpetas();
    header($ruta);
}else{
    header("../home/home.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<!-- ____________________________________ INICIO HEAD ______________________________ -->
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $tituloPagina ?></title>

    <!-- link a librería de bootstrap -->
    <script src="../../Utiles/librerias/bootstrap/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../Utiles/librerias/bootstrap/bootstrap.min.css">
    <!--<link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">-->
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../Archivos/Imagenes/mate.png">
    <!-- link a librería de jquery -->
    <script src="../../Utiles/librerias/jquery/jquery-3.7.1.min.js"></script>
    <script src="../../Utiles/librerias/jquery/jquery.validate.min.js"></script>
    <script src="../../Utiles/librerias/jquery/messages_es_PE.js"></script>

    <!-- link a librería JS para encriptar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

    <!-- link a css propio -->
    <link rel="stylesheet" href="../css/estilos.css">
    <!-- link a js propio -->
    <!--<script src="../estructura/js/validaBoostrap.js"></script>-->

    <!-- link a iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<!-- ____________________________________ INICIO BODY ______________________________ -->
<body>
