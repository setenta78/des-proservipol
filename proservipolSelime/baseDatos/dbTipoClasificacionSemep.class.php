<?
// INICIO DE FUNCIONES

Class dbTipoClasificacionSemep extends Conexion
{			
	function listaTipoClasificacionSemep($tiposClasificacionSemep){
		 
		 $sql = "SELECT TSEM_CODIGO, TSEM_DESCRIPCION FROM TIPO_CLASIFICACION_SEMEP WHERE TSEM_ACTIVO = 1 ORDER BY TSEM_CODIGO";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result) ){
		 	$tipoClasificacionSemep = new tipoClasificacionSemep;
		 	$tipoClasificacionSemep->setCodigo($myrow["TSEM_CODIGO"]);
		 	$tipoClasificacionSemep->setDescripcion($myrow["TSEM_DESCRIPCION"]);
		 	
		 	$tiposClasificacionSemep[$i] = $tipoClasificacionSemep;
		 	$i++;
		 }
	}
}//end class   
?>