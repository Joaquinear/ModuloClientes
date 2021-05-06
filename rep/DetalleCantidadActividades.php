<?php include "../template/s_sesion.php";?>
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
    <style>
        .noticias p img{
            width:100%;
            height:100%;
        }

    </style>
    <script>
        function Abrir(direccion){
            var params = [
    'height='+screen.height,
    'width='+screen.width,
    'fullscreen=yes' // only works in IE, but here for completeness
].join(',');
     // and any other options from
     // https://developer.mozilla.org/en/DOM/window.open

var popup = window.open(direccion, 'popup_window', params);
popup.moveTo(0,0);
        }
    </script>
    <style>
        #fDatosAsignacion{ width:100%; height: calc(100vh - 260px);}
        @media only screen and (max-width: 800px) {
            #fDatosAsignacion{
                width:100%; height: calc(100vh - 60px);
            }
        }

    </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">

    <?php
    $menu="rep";
    if ($_GET['op'] == '4') {
      $menu = 'spc';
    }
    include_once "../template/s_encabezado.php"; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>Reportes<small>Detalle de Actividades</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

<div class="row">
            <div class="col-xs-12">
                <div> <!--  class="box box-solid" -->
                    <div class="box box-solid">
                    <div class="box-body">
                        <form method="post" target="_blank" action="../pdf/pdf/ReporteCantidadActividades.php" >
                            <div class="box-header with-border">
                                <h3 class="box-title">Filtros de Busqueda</h3>
                                <div class="box-tools pull-right">
                                    
                                </div>
                            </div>
                            <div class="box-body">
<!-- --------------------------------------------------------------------------------------------------  -->
                                <div class="form-horizontal">
                                 
                                    <div class="row">
                                    
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ddOficina" class="col-sm-3 control-label">Oficina</label>
                                                <div class="col-sm-9">
                                                    <select id="ddOficina" name="ddOficina" class="form-control">
                                                        <?php 
                                                            $iParametros=new parametros();
                                                            $iParametros->DropDownSucursal();
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ddOficina" class="col-sm-3 control-label">Fecha Inicial</label>
                                                 <div class="col-sm-9">
                                                <input type="date" name="fecha1" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ddOficina" class="col-sm-3 control-label">Fecha Final</label>
                                                 <div class="col-sm-9">
                                                <input type="date" name="fecha2" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>                                                                  
<!-- --------------------------------------------------------------------------------------------------  -->
                                
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right btncarga" data-loading-text="Cargando...">Generar Reporte</button>
                            </div>
                            </form> 
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
