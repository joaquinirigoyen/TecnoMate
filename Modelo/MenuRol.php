<?php
class MenuRol {
    private $menu;
    private $rol;
    private $mensajeoperacion;
    

    public function getmenu()
    {
        return $this->menu;
    }

    public function setmenu($menu)
    {
        $this->menu = $menu;
    }

    public function getrol()
    {
        return $this->rol;
    }

    public function setrol($rol)
    {
        $this->rol = $rol;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function __construct(){
         $this->menu="";
         $this->rol="" ;
         $this->mensajeoperacion ="";
        
     }

     public function setear($menu, $rol)    {
        $this->setmenu($menu);
        $this->setrol($rol);
    }
    
    
    public function cargar() {
      $resp = false;
      $base = new BaseDatos();
      $sql = "SELECT * FROM menurol WHERE objmenu = ".$this->getObjMenu()."";
      if ($base->Iniciar()) {
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
          if ($res > 0) {
            $row = $base->Registro();
            $this->setear($row['idmenu'], $row['idrol']);
          }
        }
      } else {
        $this->setmensajeoperacion("MenuRol->listar: ".$base->getError());
      }
      return $resp;
    }

    
    public function insertar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO menurol (idmenu, idrol) VALUES (".$this->getObjMenu()->getIdmenu().", ".$this->getObjRol()->getIdrol().")";
    
        if ($base->Iniciar()) {
          if ($base->Ejecutar($sql)) {
    
            $resp = true;
          } else {
            $this->setmensajeoperacion("MenuRol->listar: ".$base->getError()[2]);
          }
        } else {
          $this->setmensajeoperacion("MenuRol->listar: ".$base->getError()[2]);
        }
        return $resp;
      }
    
      public function modificar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE menurol SET idrol = ".$this->getObjRol()->getIdrol()." WHERE idmenu = ".$this->getObjMenu()->getIdmenu()."";
        if ($base->Iniciar()) {
          if ($base->Ejecutar($sql)) {
            $resp = true;
          } else {
            $this->setmensajeoperacion("MenuRol->listar: ".$base->getError());
          }
        } else {
          $this->setmensajeoperacion("MenuRol->listar: ".$base->getError());
        }
        return $resp;
      }
    
      public function eliminar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM menurol WHERE idmenu= ".$this->getObjMenu()->getIdmenu()." AND idrol=".$this->getObjRol()->getIdrol()."";
        if ($base->Iniciar()) {
          if ($base->Ejecutar($sql)) {
            return true;
          } else {
            $this->setmensajeoperacion("MenuRol->listar: ".$base->getError());
          }
        } else {
          $this->setmensajeoperacion("MenuRol->listar: ".$base->getError());
        }
        return $resp;
      }
    
      public static function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM menurol ";
        if ($parametro != "") {
          $sql .= " WHERE {$parametro}";
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
          if ($res > 0) {
    
            while ($row = $base->Registro()) {
              $obj = new MenuRol();
    
              $objMenu = new Menu();
              $objMenu->setIdmenu($row['idmenu']);
              $objMenu->cargar();
    
              $objRol = new Rol();
              $objRol->setIdrol($row['idrol']);
              $objRol->cargar();
    
              $obj->setear($objMenu, $objRol);
    
              array_push($arreglo, $obj);
            }
          }
        }
    
        return $arreglo;
      }
}
?>