<?
// INICIO DE FUNCIONES

Class dbIngeniero extends Conexion
{			
	function listaIngeniero($tipoArmas){
		 
		 		
		 $sql = "SELECT 
      FUNCIONARIO.FUN_CODIGO,
       CONCAT_WS(' ','(',GRADO.GRA_DESCRIPCION,')','-',FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO) AS NOMBRE_COMPLETO
       FROM
      FUNCIONARIO
       INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
      WHERE
       FUNCIONARIO.FUN_CODIGO IN('995762T','007174T','010907Z')
      ORDER BY
       GRADO.GRA_DESCRIPCION";
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$tipo = new ingeniero;
		 	$tipo->setCodigo($myrow["FUN_CODIGO"]);
		 	$tipo->setDescripcion(STRTOUPPER($myrow["NOMBRE_COMPLETO"]));
		 			 	
		 	$tipoArmas[$i] = $tipo;
		 	$i++;
		 }
	}
	
}//end class   
?>