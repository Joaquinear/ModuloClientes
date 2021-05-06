<?php
require_once "../clases/mysql.class.php";

class Cliente{
    public $mensaje = "";



    //******************************************************************************************************
    function NuevoCliente($codPersona,$codSucursal){
     
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
         
        $consulta="INSERT INTO cliente values ('',SYSDATE(),'$codPersona','$codSucursal')"; 
        $db->ThrowExceptions = true;
        if (! $db->TransactionBegin()) $db->Kill();
        $success = true;
        $sql = $consulta;

        if (! $db->Query($sql)){
            $success = false;
        }
       
        if ($success) {
            if (! $db->TransactionEnd()) {
                $db->Kill();
            }

            $codCliente=$db->GetLastInsertID();
            return $codCliente;
        } else {
            if (! $db->TransactionRollback()) {
                $db->Kill();
                return "0";
            }
        }
        return "0";
        



    }

}



?>
