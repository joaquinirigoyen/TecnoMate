<?php
class MenuRol {
    private $ObjMenu;
    private $ObjRol;
    private $mensajeoperacion;
    

    public function getObjMenu()
    {
        return $this->ObjMenu;
    }

    public function setObjMenu($menu)
    {
        $this->ObjMenu = $menu;
    }

    public function getObjRol()
    {
        return $this->ObjRol;
    }

    public function setObjRol($rol)
    {
        $this->rObjRol = $rol;
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
         $this->ObjMenu= new Menu();
         $this->ObjRol= new Rol(); 
         $this->mensajeoperacion ="";
        
     }

     public function setear($ObjMenu, $ObjRol)    {
        $this->setObjMenu($ObjMenu);
        $this->setObjRol($ObjRol);
    }
    
    
    public function cargar() {
      $resp = false;
      $base = new BaseDatos();
      $sql = "SELECT * FROM menurol WHERE idmenu = '".$this->getObjMenu()->getIdMenu()."'";
      if ($base->Iniciar()) {
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
          if ($res > 0) {
            $row = $base->Registro();
            
            $objmenu = new Menu();
            $objmenu->setIdMenu($row['idmenu']);
            $objmenu->cargar();

            $objRol= new Menu();
            $objRol->setIdRol($row['idrol']);
            $objRol->cargar();

            $this->setear( $objmenu, $objRol);
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
        $sql = "INSERT INTO menurol (idmenu, idrol) VALUES (".$this->getObjMenu()->getIdmenu().", ".$this->getObjRol()->getIdRol().")";
    
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
        $sql = "UPDATE menurol SET idrol = ".$this->getObjRol()->getIdRol()." WHERE idmenu = ".$this->getObjMenu()->getIdMenu()."";
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
        $sql = "DELETE FROM menurol WHERE idmenu= ".$this->getObjMenu()->getIdMenu()." AND idrol=".$this->getObjRol()->getIdRol()."";
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
          $sql .= "WHERE" .$parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
          if ($res > 0) {
    
            while ($row = $base->Registro()) {
              $obj = new MenuRol();
    
              $objMenu = new Menu();
              $objMenu->setIdMenu($row['idmenu']);
              $objMenu->cargar();
    
              $objRol = new Rol();
              $objRol->setIdRol($row['idrol']);
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