<?
Class requerimiento{	
	
var $codigoRequerimiento;
var $unidad;
var $funcionario;	
var $tipoRequerimiento;
var $modulo;
var $problema;
var $observacion;
var $fechaInicio;
var $fechaTermino;
var $estado;
var $codigoUnidad;
var $vistaUnidad;
var $estadoSolicitud;
var $funDeribado;


function setCodigoRequerimiento($codigoRequerimiento){
		$this->codigoRequerimiento = $codigoRequerimiento;
	}

function setUnidad($unidad){
		$this->unidad = $unidad;
	}

function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}
	
function setTipoRequerimiento($tipoRequerimiento){
		$this->tipoRequerimiento = $tipoRequerimiento;
	}	

function setModulo($modulo){
		$this->modulo = $modulo;
	}	

function setProblema($problema){
		$this->problema = $problema;
	}	
	
function setObservacion($observacion){
		$this->observacion = $observacion;
	}

function setFechaInicio($fechaInicio){
		$this->fechaInicio = $fechaInicio;
	}		
	
function setFechaTermino($fechaTermino){
		$this->fechaTermino = $fechaTermino;
	}	
	
function setEstado($estado){
		$this->estado = $estado;
	}
	
function setCodigoUnidad($codigoUnidad){
		$this->codigoUnidad = $codigoUnidad;
	}		
	
function setVistaUnidad($vistaUnidad){
		$this->vistaUnidad = $vistaUnidad;
	}		
	
function setFunDeribado($funDeribado){
		$this->funDeribado = $funDeribado;
	}				
	
function getCodigoRequerimiento(){
		return $this->codigoRequerimiento;
	}	
	
function getUnidad(){
		return $this->unidad;
	}	
	
function getFuncionario(){
		return $this->funcionario;
	}	
	
function getTipoRequerimiento(){
		return $this->tipoRequerimiento;
	}		

function getModulo(){
		return $this->modulo;
	}		
	
function getProblema(){
		return $this->problema;
	}	
	
function getObservacion(){
		return $this->observacion;
	}			
	
function getFechaInicio(){
		return $this->fechaInicio;
	}		
	
function getFechaTermino(){
		return $this->fechaTermino;
	}			
	
function getEstado(){
		return $this->estado;
	}	
	
function getCodigoUnidad(){
		return $this->codigoUnidad;
	}							

function getVistaUnidad(){
		return $this->vistaUnidad;
	}
	
function getFunDeribado(){
		return $this->funDeribado;
	}			
	
}//end class   
?>