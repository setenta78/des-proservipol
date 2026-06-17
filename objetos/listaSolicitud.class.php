<?
Class lSolicitud{
var $codigoSolicitud;
var $unidad;
var $problema;	
var $subProblema;
var $tipoMovimiento;
var $fechaSolicitud;
var $unidadOrigen;
var $codigoProblema;
var $codigoSubProblema;
var $codigoTipoMov;

var $usuarioSolicitud;
var $grado;
var $nomCompleto;
var $perfil;

var $observacion;

var $implicado;

var $deriva;

var $identificador1;
var $identificador2;

var $identificadores;

var $secciones;	

var $diferenciaDias;	

var $movimientoTexto;

var $correlativoMov;

var $fechaInicio;

var $archivo;

var $fechaArchivo; 

function setCodigoSolicitud($codigoSolicitud){
		$this->codigoSolicitud = $codigoSolicitud;
	}
	
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setProblema($problema){
		$this->problema = $problema;
	}
	
	function setSubProblema($subProblema){
		$this->subProblema = $subProblema;
	}
	
	function setTipoMovimiento($tipoMovimiento){
		$this->tipoMovimiento = $tipoMovimiento;
	}
	
	function setFechaSolicitud($fechaSolicitud){
		$this->fechaSolicitud = $fechaSolicitud;
	}
	
	function setUnidadOrigen($unidadOrigen){
		$this->unidadOrigen = $unidadOrigen;
	}
	
	function setCodigoProblema($codigoProblema){
		$this->codigoProblema = $codigoProblema;
	}
	
	function setCodigoSubProblema($codigoSubProblema){
		$this->codigoSubProblema = $codigoSubProblema;
	}
	
	function setCodigoTipoMov($codigoTipoMov){
		$this->codigoTipoMov = $codigoTipoMov;
	}
	
	function setUsuarioSolicitud($usuarioSolicitud){
		$this->usuarioSolicitud = $usuarioSolicitud;
	}
	
	function setGrado($grado){
		$this->grado = $grado;
	}
	
	function setNomCompleto($nomCompleto){
		$this->nomCompleto = $nomCompleto;
	}
	
	function setPerfil($perfil){
		$this->perfil = $perfil;
	}
	
	function setObservacion($observacion){
		$this->observacion = $observacion;
	}
	
	function setImplicado($implicado){
		$this->implicado = $implicado;
	}
	
	function setDeriva($deriva){
		$this->deriva = $deriva;
	}
	
	function setIdentificador1($identificador1){
		$this->identificador1 = $identificador1;
	}
	
function setIdentificador2($identificador2){
		$this->identificador2 = $identificador2;
	}	
	
function setIdentificadores($identificadores){
		$this->identificadores = $identificadores;
	}	
	
function setSecciones($secciones){
		$this->secciones = $secciones;
	}		
	
function setDiferenciaDias($diferenciaDias){
		$this->diferenciaDias = $diferenciaDias;
	}	
	
	function setMovimientoTexto($movimientoTexto){
		$this->movimientoTexto = $movimientoTexto;
	}	
	
		function setCorrelativoMov($correlativoMov){
		$this->correlativoMov = $correlativoMov;
	}	
	
	function setFechaInicio($fechaInicio){
		$this->fechaInicio = $fechaInicio;
	}	
		
		function setArchivoSolicitud($archivo){
		$this->archivoSolicitud = $archivo;
	}	
	
	function setFechaArchivo($fechaArchivo){
		$this->fechaArchivo = $fechaArchivo;
	}	
	
	function getCodigoSolicitud(){
		return $this->codigoSolicitud;
	}	
	
	function getUnidad(){
		return $this->unidad;
	}	
	
	function getProblema(){
		return $this->problema;
	}	
	
	function getSubProblema(){
		return $this->subProblema;
	}	
	
	function getTipoMovimiento(){
		return $this->tipoMovimiento;
	}	
	
	function getFechaSolicitud(){
		return $this->fechaSolicitud;
	}	
	
	function getUnidadOrigen(){
		return $this->unidadOrigen;
	}	
	
	function getCodigoProblema(){
		return $this->codigoProblema;
	}	
	
	function getCodigoSubProblema(){
		return $this->codigoSubProblema;
	}	
	
	function getCodigoTipoMov(){
		return $this->codigoTipoMov;
	}	
	
	function getUsuarioSolicitud(){
		return $this->usuarioSolicitud;
	}	
	
	function getGrado(){
		return $this->grado;
	}	
	
	function getNomCompleto(){
		return $this->nomCompleto;
	}	
	
	function getPerfil(){
		return $this->perfil;
	}	
	
	function getObservacion(){
		return $this->observacion;
	}	
	
	function getImplicado(){
		return $this->implicado;
	}		
	
	function getDeriva(){
		return $this->Deriva;
	}		
	
	function getIdentificador1(){
		return $this->identificador1;
	}		
	
function getIdentificador2(){
		return $this->identificador2;
	}	
	
function getIdentificadores(){
		return $this->identificadores;
	}	
	
 function getSecciones(){
		return $this->secciones;
	}	

 function getDiferenciaDias(){
		return $this->diferenciaDias;
	}	
	
	function getMovimientoTexto(){
		return $this->movimientoTexto;
	}	
	
	function getCorrelativoMov(){
		return $this->correlativoMov;
	}			
	
	function getFechaInicio(){
		return $this->fechaInicio;
	}	
	
	function getArchivoSolicitud(){
		return $this->archivoSolicitud;
	}	
	
	function getfechaArchivo(){
		return $this->fechaArchivo;
	}	

}//end class   

?>