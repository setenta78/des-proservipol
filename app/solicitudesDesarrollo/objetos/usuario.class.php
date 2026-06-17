<?
Class usuario {
	var $unidad;
	var $funcionario;
	var $userName;
	var $clave;
	var $perfil;
	var $permisoActualizar;
	
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
	
	
	
}//end class   
?>