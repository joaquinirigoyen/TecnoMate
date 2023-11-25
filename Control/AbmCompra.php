<?php

class AbmCompra{

    /*
    ATRIBUTOS:
    'idcompra'
    'cofecha'
    'idusuario' <-- corresponde un objeto Usuario
    */
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
             
            }
            
        }
        return $resp;

    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres 
     * de las variables instancias del objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param){
        $objCompra = null;
        if( 
       // array_key_exists('idcompra', $param) &&
        array_key_exists('cofecha', $param) &&
        array_key_exists('idusuario', $param)
        ){
            $objUsuario = new Usuario();
            $objUsuario->setIdUsuario($param['idusuario']);
            $objUsuario->cargar();

            $objCompra = new Compra();

            $objCompra->setear(
                $param['idcompra'],
                $param['cofecha'],
                $objUsuario
            );
        }
        return $objCompra;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * 
     * OBSERVACION: Se utiliza este método principalmente para borrar un registro, ya que para ello
     * solamente se necesitan las claves del mismo
     * 
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if(isset($param['idcompra']) ){
            $obj = new Compra();
            $obj->setear($param['idcompra'], null, null);
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
        if (isset($param['idcompra']))
            $resp = true;
        return $resp;
    }
    
    /**
     * Esta función carga la información de un objeto a la base de datos
     * 
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        /*Si el id del objeto tuviera autoincrement en la base de datos entonces los campos claves 
        del mismo deberían setearse en nulos al momento de realizar la insersión*/
        $param['idcompra'] = null;

        $obj = $this->cargarObjeto($param);
        //verEstructura($obj);
        if ($obj != null && $obj->insertar()){
            $resp = true;
        }
        return $resp;
    }
    
    /**
     * Permite eliminar un objeto de la base de datos
     * @param array $param
     * @return boolean
     */
    public function baja($param){

        $resp = false;

        /*Primero verifica que el campo clave es enviado correctamente como parámetro */
        if ($this->seteadosCamposClaves($param)){

            /*Carga solamente la clave recibida por parámetro en el objeto actual ya que es lo único
            que se necesita para eliminar el resgistro de la base de datos */
            $obj = $this->cargarObjetoConClave($param);
            if ($obj != null && $obj->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        //echo "Estoy en modificacion";
        $resp = false;

        /*Primero verifica que el campo clave es enviado correctamente como parámetro */
        if ($this->seteadosCamposClaves($param)){

            /*Para realizar una modificación se debe recibir un arreglo con todos los datos 
            del registro cargados, tanto los que se desea editar como los que se desea que 
            permanezcan igual y se lo sobreescribe con la función modificar */
            $obj = $this->cargarObjeto($param);
            if($obj != null and $obj->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Permite buscar un objeto según distintos criterios.
     * Recibe un arreglo indexado que contiene los criterios de busqueda.
     * Retorna un arreglo compuesto por los objetos que cumplen el criterio indicado.
     * @param array $param
     * @return array
     */
    public function buscar($param){

        /*Se incia la consulta sql en true por que facilita el armado de la misma
        según el criterio de busqueda */
        $where = " true ";

        if ($param <> NULL){

            if  (isset($param['idcompra']))
                $where .= " and idcompra = '".$param['idcompra']."'";

            if  (isset($param['cofecha']))
                $where.= " and cofecha = '".$param['cofecha']."'";

            if  (isset($param['idusuario']))
                $where.= " and idusuario = ".$param['idusuario'];
        }

        $obj = new Compra();
        $arreglo = $obj->listar($where);

        return $arreglo;
    }

    /**
     * Recibe un arreglo indexado que contiene los criterios de busqueda
     * Devuelve un arreglo con la información de todos los objetos que cumplan la condición
     * recibida por parámetro
     * 
     * @param array $param
     * @return array
     */
    public function buscarColInfo($param){

        $colInfo = array();
        $arregloObj = $this->buscar($param);

        if (count($arregloObj) > 0){

            for ($i = 0; $i < count($arregloObj); $i++){
                $colInfo[$i] = $arregloObj[$i]->obtenerInfo();
            }
        }
        return $colInfo;
    }

    /* busca si hay una compra activa en estado iniciada*/
    public function compraActiva($param){
       // if(isset($param["idusuario"])){
            $obj = new Usuario;
            $obj->buscar($param["idusuario"]);
            $objCo = new Compra;
            $objCo->setObjUsuario($obj);
            $resultado = $objCo->buscarCompraActiva();
           return $resultado;
        }


    /* ESTA FUNCION busca la ulltima compra cargada*/
    public function ultimaCompra(){
   
            $objCo = new Compra;
            $resultado = $objCo->buscarUltimaCompra();
            return $resultado;
        }

   /**
     * finaliza la compra del cliente.
     */
    public function finalizarCompra($colDatos,$idUsuario){
        $abmCompra = new AbmCompra();
        $abmCompraEstado = new AbmCompraEstado();
        $abmCompraItem = new AbmCompraItem();
        $abmCompraProduct = new AbmProducto();
        $objSesion = new Session();

              $param['idusuario']=$idUsuario;
              $idCompra=$abmCompra->compraActiva($param);
              if ( $idCompra == null){
                $fechaC=date("Y-m-d H:i:s");
                $arrayConsulta = [];
                $arrayConsulta["idusuario"] = $idUsuario;
                $arrayConsulta["cofecha"] =   $fechaC;
                $arrayConsulta["accion"] = "nuevo";
                $resultado = $abmCompra->abm($arrayConsulta);
                $ultimaCompra =$abmCompra->ultimaCompra();
                $idCompra= $ultimaCompra;

              /* Crear un CompraEstado, con el tipo de estado siendo Iniciada*/
                $arrayConsultaE = [];
                 $arrayConsultaE["idcompra"] = $idCompra;
                $arrayConsultaE["idcompraestadotipo"] = 1; // guardo 1 ya que es el id de la compra iniciada
                  $arrayConsultaE["cefechaini"] = $fechaC;
                  $arrayConsultaE["cefechafin"] = NULL;
                  $resultado = $abmCompraEstado->alta($arrayConsultaE);
              } else if($idCompra != null){
                $idCompra=$idCompra;
              }
            
        // Creo el CompraItem
        for ($i = 0; $i < count($colDatos); $i++) {
            //print_r($colDatos);
            $arrayConsulta = [];
            $arrayProducto = $colDatos[$i];
            $idProducto = $arrayProducto["id"];
            $proCantidad = $arrayProducto["cant"];
            $arrayConsulta["idcompra"] = $idCompra;
            $arrayConsulta["idproducto"] = $idProducto;
            $arrayConsulta["cicantidad"] = $proCantidad;
            $abmCompraItem->alta($arrayConsulta);
            
            //doy de baja el stokc delos item..
            $stok= $arrayProducto["stock"];
            $nuevoStock= ($stok - $proCantidad);

            $paramP['idproducto']=$idProducto;
         
            $buscarProd= $abmCompraProduct->buscar($paramP);
            $paramPr['idproducto']=$buscarProd[0]->getIdProducto();
            $paramPr['pronombre']=$buscarProd[0]->getProNombre();
            $paramPr['prodetalle']=$buscarProd[0]->getProDetalle();
            $paramPr['procantstock']= $nuevoStock;
            $paramPr['tipo']=$buscarProd[0]->getTipo();
            $paramPr['imagenproducto']=$buscarProd[0]->getImagenProducto();
            $setearpro= $abmCompraProduct->modificar($paramPr);
            
        }

        $objSesion->eliminarCarrito();
    }

    }

?>