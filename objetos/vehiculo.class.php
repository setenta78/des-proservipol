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
	var $clasificacionCitacion;
	var $seccion;
	var $tipoFallaVehiculo;
	var $annoFabricacion;
	var $validaAnnoFabricacion;
	var $numeroSAP;
	var $codigoEquipo;
	var $tarjetaCombustible;

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
	
	function setClasificacionCitacion($clasificacionCitacion){
		$this->clasificacionCitacion = $clasificacionCitacion;
	}

	function setSeccion($seccion){
		$this->seccion = $seccion;
	}
	
	function setTipoFallaVehiculo($tipoFallaVehiculo){
		$this->tipoFallaVehiculo = $tipoFallaVehiculo;
	}
	
	function setAnnoFabricacion($annoFabricacion){
		$this->annoFabricacion = $annoFabricacion;
	}
	
	function setValidaAnnoFabricacion($validaAnnoFabricacion){
		$this->validaAnnoFabricacion= $validaAnnoFabricacion;
	}
	
	function setNumeroSAP($numeroSAP){
		$this->numeroSAP = $numeroSAP;
	}

	function setCodigoEquipo($codigoEquipo){
		$this->codigoEquipo = $codigoEquipo;
	}
	
	function setTarjetaCombustible($tarjetaCombustible){
		$this->tarjetaCombustible = $tarjetaCombustible;
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

	function getClasificacionCitacion(){
		return $this->clasificacionCitacion;
	}
	
	function getSeccion(){
		return $this->seccion;
	}
	
	function getTipoFallaVehiculo(){
		return $this->tipoFallaVehiculo;
	}

	function getAnnoFabricacion(){
		return $this->annoFabricacion;
	}
	
	function getValidaAnnoFabricacion(){
		return $this->validaAnnoFabricacion;
	}
	
	function getNumeroSAP(){
		return $this->numeroSAP;
	}

	function getCodigoEquipo(){
		return $this->codigoEquipo;
	}

	function getTarjetaCombustible(){
		return $this->tarjetaCombustible;
	}
}//end class
?>