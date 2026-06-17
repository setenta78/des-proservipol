<?
Class licenciaConducirSemep {
	var $funcionario;
	var $evaluacion;
	var $fechaHabilitacion;
	var $fechaRenovacion;
	var $observaciones;
		
	var $vehiculosAutorizados = array();
	var $restricciones = array();
		
	function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}
	
	function setEvaluacion($evaluacion){
		$this->evaluacion = $evaluacion;
	}

	function setFechaHabilitacion($fechaHabilitacion){
		$this->fechaHabilitacion = $fechaHabilitacion;
	}
			
	function setFechaRenovacion($fechaRenovacion){
		$this->fechaRenovacion = $fechaRenovacion;
	}
	
	function setObservaciones($observaciones){
		$this->observaciones = $observaciones;
	}
	
	function setVehiculosAutorizados($vehiculoAutorizado){
		$this->vehiculosAutorizados[count($this->vehiculosAutorizados)] = $vehiculoAutorizado;
	}
	
	function setRestricciones($restriccion){
		$this->restricciones[count($this->restricciones)] = $restriccion;
	}

	
	function getFuncionario(){
		return $this->funcionario;
	}
	
	function getEvaluacion(){
		return $this->evaluacion;
	}

	function getFechaHabilitacion(){
		return $this->fechaHabilitacion;
	}
			
	function getFechaRenovacion(){
		return $this->fechaRenovacion;
	}
	
	function getObservaciones(){
		return $this->observaciones;
	}
	
	function getVehiculosAutorizados($numero){
		return $this->vehiculosAutorizados[$numero];
	}
	
	function getRestricciones($numero){
		return $this->restricciones[$numero];
	}
	
	function getCantidadDeVehiculosAutorizados(){
		return count($this->vehiculosAutorizados); 
	}

	function getCantidadDeRestricciones(){
		return count($this->restricciones); 
	}

	
	
}//end class   
?>