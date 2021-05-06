 <?php
require_once "mysql.class.php";
require_once "usuario.php";

class Reportes{












    public function totalxSucursal($codSucursal,$gestion){

     $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
       
        


    $consulta="SELECT sucursal,codSucursal,sum(ENE) as ENE,sum(FEB) as FEB,sum(MAR) as MAR,sum(ABR) as ABR,sum(MAY) as MAY,sum(JUN) as JUN,sum(JUL) as JUL,sum(AGO) as AGO,sum(SEP) as SEP,sum(OCT) as OCT,sum(NOV) as NOV,sum(DIC) as DIC from (select 
CASE WHEN tabla.mes = 'ENE' THEN (tabla.total) end as 'ENE',
CASE WHEN tabla.mes = 'FEB' THEN (tabla.total) end as 'FEB',
CASE WHEN tabla.mes = 'MAR' THEN (tabla.total) end as 'MAR',
CASE WHEN tabla.mes = 'ABR' THEN (tabla.total) end as 'ABR',
CASE WHEN tabla.mes = 'MAY' THEN (tabla.total) end as 'MAY',
CASE WHEN tabla.mes = 'JUN' THEN (tabla.total) end as 'JUN',
CASE WHEN tabla.mes = 'JUL' THEN (total) end as 'JUL',
CASE WHEN tabla.mes = 'AGO' THEN (total) end as 'AGO',
CASE WHEN tabla.mes = 'SEP' THEN (total) end as 'SEP',
CASE WHEN tabla.mes = 'OCT' THEN (total) end as 'OCT',
CASE WHEN tabla.mes = 'NOV' THEN (total) end as 'NOV',
CASE WHEN tabla.mes = 'DIC' THEN (total) end as 'DIC',codSucursal,sucursal
from (SELECT sucursal.nombre as sucursal,reserva.codSucursal, ELT(MONTH(reserva.fechaIngreso), 'ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC') as mes, COUNT(reserva.fechaIngreso) as total
                from reserva left join sucursal on reserva.codSucursal=sucursal.codSucursal where reserva.codSucursal='$codSucursal' and year(reserva.fechaIngreso)='$gestion'
                GROUP by month(reserva.fechaIngreso) ) as tabla) as fin";

    $db->Query($consulta);
        return $db;

}

function traerlotesxVendedor($ddmes,$planpago)
{
    $db= new MySQL();
    if ($db->Error()){
        $db->Kill();
        return "0";
    }

    $condicion = "";
        if($ddmes!="0")
        {
            $condicion.=" and month(ltv.Fecha_Venta)='$ddmes' ";
        }

        if($planpago!="0")
        {
            $condicion.=" and pln.Tipo_Plan_Pag='$planpago' ";
        }
        
      
       
    $consulta="SELECT  tbj.Id_Trabajador,concat(per.Primer_Nombre,' ',per.Segundo_Nombre,' ',per.Apellido_Paterno,' ',per.Apellido_Materno) as nombre_completo,
    count(pln.Tipo_Plan_Pag) as Cantidad_vendidos ,stl.Nombre as estado,tpp.Nombre as tipoPago,
    case (month(ltv.Fecha_Venta)) 
    when 1 then 'Enero' 
    when 2 then 'Febrero'
    when 3 then 'Marzo'
    when 4 then 'Abril'
    when 5 then 'Mayo'
    WHEN 6 THEN 'Junio'
    when 7 then 'Julio'
    when 8 then 'Agosto'
    When 9 then 'Septiembre'
    when 10 then 'Octubre'
    when 11 then 'Noviembre'
    else 'Diciembre'
    END
    as mes,pln.Gestion_Deuda
    from plan_de_pago pln
    inner join lote_vendido ltv on pln.Id_Lote_Vendido = ltv.Id_Lote_Vendido
    inner join trabajador tbj on pln.Id_Trabajador= tbj.Id_Trabajador
    inner join persona per on per.Ci_Identidad = tbj.Ci_Identidad
    inner join estadolote stl on ltv.Id_Estado_LoteVendido = stl.Id_EstadoLote
    inner join tipo_pago tpp on tpp.Id_Tipo_Pago = pln.Tipo_Plan_Pag
    where 1 $condicion
   
    group by pln.Id_Trabajador,pln.Tipo_Plan_Pag
";
    $db->Query($consulta) ;
    if($db->RowCount()>0)
    {
        return $db;
    }
    else
    {
        return false;
    }
       
}









  public function DetallexSucursal($sucursal,$gestion){

  	 $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
        $condicion="";
        if ($gestion!="") $condicion.=" and year(reserva.fechaIngreso) = '".$gestion."'";
      
        if ($sucursal!="") $condicion.=" and reserva.codSucursal = '".$sucursal."'";

    $consulta="SELECT sucursal,codSucursal,sum(ENE) as ENE,sum(FEB) as FEB,sum(MAR) as MAR,sum(ABR) as ABR,sum(MAY) as MAY,sum(JUN) as JUN,sum(JUL) as JUL,sum(AGO) as AGO,sum(SEP) as SEP,sum(OCT) as OCT,sum(NOV) as NOV,sum(DIC) as DIC from (select 
CASE WHEN tabla.mes = 'ENE' THEN (tabla.total) end as 'ENE',
CASE WHEN tabla.mes = 'FEB' THEN (tabla.total) end as 'FEB',
CASE WHEN tabla.mes = 'MAR' THEN (tabla.total) end as 'MAR',
CASE WHEN tabla.mes = 'ABR' THEN (tabla.total) end as 'ABR',
CASE WHEN tabla.mes = 'MAY' THEN (tabla.total) end as 'MAY',
CASE WHEN tabla.mes = 'JUN' THEN (tabla.total) end as 'JUN',
CASE WHEN tabla.mes = 'JUL' THEN (total) end as 'JUL',
CASE WHEN tabla.mes = 'AGO' THEN (total) end as 'AGO',
CASE WHEN tabla.mes = 'SEP' THEN (total) end as 'SEP',
CASE WHEN tabla.mes = 'OCT' THEN (total) end as 'OCT',
CASE WHEN tabla.mes = 'NOV' THEN (total) end as 'NOV',
CASE WHEN tabla.mes = 'DIC' THEN (total) end as 'DIC',codSucursal,sucursal,elmes
from (SELECT month(reserva.fechaIngreso) as elmes, sucursal.nombre as sucursal,reserva.codSucursal, ELT(MONTH(reserva.fechaIngreso), 'ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC') as mes, COUNT(reserva.fechaIngreso) as total
                from reserva left join sucursal on reserva.codSucursal=sucursal.codSucursal where 1 $condicion
                GROUP by month(reserva.fechaIngreso),reserva.codSucursal ) as tabla group by elmes,codSucursal) as fin group by codSucursal";

    $db->Query($consulta);
        return $db;

}
 public function DetalleReservas($sucursal,$fechaini,$fechafin){

  	 $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
        $condicion="";
        if ($fechaini!="") $condicion.=" and reserva.fechaRegistro >= '".$fechaini."'";
        if ($fechafin!="") $condicion.=" and reserva.fechaRegistro <= '".$fechafin."'";
        if ($sucursal!="") $condicion.=" and reserva.codSucursal = '".$sucursal."'";

    $consulta="SELECT reserva.codSucursal,count(reserva.codReserva)as total,sucursal.nombre as sucursal from reserva left join sucursal on reserva.codSucursal=sucursal.codSucursal where 1 $condicion group by reserva.codSucursal";

    $db->Query($consulta);
        return $db;

}






    public function ListaEncuestas($codTipoEncuesta,$gestion){

     $db= new MySQL();
        if ($db->Error()){
            $db->Kill();
            return "0";
        }
       


    $consulta="SELECT codTipoEncuesta,
 sum(a) as 'muy malo',
 sum(b)  as 'malo',
sum(c)  as 'regular',
 sum(d)  as 'bueno',
sum(e)  as 'muy bueno'
from(select codtipoEncuesta,tipo,
case when valor =1 then total end as 'a',
case when valor =2 then total end as 'b',
case when valor =3 then total end as 'c',
case when valor =4 then total end as 'd',
case when valor =5 then total end as 'e' from
(select encuesta.codTipoEncuesta,valor,count(encuesta.codEncuesta) as total, tipoencuesta.nombre as tipo from encuesta inner join tipoencuesta on encuesta.codTipoEncuesta=tipoencuesta.codTipoEncuesta where 1 and encuesta.codTipoEncuesta='$codTipoEncuesta' and year(encuesta.fechaRegistro)='$gestion' group by encuesta.codTipoEncuesta,encuesta.valor) as tab group by codTipoEncuesta,valor) as tabFinal group by codTipoEncuesta";

    $db->Query($consulta);
        return $db;

}




}


?>
