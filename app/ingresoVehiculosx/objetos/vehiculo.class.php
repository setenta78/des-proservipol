<?

Class vehiculo{	
	var $codigoVehiculo;
	var $patente;
	var $bcu;
	var $numeroInstitucional;
	var $modelo;
	var $marca;
	var $tipo;
	var $estado;
	var $procedencia;
	var $anno;
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
	
	function setNumeroInstitucional($numeroInstitucional){
		$this->numeroInstitucional = $numeroInstitucional;
	}
	
	function setMarca($marca){
		$this->marca = $marca;
	}
	
	function setModelo($modelo){
		$this->modelo = $modelo;
	}
	
	function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	function setEstado($estado){
		$this->estado = $estado;
	}
	
	function setProcedencia($procedencia){
		$this->procedencia = $procedencia;
	}
	
	function setAnnoFabricacion($anno){
		$this->anno = $anno;
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

	function getNumeroInstitucional(){
		return $this->numeroInstitucional;
	}
	
	function getMarca(){
		return $this->marca;
	}

	function getModelo(){
		return $this->modelo;
	}
	
	function getTipo(){
		return $this->tipo;
	}
	
	function getEstado(){
		return $this->estado;
	}
	
	function getProcedencia(){
		return $this->procedencia;
	}
	
	function getAnnoFabricacion(){
		return $this->anno;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
}
?>