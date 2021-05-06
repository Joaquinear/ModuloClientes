<?php
session_name( 'sgc2' );
session_start();
require_once "../clases/Reserva.php";





	$codSucursal= $_POST['ddsucursal'];
	$codTipoHabitacion= $_POST['ddtipohabitacion'];
	$fechaIngreso= $_POST['txtfechaingreso'];
	$fechaSalida= $_POST['txtfechasalida'];
	$cantidadPersonas= $_POST['txtcantidad'];
	$codUsuario= $_POST['codUsuario'];

    $iReserva= new Reserva();
    if ($iReserva->RegistrarReserva($codUsuario,$codSucursal,$codTipoHabitacion,$fechaIngreso,$fechaSalida,$cantidadPersonas)) {
    	echo 'ok'; 	
    }else
    {
    	echo '0';
    }
   

    	


?>
