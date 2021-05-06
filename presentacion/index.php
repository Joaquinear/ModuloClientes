<?php include "../template/s_sesion.php";?>

<?php

    if ($_SESSION['perfil'] == 'Operaciones') {
        header('Location: ../tpm/index.php');

    }

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
    <style>
        .noticias p img{
            width:100%;
            height:100%;
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
    $menu="spc";
    include_once "../template/s_encabezado.php"; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">

     
    </section>

    <!-- Main content -->
    <section class="content">

<section>
      <!-- title row -->
        </section>
        <section>
      <!-- info row -->

      <!-- /.row -->

      <!-- Table row -->


    </section>
        <!-- Your Page Content Here -->

        <!-- -->
    </section>
    <!-- /.content -->
<?php include_once "../template/s_piepagina.php"; ?>
    <?php include_once "../template/s_global.php"; ?>
    </body>
</html>
