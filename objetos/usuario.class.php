<?
Class usuario {
	var $unidad;
	var $funcionario;
	var $userName;
	var $clave;
	var $perfil;
	var $permisoActualizar;
	var $fechaLimite;
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
			
	function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}
	
	function setUserName($userName){
		$this->userName = $userName;
	}
	
	function setClave($clave){
		$this->clave = $clave;
	}
	
	function setPerfil($perfil){
		$this->perfil = $perfil;
	}
	
	function setPermisoActualizar($permisoActualizar){
		$this->permisoActualizar = $permisoActualizar;
	}
	
	function setFechaLimite($fechaLimite){
		$this->fechaLimite = $fechaLimite;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
	function getFuncionario(){
		return $this->funcionario;
	}

	function getUserName(){
		return $this->userName;
	}
	
	function getClave(){
		return $this->clave;
	}
	
	function getPerfil(){
		return $this->perfil;
	}
	
	function getPermisoActualizar(){
		return $this->permisoActualizar;
	}
	
	function getFechaLimite(){
		return $this->fechaLimite;
	}
	
}//end class   
?>