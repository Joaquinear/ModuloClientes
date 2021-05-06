<?php
require_once "../clases/mysql.class.php";
require_once "../clases/Plan.php";

class Cuota{



             function RegistrarCuotas($codPlan,$cantidadCuotas,$precio)
            {
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }   
            $consulta="Select nombre from cantidadcuota where codCantidadCuota='$cantidadCuotas'";
            $db->Query($consulta);

            $db->MoveFirst();
            $fila=$db->Row();
            $resu=$fila->nombre[0].$fila->nombre[1];


            $intervalo= 12/$resu;
            $monto= $precio/$resu;
            $fechaPago= date('Y-m-d');
        for ($i=1; $i <=$resu ; $i++) { 

            $consulta= "INSERT into cuota (codPlan,monto,fecha,estado) values ('$codPlan','$monto','$fechaPago',0) ";
            $db->Query($consulta);
            $fecha = strtotime($fechaPago);
            $fechaPago = date("Y-m-d", strtotime("+".$intervalo." month", $fecha));
            
           

        }

        
    }




         function TraerUltimoPlan($codUsuario)
            {
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
           

            $consulta= "SELECT cuo.* from cuota cuo left join plan p on p.codPlan=cuo.codPlan where p.estado=0 and p.codUsuario='$codUsuario' ";
            $db->Query($consulta);
            return $db;
            
           

        

        
    }



    function RegistrarPago($codPlan,$codCuota,$monto){

        
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }

        $consulta="INSERT into pago ( codPlan ,  monto ,  fecha ) VALUES ('$codPlan','$monto',SYSDATE() ) ";
      
        $db->ThrowExceptions = true;
        $success=true;
        if (! $db->TransactionBegin()) $db->Kill();
        
        if (!$db->Query($consulta)){ 
            $success = false;
            $this->mensaje=" Error al crear cabecera.<br>";
        }else{
            
            $iPlan=new Plan();
            if ($iPlan->ActualizarCuota($codCuota)) {
                
                $aux=$iPlan->VerificarUltimoPago($codPlan);
                $success=$aux;
            }
            else
            {
                $success=false;
            }
        }
    
        if ($success) {
            if (! $db->TransactionEnd()) {
                $db->Kill();
            }
            else
            {
                //$iPlan= new Cuota();
                //$iCuota->RegistrarCuotas($codPlan,$cantidadCuotas,$precio);
                return $codPlan;
            }
                             
            }       
             

            
            
         else {    
            if (! $db->TransactionRollback()) {
                $db->Kill();
            }
        }
        return "0";
    }


    



    function CancelarCuotas($codPlan)
            {
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
           

            $consulta= "UPDATE cuota set estado=3 where codPlan='$codPlan' and estado != 1 ";
            $db->Query($consulta);
            $consulta2="UPDATE suscripcion set estado=2 where codUsuario=(select codUsuario from plan where codPlan='$codPlan')";
            $db->Query($consulta2);
            
           

        

        
    }


   



}



?>