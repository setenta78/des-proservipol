<?
Class vista{
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

}
?>