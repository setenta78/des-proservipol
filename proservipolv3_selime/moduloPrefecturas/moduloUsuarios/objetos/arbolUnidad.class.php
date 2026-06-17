<?
Class arbolUnidad{	
  var $unidad;
  var $padre;
  var $descripcion;
  var $tipoUnidad;




	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setPadre($padre){
		$this->padre = $padre;
	}

	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	function setTipoUnidad($tipoUnidad){
		$this->tipoUnidad = $tipoUnidad;
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

	function getTipoUnidad(){
		return $this->tipoUnidad;
	}


}
?>