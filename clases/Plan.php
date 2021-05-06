<?php
require_once "../clases/mysql.class.php";
require_once "../clases/Cuota.php";

class Plan{



            function RegistrarPlan($codUsuario,$codPaquete,$codtipoPlan,$cantidadCuotas,$precio){

        
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }

        $consulta="INSERT into plan ( codUsuario ,  codPaquete ,  codTipoPlan ,  codCantidadCuota ,  fechaRegistro) VALUES ('$codUsuario','$codPaquete','$codtipoPlan','$cantidadCuotas',CURRENT_DATE() ) ";
      
        $db->ThrowExceptions = true;
        $success=true;
        if (! $db->TransactionBegin()) $db->Kill();
        
        if (!$db->Query($consulta)){ 
            $success = false;
            $this->mensaje=" Error al crear cabecera.<br>";
        }else{
            $codPlan=$db->GetLastInsertID();
            //inserto el detalle para esta cotización
        }
        // Si hizo todo bien
        if ($success) {
            if (! $db->TransactionEnd()) {
                $db->Kill();
            }
            else
            {
                $iCuota= new Cuota();
                $iCuota->RegistrarCuotas($codPlan,$cantidadCuotas,$precio);
                return $codUsuario;
            }
                             
            }       
             

            
            
         else {    
            if (! $db->TransactionRollback()) {
                $db->Kill();
            }
        }
        return "0";
    }



         function ActualizarCuota($codCuota)
            {
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
           

            $consulta= "UPDATE cuota set estado=1 where codCuota='$codCuota' ";
            if ($db->Query($consulta)) {
                return true;
            }
            else
            {
                return false;
            }
            
            
           

        

        
    }


     function VerificarEstadoSuscripcion($codUsuario)
            {
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
           

            $consulta= "SELECT estado from suscripcion where codUsuario='$codUsuario' ";
            $db->Query($consulta);
            $db->MoveFirst();
            $fila= $db->Row();
            return $fila->estado;
            
            
           

        

        
    }



    function VerificarUltimoPago($codPlan)
            {
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
           

            $consulta= "SELECT * from cuota where codPlan='$codPlan' and estado=0 ";
            $db->Query($consulta);
            

            if ($db->RowCount()>0) {
                return true;
            }
            else
            {

                $consulta1= "UPDATE suscripcion set estado=1,fechaInicio=CURRENT_DATE(),fechaFin=(DATE_ADD(CURRENT_DATE(), INTERVAL 1 YEAR)) where codUsuario=(select codUsuario from plan where codPlan='$codPlan') ";
                $db->Query($consulta1);
                return true;
                
            }
            
            
           

        

        
    }




    



    


   



}



?>
