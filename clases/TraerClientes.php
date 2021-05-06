<?php
require_once "../clases/mysql.class.php";

class TraerClientes{


	function TraerTodosLosClientes(){

        
        $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
        $condicion="";
        $consulta="select concat(per.Primer_nombre,' ',per.Segundo_nombre,' ',per.Apellido_Paterno,' ',per.Apellido_Materno) as Nombre_Completo,
        lts1.TamanhoMts2 as tamano,pln.Monto_Total as precio_Lote,pln.Tipo_Moneda as Moneda,urbn.Nombre_Urbanizacion as Nombre_Urbanizacion
        ,pln.Fecha_Inicio as Fecha_Inicio,pln.Fecha_Fin as Fecha_Fin ,per.Telefono_celular as Celular ,pln.Estado as estado
        from lote_vendido lotv inner join lotes lts on lotv.Id_Lote = lts.Id_Lotes  
        inner join plan_de_pago pln on pln.Id_Lote_Vendido = lotv.Id_Lote_Vendido
        inner join cliente cli on cli.Id_Cliente = pln.Id_Cliente
        inner join persona per on per.Id_Persona = cli.Id_Persona
        inner join lotes lts1 on lts1.Id_Lotes = lotv.Id_Lote
        inner join urbanizacion urbn on urbn.Id_Urbanizacion = lts1.Id_Urbanizacion";
        
        $db->Query($consulta);

        return $db;
        
    }

}