<?
// INICIO DE FUNCIONES

Class dbTipoServicioExtraordinario extends Conexion
{			
	function listaTipoServicioExtraordinario($especialidad, $tipoServiciosExtraordinarios){
		 
     
	    // if ($especialidad == 30){
	    // 
	    // $sql = "SELECT 
		//		  ESPECIALIDAD_TSERVICIO.TIPO_SERVICIO AS TEXT_CODIGO,
		//		  TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION AS TEXT_DESCRIPCION
		//		FROM
		//		  ESPECIALIDAD_TSERVICIO
		//		  INNER JOIN TIPO_EXTRAORDINARIO ON (ESPECIALIDAD_TSERVICIO.TIPO_SERVICIO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
		//		WHERE
		//		  ESPECIALIDAD_TSERVICIO.UNIDAD_ESPECIALIDAD = 30 AND 
		//		  ESPECIALIDAD_TSERVICIO.ACTIVO = 1";
	    // 
	    //} else {
	    //	
	    // $sql = "SELECT 
		//		   TIPO_EXTRAORDINARIO.TEXT_CODIGO,
		//		   TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION
		//		 FROM
		//		   TIPO_EXTRAORDINARIO
		//		 WHERE TIPO_EXTRAORDINARIO.TEXT_ACTIVO = 1
		//		 ORDER BY TIPO_EXTRAORDINARIO.TEXT_PRIORIDAD";
		//}
	     
	     
	      $sql = "SELECT 
				  ESPECIALIDAD_TSERVICIO.TIPO_SERVICIO AS TEXT_CODIGO,
				  TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION AS TEXT_DESCRIPCION
				FROM
				  ESPECIALIDAD_TSERVICIO
				  INNER JOIN TIPO_EXTRAORDINARIO ON (ESPECIALIDAD_TSERVICIO.TIPO_SERVICIO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				WHERE
				  ESPECIALIDAD_TSERVICIO.UNIDAD_ESPECIALIDAD = ".$especialidad." AND 
				  ESPECIALIDAD_TSERVICIO.ACTIVO = 1 AND ESPECIALIDAD_TSERVICIO.TIPO = 'E' ORDER BY TEXT_DESCRIPCION";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$tipoServicioExtraordinario = new tipoServicioExtraordinario;
		 	$tipoServicioExtraordinario->setCodigo(STRTOUPPER($myrow["TEXT_CODIGO"]));
		 	$tipoServicioExtraordinario->setDescripcion(STRTOUPPER($myrow["TEXT_DESCRIPCION"]));
		 	
		 	$tipoServiciosExtraordinarios[$i] = $tipoServicioExtraordinario;
		 	$i++;
		 }
	}
	
	
	
	
}//end class   
?>