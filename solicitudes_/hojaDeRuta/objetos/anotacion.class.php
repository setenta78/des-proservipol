<?
Class anotacion{	
  var $hojaRuta;
  var $idAnotacion;
  var $factor;
  var $descripcionFactor;
  var $horaInicio;
  var $horaTermino;
  var $cuadrante;
  var $descripcioncuadrante;
  var $otraUnidad;
  var $descripcionOtraUnidad;


	function setHojaRuta($hojaRuta){
		$this->hojaRuta = $hojaRuta;
	}
	
	function setIdAnotacion($idAnotacion){
		$this->idAnotacion = $idAnotacion;
	}

	function setFactor($factor){
		$this->factor = $factor;
	}

	function setDescripcionFactor($descripcionFactor){
		$this->descripcionFactor = $descripcionFactor;
	}

	function setHoraInicio($horaInicio){
		$this->horaInicio = $horaInicio;
	}

	function setHoraTermino($horaTermino){
		$this->horaTermino = $horaTermino;
	}

	function setCuadrante($cuadrante){
		$this->cuadrante = $cuadrante;
	}

	function setDescripcioncuadrante($descripcioncuadrante){
		$this->descripcioncuadrante = $descripcioncuadrante;
	}

	function setOtraUnidad($otraUnidad){
		$this->otraUnidad = $otraUnidad;
	}

	function setDescripcionOtraUnidad($descripcionOtraUnidad){
		$this->descripcionOtraUnidad = $descripcionOtraUnidad;
	}




	function getHojaRuta(){
		return $this->hojaRuta;
	}

	function getIdAnotacion(){
		return $this->idAnotacion;
	}

	function getFactor(){
		return $this->factor;
	}

	function getDescripcionFactor(){
		return $this->descripcionFactor;
	}


	function getHoraInicio(){
		return $this->horaInicio;
	}

	function getHoraTermino(){
		return $this->horaTermino;
	}

	function getCuadrante(){
		return $this->cuadrante;
	}

	function getDescripcioncuadrante(){
		return $this->descripcioncuadrante;
	}

	function getOtraUnidad(){
		return $this->otraUnidad;
	}

	function getDescripcionOtraUnidad(){
		return $this->descripcionOtraUnidad;
	}

}
?>