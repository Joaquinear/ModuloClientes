<?php include "../template/s_sesion.php";
require_once "../clases/Plan.php";
var_dump($_SESSION);
$objPlan= new Plan();
$estadoSus=$objPlan->VerificarEstadoSuscripcion($_SESSION['codigousuario']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once "../template/s_incluir.php"; ?>
    <!-- iCheck for checkboxes and radio inputs -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css"> -->
     <link rel="stylesheet" href="../plugins/iCheck/all.css">
    <link rel="stylesheet" type="text/css" href="../plugins/newDataTable/DataTables-1.10.15/css/dataTables.bootstrap.min.css"/>

                <link rel="stylesheet" type="text/css" href="../plugins/newDataTable/Responsive-2.1.1/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" href="../plugins/iCheck/all.css">


</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">


  
    <?php

  $color="#CECECE";
    $menu="spc";
    include_once "../template/s_encabezado.php"; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">

     <h1>Nueva Reserva<small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <section>
      <!-- Table row -->
    <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
        <form method="post" target="_self" id="nuevo" name="nuevo" >
            <div class="box box-primary" style="margin: 0 auto 35px auto; max-width: 500px;">
            <div class="box-header with-border">
              <h3 class="box-title">Crear nueva reserva</h3>
            </div>
            <input type="hidden" name="codUsuario" value="<?php echo $_SESSION['codigousuario']; ?>" >
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Sucursal</label>
                                <select class="col-md-12 form-control" id="ddsucursal" name="ddsucursal">
                                    <?php $tool->DropDownSucursal(); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Tipo de Habitación</label>
                                <select class="col-md-12 form-control" id="ddtipohabitacion" name="ddtipohabitacion">
                                    <?php $tool->DropDownTipoHabitacion(); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Fecha de Ingreso</label>
                                <input type="text" name="txtfechaingreso" id="txtfechaingreso" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Fecha de Salida</label>
                                 <input type="text" name="txtfechasalida" id="txtfechasalida" class="form-control"> 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Cantidad de acompañantes</label>
                                 <input type="number" name="txtcantidad" id="txtcantidad" class="form-control" onchange="VerificarCantidad();" min="0" max="5"> 
                            </div>
                        </div>
                    </div>
                    
                  <!-- ////////////////////////////////////////////////////////////////////////////////////////////-->
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <?php 
                if ($estadoSus==1 || $_SESSION['perfil']=='administrador') {
                
                
                ?>
                <button type="submit" class="btn btn-primary">Crear</button>
            <?php } else {echo 'Actualmente no se encuentra habilitado para reservar';} ?>
              </div>

          </div>
          <!-- /.box -->
        </form>


          <!-- box -->
      


          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
  </div>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    </section>
        <!-- Your Page Content Here -->

        <!-- -->
    </section>

    <!-- /.content -->
<?php include_once "../template/s_piepagina.php"; ?>
<?php include_once "../template/s_global.php"; ?>


<script type="text/javascript" src="../plugins/newDataTable/DataTables-1.10.15/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="../plugins/newDataTable/DataTables-1.10.15/js/dataTables.bootstrap.min.js"></script>
            <script type="text/javascript" src="../plugins/newDataTable/Responsive-2.1.1/js/dataTables.responsive.min.js"></script>
            <script type="text/javascript" src="../plugins/newDataTable/Responsive-2.1.1/js/responsive.bootstrap.min.js"></script>

               <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet">
    <script type="text/javascript" src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>
       <!--      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script> -->

<script>






$(document).ready(function() {
    /*------------------------------------------------------*/
            
          $('#txtfechaingreso').datepicker({language:'es', format: 'yyyy-mm-dd',todayHighlight: true,startDate: '<?php echo date('Y-m-d'); ?>'});
            
             $('#txtfechasalida').datepicker({language:'es', format: 'yyyy-mm-dd',todayHighlight: true,startDate:'<?php echo date('Y-m-d'); ?>'});

});


    $("#nuevo").submit(function(e){
        Cargando();
        if (Validar()) {
            var postData = $(this).serializeArray();
           
            $.ajax({
                url : "nuevareserva.php",
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    
                    if (data == "0") {
                            FinCargando();

                        MostrarMensaje('Ocurrio un error al crear el prospecto:'+data,'error');
                    }else{
                   
                        FinCargando();
                       window.location.replace("mensualidad.php?cod="+data);

                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });
        }else{
            FinCargando();
        }
        e.preventDefault(); //STOP default action
    });










    function Validar(){
     

        return true;
    }

    function VerificarCantidad()
    {
        var cant= $('#txtcantidad').val();

        if (cant>5) {
            MostrarMensaje('La cantidad de acompañantes no puede ser superior a 5 personas','alerta');
            $('#txtcantidad').val(5);
        }

        if (cant<0) {
            $('#txtcantidad').val(0);
        }

    }
</script>
<script>



  

</script>
<?php require_once "../template/s_global.php";?>
</body>
</html>
