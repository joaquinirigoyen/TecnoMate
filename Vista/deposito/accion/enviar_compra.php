<?php
include_once ("../../../configuracion.php");
//pasa el carrito al estado iniciada
$datos = data_submitted();//idCompra
verEstructura($datos);
$objCompra = new AbmCompra();
$arayCompra = $objCompra->buscar($datos);//array
$compra = $arayCompra[0];//objCompra

    $objEstado = new AbmCompraEstado();
    //parametros de busqueda
    $param['idcompra'] = $compra->getIdCompra();
    //$param['idcompraestadotipo'] = 2;
    $param['cefechafin'] = '0000-00-00 00:00:00';
    $exito = $objEstado->buscar($param);
    verEstructura($exito);

    if($exito){
        //modifico el estado inicial colocandole fecha fin
        $estado = $exito[0];
        $param['idcompraestado'] = $estado->getIdCompraEstado();
        $param['idcompra'] = $estado->getObjCompra()->getIdCompra();
        $param['idcompraestadotipo'] = $estado->getObjCompraEstadoTipo()->getIdCompraEstadoTipo();
        $param['cefechaini'] = $estado->getCeFechaIni();
        $param['cefechafin'] = date('Y-m-d H:i:s');
        $objEstado->modificacion($param);

        //creo el estado cancelada con fecha de inicio
        $cancelado = new AbmCompraEstado();
        $param['idcompraestado'] = 0;
        $param['idcompra'] = $compra->getIdCompra();
        $param['idcompraestadotipo'] = 3;
        $param['cefechaini'] = date('Y-m-d H:i:s');
        $param['cefechafin'] = null;
        $exito = $cancelado->alta($param);
       
        echo "Envio realizado";
    }else{
        echo "Algo fallo";
    }




?>