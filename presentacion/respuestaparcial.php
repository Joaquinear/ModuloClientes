<?php



require_once "../clases/Plan.php";
require_once "../clases/Cuota.php";
require_once "../clases/Persona.php";
require_once "../clases/usuario.php";
require_once "../clases/TraerLotes.php";
require_once "../clases/Venta.php";
$operacion=$_GET["operacion"];






if($operacion=="registrarPlan"){
    
    
    $codUsuario=@$_POST["codUsuario"];
    $codPaquete=@$_POST["codPaquete"];
  
    $codtipoPlan=$_POST['ddsuscripcion'];
    $codCantidadCuota=$_POST['ddcuotas'];
    $precio=$_POST['txtprecio'];

    if ($codtipoPlan==1) {
        $cantidadCuotas=1;
    }else
    {
        $cantidadCuotas=$codCantidadCuota;
    }

    $iPlan = new Plan();
    $resultado= $iPlan->RegistrarPlan($codUsuario,$codPaquete,$codtipoPlan,$cantidadCuotas,$precio);

    echo $resultado;

  
}



if($operacion=="RegistrarPago"){
    
    
    $codCuota=@$_POST["codCuota"];
    $monto=@$_POST["monto"];
    $codPlan=@$_POST["codPlan"];

    $iCuota = new Cuota();
    $resultado= $iCuota->RegistrarPago($codPlan,$codCuota,$monto);

    echo $resultado;

  
}



if($operacion=="CrearUsuario"){
    
    
    $cipersona=@$_POST["txtci"];
    $primernombre=@$_POST["txtnombre1primer"];
    $segundonombre=@$_POST["txtnombre2donombre"];
    $apellidopaterno=@$_POST["txtpaterno"];
    $apellidomaterno=@$_POST["txtmaterno"];
    //$telefonocel=@$_POST["txtcelular"];
    //$telefonofijo = @$_POST["txtFijo"];

   // $fecha_inicio=@$_POST["FechaInicio"];
    $rol=@$_POST["txtrol"];
    $usuario=@$_POST["txtusuario"];
    $contrasena=@$_POST["txtpassword2"];
    //$cipersona1=@$_POST["txtci"];


    $iPersona = new Persona();
    $resultado= $iPersona->NuevaPersona($cipersona,$primernombre,$segundonombre,$apellidopaterno,$apellidomaterno,$telefonocel,$telefonofijo);
    //$resultado2= $iPersona->CrearUsuario($fecha_inicio,$rol,$usuario,$contrasena,$cipersona1);
   
    echo $resultado2;
  
}

if($operacion=="EditarUsuario"){
    
    
    $nombre=@$_POST["txtnombre"];
    $paterno=@$_POST["txtpaterno"];
    $materno=@$_POST["txtmaterno"];
    $ci=@$_POST["txtci"];
    $correo=@$_POST["txtcorreo"];
    $direccion = @$_POST["txtdireccion"];
   

    $iPersona = new Persona();
    $resultado2= $iPersona->EditarCliente($ci,$nombre,$paterno,$materno,$correo,$direccion);
   
    echo $resultado2;
  
}

if($operacion=="CrearCliente"){
    
    
    $ci1=@$_POST["txtCi"];
    $PrimerNombre=@$_POST["txtPrimerNombre"];
    $SegundoNombre=@$_POST["txtSegundoNombre"];
    $ApellidoPaterno=@$_POST["txtApellidoPaterno"];
    $ApellidoMaterno=@$_POST["txtApellidoMaterno"];
    $TelefonoCelular=@$_POST["txtTelefonoCelular"];
    $TelefonoFijo=@$_POST["txtTelefonoFijo"];
    $ci2 = @$_POST["txtCi"];    
    $FechaReg=@$_POST["txtFechaReg"];
    $Comentario=@$_POST["txtComentario"];


    $iPersona = new Persona();
    $resultado= $iPersona->NuevaPersona($ci1,$PrimerNombre,$SegundoNombre,$ApellidoPaterno,$ApellidoMaterno,$TelefonoCelular,$TelefonoFijo);
    $resultado2= $iPersona->CrearCliente($FechaReg,$Comentario,$ci2);
   
    echo $resultado2;
  
}

if($operacion=="CrearReserva"){
    
    
    $estadoRev=@$_POST["txtEstado"];
    $FechaInicioRev=@$_POST["dateFechaInicio"];
    $FechaFinRev=@$_POST["dateFechaFin"];
    $MontoRev=@$_POST["txtReservaMonto"];
    $TipoMonedaRev=@$_POST["txtTipoMoneda"];
    $IdLoteRev=@$_POST["txtIDLote"];
    $IdTrabajadorRev=@$_POST["codigousuario"];
    $IdClienteRev=@$_POST["txtIdCliente"];

    $IdLoteRev1 = @$_POST["txtIDLote"];    
    $Id_Estado_LoteRev=2;
    


    $iPersona = new Persona();
    $resultado= $iPersona->CrearReserva($estadoRev,$FechaInicioRev,$FechaFinRev,$MontoRev,$TipoMonedaRev,$IdLoteRev,$IdTrabajadorRev,$IdClienteRev);
    $resultado2= $iPersona->CambiarEstadoLote($IdLoteRev1,$Id_Estado_LoteRev);
   
    echo $resultado2;
  
}

if($operacion=="CrearVenta"){
    
    $tipoPago = $_POST['ddTipoPago'];
    $idLote = $_POST['txtIDLote_V'];
    $codTrabajador = $_POST['codigousuario_V'];
    $idCliente = $_POST['txtIdCliente_V'];
    
    $iPersona = new Persona();
    
    if($tipoPago==1)//contado
    {
        $fechaInicio = date('y-m-d');
        $fechaFin = $_POST['dateFechaFin_V'];
        $precioLote = $_POST['txtPrecioLote_V'];
        $moneda = $_POST['txtTipoMoneda_V'];
        $plazo = $_POST['txtplazo'];
        if($moneda=='Bolivianos')
        {
            $precioLote = $precioLote * 6.96;
        }
        $estadoPlanPago = 1;
        $gestion = date('Y');
        $estadoLoteVendido = 3;
        //guardo lote vendido
        $idLoteVendido = $iPersona->guardarLoteVendido($fechaInicio,$idLote,$idCliente,$codTrabajador,$estadoLoteVendido);
        //cambio estado lote 
        $resultado= $iPersona->CambiarEstadoLote($idLote,$estadoLoteVendido);
        //guardo plan pago
        $idPlanPago = $iPersona->guardarPlanPago($fechaInicio,$fechaFin,$gestion,$precioLote,$moneda,$tipoPago,$idLoteVendido,$idCliente,$estadoPlanPago,$plazo,$codTrabajador);
        
        //guardo contrato
        $tipoContrato = 1;
        $idContrato = $iPersona->guardarContrato($tipoContrato,$idPlanPago,$idCliente,$fechaInicio);

        //guardo cuota
        $Id_Estadocuota = 2;
        $montoRestante = $precioLote - $precioLote;
        $montoTotalAPagar = $precioLote;
        $idCuota = $iPersona->guardarCuota($fechaFin,$Id_Estadocuota,$precioLote,$montoRestante,$montoTotalAPagar,$idCliente,$idPlanPago,$codTrabajador);

        if($idCuota!="0")
        {
            echo "OK";
        }
    }
    else{
        if($tipoPago==2)//credito
        {

            $fechaInicio = $_POST['dateFechaInicio_V'];
            $fechaFin = $_POST['dateFechaFin_V'];
            $precioLote = $_POST['txtPrecioLote_V'];
            $moneda = $_POST['txtTipoMoneda_V'];
            $plazo = $_POST['txtplazo'];
            if($moneda=='Bolivianos')
            {
                $precioLote = $precioLote * 6.96;
            }
            $estadoPlanPago = 1;
            $gestion = date('Y');
            $estadoLoteVendido = 3;
            //guardo lote vendido
            $idLoteVendido = $iPersona->guardarLoteVendido($fechaInicio,$idLote,$idCliente,$codTrabajador,$estadoLoteVendido);
            //cambio estado lote 
            $resultado= $iPersona->CambiarEstadoLote($idLote,$estadoLoteVendido);
            //guardo plan pago
            $idPlanPago = $iPersona->guardarPlanPago($fechaInicio,$fechaFin,$gestion,$precioLote,$moneda,$tipoPago,$idLoteVendido,$idCliente,$estadoPlanPago,$plazo,$codTrabajador);
            
            //guardo contrato
            $tipoContrato = 1;
            $idContrato = $iPersona->guardarContrato($tipoContrato,$idPlanPago,$idCliente,$fechaInicio);
    
            //guardo cuota

            $Id_Estadocuota = 1;
            $montoCuota = $precioLote / $plazo;
            $fechaCuota = $fechaInicio;
            for($i=0;$i<$plazo;$i++)
            {
                $montoRestante = $precioLote - $montoCuota;
                $montoTotalAPagar = $precioLote;
                $precioLote = $precioLote - $montoCuota;
                $idCuota = $iPersona->guardarCuota($fechaCuota,$Id_Estadocuota,$montoCuota,$montoRestante,$montoTotalAPagar,$idCliente,$idPlanPago,$codTrabajador);
                  //sumo 1 mes
                 $fechaCuota =  date("Y-m-d",strtotime($fechaCuota."+ 1 month")); 
                  //resto 1 mes
                 // $fechaCuota =   echo date("d-m-Y",strtotime($fecha_actual."- 1 month"));
            }
           
           



    
            if($idCuota!="0")
            {
                echo "OK";
            }


        }
    }
  
    
  
}


if($operacion=="BajaCliente"){
    
    

    $ci=@$_POST["txtciBaja"];
    $idcliente=@$_POST["txtidClienteBaja"];
   

    $iPersona = new Persona();
    $resultado2= $iPersona->BajaClientes($ci);
     $resultado3= $iPersona->BajaClientePersona($ci);
   
    echo $resultado2;
  
}
if($operacion=="traerprecio"){

    $ddlotes=$_POST["ddlotes"];
    $iLotes = new TraerLotes();
    $resultado2= $iLotes->TraerLotess($ddlotes);
     
   
    echo json_encode($resultado2);
  
}

if($operacion=="CrearVenta"){
    
   
   
    $montoPagar=@$_POST["txtpreciolote"];
    $TipoVentaV=@$_POST["ddtipopagar"];
    $idLotes=@$_POST["ddlotes"];
     $txtcliente=@$_POST["txtcliente"];
 $iVenta = new Venta();

     if($TipoVentaV == "Contado")
     {
       
        
       
        $montoTotal=@$_POST["txtmontototal"];
        $plazoPagar = '0';
       $MontoInicio=@$_POST["txtmontoInicial"];
         
       $fecha_Cuota = date("y,m,d");
        $resultado3= $iVenta->CrearVenta($montoPagar,$plazoPagar,$MontoInicio,$montoTotal,$TipoVentaV,$idLotes,$txtcliente);
       $resultado2 = $iVenta->UpdateLote($idLotes);

       $resultado10= $iVenta->CrearCuota($fecha_Cuota,$MontoInicio,$montoTotal,$resultado3);
        
        
        echo $resultado10;
     }
     else
     {
        if($TipoVentaV == "Credito")
        {
            $plazoPagar=@$_POST["txtplazoADI"];
            $MontoInicio=@$_POST["txtmontoInicial"];
            $montoTotal=@$_POST["txtmontototal"];
             $resultado4= $iVenta->CrearVenta($montoPagar,$plazoPagar,$MontoInicio,$montoTotal,$TipoVentaV,$idLotes,$txtcliente);
        $resultado2 = $iVenta->UpdateLote($idLotes);
      
        for ($i=1; $i <=$plazoPagar ; $i++) { 
             $fecha_Cuota = date("y,m,d");
            $resultado10= $iVenta->CrearCuota($fecha_Cuota,$MontoInicio,$montoTotal,$resultado4);
        }
      
         echo $resultado10;
        }
     }
    
  
}

if($operacion=="TraerCuotas"){

     $idventa=$_POST["idventa"];
    $iLotes = new TraerLotes();
    $listado= $iLotes->TraerCuotas($idventa);
    if($listado->RowCount()>0){
        echo "<div id='no-more-tables'><table class='table table-bordered table-striped' id='tablaProductos'>";
        echo '<thead><tr>
                  <th>IDCUOTA</th>
                   <th>MONTO</th>
                  <th>IDVENTA</th>
                  <th>ESTADO</th>
                   
                  <th>Acción</th>
                </tr></thead><tbody>';
      
        while (! $listado->EndOfSeek()) {
      
            $row = $listado->Row();
            echo "<tr>";
            echo "<td data-title='#'>".$row->idcuota."</td>";
            echo "<td data-title='Tipo'>".$row->monto."</td>";
            echo "<td data-title='Marca'>".$row->idventa."</td>";
               if($row->estado == '0')
               { 
                $estado = "PENDIENTE";
            echo "<td data-title='Marca'>".$estado."</td>";
       }
       else{
        if($row->estado == '1')
        {
             $estado = "PAGADO";
            echo "<td data-title='Marca'>".$estado."</td>";
        }
       }

            if($row->estado == '0')
          {
           echo "<td align='left' data-title='Modificar'><button type='button' title='MODIFICAR' class='btn btn-success' onclick='PagarCuota(".$row->idcuota.",".$row->idventa.")'><span>PAGAR</span></button>";
          
            
            
        }
        }
        echo "</tr>";
        echo "</tbody></table></div>";
    }else{
        echo "No hay datos para mostrar";
    }
}
if($operacion=="PagarCuota"){
    
    

    $txtCuota=@$_POST["txtcuota"];
    $fecha_Cuota = date("y,m,d");
    $txtventas=@$_POST["txtventas"];

   $iVenta = new Venta();

   
     $resultado3= $iVenta->BajaCuota($txtCuota);

 
     $listaPaquete= $iVenta->HayCuota($txtventas);

    $listaPaquete->MoveFirst();
    while (! $listaPaquete->EndOfSeek()) {    
        $row = $listaPaquete->Row();
        if($row->hay == '0' )
        {   
            $resultado15= $iVenta->UpdateVenta($txtventas);
           
             
        }
     }
     
   
    echo $resultado15;
  
}


if($operacion=="traerCliente")
{
    $ci = $_POST['ci'];
    $iPersona = new Persona();

    $resultado = $iPersona->traerCliente($ci);
    // echo $resultado;
    // die();
    if($resultado!="0")
    {
        echo json_encode($resultado);
    }
    else
    {
        echo "0";
    }
   
}

?>
