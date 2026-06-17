<?
Class funcionarioDeServicio{	
	var $funcionario;
	var $armas 			= array();
	var $animales 		= array();
	var $accesorios 	= array();
	
			
	function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}
	
	function setArmas($arma){
		$this->armas[count($this->armas)] = $arma;
	}	
	
	function setAnimales($animal){
		$this->animales[count($this->animales)] = $animal;
	}	
	
	function setAccesorios($accesorio){
		$this->accesorios[count($this->accesorios)] = $accesorio;
	}	
	
	
	
		
	function getFuncionario(){
		return $this->funcionario;
	}
	
	function getArmas($numero){
		return $this->armas[$numero];
	}
	
	function getAnimales($numero){
		return $this->animales[$numero];
	}	
	
	function setAccesorios($numero){
		return $this->accesorios[$numero];
	}	
	

}//end class   
?>