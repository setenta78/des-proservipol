<?
Class funcionariosUnidad {
	var $unidad;
	var $grado;
	var $cantidadFuncionarios;
	var $cantidadAgregados;
		
		
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setGrado($grado){
		$this->grado = $grado;
	}
	
	function setCantidadFuncionarios($cantidadFuncionarios){
		$this->cantidadFuncionarios = $cantidadFuncionarios;
	}

	function setCantidadAgregados($cantidadAgregados){
		$this->cantidadAgregados = $cantidadAgregados;
	}
	
	

	function getUnidad(){
		return $this->unidad;
	}
	
	function getGrado(){
		return $this->grado;
	}
		
	function getCantidadFuncionarios(){
		return $this->cantidadFuncionarios;
	}
	
	function getCantidadAgregados(){
		return $this->cantidadAgregados;
	}	
	
	
}//end class   
?>