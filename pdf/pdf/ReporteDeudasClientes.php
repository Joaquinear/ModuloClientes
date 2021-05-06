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
 
        




             
        
        <?php 


        $fechaini=$_POST['fecha1'];
        $fechafin=$_POST['fecha2'];
        $oficina=$_POST['ddOficina'];  
        if($fechaini=="")
        {
            if($fechafin=="")
            {
                $contenidomostrar='A lo largo de la historia';
            }
            else
            {
                $contenidomostrar='Hasta la fecha de '.$fechafin;
            }
        }
        else
        {
            if($fechafin=="")
            {
                $contenidomostrar='Desde la fecha de '.$fechaini;
            }
            else
            {
                    $contenidomostrar='Entre el '.$fechaini.' Y '.$fechafin.''; 
            }

        }


        echo '<div>';
    echo '<img src="../../images/fgym.jpg" width="150" align="right">'.'<H1>Reporte General de Mensualidades con pago pendiente</H1><br>
    <H3>Clientes que sen han inscrito</H3><br>'.$contenidomostrar;
    echo '</div><br><br>';

    echo '<div class="col-md-12">';
echo '<table id="tabla">
                                        <thead class="cf">
                                            <tr>
                                                <th class="numeric">Nro</th>
                                                <th>Nombre</th>
                                               <th>Fecha de ultimo Pago</th>
                                                <th>Total</th>
   
                                            </tr>
                                            
                                        </thead>
                                        <tbody>';


        $listaMensualidad=$iReporte->DetalleDeudasClientes($oficina,$fechaini,$fechafin);
    $listaMensualidad->MoveFirst();
    $contador=0;
    while (! $listaMensualidad->EndOfSeek()) {    
        $row = $listaMensualidad->Row();
        echo "<tr>";
        echo "<td class='numeric' data-title='Nro'>".$row->codMensualidad."</td>";
        echo "<td data-title='Nombre'>".$row->nombrecompleto."</td>";
        echo "<td data-title='CI/NIT'>".$row->fechaPago."</td>";
        echo "<td data-title='Teléfono'>".$row->total."</td>";
   
        // 
        
       
        // echo "<td data-title='Total Bs' class='der'>".number_format($row->total,0,".",",")."</td>";
     
        echo "</tr>";
        $contador= $contador + $row->total;
    }
    echo '<tr><td colspan="3"> Total de Pagos:</td><td>'.$contador.'</td></tr>';

    echo '</tbody></table></div>';


        ?>    



</page>

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
