<?
Class dioscar{	
	
var $codigoSimccar;
var $unidad;
var $serieSimccar;	
var $tarjetaSimccar;
var $imei;
var $estadoVehiculo;
var $unidadAgregado;
var $origen;
var $verfica;

var $marca;
var $modelo;
var $anno;

var $reemplazoSimccar;

	function setCodigoSimccar($codigoSimccar){
		$this->codigoSimccar = $codigoSimccar;
	}

	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setSerieSimccar($serieSimccar){
		$this->serieSimccar = $serieSimccar;
	}
	
	function setTarjetaSimccar($tarjetaSimccar){
		$this->tarjetaSimccar = $tarjetaSimccar;
	}
	
		function setImei($imei){
		$this->imei = $imei;
	}
	
	function setEstadoVehiculo($estadoVehiculo){
		$this->estadoVehiculo = $estadoVehiculo;
	}
	
	function setUnidadAgregado($unidadAgregado){
		$this->unidadAgregado = $unidadAgregado;
	}
	
	function setOrigen($origen){
		$this->origen = $origen;
	}
	
	function setVerifica($verifica){
		$this->verifica = $verifica;
	}
	
	function setMarca($marca){
		$this->marca = $marca;
	}
	
	function setModelo($modelo){
		$this->modelo = $modelo;
	}
	
	function setAnno($anno){
		$this->anno = $anno;
	}
	
	function setReemplazoSimccar($reemplazoSimccar){
		$this->reemplazoSimccar = $reemplazoSimccar;
	}
	
	function getCodigoSimccar(){
		return $this->codigoSimccar;
	}
		
	function getUnidad(){
		return $this->unidad;
	}
	
	function getSerieSimccar(){
		return $this->serieSimccar;
	}
	
	function getTarjetaSimccar(){
		return $this->tarjetaSimccar;
	}
	
	function getImei(){
		return $this->imei;
	}
	
	function getEstadoVehiculo(){
		return $this->estadoVehiculo;
	}
	
	function getUnidadAgregado(){
		return $this->unidadAgregado;
	}
	
	function getOrigen(){
		return $this->origen;
	}
	
	function getVerifica(){
		return $this->verifica;
	}
	
	function getMarca(){
		return $this->marca;
	}
	
	function getModelo(){
		return $this->modelo;
	}
	
	function getAnno(){
		return $this->anno;
	}
	
		function getReemplazoSimccar(){
		return $this->reemplazoSimccar;
	}
				
}//end class   
?>