<?php
class Session{

    //IMPLEMENTAR TIENE PERMISOS

    /*_ _construct(). Constructor que. Inicia la sesión.*/
    public function __construct() {
        if(!array_key_exists('idusuario', $_SESSION)){
            session_start();
        }
    }

    /**
     * iniciar($nombreUsuario,$psw). Actualiza las variables de sesión con los valores ingresados.
     */
    public function iniciar($nombreUsuario, $psw){
        $resp = false;
        $objAbmUsuario = new AbmUsuario();

        $param['usnombre'] = $nombreUsuario;
        $param['uspass'] = $psw;
        $param['usdeshabilitado'] = NULL;

        //Buscamos la colección de usuarios que cumplen con usuario y contraseña
        $colUsuarios = $objAbmUsuario->buscar($param);
        
        //Si existe al menos uno se procede...
        if (count($colUsuarios) > 0){

            //Como existe al menos 1 lo aislamos
            $usuario = $colUsuarios[0];

            //Tomamos su id y lo guardamos como parámetro para comparar despues
            $idusuario = $usuario->getIdUsuario();
            $param2['idusuario'] = $idusuario;

            //Obtenemos toda la colección de roles que tiene ese usuario a partir
            //de los parámetros que enviemos
            $colUsuarioRol = $objAbmUsuario->darRoles($param2);

            //Si tiene al menos 1 rol podrá iniciar sesión en la página y podrá
            //visualizarla con la vista de su rol de mayor categoría
            if(count($colUsuarioRol) > 0){
                $_SESSION['idusuario'] = $usuario->getIdUsuario();
                $_SESSION['usnombre'] = $usuario->getUsNombre();
                $_SESSION['usmail'] = $usuario->getUsMail();
                $_SESSION['rol'] = $colUsuarioRol[0]->getObjRol()->getIdRol();

                for ($i = 0; $i < count($colUsuarioRol); $i++){
                    $_SESSION['colroles'][$i] = $colUsuarioRol[$i]->getObjRol()->getIdRol();
                }
                
                $resp = true;
            }

        }else{
            $this->cerrar();
        }
        return $resp;
    }

    /**validar(). Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.*/
    public function validar(){
        $resp = false;
        if ($this->activa() && isset($_SESSION['idusuario'])){
            $resp = true;
        }
        return $resp;
    }

    /*activa(). Devuelve true o false si la sesión está activa o no. */
    public function activa() {
        $resp = false;
        if (php_sapi_name() !== 'cli'){
            if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
                $resp = session_status() === PHP_SESSION_ACTIVE ? true : false;
            }else{
                $resp = session_id() === '' ? false : true;
            }
        }
        return  $resp;
    }

    /**Devuelve el usuario logeado*/
    public function getUsuario()  {
       $usuario = null;
       if ($this->validar()){
        $obj = new AbmUsuario();
        $param['idusuario'] = $_SESSION['idusuario'];
        $resultado = $obj->buscar($param);
        if (count($resultado) > 0){
            $usuario = $resultado[0];
        }
       }
       return $usuario;
    }

    /**devuelve el rol del usuario logeado */
    public function getRol() {
        $rol = null;
        if ($this->validar()){
         $obj = new AbmUsuario();
         $param['idusuario'] = $_SESSION['idusuario'];
         $resultado = $obj->darRoles($param);
         if (count($resultado) > 0){
            $rol = $resultado[0];
         }
        }
        return $rol;
    }

     /**
     * Funcion que devuelve la ruta donde redirigir si tiene los permisos validos
     */
    public function rutaCarpetas(){
        
        $listaUsuarioRoles = $this->getRol();//devuelve un rol de la session
        //verEstructura($listaUsuarioRoles);
        $idRol['idrol'] = $listaUsuarioRoles->getObjRol()->getIdRol();//lo guarde en un array
        $objRol = new AbmRol();//crear un obj rol
        $rolPorDefecto = $objRol->buscar($idRol);//busco el rol por defecto
        $rolDesc = $rolPorDefecto[0]->getRolDescripcion();//obtengo la descripcion del rol
        $loweCaseRolDesc = strtolower($rolDesc);//la paso a minuscula(por como tenemos las carpetas)
        $ruta = "../".$loweCaseRolDesc."/home".$rolDesc.".php";
        return $ruta;
    }

    /**
     * Funcion que verfica si un usuario tiene permisos.
     * Retorna false si no los tiene o una lista de los menus si tiene los roles
     */
    public function verificarPermisos(){
        $resp = false;
        $param['idpadre']  = $_SESSION['rol'];//guarda el rol de la session. el 3 corresponde a clientes, 2 a deposito, 1 a administrador
        $menu = new AbmMenu();//se crea un objeto menu
        $listaMenu = $menu->buscar($param);//se busca el menu segun el idpadre
        if(count($listaMenu)>0){
            $resp = $listaMenu;
        }
        return $resp;
    }

    public function permisos() {
        // Obtén el rol actual del usuario desde la sesión
        $rolUsuario = $_SESSION['rol'];
    
        // Obtén la URI solicitada
        $uriSolicitada = strtolower(trim($_SERVER['REQUEST_URI']));
    
        // Define los permisos permitidos para cada rol (ajusta según tus necesidades)
        $permisos = [
            '3' => ['/tp-finalpwd-grupo2a/vista/cliente/'],
            '2' => ['/tp-finalpwd-grupo2a/vista/deposito/'],
            '1' => ['/tp-finalpwd-grupo2a/vista/administrador/'],
        ];
    
        // Verifica si la URI solicitada está permitida para el rol actual
        $permitido = false;
        foreach ($permisos[$rolUsuario] as $rutaPermitida) {
            $rutaPermitida = strtolower(trim($rutaPermitida));
    
            //Verifica si la URI solicitada comienza con la ruta permitida
            if (strpos($uriSolicitada, $rutaPermitida) === 0) {
                $permitido = true;
                break;
            }
        }
        return $permitido;
    }
    

    /**cierra la sesion actual */
    public function cerrar()
    {
        $resp = true;
        session_destroy();
        return $resp;
    }

/*
    * Elimina el carrito
    */
   public function eliminarCarrito()
   {
       $exito = false;
       if (isset($_SESSION['carrito'])) {
           unset($_SESSION["carrito"]);
           $exito = true;
       }
       return $exito;
   }

   /**
     * Paga el carrito
     */
    public function finalizarCompra($colDatos,$idUsuario){
        $abmCompra = new AbmCompra();
        $abmCompraEstado = new AbmCompraEstado();
        $abmCompraItem = new AbmCompraItem();
        $abmCompraProduct = new AbmProducto();

        
              $param['idusuario']=$idUsuario;
             //echo $idUsuario;
              $idCompra=$abmCompra->compraActiva($param);
             //echo $idCompra;
              if ( $idCompra == null){
                $fechaC=date("Y-m-d H:i:s");
                $arrayConsulta = [];
                $arrayConsulta["idusuario"] = $idUsuario;
                $arrayConsulta["cofecha"] =   $fechaC;
                $arrayConsulta["accion"] = "nuevo";
                $resultado = $abmCompra->abm($arrayConsulta);
                $ultimaCompra =$abmCompra->ultimaCompra();
                //echo  $ultimaCompra;
                $idCompra= $ultimaCompra;

              /* Crear un CompraEstado, con el tipo de estado siendo Iniciada*/
                $arrayConsultaE = [];
                 $arrayConsultaE["idcompra"] = $idCompra;
                $arrayConsultaE["idcompraestadotipo"] = 1; // guardo 1 ya que es el id de la compra iniciada
                  $arrayConsultaE["cefechaini"] = $fechaC;
                  $arrayConsultaE["cefechafin"] = NULL;
               // $resultado = $abmCompraEstado->abm($arrayConsultaE);
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

            $stok= $arrayProducto["stock"];
            $nuevoStock= $stok - $proCantidad;

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
 

        $this->eliminarCarrito();
    }
}