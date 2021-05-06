<?php include "../template/s_sesion.php";?>
<?php

require_once "../clases/Mensualidad.php";
$codigoMensualidad=$_GET['cod'];

  $iMensualidad= new Mensualidad();
    $TraerDatos= $iMensualidad->TraerMensualidad($codigoMensualidad);
    $datosMensualidad= $TraerDatos->row();

    $datosActividadesMensualidad= $iMensualidad->TraerActividadesMensualidad($codigoMensualidad);
      $datosActividadesMensualidad->MoveFirst();
      $actividades="";
                                         

                                            while (! $datosActividadesMensualidad->EndOfSeek()) {
                                            $fila = $datosActividadesMensualidad->Row();
                                            if($datosActividadesMensualidad->EndOfSeek())
                                            {
                                                $actividades= $actividades.$fila->nombre;
                                            }
                                            else
                                            {
                                                $actividades= $actividades.$fila->nombre.', ';
                                            }
                                            
                                           }


if(date('Y-m-d') <= $datosMensualidad->fechaVencimiento)
{
    $colorcaja='green';
    $manito='up';
    $titulo='HABILITADO';
    $descripcion='Cliente al dia en sus pagos';
}
else
{
    $colorcaja='red';
    $manito='down';
    $titulo='INHABILITADO';
    $descripcion='Necesita pagar su mensualidad';
    if($datosMensualidad->codTemporada > 1)
    {
        $colorcaja='green';
    $manito='up';
    $titulo='HABILITADO';
    $descripcion='Cliente al dia en sus pagos';
    }
}

if ($datosMensualidad->codTipopago==1) {

    $TotalaPagar=$datosMensualidad->total;
}

if ($datosMensualidad->codTipopago==2) {

    $TotalaPagar=$datosMensualidad->total*3;
}

if ($datosMensualidad->codTipopago==3) {

    $TotalaPagar=$datosMensualidad->total*5;
}
                
                
         

    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php include_once "../template/s_incluir.php"; ?>
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="../plugins/iCheck/all.css">
        <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="../dist/css/notables.css">
<style>
</style>
    </head>

    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
        <?php
$menu="spc";
include_once "../template/s_encabezado.php"; ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">

           
            <h1>Mensualidad &nbsp;&nbsp;<small>(Ficha Cliente)</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <section>
                <!-- Table row -->
                <div class="row">
                  
                    <div class="col-md-12">
       

                        <!-- <div class="box-body"> -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs" id="myTab">
                                     <li  class="active"><a href="#tabcaratula" data-toggle="tab">Informacion General</a></li>
                                    <li><a href="#tabinformacion" data-toggle="tab">Historico de Pagos</a></li> 
                                </ul>
                                <div class="tab-content">

                                    <div class="active tab-pane" id="tabcaratula">
                                        <div class="form-horizontal">
                                            <div class="row">
                                              
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Nombre</label>

                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" value="<?php echo $datosMensualidad->nombrecompleto; ?>" readonly="readonly" >
                                                        </div>
                                                        <label for="inputEmail3" class="col-sm-2 control-label">Sucursal</label>

                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" value="<?php echo $datosMensualidad->sucursal; ?>" readonly="readonly" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="info-box bg-<?php echo $colorcaja; ?>">
                                                            <span class="info-box-icon"><i class="fa fa-thumbs-o-<?php echo $manito;?>"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text"><?php echo $titulo; ?></span>
                                                                <span class="progress-description">                                    
                                                                    <?php echo $descripcion; ?>
                                                                </span>
                                                                
                                                                
                                                                
                                                            </div>
                            
                                                       
                                                    </div>
                                                </div>
                                              </div>
                                              


                                              </div>
                                              <div class="row">
                                              
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">CI</label>

                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" value="<?php echo $datosMensualidad->ci; ?>" readonly="readonly" >
                                                        </div>
                                                         <label for="inputEmail3" class="col-sm-2 control-label">Telefono</label>

                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" value="<?php echo $datosMensualidad->telefono; ?>" readonly="readonly" >
                                                        </div>




                                                    </div>
                                                </div>
                                                


                                              </div>
                                              <div class="row">
                                              
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Direccion</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" value="<?php echo $datosMensualidad->direccion; ?>" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      
                                                    </div>
                                                </div>
                                              


                                              </div>
                                                <div class="row">
                                              
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Plan</label>

                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" value="<?php echo $datosMensualidad->tipopago; ?>" readonly="readonly">
                                                        </div>
                                                        <label for="inputEmail3" class="col-sm-2 control-label">Tipo de Registro</label>

                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" value="<?php echo $datosMensualidad->temporada; ?>" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                    </div>
                                                </div>
                                              


                                              </div>
                                                <div class="row">
                                              
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Mensualidad</label>

                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" value="<?php echo $TotalaPagar ?>" readonly="readonly">
                                                        </div>
                                                        <label for="inputEmail3" class="col-sm-2 control-label">Valido Hasta</label>

                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" value="<?php echo $datosMensualidad->fechaVencimiento; ?>" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                              


                                              </div>

                                              <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Actividades</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" value="<?php echo $actividades; ?>" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                            
   

  


                                            <div class="box-footer" style="text-align:right">
                                                <?php if($actividades != ""){?>
                                                <button type="button" class="btn btn-primary" onclick="PagarCuota();">¡Registrar Pago!</button>
                                            <?php }?>
                                                <button type="button" class="btn btn-info" onclick="EditarPlan();">¡Editar Plan!</button>
                                                <button type="button" class="btn btn-success" onclick="EditarInformacion();">¡Editar Informacion Personal!</button>
                                      
        </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tabinformacion">
                                        <div class="box-body">
     
                                            <div class="row">
                                                <div class="form-group col-md-12">

                                                        <table class="table table-hover" id="tablaModelo">
              
       
                 
                <thead>
                  <tr>
                  <th>fecha</th>
                
                  <th>Pago</th>
                  
                  <th>Usuario Encargado</th>

                  <th>Comentario Adicional</th>
            
                 
                </tr>
                </thead>
                <tbody>
                  <?php
                        $listaMensualidad=$iMensualidad->TraerTodosLosPagos($codigoMensualidad);

                $listaMensualidad->MoveFirst();
                

                      while (! $listaMensualidad->EndOfSeek()) {
                                            $registro = $listaMensualidad->Row();
                                            $totaldebe=$registro->monto+$registro->deuda;
                                               print "
                        <tr>
                         
                          <td>$registro->fechapago</td>
                          <td>$registro->monto</td>
                         
                          <td>$registro->nombre</td>
                          <td>$registro->comentario</td>
                          </tr>
                        ";

                                           }
                      
                  ?>

                </tbody></table>
                                                  
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="box-footer" style="text-align:right">
                                            
                                        </div>
                                    </div>




<!-- ELIMINAR COTIZACION VIGUETAS -->


<!-- NEW COTIZACION VIGUETAS -->




                        </div>
                            </div>
                        <!-- </div> -->

                </div>
                <!---//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
            </section>
        </section>
        <!-- /.content -->
        <?php include_once "../template/s_piepagina.php"; ?>
        <?php require_once "../template/s_global.php";?>


    <!-- DataTables -->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>



<!--
////////////////////////////////////////////////////////////////////////////////////////////////////
DIALOGO EDITAR PROSPECTO

////////////////////////////////////////////////////////////////////////////////////////////////////
DIALOGO VER IMAGENES
////////////////////////////////////////////////////////////////////////////////////////////////////
-->
        <div class="modal fade" id="dialog-formImg" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-sm" role="document" id="dialog-formImgClase" style="min-width:500px" >
                <div class="modal-content" style="height: 430px; width: 100%">
                    <div class="modal-body" id="dialog-formImgBody">
                        ...
                    </div>
                </div>
            </div>
        </div>
<!--
////////////////////////////////////////////////////////////////////////////////////////////////////
DIALOGO VER IMAGEN
////////////////////////////////////////////////////////////////////////////////////////////////////
-->
       
        <div class="modal fade" id="dialog-formEditarContacto" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  style="width:90%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Editar Contacto</h4>
                    </div>
                    <div class="modal-body" style="overflow-y:auto">
                        <form method="post" action="respuestaparcial.php?operacion=editarcontacto" id="formEditarContacto">
                            <input type="hidden" name="txcodPersonaec" id="txcodPersonaec" value="<?php echo $datosMensualidad->codPersona;?>">
                             <input type="hidden" name="txcodMensualidad" id="txcodMensualidad" value="<?php echo $codigoMensualidad; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txdescripcion">Nombre</label>
                                        <input type="text" name="txnombreec" id="txnombreec" class="form-control" value="<?php echo $datosMensualidad->nombre;?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="txdescripcion">Apellido Paterno</label>
                                        <input type="text" name="txapepatec" id="txapepatec" class="form-control" value="<?php echo $datosMensualidad->apepat;?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txdescripcion">Apellido Materno</label>
                                        <input type="text" name="txapematec" id="txapematec" class="form-control" value="<?php echo $datosMensualidad->apemat;?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="txdescripcion">Cedula de Identidad</label>
                                        <input type="text" name="txciec" id="txciec" class="form-control" value="<?php echo $datosMensualidad->ci;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txdescripcion">Telefono</label>
                                        <input type="text" name="txtelefonoec" id="txtelefonoec" class="form-control" value="<?php echo $datosMensualidad->telefono;?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="txdescripcion">Direccion</label>
                                        <input type="text" name="txdireccionec" id="txdireccionec" class="form-control" value="<?php echo $datosMensualidad->direccion;?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btncarga" onclick="($('#formEditarContacto').submit());">Guardar</button>
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
<!--
////////////////////////////////////////////////////////////////////////////////////////////////////
DIALOGO ELIMINAR CONTACTO
////////////////////////////////////////////////////////////////////////////////////////////////////
-->
        <div class="modal fade" id="dialog-formEditarPlan" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  style="width:50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Editar Plan</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                            <form method="post" action="respuestaparcial.php?operacion=editarplan" id="formEditarPlan">
                                <input type="hidden" name="txcodMensualidadep" id="txcodMensualidadep" value="<?php echo $codigoMensualidad; ?>">
                                <input type="hidden" name="codigodeltipo" id="codigodeltipo" value="<?php echo $datosMensualidad->codTipopago; ?>">
                               
                                <div class="row">
                                    

                                    <div class="form-group">
                                                    <label for="ddOficina" class="col-sm-3 control-label">Tipo de Suscripcion</label>
                                                    <div class="col-sm-9">
                                                        <select id="ddsuscripcion" name="ddsuscripcion" class="form-control">
                                                            <?php 
                                                                $iParametros=new parametros();
                                                                $iParametros->DropDownTipoPago($datosMensualidad->codTipopago);
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="ddOficina" class="col-sm-3 control-label">Actividades</label>
                                                    <div class="col-sm-9">
                                                        <select id="ddactividades" name="ddactividades[]" class="form-control" multiple>
                                                            <?php 
                                                                $iParametros=new parametros();
                                                                $iParametros->DropDownActividades($codigoMensualidad);
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                    </div>
                                   </form>
                                </div>
                            
                     
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btncarga" onclick="($('#formEditarPlan').submit());">Guardar</button>
                            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>
                        </div>
                </div>
            </div>
        </div>




                <div class="modal fade" id="dialog-formPagarCuota" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  style="width:30%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Registrar Pago</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                            <form method="post" action="respuestaparcial.php?operacion=pagarcuota" id="formPagarCuota">
                                <input type="hidden" name="txcodMensualidadpago" id="txcodMensualidadpago" value="<?php echo $codigoMensualidad; ?>">
                                <input type="hidden" name="txmontopago" id="txmontopago" value="<?php echo $TotalaPagar; ?>">
                                <input type="hidden" name="codigodeltipo" id="codigodeltipo" value="<?php echo $datosMensualidad->codTipopago; ?>">
                                <div class="row">
                                    

                                    <div class="form-group">
                                                    <label for="ddOficina" class="col-sm-12 control-label">Esta seguro que desea registrar el pago de la mensualidad de <?php echo $TotalaPagar; ?>  Bs.?</label>
                                                    
                                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txdescripcion">Comentario Adicional</label>
                                        <input type="text" name="txcomentario" id="txcomentario" class="form-control">
                                    </div>
                                  
                                </div>    
                                    </div>
                                   
                                </div>
                            </form>
                     
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btncarga" onclick="($('#formPagarCuota').submit());">Guardar</button>
                            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>
                        </div>
                </div>
            </div>
        </div>





    <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet">
    <script type="text/javascript" src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

    


    <script type="text/javascript">
        
        function EditarInformacion()
        {
            $('#dialog-formEditarContacto').modal('show');
        }
        function EditarPlan()
        {
            $('#dialog-formEditarPlan').modal('show');
        }
         function PagarCuota()
        {
            $('#dialog-formPagarCuota').modal('show');
        }


      $('#tablaModelo').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": false,
              info: false,
              language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato para mostrar",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
                },
                oAria: {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
              },
              lengthChange: false,
              paging: true,
              responsive: true,
              searching: true
            });




    </script>          


    </body>
</html>
