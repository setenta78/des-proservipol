<?//objeto cuadrante con demanda
Class cuadrante{	
	var $codigo;
	var $descripcion;
	var $abreviatura;
	var $demanda;

	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	function setAbreviatura($abreviatura){
		$this->abreviatura = $abreviatura;
	}

	function setDemanda($demanda){
		$this->demanda = $demanda;
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

	function getDemanda(){
		return $this->demanda;
	}
	
}//end class   
?>