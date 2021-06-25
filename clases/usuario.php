<?php

include_once ("mysql.class.php");


class Usuario{
	private $user    = ""; 
	private $name    = "";
	private $Apellido ="";
	private $IdTrabajador = "";
	private $Rol =""; 
	private $contraseha= ""; 
	private $oficina    = ""; 
	private $profile    = ""; 
	private $codigo = 0;
	private $codSalon = 0;
	private $codTipoUsuario = 0;
	private $salon = "";
	private $logueado = false;
	private $correo = "";
    private $foto = "";
    private $sucursal = "";
	private $roles= array();
	
	public function IniciarSesion($usuario, $contraseha){
		

		$consulta="
		select
			per.Nombres,
			per.Apellido_Paterno,
			per.Apellido_Materno,
			tr.usuario,
			tr.contrasenha,
			tr.Empleado_Id
		 from empleado tr inner join persona per on tr.Ci_Persona = per.Ci 
		 	where usuario = '$usuario' and contrasenha = '$contraseha'";
		// select * from personas per where (per.Usuario = '$usuario') and (per.Contrasenha = '$contraseha');
		
		/*select *
		from trabajador tj 
		inner join persona per 
		on tj.Ci_Identidad = per.Ci_Identidad 
		where tj.Usuario = '$usuario' and tj.contraseha = '$contraseha'";*/

		
		
		$db = new MySQL();
		if ($db->Error()) $db->Kill();
		if (! $db->Query($consulta)) $db->Kill();
		$db->MoveFirst();
		
		while (! $db->EndOfSeek()) {
			$row = $db->Row();
			$this->logueado=true;	
			$this->name=$row->Nombres;
			$this->Apellido=$row->Apellido_Paterno;
			$this->IdTrabajador=$row->Empleado_Id;
			// $this->Rol=$row->id_Role;
			$this->user=$row->usuario;
			$this->contraseha=$row->contrasenha;
			return true;			
		}
		return false;		
	}
	
	
	public function EstaLogueado(){
		return $this->logueado;
	}

	public function obtenerUsuario(){
		return $this->user;
	}
	
	public function obtenerOficina(){
		return $this->oficina;
	}
	public function obtenerApellido(){
		return $this->Apellido;
	}
	public function obtenerNombre(){
		return $this->name;
	}
	
	public function obtenerPerfil(){
		return $this->profile;
	}
	
	public function obtenerCodigo(){
		return $this->codigo;
	}
	public function obtenerIdTrabajador(){
		return $this->IdTrabajador;
	}
	public function obtenerRol(){
		return $this->Rol;
	}
	
    public function obtenerFoto(){
		return $this->foto;
	}
	public function obtenerPassword(){
		return $this->contraseha;
	}
	public function obtenercodTipoUsuario(){
		return $this->codTipoUsuario;
	}
	public function obtenerSucursal(){
		return $this->sucursal;
	}





	
	//--------------------------------------------------------------------------------------------------------------
	function CambiarContrasenia($usuario, $contrasenia){
		$consulta="update trabajador set contraseha='$contrasenia'.".".where Usuario='$usuario'";	
		//echo $consulta."br";
		$db = new MySQL();
		if ($db->Error()) $db->Kill();
		$db->ThrowExceptions = true;
		
		if (! $db->TransactionBegin()) $db->Kill();
			$success = true;
			$sql = $consulta;
		if (! $db->Query($sql)) $success = false;
		
		if ($success) {
			if (! $db->TransactionEnd()) {
				$db->Kill();
			}		
			return true;		
		} else { 	
			if (! $db->TransactionRollback()) {
				$db->Kill();
				return false;
			}
		}
		return true;
	}


	public function getUserData($codUsuario) {
        $db = new MySQL();

        if ($db->Error()) {
            $db->Kill();
            return false;
        } else {
            $data = 'SELECT * FROM usuario WHERE codUsuario = \''.$codUsuario.'\'';
            if ($db->HasRecords($data)) {
                $db->Query($data);
                return $db;
            } else {
                return false;
            }
        }
    }

   
    
}
?>