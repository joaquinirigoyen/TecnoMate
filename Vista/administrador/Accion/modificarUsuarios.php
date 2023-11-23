<?php
include_once '../../../configuracion.php';

$idUsuario=$_POST['id'];
$param['idusuario']=$idUsuario;
$objUsuario = new AbmUsuario(); 
$usuario = $objUsuario->buscar($param);

$desabilitar=$_POST['borrar'];
$borrar2=strtolower($desabilitar);

if($borrar2 == 'si'){
    $fecha= date("Y-m-d H:i:s");
}else{
    $fecha= null;
}
$datos['idusuario']=$idUsuario;
$datos['usnombre']=$_POST['nombreUs'];
$datos['uspass']=md5($_POST['pass']);
$datos['usmail']=$_POST['email'];
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