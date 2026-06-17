<?
Class actividadFueraCuartel{
	var $codActividadFueraCuartel;
	var $codigoFuncionario;
    var $rutFuncionario;
	var $numDocumento;
	var $unidad;
	var $dias;
	var $ip;
	var $archivo;
	var $usuarioProservipol;
	var $tipoActividad;
	var $fechaInicio;
	var $fechaInicioReal;
	var $fechaTermino;
	var $fechaTerminoReal;
	var $fechaRegistro;
	var $estado;

	function setCodActividadFueraCuartel($codActividadFueraCuartel){
		$this->codActividadFueraCuartel = $codActividadFueraCuartel;
	}

	function setCodigoFuncionario($codigoFuncionario){
		$this->codigoFuncionario = $codigoFuncionario;
	}

	function setRutFuncionario($rutFuncionario){
		$this->rutFuncionario = $rutFuncionario;
	}

	function setNumDocumento($numDocumento){
		$this->numDocumento = $numDocumento;
	}

	function setUnidad($unidad){
		$this->unidad = $unidad;
	}

	function setDias($dias){
		$this->dias = $dias;
	}
	
	function setIp($ip){
		$this->ip = $ip;
	}

	function setArchivo($archivo){
		$this->archivo = $archivo;
	}
	
	function setUsuarioProservipol($usuarioProservipol){
		$this->usuarioProservipol = $usuarioProservipol;
	}

	function setTipoActividad($tipoActividad){
		$this->tipoActividad = $tipoActividad;
	}

	function setFechaInicio($fechaInicio){
		$this->fechaInicio = $fechaInicio;
	}

	function setFechaTermino($fechaTermino){
		$this->fechaTermino = $fechaTermino;
	}
    
	function setFechaInicioReal($fechaInicioReal){
		$this->fechaInicioReal = $fechaInicioReal;
	}

	function setFechaTerminoReal($fechaTerminoReal){
		$this->fechaTerminoReal = $fechaTerminoReal;
	}

	function setFechaRegistro($fechaRegistro){
		$this->fechaRegistro = $fechaRegistro;
	}

	function setEstado($estado){
		$this->estado = $estado;
	}

/*-----------------------------------------------------------------------------------------------*/

	function getCodActividadFueraCuartel(){
		return $this->codActividadFueraCuartel;
	}

	function getCodigoFuncionario(){
		return $this->codigoFuncionario;
	}
	
	function getRutFuncionario(){
		return $this->rutFuncionario;
	}

	function getNumDocumento(){
		return $this->numDocumento;
	}

	function getUnidad(){
		return $this->unidad;
	}

	function getDias(){
		return $this->dias;
	}

	function getIp(){
		return $this->ip;
	}

	function getArchivo(){
		return $this->archivo;
	}

	function getUsuarioProservipol(){
		return $this->usuarioProservipol;
	}

	function getTipoActividad(){
		return $this->tipoActividad;
	}

	function getFechaInicio(){
		return $this->fechaInicio;
	}

	function getFechaTermino(){
		return $this->fechaTermino;
	}

	function getFechaInicioReal(){
		return $this->fechaInicioReal;
	}

	function getFechaTerminoReal(){
		return $this->fechaTerminoReal;
	}

	function getFechaRegistro(){
		return $this->fechaRegistro;
	}

	function getEstado(){
		return $this->estado;
	}

}//end class
?>