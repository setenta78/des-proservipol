<?
Class estadoRecurso{	
	var $codigo;
	var $descripcion;
	var $fechaDesde;
	var $fechaHasta;
	var $archivo;
	var $reemplazo;
			
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
	
	function setArchivo($archivo){
		$this->archivo = $archivo;
	}
	
	function setReemplazo($reemplazo){
		$this->reemplazo = $reemplazo;
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
	
	function getArchivo(){
		return $this->archivo;
	}
	
	function getReemplazo(){
		return $this->reemplazo;
	}
	
}//end class   
?>