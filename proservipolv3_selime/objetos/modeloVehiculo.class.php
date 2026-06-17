<?
Class modeloVehiculo{	
	var $marcaVehiculo;
	var $codigo;
	var $descripcion;

	function setMarca($marcaVehiculo){
		$this->marcaVehiculo = $marcaVehiculo;
	}
			
	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	
	function getMarca(){
		return $this->marcaVehiculo;
	}
	
	function getCodigo(){
		return $this->codigo;
	}
	
	function getDescripcion(){
		return $this->descripcion;
	}
	
	
}//end class   
?>