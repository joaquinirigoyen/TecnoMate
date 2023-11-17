<?php
include_once "../../configuracion.php";
$sesion= new Session();
if ($sesion->activa()) {
    //$listaUsuarioRol = new AbmUsuarioRol();// el buscar devuelve objetos UsuarioRol
    $listaUsuarioRol = $sesion->getRol();// me devuelve un obj UsuarioRol que contiene un obj Usuario y un obj Rol
    if($listaUsuarioRol == null){
        echo "No esta devolviendo nada <br>";
    }else{
        echo "devolvio algo <br>";
    }
    echo "Lista UsuariRol <br>";
    verEstructura($listaUsuarioRol);
    echo "<br> Id Objeto Rol <br>";
    $verRol= $listaUsuarioRol->getObjRol()->getIdRol();
    echo $verRol. " <br>";
    $idRol['idrol']=$listaUsuarioRol->getObjRol()->getIdRol();
    verEstructura($idRol);
    $menuRol= new AbmMenuRol();
    $buscaMenu = $menuRol->buscar($idRol);//bucsamos el menu por el id del rol(esto devuleve un obj menuRol)
    echo "Objeto menuRol <br>";
    verEstructura($buscaMenu);
    $objMenuRol= $buscaMenu[0];
    $idMenu['idmenu']= $objMenuRol->getmenu()->getIdMenu();
    $objMenu = new AbmMenu();
    $menu = $objMenu->buscar($idMenu);// lista de menus (es un array)
    echo "Menu <br>";
    verEstructura($menu);
    //buscar los submenus con idpadre para colocarlos
    
}
?>