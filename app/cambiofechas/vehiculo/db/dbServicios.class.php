<?
Class dbServicios extends Conexion{
	
	function RevisaServicios($vehiculo, $fechaBuscar, $servicios){
		$sql = "SELECT
			 				U.UNI_CODIGO,
			 				U.UNI_DESCRIPCION,
			 				S.CORRELATIVO_SERVICIO,
		 		 			VS.VEH_CODIGO,
			 				TS.TSERV_CODIGO,
			 				TS.TSERV_DESCRIPCION,
			 				S.FECHA,
			 				S.HORA_INICIO,
			 				S.HORA_TERMINO
			 			FROM SERVICIO S
			 			JOIN VEHICULO_SERVICIO VS ON S.UNI_CODIGO = VS.UNI_CODIGO
			 			JOIN TIPO_SERVICIO TS ON S.TSERV_CODIGO = TS.TSERV_CODIGO
			 			JOIN UNIDAD U ON U.UNI_CODIGO = VS.UNI_CODIGO AND S.CORRELATIVO_SERVICIO = VS.CORRELATIVO_SERVICIO
						WHERE VS.VEH_CODIGO = ".$vehiculo." AND S.FECHA >= '".$fechaBuscar."'
						ORDER BY S.FECHA DESC
						LIMIT 10";
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			$servicio = new servicio;
			$servicio->setUnidad($myrow["UNI_DESCRIPCION"]);
			$servicio->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
			$servicio->setFecha($myrow["FECHA"]);
			$servicio->setTipoServicio($myrow["TSERV_DESCRIPCION"]);
			$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
			$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
			$servicios[$i] = $servicio;
			$i++;
		}
	}
}
?>