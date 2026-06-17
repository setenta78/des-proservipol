<?
// INICIO DE FUNCIONES

Class dbTipoAnimal extends Conexion
{			
	function listaTipoAnimal($tipoAnimales){
		 
		$sql = "SELECT 
				  TIPO_ANIMAL.TANIM_CODIGO,
				  TIPO_ANIMAL.TANIM_DESCRIPCION
				FROM
				  TIPO_ANIMAL 
				  WHERE TANIM_CODIGO IN(20,30)
				  ORDER BY 
				  TIPO_ANIMAL.TANIM_DESCRIPCION";
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$tipo = new tipoAnimal;
		 	$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
		 	$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));
		 			 	
		 	$tipoAnimales[$i] = $tipo;
		 	$i++;
		 }
	}
	
}//end class   
?>