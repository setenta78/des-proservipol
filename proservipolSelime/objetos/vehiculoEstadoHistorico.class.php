<?
Class vehiculoEstadoHistorico{	
	var $vehiculo;
	var $estado;
	var $unidad;
	var $fecha;
	var $documento;
	var $observaciones;
			
	function setVehiculo($vehiculo){
		$this->vehiculo = $vehiculo;
	}
	
	function setEstado($estado){
		$this->estado = $estado;
	}
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setFecha($fecha){
		$this->fecha = $fecha;
	}
	
	function setDocumento($documento){
		$this->documento = $documento;
	}
	
	function setObservaciones($observaciones){
		$this->observaciones = $observaciones;
	}
	
	
	function getVehiculo(){
		return $this->vehiculo;
	}
	
	function getEstado(){
		return $this->estado;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
	function getFecha(){
		return $this->fecha;
	}
	
	function getDocumento(){
		return $this->documento;
	}
	
	function getObservaciones(){
		return $this->observaciones;
	}
	
}//end class   
?>