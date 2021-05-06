<?php 
require_once('../MPDF/vendor/autoload.php'); //instancio al vendor para traer todos las librerias de composer descargada
//require_once('../examples/prueba.php');
require_once "../clases/reportes.php";
$iReporte = new Reportes();
$mpdf = new \Mpdf\Mpdf([
    ]);
    error_reporting(0);

//estilos para paginacion
// $mpdf = new \Mpdf\Mpdf([
//     'pagenumPrefix' => ' Pagina ',
//     'pagenumSuffix' => ' - ',
//     'nbpgPrefix' => ' de ',
//     'nbpgSuffix' => ' paginas'
// ]);

//$mpdf->Setfooter('{PAGENO}{nbpg}'); //paginacion numero
//$mpdf->SetHeader('{PAGENO}{nbpg}'); // en el header numero

//fin paginacion

//$css = file_get_contents('../dist/css/style-dgpc.css');  //traigo el css
//$css2 = file_get_contents('../dist/css/notables.css');  //traigo el css

//$variable = Plantilla(); //trae la funcion que tiene contenido html

$content = ob_get_clean();


$content.='<div style="text-align:center;"> 
<h1> reporte ventas por vendedor </h1></div>
    <table style="font-size:7px;width:100%;">
            <tr>
                <th style="width:5%; border:solid 1px #000;">#</th>
                <th style="width:20%; border:solid 1px #000;">Trabajador</th>
                <th style="width:19%; border:solid 1px #000;">Cantidad Vendida</th>
                <th style="width:8%; border:solid 1px #000;">plan de pago</th>
                <th style="width:8%; border:solid 1px #000;">Mes</th>
            </tr>';
        	$resultado = $iReporte->traerlotesxVendedor(@$_POST['ddmes'], @$_POST['planpago']);
        $resultado->MoveFirst();
        $i=1;
        while (! $resultado->EndOfSeek()) 
        {
			$fila = $resultado->Row();
                $content.= "<tr>";
                $content.= "<td style='width:5%;border:solid 1px #000;'>".$i."</td>";
                $content.= "<td style='width:20%;border:solid 1px #000;'>".$fila->nombre_completo."</td>";
                $content.= "<td style='width:19%;border:solid 1px #000;'>".$fila->Cantidad_vendidos."</td>";
                $content.= "<td style='width:8%;border:solid 1px #000;'>".$fila->tipoPago."</td>";
                $content.="<td style='width:8%;border:solid 1px #000;'>".$fila->mes."</td>";
                $content.= "</tr>";
                 $i++;
        }
        $content.='</table>';


        
            //$mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}{nbpg}</div>'); // le da estilo al footer paginacion

//$mpdf->writeHtml($css,\Mpdf\HTMLParserMode::HEADER_CSS);  //para el css
//$mpdf->writeHtml($css2,\Mpdf\HTMLParserMode::HEADER_CSS);  //para el css
$mpdf->writeHtml($content,\Mpdf\HTMLParserMode::HTML_BODY); // para el cuerpo del pdf


//$mpdf->Output('reporte_'.$cod.'.pdf', 'F'); //guarda a ruta
//$mpdf->Output('reporte_'.$cod.'.pdf', 'D'); //descarga pdf
$mpdf->Output('ventasxvendedores-2021.pdf', 'I'); //solo lectura


?>


