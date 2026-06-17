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
	var $simccars	   = array();
	
	var $licenciaConducirMunicipal;
	var $licenciaSemep;
	var $tieneLicencia;
	var $archivoLicencia;
	var $rutFuncionario;
	
	var $tipoLicencia;
	var $descripcionLicencia;
	
	var $perfil;
	var $fechaCreacion;
	
	var $capturaDioscar;
	var $mesDioscar;
	
  var $mesDatos;
	
		
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
	
	function setSimccars($simccar){
		$this->simccars[count($this->simccars)] = $simccar;
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
 
 	
	function setPerfil($perfil){
		$this->perfil = $perfil;
	}
		
	function setFechaCreacion($fechaCreacion){
		$this->fechaCreacion = $fechaCreacion;
	}
	
	function setCapturaDioscar($capturaDioscar){
		$this->capturaDioscar = $capturaDioscar;
	}
	
	function setMesDioscar($mesDioscar){
		$this->mesDioscar = $mesDioscar;
	}
	
	function setMesdatos($mesDatos){
		$this->mesDatos = $mesDatos;
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
	
	function getSimccars($numero){
		return $this->simccars[$numero];
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
	
	function getCantidadSimccars(){
		return count($this->simccars);
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
	
		function getPerfil(){
		return $this->perfil;
	}
	
	function getFechaCreacion(){
		return $this->fechaCreacion;
	}
	
	function getCapturaDioscar(){
		return $this->capturaDioscar;
	}
	
	function getMesDioscar(){
		return $this->mesDioscar;
	}
	
	function getMesDatos(){
		return $this->mesDatos;
	}
	
}//end class   
?>