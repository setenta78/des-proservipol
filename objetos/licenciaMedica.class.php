<?
Class licenciaMedica{	
	var $codigoFuncionario;
  var $rutFuncionario;
	var $color;
	var $folio;
	var $unidad;
	var $fecha1;
	var $fecha2;
	var $dias;
	var $rutHijo;
	var $fecha3;
	var $tipoLicencia;
	var $recuperacion;
	var $invalidez;
	var $tipoReposo;
	var $lugarReposo;
	var $rutProfesional;
	var $especialidad;
	var $tipoProfesional;
	var $atencion;
	var $ip;
	var $archivoLicenciaMedica;
	var $usuarioProservipol;
	var $fechaInicioReal;
	var $fechaTermino;
	var $fechaTerminoReal;
	var $correlativo;
	var $descripcionLicencia;
	var $fechaIngreso;
	var $estadoLicencia;
	var $fechaTerminoInicial;
	var $fechaRegistro;
	var $codigoSelime;
	var $fueraPlazo;

			
	function setCodigoFuncionario($codigoFuncionario){
		$this->codigoFuncionario = $codigoFuncionario;
	}
		
	function setArchivoLicenciaMedica($archivoLicenciaMedica){
		$this->archivoLicenciaMedica = $archivoLicenciaMedica;
	}
	
	function setRutFuncionario($rutFuncionario){
		$this->rutFuncionario = $rutFuncionario;
	}
	
	function setColor($color){
		$this->color = $color;
	}
	
	function setFolio($folio){
		$this->folio = $folio;
	}
	
	function setFecha1($fecha1){
		$this->fecha1 = $fecha1;
	}
	
	function setDias($dias){
		$this->dias = $dias;
	}
	
	function setRutHijo($rutHijo){
		$this->rutHijo = $rutHijo;
	}
	
	function setFecha2($fecha2){
		$this->fecha2 = $fecha2;
	}
	
	function setFecha3($fecha3){
		$this->fecha3 = $fecha3;
	}
	
	function setTipoLicencia($tipoLicencia){
		$this->tipoLicencia = $tipoLicencia;
	}
	
	function setRecuperacion($recuperacion){
		$this->recuperacion = $recuperacion;
	}
	
	function setInvalidez($invalidez){
		$this->invalidez = $invalidez;
	}
	
	function setTipoReposo($tipoReposo){
		$this->tipoReposo = $tipoReposo;
	}
	
	function setLugarReposo($lugarReposo){
		$this->lugarReposo = $lugarReposo;
	}
	
	function setRutProfesional($rutProfesional){
		$this->rutProfesional = $rutProfesional;
	}
	
	function setUsuarioProservipol($usuarioProservipol){
		$this->usuarioProservipol = $usuarioProservipol;
	}
	
	function setTipoProfesional($tipoProfesional){
		$this->tipoProfesional = $tipoProfesional;
	}
	
	function setEspecialidad($especialidad){
		$this->especialidad = $especialidad;
	}
	
	function setAtencion($atencion){
		$this->atencion = $atencion;
	}
	
	function setIp($ip){
		$this->ip = $ip;
	}
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}	
	
	function setFechaInicioReal($fechaInicioReal){
		$this->fechaInicioReal = $fechaInicioReal;
	}
	
	function setFechaTermino($fechaTermino){
		$this->fechaTermino = $fechaTermino;
	}
	
	function setFechaTerminoReal($fechaTerminoReal){
		$this->fechaTerminoReal = $fechaTerminoReal;
	}
	
	function setCorrelativo($correlativo){
		$this->correlativo = $correlativo;
	}
	
	function setDescripcionLicencia($descripcionLicencia){
		$this->descripcionLicencia = $descripcionLicencia;
	}
	
	function setFechaIngreso($fechaIngreso){
		$this->fechaIngreso = $fechaIngreso;
	}
	
	function setEstadoLicencia($estadoLicencia){
		$this->estadoLicencia = $estadoLicencia;
	}
	
	function setFechaTerminoInicial($fechaTerminoInicial){
		$this->fechaTerminoInicial = $fechaTerminoInicial;
	}
	
	function setFechaRegistro($fechaRegistro){
		$this->fechaRegistro = $fechaRegistro;
	}
	
	function setCodigoSelime($codigoSelime){
		$this->codigoSelime = $codigoSelime;
	}

	function setFueraPlazo($fueraPlazo){
		$this->fueraPlazo = $fueraPlazo;
	}

	function getCodigoFuncionario(){
		return $this->codigoFuncionario;
	}
				
	function getArchivoLicenciaMedica(){
		return $this->archivoLicenciaMedica;
	}
	
	function getRutFuncionario(){
		return $this->rutFuncionario;
	}
	
	function getColor(){
		return $this->color;
	}
	
	function getFolio(){
		return $this->folio;
	}
	
	function getFecha1(){
		return $this->fecha1;
	}
	
	function getDias(){
		return $this->dias;
	}
	
	function getRutHijo(){
		return $this->rutHijo;
	}
	
	function getFecha2(){
		return $this->fecha2;
	}
	
	function getFecha3(){
		return $this->fecha3;
	}
	
	function getTipoLicencia(){
		return $this->tipoLicencia;
	}
	
	function getRecuperacion(){
		return $this->recuperacion;
	}
	
	function getInvalidez(){
		return $this->invalidez;
	}
	
	function getTipoReposo(){
		return $this->tipoReposo;
	}
	
	function getLugarReposo(){
		return $this->lugarReposo;
	}
	
	function getRutProfesional(){
		return $this->rutProfesional;
	}
	
	function getTipoProfesional(){
		return $this->tipoProfesional;
	}
	
	function getEspecialidad(){
		return $this->especialidad;
	}
	
	function getAtencion(){
		return $this->atencion;
	}
	
	function getIp(){
		return $this->ip;
	}
	
	function getUnidad(){
		return $this->unidad;
	}

	function getUsuarioProservipol(){
		return $this->usuarioProservipol;
	}

	function getFechaInicioReal(){
		return $this->fechaInicioReal;
	}
	
	function getFechaTermino(){
		return $this->fechaTermino;
	}
	
	function getFechaTerminoReal(){
		return $this->fechaTerminoReal;
	}
		
	function getCorrelativo(){
		return $this->correlativo;
	}
	
	function getDescripcionLicencia(){
		return $this->descripcionLicencia;
	}
	
	function getFechaIngreso(){
		return $this->fechaIngreso;
	}
	
  function getEstadoLicencia(){
		return $this->estadoLicencia;
	}
		
	function getFechaTerminoInicial(){
		return $this->fechaTerminoInicial;
	}
	
	function getFechaRegistro(){
		return $this->fechaRegistro;
	}
	
	function getCodigoSelime(){
		return $this->codigoSelime;
	}
	
	function getFueraPlazo(){
		return $this->fueraPlazo;
	}
}//end class
?>