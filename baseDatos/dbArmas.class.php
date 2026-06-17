<?
Class dbArmas extends Conexion{
	
	function listaTotalArmas($unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $armas){
		
		if ($NombreCampo == "tipo")  $campoOrdenar = "TIPO_ARMA.TARM_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "marca") $campoOrdenar = "MARCA_ARMA.MARM_DESCRIPCION, MODELO_ARMA.MODARM_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "serie")  $campoOrdenar = "ARMA.ARM_NUMEROSERIE ".$TipoOrden;
		if ($NombreCampo == "seccion")  $campoOrdenar = "TIPO_SECCION.SEC_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "estado")  $campoOrdenar = "ESTADO.EST_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "unidad")  $campoOrdenar = "UNIDAD.UNI_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "") $campoOrdenar = "ARMA.TARM_CODIGO, ARMA.ARM_CODIGO ASC";
	
    $sql = "SELECT 
		  ARMA.ARM_CODIGO,
		  ARMA.MODARM_CODIGO,
		  MODELO_ARMA.MODARM_DESCRIPCION,
		  MODELO_ARMA.MARM_CODIGO,
		  MARCA_ARMA.MARM_DESCRIPCION,
		  ARMA.UNI_CODIGO,
		  UNIDAD.UNI_DESCRIPCION,
		  ARMA.TARM_CODIGO,
		  TIPO_ARMA.TARM_DESCRIPCION,
		  ARMA.ARM_NUMEROSERIE,
		  ESTADO.EST_CODIGO,
		  ESTADO.EST_DESCRIPCION,
		  ESTADO_ARMA.UNI_AGREGADO,
			UNIDAD_AGREGADO.UNI_DESCRIPCION,
      TIPO_SECCION.SEC_DESCRIPCION
			FROM ARMA
		  INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
		  INNER JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
		  INNER JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
		  INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
		  LEFT OUTER JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
		  LEFT OUTER JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
		  LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ARMA.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
      LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ARMA.SEC_CODIGO)
			WHERE ARMA.UNI_CODIGO = ".$unidad." AND ESTADO_ARMA.FECHA_HASTA IS NULL";
    
    if ($nombreBuscar != "") $sql .= " AND ARMA.ARM_NUMEROSERIE like '%".$nombreBuscar."%' ";
		$sql .= " ORDER BY ".$campoOrdenar;
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) )  {
			$tipo = new tipoArma;
			$tipo->setCodigo(STRTOUPPER($myrow["TARM_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TARM_DESCRIPCION"]));
			
			$marca = new marcaArma;
			$marca->setCodigo(STRTOUPPER($myrow["MARM_CODIGO"]));
			$marca->setDescripcion(STRTOUPPER($myrow["MARM_DESCRIPCION"]));
			
			$modelo = new modeloArma;
			$modelo->setMarcaArma($marca);
			$modelo->setCodigo(STRTOUPPER($myrow["MODARM_CODIGO"]));
			$modelo->setDescripcion(STRTOUPPER($myrow["MODARM_DESCRIPCION"]));
			
			$estado = new estadoRecurso;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
      
			$seccion = new seccion; 
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$arma = new arma;
			$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
			$arma->setTipo($tipo);
			$arma->setModelo($modelo);
			$arma->setEstado($estado);
			$arma->setNumeroSerie(STRTOUPPER($myrow["ARM_NUMEROSERIE"]));
			$arma->setUnidad("");
			$arma->setUnidadAgregado($unidadAgregado);
			$arma->setSeccion($seccion);
      
			$armas[$i] = $arma;
			$i++;
		}
	}
		
	/* Agregadas */
	function listaTotalArmasAgregadas($unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $armas){
		
		if ($NombreCampo == "tipo")  $campoOrdenar = "TIPO_ARMA.TARM_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "marca") $campoOrdenar = "MARCA_ARMA.MARM_DESCRIPCION, MODELO_ARMA.MODARM_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "serie")  $campoOrdenar = "ARMA.ARM_NUMEROSERIE ".$TipoOrden;
		if ($NombreCampo == "seccion")  $campoOrdenar = "TIPO_SECCION.SEC_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "estado")  $campoOrdenar = "ESTADO.EST_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "unidad")  $campoOrdenar = "UNIDAD.UNI_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "") $campoOrdenar = "ARMA.TARM_CODIGO, ARMA.ARM_CODIGO ASC";
		
    $sql = "SELECT 
		  ARMA.ARM_CODIGO,
		  ARMA.MODARM_CODIGO,
		  MODELO_ARMA.MODARM_DESCRIPCION,
		  MODELO_ARMA.MARM_CODIGO,
		  MARCA_ARMA.MARM_DESCRIPCION,
		  ARMA.UNI_CODIGO,
		  UNIDAD.UNI_DESCRIPCION,
		  ARMA.TARM_CODIGO,
		  TIPO_ARMA.TARM_DESCRIPCION,
		  ARMA.ARM_NUMEROSERIE,
		  ESTADO.EST_CODIGO,
		  ESTADO.EST_DESCRIPCION,
		  ESTADO_ARMA.UNI_CODIGO AS Cod_Origen,
			UNIDAD.UNI_DESCRIPCION AS Des_Origen,
     	TIPO_SECCION.SEC_DESCRIPCION
			FROM  ARMA
		  INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
		  INNER JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
		  INNER JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
		  INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
		  LEFT OUTER JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
		  LEFT OUTER JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
		  LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ARMA.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
      LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ARMA.SEC_CODIGO)
			WHERE ESTADO_ARMA.UNI_AGREGADO = ".$unidad." AND ESTADO_ARMA.FECHA_HASTA IS NULL";
    
    if ($nombreBuscar != "") $sql .= " AND ARMA.ARM_NUMEROSERIE like '%".$nombreBuscar."%' ";
    $sql .= " ORDER BY ".$campoOrdenar;
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
			$tipo = new tipoArma;
			$tipo->setCodigo(STRTOUPPER($myrow["TARM_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TARM_DESCRIPCION"]));
			
			$marca = new marcaArma;
			$marca->setCodigo(STRTOUPPER($myrow["MARM_CODIGO"]));
			$marca->setDescripcion(STRTOUPPER($myrow["MARM_DESCRIPCION"]));
			
			$modelo = new modeloArma;
			$modelo->setMarcaArma($marca);
			$modelo->setCodigo(STRTOUPPER($myrow["MODARM_CODIGO"]));
			$modelo->setDescripcion(STRTOUPPER($myrow["MODARM_DESCRIPCION"]));
			
			$estado = new estadoRecurso;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["Cod_Origen"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["Des_Origen"]));
      
		  $seccion = new seccion;
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$arma = new arma;
			$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
			$arma->setTipo($tipo);
			$arma->setModelo($modelo);
			$arma->setEstado($estado);
			$arma->setNumeroSerie(STRTOUPPER($myrow["ARM_NUMEROSERIE"]));
			$arma->setUnidad("");
			$arma->setUnidadAgregado($unidadAgregado);
      $arma->setSeccion($seccion);
			$armas[$i] = $arma;
			$i++;
		}
	}
	
	function listaArmasDisponibles($unidad, $fechaServicio, $tipoServicio, $horaInicio, $horaTermino, $correlativo, $armas){			
		
		$listaExcluyente 	= $this->listaArmasExcluyentes($unidad, $fechaServicio, $tipoServicio, $horaInicio, $horaTermino, $correlativo);
		$sqlExcluyente 		= "AND ARMA.ARM_CODIGO NOT IN ({$listaExcluyente})";
		
		$sql = "(SELECT 
					ARMA.ARM_CODIGO,
					TIPO_ARMA.TARM_DESCRIPCION,
					ARMA.ARM_NUMEROSERIE
				FROM ARMA
				JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
				JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
				WHERE ESTADO_ARMA.UNI_CODIGO = {$unidad}
				AND (ESTADO_ARMA.FECHA_DESDE <= '{$fechaServicio}' AND (ESTADO_ARMA.FECHA_HASTA > '{$fechaServicio}' OR ESTADO_ARMA.FECHA_HASTA IS NULL)) 
				AND ESTADO_ARMA.EST_CODIGO = 10
				{$sqlExcluyente})
				UNION 
				(SELECT 
					ARMA.ARM_CODIGO,
					TIPO_ARMA.TARM_DESCRIPCION,
					ARMA.ARM_NUMEROSERIE
				FROM ARMA
				JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
				JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
				WHERE ESTADO_ARMA.UNI_AGREGADO = {$unidad}
				AND (ESTADO_ARMA.FECHA_DESDE <= '{$fechaServicio}' AND (ESTADO_ARMA.FECHA_HASTA > '{$fechaServicio}' OR ESTADO_ARMA.FECHA_HASTA IS NULL)) 
				AND ESTADO_ARMA.EST_CODIGO  = 3000
				{$sqlExcluyente})
				ORDER BY TARM_DESCRIPCION, ARM_CODIGO";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ){
			$tipo = new tipoArma;
			$tipo->setCodigo("");
			$tipo->setDescripcion(STRTOUPPER($myrow["TARM_DESCRIPCION"]));
			
			$arma = new arma;
			$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
			$arma->setTipo($tipo);
			$arma->setNumeroSerie(STRTOUPPER($myrow["ARM_NUMEROSERIE"]));
			
			$armas[$i] = $arma;
			$i++;
		}
	}
	
	function listaArmasExcluyentes($unidad, $fechaServicio, $servicio, $horaI, $horaT, $correlativo){
		
		$sql = "SELECT ARMA_SERVICIO.ARM_CODIGO
						FROM ARMA_SERVICIO
						JOIN SERVICIO ON (ARMA_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO AND ARMA_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
						WHERE SERVICIO.FECHA = '{$fechaServicio}' AND SERVICIO.UNI_CODIGO = {$unidad}
						AND (SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) BETWEEN SERVICIO.HORA_INICIO AND SERVICIO.HORA_TERMINO
						OR SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1) BETWEEN SERVICIO.HORA_INICIO AND SERVICIO.HORA_TERMINO
						OR SERVICIO.HORA_INICIO BETWEEN SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) AND SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1))";
		
		//Servicio existente
		if($correlativo != "" && $correlativo != "-1") $sql .= " OR (SERVICIO.UNI_CODIGO = {$unidad} AND SERVICIO.CORRELATIVO_SERVICIO = {$correlativo})";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$listaArmas = "'',";
		while($myrow = mysql_fetch_array($result)){
			$listaArmas .= "'{$myrow['ARM_CODIGO']}',";
		}
    $listaArmas = substr($listaArmas, 0, strlen($listaArmas)-1);
    return $listaArmas;
	}
	
	function buscaDatosArma($armaBuscar, $arma){
		
    $sql = "SELECT 
						  ARMA.ARM_CODIGO,
						  ARMA.MODARM_CODIGO,
						  MODELO_ARMA.MODARM_DESCRIPCION,
						  MODELO_ARMA.MARM_CODIGO,
						  MARCA_ARMA.MARM_DESCRIPCION,
						  ARMA.UNI_CODIGO,
						  UNIDAD.UNI_DESCRIPCION,
						  ARMA.TARM_CODIGO,
						  TIPO_ARMA.TARM_DESCRIPCION,
						  ARMA.ARM_NUMEROSERIE,
						  ESTADO.EST_CODIGO,
						  ESTADO.EST_DESCRIPCION,
						  ESTADO_ARMA.FECHA_DESDE,
						  ARMA.ARM_BCU,
						  ESTADO_ARMA.UNI_AGREGADO,
						  UNIDAD_AGREGADO.UNI_DESCRIPCION AS DES_UNIDADGREGADO,
	            TIPO_SECCION.SEC_CODIGO,
	            TIPO_SECCION.SEC_DESCRIPCION
						FROM ARMA
						JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
						JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
						LEFT JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
						JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
						LEFT JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
						LEFT JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
						LEFT JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ARMA.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
	          LEFT JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ARMA.SEC_CODIGO)
						WHERE ARMA.ARM_CODIGO = ".$armaBuscar." AND ESTADO_ARMA.FECHA_HASTA IS NULL";
    
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
			$tipo = new tipoArma;
			$tipo->setCodigo(STRTOUPPER($myrow["TARM_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TARM_DESCRIPCION"]));
			
			$marca = new marcaArma;
			$marca->setCodigo(STRTOUPPER($myrow["MARM_CODIGO"]));
			$marca->setDescripcion(STRTOUPPER($myrow["MARM_DESCRIPCION"]));
			
			$modelo = new modeloArma;
			$modelo->setMarcaArma($marca);
			$modelo->setCodigo(STRTOUPPER($myrow["MODARM_CODIGO"]));
			$modelo->setDescripcion(STRTOUPPER($myrow["MODARM_DESCRIPCION"]));
							
			$estado = new estadoRecurso;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			$estado->setFechaDesde($myrow["FECHA_DESDE"]);
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DES_UNIDADGREGADO"]));
      
      $seccion = new seccion;
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$arma = new arma;
			$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
			$arma->setTipo($tipo);
			$arma->setModelo($modelo);
			$arma->setEstado($estado);
			$arma->setNumeroSerie(STRTOUPPER($myrow["ARM_NUMEROSERIE"]));
			$arma->setUnidad($unidad);
			$arma->setNumeroBCU($myrow["ARM_BCU"]);
			$arma->setUnidadAgregado($unidadAgregado);
 	    $arma->setSeccion($seccion);
		}
	}
	
	function buscaDatosArmaPorSerie($armaBuscar, $arma){
		
		$sql = "SELECT ARMA.ARM_CODIGO
						FROM ARMA
						JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
						JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
						LEFT JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
						JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
						LEFT JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
						LEFT JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
						WHERE ARMA.ARM_NUMEROSERIE = '".$armaBuscar."' AND ESTADO_ARMA.FECHA_HASTA IS NULL";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) )  {
			$arma = new arma;
			$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
		}
	}
	
	function updateArma($arma){
		
		$sql = "UPDATE ARMA SET
						ARM_NUMEROSERIE = '".$arma->getNumeroSerie(). "',
						UNI_CODIGO = '".$arma->getUnidad()->getCodigoUnidad(). "',
						TARM_CODIGO = ".$arma->getTipo()->getCodigo(). ",
						MODARM_CODIGO = '".$arma->getModelo()->getCodigo(). "',
						ARM_BCU = '".$arma->getNumeroBCU(). "'
						WHERE ARM_CODIGO ='" . $arma->getCodigo(). "'";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		return $result;
	}
	
	function updateEstadoArma($arma, $fechaNuevoEstado){
		
		$sql = "UPDATE ESTADO_ARMA SET
						FECHA_HASTA = '".$fechaNuevoEstado."'
						WHERE ARM_CODIGO = ".$arma->getCodigo()." AND FECHA_HASTA IS NULL";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
  function insertEstadoArma($arma, $fechaNuevoEstado){
		
		if ($arma->getUnidadAgregado()->getCodigoUnidad() == 0) $unidadAgregadoGuardar = 'NULL';
		else $unidadAgregadoGuardar = $arma->getUnidadAgregado()->getCodigoUnidad();
    
    if ($arma->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
		else $seccionGuardar = $arma->getSeccion()->getCodigo();
		
		$sql = "INSERT INTO ESTADO_ARMA (EST_CODIGO, UNI_CODIGO, ARM_CODIGO, FECHA_DESDE, UNI_AGREGADO, SEC_CODIGO) 
						VALUES (".$arma->getEstado()->getCodigo().",".$arma->getUnidad()->getCodigoUnidad().",".$arma->getCodigo().",'".$fechaNuevoEstado."',".$unidadAgregadoGuardar.",".$seccionGuardar.")";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function nuevaArma($arma){ 
		
		$sql = "INSERT INTO ARMA 
			   		(ARM_NUMEROSERIE, TARM_CODIGO, MODARM_CODIGO, UNI_CODIGO) VALUES
		 	   		('".$arma->getNumeroSerie()."',
			 	     '".$arma->getTipo()->getCodigo()."',
			 	     ".$arma->getModelo()->getCodigo().",
			 	     '".$arma->getUnidad()->getCodigoUnidad()."')";
		
		//echo $sql ."\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return mysql_insert_id($this->Conecta());
	}
	
	function dejarDisponible($arma, $fecha){
		
		$sql = "UPDATE ARMA SET UNI_CODIGO = NULL WHERE ARM_CODIGO = " . $arma->getCodigo();
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function bajaArma($arma, $motivo, $fechaBaja){ 
		
		if ($arma->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
		else $seccionGuardar = $arma->getSeccion()->getCodigo();
		
		$sql = "INSERT INTO ESTADO_ARMA (EST_CODIGO, UNI_CODIGO, ARM_CODIGO, FECHA_DESDE, FECHA_HASTA, SEC_CODIGO)
						VALUES (".$arma->getEstado()->getCodigo().",".$arma->getUnidad()->getCodigoUnidad().",".$arma->getCodigo().",'".$fechaBaja."','".$fechaBaja."',".$seccionGuardar.");";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
				
}//end class        
?>