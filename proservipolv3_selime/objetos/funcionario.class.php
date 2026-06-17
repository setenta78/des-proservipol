<?
Class funcionario{	
	var $codigoFuncionario;
	var $apellidoPaterno;
	var $apellidoMaterno;
	var $pNombre;
	var $sNombre;
	var $grado;
	var $cargo;
	var $unidad;
	var $unidadAgregado;
	var $cuadrante;
  var $dias;
	
	var $armas 			= array();
	var $animales 		= array();
	var $accesorios 	= array();
	
	var $licenciaConducirMunicipal;
	var $licenciaSemep;
	var $tieneLicencia;
	var $archivoLicencia;
	var $rutFuncionario;
	
	var $tipoLicencia;
	
	var $descripcionLicecencia;
	
		
	function setCodigoFuncionario($codigoFuncionario){
		$this->codigoFuncionario = $codigoFuncionario;
	}
	
	function setApellidoPaterno($apellidoPaterno){
		$this->apellidoPaterno = $apellidoPaterno;
	}
	
	function setApellidoMaterno($apellidoMaterno){
		$this->apellidoMaterno = $apellidoMaterno;
	}
	
	function setPNombre($pNombre){
		$this->pNombre = $pNombre;
	}
	
	function setSNombre($sNombre){
		$this->sNombre = $sNombre;
	}
	
	function setGrado($grado){
		$this->grado = $grado;
	}
	
	function setCargo($cargo){
		$this->cargo = $cargo;
	}
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	
	function setArmas($arma){
		$this->armas[count($this->armas)] = $arma;
	}	
	
	function setAnimales($animal){
		$this->animales[count($this->animales)] = $animal;
	}	
	
	function setAccesorios($accesorio){
		$this->accesorios[count($this->accesorios)] = $accesorio;
	}	
	
	function setUnidadAgregado($unidadAgregado){
		$this->unidadAgregado = $unidadAgregado;
	}
	
	function setCuadrante($cuadrante){
		$this->cuadrante = $cuadrante;
	}
	
	function setLicenciaConducirMunicipal($licenciaConducirMunicipal){
		$this->licenciaConducirMunicipal = $licenciaConducirMunicipal;
	}
	
	function setLicenciaSemep($licenciaSemep){
		$this->licenciaSemep = $licenciaSemep;
	}
	
	
	function setTieneLicencia($tieneLicencia){
		$this->tieneLicencia = $tieneLicencia;
	}
	
	function setArchivoLicencia($archivoLicencia){
		$this->archivoLicencia = $archivoLicencia;
	}
    
   function setDias($dias){
		$this->dias = $dias;
	}

  function setRutFuncionario($rutFuncionario){
		$this->rutFuncionario = $rutFuncionario;
	}

  function setTipoLicencia($tipoLicencia){
		$this->tipoLicencia = $tipoLicencia;
	}
	
	  function setDescripcionLicencia($descripcionLicencia){
		$this->descripcionLicencia = $descripcionLicencia;
	}


	function getCodigoFuncionario(){
		return $this->codigoFuncionario;
	}
	
	function getApellidoPaterno(){
		return $this->apellidoPaterno;
	}
	
	function getApellidoMaterno(){
		return $this->apellidoMaterno;
	}
	
	function getPNombre(){
		return $this->pNombre;
	}
	
	function getSNombre(){
		return $this->sNombre;
	}
	
	function getGrado(){
		return $this->grado;
	}
	
	function getCargo(){
		return $this->cargo;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
	function getUnidadAgregado(){
		return $this->unidadAgregado;
	}
		
	function getCuadrante(){
		return $this->cuadrante;
	}
	
	
	function getNombreCompleto(){
		return $this->apellidoPaterno . " " . $this->apellidoMaterno . ", " . $this->pNombre;
	}
	
	
	
	function getArmas($numero){
		return $this->armas[$numero];
	}
	
	function getAnimales($numero){
		return $this->animales[$numero];
	}	
	
	function getAccesorios($numero){
		return $this->accesorios[$numero];
	}	
	
	
	function getCantidadArmas(){
		return count($this->armas);
	}
	
	function getCantidadAnimales(){
		return count($this->animales);
	}
	
	function getCantidadAccesorios(){
		return count($this->accesorios);
	}
	
	
	function getLicenciaConducirMunicipal(){
		return $this->licenciaConducirMunicipal;
	}
	
	function getLicenciaSemep(){
		return $this->licenciaSemep;
	}
	
	function getTieneLicencia(){
		return $this->tieneLicencia;
	}
	
	function getArchivoLicencia(){
		return $this->archivoLicencia;
	}
	
    function getDias(){
		return $this->dias;
	}
	
	function getRutFuncionario(){
		return $this->rutFuncionario;
	}
	
	function getTipoLicencia(){
		return $this->tipoLicencia;
	}
	
	function getDescripcionLicencia(){
		return $this->descripcionLicencia;
	}
	
}//end class   
?>