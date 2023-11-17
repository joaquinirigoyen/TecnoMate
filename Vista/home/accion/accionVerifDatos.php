
<p>
Nota: Hacer que al crear una cuenta, esta queda en la base de datos
      Hacer en el rol Adminstrador un listarUsuarios con un editar rol
      y algo que chequea si el usuario tiene rol o no (Mostrarlos en la 
      lista o hacer un listar que liste usuarios sin roles)
      Como diferenciar nuevos susarios de ya existentes?
</p>
<?php 
include_once("../../../configuracion.php");
$datos = data_submitted();
$objUsuario = new AbmUsuario();
$exiteUsuario = $objUsuario->buscar($datos);
if(count($exiteUsuario)>0){
    //por ahora solo se va a guardar en la base de datos
    if($exito = $objUsuario->alta($exiteUsuario)){
        echo "Registro existoso!";
    }else{
        echo "Sucedio un Errosr al cargar el usuario";
    }
}else{
    
    echo "Usuario ya existente <br>";
}
?>