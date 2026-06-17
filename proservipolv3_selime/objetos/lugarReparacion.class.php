<?
Class lugarReparacion{	
	var $codigo;
	var $descripcion;
	var $activo;

	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
			
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	function setActivo($activo){
		$this->activo = activo;
	}
	
	
	
	function getCodigo(){
		return $this->codigo;
	}
			
	function getDescripcion(){
		return $this->descripcion;
	}
		
	function getActivo(){
		return $this->activo;
	}
	
	
}//end class   
?>