<?
Class dbFechas extends Conexion{
	
	function listaFechas($codigo,$fechas){
		
		$sql = "SELECT 
					F.CORRELATIVO_CARGOFUNCIONARIO,
					C.CAR_DESCRIPCION,
					U.UNI_DESCRIPCION,
					F.FECHA_DESDE,
					F.FECHA_HASTA,
					IF(S.FECHA_LIMITE >= DATE_ADD(F.FECHA_HASTA, INTERVAL -1 DAY)
						OR (S.FECHA_LIMITE BETWEEN DATE_ADD(F.FECHA_DESDE, INTERVAL 1 DAY) AND DATE_ADD(IF(ISNULL(F.FECHA_HASTA),NOW(),F.FECHA_HASTA), INTERVAL -1 DAY)),TRUE,FALSE) BLOQUEADO
				FROM CARGO_FUNCIONARIO F
				JOIN UNIDAD U ON U.UNI_CODIGO = F.UNI_CODIGO
				JOIN CARGO C ON C.CAR_CODIGO = F.CAR_CODIGO
				JOIN CONFIG_SYS S ON S.ACTIVO = 1
				WHERE F.FUN_CODIGO='{$codigo}'
				ORDER BY F.CORRELATIVO_CARGOFUNCIONARIO ASC";
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$fecha = new fecha;
			$fecha->setCodigoFuncionario($codigo);
			$fecha->setCorrelativo(STRTOUPPER($myrow["CORRELATIVO_CARGOFUNCIONARIO"]));
			$fecha->setCargo(STRTOUPPER($myrow["CAR_DESCRIPCION"]));
			$fecha->setUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			$fecha->setFechaD($myrow["FECHA_DESDE"]);
			$fecha->setFechaLimite($myrow["BLOQUEADO"]);
			($myrow["FECHA_HASTA"]=="") ? $fecha->setFechaH("--") : $fecha->setFechaH($myrow["FECHA_HASTA"]);
			$fechas[$i] = $fecha;
			$i++;
		}
	}
	
	function deleteFecha($fecha){
		$sql = "DELETE FROM CARGO_FUNCIONARIO 
				WHERE FUN_CODIGO = '{$fecha->getCodigoFuncionario()}' 
				AND CORRELATIVO_CARGOFUNCIONARIO >= {$fecha->getCorrelativo()} ";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateFecha($fecha){
		$sql = "UPDATE CARGO_FUNCIONARIO 
				SET FECHA_HASTA = NULL
				WHERE FUN_CODIGO = '{$fecha->getCodigoFuncionario()}' 
				AND CORRELATIVO_CARGOFUNCIONARIO = {$fecha->getCorrelativo()} ";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateUnidad($fecha){
		
		$sql = "UPDATE FUNCIONARIO 
				SET UNI_CODIGO = (SELECT IF(CAR_CODIGO=3500,NULL,UNI_CODIGO) UNI_CODIGO
									FROM CARGO_FUNCIONARIO
									WHERE FUN_CODIGO='{$fecha->getCodigoFuncionario()}' 
									AND FECHA_HASTA IS NULL)
				WHERE FUN_CODIGO ='{$fecha->getCodigoFuncionario()}' ";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}

}
?>