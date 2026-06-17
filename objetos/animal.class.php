<?
Class animal{	
	var $codigoAnimal;
	var $nombreAnimal;
	var $unidad;
  var $numeroBCU;
  var $fechaNacimiento;
	var $raza;
	var $color;
	var $pelaje;
	var $sexo;
	var $estadoAnimal;
	var $unidadAgregado;
	var $tipoAnimal;
	var $seccion;
	var $verifica;
	
	function setCodigoAnimal($codigoAnimal){
		$this->codigoAnimal = $codigoAnimal;
	}
	
	function setNombreAnimal($nombreAnimal){
		$this->nombreAnimal = $nombreAnimal;
	}
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setNumeroBCU($numeroBCU){
		$this->numeroBCU = $numeroBCU;
	}
	
	function setFechaNacimiento($fechaNacimiento){
		$this->fechaNacimiento = $fechaNacimiento;
	}
	
	function setRaza($raza){
		$this->raza = $raza;
	}
	
	function setColor($color){
		$this->color = $color;
	}
	
	function setPelaje($pelaje){
		$this->pelaje = $pelaje;
	}
	
	function setSexo($sexo){
		$this->sexo = $sexo;
	}
	
	function setUnidadAgregado($unidadAgregado){
		$this->unidadAgregado = $unidadAgregado;
	}
	
	function setEstadoAnimal($estadoAnimal){
		$this->estadoAnimal = $estadoAnimal;
	}
	
	function setTipoAnimal($tipoAnimal){
		$this->tipoAnimal = $tipoAnimal;
	}
	
	function setSeccion($seccion){
	     $this->seccion = $seccion;
	}
		
	function setVerifica($verifica){
		$this->verifica = $verifica;
	}
	
	function getCodigoAnimal(){
		return $this->codigoAnimal;
	}
	
	function getNombreAnimal(){
		return $this->nombreAnimal;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
	function getNumeroBCU(){
		return $this->numeroBCU;
	}
	
	function getFechaNacimiento(){
		return $this->fechaNacimiento;
	}
	
	function getRaza(){
		return $this->raza;
	}
	
	function getColor(){
		return $this->color;
	}
	
	function getPelaje(){
		return $this->pelaje;
	}
	
	function getSexo(){
		return $this->sexo;
	}
	
	function getUnidadAgregado(){
		return $this->unidadAgregado;
	}
	
	function getEstadoAnimal(){
		return $this->estadoAnimal;
	}
	
	function getTipoAnimal(){
		return $this->tipoAnimal;
	}
	
	function getSeccion(){
		return $this->seccion;
	}
	
	function getVerifica(){
		return $this->verifica;
	}
	
}//end class   
?>