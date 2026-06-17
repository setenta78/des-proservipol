<?
Class serviciosUnidad {
	var $unidad;
	var $codigoServicio;
	var $correlativo;
	var $fecha;
	var $cantidadFuncionarios;
	var $cantidadVehiculos;
	var $cantidadArmas;
	var $cantidadAnimales;
	var $cantidadAccesorios;
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setTipoServicio($codigoServicio){
		$this->codigoServicio = $codigoServicio;
	}
	
	function setCorrelativo($correlativo){
		$this->correlativo = $correlativo;
	}
	
	function setFecha($fecha){
		$this->fecha = $fecha;
	}
	
	function setCantidadFuncionarios($cantidadFuncionarios){
		$this->cantidadFuncionarios = $cantidadFuncionarios;
	}
	
	
	function setCantidadVehiculos($cantidadVehiculos){
		$this->cantidadVehiculos = $cantidadVehiculos;
	}
	
	function setCantidadArmas($cantidadArmas){
		$this->cantidadArmas = $cantidadArmas;
	}
	
	function setCantidadAnimales($cantidadAnimales){
		$this->cantidadAnimales = $cantidadAnimales;
	}
	
	function setCantidadAccesorios($cantidadAccesorios){
		$this->cantidadAccesorios = $cantidadAccesorios;
	}
	

	function getUnidad(){
		return $this->unidad;
	}
	
	function getTipoServicio(){
		return $this->codigoServicio;
	}
	
	function getCorrelativo(){
		return $this->correlativo;
	}
	
	function getFecha(){
		return $this->fecha;
	}
	
	function getCantidadFuncionarios(){
		return $this->cantidadFuncionarios;
	}
	
	function getCantidadVehiculos(){
		return $this->cantidadVehiculos;
	}
	
	function getCantidadArmas(){
		return $this->cantidadArmas;
	}
	
	function getCantidadAnimales(){
		return $this->cantidadAnimales;
	}
	
	function getCantidadAccesorios(){
		return $this->cantidadAccesorios;
	}
	
	
}//end class   
?>