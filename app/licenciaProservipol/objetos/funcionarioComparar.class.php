<?
Class funcionario{	
	var $codigoFuncionario;
	var $apellidoPaterno;
	var $apellidoMaterno;
	var $pNombre;
	var $sNombre;
	var $grado;
	var $observacion;

	function setCodigoFuncionario($codigoFuncionario){
		$this->codigoFuncionario = $codigoFuncionario;
	}
	
	function setApellidoPaterno($apellidoPaterno){
		$this->apellidoPaterno = $apellidoPaterno;
	}
	
	function setApellidoMaterno($apellidoMaterno){
		$this->apellidoMaterno = $apellidoMaterno;
	}
	
	function setPNombre($pNombre){
		$this->pNombre = $pNombre;
	}
	
	function setSNombre($sNombre){
		$this->sNombre = $sNombre;
	}
	
	function setGrado($grado){
		$this->grado = $grado;
	}
	
	function setObservacion($observacion){
		$this->observacion = $observacion;
	}


	function getCodigoFuncionario(){
		return $this->codigoFuncionario;
	}
	
	function getApellidoPaterno(){
		return $this->apellidoPaterno;
	}
	
	function getApellidoMaterno(){
		return $this->apellidoMaterno;
	}
	
	function getPNombre(){
		return $this->pNombre;
	}
	
	function getSNombre(){
		return $this->sNombre;
	}
	
	function getGrado(){
		return $this->grado;
	}
	
	function getObservacion(){
		return $this->observacion;
	}
	
}//end class   
?>