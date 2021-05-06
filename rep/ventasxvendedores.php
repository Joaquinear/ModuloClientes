<?php include "../template/s_sesion.php";
include_once "../clases/reportes.php";
$iReporte = new Reportes();
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
    <?php include_once "../template/s_incluir.php"; ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

     <script>
   
    function FiltrarDatos() {
        $("#filtrarForm").attr('action', 'ventasxvendedores.php');
        $("#filtrarForm").attr('target', '_self');
        $('#filtrarForm').submit();
    }
    function GeneraXLS() {
        $("#filtrarForm").attr('action', 'ventasxvendedoresxls.php');
        $("#filtrarForm").attr('target', '_blank');
        $("#filtrarForm").submit();
    }
    function GenerarPDF() {
        $("#filtrarForm").attr('action', 'ventasxvendedorespdf.php');
        $("#filtrarForm").attr('target', '_blank');
        $("#filtrarForm").submit();
    }
    </script>

    <style>
        .resaltar th{
            background-color: #222d32;
            background-color: #555;
            color:#ffffff;

        }
        .subtotal th{
            background-color: #337ab7;

            color:#ffffff;

        }
        .subtotal th{
            background-color: #333;

            color:#ffffff;

        }
        .titulo th{
            background-color: #fff;
            font-weight: bold;
            color:#333;

        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">

    <?php
    $menu="rep";
    include_once "../template/s_encabezado.php"; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-2x fa-calendar"></i> REP</a></li>
        <li class="active">Lotes Vendidos por Usuarios</li>
      </ol><h1>Reportes<small>Lotes Vendidos por Usuarios</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

<div class="row">
            <div class="col-xs-12">
                <div> <!--  class="box box-solid" -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Filtros</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form method="POST" id="filtrarForm">
                                <div class="form-horizontal">
                                    <div class="row">
                                       
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="iOficina_id" class="col-sm-3 control-label">Mes</label>
                                                <div class="col-sm-9">
                                                    <select id="ddmes" name="ddmes" class="form-control">
                                                    <option value="0" <?php if($_POST['ddmes']=="0"){echo "selected";} ?>>Todos</option>
                                                      <option value="1" <?php if($_POST['ddmes']=="1"){echo "selected";} ?>>Enero</option>
                                                      <option value="2" <?php if($_POST['ddmes']=="2"){echo "selected";} ?>>Febrero</option>
                                                      <option value="3" <?php if($_POST['ddmes']=="3"){echo "selected";} ?>>Marzo</option>
                                                      <option value="4" <?php if($_POST['ddmes']=="4"){echo "selected";} ?>>Abril</option>
                                                      <option value="5" <?php if($_POST['ddmes']=="5"){echo "selected";} ?>>Mayo</option>
                                                      <option value="6" <?php if($_POST['ddmes']=="6"){echo "selected";} ?>>Junio</option>
                                                      <option value="7" <?php if($_POST['ddmes']=="7"){echo "selected";} ?>>Julio</option>
                                                      <option value="8" <?php if($_POST['ddmes']=="8"){echo "selected";} ?>>Agosto</option>
                                                      <option value="9" <?php if($_POST['ddmes']=="9"){echo "selected";} ?>>Septiembre</option>
                                                      <option value="10" <?php if($_POST['ddmes']=="10"){echo "selected";} ?>>Octubre</option>
                                                      <option value="11" <?php if($_POST['ddmes']=="11"){echo "selected";} ?>>Noviembre</option>
                                                      <option value="12" <?php if($_POST['ddmes']=="12"){echo "selected";} ?>>Diciembre</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Plan Pago</label>
                                                <div class="col-sm-9">
                                                    <select id="planpago" name="planpago" class="form-control">
                                                        <option value="0" <?php if($_POST['planpago']=="0"){echo "selected";} ?>>Todos</option>
                                                        <option value="1" <?php if($_POST['planpago']=="1"){echo "selected";} ?>>Al Contado</option>
                                                        <option value="2" <?php if($_POST['planpago']=="2"){echo "selected";} ?>>Al Credito</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                       


                                
                                    </div>
                                   
                                </div>
                            </form>
                        </div>
                        <div class="box-footer" style="text-align:right">
                            <button type="button" onclick="FiltrarDatos()" class="btn btn-info btncarga" data-loading-text="Cargando...">Filtrar</button>
                            <?php if ($_POST) {
                            ?>
                            <button type="button" onclick="GeneraXLS()" class="btn btn-success btncarga" data-loading-text="Cargando...">XLS</button>
                            <button type="button" onclick="GenerarPDF()" class="btn btn-danger btncarga" data-loading-text="Cargando...">PDF</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header">
                         
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="titulo">
                                        <th>#</th>
                                        <th>Trabajador</th>
                                        <th>Cantidad Vendida</th>
                                         <th> plan de pago</th>
                                         <th>Mes</th>
                                      
                                        
                                      
                                    </tr>
                                </thead>
                <tbody>
<?php
//$resultado = $iReporte->listAllProspectByDates();
if ($_POST) {
    $resultado = $iReporte->traerlotesxVendedor($_POST['ddmes'], $_POST['planpago']);
    if ($resultado != false) {
       
        $resultado->MoveFirst();
        $i = 0;
        while(!$resultado->EndOfSeek()) {
            $i++;
            $fila = $resultado->Row();
            
           
?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $fila->nombre_completo; ?></td>
                    <td><?php echo $fila->Cantidad_vendidos; ?></td>
                    <td><?php echo $fila->tipoPago; ?></td>
                    <td><?php echo $fila->mes; ?></td>
                    
        
                </tr>
<?php
        }
       
        
       
    }
}
    /*$resultado->MoveFirst();
    if ($resultado != false) {
        $i = 0;
        while(!$resultado->EndOfSeek()) {
            $i++;
            $fila = $resultado->Row();*/
?>
               
<?php
      /*  }
    }*/
?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
<?php include_once "../template/s_piepagina.php"; ?>
<?php include_once "../template/s_global.php"; ?>
    </body>
</html>
