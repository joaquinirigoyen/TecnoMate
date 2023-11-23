<?php
class AbmUsuarioRol {
    
    // Metodos

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * @param array $param
     */
    private function cargarObjeto ($param){
        $obj = null;
        if (array_key_exists('idusuario',$param) and array_key_exists('idrol',$param))
        {
            //Inicio modificacion Marco
            $obj = new UsuarioRol();
            $abmUsuario = new AbmUsuario ();
            $abmRol = new AbmRol ();
            $array = [];
            $array ['idusuario'] = $param['idusuario'];
            $array ['idrol'] = $param['idrol'];
            $listaUsuarios = $abmUsuario -> buscar ($array);
            $listaRoles = $abmRol -> buscar ($array);
            $objUsuario = $listaUsuarios[0];
            $objRol = $listaRoles[0];
            $obj -> setear($objUsuario, $objRol);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * ES IGUAL A cargarObjeto()
     * @param array $param
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if (isset($param['idusuario']) && isset($param['idrol'])) {
            $obj = new UsuarioRol();
            $abmUsuario = new AbmUsuario ();
            $abmRol = new AbmRol ();
            $array = [];
            $array ['idusuario'] = $param['idusuario'];
            $array ['idrol'] = $param['idrol'];
            $listaUsuarios = $abmUsuario -> buscar ($array);
            $listaRoles = $abmRol -> buscar ($array);
            $objUsuario = $listaUsuarios[0];
            $objRol = $listaRoles[0];
            $obj -> setear($objUsuario, $objRol);
        }
        return $obj;
    }
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
     private function seteadosCamposClaves($param){
        $echo="entro al seteado";
        $resp = false;
        if (isset($param['idrol']) && isset($param['idrol'])){
            $resp = true;
        }
        return $resp;
    }
    
    /**
     * Carga un usuarioRol a la BD. Espera un array como parametro.
     * Retorna un booleano
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $elObjUsuarioRol = $this->cargarObjeto($param);
        if ($elObjUsuarioRol!=null and $elObjUsuarioRol->insertar()){
            $resp = true;
        }
        return $resp;
    }

    /**
     * Borra un usuarioRol de la BD. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        echo"entro al baja";
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            echo"entro al if";
            $elObjUsuarioRol = $this->cargarObjetoConClave($param);
            if ($elObjUsuarioRol!=null and $elObjUsuarioRol->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Modifica un usuarioRol. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjUsuarioRol = $this->cargarObjeto($param);
            if($elObjUsuarioRol!=null and $elObjUsuarioRol->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Busca en la BD con o sin parametros. Espera un array como parametro.
     * Retorna un array con lo encontrado.
     * @param array $param
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario = ".$param['idusuario'];
            }
            if (isset($param['idrol'])) {
                $where .= " and idrol = ".$param['idrol'];
            }
        }

        $obj = new UsuarioRol();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }
}
?>