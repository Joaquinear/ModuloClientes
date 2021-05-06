<?php
session_name( 'sgc2' );
session_start();
unset($_SESSION['usuario']);
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php require_once "../template/s_incluir.php";?>

  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" <?php ?> style="background: url(../images/fondo_softwarecasamia.jpg);
    background-attachment: fixed;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    padding-top: 50px;">
<div class="login-box" style="margin-top:0;">
     <center>
     <div class="login-logo">            
    <a style="color:black"><b>Penta Solución</b></a>
    </div>      
    </center>
 
  <!-- /.login-logo -->
  <div class="login-box-body" style="background-color: rgba(255, 255, 255, 0.55) !important;">
     <div class="login-logo">
    <!-- <a href="#"><b>SGC 2.0</b></a> -->
         <center>
        <img src="../images/PentaSolucion.png" class="img-responsive" style="margin-top: 10px; margin-bottom: 20px; width: 80%;">
    </center>
  </div>  
    <!-- <div class="row">
    <div class="col-xs-12" style="text-align: center;">
      <img src="../logogrt.png" style="width:70%">
    </div>
    </div> -->
    <form action="iniciar.php" method="post" id="frmIniciar" name="frmIniciar">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="txusuario" id="txusuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="txpassword" id="txpassword">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <button type="button" onclick="AbirModalRegistro();" class="btn btn-success btn-block btn-flat">Registrarse</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- <a href="#" style="padding-left:20px">¿Olvido su contraseña?</a><br> -->
  
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 2.1.4 -->
 <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
 <script src="../plugins/jQuery/validacionKeyCampo.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>

<script>
   $(function(){
                //Para escribir solo letras
                 $('#txtnombre').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
                 $('#txtpaterno').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
                 $('#txtmaterno').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
                 
                //Para escribir solo numeros    
                $('#txtci').validCampoFranz('0123456789');    
               
                

            });
        $(document).ready(function() {
            $("#frmIniciar").submit(function(e){
                if (($("#txusuario").val()!='')&&($("#txpassword").val()!='')){
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
							location.href="../presentacion/index.php";
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
            }else{
                MostrarMensaje("Debe ingresar sus credenciales para iniciar sesión.", "alerta");

            }

                e.preventDefault();	//STOP default action
            });


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
              MostrarMensaje2('Se ha registrado satisfactoriamente, por favor inicie sesion para continuar','exito');
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

setInputFilter(document.getElementById("txttelefono"), function(value) {
  return /^\d*\.?\d*$/.test(value);
});




        });

    function NoSesion(){
        MostrarMensaje("Debe iniciar sesión para ingresar al sistema.", "alerta");
    }

    function AbirModalRegistro()
    {
      $('#modalCrear').modal('show');
    }

    function verificar1y2()
    {
      var pass1 = $('#txtpassword1').val();
      var pass2 = $('#txtpassword2').val();

      if (pass2=="") {
        $('#divPass').html('');
        $('#botonReg').hide('slow');

      }
      else
      {
        if (pass1==pass2) {
            $('#divPass').html('');
            $('#botonReg').show('slow');
        }
        else
        {
          $('#divPass').html('Las contraseñas no coinciden!');
          $('#botonReg').hide('slow');
        }
      }
    }


   
</script>
<?php require_once "../template/s_global.php";?>


<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document"  >
                <div class="modal-content">
                  <form id="formCrear" name="formCrear" method="POST" action="../presentacion/respuestaparcial.php?operacion=CrearUsuario">
                    
                  
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Registro</h4>
                    </div>
                        <div class="modal-body" style="overflow-y:auto">
                          



                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">1re Nombre</label>
                                <input type="text" name="txtnombre1primer" id="txtnombre1primer" class="form-control" placeholder="Por ejemplo, Juan" required="" >
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">2do Nombre</label>
                                <input type="text" name="txtnombre2donombre" id="txtnombre2donombre" class="form-control" placeholder="Por ejemplo, Juan" >
                                </div>
                            </div>
                        </div>  

                    
                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Apellido Paterno</label>
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
                                <label class="control-label">celularI</label>
                                <input type="text" name="txtcelular" id="txtcelular" class="form-control" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Fijo</label>
                                <input type="text" name="txtFijo" id="txtFijo" class="form-control" required="">
                            </div>
                        </div>
                    </div>

                             <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">CI</label>
                                <input type="text" name="txtci" id="txtci" class="form-control" required="">
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">fecha</label>
                                <input type="date" name="FechaInicio" id="FechaInicio" class="form-control" required="">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Rol</label>
                                <select  name="txtrol" id="txtrol" class="form-control" required="">
                                <?php 
                                $tool->traerRoles();
                                ?>
                                </select>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Usuario</label>
                                <input type="text" name="txtusuario" id="txtusuario" class="form-control" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="control-label">Contraseña</label>
                                <input type="text" name="txtpassword1" id="txtpassword1" class="form-control" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label class="col-md-12 control-label">Verificar Contraseña</label>
                                <input type="password" name="txtpassword2" id="txtpassword2" onkeyup="verificar1y2();" class="form-control" required="">
                            </div>
                        </div>
                    </div>

                            
                     
                    <div class="row">
                        <div class="col-md-12">
                            <div id="divPass"></div>
                        </div>
                    </div> 

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="botonReg" class="btn btn-success " style="display: none;">Registrarse</button>
                         <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>
                    </div>
                            
                     </form>
                </div>
            </div>
        </div>


</body>
</html>
