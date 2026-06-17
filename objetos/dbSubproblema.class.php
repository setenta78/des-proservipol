<?
// INICIO DE FUNCIONES

Class dbSubproblema extends Conexion
{			
	function listaSubproblemas($marca, $modelos){
		 
		 $sql = "SELECT 
             SUBPROBLEMA.PROB_CODIGO,
             SUBPROBLEMA.SUBP_CODIGO,
             SUBPROBLEMA.SUBP_DESCRIPCION
           FROM
           PROBLEMA
           INNER JOIN SUBPROBLEMA ON (PROBLEMA.PROB_CODIGO = SUBPROBLEMA.PROB_CODIGO) ";
	     if ($marca != "") $sql .= " WHERE SUBPROBLEMA.PROB_CODIGO = ".$marca;
	     $sql .= " ORDER BY 
	               SUBP_CODIGO,
	               SUBPROBLEMA.SUBP_DESCRIPCION";
	    
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$marca = new problema;
		 	$marca->setCodigo(STRTOUPPER($myrow["PROB_CODIGO"]));
		 	
		 	
		 	
		 	$modelo = new subProblema;
		 	$modelo->setProblemaSolicitud($marca);
		 	$modelo->setCodigo(STRTOUPPER($myrow["SUBP_CODIGO"]));
		 	$modelo->setDescripcion(STRTOUPPER($myrow["SUBP_DESCRIPCION"]));
		 	
		 	$modelos[$i] = $modelo;
		 	$i++;
		 }
	}
}//end class   
?>