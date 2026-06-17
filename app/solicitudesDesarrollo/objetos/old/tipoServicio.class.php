<?
Class tipoServicio{	
	var $codigo;
	var $descripcion;
	var $inicio;
	var $termino;
	var $extraordinario;
	var $administrativo;
	var $activo;

	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
			
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	function setInicio($inicio){
		$this->inicio = $inicio;
	}
	
	function setTermino($termino){
		$this->termino = $termino;
	}
	
	function setExtraordinario($extraordinario){
		$this->extraordinario = $extraordinario;
	}
	
	function setAdministrativo($administrativo){
		$this->administrativo = $administrativo;
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
	
	function getInicio(){
		return $this->inicio;
	}
	
	function getTermino(){
		return $this->termino;
	}
	
	function getExtraordinario(){
		return $this->extraordinario;
	}
	
	function getAdministrativo(){
		return $this->administrativo;
	}
	
	function getActivo(){
		return $this->activo;
	}
	
	
}//end class   
?>