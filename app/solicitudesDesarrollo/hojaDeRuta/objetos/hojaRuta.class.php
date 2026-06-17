<?
Class hojaRuta{	
  var $unidad;
  var $correlativoServicio;
  var $numeroMedio;
  var $horaInicioReal;
  var $horaTerminoReal;



	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setCorrelativoServicio($correlativoServicio){
		$this->correlativoServicio = $correlativoServicio;
	}

	function setNumeroMedio($numeroMedio){
		$this->numeroMedio = $numeroMedio;
	}

	function setHoraInicioReal($horaInicioReal){
		$this->horaInicioReal = $horaInicioReal;
	}

	function setHoraTerminoReal($horaTerminoReal){
		$this->horaTerminoReal = $horaTerminoReal;
	}





	function getUnidad(){
		return $this->unidad;
	}

	function getCorrelativoServicio(){
		return $this->correlativoServicio;
	}

	function getNumeroMedio(){
		return $this->numeroMedio;
	}

	function getHoraInicioReal(){
		return $this->horaInicioReal;
	}

	function getHoraTerminoReal(){
		return $this->horaTerminoReal;
	}


}
?>