<?
Class vehiculosUnidad {
	var $unidad;
	var $tipoVehiculo;
	var $cantidadVehiculos;
	var $cantidadActivos;
	var $cantidadMantencion;
	var $cantidadReparacion;
	var $cantidadProcesoBaja;
	var $cantidadTribunal;
		
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setTipoVehiculo($tipoVehiculo){
		$this->tipoVehiculo = $tipoVehiculo;
	}
	
	function setCantidadVehiculos($cantidadVehiculos){
		$this->cantidadVehiculos = $cantidadVehiculos;
	}
	
	function setCantidadActivos($cantidadActivos){
		$this->cantidadActivos = $cantidadActivos;
	}
	
	function setCantidadMantencion($cantidadMantencion){
		$this->cantidadMantencion = $cantidadMantencion;
	}
	
	function setCantidadReparacion($cantidadReparacion){
		$this->cantidadReparacion = $cantidadReparacion;
	}
	
	function setCantidadProcesoBaja($cantidadProcesoBaja){
		$this->cantidadProcesoBaja = $cantidadProcesoBaja;
	}
	
	function setCantidadTribunal($cantidadTribunal){
		$this->cantidadTribunal = $cantidadTribunal;
	}

	function getUnidad(){
		return $this->unidad;
	}
	
	function getTipoVehiculo(){
		return $this->tipoVehiculo;
	}
	
	function getCantidadVehiculos(){
		return $this->cantidadVehiculos;
	}
	
	function getCantidadActivos(){
		return $this->cantidadActivos;
	}
	
	function getCantidadMantencion(){
		return $this->cantidadMantencion;
	}
	
	function getCantidadReparacion(){
		return $this->cantidadReparacion;
	}
	
	function getCantidadProcesoBaja(){
		return $this->cantidadProcesoBaja;
	}
	
	function getCantidadTribunal(){
		return $this->cantidadTribunal;
	}
	
	
}//end class   
?>