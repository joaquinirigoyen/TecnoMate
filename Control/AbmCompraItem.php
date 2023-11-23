<?php
class AbmCompraItem{

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
       //  echo"estoy entrando al alta \n";
        $param['idcompraitem'] = null;
       
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
    
    /**
     * Funcion ABM. Espera un array de parametro. Indicando la accion a realizar.
     * Retorna un array con un mensaje y un booleano segun su exito.
     * @param array $datos
     * @return boolean
     */
    // public function abm($datos){
    //     $array = [];
    //     $array ["exito"] = false;  
    //     $array ["mensaje"] = "";      
    //     if (isset($datos['accion'])) 
    //     {
    //         if($datos['accion']=='editar')
    //         {
    //             if ($this->modificacion($datos)) {
    //                 $array ["exito"] = true;
    //             }
    //         }
    //         if($datos['accion']=='borrar') 
    //         {
    //             if ($this->baja($datos)) 
    //             {
    //                 $array ["exito"] = true;
    //             }
    //         }
    //         if($datos['accion']=='nuevo')
    //         {
    //             if ($this->alta($datos)) {
    //                 $array ["exito"] = true;
    //             }
    //         }
    //         if($datos['accion']=='borrarItem')
    //         {
    //             if ($this->borrarItem($datos)) {
    //                 $array ["exito"] = true;
    //             }
    //         }
    //         if ($array ["exito"]) {
    //             $array ["mensaje"] = "<h3 class='text-success'>La accion " . $datos['accion'] . " se realizo correctamente.</h3>";
    //         } else {
    //             $array ["mensaje"] = "<h3 class='text-danger'>La accion " . $datos['accion'] . " no pudo concretarse.</h3>";
    //         } 
    //     }
    //     return $array;
    // }
    //  */
    // public function borrarItem($data)
    // {
    //     echo"estoy dentro del borrar item";
    //     print_r($data);
    //     $data['accion']='borrar';
    //     $idCompra = $data['idcompra'];
    //     $idCompraItem = $data['idcompraitem'];

    //     $idCompraItem = $data['idcompraitem'];
    //     $param['idcompraitem'] = $data['idcompraitem'];
    //     $param['accion']='borrar';
    //     $this->abm($param);
        
    //     $param1['idcompra']=$idCompra;
    //     $listaObjCompraItem = $this->buscar($param1);

    //     $objAbmCompraEstado=new AbmCompraEstado();
    //     $objAbmCompra= new AbmCompra();

    //     if(count($listaObjCompraItem)==0){
    //         $listarCompraEstado = $objAbmCompraEstado->buscar(null);
    //         foreach ($listarCompraEstado as $compraEstado) {
    //             $idCompraActual = $compraEstado->getObjCompra()->getIdCompra();
    //             if ($idCompra == $idCompraActual) {
    //                 $arrayBorrar = [];
    //                 $arrayBorrar['idcompraestado'] = $compraEstado->getIdCompraEstado();
    //                 $arrayBorrar['accion'] = "borrar";
    //                 $objAbmCompraEstado->abm($arrayBorrar);
    //             }
    //         }
    //         $arregloCompras = $objAbmCompra->buscar($data);
    //         $objCompra = $arregloCompras[0];
    //         $array['idcompra'] = $idCompra;
    //         $array['accion'] = "borrar";
    //         $respuesta = $objAbmCompra->abm($array);
    //     }
    //     $exito = $respuesta ["exito"];
    //     return $exito;
    // }
}

?>