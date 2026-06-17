<?
Class fallaPospuesta{
	
	var $codigo_vehiculo;
	var $correlativo_estado;
	var $fecha_Desde;


	function setCodigo_Vehiculo($codigo_vehiculo){
		$this->codigo_vehiculo = $codigo_vehiculo;
	}
	
	function setCorrelativo_Estado($correlativo_estado){
		$this->correlativo_estado = $correlativo_estado;
	}
	
	function setFecha_Desde($fecha_Desde){
		$this->fecha_Desde = $fecha_Desde;
	}
	
	function getCodigo_Vehiculo(){
		return $this->codigo_vehiculo;
	}
	
	function getCorrelativo_Estado(){
		return $this->correlativo_estado;
	}
	
	function getFecha_Desde(){
		return $this->fecha_Desde;
	}
	
}//end class   
?>