<?
Class ferper{
	var $codigoFuncionario;
  var $rutFuncionario;
	var $folio;
	var $unidad;
	var $dias;
	var $tipoPermiso;
	var $ip;
	var $archivoPermiso;
	var $usuarioProservipol;
	var $fechaInicio;
	var $fechaTermino;
	var $fechaTerminoReal;
	var $fechaRegistro;
	var $estadopermiso;

	function setCodigoFuncionario($codigoFuncionario){
		$this->codigoFuncionario = $codigoFuncionario;
	}

	function setRutFuncionario($rutFuncionario){
		$this->rutFuncionario = $rutFuncionario;
	}

	function setFolio($folio){
		$this->folio = $folio;
	}

	function setUnidad($unidad){
		$this->unidad = $unidad;
	}

	function setDias($dias){
		$this->dias = $dias;
	}
	
	function setTipoPermiso($tipoPermiso){
		$this->tipoPermiso = $tipoPermiso;
	}

	function setIp($ip){
		$this->ip = $ip;
	}

	function setArchivoPermiso($archivoPermiso){
		$this->archivoPermiso = $archivoPermiso;
	}
	
	function setUsuarioProservipol($usuarioProservipol){
		$this->usuarioProservipol = $usuarioProservipol;
	}

	function setFechaInicio($fechaInicio){
		$this->fechaInicio = $fechaInicio;
	}

	function setFechaTermino($fechaTermino){
		$this->fechaTermino = $fechaTermino;
	}

	function setFechaTerminoReal($fechaTerminoReal){
		$this->fechaTerminoReal = $fechaTerminoReal;
	}

	function setFechaRegistro($fechaRegistro){
		$this->fechaRegistro = $fechaRegistro;
	}

	function setEstadopermiso($estadopermiso){
		$this->estadopermiso = $estadopermiso;
	}

/*-----------------------------------------------------------------------------------------------*/

	function getCodigoFuncionario(){
		return $this->codigoFuncionario;
	}
	
	function getRutFuncionario(){
		return $this->rutFuncionario;
	}

	function getFolio(){
		return $this->folio;
	}

	function getUnidad(){
		return $this->unidad;
	}

	function getDias(){
		return $this->dias;
	}

	function getTipoPermiso(){
		return $this->tipoPermiso;
	}

	function getIp(){
		return $this->ip;
	}

	function getArchivoPermiso(){
		return $this->archivoPermiso;
	}

	function getUsuarioProservipol(){
		return $this->usuarioProservipol;
	}

	function getFechaInicio(){
		return $this->fechaInicio;
	}

	function getFechaTermino(){
		return $this->fechaTermino;
	}

	function getFechaTerminoReal(){
		return $this->fechaTerminoReal;
	}

	function getFechaRegistro(){
		return $this->fechaRegistro;
	}

	function getEstadopermiso(){
		return $this->estadopermiso;
	}

}//end class
?>