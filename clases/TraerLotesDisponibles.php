<?php
require_once "../clases/mysql.class.php";

class TraerLotesDisponibles{


	function TraerLotesDisponibles(){

        
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
        $condicion="";
        $consulta="select Id_Produto,Nombre_Producto,Descripcion_Productos,
                      Fabricante,Cantidad,Precio_Unitario, 
                          case 
                             when  estado = 1 then 'Activo'
                             when estado = 2 then 'Inactivo'
                              end as estado
                    from producto";
        
        $db->Query($consulta);

        return $db;
        
    }
    function TraerLotesVendidos_Reservados(){

        
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
        $condicion="";
        $consulta="CALL Ver_Lotes_Disponibles1";
        $consulta = "SELECT lts.Id_Lotes,urb.Ciudad,urb.Nombre_Urbanizacion,lts.TamanhoMts2,lts.Precio,lts.Tipo_Moneda,
        case lts.Id_EstadoLote
        when  1 then 'Disponible'
        when  2	then 'Reservado'
        when  3 then 'vendido'
        END as estado,
     concat(per2.Primer_Nombre,' ',per2.Apellido_Paterno)   as trabajadorV,
        concat(per.Primer_Nombre,' ',per.Apellido_Paterno)   as clienteV,
       concat(per4.Primer_Nombre,' ',per4.Apellido_Paterno)   as trabajadorR,
      concat(per3.Primer_Nombre,' ',per3.Apellido_Paterno)   as clienteR
        from lotes lts 
           left JOIN reserva re on re.Id_Lotes = lts.Id_Lotes
        left JOIN lote_vendido lvendido on lvendido.Id_Lotes = lts.Id_Lotes
        LEFT JOIN cliente cli on cli.Id_Cliente = lvendido.Id_Cliente
        left JOIN persona per on per.Ci_Identidad = cli.Ci_Identidad
          left JOIN trabajador tra on tra.Id_Trabajador = lvendido.Id_Trabajador
          left JOIN persona per2 on per2.Ci_Identidad = tra.Ci_Identidad
          
           LEFT JOIN cliente cli2 on cli2.Id_Cliente = re.Id_Cliente
        left JOIN persona per3 on per3.Ci_Identidad = cli2.Ci_Identidad
          left JOIN trabajador tra2 on tra2.Id_Trabajador = re.Id_Trabajador
          left JOIN persona per4 on per4.Ci_Identidad = tra2.Ci_Identidad
          left join urbanizacion urb on lts.Id_Urbanizacion = urb.Id_Urbanizacion 
        where lts.Id_EstadoLote in(2,3) GROUP BY lvendido.Id_Lotes";
        
        $db->Query($consulta);

        return $db;
        
    }

}