<?php
class AbmCompraEstado{

    public function abm($datos){
        $resp = false;
        if($datos['accion']=='editar'){
            if($this->modificacion($datos)){
                $resp = true;
            }
        }
        if($datos['accion']=='borrar'){
            if($this->baja($datos)){
                $resp =true;
            }
        }
        if($datos['accion']=='nuevo'){
            if($this->alta($datos)){
                $resp =true;
            }
            
        }
        return $resp;

    }

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraEstado
     */
    // private function cargarObjeto ($param){
    //     $obj = null;
    //     if (array_key_exists('idcompraestado',$param) and array_key_exists('idcompra',$param) and
    //         array_key_exists('idcompraestadotipo',$param) and array_key_exists('cefechaini',$param) and 
    //         array_key_exists('cefechafin',$param))
    //     {
    //         $obj = new CompraEstado();
    //         $abmCompra = new AbmCompra ();
    //         $abmCompraEstadoTipo = new AbmCompraEstadoTipo();
    //         $arrayCompra = [];
    //         $arrayCompraEstadoTipo = [];
    //         $arrayCompra ['idcompra'] = $param['idcompra'];
    //         $arrayCompraEstadoTipo ['idcompraestadotipo'] = $param['idcompraestadotipo']; // Modificado!!!
    //         // MODIFICADO!!!
    //         $listaCompras = $abmCompra -> buscar ($arrayCompra);
    //         $listaCompraEstadoTipo = $abmCompraEstadoTipo -> buscar ($arrayCompraEstadoTipo);
    //        // print_r($listaCompraEstadoTipo);
    //         $objCompra = $listaCompras[0];
    //         $objCompraEstadoTipo = $listaCompraEstadoTipo[0];
    //         // MODIFICADO!!!
    //         $idCompraEstado = $param ['idcompraestado'];
    //         $ceFechaIni = $param ['cefechaini'];
    //         $ceFechaFin = $param ['cefechafin'];

    //         $obj -> setear($idCompraEstado, $objCompra, $objCompraEstadoTipo, $ceFechaIni, $ceFechaFin);
    //     }
    //     return $obj;
    // }
    private function cargarObjeto($param){
        $objEstado = null;
        //print_r($param);
        if( array_key_exists('idcompraestado',$param)){ 
            
            $objCompra = new Compra();
            $objCompra->setIdCompra($param['idcompra']);
            $objCompra->cargar();

            $objCompraEstadoTipo = new CompraEstadoTipo();
            $objCompraEstadoTipo->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $objCompraEstadoTipo->cargar();

            $objEstado = new CompraEstado();
            $objEstado->setear(
            $param['idcompraestado'],
            $objCompra,
            $objCompraEstadoTipo,
            $param['cefechaini'],
            $param['cefechafin']
            );

    }
    return $objEstado;

    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     *  que son claves
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if(isset($param['idcompraestado']) ){
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'],null,null,null,null);
        }
        return $obj;
    }


     /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraestado']))
            $resp = true;
        return $resp;
    }


    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $param['idcompraestado'] = null; 
        $resp = false;
        $unObjCompraEstado = $this->cargarObjeto($param);
        if ($unObjCompraEstado!=null && $unObjCompraEstado->insertar()){
            $resp = true;
        }
        return $resp;
        
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $unObjCompraEstado = $this->cargarObjeto($param);
            if ($unObjCompraEstado!=null && $unObjCompraEstado->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $unObjCompraEstado = $this->cargarObjeto($param);
            if($unObjCompraEstado!=null && $unObjCompraEstado->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
   /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>null){

            if(isset($param['idcompraestado'])){
                $where.=" and idcompraestado ='".$param['idcompraestado']."'";
            }
            if(isset($param['idcompra'])){
                $where.=" and idcompra ='".$param['idcompra']."'";
            }
                
            if(isset($param['idcompraestadotipo'])){
                $where.=" and idcompraestadotipo ='".$param['idcompraestadotipo']."'";
            }
                
            if(isset($param['cefechaini'])){
                $where.=" and cefechaini ='".$param['cefechaini']."'";
            }
                
            if(isset($param['cefechafin'])){

                if($param['cefechafin'] != "NULL"){
                    $where.=" and cefechafin = ".$param['cefechafin'];
                } else {
                    $where.=" and cefechafin is NULL";
                }
                
            }
            
        }
        $obj = new CompraEstado();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }
}

?>