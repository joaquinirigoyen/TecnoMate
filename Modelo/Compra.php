<?php
class Compra extends BaseDatos{
 private $idcompra;
 private $cofecha;
 private $objUsuario;
 private $mensajeoperacion;

 
 public function __construct()
 {
    $this->idcompra="";
    $this->cofecha="";
    $this->objUsuario= new Usuario();
 }



 /* Medodos get y set para $idcompra*/ 
  public function getIdCompra() {
   return $this->idcompra;
  }
 
  public function setIdCompra($idcompra){
   $this->idcompra = $idcompra;
  }

   /* Medodos get y set para $cofecha*/ 
   public function getCoFecha(){
    return $this->cofecha;
   }
   public function setCoFecha($cofecha){
    $this->cofecha = $cofecha;
   }
 
  /* Medodos get y set para $objUsuario*/ 

  public function getObjUsuario(){
   return $this->objUsuario;
  }
  public function setObjUsuario($objUsuario){
   $this->objUsuario = $objUsuario;
  }

  /* Medodos get y set para mensajeoperacion*/ 

  public function getMensajeOperacion(){
    return $this->mensajeoperacion;
  }
  public function setMensajeOperacion($valor){
    $this->mensajeoperacion = $valor;
  }

  public function setear($idcompra, $cofecha, $objUsuario) {
    $this->setIdCompra($idcompra);
    $this->setCoFecha($cofecha);
    $this->setObjUsuario($objUsuario);
  }



     /**
	 * Recupera los datos del usuario por idusuario
	 * @param int $idusuario
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
	public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql = "SELECT * FROM compra WHERE idcompra = '".$this->getIdCompra()."'";
        if ($base->Iniciar()) {
          $res = $base->Ejecutar($sql);
          if ($res > -1) {
            if ($res > 0) {
              $row = $base->Registro();
     
              $objUsuario = new Usuario();
              $objUsuario->setIdUsuario($row['idusuario']);
              $objUsuario->cargar();
     
              $this->setear($row['idcompra'], $row['cofecha'], $objUsuario);
            }
          }
        } else {
          $this->setMensajeOperacion("Compra->listar: ".$base->getError());
        }
        return $resp;
    }
 /**
     * Busca una compra por id.
     * Coloca su datos al objeto actual.
     * @param int $id
     * @return boolean
     */
    public function buscar($id){
     // print_r($id);
      echo"entro al buscar compra";
      $encontro = false;
      $base = new BaseDatos();
      $consulta = "SELECT * FROM compra WHERE idcompra = '" . $id . "'";

      if( $base->Iniciar()){
          if( $base->Ejecutar($consulta)){
              if($fila = $base->Registro()){
                  $objUsuario = new Usuario();
                  $objUsuario->buscar($fila["idusuario"]);
                  //print_r( $objUsuario);

                  $this->setear(
                      $fila["idcompra"],
                      $fila["cofecha"],
                      $objUsuario
                  );

                  $encontro = true;
              }
          }else{$this->setMensajeOperacion("Compra->buscar: ".$this->getError());}
      }else{$this->setMensajeOperacion("Compra->buscar: ".$this->getError());}

      return $encontro;
  }
  /**
     * Esta función lee los valores actuales de los atributos del objeto e inserta un nuevo
     * registro en la base de datos a partir de ellos.
     * Retorna un booleano que indica si le operación tuvo éxito
     * 
     * @return boolean
     */
    public function insertar(){

        $resp = false;
        $base = new BaseDatos();
        
        $sql = "INSERT INTO compra(cofecha, idusuario)
        VALUES ( '".$this->getCoFecha()."' , '". $this->getObjUsuario()->getIdUsuario() ."');";

     
        if ($base->Iniciar()) {
          if ($elId = $base->Ejecutar($sql)) {
            $this->setIdCompra($elId);
            $resp = true;
          } else {
            $this->setmensajeoperacion("Compra->insertar: ".$base->getError()[2]);
          }
        } else {
          $this->setMensajeOperacion("Compra->insertar: ".$base->getError()[2]);
        }
        return $resp;

    }

     /**
     * Esta función lee los valores actuales de los atributos del objeto y los actualiza en la
     * base de datos.
     * Retorna un booleano que indica si le operación tuvo éxito
     * 
     * @return boolean
     */
    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compra SET cofecha = '".$this->getCoFecha()."', idusuario = '".$this->getObjUsuario()->getIdUsuario()."' WHERE idcompra = '".$this->getIdCompra()."'";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Compra->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("Compra->modificar: ".$base->getError());
        }
        return $resp;
    }

     /**
     * Esta función lee el id actual del objeto y si puede lo borra de la base de datos
     * Retorna un booleano que indica si le operación tuvo éxito
     * 
     * @return boolean
     */
    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();

        $sql = "DELETE FROM compra WHERE idcompra = ".$this->getIdCompra()."";

        if ($base->Iniciar()) {
          if ($base->Ejecutar($sql)) {
            return true;
          } else {
            $this->setMensajeOperacion("Compra->eliminar: ".$base->getError());
          }
        } else {
          $this->setMensajeOperacion("Compra->eliminar: ".$base->getError());
        }
        return $resp;
    }
    

    /**
     * Esta función recibe condiciones de busqueda en forma de consulta sql para obtener
     * los registros requeridos.
     * Si por parámetro se envía el valor "" se devolveran todos los registros de la tabla
     * 
     * La función devuelve un arreglo compuesto por todos los objetos que cumplen la condición indicada
     * por parámetro
     * 
     * @return array
     */
    public function listar($parametro = ""){
    $arreglo = array();
    $base = new BaseDatos();

    $sql = "SELECT * FROM compra ";

   if ($parametro != "") {
     $sql .= " WHERE ".$parametro;
    }
   $res = $base->Ejecutar($sql);
   if ($res > -1) {
     if ($res > 0) {
       while ($row = $base->Registro()) {
         $obj = new Compra();

         $objUsuario= new Usuario();
         $objUsuario->setIdUsuario($row['idusuario']);
         $objUsuario->cargar();

         $obj->setear($row['idcompra'], $row['cofecha'], $objUsuario);

         array_push($arreglo, $obj);
       }
     }
    }
        return $arreglo;
    }



    /**
     * Esta función lee todos los valores de todos los atributos del objeto y los devuelve
     * en un arreglo asociativo
     * 
     * @return array
     */
    public function obtenerInfo(){

        $info = [];
        $info['idcompra'] = $this->getIdCompra();
        $info['cofecha'] = $this->getCoFecha();
        $info['idusuario'] =$this->getObjUsuario()->getIdUsuario();
        return $info;
    }

    public function buscarCompraActiva()
    {
     // echo"entro a buscar compra";
      $base = new BaseDatos();

        $resp = null;
      
       $consulta = "SELECT * FROM compra INNER JOIN compraestado ON compraestado.idcompra = compra.idcompra
        WHERE idusuario = ".$this->getObjUsuario()->getIdUsuario()." AND idcompraestadotipo = 1 ;";

        if ( $base ->Iniciar()) {
        //  echo"entro a iniciar";
            if ( $base->Ejecutar($consulta)) {
            //  echo"entro a ejecutar";
                if ($row= $base->Registro()) {
              //    echo"entro a registro";
                    $resp = new Compra();
                    $resp=$row["idcompra"];
                  //  echo $resp;
                }
            } else {
                $this->setMensajeOperacion("compra->buscarCompra: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("compra->buscarCompra: " . $this->getError());
        }
    
        return $resp;
    }

    public function buscarUltimaCompra()
    {
      $base = new BaseDatos();
     // print_r($param);
      //echo 'entro a buscar ultima compra';
        $resp = null;
      
       $consulta = "SELECT MAX(idcompra)  FROM compra;";
    
        if ( $base ->Iniciar()) {
       // echo 'entro A iniciar';
            if ( $base->Ejecutar($consulta)) {
          //  echo 'entro A ejecutar';
                if ($row= $base->Registro()) {
                   // echo 'entro A REGISTRO';
                    $resp=$row[0];
                }
            } else {
                $this->setMensajeOperacion("compra->buscarCompra: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("compra->buscarCompra: " . $this->getError());
        }
    
        return $resp;
    }


}

?>