<?
Class grado{	
	var $escalafon;
	var $gradoCodigo;
	var $gradoDescripcion;

	function setEscalafon($escalafon){
		$this->escalafon = $escalafon;
	}
			
	function setCodigo($gradoCodigo){
		$this->gradoCodigo = $gradoCodigo;
	}
	
	function setDescripcion($gradoDescripcion){
		$this->gradoDescripcion = $gradoDescripcion;
	}
	
	
	function getCodigo(){
		return $this->gradoCodigo;
	}
	
	function getDescripcion(){
		return $this->gradoDescripcion;
	}
	
	function getEscalafon(){
		return $this->escalafon;
	}
	
	
}//end class   
?>