<?
Class comuna {	
	var $codigoComuna;
	var $descripcionComuna;

		
	function setCodigoComuna($codigoComuna){
		$this->codigoComuna = $codigoComuna;
	}
	
	function getCodigoComuna(){
		return $this->codigoComuna;
	}

	
	function setDescripcionComuna($descripcionComuna){
		$this->descripcionComuna = $descripcionComuna;
	}
	
	function getDescripcionComuna(){
		return $this->descripcionComuna;
	}
	
}//end class   
?>