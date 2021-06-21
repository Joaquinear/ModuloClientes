<?php include "../template/s_sesion.php";?>
<?php
//************************** Incluyo las clases a usar  **************************************
require_once "../clases/TraerClientes.php";
require_once "../clases/Cuota.php";
require_once "../clases/Plan.php";
require_once "../clases/TraerLotesDisponibles.php";

//var_dump($_SESSION);
//*************************** Obtengo los datos usuario y codprospecto **************************

  $clientes = new TraerLotesDisponibles();

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
            <h1>Cliente Proveedor<small></small>
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
                                <h3 class="box-title">Cliente Proveedor</h3>
                          

                            <!-- <div class="row pull-right">
                            <div class="col-sm-12">
  
                             <button type="button" class="btn btn-primary form-control" onclick="AdicionarCliente();">Adicionar Lotes</button>
                             <br><br>
                             <button type="button" class="btn btn-primary form-control" onclick="AdicionarReserva();">Realizar Reserva</button>   
                              </div>
                              </div> -->
  </div>
                            <div class="box-body">
                                <!-- ****************************************************************************************** -->
                             
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-hover table-striped table-condensed cf" id="tablapaquetes" style="padding:0">
                                        <thead class="cf">
                                            <tr>
                                                <th class="numeric">Id Producto </th>
                                                <th >Nombre Producto</th>
                                                <th>Descripcion del producto</th>
                                                <th>Fabricante</th>
                                               <th>Cantidad</th>
                                                <th>Precio Unitario</th>
                                                 <!-- <th>TIPO MONEDA</th> -->
                                                <th>ESTADO</th>  
                                                <th>ACCIONES</th>                                           
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php
    $listaPaquete= $clientes->TraerLotesDisponibles();
    //var_dump($_SESSION['codigousuario']);
    $listaPaquete->MoveFirst();
    while (! $listaPaquete->EndOfSeek()) {    
        $row = $listaPaquete->Row();
        echo "<tr>";
        echo "<td  data-title='Id_Produto'>".$row->Id_Produto."</td>";
        echo "<td data-title='Nombre_Producto'>".$row->Nombre_Producto."</td>";
        echo "<td data-title='Descripcion_Producto'>".$row->Descripcion_Productos."</td>";
        echo "<td data-title='Fabricante'>".$row->Fabricante."</td>";
        echo "<td data-title='Cantidad'>".$row->Cantidad."</td>";
          echo "<td data-title='PRECIO'>".$row->Precio_Unitario."</td>";
        // echo "<td data-title='TIPO MONEDA'>".$row->Tipo_Moneda."</td>";
        echo "<td data-title='ESTADO'>".$row->estado."</td>";
        // 
        echo "<td data-title='ACCION' ><button type='button' class='btn btn-success'  onclick='reservarLote(".chr(34).$row->Id_Produto.chr(34).")'>Reservar</button><br>";
        echo "<br>";
        echo "&nbsp;&nbsp;";
        echo "<button type='button' class='btn btn-danger'  onclick='VenderLoteContrato(".chr(34).$row->Id_Lotes.chr(34).",".chr(34).$row->Precio.chr(34).")'>Vender</button></td>";
      
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
         <script src="../plugins/jQuery/validacionKeyCampo.min.js"></script>




        <script>
            $(function () {        
                $('#tablapaquetes').DataTable({
                 language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "_TOTAL_ Registros",
          "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
          "infoFiltered": "(Filtrado de un Total de _MAX_)",
          "infoPostFix": "",
          "thousands": ",",
       // "lengthMenu": "Mostrar _MENU_ Registros",
       "loadingRecords": "Cargando...",
       "processing": "Procesando...",
       "search": "Buscar en tiempo real:",
       "zeroRecords": "Sin resultados encontrados",
       "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    },
    "lengthChange": false
  });



            });
        </script>
        <script>
 $(function(){
                //Para escribir solo letras
                 $('#txtnombre').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
                 $('#txtpaterno').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
                 $('#txtmaterno').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
                 
                //Para escribir solo numeros    
                $('#txtciADI').validCampoFranz('0123456789');    
                $('#txtmontototal').validCampoFranz('0123456789');  
                 $('#txtplazoADI').validCampoFranz('0123456789');    
                

            });


            
            function AdicionarReserva()
            {
            
                $("#modalReserva").modal('show');
            }

          function AdicionarCliente()
            {   
         
            $("#modalAdicionarCli" ).modal('show');
             }
//estoy poniendo
             function VenderLoteContrato(idLote,PrecioLote)
            {   
                $("#txtPrecioLote_V").val(PrecioLote);
                $("#txtIDLote_V").val(idLote);
            $("#modalVenta" ).modal('show');
             }
//aqui termina todo
            function EditarClientes(ci,idcliente,nombre,apellidopa,apellidoma,correo,direccion)
            {
                $("#txtnombre").val(nombre);
                $("#txtpaterno").val(apellidopa);
                $("#txtmaterno").val(apellidoma);
                $("#txtdireccion").val(direccion);
                $("#txtcorreo").val(correo);
                $("#txtci").val(ci);
                $("#txtidcli").val(idcliente);

                $("#modalCrear").modal('show');
            }

            function reservarLote(idLote)
        { 
                $("#txtIDLote").val(idLote);
                $("#modalCrear").modal('show');
            }

     

              function BajaCliente(ci,idcliente)
            {
              
                $("#txtciBaja").val(ci);
                $("#txtidClienteBaja").val(idcliente);

                $("#modalBajaCli").modal('show');
            }

            
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}
//solo permite letras
function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

function limpia() {
    var val = document.getElementById("txtciADI").value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById("txtciADI").value = '';
    }
}



         function traerCliente()
         {

            var ci = $("#txtciBuscar").val();
            $.ajax(
        {
          url : "respuestaparcial.php?operacion=traerCliente",
          type: "POST",
          data : {
            ci : ci
          },
          success:function(data, textStatus, jqXHR)
          {
            if (data != "0") {
                var res = JSON.parse(data);
                $("#txtClientename").val(res['Nombre_completo']);
                $("#txtIdCliente").val(res['Id_Cliente']);
                
            }else{
                $("#txtNombre").val("NO SE ENCONTRO EL CLIENTE");
                $("#txtCodCliente").val("0");   
            }
        
           // MostrarMensaje(data);
          },
          error: function(jqXHR, textStatus, errorThrown)
          {
                        FinCargando();
          }
        });

         }

         function traerCliente_V()
         {

            var ci = $("#txtciBuscar_V").val();
            $.ajax(
        {
          url : "respuestaparcial.php?operacion=traerCliente",
          type: "POST",
          data : {
            ci : ci
          },
          success:function(data, textStatus, jqXHR)
          {
            if (data != "0") {
                var res = JSON.parse(data);
                $("#txtClientename_V").val(res['Nombre_completo']);
                $("#txtIdCliente_V").val(res['Id_Cliente']);
                
            }else{
                $("#txtClientename_V").val("NO SE ENCONTRO EL CLIENTE");
                $("#txtIdCliente_V").val("0");   
            }
        
           // MostrarMensaje(data);
          },
          error: function(jqXHR, textStatus, errorThrown)
          {
                        FinCargando();
          }
        });

         }
        </script>

        <?php/////////////////// MODALS ///////////////////////////////////// ?>  


<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  >
                <div class="modal-content">
                  <form id="formCrear" name="formCrear" method="POST" action="../presentacion/respuestaparcial.php?operacion=CrearReserva">
                    
                  
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">REGISTRAR PRODUCTO</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                          

                             <div class="row">
                        <div class="col-md-12">
                            <div >                              
                                <input type="hidden" name="txtEstado" id="txtEstado" value="1" class="form-control" >
                                
                            </div>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Nombre del Producto</label>
                                <input type="text" name="txtNombreProducto" id="txtNombreProducto" class="form-control" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Descripcion Del Producto</label>
                                <textarea type="text" name="txtdescripcionDelProducto" id="txtdescripcionDelProducto" class="form-control" required=""> </textarea>
                            </div>
                        </div>
                    </div>

                    <div class = "row">
                        <div class="col-md-12">
                            <div>
                                <label class="col-md-12 control-label">Cantidad </label>
                                <input type="text" name="txtCantidad" id="txtCantidad" class="form-control"   required="" onkeypress="return valideKey(event);"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <label class="col-md-12 control-label">Fabricante</label>
                                
                                <input type="text" name="txtFabricante" id="txtFabricante" class="form-control" required="">
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Precio Unitario</label>
                                <input type="text" name="txtPrecioUnitario" id="txtPrecioUnitario" class="form-control" required="">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Fecha Inicio</label>
                                <input type="date" name="dateFechaInicio" id="dateFechaInicio" class="form-control" required="" min="<?php echo date('Y-m-d'); ?>" max="<?php  $actual = strtotime(date('Y-m-d'));
                                     $mesmas = date("Y-m-d", strtotime("+1 day", $actual)); echo $mesmas; ?>">
                            </div>
                        </div>
                    </div>  

                    
                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Fecha Fin</label>
                                <input type="date" name="dateFechaFin" id="dateFechaFin" class="form-control" required="" min="<?php echo date('Y-m-d'); ?>" max="<?php   $mesmas = date("Y-m-d", strtotime("+60 day", $actual)); echo $mesmas; ?>"> 
                            </div>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Monto Reserva</label>
                                <input type="text" name="txtReservaMonto" id="txtReservaMonto" class="form-control" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Tipo Moneda</label>
                                <select name="txtTipoMoneda" id="txtTipoMoneda" class="form-control" required="">
                                <option value="Bolivianos">Bolivianos</option>
                                <option value="Dolares">Dolares</option>
                                </select>
                            </div>
                        </div>
                    </div>  
                    
                    <div class="row" style="display: none;">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Id Lote</label>
                                <input type="hidden" name="txtIDLote" id="txtIDLote" class="form-control" readonly>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                
                                <input type="hidden" value="<?php echo $_SESSION['codigousuario']; ?>" id="codigousuario" name="codigousuario">
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="width:100%">
                        <label for="nombre">CI<span style="color: #FF0000; font-size: 20px;"><b>*</b></span></label>
                    <div class="input-group">
                        <input type="text" name="txtciBuscar" class="form-control" id="txtciBuscar"  placeholder="CI del Cliente">
                         <span title="Buscar Cliente" class="input-group-btn">
                            <button class="btn btn-info" type="button" onclick="traerCliente();">
                                 <i class="fa fa-search"></i>
                                 </button></span></div>
                     
                    </div>
                  
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Nombre Cliente</label>
                                <input type="text" name="txtClientename" id="txtClientename" class="form-control" required="">
                                <input type="hidden" name="txtIdCliente" id="txtIdCliente" class="form-control" >
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success ">Guardar Reserva</button>
                         <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">CERRAR</button>
                    </div>
                            
                     </form>
                </div>
            </div>
        </div>
<?php //////////////////////////////////////////////////////////// adicioncontrato ESTO ESTOY PONIENDO ?>

<div class="modal fade" id="modalVenta" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  >
                <div class="modal-content">
                  <form id="formVender" name="formVender" method="POST" action="../presentacion/respuestaparcial.php?operacion=CrearVenta">
                    
                  
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">VENTA DE LOTE</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                          

                           
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Tipo Pago</label>
                                <select class="form-control" id="ddTipoPago" name="ddTipoPago" onchange="tipoPago();">
                                <option value="0">Seleccionar</option>
                                <option value="1">Contado</option>
                                <option value="2">Credito</option>
                                </select>
                            </div>
                        </div>
                    </div>  

                    <div class="row" id="fila_Plazo" style="display: none;">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Plazo Meses</label>
                                <input type="text" name="txtplazo" id="txtplazo" class="form-control"  >
                            </div>
                        </div>
                    </div>


                             <div class="row" id="fila_FechaInicio">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Fecha Inicio</label>
                                <input type="date" name="dateFechaInicio_V" id="dateFechaInicio_V" class="form-control"  min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>  

                    
                             <div class="row"  id="fila_FechaFin">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Fecha Fin</label>
                                <input type="date" name="dateFechaFin_V" id="dateFechaFin_V" class="form-control"  min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div> 

                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Precio Lote</label>
                                <input type="text" name="txtPrecioLote_V" id="txtPrecioLote_V" class="form-control"  readonly>
                            </div>
                        </div>
                    </div>

                   


                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Tipo Moneda</label>
                                <select name="txtTipoMoneda_V" id="txtTipoMoneda_V" class="form-control" required="">
                                <option value="Bolivianos">Bolivianos</option>
                                <option value="Dolares">Dolares</option>
                                </select>
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Id Lote</label>
                                <input type="text" name="txtIDLote_V" id="txtIDLote_V" class="form-control" readonly>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                
                                <input type="hidden" value="<?php echo $_SESSION['codigousuario']; ?>" id="codigousuario_V" name="codigousuario_V">
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="width:100%">
                        <label for="nombre">CI<span style="color: #FF0000; font-size: 20px;"><b>*</b></span></label>
                    <div class="input-group">
                        <input type="text" name="txtciBuscar_V" class="form-control" id="txtciBuscar_V"  placeholder="CI del Cliente">
                         <span title="Buscar Cliente" class="input-group-btn">
                            <button class="btn btn-info" type="button" onclick="traerCliente_V();">
                                 <i class="fa fa-search"></i>
                                 </button></span></div>
                     
                    </div>
                  
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Nombre Cliente</label>
                                <input type="text" name="txtClientename_V" id="txtClientename_V" class="form-control" required="">
                                <input type="hidden" name="txtIdCliente_V" id="txtIdCliente_V" class="form-control" >
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success ">Guardar Venta</button>
                         <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">CERRAR</button>
                    </div>
                            
                     </form>
                </div>
            </div>
        </div>



<?php ////////////////////////////////////// adicionar cliente ?>

<div class="modal fade" id="modalAdicionarCli" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  >
                <div class="modal-content">
                  <form id="formCrearCLI" name="formCrearCLI" method="POST" action="../presentacion/respuestaparcial.php?operacion=CrearCliente">
                    
                  
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">CREAR CLIENTE</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                          

                            <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">CI</label>
                                <input type="text" name="txtciADI" id="txtciADI" class="form-control"  required="">
                            </div>
                        </div>
                    </div>  

                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Nombre</label>
                                <input type="text" name="txtnombreADI" id="txtnombreADI" class="form-control" placeholder="Por ejemplo, Juan" onkeypress="return soloLetras(event)" onblur="limpia()" required="" >
                            </div>
                        </div>
                    </div>  

                    
                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Apellido Paterno</label>
                                <input type="text" name="txtpaternoADI" id="txtpaternoADI" class="form-control" onkeypress="return soloLetras(event)" onblur="limpia()" required="">
                            </div>
                        </div>
                    </div>  

                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Apellido Materno</label>
                                <input type="text" name="txtmaternoADI" id="txtmaternoADI" class="form-control" onkeypress="return soloLetras(event)" onblur="limpia()" required="">
                            </div>
                        </div>
                    </div>  




                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Direccion</label>
                                <input type="text" name="txtdireccionADI" id="txtdireccionADI" class="form-control" required="">
                            </div>
                        </div>
                    </div>  


                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Correo Electrónico</label>
                                <input type="email" name="txtcorreoADI" id="txtcorreoADI" class="form-control" placeholder="Por ejemplo, jc10@gmail.com" required="" >
                            </div>
                        </div>
                    </div> 

                      

                           
                         </div> 
                         <div class="modal-footer">
                         <button type="submit" class="btn btn-success ">CREAR CLIENTE</button> 
                         <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">CERRAR</button> 
                         </div>
                         </form> </div> </div> </div>

<?php ////////////////////////////////////// adicionar Reserva ?>

<div class="modal fade" id="modalReserva" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  >
                <div class="modal-content">
                  <form id="formCrearCLI" name="formCrearCLI" method="POST" action="../presentacion/respuestaparcial.php?operacion=CrearCliente">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Adicionar Reserva</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                          
                          <input type="hidden" value="<?php echo $_SESSION['codigousuario']; ?>" id="codigousuario" name="codigousuario">

                          
                     

                          <div class="row">
                        <div class="col-md-12">

                            <!-- <div class="form-group">
                        <label class="control-label">CI</label>
                        <div class="input-group">
                        <input type="text" name="txtciBuscar" id="txtciBuscar" class="form-control">
                        <button type="button" class="btn btn-default" onclick="traerCliente();"><i class="fa fa-search"></i></button>
                        </div>
                            </div> -->




                            <div class="form-group" style="width:100%">
                        <label for="nombre">CI<span style="color: #FF0000; font-size: 20px;"><b>*</b></span></label>
                    <div class="input-group">
                        <input type="text" name="txtciBuscar" class="form-control" id="txtciBuscar"  placeholder="CI del Cliente">
                         <span title="Buscar Cliente" class="input-group-btn">
                            <button class="btn btn-info" type="button" onclick="traerCliente();">
                                 <i class="fa fa-search"></i>
                                 </button></span></div>
                     
                    </div>


                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Cliente</label>
                                <input type="text" name="txtNombre" id="txtNombre" class="form-control" readonly>
                            </div>
                        </div>
                    </div>  
                             
                <input type="hidden" id="txtCodCliente" name="txtCodCliente">

                       

                           
                         </div> 
                         <div class="modal-footer">
                         <button type="submit" class="btn btn-success ">CREAR CLIENTE</button> 
                         <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">CERRAR</button> 
                         </div>
                         </form> </div> </div> </div>
              
<?php//////////////////////////////////////// eliminar cliente ?>
<div class="modal fade" id="modalBajaCli" name="modalBajaCli"  role="dialog" style=" overflow: auto; width: 100%;">
  <div class="modal-dialog modal-sm" role="document" id="dialog-formImgageClase" style="width: 50%;margin: auto;">
    <div class="modal-content" id="dialog-formImagenContent">
      <div class="modal-header">
        <h3>DATOS DEL CLIENTE</h3>
      </div>
      
      <div class="modal-body"  id="dialog-formImagenBody" align="center">
        <form role="form" action="../presentacion/respuestaparcial.php?operacion=BajaCliente" id="frmBajaCliente" name="frmBajaCliente">
          <div class="row">

            
            <input type="hidden" name="txtciBaja" id="txtciBaja">
           <input type="hidden" name="txtidClienteBaja" id="txtidClienteBaja">
            <div class="col-md-12">
              <div class="form-group">
                <label for="txmarcaMOD">ESTAS SEGURO DE ELIMINAR EL CLIENTE?</label>
                   <button  type="submit" class="btn btn-success">ACEPTAR</button>           
          <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
              </div>                                         
            </div>
          
           
          
            
            
            
            

            
          </div>
        </form>

       
        

        
      </div>
    </div>
  </div>
</div>
<?php ///////////////////////////////////////// ?>
    </body>
    <script>


        
		function valideKey(evt){
			
			// code is the decimal ASCII representation of the pressed key.
			var code = (evt.which) ? evt.which : evt.keyCode;
			
			if(code==8) { // backspace.
			  return true;
			} else if(code>=48 && code<=57) { // is a number.
			  return true;
			} else{ // other keys.
			  return false;
			}
		}
		


        $("#formCrear").submit(function(e){
                
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
            if (data == "OK") {
              $('#modalCrear').modal('hide');
              FinCargando();
              MostrarMensaje('Se ha modificado satisfactoriamente');
              setTimeout(function(){
            location.reload();
                }, 1000);
            }else{

                            MostrarMensaje(data,'error');
                            FinCargando();

            }
          },
          error: function(jqXHR, textStatus, errorThrown)
          {

                        MostrarMensaje("ERROR INTERNO",'error');
                        FinCargando();

          }
        });
            

                e.preventDefault(); //STOP default action
            });


        /////modal venderLOTE ESTO ESTOY PONIENDO
        $("#formVender").submit(function(e){
                
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
            if (data == "OK") {
              $('#modalVenta').modal('hide');
              FinCargando();
              MostrarMensaje('Se ha procesado satisfactoriamente la venta');
              setTimeout(function(){
            location.reload();
                }, 1000);
            }else{

                            MostrarMensaje(data,'error');
                            FinCargando();

            }
          },
          error: function(jqXHR, textStatus, errorThrown)
          {

                        MostrarMensaje("ERROR INTERNO",'error');
                        FinCargando();

          }
        });
            

                e.preventDefault(); //STOP default action
            });    
           // ESTO HASTA AQUI

        $("#formCrearCLI").submit(function(e){
                
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
            if (data == "OK") {
              $('#modalAdicionarCli').modal('hide');
              FinCargando();
              MostrarMensaje('Se ha creado satisfactoriamente');
            }else{

                            MostrarMensaje(data,'error');
                            FinCargando();

            }
          },
          error: function(jqXHR, textStatus, errorThrown)
          {

                        MostrarMensaje("ERROR INTERNO",'error');
                        FinCargando();

          }
        });
            

                e.preventDefault(); //STOP default action
            });


        $("#frmBajaCliente").submit(function(e){
                
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
            if (data == "OK") {
              $('#modalBajaCli').modal('hide');
              FinCargando();
              MostrarMensaje('Se ha eliminado satisfactoriamente');
            }else{

                            MostrarMensaje(data,'error');
                            FinCargando();

            }
          },
          error: function(jqXHR, textStatus, errorThrown)
          {

                        MostrarMensaje("ERROR INTERNO",'error');
                        FinCargando();

          }
        });
            

                e.preventDefault(); //STOP default action
            });




                        
//esto para aumentar dos meses a la fecha inicio

document.getElementById("dateFechaInicio").onchange = function ()
{
  var input = document.getElementById("dateFechaFin");
  input.min = this.value;

  var fecha = new Date($('#dateFechaInicio').val());
var dias = 60; // Número de días a agregar
  fecha.setDate(fecha.getDate() + dias);
  var day = fecha.getDate();
    var month = fecha.getMonth() + 1;
    var year = fecha.getFullYear();
  if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }

  fecha = year + "-"+month + "-" + day;
  input.max = fecha;

}

document.getElementById("dateFechaInicio_V").onchange = function ()
{
  var input = document.getElementById("dateFechaFin_V");
  input.min = this.value;
  var plazo = $("#txtplazo").val();
    plazo = parseInt(plazo);


  var fecha = new Date($('#dateFechaInicio_V').val());
var dias = 60; // Número de días a agregar
  fecha.setMonth(fecha.getMonth() + plazo);
  var day = fecha.getDate();
    var month = fecha.getMonth() + 1;
    var year = fecha.getFullYear();
  if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }

  fecha = year + "-" +month + "-" + day;
  $('#dateFechaFin_V').val(fecha)
  input.max = fecha;
//alert(fecha);
}


document.getElementById("txtplazo").onchange = function ()
{
  var plazo = $("#txtplazo").val();
    plazo = parseInt(plazo);


  var fecha = new Date($('#dateFechaInicio_V').val());
  fecha.setMonth(fecha.getMonth() + plazo);
  var day = fecha.getDate();
    var month = fecha.getMonth() + 1;
    var year = fecha.getFullYear();
  if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }

  fecha = year + "-" +month + "-" + day;
  $('#dateFechaFin_V').val(fecha)
  input.max = fecha;
//alert(fecha);
}


function tipoPago()
{
   var tipoPago = $("#ddTipoPago").val();
   if(tipoPago==2)
   {
    $("#fila_FechaInicio").show("slow");
    $("#fila_Plazo").show("slow");
    $("#dateFechaFin_V").attr('readonly', true);
   }
   else
   {
  if(tipoPago==1)
  {
    $("#fila_FechaInicio").hide("slow");
    $("#fila_Plazo").hide("slow");
    $("#dateFechaFin_V").attr('readonly', false);
    
  }
  else
  {
    $("#fila_Plazo").hide("slow");
  }
  
   }
    
}


//fin

    </script>
</html>
