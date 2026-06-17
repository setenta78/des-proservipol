<?
Class licenciaConducirMunicipal {
	var $funcionario;
	var $numero;
	var $comuna;
	var $fechaUltimoControl;
	var $fechaProximoControl;
	var $observaciones;
		
	var $clases = array();
	var $restricciones = array();
		
	function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}
	
	function setNumero($numero){
		$this->numero = $numero;
	}

	function setComuna($comuna){
		$this->comuna = $comuna;
	}
	
	function setFechaUltimoControl($fechaUltimoControl){
		$this->fechaUltimoControl = $fechaUltimoControl;
	}
			
	function setFechaProximoControl($fechaProximoControl){
		$this->fechaProximoControl = $fechaProximoControl;
	}
	
	function setObservaciones($observaciones){
		$this->observaciones = $observaciones;
	}
	
	function setClases($clase){
		$this->clases[count($this->clases)] = $clase;
	}
	
	function setRestricciones($restriccion){
		$this->restricciones[count($this->restricciones)] = $restriccion;
	}

	
	function getFuncionario(){
		return $this->funcionario;
	}
	
	function getNumero(){
		return $this->numero;
	}

	function getComuna(){
		return $this->comuna;
	}
	
	function getFechaUltimoControl(){
		return $this->fechaUltimoControl;
	}
			
	function getFechaProximoControl(){
		return $this->fechaProximoControl;
	}
	
	function getObservaciones(){
		return $this->observaciones;
	}
	
	function getClases($numero){
		return $this->clases[$numero];
	}
	
	function getRestricciones($numero){
		return $this->restricciones[$numero];
	}
	
	function getCantidadDeClases(){
		return count($this->clases); 
	}

	function getCantidadDeRestricciones(){
		return count($this->restricciones); 
	}

	
	
}//end class   
?>