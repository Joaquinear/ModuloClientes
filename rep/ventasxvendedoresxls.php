<?php include "../template/s_sesion.php";
include_once "../clases/reportes.php";
$iReporte = new Reportes();

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/La_Paz');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once '../clases/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("")
							 ->setLastModifiedBy("")
							 ->setTitle("")
							 ->setSubject("")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("Self Service BI");


// Add some data

$i=1;
// Escribo los encabezados
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i, "#")
        ->setCellValue('B'.$i, "Trabajador")
        ->setCellValue('C'.$i, "Cantidad Vendida")
        ->setCellValue('D'.$i, "plan de pago")
        ->setCellValue('E'.$i, "Mes");
      
		
$i = 2;
$i2 = 1;
//*****************************
$datos = $iReporte->traerlotesxVendedor($_POST['ddmes'], $_POST['planpago']);
$datos->MoveFirst();
while (!$datos->EndOfSeek()) 
{
    // Escribo contenido
    $row=$datos->Row();
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i, $i2)
        ->setCellValue('B'.$i, $row->nombre_completo)
        ->setCellValue('C'.$i, $row->Cantidad_vendidos)
        ->setCellValue('D'.$i, $row->tipoPago)
        ->setCellValue('E'.$i, $row->mes);
	$i++;
    $i2++;
    }



// Rename worksheet


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Save Excel 95 file
$callStartTime = microtime(true);
$varn=rand(1,10);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save("./ventasxvendedores".$varn.".xls");
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
header('Location: ./ventasxvendedores'.$varn.'.xls');
?>
			