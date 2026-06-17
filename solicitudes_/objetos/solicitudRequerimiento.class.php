<?
Class requerimiento{	
	
var $codigoSolicitud;
var $unidad;
var $funcionario;	
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

var $secciones;
var $fechaInicio;
var $fechaTermino;

var $textoMovimiento;

var $archivo;


function setCodigoSolicitud($codigoSolicitud){
		$this->codigoSolicitud = $codigoSolicitud;
	}

function setUnidad($unidad){
		$this->unidad = $unidad;
	}

function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}
	
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
	
function setSecciones($secciones){
		$this->secciones = $secciones;
	}	
	
function setFechaInicio($fechaInicio){
		$this->fechaInicio = $fechaInicio;
	}	
	
function setFechaTermino($fechaTermino){
		$this->fechaTermino = $fechaTermino;
	}	
	
function setTextoMovimiento($textoMovimiento){
		$this->textoMovimiento = $textoMovimiento;
	}		
	
	function setArchivoSolicitud($archivo){
		$this->archivoSolicitud = $archivo;
	}													
	
function getCodigoSolicitud(){
		return $this->codigoSolicitud;
	}	
	
function getUnidad(){
		return $this->unidad;
	}	
	
function getFuncionario(){
		return $this->funcionario;
	}	

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
	
function getSecciones(){
		return $this->secciones;
	}				

function getFechaInicio(){
		return $this->fechaInicio;
	}	
	
function getFechaTermino(){
		return $this->fechaTermino;
	}		
	
function getTextoMovimiento(){
		return $this->textoMovimiento;
	}	
	
function getArchivoSolicitud(){
		return $this->archivoSolicitud;
	}		
		
}//end class   
?>