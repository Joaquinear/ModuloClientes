<?php
ob_start();
require_once "../../clases/reportes.php";
$iReporte = new Reportes();
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    date_default_timezone_set("America/La_Paz");
   
 
    $content = ob_get_clean();
    // contenido *************************************************************
    // $codCot=$_POST["hcodcotizacionpdf"];
    // $codProspecto=$_POST["hcodprosppdf"];
    // $cod=$codProspecto;

    


   

    $iReporte = new Reportes();



    $content.='<page backtop="0mm" backbottom="10mm" backleft="10mm" backright="10mm">';
    // HEADER *****************************************************************

    // FOOTER *****************************************************************
    $content.='<page_footer><table style="width: 100%;">';
    $content.='<tr>';
    $content.='<td class="footer" style="text-align: center; width: 100%" >';
    $content.='</td>';
    $content.='</tr>';
    $content.='<tr>';
    $content.='<td  style="text-align: right; font-size:11px; width: 100%" >página [[page_cu]] de [[page_nb]]</td>';
    $content.='</tr>';
    $content.='</table>';
    $content.='</page_footer>';
    //***************************************************************************
    //  Fecha y titulo del documento
    //***************************************************************************


    $content.='
    <table class="tablapeque" style="font-size:7px; width:100%">

            <tr>
                <th style="width:5%; border:solid 1px #000" class="cen">#</th>
                <th style="width:20%; border:solid 1px #000" class="cen">Trabajador</th>
                <th style="width:19%; border:solid 1px #000" class="cen">Cantidad Vendida</th>
                <th style="width:8%; border:solid 1px #000" class="cen">plan de pago</th>
                <th style="width:8%; border:solid 1px #000" class="cen">Mes</th>
            </tr>   ';

        if ($_POST) {
        	$resultado = $iReporte->traerlotesxVendedor($_POST['ddmes'], $_POST['planpago']);
        } 
        $resultado->MoveFirst();
      
        $i=1;
        

        while (! $resultado->EndOfSeek()) {
       
			$fila = $resultado->Row();

                $content.= "<tr>";
                $content.= "<td style='width:5%; border:solid 1px #000' class='cen'>".$i."</td>";
                $content.= "<td style='width:20%; border:solid 1px #000' class='cen'>".$fila->nombre_completo."</td>";
                $content.= "<td style='width:19%; border:solid 1px #000' class='cen'>".$fila->Cantidad_vendidos."</td>";
                $content.= "<td style='width:8%; border:solid 1px #000' class='cen'>".$fila->tipoPago."</td>";
            



                $content.= "</tr>";

               
$i++;
        }
        $content.='</table></page>';


$year = date('Y');
    // convert to PDF
 
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
