<?
Class unidad {	
	var $codigoUnidad;
	var $padreUnidad;
	var $descripcionUnidad;
	var $tienePlanCuadrante;
	var $seleccionable;
	var $bloqueda;
	var $especialidad;
	var $especialidadOld;
	var $tipo;
	var $contieneHijos;
	var $unidadServicio;
	var $UnidadTipo;
	var $tipoUnidadPadre;
	var $captura;
	var $tipoUnidad;
	var $especialidadUnidad;
	
	var $cuadrantes	= array();
		
	function setCodigoUnidad($codigoUnidad){
		$this->codigoUnidad = $codigoUnidad;
	}
	
	function setPadreUnidad($padreUnidad){
		$this->padreUnidad = $padreUnidad;
	}
			
	function setDescripcionUnidad($descripcionUnidad){
		$this->descripcionUnidad = $descripcionUnidad;
	}
	
	function setTienePlanCuadrante($tienePlanCuadrante){
		$this->tienePlanCuadrante = $tienePlanCuadrante;
	}
		
	function setCuadrantes($cuadrante){
		$this->cuadrantes[count($this->cuadrantes)] = $cuadrante;
	}
	
	function setSeleccionable($seleccionable){
		$this->seleccionable = $seleccionable;
	}
	
	function setBloqueada($bloqueda){
		$this->bloqueda = $bloqueda;
	}
	
	function setEspecialidad($especialidad){
		$this->especialidad = $especialidad;
	}
	
	function setEspecialidadOld($especialidadOld){
		$this->especialidadOld = $especialidadOld;
	}
	
	function setTipoUnidad($tipo){
		$this->tipo = $tipo;
	}
	
	function setContieneHijos($contieneHijos){
		$this->contieneHijos = $contieneHijos;
	}
	
	function setUnidadServicio($unidadServicio){
		$this->unidadServicio = $unidadServicio;
	}
	
	function setUnidadTipo($UnidadTipo){
		$this->UnidadTipo = $UnidadTipo;
	}
	
	function setTipoUnidadPadre($tipoUnidadPadre){
		$this->tipoUnidadPadre = $tipoUnidadPadre;
	}
	
	function setCaptura($captura){
		$this->captura = $captura;
	}
	
	function setTipoUnidadNew($tipoUnidad){
		$this->tipoUnidad = $tipoUnidad;
	}

	function setEspecialidadUnidadNew($especialidadUnidad){
		$this->especialidadUnidad = $especialidadUnidad;
	}

	function getCodigoUnidad(){
		return $this->codigoUnidad;
	}
	
	function getPadreUnidad(){
		return $this->padreUnidad;
	}
	
	function getDescripcionUnidad(){
		return $this->descripcionUnidad;
	}
	
	function getTienePlanCuadrante(){
		return $this->tienePlanCuadrante;
	}
	
	function getCuadrantes($numero){
		return $this->cuadrantes[$numero];
	}
	
	function getCantidadCuadrantes(){
		return count($this->cuadrantes);
	}
	
	function getSeleccionable(){
		return $this->seleccionable;
	}
	
	function getBloqueada(){
		return $this->bloqueda;
	}
	
	function getEspecialidad(){
		return $this->especialidad;
	}
	
	function getEspecialidadOld(){
		return $this->especialidadOld;
	}
	
	function getTipoUnidad(){
		return $this->tipo;
	}
	
	function getContieneHijos(){
		return $this->contieneHijos;
	}
	
	function getUnidadServicio(){
		return $this->unidadServicio;
	}
	
	function getUnidadTipo(){
		return $this->UnidadTipo;
	}
	
	function getTipoUnidadPadre(){
	  return $this->tipoUnidadPadre;
	}
	
	function getCaptura(){
	  return $this->captura;
	}

	function getTipoUnidadNew(){
	  return $this->tipoUnidad;
	}

	function getEspecialidadUnidadNew(){
	  return $this->especialidadUnidad;
	}
}
?>