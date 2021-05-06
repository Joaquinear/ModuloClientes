<?php
require_once "../clases/mysql.class.php";

class TraerClientesPotenciales{


	function TraerClientesPotenciales(){

        
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
        $condicion="";
        $consulta="select cli.Id_Cliente,per.Ci_Identidad,concat(per.Primer_Nombre,' ',per.Segundo_Nombre,' ',per.Apellido_Paterno,' ',per.Apellido_Materno) as Nombre_completo,cli.Comentario, per.Telefono_Celular,per.Telefono_Fijo from persona per inner join cliente cli on per.Ci_Identidad = cli.Ci_Identidad";
        
        $db->Query($consulta);

        return $db;
        
    }

}