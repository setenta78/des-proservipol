<?
Class dbTipoServicioExtraordinario extends Conexion{
	
	function listaTipoServicioExtraordinario($codUnidad, $tipoServiciosExtraordinarios){
		$sql = "SELECT 
					ESPECIALIDAD_TSERVICIO.TIPO_SERVICIO AS TEXT_CODIGO,
					TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION AS TEXT_DESCRIPCION
				FROM ESPECIALIDAD_TSERVICIO
				JOIN TIPO_EXTRAORDINARIO ON (ESPECIALIDAD_TSERVICIO.TIPO_SERVICIO = TIPO_EXTRAORDINARIO.TEXT_CODIGO) AND TIPO_EXTRAORDINARIO.TEXT_ACTIVO = 1
				JOIN UNIDAD ON UNIDAD.UNI_CODIGO = {$codUnidad}
				WHERE ESPECIALIDAD_TSERVICIO.UNIDAD_ESPECIALIDAD = IF(UNIDAD.UNI_ESPECIALIDAD IN (20,30,31,150,110),UNIDAD.UNI_ESPECIALIDAD,70)
				AND ESPECIALIDAD_TSERVICIO.ACTIVO = 1 AND ESPECIALIDAD_TSERVICIO.TIPO = 'E'
				ORDER BY TEXT_DESCRIPCION";
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

	function listaTipoServicioExtraordinarioN($codUnidad, $tipoServiciosExtraordinarios){
		$sql = "SELECT 
					S.TEXT_CODIGO,
					S.TEXT_DESCRIPCION
				FROM TIPO_EXTRAORDINARIO S
				JOIN TIPO_EXTRAORDINARIO_CUARTEL T ON S.TEXT_CODIGO = T.TEXT_CODIGO
				JOIN UNIDAD U ON U.TCU_CODIGO = T.TCU_CODIGO AND U.TESPC_CODIGO = T.TESPC_CODIGO
				WHERE U.UNI_CODIGO = {$codUnidad}
				AND T.GSER_CODIGO = 20 AND S.TEXT_ACTIVO = 1
				ORDER BY T.ORDEN ASC";
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
}
?>