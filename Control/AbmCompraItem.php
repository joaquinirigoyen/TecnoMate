<?php
class AbmCompraItem{

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
            echo "estoy en alta accion nueva";
            if($this->alta($datos)){
                $resp =true;
            }
            
        }
        return $resp;

    }

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraItem
     */
     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * @param array $param
     */
    // private function cargarObjeto ($param){
    //     $obj = null;
    //     if (array_key_exists('idcompraItem',$param) and array_key_exists('idproducto',$param) 
    //     and array_key_exists('idcompra',$param)  and array_key_exists('cicantidad',$param))
    //     {
    //         $obj = new CompraItem();
    //         $abmProducto = new AbmProducto();
    //         $abmCompra = new AbmCompra();
    //         $arrayCompra = [];
    //         $arrayProducto = [];
    //         $arrayCompra ['idcompra'] = $param['idcompra'];
    //         $arrayProducto ['idproducto'] = $param['idproducto'];
    //         // MODIFICADO!!!
    //         $listaCompras = $abmCompra -> buscar ($arrayCompra);
    //         $listaProductos = $abmProducto -> buscar ($arrayProducto);
    //         $objCompra = $listaCompras[0];
    //         $objProducto = $listaProductos[0];
    //         // MODIFICADO!!!
    //         $idCompraItem = $param ['idcompraitem'];
    //         $ciCantidad = $param ['cicantidad'];
    //         $obj -> setear($idCompraItem, $objProducto, $objCompra, $ciCantidad);
    //     }
    //     return $obj;
    // }


  
private function cargarObjeto($param){$objItem = null;//print_r($param);
    if (array_key_exists('idcompraitem', $param)) {
                $objProducto = new Producto();
                $objProducto->setIdProducto($param['idproducto']);
                $objProducto->cargar();

                $objCompra = new Compra();
                $objCompra->setIdCompra($param['idcompra']);
                $objCompra->cargar();
                 $objItem = new CompraItem();
                $objItem->setear(
                $param['idcompraitem'],
                $objProducto,
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
       // print_r($param);
        // echo"estoy entrando al alta \n";
        // $param['idcompraitem'] = null;
        // $resp = false;
        // $unObjCompraI = $this->cargarObjeto($param);
        //  verEstructura($unObjCompraI);
        // if ($unObjCompraI!=null && $unObjCompraI->insertar()){
        //     echo"estoy entrando al insertar \n";
        //     $resp = true;
        // }
        // return $resp;
        $resp = false;
        
        $elObjCompraItem = $this->cargarObjeto($param);
        if ($elObjCompraItem!=null and $elObjCompraItem->insertar()){
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
    public function modificacion($param){
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