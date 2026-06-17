<?
Class medioVigilancia{
	var $vehiculo;
	var $funcionarios = array();
	var $kmInicial;
	var $kmFinal;
	var $cuadrantes = array();
	var $factor;
	var $numeroMedio;
	var $animal;
	var $tipoAnimal;
	var $unidades = array();
	
	function setVehiculo($vehiculo){
		$this->vehiculo = $vehiculo;
	}
	
	function setFuncionarios($funcionario){
		$this->funcionarios[count($this->funcionarios)] = $funcionario;
	}
	
	function setKmInicial($kmInicial){
		$this->kmInicial = $kmInicial;
	}
	
	function setKmFinal($kmFinal){
		$this->kmFinal = $kmFinal;
	}
	
	function setCuadrantes($cuadrante){
		$this->cuadrantes[count($this->cuadrantes)] = $cuadrante;
	}
	
	function setFactor($factor){
		$this->factor = $factor;
	}
	
	function setNumeroMedio($numeroMedio){
		$this->numeroMedio = $numeroMedio;
	}
	
	function setAnimal($animal){
		$this->animal = $animal;
	}
	
	function setTipoAnimal($tipoAnimal){
		$this->tipoAnimal = $tipoAnimal;
	}
	
	function setUnidades($unidad){
	    $this->unidades[count($this->unidades)] = $unidad;
	}
	
	function getVehiculo(){
		return $this->vehiculo;
	}
	
	function getFuncionarios($numero){
		return $this->funcionarios[$numero];
	}
	
	function getKmInicial(){
		return $this->kmInicial;
	}
	
	function getKmFinal(){
		return $this->kmFinal;
	}
	
	function getCuadrantes($numero){
		return $this->cuadrantes[$numero];
	}
	
	function getFactor(){
		return $this->factor;
	}
	
	function getUnidades($numero){
	    return $this->unidades[$numero];
	}
  
	function getCantidadDeFuncionarios(){
		return count($this->funcionarios);
	}
	
	function getCantidadDeCuadrantes(){
		return count($this->cuadrantes);
	}
	
	function getNumeroMedio(){
		return $this->numeroMedio;
	}
	
	function getAnimal(){
		return $this->animal;
	}
	
	function getTipoAnimal(){
		return $this->tipoAnimal;
	}
	
	function getCantidadDeUnidades(){
		return count($this->unidades);
	}

}//end class   
?>