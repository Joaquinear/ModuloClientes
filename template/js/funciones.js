var codP = 0;
var codOT = 0;
var desp = "";
var valsec = 1;
$(document).ready(function(){
	$("#AddProveedorx").submit(function(e)
	{
		$("#cod_pro_n").css("border","1px solid #CCC");
		$("#nombre_n").css("border","1px solid #CCC");

		if (($("#cod_pro_n").val() != "") && ($("#nombre_n").val() != "")) {
			var postData = $(this).serializeArray();
			var formURL = $(this).attr("action");
			addLoading();
			$.ajax(
			{
				url : formURL,
				type: "POST",
				data : postData,
				success:function(data, textStatus, jqXHR) 
				{
					if (data != "") {
						clearLoading();
						$("#ABMProveedor").hide();
						$("#proveedor").html(data);
					};
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});
		}else{
			$("#cod_pro_n").css("border","1px solid red");
			$("#nombre_n").css("border","1px solid red");
		}
	    e.preventDefault();	//STOP default action
	});

	$("#AddProductox").submit(function(e)
	{

			var postData = $(this).serializeArray();
			var formURL = $(this).attr("action");
			addLoading();
			$.ajax(
			{
				url : formURL,
				type: "POST",
				data : postData,
				success:function(data, textStatus, jqXHR) 
				{
					if (data == "") {
						clearLoading();
						$("#ABMProducto").hide();
					};
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});
	    e.preventDefault();	//STOP default action
	});

	$("#CabNotaCompra").submit(function(e)
	{
		var datosx = $("#proveedor").val();
		if (datosx != "") {
			var datosx2 = datosx.split("-");
			$("#nit_f").val(datosx2[0]);
			$("#cod_pro_f").val(datosx2[1]);			
			$("#nombre_f").val($("#proveedor option:selected").text());			
		};
		

		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");

		$("#fecha").css("border","1px solid #CCC");
		$("#bodega").css("border","1px solid #CCC");
		$("#proveedor").css("border","1px solid #CCC");

		if ($("#fecha").val()== "") {$("#fecha").css("border","1px solid red");}
		if ($("#bodega").val()== "") {$("#bodega").css("border","1px solid red");}
		if ($("#proveedor").val()== "") {$("#proveedor").css("border","1px solid red");}
		if (($("#fecha").val() != "")&&($("#bodega").val() != "")&&($("#proveedor").val() != "")) {
			addLoading();
			$.ajax(
			{
				url : formURL,
				type: "POST",
				data : postData,
				success:function(data, textStatus, jqXHR) 
				{
					clearLoading();
					if (data != "") {
						datos = data.split(",")
						$("#nro").val(datos[0]);
						$("#estado").val(datos[1]);
						$("#co").val("Actualizar Orden");

					};
					if($("#facturado").val() == 1){
						$("#DetalleNotaFactura").show();
						$("#nro_f").val($("#nrodoc").val());
					}
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});
		};
	    e.preventDefault();	//STOP default action
	});
	$("#GrabarOT").submit(function(e)
	{
		$("#ot").css("border","1px solid #CCC");
		$("#lineaot").css("border","1px solid #CCC");

		var Errorx = "";
		for (var i = 0; i < 50; i++) {
			if ($("#" + i + "0-x").val() == 1) {
				Errorx = "Campos Invalidos!!!";
			};	
		};
		for (var i = 0; i < 50; i++) {
			if (($("#" + i + "7-p").val() == "") && ($("#" + i + "0-p").val() != "")) {
				Errorx = "Cantidades Vacias!!!";
			};	
		};

		if ($("#ot").val() != "") {
			if ($("#lineaot").val() != "") {
				if (Errorx == "") {
					var postData = $(this).serializeArray();
					var formURL = $(this).attr("action");
					addLoading();
					$.ajax(
					{
						url : formURL,
						type: "POST",
						data : postData,
						success:function(data, textStatus, jqXHR) 
						{
							if (data == "OK") {
								alert("Orden Guardada Con Exito!!!");
								clearLoading();
							}else{
								alert(data);
							};
						},
						error: function(jqXHR, textStatus, errorThrown) 
						{
						}
					});
				}
				else{
					alert(Errorx);	
				}	
			}
			else{
				$("#lineaot").css("border","1px solid red");	
			}	
		}
		else{
			$("#ot").css("border","1px solid red");
		}
	    e.preventDefault();	//STOP default action
	});
	$("#ProcesarNotaCompra").submit(function(e)
	{
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		addLoading();
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{
				if (data != "") {
					clearLoading();
					alert("Orden Procesada!!");
					$("#estado").val("PROCESADA");
					$("#co").hide();
				};
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
			}
		});
	    e.preventDefault();	//STOP default action
	});

	

	$("#GuardarFac").submit(function(e)
	{
		$("#cod_pro_f").css("border","1px solid #CCC");			
		$("#nit_f").css("border","1px solid #CCC");			
		$("#nombre_f").css("border","1px solid #CCC");
		$("#fecha_fac").css("border","1px solid #CCC");
		$("#nro_f").css("border","1px solid #CCC");
		$("#nro_aut_f").css("border","1px solid #CCC");


		if ($("#cod_pro_f").val() != "")
			if ($("#nit_f").val() != "")
				if ($("#nombre_f").val() != "")
					if ($("#fecha_fac").val() != "")
						if ($("#nro_f").val() != "")
							if ($("#nro_aut_f").val() != "") {
								addLoading();
								var postData = $(this).serializeArray();
								var formURL = $(this).attr("action");
								$.ajax(
								{
									url : formURL + "?n=" + $("#nro").val(),
									type: "POST",
									data : postData,
									success:function(data, textStatus, jqXHR) 
									{
										if (data == "") {
											clearLoading();
											document.getElementById("DetalleNotaFactura").style.display = "none";
										};
									},
									error: function(jqXHR, textStatus, errorThrown) 
									{
									}
								});
							}
							else
								$("#nro_aut_f").css("border","1px solid red");			
						else
							$("#nro_f").css("border","1px solid red");			
					else
						$("#fecha_fac").css("border","1px solid red");			
				else
					$("#nit_f").css("border","1px solid red");			
			else
				$("#nit_f").css("border","1px solid red");			
		else
			$("#cod_pro_f").css("border","1px solid red");			
		
	    e.preventDefault();	//STOP default action
	});		
	$("#BuscarProd").submit(function(e)
	{
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		addLoading();
		$.ajax(
		{
			url : formURL + "?n=" + $("#nro").val(),
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{
				$("#DetalleNotaCompraPro").html(data);
				clearLoading();
				
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
			}
		});
	    e.preventDefault();	//STOP default action
	});		

	$("#BuscarOT").submit(function(e)
	{
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		addLoading();
		$.ajax(
		{
			url : formURL ,
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{
				$("#DetalleBusquedaOT2").html(data);
				clearLoading();
				
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
			}
		});
	    e.preventDefault();	//STOP default action
	});		
	$("#AddDetalle").submit(function(e)
	{
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		var Errorx = "";
		for (var i = 0; i < 50; i++) {
			if ($("#" + i + "0-x").val() == 1) {
				Errorx = "Campos Invalidos";
			};	
		};
		for (var i = 0; i < 50; i++) {
			if (($("#" + i + "5-p").val() == "") && ($("#" + i + "0-p").val() != "")) {
				Errorx = "Cantidades Vacias";
			};	
			if (($("#" + i + "6-p").val() == "") && ($("#" + i + "0-p").val() != "")) {
				Errorx = "Precio Unitario Vacios";
			};	
		};
		for (var i = 0; i < 50; i++) {
			var k = 0;
			for (var j = 0; j < 50; j++) {
				if (($("#" + i + "0-p").val() == $("#" + j + "0-p").val()) && ($("#" + i + "0-p").val() != "")) {
					k++;
					if (k > 1) {
						$("#" + i + "0-p").css("border","1px solid red");
						$("#" + i + "0-p").css("background","red");
						$("#" + i + "0-p").css("color","white");
						$("#" + i + "0-p").css("font-weight","bold");

						$("#" + j + "0-p").css("border","1px solid red");
						$("#" + j + "0-p").css("background","red");
						$("#" + j + "0-p").css("color","white");
						$("#" + j + "0-p").css("font-weight","bold");

						Errorx = "Campos Duplicados";

						j = 50;
						i = 50;

					};

				}
			}
		};

		if (Errorx == "") {
			addLoading();
			$.ajax(
			{
				url : formURL + "?n=" + $("#nro").val(),
				type: "POST",
				data : postData,
				success:function(data, textStatus, jqXHR) 
				{
					clearLoading();
					if ($("#totalcompra").val() != $("#totalventa").val()) {
						alert("Productos guardados con exito!!\n\n Advertencia!!!\n Monto total no cuadra con lista de total de precios de productos !!\n\n");
					}else{
						alert("Productos guardados con exito!!");
					};
					document.getElementById("DetalleNotaCompra").style.display = "NONE";
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});
		}else{
			alert(Errorx);
		};

		e.preventDefault();	//STOP default action
	});		
	$("#AgregarDetalles").click(function(){
		if ($("#nro").val() != "") {
			$("#DetalleNotaCompra").show();
			$("#estado").val("INGRESADA");
		}else{
			alert("Necesita crear la Nota de Compra");
		};
	})
	$("#AddProveedor").click(function(){
			$("#ABMProveedor").show();
	})
	$("#AddProducto").click(function(){
			$("#ABMProducto").show();
	})
});
function cerrar(id){
	document.getElementById(id).style.display = "NONE";
}
function enviop(id){
	document.getElementById("DetalleNotaProducto").style.display = "none";
	document.getElementById(codP + "0-p").value = id;
	traerProducto(codP);

}
function enviop2(id){
	addLoading();
	$(document).ready(function(){
			$.ajax(
			{
				url : "funciones2.php?f=buscarProducto2&id=" + id,
				type: "POST",
				success:function(data, textStatus, jqXHR) 
				{
					if (data != "NONE"){
						$("#DetalleProducto").html(data);
						document.getElementById("DetalleProducto").style.display = "block";
						clearLoading();
					}else{
					};
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});			
	});
}
function abrirPago(id){
	addLoading();
	$(document).ready(function(){
			$("#pagopersona").val("");
			$("#saldopersona").val("");
			$("#totalpago").val("");	
			$.ajax(
			{
				url : "funciones2.php?f=buscarPago&id=" + id,
				type: "POST",
				success:function(data, textStatus, jqXHR) 
				{
					if (data != ""){
						$("#PagoProducto").show();
						var datosx2 = data.split("-");
						$("#totalpagonro").val(datosx2[0]);
						$("#totalpago").val(datosx2[1]);	
						clearLoading();
					}else{
					};
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});			
	});
}
function envioot(id){
	document.getElementById("DetalleBusquedaOT").style.display = "none";
	document.getElementById("ot").value = id;
	cargarLineaOT(id);

}
function abrirB(id){
	document.getElementById("DetalleNotaProducto").style.display = "block";
	codP = id;
}
function abrirBOT(){
	document.getElementById("DetalleBusquedaOT").style.display = "block";
}
function calcularsemiTotal(id){
	var sum = 0;	
	var mul = 0;
	if ((document.getElementById(id + "5-p").value > 0)&&(document.getElementById(id + "6-p").value > 0)) {
		mul = document.getElementById(id + "5-p").value * document.getElementById(id + "6-p").value;
		document.getElementById(id + "7-p").value = mul.toFixed(2);
		for (var i = 0; i < 50; i++) {
			if (document.getElementById(i + "7-p").value != "") {
				sum = parseFloat(sum + parseFloat(document.getElementById(i + "7-p").value));
			};
		};
		document.getElementById("totalventa").value = sum.toFixed(2);
	};
}

function IrEditar(x){
	location.href = "actualizar-compras.php?o=" + x;
}

function IrProcesar(x){
	location.href = "procesar-orden.php?o=" + x;
}

function IrVer(x){
	location.href = "ver-orden.php?o=" + x;
}

function traerProducto(id){
	$(document).ready(function(){
		$("#" + id + "0-p").css("border","1px solid #CCC");
		if ($("#" + id + "0-p").val() != "") {
			$.ajax(
			{
				url : "funciones2.php?f=buscarProducto&id=" + $("#" + id + "0-p").val(),
				type: "POST",
				success:function(data, textStatus, jqXHR) 
				{
					if (data != "NONE"){
						var res = data.split(",");
						$("#" + id + "0-p").css("border","1px solid #CCC");
						$("#" + id + "0-p").css("background","white");
						$("#" + id + "0-p").css("color","#767676");
						$("#" + id + "0-p").css("font-weight","normal");
						$("#" + id + "0-p").val(res[0]); 
						$("#" + id + "1-p").val(res[1]); 
						$("#" + id + "2-p").val(res[2]); 
						$("#" + id + "3-p").val(res[3]); 
						$("#" + id + "4-p").val(res[4]); 
						$("#" + id + "0-x").val(0);
					}else{
						$("#" + id + "0-p").css("border","1px solid red");
						$("#" + id + "0-p").css("background","red");
						$("#" + id + "0-p").css("color","white");
						$("#" + id + "0-p").css("font-weight","bold");
						$("#" + id + "0-x").val(1);
					};
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});			
		}else{
			$("#" + id + "0-p").css("border","1px solid #CCC");
			$("#" + id + "0-p").css("background","white");
			$("#" + id + "0-p").css("color","#767676");
			$("#" + id + "0-p").css("font-weight","normal");

			$("#" + id + "0-p").val("");	
			$("#" + id + "1-p").val("");	
			$("#" + id + "2-p").val("");	
			$("#" + id + "3-p").val("");	
			$("#" + id + "4-p").val("");	
			$("#" + id + "5-p").val("");	
			$("#" + id + "6-p").val("");	
			$("#" + id + "7-p").val("");	
			$("#" + id + "0-x").val("");	
		};
	});
}
function traerProductoSector(idu){
	$(document).ready(function(){
			document.getElementById("SectorProducto").style.display = "block";
			$.ajax(
			{
				url : "funciones2.php?f=buscarProducto3&idub=" + idu,
				type: "POST",
				success:function(data, textStatus, jqXHR) 
				{
					if (data != "NONE")
						$('#SectorProducto').html(data);
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});			
	});
}

function cambiarub(sec){
	addLoading();
	$(document).ready(function(){
			$.ajax(
			{
				url : "funciones2.php?f=cargarub&sec=" + sec,
				type: "POST",
				success:function(data, textStatus, jqXHR) 
				{
					if (data != "NONE")
						$('#selectubicacion').html(data);
					clearLoading();
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});			
	});
}

function cargarLineaOT(x){
	$(document).ready(function(){
			$.ajax(
			{
				url : "funciones2.php?f=buscarLineaOT&id=" + x,
				type: "POST",
				success:function(data, textStatus, jqXHR) 
				{
					if (data != ""){
						$("#lineaot").html(data);
					}else{
					};
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});			
	});	
}
function cargarLineaOTDetalle(x){
	$(document).ready(function(){
			$.ajax(
			{
				url : "funciones2.php?f=buscarLineaOTDetalle&id=" + x,
				type: "POST",
				success:function(data, textStatus, jqXHR) 
				{
					if (data != ""){
						$("#ListaNotaCompraTabla").html(data);
					}else{
					};
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});			
	});	
}

function eliminaro(o){
	if (confirm("¿Realmente Desea Eliminar Esta Orden?")) {
		location.href = "funciones2.php?f=eliminarOrden&o=" + o;
	};
}

function validarEmpresa(){
	var sw = true;
		document.getElementById("empresa").style.border = "1px solid #ccc";
		document.getElementById("nit").style.border = "1px solid #ccc";
	if(document.getElementById("empresa").value == ""){
		sw = false;
		document.getElementById("empresa").style.border = "1px solid red";
	}
	if(document.getElementById("nit").value == ""){
		sw = false;
		document.getElementById("nit").style.border = "1px solid red";
	}
	return sw;
}
function validarMarca(){
	var sw = true;
		document.getElementById("marca").style.border = "1px solid #ccc";
		document.getElementById("abreviatura").style.border = "1px solid #ccc";
	if(document.getElementById("marca").value == ""){
		sw = false;
		document.getElementById("marca").style.border = "1px solid red";
	}
	if(document.getElementById("abreviatura").value == ""){
		sw = false;
		document.getElementById("abreviatura").style.border = "1px solid red";
	}
	return sw;
}
function validarLocal(){
	var sw = true;
		document.getElementById("local").style.border = "1px solid #ccc";
	if(document.getElementById("local").value == ""){
		sw = false;
		document.getElementById("local").style.border = "1px solid red";
	}
	return sw;
}
function validarBodega(){
	var sw = true;
		document.getElementById("bodega").style.border = "1px solid #ccc";
	if(document.getElementById("bodega").value == ""){
		sw = false;
		document.getElementById("bodega").style.border = "1px solid red";
	}
	return sw;
}
function validarLinea(){
	var sw = true;
		document.getElementById("linea").style.border = "1px solid #ccc";
	if(document.getElementById("linea").value == ""){
		sw = false;
		document.getElementById("linea").style.border = "1px solid red";
	}
	return sw;
}
function validarGrupo(){
	var sw = true;
		document.getElementById("grupo").style.border = "1px solid #ccc";
	if(document.getElementById("grupo").value == ""){
		sw = false;
		document.getElementById("grupo").style.border = "1px solid red";
	}
	return sw;
}
function validarFamilia(){
	var sw = true;
		document.getElementById("familia").style.border = "1px solid #ccc";
	if(document.getElementById("familia").value == ""){
		sw = false;
		document.getElementById("familia").style.border = "1px solid red";
	}
	return sw;
}
function validarProveedor(){
	var sw = true;
		document.getElementById("nit").style.border = "1px solid #ccc";
		document.getElementById("proveedor").style.border = "1px solid #ccc";
	if(document.getElementById("nit").value == ""){
		sw = false;
		document.getElementById("nit").style.border = "1px solid red";
	}
	if(document.getElementById("proveedor").value == ""){
		sw = false;
		document.getElementById("proveedor").style.border = "1px solid red";
	}
	return sw;
}
function validarSector(){
	var sw = true;
		document.getElementById("sector").style.border = "1px solid #ccc";
	if(document.getElementById("sector").value == ""){
		sw = false;
		document.getElementById("sector").style.border = "1px solid red";
	}
	return sw;
}
function validarUbicacion(){
	var sw = true;
		document.getElementById("anaquel").style.border = "1px solid #ccc";
		document.getElementById("pasillo").style.border = "1px solid #ccc";
		document.getElementById("estante").style.border = "1px solid #ccc";
	if(document.getElementById("anaquel").value == ""){
		sw = false;
		document.getElementById("anaquel").style.border = "1px solid red";
	}
	if(document.getElementById("pasillo").value == ""){
		sw = false;
		document.getElementById("pasillo").style.border = "1px solid red";
	}
	if(document.getElementById("estante").value == ""){
		sw = false;
		document.getElementById("estante").style.border = "1px solid red";
	}
	return sw;
}
function validarTasa(){
	var sw = true;
		document.getElementById("fecha").style.border = "1px solid #ccc";
		document.getElementById("moneda").style.border = "1px solid #ccc";
		document.getElementById("tcompra").style.border = "1px solid #ccc";
		document.getElementById("tventa").style.border = "1px solid #ccc";
	if(document.getElementById("fecha").value == ""){
		sw = false;
		document.getElementById("fecha").style.border = "1px solid red";
	}
	if(document.getElementById("moneda").value == ""){
		sw = false;
		document.getElementById("moneda").style.border = "1px solid red";
	}
	if(document.getElementById("tcompra").value == ""){
		sw = false;
		document.getElementById("tcompra").style.border = "1px solid red";
	}
	if(document.getElementById("tventa").value == ""){
		sw = false;
		document.getElementById("tventa").style.border = "1px solid red";
	}
	return sw;
}
function validarProducto(){
	var sw = true;
		document.getElementById("codigo").style.border = "1px solid #ccc";
		document.getElementById("producto").style.border = "1px solid #ccc";
		document.getElementById("prefijo").style.border = "1px solid #ccc";
		document.getElementById("modelo").style.border = "1px solid #ccc";
		document.getElementById("serializado").style.border = "1px solid #ccc";
		document.getElementById("unidadpackage").style.border = "1px solid #ccc";
		document.getElementById("precio").style.border = "1px solid #ccc";
	if(document.getElementById("producto").value == ""){
		sw = false;
		document.getElementById("producto").style.border = "1px solid red";
	}
	if(document.getElementById("prefijo").value == ""){
		sw = false;
		document.getElementById("prefijo").style.border = "1px solid red";
	}
	if(document.getElementById("modelo").value == ""){
		sw = false;
		document.getElementById("modelo").style.border = "1px solid red";
	}
	if(document.getElementById("serializado").value == ""){
		sw = false;
		document.getElementById("serializado").style.border = "1px solid red";
	}
	if(document.getElementById("unidadpackage").value == ""){
		sw = false;
		document.getElementById("unidadpackage").style.border = "1px solid red";
	}
	if(document.getElementById("precio").value == ""){
		sw = false;
		document.getElementById("precio").style.border = "1px solid red";
	}
	if(document.getElementById("codigo").value == ""){
		sw = false;
		document.getElementById("codigo").style.border = "1px solid red";
	}
	return sw;
}

function eliminarx(id){
	if (confirm("Realmente Desea Eliminar Este Item?")) {
		location.href = "?idx=" + id;
	};
}

function validarpasar(cant){
	var piezas = document.getElementById('piezas').value;
	document.getElementById('piezaspasar').style.border = "1px solid #CCC";
	valsec = 0;
	if(parseInt(cant) > parseInt(piezas)){
		valsec = 1;
		document.getElementById('piezaspasar').style.border = "1px solid red";
	}
	if(parseInt(cant) == 0){
		valsec = 1;
		document.getElementById('piezaspasar').style.border = "1px solid red";
	}
}


function camsec()
{
	var sw = false;
	if(valsec == 0){
		sw = true;
	}else{
		alert("Cantidad Incorrecta!!")
	}
	return sw;
}