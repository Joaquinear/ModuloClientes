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

      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-2x fa-calendar"></i> REP</a></li>
        <li class="active">Plan de trabajo</li>
      </ol><h1>Reportes<small>Plan de trabajo</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

<div class="row">
            <div class="col-xs-12">
                <div> <!--  class="box box-solid" -->
                    <div class="box box-solid">
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
                            <div class="row">
                                <div class="col-sm-12">
<?php
    $op=@$_GET["op"]; $src="";
    if($op=="1"){ $src="mapa4.php";}
    if($op=="2"){ $src="mapa5.php";}
    if($op=="3"){ $src="mapa6.php";}
    if($op=="4"){ $src="mapa7.php?oficina=".$_SESSION['oficina']; }

                                    if($op!=""){
?>
                                <!---->
                     <iframe id="fDatosAsignacion" style="border-style:none;" class="col-sm-12" src="<?php echo $src;?>">
                    </iframe>
                     <button type='button' class='btn btn-default btn-sm checkbox-toggle pull-right' onclick="Abrir(&quot;<?php echo $src; ?>&quot;);" style="margin-top: 10px;"><i class='fa fa-television'></i> Pantalla completa</button>
                                <!---->
<?php } ?>
                                </div>
                            </div>
                        </div>
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
