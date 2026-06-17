<?
// INICIO DE FUNCIONES

Class dbSeccion extends Conexion
{			
	function listaSecciones($factoresDemanda){
		 
		$sql = "SELECT
				  SECCION_DEPTO.SDEPTO_CODIGO,
				  SECCION_DEPTO.SDEPTO_DESCRIPCION
				FROM
				  SECCION_DEPTO WHERE ACTIVO=1";
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
			$factorDemanda = new seccion;
		 	$factorDemanda->setCodigo($myrow["SDEPTO_CODIGO"]);
		 	$factorDemanda->setDescripcion($myrow["SDEPTO_DESCRIPCION"]);

		 	
			$factoresDemanda[$i] = $factorDemanda;
			$i++;
		 }
	}
	
}//end class   
?>