<?
Class funcionario{	
	var $codigoFuncionario;
	var $apellidoPaterno;
	var $apellidoMaterno;
	var $pNombre;
	var $sNombre;

	
	var $descGrado;
	
 var $codUnidadFuncionario;
 var $tipoUnidadFuncionario;
 var $especialidadUnidadFuncionario;

 var $descUnidadFuncionario;
 var $codUnidadPadreFuncionario;
 
 
 var $codUnidadUsuario;
 var $tipoUnidadUsuario;
 var $descUnidadUsuario;
 var $usuarioFechaDesde1;
 var $usuarioTipo1;
 var $usuarioFechaDesde2;
 var $usuarioTipo2;




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
	
	function setSNombre($sNombre){
		$this->sNombre = $sNombre;
	}



	
	function setGradoDescripcion($descGrado){
		$this->descGrado = $descGrado;
	}


	
  function setCodUnidadFuncionario($codUnidadFuncionario){
    $this->codUnidadFuncionario = $codUnidadFuncionario;
  }

  function setTipoUnidadFuncionario($tipoUnidadFuncionario){
    $this->tipoUnidadFuncionario = $tipoUnidadFuncionario;
  }

  function setEspecialidadUnidadFuncionario($especialidadUnidadFuncionario){
    $this->especialidadUnidadFuncionario = $especialidadUnidadFuncionario;
  }




  function setDescUnidadFuncionario($descUnidadFuncionario){
    $this->descUnidadFuncionario = $descUnidadFuncionario;
  }

  function setCodUnidadPadreFuncionario($codUnidadPadreFuncionario){
    $this->codUnidadPadreFuncionario = $codUnidadPadreFuncionario;
  }


  function setCodUnidadUsuario($codUnidadUsuario){
    $this->codUnidadUsuario = $codUnidadUsuario;
  }

  function setTipoUnidadUsuario($tipoUnidadUsuario){
    $this->tipoUnidadUsuario = $tipoUnidadUsuario;
  }

  function setDescUnidadUsuario($descUnidadUsuario){
    $this->descUnidadUsuario = $descUnidadUsuario;
  }

  function setUsuarioFechaDesde1($usuarioFechaDesde1){
    $this->usuarioFechaDesde1 = $usuarioFechaDesde1;
  }

  function setUsuarioTipo1($usuarioTipo1){
    $this->usuarioTipo1 = $usuarioTipo1;
  }

  function setUsuarioFechaDesde2($usuarioFechaDesde2){
    $this->usuarioFechaDesde2 = $usuarioFechaDesde2;
  }

  function setUsuarioTipo2($usuarioTipo2){
    $this->usuarioTipo2 = $usuarioTipo2;
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
	
	function getSNombre(){
		return $this->sNombre;
	}



	
	function getGradoDescripcion(){
		return $this->descGrado;
	}

  function getCodUnidadFuncionario(){
		return $this->codUnidadFuncionario;
	}

  function getTipoUnidadFuncionario(){
		return $this->tipoUnidadFuncionario;
	}
  
  function getDescUnidadFuncionario(){
		return $this->descUnidadFuncionario;
	}

  function getCodUnidadPadreFuncionario(){
    return $this->codUnidadPadreFuncionario;
  }
  
  function getCodUnidadUsuario(){
		return $this->codUnidadUsuario;
	}
  
  function getTipoUnidadUsuario(){
		return $this->tipoUnidadUsuario;
	}

  function getEspecialidadUnidadFuncionario(){
		return $this->especialidadUnidadFuncionario;
	}

  function getDescUnidadUsuario(){
		return $this->descUnidadUsuario;
	}

  function getUsuarioFechaDesde1(){
		return $this->usuarioFechaDesde1;
	}

  function getUsuarioTipo1(){
		return $this->usuarioTipo1;
	}

  function getUsuarioFechaDesde2(){
		return $this->usuarioFechaDesde2;
	}

  function getUsuarioTipo2(){
		return $this->usuarioTipo2;
	}

}//end class   
?>