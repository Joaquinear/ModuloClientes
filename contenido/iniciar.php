<?php
session_name( 'sgc2' );
session_start(); 
$user=@$_POST["txusuario"];
$pass=@$_POST["txpassword"];

include_once "../clases/usuario.php";
$iUsuario= new Usuario();
$iUsuario->IniciarSesion($user, $pass);
if ($iUsuario->EstaLogueado()){
    $_SESSION['codigousuario'] = $iUsuario->obtenerIdTrabajador();
    $_SESSION['usuario'] = $iUsuario->obtenerUsuario();
    $_SESSION['nombre'] = $iUsuario->obtenerNombre();
    $_SESSION['Apellido'] = $iUsuario->obtenerApellido();

    $_SESSION['rol'] = $iUsuario->obtenerRol();
   
    $tipo=$iUsuario->obtenerPerfil();
    $_SESSION['perfil'] =$tipo;
    //REEMPLAZAR PERFILES POR ROLES
    echo "OK";
}else{
	echo "No se pudo iniciar sesión. <br>Usuario o/y contraseña incorrectos.";
}
?>