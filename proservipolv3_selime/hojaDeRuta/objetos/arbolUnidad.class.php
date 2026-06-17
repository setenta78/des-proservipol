<?
Class arbolUnidad{	
  var $unidad;
  var $padre;
  var $descripcion;
  var $planCuadrante;




	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setPadre($padre){
		$this->padre = $padre;
	}

	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	function setPlanCuadrante($planCuadrante){
		$this->planCuadrante = $planCuadrante;
	}




	function getUnidad(){
		return $this->unidad;
	}

	function getPadre(){
		return $this->padre;
	}

	function getDescripcion(){
		return $this->descripcion;
	}

	function getPlanCuadrante(){
		return $this->planCuadrante;
	}




}
?>