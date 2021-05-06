<?php
require_once "../clases/mysql.class.php";

class TraerLotes{


	function TraerLotess($idlote){

        
       
        $consulta="SELECT precio_Lote FROM lotes where baja = '0' and idLotes='$idlote' ";
        
           $db= new MySQL();

            if ($db->Error()){

                $db->Kill();

                return "0";

            }



           $db->Query($consulta);

        $db->MoveFirst();

        return $db->Row();

       
        
    }


    function TraerVentas(){

        
       
        $consulta="SELECT ven.idVenta as idventa,ven.estado as estado,ven.TipoVentaV as tipoventa,ven.baja as baja,lo.nombre_Lote as nombrelote,lo.precio_Lote as preciolote,ven.montoTotal as montotal  FROM lotes lo left join venta ven on ven.idLotes = lo.idLotes where ven.baja = '0' ";
        
           $db= new MySQL();

            if ($db->Error()){

                $db->Kill();

                return "0";

            }



        $db->Query($consulta);

        return $db;

       
        
    }

    function TraerCuotas($idventa){

        
       
        $consulta="SELECT cu.idCuota as idcuota,cu.monto as monto,cu.idventaC as idventa,cu.estado as estado FROM cuotas cu where idventaC='$idventa' ";
        
           $db= new MySQL();

            if ($db->Error()){

                $db->Kill();

                return "0";

            }



            if (! $db->Query($consulta)) $db->Kill();
        return $db;

       
        
    }

}