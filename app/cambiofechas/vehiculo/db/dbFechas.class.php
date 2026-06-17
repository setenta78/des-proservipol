<?
Class dbFechas extends Conexion{
	
	function listaFechas($codigo,$fechas){
	
		$sql = "SELECT
					EV.CORRELATIVO_ESTADOVEHICULO,
					EV.VEH_CODIGO,
					E.EST_DESCRIPCION,
					U.UNI_DESCRIPCION,
					EV.FECHA_DESDE,
					EV.FECHA_HASTA,
					IF(S.FECHA_LIMITE >= DATE_ADD(EV.FECHA_HASTA, INTERVAL -1 DAY)
						OR (S.FECHA_LIMITE BETWEEN DATE_ADD(EV.FECHA_DESDE, INTERVAL 1 DAY) AND DATE_ADD(IF(ISNULL(EV.FECHA_HASTA),NOW(),EV.FECHA_HASTA), INTERVAL -1 DAY)),TRUE,FALSE) BLOQUEADO
				FROM ESTADO_VEHICULO EV
				JOIN UNIDAD U ON U.UNI_CODIGO = EV.UNI_CODIGO
				JOIN ESTADO E ON E.EST_CODIGO = EV.EST_CODIGO
				JOIN CONFIG_SYS S ON S.ACTIVO = 1
				WHERE EV.VEH_CODIGO = '{$codigo}'
				ORDER BY EV.CORRELATIVO_ESTADOVEHICULO ASC";
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$fecha = new fecha;
			$fecha->setCodigoVehiculo($codigo);
			$fecha->setCorrelativo(STRTOUPPER($myrow["CORRELATIVO_ESTADOVEHICULO"]));
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
		$sql = "DELETE FROM ESTADO_VEHICULO 
				WHERE VEH_CODIGO = '{$fecha->getCodigoVehiculo()}' 
				AND CORRELATIVO_ESTADOVEHICULO >= {$fecha->getCorrelativo()} ";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateFecha($fecha){
		$sql = "UPDATE ESTADO_VEHICULO 
				SET FECHA_HASTA = NULL
				WHERE VEH_CODIGO = '{$fecha->getCodigoVehiculo()}' 
				AND CORRELATIVO_ESTADOVEHICULO = {$fecha->getCorrelativo()} ";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateUnidad($fecha){
		
		$sql = "UPDATE VEHICULO 
				SET UNI_CODIGO = (SELECT IF(EST_CODIGO=3500,NULL,UNI_CODIGO) UNI_CODIGO
									FROM ESTADO_VEHICULO
									WHERE VEH_CODIGO = '{$fecha->getCodigoVehiculo()}' 
									AND FECHA_HASTA IS NULL)
				WHERE VEH_CODIGO = '{$fecha->getCodigoVehiculo()}' ";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}

}
?>