<?php include "../template/s_sesion.php";?>
<?php
//************************** Incluyo las clases a usar  **************************************
require_once "../clases/Paquete.php";
require_once "../clases/Cuota.php";
require_once "../clases/Plan.php";

//var_dump($_SESSION);
//*************************** Obtengo los datos usuario y codprospecto **************************

  $iPaquete= new Paquete();

//********************************************************************************************
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php include_once "../template/s_incluir.php"; ?>
        <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="../dist/css/notables.css">
        
    </head>

    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
        <?php
$menu="spc";
include_once "../template/s_encabezado.php"; ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <ol class="breadcrumb">
                

              
            </ol>
            <h1>Paquetes<small></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <section>
                <!-- Table row -->
                <div class="row">
                    <div class="col-sm-12">
                 
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Paquetes</h3>
                            </div>
                            <div class="box-body">
                                <!-- ****************************************************************************************** -->
                             
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-hover table-striped table-condensed cf" id="tablapaquetes" style="padding:0">
                                        <thead class="cf">
                                            <tr>
                                                <th class="numeric">codigo</th>
                                                <th>Nombre</th>
                                               <th>Precio $us.</th>
                                                <th>Descripción</th>
                                                <th></th>
                                             
                                                
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php
    $listaPaquete= $iPaquete->TraerTodosLosPaquetes();
    $listaPaquete->MoveFirst();
    while (! $listaPaquete->EndOfSeek()) {    
        $row = $listaPaquete->Row();
        echo "<tr>";
        echo "<td class='numeric' data-title='Nro'>".$row->codPaquete."</td>";
        echo "<td data-title='Nombre'>".$row->nombre."</td>";
        echo "<td data-title='CI/NIT'>".$row->precio."</td>";
        echo "<td data-title='Teléfono'>".$row->descripcion."</td>";
   
        // 
        echo "<td data-title='Ejecutivo' ><img style='cursor:pointer;'  onclick='MostrarModalPlan(".$row->codPaquete.",".$row->precio.")' src='../images/".$row->foto."'/></td>";
      
        echo "</tr>";
    }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- ****************************************************************************************** -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
            </section>
            <!-- Your Page Content Here -->

            <!-- -->
        </section>

        <!-- /.content -->
        <?php include_once "../template/s_piepagina.php"; ?>
        <?php require_once "../template/s_global.php";?>    
        <!-- DataTables -->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>





        <script>
            $(function () {        
                $('#tablapaquetes').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    language: {
                        url: '../plugins/datatables/es_es.json'
                    }
                });



                    $("#formplan").submit(function(e){
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            Cargando();
            $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    success:function(data, textStatus, jqXHR)
                    {
                        if ($.isNumeric(data)) {
                            location.href="plan.php";
                            
                        }else{
                            $("#dialog-formAgregarContacto").modal('hide');
                            FinCargando();
                            MostrarMensaje(data, 'error');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        MostrarMensaje("ERROR de ajax"+textStatus+' '+ errorThrown,"error");
                    }
                });
            e.preventDefault(); //STOP default
        });

            });
        </script>
        <script>
            $(document).ready(function() {
                $('.ddMarca').change(function() {   
                    var item=$(this);
                    $(".ddModelo").empty();
                    $(".ddModelo").load("devolverdropdown.php?tipo=modelo&marca=" +item.val());

                });
            });
            function Detalle(cod){
                var url="mensualidad.php?cod="+cod;
                window.open(url);
            }

            function MostrarModalPlan(paquete,precio)
            {
                $("#codPaquete").val(paquete);
                $("#txtprecio").val(precio);
                $("#modalPlan").modal('show');
            }

            function MostrarCuotas()
            {
                var control = $('#ddsuscripcion').val();
                if (control==2)
                {
                    $('#divCuotas').show('slow');
                }
                else
                {

                    $('#divCuotas').hide('slow');   
                }
            }
        </script>

        <?php/////////////////// MODALS ///////////////////////////////////// ?>  









                <div class="modal fade" id="modalPlan" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Editar Plan</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                            <form method="post" action="respuestaparcial.php?operacion=registrarPlan" id="formplan">
                                <input type="text" name="codPaquete" id="codPaquete" value="">
                                <input type="text" name="codUsuario" id="codUsuario" value="<?php echo $_SESSION['codigousuario'] ?>">
                                <input type="text" name="txtprecio" id="txtprecio">
                               
                                <div class="row">
                                    

                                    <div class="form-group">
                                                    <label for="ddOficina" class="col-sm-3 control-label">Forma de pago</label>
                                                    <div class="col-sm-9">
                                                        <select id="ddsuscripcion" name="ddsuscripcion" class="form-control" onchange="MostrarCuotas();">
                                                            <?php 
                                                                $iParametros=new parametros();
                                                                $iParametros->DropDownTipoPlan();
                                                            ?>
                                                        </select>
                                                    </div>
                                    </div>
                                </div>

                                <br><br>
                                <div class="row">

                                     <div class="form-group" id="divCuotas" style="display: none;">
                                                    <label for="ddOficina" class="col-sm-3 control-label">Cuotas</label>
                                                    <div class="col-sm-9">
                                                        <select id="ddcuotas" name="ddcuotas" class="form-control">
                                                            <?php 
                                                                $iParametros=new parametros();
                                                                $iParametros->DropDownCuotas();
                                                            ?>
                                                        </select>
                                                    </div>
                                    </div>

                                               
                                    </div>
                                   </form>
                                </div>
                            
                     
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btncarga" onclick="($('#formplan').submit());">Guardar</button>
                            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>
                        </div>
                </div>
            </div>
        </div>

    </body>
</html>
