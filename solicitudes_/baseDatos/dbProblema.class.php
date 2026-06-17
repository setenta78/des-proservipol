<?
// INICIO DE FUNCIONES

Class dbProblema extends Conexion
{			
	function listaProblema($factoresDemanda){
		 
		$sql = "SELECT
				  PROBLEMA.PROB_CODIGO,
				  PROBLEMA.PROB_DESCRIPCION
				FROM
				  PROBLEMA";
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
			$factorDemanda = new problema;
		 	$factorDemanda->setCodigo($myrow["PROB_CODIGO"]);
		 	$factorDemanda->setDescripcion($myrow["PROB_DESCRIPCION"]);

		 	
			$factoresDemanda[$i] = $factorDemanda;
			$i++;
		 }
	}
	
}//end class   
?>