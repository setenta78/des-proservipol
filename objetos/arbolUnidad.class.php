<?

Class ArboUnidad{
	
	var $CodigoUnidad;
	var $NombreUnidad;
	var $CodigoPadre;
	var $CodigoTipo;
	var $Jerarquia;
	var $Especialidad;
	var $Cuadrante;
	
	function setCodigoUnidad($CodigoUnidad){
		$this->CodigoUnidad = $CodigoUnidad;
	}
	
	function setNombreUnidad($NombreUnidad){
		$this->NombreUnidad = $NombreUnidad;
	}
	
	function setCodigoPadre($CodigoPadre){
		$this->CodigoPadre = $CodigoPadre;
	}
	
	function setCodigoTipo($CodigoTipo){
		$this->CodigoTipo = $CodigoTipo;
	}
	
	function setJerarquia($Jerarquia){
		$this->Jerarquia = $Jerarquia;
	}
	
	function setEspecialidad($Especialidad){
		$this->Especialidad = $Especialidad;
	}
	
	function setCuadrante($Cuadrante){
		$this->Cuadrante = $Cuadrante;
	}

	function getCodigoUnidad(){
		return $this->CodigoUnidad;
	}
	
	function getNombreUnidad(){
		return $this->NombreUnidad;
	}
	
	function getCodigoPadre(){
		return $this->CodigoPadre;
	}
	
	function getCodigoTipo(){
		return $this->CodigoTipo;
	}
	
	function getJerarquia(){
		return $this->Jerarquia;
	}
	
	function getEspecialidad(){
		return $this->Especialidad;
	}
	
  function getCuadrante(){
		return $this->Cuadrante;
	}


}
?>