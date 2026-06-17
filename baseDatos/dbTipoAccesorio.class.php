<?
// INICIO DE FUNCIONES

Class dbTipoAccesorio extends Conexion
{			
	function listaTipoAccesorio($tipoAccesorios){
		 
		$sql = "SELECT 
				  TIPO_ACCESORIO.TACC_CODIGO,
				  TIPO_ACCESORIO.TACC_DESCRIPCION
				FROM TIPO_ACCESORIO 
				WHERE ACTIVO = 1
				ORDER BY TIPO_ACCESORIO.ORDEN ASC";
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$tipo = new tipoAccesorio;
		 	$tipo->setCodigo(STRTOUPPER($myrow["TACC_CODIGO"]));
		 	$tipo->setDescripcion(STRTOUPPER($myrow["TACC_DESCRIPCION"]));
		 			 	
		 	$tipoAccesorios[$i] = $tipo;
		 	$i++;
		 }
	}
	
}//end class   
?>