<?
Class accesorioAsignado {	
	var $tipoAccesorio;
	var $cantidad;
			
	function setTipoAccesorio($tipoAccesorio){
		$this->tipoAccesorio = $tipoAccesorio;
	}
	
	function setCantidad($cantidad){
		$this->cantidad = $cantidad;
	}
		
	
	function getTipoAccesorio(){
		return $this->tipoAccesorio;
	}

	function getCantidad(){
		return $this->cantidad;
	}
	
}//end class   
?>