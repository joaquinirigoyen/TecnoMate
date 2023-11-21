<?php
class AbmCompraItem{

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjeto($param){
        $objItem = null;
        //print_r($param);
        if (array_key_exists('idcompraitem', $param)) {

                $objUsuario = new Usuario();
                $objUsuario->setIdUsuario($param['idusuario']);
                $objUsuario->cargar();
    
                $objCompra = new Compra();
                $objCompra->setIdCompra($param['idcompra']);
                $objCompra->cargar();
                 $objItem = new CompraItem();
                $objItem->setear(
                $param['idcompraitem'],
                $objUsuario,
                $objCompra,
                $param['cicantidad']
            );

        }
        return $objItem;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     *  que son claves
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if(isset($param['idcompraitem']) ){
            $obj = new CompraItem();
            $obj->setear($param['idcompraitem'],null,null,null);
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
        if (isset($param['idcompraitem']))
            $resp = true;
        return $resp;
    }


    /**
     * 
     * @param array $param
     */
    public function alta($param){
        print_r($param);
        echo"estoy entrando al alta \n";
        $param['idcompraitem'] = null;
        $resp = false;
        $unObjCompraI = $this->cargarObjeto($param);
         verEstructura($unObjCompraI);
        if ($unObjCompraI!=null && $unObjCompraI->insertar()){
            echo"estoy entrando al insertar \n";
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
            $unObjCompraI = $this->cargarObjeto($param);
            if ($unObjCompraI!=null && $unObjCompraI->eliminar()){
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
    public function modificar($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $unObjCompraI = $this->cargarObjeto($param);
            if($unObjCompraI!=null && $unObjCompraI->modificar()){
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
            if  (isset($param['idcompraitem']))
                $where.=" and idcompraitem ='".$param['idcompraitem']."'";
            if  (isset($param['idproducto']))
                $where.=" and idproducto ='".$param['idproducto']."'";
            if  (isset($param['idcompra']))
                $where.=" and idcompra = ".$param['idcompra'];
            if  (isset($param['cicantidad']))
                $where.=" and cicantidad ='".$param['cicantidad']."'";
        }

        $obj = new CompraItem();
        $arreglo = $obj->listar($where);

        return $arreglo;
    }
}

?>