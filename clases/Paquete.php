<?php
require_once "../clases/mysql.class.php";

class Paquete{


	function TraerTodosLosPaquetes(){

        
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
        $condicion="";
        $consulta="SELECT * from paquete";
        
        $db->Query($consulta);

        return $db;
        
    }

}