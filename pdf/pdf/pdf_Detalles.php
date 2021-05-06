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
 
        
     <page_footer> 
        <table id="footer">
            <tr class="fila">
                <td>
                    <?php
					echo "Fecha Documento: ".date('d/m/Y'); 
					?>
                </td>
            </tr>
        </table>
    </page_footer>  
	
<?php
$id=$_GET["id"];




$db = new mysqli("localhost", "phpmyadmin", "Pw4Sqlgrt2011", "mainter.crm");
$c="SELECT c.iCuenta_id, p.sPersona_n as Nombre,p.sPersona_app as AppTitular,p.sPersona_apm as ApmTitular, 
v.sPersona_n as Vendedor,v.sPersona_app as AppVendedor, p.dtPersona_bday,
p.sPersona_photo, p.iPersona_fl, c.sCuenta_CCrediticia, c.sCuenta_CCompra, c.sCuenta_codigo
FROM cuenta AS c, persona p, persona v
WHERE c.iCuenta_id = '$id' and c.iPersona_id=p.iPersona_id and c.iVendedor_id=v.iPersona_id"; 
$r=$db->query($c);


while ($f=$r->fetch_assoc())
{

if($f['iPersona_fl']==1)
{
	echo '<div col_2>';
	echo '<img src="../../public/images/logo.png" width="150" align="right">'.'<H1>Formulario Persona</H1>';
	echo '</div>';
	
    if($f['sPersona_photo']!=NULL)
{
    echo "<table width='600'  border='1' cellspacing='0' cellpadding='1' bordercolor='#000000'>";
    echo "<tr>";
    echo "<td>";
   echo" <table width='600' border='0' cellspacing='0' cellpadding='0' >";
   echo "<tr>";
   echo "<td width='200'></td><td width=' 450' align='right'>Informacion Basica</td>";
   echo "</tr>";
    echo "<tr>";
   echo "<td width='200'>Foto de Perfil</td><td width=' 450' align='left'>".'<img src="../../'. $f['sPersona_photo'] .'" width="80" height=80>'."</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td width='200'>Titular de la Cuenta:</td><td width=' 450' align='left'>".$f['Nombre']." ".$f['AppTitular']." ".$f['ApmTitular']."</td>";
     echo "</tr>";
     if($f['Vendedor']!=NULL)
        {
            echo "<tr>";
        echo "<td width='200'>Vendedor Asignado:</td><td width=' 450' align='left'>".$f['Vendedor']." ".$f['AppVendedor']."</td>";
        echo "</tr>";
        }
        else{}
     if($f['sCuenta_CCrediticia']!=NULL)
        {
           
           echo "<tr>";
        echo "<td width='200'>Calificación Crediticia:</td><td width=' 450' align='left'>".$f['sCuenta_CCrediticia']."</td>";
           echo "</tr>";
       }
	   else{}
	    if($f['sCuenta_CCompra']!=NULL)
        {
           
           echo "<tr>";
        echo "<td width='200'>Capacidad Compra:</td><td width=' 450' align='left'>".$f['sCuenta_CCompra']."</td>";
           echo "</tr>";
       }
	   else{}
     echo "</table>";
     echo "</td>";
     echo "</tr>";
     echo "</table>";

}
else
{
	 echo "<table width='600'  border='1' cellspacing='0' cellpadding='1' bordercolor='#000000'>";
    echo "<tr>";
    echo "<td>";
   echo" <table width='600' border='0' cellspacing='0' cellpadding='0' >";
   echo "<tr>";
   echo "<td width='200'></td><td width=' 450' align='right'>Informacion Basica</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td width='200'>Foto de Perfil</td><td width=' 450' align='left'>No tiene Foto de Perfil</td>";
   echo "</tr>";
   echo "<tr>";
    echo "<td width='200'>Titular de la Cuenta:</td><td width=' 450' align='left'>".$f['Nombre']." ".$f['AppTitular']." ".$f['ApmTitular']."</td>";
     echo "</tr>";
    if($f['Vendedor']!=NULL)
        {
            echo "<tr>";
        echo "<td width='200'>Vendedor Asignado:</td><td width=' 450' align='left'>".$f['Vendedor']." ".$f['AppVendedor']."</td>";
        echo "</tr>";
        }
        else{}
     if($f['sCuenta_CCrediticia']!=NULL)
        {
           
           echo "<tr>";
        echo "<td width='200'>Calificación Crediticia:</td><td width=' 450' align='left'>".$f['sCuenta_CCrediticia']."</td>";
           echo "</tr>";
       }
	   else{}
	    if($f['sCuenta_CCompra']!=NULL)
        {
           
           echo "<tr>";
        echo "<td width='200'>Capacidad Compra:</td><td width=' 450' align='left'>".$f['sCuenta_CCompra']."</td>";
           echo "</tr>";
       }
	   else{}
     echo "</table>";
     echo "</td>";
     echo "</tr>";
     echo "</table>";

}


}

else
{
    echo '<div col_2>';
	echo '<img src="../../public/images/logo.png" width="150" align="right">'.'<H1>Formulario Empresa</H1>';
	echo '</div>';
	
    if($f['sPersona_photo']!=NULL)
{
    echo "<table width='600'  border='1' cellspacing='0' cellpadding='1' bordercolor='#000000'>";
    echo "<tr>";
    echo "<td>";
   echo" <table width='600' border='0' cellspacing='0' cellpadding='0' >";
   echo "<tr>";
   echo "<td width='200'></td><td width=' 450' align='right'>Informacion Basica</td>";
   echo "</tr>";
    echo "<tr>";
   echo "<td width='200'>Foto de Perfil</td><td width=' 450' align='left'>".'<img src="../../'. $f['sPersona_photo'] .'" width="80" height=80>'."</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td width='200'>Titular de la Cuenta:</td><td width=' 450' align='left'>".$f['Nombre']."</td>";
     echo "</tr>";
	      if($f['Vendedor']!=NULL)
        {
            echo "<tr>";
        echo "<td width='200'>Vendedor Asignado:</td><td width=' 450' align='left'>".$f['Vendedor']." ".$f['AppVendedor']."</td>";
        echo "</tr>";
        }
        else{}
     if($f['sCuenta_CCrediticia']!=NULL)
        {
           
           echo "<tr>";
        echo "<td width='200'>Calificación Crediticia:</td><td width=' 450' align='left'>".$f['sCuenta_CCrediticia']."</td>";
           echo "</tr>";
       }
	   else{}
	    if($f['sCuenta_CCompra']!=NULL)
        {
           
           echo "<tr>";
        echo "<td width='200'>Capacidad Compra:</td><td width=' 450' align='left'>".$f['sCuenta_CCompra']."</td>";
           echo "</tr>";
       }
	   else{}
     echo "</table>";
     echo "</td>";
     echo "</tr>";
     echo "</table>";

}
else
{
	echo "<table width='600'  border='1' cellspacing='0' cellpadding='1' bordercolor='#000000'>";
    echo "<tr>";
    echo "<td>";
   echo" <table width='600' border='0' cellspacing='0' cellpadding='0' >";
   echo "<tr>";
   echo "<td width='200'></td><td width=' 450' align='right'>Informacion Basica</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td width='200'>Foto de Perfil</td><td width=' 450' align='left'>No tiene Foto de Perfil</td>";
   echo "</tr>";
    echo "<tr>";
   echo "<td width='200'>Titular de la Cuenta:</td><td width=' 450' align='left'>".$f['Nombre']."</td>";
     echo "</tr>";
	      if($f['Vendedor']!=NULL)
        {
            echo "<tr>";
        echo "<td width='200'>Vendedor Asignado:</td><td width=' 450' align='left'>".$f['Vendedor']." ".$f['AppVendedor']."</td>";
        echo "</tr>";
        }
        else{}
     if($f['sCuenta_CCrediticia']!=NULL)
        {
           
           echo "<tr>";
        echo "<td width='200'>Calificación Crediticia:</td><td width=' 450' align='left'>".$f['sCuenta_CCrediticia']."</td>";
           echo "</tr>";
       }
	   else{}
	    if($f['sCuenta_CCompra']!=NULL)
        {
           
           echo "<tr>";
        echo "<td width='200'>Capacidad Compra:</td><td width=' 450' align='left'>".$f['sCuenta_CCompra']."</td>";
           echo "</tr>";
       }
	   else{}
     echo "</table>";
     echo "</td>";
     echo "</tr>";
     echo "</table>";

}
	
}


}


$cx="select per.iPersona_fl 
FROM atributo_cuenta ap 
inner join detalle_atributo_cuenta det on det.iAC_id = ap.iAC_id 
INNER JOIN cuenta c on c.iCuenta_id= det.iCuenta_id
inner join persona per on per.iPersona_id=c.iPersona_id 
inner join categoria_atributo cat on cat.iCategoriaA_id= ap.iCategoriaA_id 
where per.iPersona_id=c.iPersona_id and c.iCuenta_id='$id' group by per.iPersona_fl";
$result= $db->query($cx);
$Row = mysqli_fetch_assoc($result);
$Tipo= $Row['iPersona_fl'];


$cons="SELECT c.iCuenta_id, per.iPersona_fl,cat.iCategoriaA_id,det.sAC_valor,ap.iTipoF_id,cat.ICategoriaA_nombre 
FROM atributo_cuenta ap 
inner join detalle_atributo_cuenta det on det.iAC_id = ap.iAC_id 
INNER JOIN cuenta c on c.iCuenta_id=det.iCuenta_id
inner join persona per on per.iPersona_id=c.iPersona_id 
inner join categoria_atributo cat on cat.iCategoriaA_id=ap.iCategoriaA_id
where c.iCuenta_id='$id' 
group by cat.iCategoriaA_id order by cat.iCategoriaA_id";
$res= $db->query($cons);

if ($Tipo ==1)
{
	while($fil=$res->fetch_assoc())
    {
		 echo "<table width='600'  border='1' cellspacing='0' cellpadding='1' bordercolor='#000000'>";
    echo "<tr>";
    echo "<td>";
	echo" <table width='600' border='0' cellspacing='0' cellpadding='0' >";
	echo "<tr>";
	echo "<td width='200'></td><td width=' 450' align='right'>".$fil['ICategoriaA_nombre']."</td>";
	echo "</tr>";
	
	 $consulta = "SELECT per.iPersona_fl,cat.iCategoriaA_id,ap.sAC_nombre,det.sAC_valor,ap.iTipoF_id,cat.ICategoriaA_nombre 
FROM atributo_cuenta ap 
inner join detalle_atributo_cuenta det on det.iAC_id = ap.iAC_id
INNER JOIN cuenta c on c.iCuenta_id=det.iCuenta_id
inner join persona per on per.iPersona_id=c.iPersona_id 
inner join categoria_atributo cat on cat.iCategoriaA_id=ap.iCategoriaA_id 
where c.iCuenta_id='$id' order by cat.iCategoriaA_id";
     $resultado= $db->query($consulta);  
  
	 while($fila = $resultado->fetch_assoc()) 
		{
			
			if($fila['iCategoriaA_id']==$fil['iCategoriaA_id'])
			{ 
				
					 if($fila['iTipoF_id']==4)
                { 
			        
                     $cp="select sPersona_n,sPersona_app,sPersona_apm from persona where iPersona_id=".$fila['sAC_valor']."";
                     $rp= $db->query($cp);
                     $Rowp = mysqli_fetch_assoc($rp);
                     $Persona= $Rowp['sPersona_n']." ".$Rowp['sPersona_app']." ".$Rowp['sPersona_apm'];
                     echo "<tr>";
                    echo " <td>".$fila['sAC_nombre']."</td><td width=' 450'>".$Persona."</td>"; 
                     echo "</tr>";

                }
				else {
					if(($fila['iTipoF_id']==3)){
						 $cp="select sEAC_valor from espesificacion_atributo_cuenta where iEAC_id=".$fila['sAC_valor']."";
                     $rp= $db->query($cp);
                     $Rowp = mysqli_fetch_assoc($rp);
                     $valor= $Rowp['sEAC_valor'];
                    echo "<tr>";
                    echo " <td>".$fila['sAC_nombre']."</td><td width=' 450'>".$fila['sAC_valor']."</td>"; 
                     echo "</tr>";
					}
					else{
						if($fila['iTipoF_id']==5)
                { 
			        
                     $cp="select sPersona_n,sPersona_app,sPersona_apm from persona where iPersona_id=".$fila['sAC_valor']."";
                     $rp= $db->query($cp);
                     $Rowp = mysqli_fetch_assoc($rp);
                     $Persona= $Rowp['sPersona_n']." ".$Rowp['sPersona_app']." ".$Rowp['sPersona_apm'];
                     echo "<tr>";
                    echo " <td>".$fila['sAC_nombre']."</td><td width=' 450'>".$Persona."</td>"; 
                     echo "</tr>";

                }
				else
				{
					 if($fila['iTipoF_id']==2)
                {
                    $cp="select sEAC_valor from espesificacion_atributo_persona where iAC_id=".$fila['sAC_valor']."";
                     $rp= $db->query($cp);
                     $Rowp = mysqli_fetch_assoc($rp);
                     $valor= $Rowp['sEAC_valor'];
                    echo "<tr>";
                    echo " <td>".$fila['sAC_nombre']."</td><td width=' 450'>".$valor."</td>"; 
                     echo "</tr>";

                } 
				else
				{
					 if($fila['iTipoF_id']==9&&$fila['sAP_valor']==NULL)
        {
            
        }
        else
        {


            if($fila['iTipoF_id']==9)
            {
               
                
            echo "<tr >";
            echo " <td>".$fila['sAC_nombre']."</td><td width=' 450'>". $fila['sAC_valor']."</td>"; 
            echo "</tr>";
                
            
		    }
		               }
				   }
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
}
else{
while($fil=$res->fetch_assoc())
    {
		 echo "<table width='600'  border='1' cellspacing='0' cellpadding='1' bordercolor='#000000'>";
    echo "<tr>";
    echo "<td>";
	echo" <table width='600' border='0' cellspacing='0' cellpadding='0' >";
	echo "<tr>";
	echo "<td width='200'></td><td width=' 450' align='right'>".$fil['ICategoriaA_nombre']."</td>";
	echo "</tr>";
	
	 $consulta = "SELECT per.iPersona_fl,cat.iCategoriaA_id,ap.sAC_nombre,det.sAC_valor,ap.iTipoF_id,cat.ICategoriaA_nombre 
FROM atributo_cuenta ap 
inner join detalle_atributo_cuenta det on det.iAC_id = ap.iAC_id
INNER JOIN cuenta c on c.iCuenta_id=det.iCuenta_id
inner join persona per on per.iPersona_id=c.iPersona_id 
inner join categoria_atributo cat on cat.iCategoriaA_id=ap.iCategoriaA_id 
where c.iCuenta_id='$id' order by cat.iCategoriaA_id";
     $resultado= $db->query($consulta);  
  
	 while($fila = $resultado->fetch_assoc()) 
		{
			
			if($fila['iCategoriaA_id']==$fil['iCategoriaA_id'])
			{ 
				
					 if($fila['iTipoF_id']==4)
                { 
			        
                     $cp="select sPersona_n,sPersona_app,sPersona_apm from persona where iPersona_id=".$fila['sAC_valor']."";
                     $rp= $db->query($cp);
                     $Rowp = mysqli_fetch_assoc($rp);
                     $Persona= $Rowp['sPersona_n']." ".$Rowp['sPersona_app']." ".$Rowp['sPersona_apm'];
                     echo "<tr>";
                    echo " <td>".$fila['sAC_nombre']."</td><td width=' 450'>".$Persona."</td>"; 
                     echo "</tr>";

                }
				else {
					if(($fila['iTipoF_id']==3)){
						 $cp="select sEAC_valor from espesificacion_atributo_cuenta where iEAC_id=".$fila['sAC_valor']."";
                     $rp= $db->query($cp);
                     $Rowp = mysqli_fetch_assoc($rp);
                     $valor= $Rowp['sEAC_valor'];
                    echo "<tr>";
                    echo " <td>".$fila['sAC_nombre']."</td><td width=' 450'>".$fila['sAC_valor']."</td>"; 
                     echo "</tr>";
					}
					else{
						if($fila['iTipoF_id']==5)
                { 
			        
                     $cp="select sPersona_n,sPersona_app,sPersona_apm from persona where iPersona_id=".$fila['sAC_valor']."";
                     $rp= $db->query($cp);
                     $Rowp = mysqli_fetch_assoc($rp);
                     $Persona= $Rowp['sPersona_n']." ".$Rowp['sPersona_app']." ".$Rowp['sPersona_apm'];
                     echo "<tr>";
                    echo " <td>".$fila['sAC_nombre']."</td><td width=' 450'>".$Persona."</td>"; 
                     echo "</tr>";

                }
				else
				{
					 if($fila['iTipoF_id']==2)
                {
                    $cp="select sEAC_valor from espesificacion_atributo_persona where iAC_id=".$fila['sAC_valor']."";
                     $rp= $db->query($cp);
                     $Rowp = mysqli_fetch_assoc($rp);
                     $valor= $Rowp['sEAC_valor'];
                    echo "<tr>";
                    echo " <td>".$fila['sAC_nombre']."</td><td width=' 450'>".$valor."</td>"; 
                     echo "</tr>";

                } 
				else
				{
					 if($fila['iTipoF_id']==9&&$fila['sAP_valor']==NULL)
        {
            
        }
        else
        {


            if($fila['iTipoF_id']==9)
            {
               
                
            echo "<tr >";
            echo " <td>".$fila['sAC_nombre']."</td><td width=' 450'>". $fila['sAC_valor']."</td>"; 
            echo "</tr>";
                
            
		    }
		               }
				   }
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