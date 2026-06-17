<?
Class dbSeccion extends Conexion{

	function listaSeccion($unidad,$secciones){
		 
		 $sql = "SELECT 
                 SECCION_TUNIDAD.SEC_CODIGO,
                 TIPO_SECCION.SEC_DESCRIPCION
                 FROM
                 SECCION_TUNIDAD
                 INNER JOIN TIPO_SECCION ON (SECCION_TUNIDAD.SEC_CODIGO=TIPO_SECCION.SEC_CODIGO)
                 WHERE
                 SECCION_TUNIDAD.UNI_CODIGO={$unidad} AND
                 SECCION_TUNIDAD.ACTIVO = 1
                 ORDER BY TIPO_SECCION.SEC_DESCRIPCION";
	    
	   	//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
			$sec = new seccion;
			$sec->setCodigo($myrow["SEC_CODIGO"]);
			$sec->setDescripcion($myrow["SEC_DESCRIPCION"]);
			
		 	$secciones[$i] = $sec;
		 	$i++;
		 }
	}
}//end class   
?>