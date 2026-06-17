<?
Class modeloArma{	
	var $marcaArma;
	var $codigo;
	var $descripcion;

	function setMarcaArma($marcaArma){
		$this->marcaArma = $marcaArma;
	}
			
	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	
	function getMarcaArma(){
		return $this->marcaArma;
	}
	
	function getCodigo(){
		return $this->codigo;
	}
	
	function getDescripcion(){
		return $this->descripcion;
	}
	
	
}//end class   
?>