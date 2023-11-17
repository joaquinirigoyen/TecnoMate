<?php
//ACCIONES DE LA VISTA
include_once "../../configuracion.php";
$datos = data_submitted();


//Este arreglo respuesta se puede armar segun como espere las respuestas
/*$a=$b;
Es posible que los errores generados en el codigo php no permitan que se genere bien el json*/

$a = $b;

//json es una especie de arreglo y la funcion json_encode($param) transforma los 
//arreglos php en formato json
//el echo imprime en pantalla el json y el javascript lee lo imprimido en pantalla
echo json_encode($datos);
?>