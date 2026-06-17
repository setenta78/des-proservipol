<?
Class factor{	
	var $codigo;
	var $descripcion;
	var $abreviatura;

	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	function setAbreviatura($abreviatura){
		$this->abreviatura = $abreviatura;
	}
	
	
	function getCodigo(){
		return $this->codigo;
	}
	
	function getDescripcion(){
		return $this->descripcion;
	}
	
	function getAbreviatura(){
		return $this->abreviatura;
	}
	
}//end class   
?>