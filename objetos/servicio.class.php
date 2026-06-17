<?
Class servicio {
	var $unidad;
	var $correlativo;
	var $codigoServicio;
	var $servicioExtraordinario;
	var $descripcionOtroServicioExtraordinario;
	var $fecha;
	var $horaInicio;
	var $horaTermino;
	var $observaciones;
	var $cantidadFuncionarios;
	var $cantidadVehiculos;
	var $fechaValidacion;
	var $cantidadAnimales;
	var $destino;
	var $mediosDeVigilancia = array();
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setCorrelativo($correlativo){
		$this->correlativo = $correlativo;
	}
	
	function setTipoServicio($codigoServicio){
		$this->codigoServicio = $codigoServicio;
	}
	
	function setServicioExtraordinario($servicioExtraordinario){
		$this->servicioExtraordinario = $servicioExtraordinario;
	}
	
	function setDescripcionServicioOtroExtraordinario($descripcionOtroServicioExtraordinario){
		$this->descripcionOtroServicioExtraordinario = $descripcionOtroServicioExtraordinario;
	}
	
	function setFecha($fecha){
		$this->fecha = $fecha;
	}
	
	function setHoraInicio($horaInicio){
		$this->horaInicio = $horaInicio;
	}
	
	function setHoraTermino($horaTermino){
		$this->horaTermino = $horaTermino;
	}
	
	function setObservaciones($observaciones){
		$this->observaciones = $observaciones;
	}
	
	function setMedioDeVigilancia($medioDeVigilancia){
		$this->mediosDeVigilancia[count($this->mediosDeVigilancia)] = $medioDeVigilancia;
	}
	
	function setCantidadFuncionarios($cantidadFuncionarios){
		$this->cantidadFuncionarios = $cantidadFuncionarios;
	}
	
	function setCantidadVehiculos($cantidadVehiculos){
		$this->cantidadVehiculos = $cantidadVehiculos;
	}
	
	function setFechaValidacion($fechaValidacion){
		$this->fechaValidacion = $fechaValidacion;
	}
	
	function setCantidadAnimales($cantidadAnimales){
		$this->cantidadAnimales = $cantidadAnimales;
	}

	function setDestino($destino){
		$this->destino = $destino;
	}

	function getUnidad(){
		return $this->unidad;
	}
	
	function getCorrelativo(){
		return $this->correlativo;
	}
	
	function getTipoServicio(){
		return $this->codigoServicio;
	}
	
	function getServicioExtraordinario(){
		return $this->servicioExtraordinario;
	}
	
	function getDescripcionServicioOtroExtraordinario(){
		return $this->descripcionOtroServicioExtraordinario;
	}
	
	function getFecha(){
		return $this->fecha;
	}
  
	function getHoraInicio(){
		return $this->horaInicio;
	}
	
	function getHoraTermino(){
		return $this->horaTermino;
	}
	
	function getObservaciones(){
		return $this->observaciones;
	}
	
	function getMedioDeVigilancia($numero){
		return $this->mediosDeVigilancia[$numero];
	}
	
	function getCantidadDeMediosDeVigilancia(){
		return count($this->mediosDeVigilancia);
	}
  
	function getCantidadFuncionarios(){
		return $this->cantidadFuncionarios;
	}
  
	function getCantidadVehiculos(){
		return $this->cantidadVehiculos;
	}
	
	function getFechaValidacion(){
		return $this->fechaValidacion;
	}
	
	function getDestino(){
		return $this->destino;
	}

	function getCantidadAnimales(){
		return $this->cantidadAnimales;
	}
	
}//end class
?>