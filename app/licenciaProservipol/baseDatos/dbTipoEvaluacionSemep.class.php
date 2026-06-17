<?
// INICIO DE FUNCIONES

Class dbTipoEvaluacionSemep extends Conexion
{			
	function listaTipoEvaluacionSemep($tiposEvaluacionSemep){
		 
		 $sql = "SELECT TEV_CODIGO, TEV_DESCRIPCION FROM TIPO_EVALUACION_SEMEP WHERE TEV_ACTIVO = 1 ORDER BY TEV_CODIGO";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result) ){
		 	$tipoEvaluacionSemep = new tipoEvaluacionSemep;
		 	$tipoEvaluacionSemep->setCodigo($myrow["TEV_CODIGO"]);
		 	$tipoEvaluacionSemep->setDescripcion($myrow["TEV_DESCRIPCION"]);
		 	
		 	$tiposEvaluacionSemep[$i] = $tipoEvaluacionSemep;
		 	$i++;
		 }
	}
}//end class   
?>