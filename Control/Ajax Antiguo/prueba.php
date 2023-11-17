<?php
$arreglo = array(); 
$arreglo['valor1'] = "Hola";
$arreglo['valor2'] = "Mundo";
?>
<html>
    <form action="pruebajson.php" method="POST">
        Ingrese algo<input id="valor1" name="valor1" type="text"> <br>
        Ingrese algo<input id="valor2" name="valor2" type="text"> <br>
        Ingrese algo<input id="valor3" name="valor3" type="text"> <br>
        <input type="submit" value="Enviar">
    </form>
</html>
