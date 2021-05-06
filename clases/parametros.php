<?php

include_once ("../clases/mysql.class.php");
include_once ("../clases/usuario.php");

class parametros{

	public $mensaje="";



         public function DropDownLotes(){
        $db = new MySQL();
        if ($db->Error()) $db->Kill();
        if (! $db->Query("SELECT * FROM lotes where baja = '0'")) $db->Kill();
        $db->MoveFirst();
        echo '<option value="">SELECCIONAR</option>';
        while (! $db->EndOfSeek()){
            $row= $db->row();
            echo "<option value='".$row->idLotes."'>".$row->nombre_Lote."</option>";
        }
    }
     public function DropDownClintes(){
        $db = new MySQL();
        if ($db->Error()) $db->Kill();
        if (! $db->Query("SELECT cli.idCliente as idcliente,per.Nombre as nombrecliente FROM cliente cli left join persona per on per.CI = cli.idPersonaC where cli.baja = '0' and per.CI = cli.idPersonaC ")) $db->Kill();
        $db->MoveFirst();
        echo '<option value="">SELECCIONAR</option>';
        while (! $db->EndOfSeek()){
            $row= $db->row();
            echo "<option value='".$row->idcliente."'>".$row->nombrecliente."</option>";
        }
    }
    
public function DropDownTipoEncuesta($codEncuesta){
    $selected="";
        $db = new MySQL();
        if ($db->Error()) $db->Kill();
        if (! $db->Query("SELECT * FROM tipoencuesta where codTipoEncuesta != 5")) $db->Kill();
         $db->MoveFirst();
        //echo '<option value="">Todas</option>';
        while (! $db->EndOfSeek()){
             $row= $db->row();
            if ($codEncuesta==$row->codTipoEncuesta) {
                $selected="selected";
            }
            else
            {
                $selected="";
            }
           
            echo "<option value='".$row->codTipoEncuesta."' $selected>".$row->nombre."</option>";
        }
        }

      

        

    public function DropDownPais(){
        $db = new MySQL();
        if ($db->Error()) $db->Kill();
        if (! $db->Query("SELECT per.Ci_Persona, concat(per.Primer_Nombre,' ',per.Segundo_Nombre,' ',per.Apellido_Paterno,' ',per.Apellido_Materno)as nombre FROM persona per inner join cliente cli on per.Id_Persona = cli.Id_Persona")) $db->Kill();
        $db->MoveFirst();
        echo '<option value="">SELECCIONAR</option>';
        while (! $db->EndOfSeek()){
            $row= $db->row();
            echo "<option value='".$row->nombre."'>".$row->nombre."</option>";
        }
    }
    public function traerRoles(){
        $db = new MySQL();
        if ($db->Error()) $db->Kill();
        if (! $db->Query("SELECT * from roles")) $db->Kill();
        $db->MoveFirst();
        echo '<option value="">SELECCIONAR</option>';
        while (! $db->EndOfSeek()){
            $row= $db->row();
            echo "<option value='".$row->Id_Role."'>".$row->Nombre_Role."</option>";
        }
    }
   
    
}
?>
