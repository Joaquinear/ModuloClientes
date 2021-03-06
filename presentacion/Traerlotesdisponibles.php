<?php include "../template/s_sesion.php";?>
<?php
//************************** Incluyo las clases a usar  **************************************
require_once "../clases/TraerClientes.php";
require_once "../clases/TraerLotesDisponibles.php";
require_once "../clases/Cuota.php";
require_once "../clases/Plan.php";

//var_dump($_SESSION);
//*************************** Obtengo los datos usuario y codprospecto **************************

  $Lotes = new TraerLotesDisponibles();

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
            <h1>Gestion Lotes<small></small>
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
                                <h3 class="box-title">Listado Lotes Disponibles</h3>
                          

                            <div class="row pull-right">
                            <div class="col-sm-12">
  
                             <button type="button" class="btn btn-primary form-control" onclick="AdicionarCliente();">vender Lotes</button>
             
                              </div>
                              </div>
  </div>
                            <div class="box-body">
                                <!-- ****************************************************************************************** -->
                             
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-hover table-striped table-condensed cf" id="tablapaquetes" style="padding:0">
                                        <thead class="cf">
                                            <tr>
                                                <th>Id Lote </th>
                                                <th>Urbanizacion</th>
                                                <th>Tama??oMTS2</th>
                                                <th>Precio</th>
                                                <th>Tipo de moneda</th>
                                               <th>Estado</th>                                              
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php
    $listaPaquete= $Lotes->TraerLotesDisponibles();
    $listaPaquete->MoveFirst();
    while (! $listaPaquete->EndOfSeek()) {    
        $row = $listaPaquete->Row();
        echo "<tr>";
        echo "<td data-title='Id Lote'>".$row->Id_Lotes."</td>";
        echo "<td data-title='Urbanizacion'>".$row->Nombre_Urbanizacion."</td>";
        echo "<td data-title='Tama??oMTS2'>".$row->TamanhoMts2."</td>";
        echo "<td data-title='Precio'>".$row->Precio."</td>";
        echo "<td data-title='Tipo de moneda'>".$row->Tipo_Moneda."</td>";
        echo "<td data-title='Estado'>".$row->Estado."</td>";
        // 
        echo "<td data-title='ACCION' ><button type='button' class='btn btn-success'  onclick='EditarClientes(".chr(34).$row->ci.chr(34).",".chr(34).$row->idcliente.chr(34).",".chr(34).$row->nombrecli.chr(34).",".chr(34).$row->apellidopa.chr(34).",".chr(34).$row->apellidoma.chr(34).",".chr(34).$row->correo.chr(34).",".chr(34).$row->direccion.chr(34).")'<span class ='fa fa-check'>EDITAR</span></button>";
        echo "&nbsp;&nbsp;";
        echo "<button type='button' class='btn btn-danger'  onclick='BajaCliente(".chr(34).$row->ci.chr(34).",".chr(34).$row->idcliente.chr(34).")'<span class ='fa fa-close'>ELIMINAR</span></button>
        
        
         </td>";
      
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
          "emptyTable": "No hay informaci??n",
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
                 $('#txtnombre').validCampoFranz(' abcdefghijklmn??opqrstuvwxyz????iou');
                 $('#txtpaterno').validCampoFranz(' abcdefghijklmn??opqrstuvwxyz????iou');
                 $('#txtmaterno').validCampoFranz(' abcdefghijklmn??opqrstuvwxyz????iou');
                 
                //Para escribir solo numeros    
                $('#txtciADI').validCampoFranz('0123456789');    
                $('#txtmontototal').validCampoFranz('0123456789');  
                 $('#txtplazoADI').validCampoFranz('0123456789');    
                

            });
          function AdicionarCliente()
        {   
         
            
        
         $("#modalAdicionarCli" ).modal('show');
          }

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
    letras = " ??????????abcdefghijklmn??opqrstuvwxyz";
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



         
        </script>

        <?php/////////////////// MODALS ///////////////////////////////////// ?>  


<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  >
                <div class="modal-content">
                  <form id="formCrear" name="formCrear" method="POST" action="../presentacion/respuestaparcial.php?operacion=EditarUsuario">
                    
                  
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">??</span></button>
                        <h4 class="modal-title">MODIFICACION DE CLIENTE</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                          

                             <div class="row">
                        <div class="col-md-12">
                            <div >
                              
                                <input type="hidden" name="txtci" id="txtci" class="form-control" >
                                <input type="hidden" name="txtidcli" id="txtidcli" class="form-control" >

                            </div>
                        </div>
                    </div>  


                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Nombre</label>
                                <input type="text" name="txtnombre" id="txtnombre" class="form-control" required="" >
                            </div>
                        </div>
                    </div>  

                    
                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Apellido Paterno</label>
                                <input type="text" name="txtpaterno" id="txtpaterno" class="form-control" required="">
                            </div>
                        </div>
                    </div>  

                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Apellido Materno</label>
                                <input type="text" name="txtmaterno" id="txtmaterno" class="form-control" required="">
                            </div>
                        </div>
                    </div>  




                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Direccion</label>
                                <input type="text" name="txtdireccion" id="txtdireccion" class="form-control" required="">
                            </div>
                        </div>
                    </div>  


                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Correo Electr??nico</label>
                                <input type="text" name="txtcorreo" id="txtcorreo" class="form-control" >
                            </div>
                        </div>
                    </div> 

                           

                     
                       
                    



                                


             
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success ">MODIFICAR</button>
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
                            <span aria-hidden="true">??</span></button>
                        <h4 class="modal-title">Vender Lote</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                          

                            <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Fecha Venta</label>
                                <input type="date" name="txtciADI" id="txtciADI" class="form-control"  required="">
                                </div>
                            </div>
                        </div>  

                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">ID Lote</label>
                                <input type="text" name="txtnombreADI" id="txtnombreADI" class="form-control" placeholder="ID del lote" onkeypress="return soloLetras(event)" onblur="limpia()" required="" >
                                </div>
                            </div>
                        </div>  

                    
                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Estado</label>
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
                                <label class="col-md-12 control-label">Correo Electr??nico</label>
                                <input type="email" name="txtcorreoADI" id="txtcorreoADI" class="form-control" placeholder="Por ejemplo, jc10@gmail.com" required="" >
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Cliente</label>
                                <select class="col-md-12 form-control" id="ddpaisADI" name="ddpaisADI" >
                                    <?php $tool->DropDownPais(); ?>
                                </select>
                                </div>
                            </div>
                        </div>   

                           
                         </div> 
                         <!--<div class="modal-footer"> -->
                         <button type="submit" class="btn btn-success ">CREAR CLIENTE</button> 
                         <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">CERRAR</button> 
                         <!-- </div> -->
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
              MostrarMensaje2('Se ha modificado satisfactoriamente');
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
              MostrarMensaje2('Se ha creado satisfactoriamente');
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
              MostrarMensaje2('Se ha eliminado satisfactoriamente');
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
    </script>
</html>
