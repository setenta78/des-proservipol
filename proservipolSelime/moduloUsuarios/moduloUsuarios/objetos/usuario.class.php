<?
Class usuario{	
	var $codigoFuncionario;
	var $apellidoPaterno;
	var $apellidoMaterno;
	var $pNombre;
	
	var $descGrado;
	
 var $usuarioModulo;

 var $usuarioFechaDesde1;
 var $usuarioTipo1;




	function setCodigoFuncionario($codigoFuncionario){
		$this->codigoFuncionario = $codigoFuncionario;
	}
	
	function setApellidoPaterno($apellidoPaterno){
		$this->apellidoPaterno = $apellidoPaterno;
	}
	
	function setApellidoMaterno($apellidoMaterno){
		$this->apellidoMaterno = $apellidoMaterno;
	}
	
	function setPNombre($pNombre){
		$this->pNombre = $pNombre;
	}
	

	function setGradoDescripcion($descGrado){
		$this->descGrado = $descGrado;
	}

	function setUsuarioModulo($usuarioModulo){
		$this->usuarioModulo = $usuarioModulo;
	}

  function setUsuarioFechaDesde1($usuarioFechaDesde1){
    $this->usuarioFechaDesde1 = $usuarioFechaDesde1;
  }

  function setUsuarioTipo1($usuarioTipo1){
    $this->usuarioTipo1 = $usuarioTipo1;
  }




  function getCodigoFuncionario(){
		return $this->codigoFuncionario;
	}
	
	function getApellidoPaterno(){
		return $this->apellidoPaterno;
	}
	
	function getApellidoMaterno(){
		return $this->apellidoMaterno;
	}
	
	function getPNombre(){
		return $this->pNombre;
	}
	
	function getGradoDescripcion(){
		return $this->descGrado;
	}

	function getUsuarioModulo(){
		return $this->usuarioModulo;
	}

  function getUsuarioFechaDesde1(){
		return $this->usuarioFechaDesde1;
	}

  function getUsuarioTipo1(){
		return $this->usuarioTipo1;
	}
}//end class   
?>