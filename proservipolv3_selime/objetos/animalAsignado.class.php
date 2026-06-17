<?
Class animalAsignado {	
	var $tipoAnimal;
	var $numero;
	var $responsable;
	var $cantidad;
			
	function setTipoAnimal($tipoAnimal){
		$this->tipoAnimal = $tipoAnimal;
	}
			
	function setNumero($numero){
		$this->numero = $numero;
	}
	
	function setResponsable($responsable){
		$this->responsable = $responsable;
	}
	
	function setCantidad($cantidad){
		$this->cantidad = $cantidad;
	}
	
		
	
	function getTipoAnimal(){
		return $this->tipoAnimal;
	}
			
	function getNumero(){
		return $this->numero;
	}
	
	function getResponsable(){
		return $this->responsable;
	}
	
	function getCantidad(){
		return $this->cantidad;
	}
	
}//end class   
?>