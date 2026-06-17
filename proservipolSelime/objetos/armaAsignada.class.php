<?
Class armaAsignada {	
	var $tipoArma;
	var $numero;
	var $responsable;
			
	function setTipoArma($tipoArma){
		$this->tipoArma = $tipoArma;
	}
			
	function setNumero($numero){
		$this->numero = $numero;
	}
	
	function setResponsable($responsable){
		$this->responsable = $responsable;
	}
	
		
	
	function getTipoArma(){
		return $this->tipoArma;
	}
			
	function getNumero(){
		return $this->numero;
	}
	
	function getResponsable(){
		return $this->responsable;
	}
	
}//end class   
?>