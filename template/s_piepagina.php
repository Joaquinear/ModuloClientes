      <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->

    <!-- Default to the left -->

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-stats-tab" data-toggle="tab"><i class="fa fa-cubes"></i></a></li>
    
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">

      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane active" id="control-sidebar-stats-tab">
        <?php $perfil = $_SESSION['perfil']; ?>
          <h3 class="control-sidebar-heading">Modulos</h3>
          <?php if($_SESSION['rol']=="1" || $_SESSION['rol']=="2" ) { ?>
          <a class="btn btn-block btn-social bg-orange" href="../presentacion/index.php"><i class="fa fa-cube"></i>Ventas</a>
          <?php } ?>
          <?php if ($_SESSION['rol']=="2") { ?>
          <a class="btn btn-block btn-social bg-primary" href="../rep/ventasxvendedores.php"><i class="fa fa-cube"></i> Reportes</a>
          <?php } ?>
          
         
        
          <!-- <a class="btn btn-block btn-social btn-info"><i class="fa fa-cube"></i> X: Tutifruti</a> -->
      </div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
    
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- SlimScroll 1.3.0 -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->


<!-- AdminLTE App -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../dist/js/app.min.js"></script> 
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<script>

$( function() {
  $( ".toFromDate" ).datepicker({
    changeMonth: true,
    changeYear: true
  });
} );


function SincronizarClientes(){
  Cargando();
    // window.open("../contenido/clientecompleto.php");
     $.ajax({
                url : "../template/sincronizarcliente.php",
                type: "POST",
                data : 0,
                success:function(data, textStatus, jqXHR)
                {
                    if ((data != "ok") && data.length>100) {
                       alert('Sincronizacion Exitosa.');
                        //alert(data);
                         FinCargando();
                    }else{
                        FinCargando();
                        MostrarMensaje('Ocurrio un error al sincronizar:'+data,'error');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });
}

function SincronizarPrecios(){
  Cargando();
    // window.open("../contenido/clientecompleto.php");
     $.ajax({
                //url : "upload/ws/procesar_precios.php",
                 url : "../template/sincronizarprecios.php",
                type: "POST",
                data : 0,
                success:function(data, textStatus, jqXHR)
                {
                    if ((data != "ok") && data.length>100) {
                       alert('Sincronizacion Exitosa.');
                        //alert(data);
                         FinCargando();
                    }else{
                        FinCargando();
                        MostrarMensaje('Ocurrio un error al sincronizar:'+data,'error');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });
}


function generarExcel(){
    window.open("../spc/downloadExcel.php?fromDate="+$('#fromDate').val()+"&toDate="+$('#toDate').val());
}
</script>