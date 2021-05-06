<?php
require_once "../clases/mysql.class.php";
require_once "../clases/Plan.php";

class Reserva{


    function RegistrarReserva($codUsuario,$codSucursal,$codTipoHabitacion,$fechaIngreso,$fechaSalida,$cantidadPersonas){

        
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }

        $consulta="INSERT into reserva ( codUsuario ,  codSucursal ,  codTipoHabitacion, fechaRegistro, fechaIngreso, fechaSalida, cantidadPersonas, estado ) VALUES ('$codUsuario','$codSucursal','$codTipoHabitacion',SYSDATE(),'$fechaIngreso', '$fechaSalida','$cantidadPersonas',0 ) ";
      
        
        if (!$db->Query($consulta)){ 
         return false;
        }
       
        
        return true;
    }


    



    


   



}



?>