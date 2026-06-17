<?
Class camara{
	var $codigo;
	var $marca;
	var $modelo;
	var $procedencia;
	var $estado;
	var $unidad;
	var $codSap;
	var $codEquipo;
	var $numeroSerie;
	var $unidadAgregado;
	
	function setCodigo($codigo){
		$this->codigo = $codigo;
	}

	function setMarca($marca){
		$this->marca = $marca;
	}

	function setModelo($modelo){
		$this->modelo = $modelo;
	}

	function setEstado($estado){
		$this->estado = $estado;
	}

	function setProcedencia($procedencia){
		$this->procedencia = $procedencia;
	}

	function setUnidad($unidad){
		$this->unidad = $unidad;
	}

	function setCodSap($codSap){
		$this->codSap = $codSap;
	}

	function setCodEquipo($codEquipo){
		$this->codEquipo = $codEquipo;
	}

	function setNumeroSerie($numeroSerie){
		$this->numeroSerie = $numeroSerie;
	}

	function setUnidadAgregado($unidadAgregado){
		$this->unidadAgregado = $unidadAgregado;
	}

	function getCodigo(){
		return $this->codigo;
	}

	function getMarca(){
		return $this->marca;
	}

	function getModelo(){
		return $this->modelo;
	}

	function getEstado(){
		return $this->estado;
	}

	function getProcedencia(){
		return $this->procedencia;
	}

	function getUnidad(){
		return $this->unidad;
	}

	function getCodSap(){
		return $this->codSap;
	}

	function getCodEquipo(){
		return $this->codEquipo;
	}

	function getNumeroSerie(){
		return $this->numeroSerie;
	}

	function getUnidadAgregado(){
		return $this->unidadAgregado;
	}

}
?>