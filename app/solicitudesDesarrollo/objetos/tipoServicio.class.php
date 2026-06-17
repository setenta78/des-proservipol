<?
Class tipoServicio{	
	var $codigo;
	var $descripcion;
	var $tipo;
	var $activo;

	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
			
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	function setTipo($tipo){
		$this->tipo = $tipo;
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
	
	function getTipo(){
		return $this->tipo;
	}
		
	function getActivo(){
		return $this->activo;
	}
	
	
}//end class   
?>