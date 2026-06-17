<?
Class dbServicios extends Conexion{
	
	function RevisaServicios($funcionario, $fechaBuscar, $servicios){
		$sql = "SELECT 
						  SERVICIO.UNI_CODIGO,
						  UNIDAD.UNI_DESCRIPCION,
						  SERVICIO.CORRELATIVO_SERVICIO,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  SERVICIO.TEXT_CODIGO,
						  TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION,
						  SERVICIO.FECHA,
						  SERVICIO.HORA_INICIO,
						  SERVICIO.HORA_TERMINO
						FROM FUNCIONARIO_SERVICIO
					  JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					  JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
					  JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
						WHERE FUNCIONARIO_SERVICIO.FUN_CODIGO = '".$funcionario."' AND SERVICIO.FECHA >= '".$fechaBuscar."'
					  ORDER BY SERVICIO.FECHA DESC
					  LIMIT 10";
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$servicio = new servicio;
			$servicio->setUnidad($myrow["UNI_DESCRIPCION"]);
			$servicio->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
			$servicio->setFecha($myrow["FECHA"]);
			$servicio->setTipoServicio($myrow["TSERV_DESCRIPCION"]);
			$servicio->setServicioExtraordinario($myrow["TEXT_DESCRIPCION"]);
			$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
			$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
			$servicios[$i] = $servicio;
			$i++;
		}
	}
}
?>