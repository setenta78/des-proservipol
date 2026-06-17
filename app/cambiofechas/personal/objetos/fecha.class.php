<?

Class fecha{	
	var $codigoFuncionario;
	var $correlativo;
	var $cargo;
	var $unidad;
	var $fechaD;
	var $fechaH;
	var $fechaLimite;
	var $dias;
	
	function setCodigoFuncionario($codigoFuncionario){
		$this->codigoFuncionario = $codigoFuncionario;
	}
	
	function setCorrelativo($correlativo){
		$this->correlativo = $correlativo;
	}
	
	function setCargo($cargo){
		$this->cargo = $cargo;
	}
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setFechaD($fechaD){
		$this->fechaD = $fechaD;
	}

  function setFechaH($fechaH){
		$this->fechaH = $fechaH;
	}
	
	function setFechaLimite($fechaLimite){
		$this->fechaLimite = $fechaLimite;
	}
	
	function setDias($dias){
		$this->dias = $dias;
	}
	
	function getCodigoFuncionario(){
		return $this->codigoFuncionario;
	}

	function getCorrelativo(){
		return $this->correlativo;
	}
	
	function getCargo(){
		return $this->cargo;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
	function getFechaD(){
		return $this->fechaD;
	}
	
	function getFechaH(){
		return $this->fechaH;
	}
	
	function getFechaLimite(){
		return $this->fechaLimite;
	}
	
	function getDias(){
		return $this->dias;
	}
	
}
?>