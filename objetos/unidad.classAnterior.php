<?
Class unidad {	
    //Clase modificada el 16-04-2014
    //Atributos añadidos: $contieneHijos, $unidadServicio
    //Funciones añadidas: setContieneHijos(), setUnidadServicio(), getContieneHijos(), getUnidadServicio()
	var $codigoUnidad;
	var $padreUnidad;
	var $descripcionUnidad;
	var $tienePlanCuadrante;
	var $seleccionable;
	var $bloqueda;
	var $especialidad;
	var $tipo;
	var $contieneHijos; //Variable añadida 16-04-2015 
	var $unidadServicio; //variable añadida 16-04-2015
	var $UnidadTipo; //variable añadida 17-06-2019
	
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
	
	function setTipoUnidad($tipo){
		$this->tipo = $tipo;
	}
	
	//Añadida: 16-04-2015
	function setContieneHijos($contieneHijos){
		$this->contieneHijos = $contieneHijos;
	}
	//Añadida: 16-04-2015
	function setUnidadServicio($unidadServicio){
		$this->unidadServicio = $unidadServicio;
	}
	//Añadida: 17-06-2019
	function setUnidadTipo($UnidadTipo){
		$this->UnidadTipo = $UnidadTipo;
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
	
	function getTipoUnidad(){
		return $this->tipo;
	}
	
	//Añadida: 16-04-2015
	function getContieneHijos(){
		return $this->contieneHijos;
	}
	//Añadida: 16-04-2015
	function getUnidadServicio(){
		return $this->unidadServicio;
	}
	//Añadida: 17-06-2019
	function getUnidadTipo(){
		return $this->UnidadTipo;
	}
    
}//end class   
?>