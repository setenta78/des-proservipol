<?
Class movimientoSolicitud{	
	
var $codigoSolicitud;
var $codigoMovimiento;
var $codigoTipoMovimiento;	
var $textoMovimiento;
var $usuarioImplicado;
var $tipoUsuario;
var $fechaMovimiento;	
var $funcionarioDeriba;	
var $secciones;	
var $fechaInicio;
var $fechaTermino;
var $visible;
var $unidad;

var $subproblema;

var $archivo;

function setCodigoSolicitud($codigoSolicitud){
		$this->codigoSolicitud = $codigoSolicitud;
	}

function setCodigoMovimiento($codigoMovimiento){
		$this->codigoMovimiento = $codigoMovimiento;
	}	
	
function setCodigoTipoMovimiento($codigoTipoMovimiento){
		$this->codigoTipoMovimiento = $codigoTipoMovimiento;
	}		
	
function setTextoMovimiento($textoMovimiento){
		$this->textoMovimiento = $textoMovimiento;
	}		
	
function setUsuarioImplicado($usuarioImplicado){
		$this->usuarioImplicado = $usuarioImplicado;
	}		
	
function setTipoUsuario($tipoUsuario){
		$this->tipoUsuario = $tipoUsuario;
	}	
	
function setFechaMovimiento($fechaMovimiento){
		$this->fechaMovimiento = $fechaMovimiento;
	}		
	
function setFuncionarioDeriba($funcionarioDeriba){
		$this->funcionarioDeriba = $funcionarioDeriba;
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
	
function setVisible($visible){
		$this->visible = $visible;
	}	

function setUnidad($unidad){
		$this->unidad = $unidad;
	}		
	
function setSubproblema($subproblema){
		$this->subproblema = $subproblema;
	}
	
function setArchivoSolicitud($archivo){
		$this->archivoSolicitud = $archivo;
	}							
									
	
function getCodigoSolicitud(){
		return $this->codigoSolicitud;
	}	
	
function getCodigoMovimiento(){
		return $this->codigoMovimiento;
	}	
	
function getCodigoTipoMovimiento(){
		return $this->codigoTipoMovimiento;
	}

function getTextoMovimiento(){
		return $this->textoMovimiento;
	}	
	
function getUsuarioImplicado(){
		return $this->usuarioImplicado;
	}		
	
function getTipoUsuario(){
		return $this->tipoUsuario;
	}	
	
function getFechaMovimiento(){
		return $this->fechaMovimiento;
	}	
	
function getFuncionarioDeriba(){
		return $this->funcionarioDeriba;
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
	
function getVisible(){
		return $this->visible;
	}		
	
function getUnidad(){
		return $this->unidad;
	}		
	
function getSubproblema(){
		return $this->subproblema;
	}	
	
function getArchivoSolicitud(){
		return $this->archivoSolicitud;
	}														

}//end class   
?>