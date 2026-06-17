<?
// INICIO DE FUNCIONES

Class dbGrados extends Conexion
{			
	
	function listaEscalafones($escalafones){
		 
		 $sql = "SELECT ESC_CODIGO, ESC_DESCRIPCION FROM ESCALAFON WHERE ACTIVO = 1";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result) ){
		 	$escalafon = new escalafon;
		 	$escalafon->setCodigo($myrow["ESC_CODIGO"]);
		 	$escalafon->setDescripcion($myrow["ESC_DESCRIPCION"]);
		 	
		 	$escalafones[$i] = $escalafon;
		 	$i++;
		 }
	}
		
	function listaGrados($escalafon, $grados){
		
		
		$escalafonCodigo = $escalafon->getCodigo();
		$sql = "SELECT GRA_CODIGO, GRA_DESCRIPCION FROM GRADO WHERE ESC_CODIGO = ". $escalafonCodigo;
				
		//echo $sql;
				
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i = 0;
		while($myrow = mysql_fetch_array($result)){
			$grado = new grado;
			$grado->setEscalafon($escalafon);
			$grado->setCodigo($myrow["GRA_CODIGO"]);
			$grado->setDescripcion($myrow["GRA_DESCRIPCION"]);
			
			$grados[$i] = $grado;
			$i++;
		}
	}
		
		

}//end class   
?>