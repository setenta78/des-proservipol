<?
Class dbFechas extends Conexion{
	
	function listaFechas($codigo,$fechas){
	
		$sql = "SELECT
					EA.CORRELATIVO_ESTADOARMA,
					EA.ARM_CODIGO,
					E.EST_DESCRIPCION,
					U.UNI_DESCRIPCION,
					EA.FECHA_DESDE,
					EA.FECHA_HASTA,
					IF(S.FECHA_LIMITE >= DATE_ADD(EA.FECHA_HASTA, INTERVAL -1 DAY)
						   OR (S.FECHA_LIMITE BETWEEN DATE_ADD(EA.FECHA_DESDE, INTERVAL 1 DAY) AND DATE_ADD(IF(ISNULL(EA.FECHA_HASTA),NOW(),EA.FECHA_HASTA), INTERVAL -1 DAY)),TRUE,FALSE) BLOQUEADO
				FROM ESTADO_ARMA EA
				LEFT JOIN UNIDAD U ON U.UNI_CODIGO = EA.UNI_CODIGO
				LEFT JOIN ESTADO E ON E.EST_CODIGO = EA.EST_CODIGO
				JOIN CONFIG_SYS S ON S.ACTIVO = 1
				WHERE EA.ARM_CODIGO='{$codigo}'
				ORDER BY EA.CORRELATIVO_ESTADOARMA ASC";
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$fecha = new fecha;
			$fecha->setCodigoArma($codigo);
			$fecha->setCorrelativo(STRTOUPPER($myrow["CORRELATIVO_ESTADOARMA"]));
			$fecha->setEstado(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			$fecha->setUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			$fecha->setFechaD($myrow["FECHA_DESDE"]);
			$fecha->setFechaLimite($myrow["BLOQUEADO"]);
			($myrow["FECHA_HASTA"]=="") ? $fecha->setFechaH("--") : $fecha->setFechaH($myrow["FECHA_HASTA"]);
			$fechas[$i] = $fecha;
			$i++;
		}
	}
	
	function deleteFecha($fecha){
		$sql = "DELETE FROM ESTADO_ARMA 
				WHERE ARM_CODIGO = '".$fecha->getCodigoArma()."' 
				AND CORRELATIVO_ESTADOARMA >= {$fecha->getCorrelativo()} ";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateFecha($fecha){
		$sql = "UPDATE ESTADO_ARMA 
				SET FECHA_HASTA = NULL
				WHERE ARM_CODIGO = '{$fecha->getCodigoArma()}' 
				AND CORRELATIVO_ESTADOARMA = {$fecha->getCorrelativo()} ";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateUnidad($fecha){
		$sql = "UPDATE ARMA 
				SET UNI_CODIGO = (SELECT IF(EST_CODIGO=3500,NULL,UNI_CODIGO) UNI_CODIGO
									FROM ESTADO_ARMA
									WHERE ARM_CODIGO='{$fecha->getCodigoArma()}' 
									AND FECHA_HASTA IS NULL)
				WHERE ARM_CODIGO ='{$fecha->getCodigoArma()}' ";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}

}
?>