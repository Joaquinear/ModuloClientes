<?php
require_once "../clases/mysql.class.php";
require_once "../clases/usuario.php";

class Venta{
    public $mensaje = "";



function CrearVenta($montoPagar,$plazoPagar,$MontoInicio,$montoTotal,$TipoVentaV,$idLotes,$txtcliente){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta=" INSERT into  venta (plazoPagar,montoPagar,MontoInicio,montoTotal,TipoVentaV,idLotes,idcliente) values ('$plazoPagar','$montoPagar','$MontoInicio','$montoTotal','$TipoVentaV',
                    '$idLotes','$txtcliente')"; 
       $db->ThrowExceptions = true;
        if (! $db->TransactionBegin()) $db->Kill();
        $success = true;
        $sql = $consulta;

        if (! $db->Query($sql)){
            $success = false;
             
        }

       
        if ($success) {
            $db->TransactionEnd();
        
               
                 return $db->GetLastInsertID();
            
              

        } else {
            if (! $db->TransactionRollback()) {
                $db->Kill();
                return "0";
            }
        }
        return "0";
        

    }
function UpdateLote($idLotes){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta="UPDATE lotes set baja = '1' where idLotes = '$idLotes'"; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }

function CrearCuota($fecha_Cuota,$monto,$saldo,$idventaC){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta="INSERT into cuotas (fecha_Cuota,monto,saldo,idventaC) values ('$fecha_Cuota','$monto','$saldo',(select max(idVenta) from venta))"; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }

    function InsertarPago($fecha_Cuota,$montodepositado,$idventa,$idcliente,$idcuota){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta="INSERT into cuota (fecha,montoDepositado,idVentaP,idClienteP,idCuota) values ('$fecha_Cuota','$montodepositado','$idventa','$idcliente','$idcuota')"; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }
        function BajaCuota($idcuota){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta="UPDATE cuotas set estado = '1' where idCuota = '$idcuota'"; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }

    function HayCuota($idventa)
    {
        
             $consulta = "SELECT COUNT(*) as hay from cuotas cu LEFT join venta ve on cu.idventaC = ve.idVenta WHERE cu.idventaC = '$idventa' and cu.estado = '0'";
           $db= new MySQL();

            if ($db->Error()){

                $db->Kill();

                return "0";

            }



        $db->Query($consulta);

        return $db;

       
        
    }



    function UpdateVenta($idventa){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
        
        $consulta="UPDATE venta set estado = '1' where idVenta = '$idventa'"; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }
}