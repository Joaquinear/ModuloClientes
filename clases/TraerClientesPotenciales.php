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
        $consulta="select cl.Cliente_id,per.Ci,concat(per.Nombres,' ',per.Apellido_Paterno,' ',per.Apellido_Materno) as Nombre_Completo, per.edad,per.Nacionalidad,per.telefono,per.Correo,
                        case 
                            when cl.Estado = 1 then 'Activo'
                            when cl.Estado = 2 then 'Inactivo'
                        end as Estado
                    from persona per inner join cliente cl on per.Ci = cl.Ci_Persona";
        
        $db->Query($consulta);

        return $db;
        
    }

}