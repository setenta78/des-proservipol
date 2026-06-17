<?
// INICIO DE FUNCIONES

Class dbTipoRestriccionConducir extends Conexion
{			
	function listaTipoRestriccionConducir($filtroTipoRestriccion, $tiposDeRestriccionConducir){
		 
		 if ($filtroTipoRestriccion == 1) $filtro = "AND TRE_SEMEP = 1 ";
		 if ($filtroTipoRestriccion == 2) $filtro = "AND TRE_MUNICIPAL = 1 ";
		 
		 $sql = "SELECT 
		 			TRE_CODIGO, 
		 			TRE_DESCRIPCION 
		 		FROM TIPO_RESTRICCION_CONDUCIR 
		 		WHERE TRE_ACTIVO = 1 " .$filtro. "ORDER BY TRE_CODIGO";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result) ){
		 	$tipoRestriccionConducir = new tipoRestriccionConducir;
		 	$tipoRestriccionConducir->setCodigo($myrow["TRE_CODIGO"]);
		 	$tipoRestriccionConducir->setDescripcion($myrow["TRE_DESCRIPCION"]);
		 	
		 	$tiposDeRestriccionConducir[$i] = $tipoRestriccionConducir;
		 	$i++;
		 }
	}
}//end class   
?>