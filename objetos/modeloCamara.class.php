<?
Class modeloCamara{
	var $marca;
	var $codigo;
	var $descripcion;

	function setMarca($marca){
		$this->marca = $marca;
	}
	
	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	function getMarca(){
		return $this->marca;
	}
	
	function getCodigo(){
		return $this->codigo;
	}
	
	function getDescripcion(){
		return $this->descripcion;
	}
}
?>