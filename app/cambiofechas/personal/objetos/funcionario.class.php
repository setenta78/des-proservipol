<?

Class funcionario{	
	var $codigoFuncionario;
	var $apellidoPaterno;
	var $apellidoMaterno;
	var $pNombre;
	var $sNombre;
	var $grado;
	var $unidad;
		
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
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
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
	
	function getNombreCompleto(){
		return $this->apellidoPaterno . " " . $this->apellidoMaterno . ", " . $this->pNombre;
	}
	
	function getGrado(){
		return $this->grado;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
}
?>