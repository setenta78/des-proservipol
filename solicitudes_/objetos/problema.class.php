<?
Class problema{	
	var $codigo;
	var $descripcion;


	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	function getCodigo(){
		return $this->codigo;
	}
	
	function getDescripcion(){
		return $this->descripcion;
	}
		
}//end class   
?>