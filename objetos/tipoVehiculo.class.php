<?
Class tipoVehiculo{	
	var $codigo;
	var $descripcion;
	var $indicaKM;
			
	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	function setIndicaKM($indicaKM){
		$this->indicaKM = $indicaKM;
	}
	
	function getCodigo(){
		return $this->codigo;
	}
	
	function getDescripcion(){
		return $this->descripcion;
	}
	
	function getIndicaKM(){
		return $this->indicaKM;
	}
}//end class   
?>