<?
Class vehiculo{	
	var $codigoVehiculo;
	var $tipoVehiculo;
	var $modeloVehiculo;
	var $estadoVehiculo;
	var $patente;
	var $numeroInstitucional;
	var $procedenciaVehiculo;
	var $unidad;
	var $documentoEstado;
	var $numeroBCU;
	var $ultimoKilometraje;
	var $unidadAgregado;
	var $lugarReparacion;
  var $seccion; //Variable agregada el 05-05-2015
  var $annoFabricacion;
  var $validaAnnoFabricacion;
  var $tipoFallaVehiculo;

	function setCodigoVehiculo($codigoVehiculo){
		$this->codigoVehiculo = $codigoVehiculo;
	}
	
	function setTipoVehiculo($tipoVehiculo){
		$this->tipoVehiculo = $tipoVehiculo;
	}
	
	function setModeloVehiculo($modeloVehiculo){
		$this->modeloVehiculo = $modeloVehiculo;
	}
	
	function setEstadoVehiculo($estadoVehiculo){
		$this->estadoVehiculo = $estadoVehiculo;
	}
	
	function setPatente($patente){
		$this->patente = $patente;
	}
	
	function setNumeroInstitucional($numeroInstitucional){
		$this->numeroInstitucional = $numeroInstitucional;
	}
	
	function setProcedencia($procedenciaVehiculo){
		$this->procedenciaVehiculo = $procedenciaVehiculo;
	}
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setDocumentoEstado($documentoEstado){
		$this->documentoEstado = $documentoEstado;
	}              
	
	function setNumeroBCU($numeroBCU){
		$this->numeroBCU = $numeroBCU;
	}
	
	function setUltimoKilometraje($ultimoKilometraje){
		$this->ultimoKilometraje = $ultimoKilometraje;
	}
	
	function setUnidadAgregado($unidadAgregado){
		$this->unidadAgregado = $unidadAgregado;
	}
	
	function setLugarReparacion($lugarReparacion){
		$this->lugarReparacion = $lugarReparacion;
	}
	
	//Funcion agregada el 05-05-2015
	function setSeccion($seccion){
	     $this->seccion = $seccion;
	}
	
	function setAnnoFabricacion($annoFabricacion){
		$this->annoFabricacion = $annoFabricacion;
	}
	
	function setValidaAnnoFabricacion($validaAnnoFabricacion){
		$this->validaAnnoFabricacion= $validaAnnoFabricacion;
	}
	
	function setTipoFallaVehiculo($tipoFallaVehiculo){
		$this->tipoFallaVehiculo = $tipoFallaVehiculo;
	}
	
	function getCodigoVehiculo(){
		return $this->codigoVehiculo;
	}
	
	function getTipoVehiculo(){
		return $this->tipoVehiculo;
	}
	
	function getModeloVehiculo(){
		return $this->modeloVehiculo;
	}
	
	function getEstadoVehiculo(){
		return $this->estadoVehiculo;
	}
	
	function getPatente(){
		return $this->patente;
	}
	
	function getNumeroInstitucional(){
		return $this->numeroInstitucional;
	}
	
	function getProcedencia(){
		return $this->procedenciaVehiculo;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
	function getDocumentoEstado(){
		return $this->documentoEstado;
	}
	
	function getNumeroBCU(){
		return $this->numeroBCU;
	}
	
	function getUltimoKilometraje(){
		return $this->ultimoKilometraje;
	}
	
	function getUnidadAgregado(){
		return $this->unidadAgregado;
	}
	
	function getLugarReparacion(){
		return $this->lugarReparacion;
	}
	
	//Funcion agregada el 05-05-2015
	function getSeccion(){
		return $this->seccion;
	}
	
	function getAnnoFabricacion(){
		return $this->annoFabricacion;
	}
	
	function getValidaAnnoFabricacion(){
		return $this->validaAnnoFabricacion;
	}
	
	function getTipoFallaVehiculo(){
		return $this->tipoFallaVehiculo;
	}

}//end class   
?>