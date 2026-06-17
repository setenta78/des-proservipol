<?
Class vehiculosUnidad {
	var $unidad;
	var $tipoVehiculo;
	var $cantidadVehiculos;
	var $cantidadActivos;
	var $cantidadMantencion;
	var $cantidadReparacion;
	var $cantidadProcesoBaja;
	var $cantidadTribunal;
    
    var $cantidadActivo;
	var $cantidadAgregado;
    var $cantidadReparacionMenor;
    var $cantidadReparacionMayor;
		
	function setUnidad($unidad){
		$this->unidad = $unidad;
	}
	
	function setTipoVehiculo($tipoVehiculo){
		$this->tipoVehiculo = $tipoVehiculo;
	}
	
	function setCantidadVehiculos($cantidadVehiculos){
		$this->cantidadVehiculos = $cantidadVehiculos;
	}
	
	function setCantidadActivos($cantidadActivos){
		$this->cantidadActivos = $cantidadActivos;
	}
	
	function setCantidadMantencion($cantidadMantencion){
		$this->cantidadMantencion = $cantidadMantencion;
	}
	
	function setCantidadReparacion($cantidadReparacion){
		$this->cantidadReparacion = $cantidadReparacion;
	}
	
	function setCantidadProcesoBaja($cantidadProcesoBaja){
		$this->cantidadProcesoBaja = $cantidadProcesoBaja;
	}
	
	function setCantidadTribunal($cantidadTribunal){
		$this->cantidadTribunal = $cantidadTribunal;
	}

    
   	function setCantidadActivo($cantidadActivo){
		$this->cantidadActivo = $cantidadActivo;
	}
    
   	function setCantidadAgregado($cantidadAgregado){
		$this->cantidadAgregado = $cantidadAgregado;
	}

   function setCantidadReparacionMenor($cantidadReparacionMenor){
		$this->cantidadReparacionMenor = $cantidadReparacionMenor;
	}
    
    function setCantidadReparacionMayor($cantidadReparacionMayor){
		$this->cantidadReparacionMayor = $cantidadReparacionMayor;
	}

    function setCantidadEvaluacionFalla($cantidadEvaluacionFalla){
		$this->cantidadEvaluacionFalla = $cantidadEvaluacionFalla;
	}
    
    function setCantidadTramiteAdm($cantidadTramiteAdm){
		$this->cantidadTramiteAdm = $cantidadTramiteAdm;
	}

	function getUnidad(){
		return $this->unidad;
	}
	
	function getTipoVehiculo(){
		return $this->tipoVehiculo;
	}
	
	function getCantidadVehiculos(){
		return $this->cantidadVehiculos;
	}
	
	function getCantidadActivos(){
		return $this->cantidadActivos;
	}
	
	function getCantidadMantencion(){
		return $this->cantidadMantencion;
	}
	
	function getCantidadReparacion(){
		return $this->cantidadReparacion;
	}
	
	function getCantidadProcesoBaja(){
		return $this->cantidadProcesoBaja;
	}
	
	function getCantidadTribunal(){
		return $this->cantidadTribunal;
	}
	
    	function getCantidadActivo(){
		return $this->cantidadActivo;
	}
    
   	function getCantidadAgregado(){
		return $this->cantidadAgregado;
	}
	
	function getCantidadReparacionMenor(){
		return $this->cantidadReparacionMenor;
	}
    
   	function getCantidadReparacionMayor(){
		return $this->cantidadReparacionMayor;
	}
    
    function getCantidadEvaluacionFalla(){
		return $this->cantidadEvaluacionFalla;
	}
    
    function getCantidadTramiteAdm(){
		return $this->cantidadTramiteAdm;
	}
	
}//end class   
?>