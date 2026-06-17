<?
Class datoUsuarioSolicitud{
var $codigoUnidad;
var $zona;
var $prefectura;
var $comisaria;
var $destacanmento;
var $funcionario;
var $nomFuncionario;
var $usuario;
var $tipoUsuario;
var $grado;

var $codigoSolicitud;
var $unidad;
//var $funcionario;	
var $problema;
var $subproblema;
var $fechaSolicitud;
var $observacion;
var $identificador1;
var $identificador2;
var $etiqueta1;
var $etiqueta2;
var $movimiento;
var $operador;
var $funcionarioDeriba;
var $tipoMovimiento;
var $fechaMovimiento;

var $codigoProblema;
var $codigoSubProblema;
var $codigoTipoMov;

var $movimientoTexto;

var $secciones;
 
function setCodigoUnidad($codigoUnidad){
		$this->codigoUnidad = $codigoUnidad;
	}
	
function setZona($zona){
		$this->zona = $zona;
	}	

function setPrefectura($prefectura){
		$this->prefectura = $prefectura;
	}

function setComisaria($comisaria){
		$this->comisaria = $comisaria;
	}		
	
function setDestacamento($destacamento){
		$this->destacamento = $destacamento;
	}
	
function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}	
	
function setNomFuncionario($nomFuncionario){
		$this->nomFuncionario = $nomFuncionario;
	}		
	
function setUsuario($usuario){
		$this->usuario = $usuario;
	}		
	
function setTipoUsuario($tipoUsuario){
		$this->tipoUsuario = $tipoUsuario;
	}		

function setGrado($grado){
		$this->grado = $grado;
	}		
	
function setCodigoSolicitud($codigoSolicitud){
		$this->codigoSolicitud = $codigoSolicitud;
	}

function setUnidad($unidad){
		$this->unidad = $unidad;
	}

//function setFuncionario($funcionario){
//		$this->funcionario = $funcionario;
//	}
	
function setProblema($problema){
		$this->problema = $problema;
	}	

 function setSubProblema($subProblema){
		$this->subProblema = $subProblema;
	}	
	
	function setFechaSolicitud($fechaSolicitud){
		$this->fechaSolicitud = $fechaSolicitud;
	}	
	
 function setObservacion($observacion){
		$this->observacion = $observacion;
	}

	function setIdentificador1($identificador1){
		$this->identificador1 = $identificador1;
	}
	
function setIdentificador2($identificador2){
		$this->identificador2 = $identificador2;
	}	
	
function setEtiqueta1($etiqueta1){
		$this->etiqueta1 = $etiqueta1;
	}
	
function setEtiqueta2($etiqueta2){
		$this->etiqueta2 = $etiqueta2;
	}		
	
function setMovimiento($movimiento){
		$this->movimiento = $movimiento;
	}		
	
function setOperador($operador){
		$this->operador = $operador;
	}
	
function setFuncionarioDeriba($funcionarioDeriba){
		$this->FuncionarioDeriba = $funcionarioDeriba;
	}		
	
function setTipoMovimiento($tipoMovimiento){
		$this->tipoMovimiento = $tipoMovimiento;
	}	
	
function setFechaMovimiento($fechaMovimiento){
		$this->fechaMovimiento = $fechaMovimiento;
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
	
function setMovimientoTexto($movimientoTexto){
		$this->movimientoTexto = $movimientoTexto;
	}		
	
function setSecciones($secciones){
		$this->secciones = $secciones;
	}				
	
function getCodigoUnidad(){
		return $this->codigoUnidad;
	}	
	
function getZona(){
		return $this->zona;
	}				
	
function getPrefectura(){
		return $this->prefectura;
	}	
	
function getComisaria(){
		return $this->comisaria;
	}		
	
function getDestacamento(){
		return $this->destacamento;
	}				

function getFuncionario(){
		return $this->funcionario;
	}	

function getNomFuncionario(){
		return $this->nomFuncionario;
	}	

function getUsuario(){
		return $this->usuario;
	}		
	
function getTipoUsuario(){
		return $this->tipoUsuario;
	}	

function getGrado(){
		return $this->grado;
	}	
	
	function getCodigoSolicitud(){
		return $this->codigoSolicitud;
	}	
	
function getUnidad(){
		return $this->unidad;
	}	
	
//function getFuncionario(){
//		return $this->funcionario;
//	}	

function getProblema(){
		return $this->problema;
	}		
	
function getSubProblema(){
		return $this->subProblema;
	}		

function getFechaSolicitud(){
		return $this->fechaSolicitud;
	}		
	
function getObservacion(){
		return $this->observacion;
	}			
	
function getIdentificador1(){
		return $this->identificador1;
	}		
	
function getIdentificador2(){
		return $this->identificador2;
	}			
	
function getEtiqueta1(){
		return $this->etiqueta1;
	}	
	
function getEtiqueta2(){
		return $this->etiqueta2;
	}							

function getMovimiento(){
		return $this->movimiento;
	}
	
function getOperador(){
		return $this->operador;
	}	
	
function getFuncionarioDeriba(){
		return $this->funcionarioDeriba;
	}		

function getTipoMovimiento(){
		return $this->tipoMovimiento;
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
	
function getMovimientoTexto(){
		return $this->movimientoTexto;
	}		
	
function getSecciones(){
		return $this->secciones;
	}											

}
?>