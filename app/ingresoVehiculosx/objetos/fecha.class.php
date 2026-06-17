<?

Class fecha{	
	var $codigoVehiculo;
	var $correlativo;
	var $estado;
	var $unidad;
	var $fechaD;
	var $fechaH;
	var $dias;	
		
	function setCodigoVehiculo($codigoVehiculo){
		$this->codigoVehiculo = $codigoVehiculo;
	}
	
	function setCorrelativo($correlativo){
		$this->correlativo = $correlativo;
	}
	
	function setEstado($estado){
		$this->estado = $estado;
	}
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setFechaD($fechaD){
		$this->fechaD = $fechaD;
	}

  function setFechaH($fechaH){
		$this->fechaH = $fechaH;
	}
	
	function setDias($dias){
		$this->dias = $dias;
	}
	
	function getCodigoVehiculo(){
		return $this->codigoVehiculo;
	}

	function getCorrelativo(){
		return $this->correlativo;
	}
	
	function getEstado(){
		return $this->estado;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
	function getFechaD(){
		return $this->fechaD;
	}
	
	function getFechaH(){
		return $this->fechaH;
	}
	
	function getDias(){
		return $this->dias;
	}
	
}
?>