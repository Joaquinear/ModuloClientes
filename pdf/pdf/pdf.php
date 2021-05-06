<?php
ob_start();
?>
<style>
<!--
#encabezado {padding:5px 0; border-bottom: 1px solid; width:100%;margin:auto;}
#encabezado .fila #col_1 {width: 15%; text-align: left;}
#encabezado .fila #col_2 {text-align:left; width: 65%}

#encabezado .fila #col_2 #span1{font-size: 15px;}
#encabezado .fila #col_2 #span2{font-size: 15px; color: #ccc;}

#footer {padding-bottom:5px 0;border-top: 2px solid #46d; width:80%; margin:auto;}
#footer .fila td {text-align:center; width:100%;}
#footer .fila td span {font-size: 10px; color: #000;}

#fecha {margin-top:100px; width:100%;}
#fecha tr td {text-align: right; width:100%;}

#central {margin-top:20px; width:100%;}
#central tr td {padding: 0px; text-align:left; width:100%;}

#datos { margin:auto; width:100%;}
#datos td{border:1px solid black;}
-->
</style>
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="20mm">
 
        
                
             
         
    

<?php


$id=$_GET["id"];



$db = new mysqli("localhost", "phpmyadmin", "Pw4Sqlgrt2011", "mainter.crm");
$c="Select * from persona where iPersona_id='$id'";
$r=$db->query($c);
while ($f=$r->fetch_assoc())
{

echo "<br>";
echo $f['sPersona_n']." ".$f['sPersona_app']." ".$f['sPersona_apm'];
echo "<br>";
if($f['sPersona_photo']!=NULL)
{
echo '<img src="../../'. $f['sPersona_photo'] .'" width="80" height=80>';
echo "<br>";
}
else
{
    echo "No tiene Foto de Perfil";
}
}

//$cons= "select * from categoria_atributo where iStatus_fl=1";
$cons="SELECT per.iPersona_fl,cat.iCategoriaA_id,det.sAP_valor,ap.iTipoF_id,cat.ICategoriaA_nombre FROM atributo_persona ap inner join detalle_atributo_persona det on det.iAP_id = ap.iAP_id inner join persona per on per.iPersona_id=det.iPersona_id inner join categoria_atributo cat on cat.iCategoriaA_id=ap.iCategoriaA_id where per.iPersona_id=149 order by cat.iCategoriaA_id";
$res= $db->query($cons);




while($fil=$res->fetch_assoc())
{
    echo "<table border='1' cellspacing='0' cellpadding='1' bordercolor='#000000'>";
    echo "<tr>";
    echo "<td>";
   echo" <table border='0' cellspacing='0' cellpadding='0' >";
   echo "<tr>";
   echo "<td width='300'></td><td width='300' align='right'>".$fil['ICategoriaA_nombre']."</td>";
   echo "</tr>";

 
     $consulta = "SELECT per.iPersona_fl,cat.iCategoriaA_id,det.sAP_valor,ap.iTipoF_id,cat.ICategoriaA_nombre FROM atributo_persona ap inner join detalle_atributo_persona det on det.iAP_id = ap.iAP_id inner join persona per on per.iPersona_id=det.iPersona_id inner join categoria_atributo cat on cat.iCategoriaA_id=ap.iCategoriaA_id where per.iPersona_id=149 order by cat.iCategoriaA_id";
$resultado= $db->query($consulta);  

while($fila = $resultado->fetch_assoc()) 
{

    if($fila['iCategoriaA_id']==$fil['iCategoriaA_id'])
    {   

        if($fila['iTipoF_id']==9&&$fila['sValor_value']==NULL)
        {
            
        }
        else
        {


            if($fila['iTipoF_id']==9)
            {
            echo "<tr >";
            echo " <td>".$fila['sAtributo_nm']."</td><td>".'<img src="../../'. $fila['sValor_value'] .'" width="80" height=80>'."</td>"; 
            echo "</tr>";
            }
            else
            {
                if($fila['iTipoF_id']!=9&&$fila['sValor_value']!=NULL)
                    {

                    echo "<tr>";
                    echo " <td>".$fila['sAtributo_nm']."</td><td>".$fila['sValor_value']."</td>"; 
                     echo "</tr>";
          
                     }
                     else
                        {
                            // echo "<tr>";
                            //  echo " <td >".$fila['sAtributo_nm']."</td><td> &#160;  </td>"; 
                            // echo "</tr>";
                           
                        }
           
            }
        }

    }
    else
    {   
            
    }
}


    
   
   echo "</table>";
   echo "</td>";
    echo "</tr>";
echo "</table>"; 

}

?>
 




                
     
    
</page>
<?php
    $content = ob_get_clean();
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3); 
        $html2pdf->pdf->SetDisplayMode('fullpage'); 
        $html2pdf->writeHTML($content);
        $html2pdf->Output('calificaciones.pdf'); 
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>


