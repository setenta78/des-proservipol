<?
Class capacitacion{
	var $FunCodigo;
	var $FechaCapacitacion;
	var $VersionProservipol;
	var $VersionSiicge;
	var $NotaProservipol;
	var $NotaSiicge;
	var $CodigoVerificacion;
	var $TipoCapacitacion;
	
	function setFunCodigo($FunCodigo){
		$this->FunCodigo = $FunCodigo;
	}
	
	function setFechaCapacitacion($FechaCapacitacion){
		$this->FechaCapacitacion = $FechaCapacitacion;
	}
	
	function setVersionProservipol($VersionProservipol){
		$this->VersionProservipol = $VersionProservipol;
	}
	
	function setVersionSiicge($VersionSiicge){
		$this->VersionSiicge = $VersionSiicge;
	}

	function setNotaProservipol($NotaProservipol){
		$this->NotaProservipol = $NotaProservipol;
	}
	
	function setNotaSiicge($NotaSiicge){
		$this->NotaSiicge = $NotaSiicge;
	}

	function setCodigoVerificacion($CodigoVerificacion){
		$this->CodigoVerificacion = $CodigoVerificacion;
	}
	
	function setTipoCapacitacion($TipoCapacitacion){
		$this->TipoCapacitacion = $TipoCapacitacion;
	}

	function getFunCodigo(){
		return $this->FunCodigo;
	}
	
	function getFechaCapacitacion(){
		return $this->FechaCapacitacion;
	}
	
	function getVersionProservipol(){
		return $this->VersionProservipol;
	}
	
	function getVersionSiicge(){
		return $this->VersionSiicge;
	}
	
	function getNotaProservipol(){
		return $this->NotaProservipol;
	}
	
	function getNotaSiicge(){
		return $this->NotaSiicge;
	}

	function getCodigoVerificacion(){
		return $this->CodigoVerificacion;
	}
	
	function getTipoCapacitacion(){
		return $this->TipoCapacitacion;
	}
	
}//end class
?>