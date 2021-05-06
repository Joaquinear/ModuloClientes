<?php 
include "../template/s_sesion.php";
include "../clases/reportes.php";
$gestion= @$_GET['ges'];
$tip=@$_GET['tip'];
?>

<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

 
<script src="src/Chart.js"></script>
<script src="src/Chart.min.js"></script>
<style type="text/css">
  
.pie-legend ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

    .pie-legend span {
        display: inline-block;
        width: 14px;
        height: 14px;
        border-radius: 100%;
        margin-right: 16px;
        margin-bottom: -2px;
    }

    .pie-legend li {
        margin-bottom: 10px;
        display: inline-block;
        margin-right: 10px;
    }

canvas {
    width: 100% !important;
    height: auto !important;
}

.table {
    border: 1px solid red;
    display: table;
    width: 100%;
    table-layout: fixed;
}

.cell {
    display: table-cell;
    vertical-align: middle;
}


</style>

  <?php include_once "../template/s_incluir.php"; 
// $VariableNPS=$tool->GenerarNpxLocal($test);
// $NPSTOTAL= $tool->GenerarNps();
  $iParametro = new parametros();
  $tool = new Reportes();
  ?>


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<?php
    $menu="rep";
    include_once "../template/s_encabezado.php"; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-2x fa-calendar"></i> SPC</a></li>
        <li class="active">Dashboard</li>
      </ol><h1>Dashboard<small>Análisis de Prospectos</small>
      </h1>


    </section>
<section class="content">
    <div class="row" style="text-align: center;">
      <div class="col-md-4"></div>
      <div class="col-md-4" style="text-align: center;">
      <div class="col-md-12 col-sm-12 col-xs-12">
                        
                        <!-- /.info-box -->
                    </div>

                    </div>
                    <div class="col-md-4"></div>

    </div>

  <br>


                         

                                 
<div class="row">
  <div class="col-md-12">
    <div class="box box-Gray">
       <div class="box-body">
         <div class="col-md-4">
          <label>Gestión</label>
                               
                          <select class="form-control col-md-9" id="ddgestion" onchange="Actualizar();" style="width: 100%;">
                          <option class="2019">2018</option>
                          <option class="2019">2019</option>
                          <option class="2020">2020</option>

                          </select>  
    </div>

    <div class="col-md-4">
           <label>Tipo de Encuesta</label>
                               
                          <select class="form-control col-md-9" id="ddencuesta" onchange="Actualizar();" style="width: 100%;">
                          <?php $iParametro->DropDownTipoEncuesta($_GET['tip']); ?>  

                          </select>  
    </div>

       </div>
    </div>
 

   
  </div>
</div>
       
                     




 
<div class="col-md-6 col-xs-12">
          <div class="box box-Gray">
                        <div class="box-header with-border">
                          <h3 class="box-title">Total reservas por sucursal</h3>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                               <div class="box-body">
                                 <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="info-box bg-white">
                            <span class="info-box-icon bg-gray"><i class="ion ion-ios-people-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Reservas</span> 
                               
                                <span class="info-box-number"><div id="contenedorReserva"></div></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        </div>
                   
                  
                    </div>
                    <center>
                         <div class="row" style="width:100%;margin-bottom:1em ">
                        <canvas id="charSucursal" ></canvas>
                        </div>
                        </center>
                    </div>
                  </div>
            <!-- /.box-body -->
          </div>

  <div class="col-md-6 col-xs-12">
          <div class="box box-Gray">
                        <div class="box-header with-border">
                          <h3 class="box-title">Resultado de encuestas</h3>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                               <div class="box-body">
                                 <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="info-box bg-white">
                            <span class="info-box-icon bg-gray"><i class="ion ion-ios-people-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Encuestas</span> 
                               
                                <span class="info-box-number"><div id="contenedorEncuesta"></div></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        </div>

                               
                      
                   
                  
                    </div>
                    <center>
                         <div class="row" style="width:100%;margin-bottom:1em ">
                        <canvas id="charEncuesta" ></canvas>
                        </div>
                        </center>
                    </div>
                  </div>
            <!-- /.box-body -->
          </div>        




  





       
      
    
 </section>
<script type="text/javascript">

$(function(){
    

    graficaSucursal();
    graficaEncuesta();
    
});


   


</script>



<script>


  


 




function graficaSucursal()
 {


var ctx = document.getElementById('charSucursal').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
      labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],

      datasets: [
      <?php
      $totalReservas="";
       $sucursales= $iParametro->TraerSucursales();
       $sucursales->MoveFirst();
       for($i=0;$i<$sucursales->RowCount();$i++)
       {
        if ($i==0) {
          $elcolor='81b5d4';  
        }
        if ($i==1) {
          $elcolor='5ad6f5';  
        }
        if ($i==2) {
          $elcolor='f56954';  
        }
        if ($i==3) {
          $elcolor='f7bf66';  
        }
        if ($i==4) {
          $elcolor='e98a7f';  
        }
        if ($i==5) {
          $elcolor='f56954';  
        }
        if ($i==6) {
          $elcolor='5a6e83';  
        }
        if ($i==7) {
          $elcolor='7fdede';  
        }
        if ($i==8) {
          $elcolor='111111';  
        }
        if ($i==9) {
          $elcolor='ff851b';  
        }
        if ($i==10) {
          $elcolor='957ca5';  
        }
        if ($i==11) {
          $elcolor='001f3f';  
        }
        

        $laSuc=$sucursales->Row($i);
      ?>
                      {
                        label: "<?php echo $laSuc->nombre; ?>",
                        backgroundColor: "#<?php echo $elcolor; ?>",
                        data: [
            <?php  
        $listado = $tool->totalxSucursal($laSuc->codSucursal,$_GET['ges']);
        $listado->MoveFirst();
        $contador=0;
       
         
          $fila=$listado->Row();
          echo $fila->ENE.','.$fila->FEB.','.$fila->MAR.','.$fila->ABR.','.$fila->MAY.','.$fila->JUN.','.$fila->JUL.','.$fila->AGO.','.$fila->SEP.','.$fila->OCT.','.$fila->NOV.','.$fila->DIC;
          $totalReservas += $fila->ENE+$fila->FEB+$fila->MAR+$fila->ABR+$fila->MAY+$fila->JUN+$fila->JUL+$fila->AGO+$fila->SEP+$fila->OCT+$fila->NOV+$fila->DIC;
        
        ?>

            ]
                      }<?php 
                      if ($i == ($sucursales->RowCount()-1)) 
                        { 
                          echo ''; 
                        }
                        else{
                         echo ',';  
                        } 
                      ?>
  <?php } ?>
      ]
    }


});


$('#contenedorReserva').html(<?php echo $totalReservas; ?>)

}




function graficaEncuesta()
 {


var ctx = document.getElementById('charEncuesta').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
      labels: ["MUY MALO", "MALO", "REGULAR", "BUENO", "MUY BUENO"],

      datasets: [
     
                      {
                        label: "TOTAL",
                        backgroundColor: ["#FFFF00", "#FF6C00","#05AD00","#000DAD","#FF0000","#660066","#996600","#40681E","#28B075","#969696"],
                        data: [
            <?php  
        $listado = $tool->ListaEncuestas($_GET['tip'],$_GET['ges']);
        $listado->MoveFirst();
        $contador=0;
       for($i=0;$i<$listado->RowCount();$i++)
         
          $fila=$listado->Row($i);
          echo $fila->muymalo.','.$fila->malo.','.$fila->regular.','.$fila->bueno.','.$fila->muybueno;
         $totalEncuestas += ($fila->muymalo+$fila->malo+$fila->regular+$fila->bueno+$fila->muybueno);
        ?>

            ]
            }
      ]
    },

    options: {
          legend: {
            display: false
          },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }


});


$('#contenedorEncuesta').html(<?php echo $totalEncuestas; ?>)

}


$( document ).ready(function() {
    $('#ddgestion').val('<?php echo $_GET["ges"] ?>');
});



function Actualizar()
{
  var gestion = $('#ddgestion').val();
  var tipo = $('#ddencuesta').val();
  window.location.replace("dash.php?ges="+gestion+"&tip="+tipo+"");
}

</script>




<?php include_once "../template/s_piepagina.php"; ?>
    <?php include_once "../template/s_global.php"; ?>
    
 </body>

</head>
</html>
