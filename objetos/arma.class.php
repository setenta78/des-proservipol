<?
Class arma{
	var $codigo;
	var $tipo;
	var $modelo;
	var $estado;
	var $unidad;
	var $numeroSerie;
	var $unidadAgregado;
	var $seccion;
	
	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	function setModelo($modelo){
		$this->modelo = $modelo;
	}
	
	function setEstado($estado){
		$this->estado = $estado;
	}
	
	function setNumeroSerie($numeroSerie){
		$this->numeroSerie = $numeroSerie;
	}

	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setNumeroBCU($numeroBCU){
		$this->numeroBCU = $numeroBCU;
	}
	
	function setUnidadAgregado($unidadAgregado){
		$this->unidadAgregado = $unidadAgregado;
	}
	
	function setSeccion($seccion){
	     $this->seccion = $seccion;
	}
	
	function getCodigo(){
		return $this->codigo;
	}
	
	function getTipo(){
		return $this->tipo;
	}
	
	function getModelo(){
		return $this->modelo;
	}
	
	function getEstado(){
		return $this->estado;
	}
	
	function getNumeroSerie(){
		return $this->numeroSerie;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
	function getNumeroBCU(){
		return $this->numeroBCU;
	}	
	
	function getUnidadAgregado(){
		return $this->unidadAgregado;
	}
	
	function getSeccion(){
		return $this->seccion;
	}
}//end class   
?>