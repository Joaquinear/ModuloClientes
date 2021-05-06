<?php include "../template/s_sesion.php";?>
<?php
//************************** Incluyo las clases a usar  **************************************
require_once "../clases/Paquete.php";
require_once "../clases/Cuota.php";
require_once "../clases/Plan.php";

var_dump($_SESSION);
$codUsuario=$_SESSION['codigousuario'];
//*************************** Obtengo los datos usuario y codprospecto **************************

  $iCuota= new Cuota();

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
                                <h3 class="box-title">Plan de Pago</h3>
                            </div>
                            <div class="box-body">
                                <!-- ****************************************************************************************** -->
                             
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-hover table-striped table-condensed cf" id="tablapaquetes" style="padding:0">
                                        <thead class="cf">
                                            <tr>
                                                <th class="numeric">#</th>
                                                <th>Monto</th>
                                               <th>Fecha limite</th>
                                                <th>Pagar</th>
                                            
                                             
                                                
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php
    $listaPaquete= $iCuota->TraerUltimoPlan($codUsuario);
    if ($listaPaquete->RowCount()>0) {
            $listaPaquete->MoveFirst();
             $auxiliar=1;    
    while (! $listaPaquete->EndOfSeek()) {
       
        $row = $listaPaquete->Row();
        echo "<tr>";
        echo "<td class='numeric' data-title='Nro'>".$row->codPlan."</td>";
        echo "<td data-title='Nombre'>".$row->monto."</td>";
        echo "<td data-title='CI/NIT'>".$row->fecha."</td>";
        if ($row->estado=="3") {
            echo "<td data-title='CI/NIT'>Cancelado por incumplimiento</td>";
        }
        else
        {
        if ($row->estado=="1") {
            echo "<td data-title='CI/NIT'>Cuota Pagada</td>";
        }
        else{
            if ($auxiliar==1) {
                if (date('Y-m-d')>$row->fecha) {
                     echo "<td data-title='CI/NIT'>Atrasada</td>";
                     $iCuota->CancelarCuotas($row->codPlan);
                     header("location: plan.php");
                }
                else
                {
                echo "<td data-title='Teléfono'><button type='button' class='btn btn-primary btncarga' onclick='MostrarModalPP(".$row->codPlan.",".$row->codCuota.",".$row->monto.")'><i class='fa fa-money' ></i></button></td>";
                
                }
                $auxiliar=2;
            }
            else{
echo "<td data-title='CI/NIT'></td>";
            }
        
            }
        }
    
      
        echo "</tr>";
    }
       
    }
    else
    {
        echo '<tr><td></td><td></td><td></td><td></td></tr>';
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

            function MostrarModalPP(codPlan,codCuota,monto)
            {
                $("#codPlan").val(codPlan);
                $("#codCuota").val(codCuota);
                $("#controlPago").val(monto);
                
                $("#modalPP").modal('show');
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

            function GuardarPago(codPlan,codCuota,monto)
            {
                Cargando();
                   $.ajax(
                {
                    url : 'respuestaparcial.php?operacion=RegistrarPago',
                    type: "POST",
                    data : {
                        codPlan: codPlan,
                        codCuota: codCuota,
                        monto: monto
                    },
                    success:function(data, textStatus, jqXHR)
                    {
                        if ($.isNumeric(data)) {
                            FinCargando();
                            $('#modalPP').modal('hide');

                            MostrarMensaje2('El Pago ha sido completado Exitosamente', 'exito');
                            
                        }else{
                            
                            FinCargando();
                            MostrarMensaje(data, 'error');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        MostrarMensaje("ERROR de ajax"+textStatus+' '+ errorThrown,"error");
                    }
                });
            }
        </script>



        <?php/////////////////// MODALS ///////////////////////////////////// ?>  









                <div class="modal fade" id="modalPP" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Seleccione el medio con el que desea pagar</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                            <input type="hidden" name="controlPago" id="controlPago">
                            <input type="hidden" name="codCuota" id="codCuota">
                            <input type="hidden" name="codPlan" id="codPlan">

                                              <div id="paypal-button-container" style="cursor: pointer;"></div>
                                                          <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            



            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: $('#controlPago').val()
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    GuardarPago($('#codPlan').val(),$('#codCuota').val(),$('#controlPago').val());
                });
            }


        }).render('#paypal-button-container');
    </script>

    <!-- Include the PayPal JavaScript SDK -->

             
                    </div>
                            
                     
                </div>
            </div>
        </div>

    </body>
</html>
