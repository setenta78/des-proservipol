<?
Class mensaje {
	var $titulo;
	var $contenido;
	var $tiempo;
	var $activo;
	var $unidades = array();
	
	function setTitulo($titulo){
		$this->titulo = $titulo;
	}
	
	function setContenido($contenido){
		$this->contenido = $contenido;
	}
	
	function setTiempo($tiempo){
		$this->tiempo = $tiempo;
	}

	function setActivo($activo){
		$this->activo = $activo;
	}

	function setUnidades($unidades){
		$listaUnidades = array();
		$unidadPaso	= explode(",",$unidades);
		foreach($unidadPaso as &$unidad) {
			array_push($listaUnidades,$unidad);
		}
		$this->unidades = $listaUnidades;
	}

	function getTitulo(){
		return $this->titulo;
	}

	function getContenido(){
		return $this->contenido;
	}
	
	function getTiempo(){
		return $this->tiempo;
	}

	function getActivo(){
		return $this->activo;
	}
	
	function getUnidades(){
		return $this->unidades;
	}
	
	function buscarUnidad($unidad){
		return (in_array($unidad, $this->unidades)||$this->unidades[0]=='');
	}

}//end class   
?>