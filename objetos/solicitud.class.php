<?
Class solicitud{	

var $zona;
var $prefectura;
var $comisaria;
var $destacanmento;
var $nomFuncionario;
var $usuario;
var $tipoUsuario;
var $grado;
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


		
}//end class   
?>