<?

Class vehiculo{	
	var $codigoVehiculo;
	var $patente;
	var $bcu;
	var $modelo;
	var $tipo;
	var $unidad;
		
	function setCodigoVehiculo($codigoVehiculo){
		$this->codigoVehiculo = $codigoVehiculo;
	}
	
	function setPatente($patente){
		$this->patente = $patente;
	}

	function setBcu($bcu){
		$this->bcu = $bcu;
	}
	
	function setModelo($modelo){
		$this->modelo = $modelo;
	}
	
	function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}

	function getCodigoVehiculo(){
		return $this->codigoVehiculo;
	}
	
	function getPatente(){
		return $this->patente;
	}

	function getBcu(){
		return $this->bcu;
	}

	function getModelo(){
		return $this->modelo;
	}
	
	function getTipo(){
		return $this->tipo;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
}
?>