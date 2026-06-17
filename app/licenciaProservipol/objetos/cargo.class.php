<?
Class cargo{	
	var $codigo;
	var $descripcion;
	var $fechaDesde;
	var $fechaHasta;
	var $cuadrante;
	var $dias;

	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	function setFechaDesde($fechaDesde){
		$this->fechaDesde = $fechaDesde;
	}
	
	function setFechaHasta($fechaHasta){
		$this->fechaHasta = $fechaHasta;
	}
	
	function setCuadrante($cuadrante){
		$this->cuadrante = $cuadrante;
	}
	
		function setDias($dias){
		$this->dias = $dias;
	}
	
	function getCodigo(){
		return $this->codigo;
	}
	
	function getDescripcion(){
		return $this->descripcion;
	}
	
	function getFechaDesde(){
		return $this->fechaDesde;
	}
	
	function getFechaHasta(){
		return $this->fechaHasta;
	}
	
	function getCuadrante(){
		return $this->cuadrante;
	}	
	
	function getDias(){
		return $this->dias;
	}
	
}//end class   
?>