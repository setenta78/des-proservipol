<?

Class servicio{	
	var $unidad;
	var $correlativo;
	var $fecha;
	var $servicio;
	var $HoraInicio;
	var $HoraTermino;

  function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setCorrelativo($correlativo){
		$this->correlativo = $correlativo;
	}
	
	function setFecha($fecha){
		$this->fecha = $fecha;
	}
	
	function setTipoServicio($servicio){
		$this->servicio = $servicio;
	}
	
	function setHoraInicio($HoraInicio){
		$this->HoraInicio = $HoraInicio;
	}
	
	function setHoraTermino($HoraTermino){
		$this->HoraTermino = $HoraTermino;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
	function getCorrelativo(){
		return $this->correlativo;
	}
	
	function getFecha(){
		return $this->fecha;
	}
	
	function getTipoServicio(){
		return $this->servicio;
	}
	
	function getHoraInicio(){
		return $this->HoraInicio;
	}
	
	function getHoraTermino(){
		return $this->HoraTermino;
	}
	
}
?>