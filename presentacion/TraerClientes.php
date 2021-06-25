<?php include "../template/s_sesion.php";?>
<?php
//************************** Incluyo las clases a usar  **************************************
require_once "../clases/TraerClientes.php";
require_once "../clases/TraerClientesPotenciales.php";
require_once "../clases/Cuota.php";
require_once "../clases/Plan.php";

//var_dump($_SESSION);
//*************************** Obtengo los datos usuario y codprospecto **************************

  $Lotes = new TraerClientesPotenciales();

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
            <h1>Modulo Clientes<small></small>
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
                                <h3 class="box-title">Clientes</h3>
                          

                            <div class="row pull-right">
                            <div class="col-sm-12">
  
                             <button type="button" class="btn btn-primary form-control" onclick="AdicionarCliente();">Registrar cliente</button>
             
                              </div>
                              </div>
  </div>
                            <div class="box-body">
                                <!-- ****************************************************************************************** -->
                             
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-hover table-striped table-condensed cf" id="tablapaquetes" style="padding:0">
                                        <thead class="cf">
                                            <tr>
                                                <th>ID de Cliente</th>
                                                <th>Ci Cliente </th>
                                                <th>Nombre cliente</th>
                                                <th>Edad</th>
                                                <th>Nacionalidad</th>
                                                <th>Telefono</th>   
                                                <!-- <th>Acciones</th> --> 
                                                <th>Correo</th>                                          
                                                <th>Estado</th> 
                                                <th>ACCIONES</th>     
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php
    $listaPaquete= $Lotes->TraerClientesPotenciales();
    $listaPaquete->MoveFirst();
    while (! $listaPaquete->EndOfSeek()) {    
        $row = $listaPaquete->Row();
        echo "<tr>";
        echo "<td data-title='ID de Cliente'>".$row->Cliente_id."</td>";
        echo "<td data-title='Ci Cliente'>".$row->Ci."</td>";
        echo "<td data-title='Nombre cliente'>".$row->Nombre_Completo."</td>";
        echo "<td data-title='Edad'>".$row->edad."</td>";
        echo "<td data-title='Nacionalidad'>".$row->Nacionalidad."</td>";
        echo "<td data-title='Telefono'>".$row->telefono."</td>";
        echo "<td data-title='Correo'>".$row->Correo."</td>";
        echo "<td data-title='Estado'>".$row->Estado."</td>";
        // aqui comienza las acciones
    


        // 
        echo "<td data-title='ACCION' ><button type='button' class='btn btn-success'  onclick='EditarClientes(".chr(34).$row->Ci.chr(34).",".chr(34).$row->Cliente_id.chr(34).",".chr(34).$row->Nombre_Completo.chr(34).",".chr(34).$row->apellidopa.chr(34).",".chr(34).$row->apellidoma.chr(34).",".chr(34).$row->correo.chr(34).",".chr(34).$row->direccion.chr(34).")'<span class ='fa fa-check'>EDITAR</span></button>";
        
        echo "<td data-title='ACCION' >";
        echo "&nbsp;&nbsp;";
        echo "<button type='button' class='btn btn-danger'  onclick='bajaCliente(".chr(34).$row->Ci.chr(34).",".chr(34).$row->Cliente_id.chr(34).");'> Baja </button>";
      
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
                $('#txtCi').validCampoFranz('0123456789');    
                $('#txtmontototal').validCampoFranz('0123456789');  
                 $('#txtplazoADI').validCampoFranz('0123456789');    
                

            });
          function AdicionarCliente()
        {   

         $("#modalAdicionarCli").modal('show');
          }

          function bajaCliente(cipersona,idcliente)
        {   
         $("#txtCi").val(cipersona);
         $("#txtidCliente").val(idcliente);
         $("#modalBaja").modal('show');
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
              
                $("#txtCi").val(ci);
                $("#txtidClienteBaja").val(idcliente);

                
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
    var val = document.getElementById("txtCi").value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById("txtCi").value = '';
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
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">MODIFICACION DE CLIENTE</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                          

                             <div class="row">
                        <div class="col-md-12">
                            <div >
                              
                                <input type="hidden" name="txtCi" id="txtCi" class="form-control" >
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
                                <label class="col-md-12 control-label">Correo Electrónico</label>
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
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Registrar Cliente</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                          

                            <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">CI</label>
                                <input type="text" name="txtCi" id="txtCi" class="form-control" placeholder="ejemplo : 5814012" required="">
                                </div>
                            </div>
                        </div>  

                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Nombres</label>
                                <input type="text" name="txtNombres" id="txtNombres" class="form-control" placeholder="Nombre" onkeypress="return soloLetras(event)" onblur="limpia()" required="" >
                                </div>
                            </div>
                        </div>  
                         <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Apellido Paterno</label>
                                <input type="text" name="txtApellidoPaterno" id="txtApellidoPaterno" class="form-control" onkeypress="return soloLetras(event)" onblur="limpia()" required="">
                                </div>
                            </div>
                        </div>  
                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Apellido Materno </label>
                                <input type="text" name="txtApellidoMaterno" id="txtApellidoMaterno" class="form-control" required="">
                                </div>
                            </div>
                        </div>  


                        <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Telefono Celular</label>
                                <input type="text" name="txtTelefonoCelular" id="txtTelefonoCelular" class="form-control" placeholder="Por ejemplo, +591 74600000" required="" >
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Edad</label>
                                <input type="text" name="txtEdad" id="txtEdad" class="form-control" placeholder="ejemplo : 26" required="" >
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Nacionalidad</label>
                                <input type="text" name="txtNacionalidad" id="txtNacionalidad" class="form-control" placeholder="Por ejemplo: Boliviano" required="" >
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Correo</label>
                                <input type="email" name="txtCorreo" id="txtCorreo" class="form-control" placeholder="Por ejemplo: CorreoCliente@Sion.com" required="" >
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Fecha de registro</label>
                                <input type="date" name="txtFechaReg" id="txtFechaReg" class="form-control" placeholder="Por ejemplo, jc10@gmail.com" required="" >
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Comentario</label>
                                <input type="text" name="txtComentario" id="txtComentario" class="form-control" placeholder="Por ejemplo, Cliente potencial o cliente" required="" >
                                </div>
                            </div>
                        </div> 
                        <div><br></div>
                         <!--<div class="modal-footer"> -->
                         <button type="submit" class="btn btn-success">CREAR CLIENTE</button> 
                         <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">CERRAR</button> 
                         <!-- </div> -->
                         </form> </div> </div> </div></div>


<div class="modal fade" id="modalBaja" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  >
                <div class="modal-content">
                  <form id="formBaja" name="formBaja" method="POST" action="../presentacion/respuestaparcial.php?operacion=BajaCliente">
                    
                  
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Baja Cliente</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                          

                            <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">CI</label>
                                <input type="text" name="txtCi" id="txtCi" class="form-control" required="">
                                </div>
                            </div>
                        </div>  

                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">idCliente</label>
                                <input type="text" name="txtidCliente" id="txtidCliente" class="form-control" placeholder="Nombre" onkeypress="return soloLetras(event)" onblur="limpia()" required="" >
                                </div>
                            </div>
                        </div>  
                         <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Estado</label>
                                <!--<input type="text" name="txtApellidoPaterno" id="txtApellidoPaterno" class="form-control" onkeypress="return soloLetras(event)" onblur="limpia()" required="">-->
                                <select name="txtEstado" id="txtEstado" class="form-control" >
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                                </div>
                            </div>
                        </div>  
                         <!--<div class="modal-footer"> -->
                         <button type="submit" class="btn btn-success">Cambiar estado</button> 
                         <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">CERRAR</button> 
                         <!-- </div> -->
                         </form> </div> </div> </div></div>
              
<!-- -->


              
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



            $("#formBaja").submit(function(e){
                
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
              $('#modalBaja').modal('hide');
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




    </script>
</html>
