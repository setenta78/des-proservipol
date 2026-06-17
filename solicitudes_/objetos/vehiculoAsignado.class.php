<?
Class vehiculoAsignado {	
	var $vehiculo;
	var $servicio;
	var $kmInicial;
	var $kmFinal;
	var $totalKms;
	var $ltsCombustible;
		
	function setVehiculo($vehiculo){
		$this->vehiculo = $vehiculo;
	}
			
	function setServicio($servicio){
		$this->servicio = $servicio;
	}
	
	function setKmInicial($kmInicial){
		$this->kmInicial = $kmInicial;
	}
	
	function setKmFinal($kmFinal){
		$this->kmFinal = $kmFinal;
	}
	
	function setTotalKms($totalKms){
		$this->totalKms = $totalKms;
	}
	
	function setLtsCombustible($ltsCombustible){
		$this->ltsCombustible = $ltsCombustible;
	}
	
	
	
	function getVehiculo(){
		return $this->vehiculo;
	}
			
	function getServicio(){
		return $this->servicio;
	}
	
	function getKmInicial(){
		return $this->kmInicial;
	}
	
	function getKmFinal(){
		return $this->kmFinal;
	}
	
	function getTotalKms(){
		return $this->totalKms;
	}
	
	function getLtsCombustible(){
		return $this->ltsCombustible;
	}
	
}//end class   
?>