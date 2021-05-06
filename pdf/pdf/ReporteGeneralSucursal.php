<?php
ob_start();
require_once "../../clases/reportes.php";
$iReporte = new Reportes();


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

#tabla {
    
    border-collapse: collapse;
    width: 100%;
}

#tabla td, #tabla th {
    border: 1px solid #ddd;
    padding: 8px;
    width: 15px;
}

#tabla tr:nth-child(even){background-color: #f2f2f2;}

#tabla tr:hover {background-color: #ddd;}

#tabla th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
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


        $gestion=$_POST['fecha1'];
 
        $oficina=$_POST['ddOficina'];
        if($gestion=="")
        {
            
                $contenidomostrar='A lo largo de la historia';
           
        }
        else
        {
            
                $contenidomostrar='De la gestión '.$gestion;
           

        }  

        echo '<div col_2>';
    echo '<img src="../../images/fgym.jpg" width="150" align="right">'.'<H1>Reporte General de Reservas</H1><br>
    <H3>Cantidad de Reservas</H3><br>'.$contenidomostrar;
echo '</div><br><br>';
    
echo '<table id="tabla" width="">
                                        <thead class="cf">
                                            <tr>
                                                <th class="numeric" width="50%">Sucursal</th>
                                                <th>ENE</th>
                                               <th>FEB</th>
                                                <th>MAR</th>
                                                <th>ABR</th>
                                                <th>MAY</th>
                                                <th>JUN</th>
                                                <th>JUL</th>
                                                <th>AGO</th>
                                                <th>SEP</th>
                                                <th>OCT</th>
                                                <th>NOV</th>
                                                <th>DIC</th>
                                                <th width="50%">TOTAL</th>

                                            </tr>                      
                                        </thead>
                                        <tbody>';


        $listaSucursal=$iReporte->DetallexSucursal($oficina,$gestion);
    $listaSucursal->MoveFirst();
    $contador=0;
    while (! $listaSucursal->EndOfSeek()) {    
        $row = $listaSucursal->Row();
        echo "<tr>";
        echo "<td data-title='CI/NIT'>".$row->sucursal."</td>";
       echo "<td data-title='CI/NIT'>".$row->ENE."</td>";
       echo "<td data-title='CI/NIT'>".$row->FEB."</td>";
       echo "<td data-title='CI/NIT'>".$row->MAR."</td>";
       echo "<td data-title='CI/NIT'>".$row->ABR."</td>";
       echo "<td data-title='CI/NIT'>".$row->MAY."</td>";
       echo "<td data-title='CI/NIT'>".$row->JUN."</td>";
       echo "<td data-title='CI/NIT'>".$row->JUL."</td>";
       echo "<td data-title='CI/NIT'>".$row->AGO."</td>";
       echo "<td data-title='CI/NIT'>".$row->SEP."</td>";
       echo "<td data-title='CI/NIT'>".$row->OCT."</td>";
       echo "<td data-title='CI/NIT'>".$row->NOV."</td>";
       echo "<td data-title='CI/NIT'>".$row->DIC."</td>";
       echo "<td data-title='CI/NIT'>".($row->ENE+$row->FEB+$row->MAR+$row->ABR+$row->MAY+$row->JUN+$row->JUL+$row->AGO+$row->SEP+$row->OCT+$row->NOV+$row->DIC)."</td>";
        
        echo "</tr>";
        $contador +=($row->ENE+$row->FEB+$row->MAR+$row->ABR+$row->MAY+$row->JUN+$row->JUL+$row->AGO+$row->SEP+$row->OCT+$row->NOV+$row->DIC);
    }
    echo '<tr><td colspan="13"> Total Reservas:</td><td>'.$contador.'</td></tr>';

    echo '</tbody></table>';


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
