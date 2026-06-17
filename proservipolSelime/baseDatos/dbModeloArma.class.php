<?
// INICIO DE FUNCIONES

Class dbModeloArma extends Conexion
{			
	function listaModelosArmas($marca, $modelos){
		 
		 $sql = "SELECT 
				  MARCA_ARMA.MARM_CODIGO,
				  MARCA_ARMA.MARM_DESCRIPCION,
				  MODELO_ARMA.MODARM_CODIGO,
				  MODELO_ARMA.MODARM_DESCRIPCION
				FROM
				  MARCA_ARMA
				  INNER JOIN MODELO_ARMA ON (MARCA_ARMA.MARM_CODIGO = MODELO_ARMA.MARM_CODIGO)";
	     
	     if ($marca != "") $sql .= " WHERE MARCA_ARMA.MARM_CODIGO = ".$marca;
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$marca = new marcaArma;
		 	$marca->setCodigo(STRTOUPPER($myrow["MARM_CODIGO"]));
		 	$marca->setDescripcion(STRTOUPPER($myrow["MARM_DESCRIPCION"]));
		 	
		 	
		 	$modelo = new modeloArma;
		 	$modelo->setMarcaArma($marca);
		 	$modelo->setCodigo(STRTOUPPER($myrow["MODARM_CODIGO"]));
		 	$modelo->setDescripcion(STRTOUPPER($myrow["MODARM_DESCRIPCION"]));
		 	
		 	$modelos[$i] = $modelo;
		 	$i++;
		 }
	}
}//end class   
?>