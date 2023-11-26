<?php
class AbmCompraEstado{

 
    /**
     * Funcion ABM. Espera un array de parametro. Indicando la accion a realizar.
     * Retorna un array con un mensaje y un booleano segun su exito.
     * @param array $datos
     * @return boolean
     */
    public function abm($datos){
        $array = [];
        $array ["exito"] = false;  
        $array ["mensaje"] = "";      
        if (isset($datos['accion'])) 
        {
            if($datos['accion']=='editar')
            {
                if ($this->modificacion($datos)) {
                    $array ["exito"] = true;
                }
            }
            if($datos['accion']=='borrar') 
            {
                if ($this->baja($datos)) 
                {
                    $array ["exito"] = true;
                }
            }
            if($datos['accion']=='nuevo')
            {
                if ($this->alta($datos)) {
                    $array ["exito"] = true;
                }
            }
            if($datos['accion']=='editarEstado')
            {
                if ($this->editarEstado($datos)) {
                    $array ["exito"] = true;
                }
            }
            if($datos['accion']=='actualizarEstado')
            {
                if ($this->actualizarEstado($datos)) {
                    $array ["exito"] = true;
                }
            }
            if ($array ["exito"]) {
                $array ["mensaje"] = "<h3 class='text-success'>La accion " . $datos['accion'] . " se realizo correctamente.</h3>";
            } else {
                $array ["mensaje"] = "<h3 class='text-danger'>La accion " . $datos['accion'] . " no pudo concretarse.</h3>";
            } 
        }
        return $array;
    }
    private function actualizarEstado($data)
    {
        $idCompra = $data['idcompra'];
        $idCompraEstadoTipo = $data['idcompraestadotipo'];
        //cargo el ultimo compra estado, como viene uno solo(busca por su id) selecciono el arreglo en posicion 0
        $buscaCompra['idcompraestado']=$data['idcompraestado'];
        $estadoCompra = $data['cetdescripcion'];

        $compraEstado = new AbmCompraEstado();
        $arrObjCompraEstado = $compraEstado->buscar($buscaCompra);
        $ObjCompraEstado = $arrObjCompraEstado[0];
        // seteo el id de ese objeto CompraEstado (es el mismo que me mando por ajax 'idCompraEstado'), tambien las fechas que tenia este estado
        $idCompraEstado = $ObjCompraEstado->getIdCompraEstado();
        $ceFechaIni = $ObjCompraEstado->getCeFechaIni();
        $ceFechaFin = $ObjCompraEstado->getCeFechaFin();
        // fecha actual
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha_actual = date("Y-m-d H:i:s");
        // seteo el arreglo de datos para las acciones AmbCompraEstado
        $datos['accion'] = "editarEstado";
        $datos['idcompraestado'] = $idCompraEstado; //id del ultimo estado que tuvo la compra
        $datos['cetdescripcion'] = $estadoCompra;
        $datos['idcompra'] = $idCompra; // id de la compra
        $datos['idcompraestadotipo'] = $idCompraEstadoTipo; //id del tipo de estado de la compra
        $datos['cefechaini'] = $ceFechaIni; // fecha Inicio estado
        $datos['cefechafin'] = $fecha_actual;// fecha Fin estado

        // echo "estoy en actualizar";
        // print_r($datos);
        $respuesta = $compraEstado->abm($datos);
        $exito = $respuesta["exito"];

        verEstructura($respuesta);
        return $exito;
    }


    private function editarEstado($datos)
    {
        $resp = false;
        $idCompraEstado = $datos['idcompraestado'];
        $idCompra = $datos['idcompra'];
        $idCompraEstadoTipo = $datos['idcompraestadotipo'];
        $fechaini = $datos['cefechaini'] ; // no lo usamos
        $fechaFin= $datos['cefechafin']; // tecnicamente deberia ser 0000

        //seteo el objeto compraEstado (el ultimo estado que tiene/ estado actual)
        $array['idcompraestado'] = $idCompraEstado;
        $AbmCompraEstado = new AbmCompraEstado();
        $arregloEstados = $AbmCompraEstado->buscar($array);
        $compraEstado = $arregloEstados[0];

        $array["idcompra"] = $compraEstado->getObjCompra()->getIdCompra();
        $array['idcompraestadotipo'] = $compraEstado->getObjCompraEstadoTipo()->getIdCompraEstadoTipo();
        $array['cefechaini'] = $compraEstado->getCeFechaIni();
        $array['cefechafin'] = $fechaFin;
        echo "antes de entrar al modificacion";
        print_r($array);
        if($this->modificacion($array)){
            $id = $idCompraEstadoTipo;
            if ($id == 1){
                $id ++;
                $fecha = '0000-00-00 00:00:00';
            }else if($id == 2) {
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $id ++;
                $fecha = $fechaFin;
                $fechaFin = $fechaini;
            }
            $resp = true; 
            $arrayDatos['idcompra'] = $idCompra;
            $arrayDatos['idcompraestadotipo'] = $id;
            $arrayDatos['cefechaini'] =  $fechaFin;
            $arrayDatos['cefechafin'] = $fecha;
            echo "antes de entrar al alta";
            print_r($arrayDatos);
            $this->alta($arrayDatos);
        }
       
        return $resp;
    }

    private function cargarObjeto($param){
        $obj = null;
        if (array_key_exists('idcompraestado',$param) and array_key_exists('idcompra',$param) and
            array_key_exists('idcompraestadotipo',$param) and array_key_exists('cefechaini',$param) and 
            array_key_exists('cefechafin',$param))
        {
            $obj = new CompraEstado();
            $abmCompra = new AbmCompra ();
            $abmCompraEstadoTipo = new AbmCompraEstadoTipo();
            $arrayCompra = [];
            $arrayCompraEstadoTipo = [];
            $arrayCompra ['idcompra'] = $param['idcompra'];
            $arrayCompraEstadoTipo ['idcompraestadotipo'] = $param['idcompraestadotipo']; // Modificado!!!
            // MODIFICADO!!!
            $listaCompras = $abmCompra -> buscar ($arrayCompra);
            $listaCompraEstadoTipo = $abmCompraEstadoTipo -> buscar ($arrayCompraEstadoTipo);
            $objCompra = $listaCompras[0];
            $objCompraEstadoTipo = $listaCompraEstadoTipo[0];
            // MODIFICADO!!!
            $idCompraEstado = $param ['idcompraestado'];
            $ceFechaIni = $param ['cefechaini'];
            $ceFechaFin = $param ['cefechafin'];

            $obj -> setear($idCompraEstado, $objCompra, $objCompraEstadoTipo, $ceFechaIni, $ceFechaFin);
        }
        return $obj;

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
        //int_r($param);
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
     * Modifica un CompraEstado. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        echo "estoy en modificacion";
        print_r($param);
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjCompraEstado = $this->cargarObjeto($param);
            if($elObjCompraEstado!=null and $elObjCompraEstado->modificar()){
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