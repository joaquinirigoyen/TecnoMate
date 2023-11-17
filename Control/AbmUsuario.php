<?php

class AbmUsuario
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuario
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idusuario', $param) and
            array_key_exists('usnombre', $param) and
            array_key_exists('uspass', $param) and
            array_key_exists('usmail', $param) and
            array_key_exists('usdeshabilitado', $param)
        ) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], $param['usnombre'], $param['uspass'], $param['usmail'], $param['usdeshabilitado']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     *  que son claves
     * @param array $param
     * @return Usuario
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idusuario'])) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], null, null, null, null);
            $obj->cargar();
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idusuario']))
            $resp = true;
        return $resp;
    }

    /**
     * Esta función carga la información de un objeto a la base de datos
     * 
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;
        $objUsuario = $this->cargarObjeto($param);
        if ($objUsuario != null && $objUsuario->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $unObjUsuario = $this->cargarObjeto($param);
            if ($unObjUsuario != null && $unObjUsuario->eliminar()) {
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

        $respuesta = false;
        if ($this->seteadosCamposClaves($param)) {

            $objUsuario = $this->cargarObjeto($param);
            
            if ($objUsuario != null and $objUsuario->modificar()) {
                $respuesta = true;
            }
        }
        return $respuesta;
    }


    /**
     * Devuelve una lista con los roles de los usuarios, espera
     * $param['idusuario'] y $param['idrol'], retorna un
     * arreglo de objetos objetos usuarioRol
     * 
     * @return array
     */
    public function darRoles($param)
    {
        $where = " true ";
        if ($param <> null) {
            if (isset($param['idusuario']))
                $where .= " and idusuario =" . $param['idusuario'];
            if (isset($param['idrol']))
                $where .= " and idrol =" . $param['idrol'];
        }
        $obj = new UsuarioRol();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

    public function borrarRol()
    {
        $resp = false;
        if (isset($param['idusuario']) && isset($param['idrol'])) {
            $objTabla = new UsuarioRol();
            $objTabla->setear($param['idusuario'], $param['idrol']);
            $resp = $objTabla->eliminar();
        }

        return $resp;
    }

    /* permite actualizar la fecha de baja del usuario */
    public function borradoLogico($param)
    {

        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $unObjUsuario = $this->cargarObjetoConClave($param);
            $unObjUsuario->deshabilitar();
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
    public function buscar($param)
    {
        $where = " true";
        if ($param <> null) {
            if (isset($param['idusuario']))
                $where .= " and idusuario = " . $param['idusuario'];
            if (isset($param['usnombre']))
                $where .= " and usnombre = '" . $param['usnombre'] . "'";
            if (isset($param['uspass']))
                $where .= " and uspass = '" . $param['uspass'] . "'";
            if (isset($param['usmail']))
                $where .= " and usmail = '" . $param['usmail'] . "'";
            if (isset($param['usdeshabilitado']))
                $where .= " and usdeshabilitado = '" . $param['usdeshabilitado'] . "'";
        }

        $obj = new Usuario();
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
    public function buscarColInfo($param)
    {

        $colInfo = array();
        $arregloObj = $this->buscar($param);

        if (count($arregloObj) > 0) {

            for ($i = 0; $i < count($arregloObj); $i++) {
                $colInfo[$i] = $arregloObj[$i]->obtenerInfo();
            }
        }

        return $colInfo;
    }
}
