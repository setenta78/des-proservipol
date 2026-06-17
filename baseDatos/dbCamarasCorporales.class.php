<?
Class dbCamaras extends Conexion{

	function listaCamarasDisponibles($unidad, $fechaServicio, $tipoServicio, $horaInicio, $horaTermino, $correlativo, $camaras){			
		
		$listaExcluyente 	= $this->listaCamarasExcluyentes($unidad, $fechaServicio, $tipoServicio, $horaInicio, $horaTermino, $correlativo);
		$sqlExcluyente 		= "AND V.VC_CODIGO NOT IN ({$listaExcluyente})";
		
		$sql = "SELECT 
					V.VC_CODIGO,
					V.VC_COD_EQUIPO_SAP,
					CONCAT(MC.MVC_DESCRIPCION,' ',MOV.MODVC_DESCRIPCION) DESCRIPCION,
					V.VC_NRO_SERIE
				FROM VIDEOCAMARA V
				LEFT JOIN MARCA_VIDEOCAMARA MC ON MC.MVC_CODIGO = V.MVC_CODIGO
				LEFT JOIN MODELO_VIDEOCAMARA MOV ON MOV.MVC_CODIGO = V.MVC_CODIGO AND MOV.MODVC_CODIGO = V.MODVC_CODIGO
				JOIN ESTADO_VIDEOCAMARA EV ON EV.VC_CODIGO = V.VC_CODIGO
				WHERE ((EV.UNI_CODIGO = {$unidad} AND EV.EST_CODIGO = 10) OR (EV.UNI_AGREGADO = {$unidad} AND EV.EST_CODIGO = 3000))
				AND (EV.FECHA_DESDE <= '{$fechaServicio}' AND (EV.FECHA_HASTA > '{$fechaServicio}' OR EV.FECHA_HASTA IS NULL))
				{$sqlExcluyente}
				ORDER BY DESCRIPCION, VC_CODIGO";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ){
			$camara = new camara;
			$camara->setCodigo(STRTOUPPER($myrow["VC_CODIGO"]));
			$camara->setCodEquipo(STRTOUPPER($myrow["VC_COD_EQUIPO_SAP"]));
			$camara->setModelo(STRTOUPPER($myrow["DESCRIPCION"]));
			$camara->setNumeroSerie(STRTOUPPER($myrow["VC_NRO_SERIE"]));
			$camaras[$i] = $camara;
			$i++;
		}
	}

	function listaCamarasExcluyentes($unidad, $fechaServicio, $servicio, $horaI, $horaT, $correlativo){
		
		$sql = "SELECT V.VC_CODIGO
				FROM FUNCIONARIO_VIDEOCAMARA V
				JOIN SERVICIO S ON S.UNI_CODIGO = V.UNI_CODIGO AND S.CORRELATIVO_SERVICIO = V.CORRELATIVO_SERVICIO
				WHERE S.FECHA = '{$fechaServicio}' AND S.UNI_CODIGO = {$unidad}
				AND (SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) BETWEEN S.HORA_INICIO AND S.HORA_TERMINO
				OR SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1) BETWEEN S.HORA_INICIO AND S.HORA_TERMINO
				OR S.HORA_INICIO BETWEEN SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) AND SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1))";
		
		//Servicio existente
		if($correlativo != "" && $correlativo != "-1") $sql .= " OR (S.UNI_CODIGO = {$unidad} AND S.CORRELATIVO_SERVICIO = {$correlativo})";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$listaCamaras = "'',";
		while($myrow = mysql_fetch_array($result)){
			$listaCamaras .= "'{$myrow['VC_CODIGO']}',";
		}
    $listaCamaras = substr($listaCamaras, 0, strlen($listaCamaras)-1);
    return $listaCamaras;
	}

	function actualizarEstadoCamara_mysqli($camara){
		$sql = "CALL ActualizarEstadoCamaras
				({$camara->getCodigo()},
				 {$camara->getUnidad()->getCodigoUnidad()},
				 {$camara->getEstado()->getCodigo()},
				'{$camara->getEstado()->getFechaDesde()}',
				 {$camara->getUnidadAgregado()->getCodigoUnidad()})";
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['message']=='OK') ? true : false;
	}
	
}
?>