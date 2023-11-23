<?php
include_once ("../../../configuracion.php");
//pasa el carrito al estado iniciada
$datos = data_submitted();//idCompra
$objCompra = new AbmCompra();
$arayCompra = $objCompra->buscar($datos);//array
$compra = $arayCompra[0];//objCompra

    $objEstado = new AbmCompraEstado();
    //parametros de busqueda
    $param['idcompra'] = $compra->getIdCompra();
    //$param['idcompraestadotipo'] = 1;
    $param['cefechafin'] = null;
    $exito = $objEstado->buscar($param);

    if($exito){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha_actual = date("Y-m-d H:i:s");
        //modifico el estado inicial colocandole fecha fin
        $estado = $exito[0];
        $param['idcompraestado'] = $estado->getIdCompraEstado();
        $param['idcompra'] = $estado->getObjCompra()->getIdCompra();
        $param['idcompraestadotipo'] = $estado->getObjCompraEstadoTipo()->getIdCompraEstadoTipo();
        $param['cefechaini'] = $estado->getCeFechaIni();
        $param['cefechafin'] =  $fecha_actual;
        $objEstado->modificacion($param);

        //creo el estado cancelada con fecha de inicio
        $cancelado = new AbmCompraEstado();
        $param['idcompraestado'] = 0;
        $param['idcompra'] = $compra->getIdCompra();
        $param['idcompraestadotipo'] = 4;
        $param['cefechaini'] = $estado->getCeFechaIni();;
        $param['cefechafin'] = $fecha_actual;
        $exito = $cancelado->alta($param);
       
        echo "cancelacion realizada";
    }else{
        echo "Algo fallo";
    }




?>