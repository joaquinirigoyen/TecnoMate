<?php
include_once '../../../configuracion.php';
$datos = data_submitted();
$idUsuario=$datos['id'];
$param['idusuario']=$idUsuario;
$objUsuario = new AbmUsuario(); 
$usuario = $objUsuario->buscar($param);

$desabilitar=$datos['borrar'];
$borrar2=strtolower($desabilitar);

if($borrar2 == 'si'){
    $fecha= date("Y-m-d H:i:s");
}else{
    $fecha= null;
}
$datos['idusuario']=$idUsuario;
$datos['usnombre']=$datos['nombreUs'];
$datos['uspass']=md5($datos['pass']);
$datos['usmail']=$datos['email'];
$datos['usdeshabilitado']= $fecha;


    if (!empty($usuario)){
        if ($objUsuario->modificar($datos)){
           echo "Datos usuario Modificados";
           
        }else {
            echo"Erro al moficicar";}
    } else {
        echo"Erro al moficicar";
    }
?>