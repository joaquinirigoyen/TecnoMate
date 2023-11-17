<?php
/**Aca se debe encriptar la pass antes de que se guarde en el server */
include_once '../../configuracion.php';
$datos=data_submitted();
$sesion= new Session();
if (isset($datos['cerrar'])){
    $sesion->cerrar();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login/verificacion.php" method="post">
        Nombre: <input type="text" id="usnombre" name="usnombre">
        contraseña: <input type="password" name="uspass" id="uspass">
        <input type="submit" value="Login">
    </form>
</body>
</html>