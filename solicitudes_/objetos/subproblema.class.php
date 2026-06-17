<?
Class subproblema{	
	var $problema;
	var $codigo;
	var $descripcion;

	function setProblemaSolicitud($problema){
		$this->problemaSolicitud = $problema;
	}
			
	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	
	function getProblemaSolicitud(){
		return $this->problemaSolicitud;
	}
	
	function getCodigo(){
		return $this->codigo;
	}
	
	function getDescripcion(){
		return $this->descripcion;
	}
	
	
}//end class   
?>