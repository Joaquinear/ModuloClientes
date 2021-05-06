<?php
require_once "../clases/mysql.class.php";
require_once "../clases/usuario.php";

class Persona{
    public $mensaje = "";



    //******************************************************************************************************
    function NuevaPersona($cipersona,$Primernombre,$Segundonombre,$Apellidopaterno,$Apellidomaterno,$telefonoCel,$telefonoFijo){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta="INSERT INTO persona values ('$cipersona','$Primernombre','$Segundonombre','$Apellidopaterno','$Apellidomaterno','$telefonoCel','$telefonoFijo')"; 
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


    function CrearUsuario($fecha_inicio,$rol,$usuario,$contra,$cipersona){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta=" INSERT into  trabajador values ('','$fecha_inicio','$usuario','$contra','$cipersona','$rol')"; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }

      function CrearCliente($FechaRegistro,$Comentario,$Ci_Identidad){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta=" INSERT into  cliente  values ('','$FechaRegistro','$Comentario','$Ci_Identidad')"; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }

    function EditarCliente($ci,$nombre,$paterno,$materno,$correo,$direccion){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta=" UPDATE persona  set Nombre = '$nombre' , apellidoP = '$paterno' , apellidoM = '$materno',correo ='$correo',direccion = '$direccion'
        where persona.ci = '$ci' "; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }

    function BajaClientes($ci){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta=" UPDATE cliente  set baja = '1' 
        where cliente.idPersonaC = '$ci'"; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }

     function BajaClientePersona($ci){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta=" UPDATE persona  set baja = '1' 
        where persona.CI = '$ci'"; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }

    
    public function traerCliente($ci){

        $db= new MySQL();
           if ($db->Error()){
               $db->Kill();
               return "0";
           }
          
   
   
       $consulta="SELECT cli.Id_Cliente,concat(per.Primer_Nombre,' ',per.Segundo_Nombre,' ',per.Apellido_Paterno,' ',per.Apellido_Materno) as Nombre_completo 
       from persona per 
       inner join cliente cli 
       on per.Ci_Identidad = cli.Ci_Identidad where cli.Ci_Identidad = '$ci'  ";
    //return $consulta;
       $db->Query($consulta);
       if($db->RowCount()>0)
       {
           $db->MoveFirst();
        return $db->Row();
       }
       else{
           return "0";
       }
           
   
   }
   function CrearReserva($Estado,$FechaInicio,$FechFin,$Monto_Rev,$TipoMoneda,$IdLote,$IdTrabajador,$IdCliente){
        

    $db= new MySQL();
    if ($db->Error()){
        $db->Kill();
        return "0";
    }
     
    $consulta="INSERT INTO reserva values ('','$Estado','$FechaInicio','$FechFin','$Monto_Rev','$TipoMoneda','$IdLote','$IdTrabajador','$IdCliente')"; 
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

    function guardarLoteVendido($fechaInicio,$idLote,$idCliente,$codTrabajador,$estadoLoteVendido){
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
        $consulta="INSERT INTO lote_vendido  values ('','$fechaInicio','$idCliente','$idLote','$codTrabajador','$estadoLoteVendido')"; 
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
        function guardarPlanPago($fechaInicio,$fechaFin,$gestion,$precioLote,$moneda,$tipoPago,$idLoteVendido,$idCliente,$estadoPlanPago,$plazo,$codTrabajador)
        {
            $db= new MySQL();
            if ($db->Error()){
                $db->Kill();
                return "0";
            }
            $consulta="INSERT INTO plan_de_pago values ('','$fechaInicio','$fechaFin','$gestion','$precioLote','$moneda','$tipoPago','$idLoteVendido','$idCliente','$estadoPlanPago','$plazo','$codTrabajador',null)"; 
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

            function guardarContrato($tipoContrato,$idPlanPago,$idCliente,$fechaInicio){
                $db= new MySQL();
                if ($db->Error()){
                    $db->Kill();
                    return "0";
                }
                $consulta="INSERT INTO contrato  values ('','$tipoContrato','$idPlanPago','$idCliente','$fechaInicio')"; 
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
                function guardarCuota($fechaFin,$Id_Estadocuota,$precioLote,$montoRestante,$montoTotalAPagar,$idCliente,$idPlanPago,$codTrabajador)
                {
                    $db= new MySQL();
                    if ($db->Error()){
                        $db->Kill();
                        return "0";
                    }
                    $consulta="INSERT INTO cuota  values ('','$fechaFin','$Id_Estadocuota','$precioLote','$montoRestante','$montoTotalAPagar','$idCliente','$idPlanPago','$codTrabajador')"; 
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
              

    function CambiarEstadoLote($idLote,$IdEstado){
        

        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta=" UPDATE lotes  set Id_EstadoLote = '$IdEstado' 
        where lotes.Id_Lotes = '$idLote'"; 
        $db->Query($consulta);
        
    

        // return $db->GetLastInsertID();
        
         return "OK";   


    }

}



?>
