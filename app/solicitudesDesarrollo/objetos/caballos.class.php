<?
Class caballo{	
	var $codigoCaballo;
	var $nombreCaballo;
	var $unidad;
  var $numeroBCU;
  var $fechaNacimiento;
	var $raza;
	var $color;
	var $pelaje;
	var $sexo;
	var $estadoVehiculo;
	var $unidadAgregado;
	var $tipoAnimal;
	var $verifica;


	function setCodigoCaballo($codigoCaballo){
		$this->codigoCaballo = $codigoCaballo;
	}
	
	function setNombreCaballo($nombreCaballo){
		$this->nombreCaballo = $nombreCaballo;
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
	
	function setEstadoVehiculo($estadoVehiculo){
		$this->estadoVehiculo = $estadoVehiculo;
	}
	
	function setTipoAnimal($tipoAnimal){
		$this->tipoAnimal = $tipoAnimal;
	}
	
	function setVerifica($verifica){
		$this->verifica = $verifica;
	}
	
	function getCodigoCaballo(){
		return $this->codigoCaballo;
	}
	
	function getNombreCaballo(){
		return $this->nombreCaballo;
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
	
	function getEstadoVehiculo(){
		return $this->estadoVehiculo;
	}
	
	function getTipoAnimal(){
		return $this->tipoAnimal;
	}
	
		function getVerifica(){
		return $this->verifica;
	}
	
}//end class   
?>