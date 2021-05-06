<script>
    function MostrarMensaje(mensaje, tipo){
        var clase="modal-dialog modal-sm";
        var clase2="btn btn-default";
        var clase3="icon fa fa-info";
        tipo = tipo || 'normal';
        if(tipo=="normal"){ clase="modal-dialog "; clase2="btn btn-default"; clase3='<i class="icon fa fa-info"></i>&nbsp;&nbsp;&nbsp;Mensaje';}
        if(tipo=="alerta"){ clase="modal-dialog modal-warning"; clase2="btn btn-outline"; clase3='<i class="icon fa fa-warning"></i>&nbsp;&nbsp;&nbsp;Alerta';}
        if(tipo=="exito"){ clase="modal-dialog modal-success"; clase2="btn btn-outline"; clase3='<i class="icon fa fa-check"></i>&nbsp;&nbsp;&nbsp;Correcto';}
        if(tipo=="error"){ clase="modal-dialog modal-danger"; clase2="btn btn-outline"; clase3='<i class="icon fa fa-ban"></i>&nbsp;&nbsp;&nbsp;Error';}
        if(tipo=="info"){ clase="modal-dialog modal-info"; clase2="btn btn-outline"; clase3='<i class="icon fa fa-ban"></i>&nbsp;&nbsp;&nbsp;Info';}
        $("#ModalMensajeClase").attr("class", clase);
        $("#btnModalMensaje").attr("class", clase2);
        mensaje='<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4>'+clase3+'</h4>&nbsp;<center>'+mensaje+'</center><div style="text-align:right; padding-top: 15px;"><button type="button" class="'+clase2+'" data-dismiss="modal" id="btnModalMensaje">Cerrar</button></div>';
        $("#ModalMensajeBody").html(mensaje);
        $('#ModalMensaje').modal('show');
    }




    function MostrarMensaje2(mensaje, tipo,codigo){
        var clase="modal-dialog modal-sm";
        var clase2="btn btn-default";
        var clase3="icon fa fa-info";
        tipo = tipo || 'normal';
        if(tipo=="normal"){ clase="modal-dialog "; clase2="btn btn-default"; clase3='<i class="icon fa fa-info"></i>&nbsp;&nbsp;&nbsp;Mensaje';}
        if(tipo=="alerta"){ clase="modal-dialog modal-warning"; clase2="btn btn-outline"; clase3='<i class="icon fa fa-warning"></i>&nbsp;&nbsp;&nbsp;Alerta';}
        if(tipo=="exito"){ clase="modal-dialog modal-success"; clase2="btn btn-outline"; clase3='<i class="icon fa fa-check"></i>&nbsp;&nbsp;&nbsp;Correcto';}
        if(tipo=="error"){ clase="modal-dialog modal-danger"; clase2="btn btn-outline"; clase3='<i class="icon fa fa-ban"></i>&nbsp;&nbsp;&nbsp;Error';}
        if(tipo=="info"){ clase="modal-dialog modal-info"; clase2="btn btn-outline"; clase3='<i class="icon fa fa-ban"></i>&nbsp;&nbsp;&nbsp;Info';}
        $("#ModalMensajeClase").attr("class", clase);
        $("#btnModalMensaje").attr("class", clase2);

        mensaje='<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4>'+clase3+'</h4>&nbsp;<center>'+mensaje+'</center><div style="text-align:right; padding-top: 15px;"><form><button type="submit" class="'+clase2+'" id="btnModalMensaje">Aceptar</button></div></form>';
        $("#ModalMensajeBody").html(mensaje);
        $('#ModalMensaje').modal('show');
    }
    
    function Cargando(){
        var h2 = ($(window).height()-100)/2;
        var auxh2=h2+"px";
        $("#CargandoContent").css({
            "border-radius": "5px",
            "margin-top":auxh2
        });
        $('#ModalCargando').modal({backdrop: 'static', keyboard: false})
        $('#ModalCargando').modal('show');
    }
    
    function FinCargando(){
        $('#ModalCargando').modal('hide');
    }
    function CambiarContraseña(){
        $('#ModalCambiarContrasenia').modal('show');
    }
    function CambiarContrasenia(){
        $('#frmCambiarContrasenia').submit();
    }
    $('.btncarga')
        .click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
            btn.button('reset')
        }, 3000)
    });
    
    $(function(){
        $("#frmCambiarContrasenia").submit(function(e){
            $('#ModalCambiarContrasenia').modal('hide');
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
                        if (data.length >100) {
                            FinCargando();
                            MostrarMensaje("Contraseña cambiada", 'exito');
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
            e.preventDefault();	//STOP default 
        }); 
    });
	// no deja ir hacia atras al apretar backspace
	$(document).on("keydown", function (e) {		
		if (e.which === 8 && !$(e.target).is("input, textarea")) {
			e.preventDefault();
		}else{
			if($(e.target).prop('readonly')){
				e.preventDefault();
			}
		}
	});
</script>
<div class="modal fade" id="ModalMensaje" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document" id="ModalMensajeClase">
        <div class="modal-content">           
          <div class="modal-body" id="ModalMensajeBody">
            ...
          </div>
        </div>
      </div>
</div>    

    
<div class="modal fade" id="ModalCargando" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="border-radius: 5px;" id="CargandoContent">
            <div class="modal-body">
                <center>
                    <i class="fa fa-spinner fa-pulse fa-5x" style="color:#3c8dbc"></i>
                </center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalCambiarContrasenia" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" action="respuestaparcial.php?operacion=contrasenia" id="frmCambiarContrasenia">
                <input type="hidden" name="hcodusrpass" id="hcodusrpass" value="<?php echo $_SESSION["codigousuario"];?>">
                <input type="hidden" name="husrpass" id="husrpass" value="<?php echo $_SESSION["usuario"];?>">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Cambiar contraseña</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="txcontrasenia">Contraseña actual</label>
                  <input type="password" class="form-control" id="txcontrasenia" name="txcontrasenia" placeholder="Contraseña actual">
                </div>
                <div class="form-group">
                  <label for="txcontrasenia">Nueva contraseña</label>
                  <input type="password" class="form-control" id="txncontrasenia" name="txncontrasenia" placeholder="Mueva contraseña">
                </div>
                <div class="form-group">
                  <label for="txcontrasenia">Nueva contraseña (confirmar)</label>
                  <input type="password" class="form-control" id="txncontraseniaconf" name="txncontraseniaconf" placeholder="Contraseña">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="CambiarContrasenia()">Cambiar</button>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>