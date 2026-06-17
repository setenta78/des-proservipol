<?
Class dbVehiculos extends Conexion {

	function listaTotalVehiculos($unidad, $nombreBuscar, $tipoVehiculo, $NombreCampo, $TipoOrden, $tipoEstado, $vehiculos){
		
		if ($NombreCampo == "tipo") $campoOrdenar = "TV.TVEH_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "marca") $campoOrdenar = "M.MVEH_DESCRIPCION, MO.MODVEH_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "patente") $campoOrdenar = "V.VEH_PATENTE {$TipoOrden}";
		if ($NombreCampo == "codigoEquipo") $campoOrdenar = "V.VEH_COD_EQUIPO_SAP {$TipoOrden}";
		if ($NombreCampo == "sap") $campoOrdenar = "V.VEH_SAP {$TipoOrden}";
		if ($NombreCampo == "seccion") $campoOrdenar = "TS.SEC_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "estado") $campoOrdenar = "E.EST_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "unidad") $campoOrdenar = "UA.UNI_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "nroTarjeta") $campoOrdenar = "NRO_TARJETA {$TipoOrden}";
		if ($NombreCampo == "") $campoOrdenar = "V.TVEH_CODIGO, V.VEH_PATENTE ASC";
		
		$sql = "SELECT 
					V.VEH_NUMEROINSITUCIONAL,
					V.VEH_PATENTE,
					V.VEH_CODIGO,
					V.TVEH_CODIGO,
					V.VEH_COD_EQUIPO_SAP,
					V.VEH_SAP,
					TV.TVEH_DESCRIPCION,
					MO.MODVEH_CODIGO,
					MO.MODVEH_DESCRIPCION,
					M.MVEH_CODIGO,
					M.MVEH_DESCRIPCION,
					E.EST_CODIGO,
					E.EST_DESCRIPCION,
					V.PREC_CODIGO,
					P.PREC_DESCRIPCION,
					V.UNI_CODIGO,
					EV.UNI_AGREGADO,
					UA.UNI_DESCRIPCION,
					EV.SEC_CODIGO,
					TS.SEC_DESCRIPCION,
					CONCAT(TC.TC_NRO_TARJETA,'-',	TC.TC_NRO_TARJETA_DV) NRO_TARJETA
				FROM VEHICULO V
				LEFT JOIN ESTADO_VEHICULO EV ON EV.VEH_CODIGO = V.VEH_CODIGO
				LEFT JOIN ESTADO E ON EV.EST_CODIGO = E.EST_CODIGO
				JOIN UNIDAD U ON V.UNI_CODIGO = U.UNI_CODIGO
				LEFT JOIN PROCEDENCIA_RECURSO P ON V.PREC_CODIGO = P.PREC_CODIGO
				JOIN TIPO_VEHICULO TV ON V.TVEH_CODIGO = TV.TVEH_CODIGO
				LEFT JOIN MODELO_VEHICULO MO ON V.MODVEH_CODIGO = MO.MODVEH_CODIGO
				LEFT JOIN MARCA_VEHICULO M ON V.MVEH_CODIGO = M.MVEH_CODIGO
				LEFT JOIN UNIDAD UA ON EV.UNI_AGREGADO = UA.UNI_CODIGO
				LEFT JOIN TIPO_SECCION TS ON EV.SEC_CODIGO = TS.SEC_CODIGO
				LEFT JOIN TARJETA_COMBUSTIBLE TC ON TC.COD_VEH = V.VEH_CODIGO AND TC.TC_FECHA_HASTA IS NULL
				WHERE V.UNI_CODIGO = {$unidad} AND EV.FECHA_HASTA IS NULL";
		
		if ($tipoVehiculo != "") $sql .= " AND V.TVEH_CODIGO = {$tipoVehiculo}";
		if ($nombreBuscar != "") $sql .= " AND V.VEH_PATENTE like '%{$nombreBuscar}%'";
		
		$sql .= " ORDER BY {$campoOrdenar}";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) )  {
			$tipo = new tipoVehiculo;
			$tipo->setCodigo(STRTOUPPER($myrow["TVEH_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TVEH_DESCRIPCION"]));
			
			$procedencia = new procedenciaVehiculo;
			$procedencia->setCodigo(STRTOUPPER($myrow["PREC_CODIGO"]));
			$procedencia->setDescripcion(STRTOUPPER($myrow["PREC_DESCRIPCION"]));
			
			$marca = new marcaVehiculo;
			$marca->setCodigo(STRTOUPPER($myrow["MVEH_CODIGO"]));
			$marca->setDescripcion(STRTOUPPER($myrow["MVEH_DESCRIPCION"]));
			
			$modelo = new modeloVehiculo;
			$modelo->setMarca($marca);
			$modelo->setCodigo(STRTOUPPER($myrow["MODVEH_CODIGO"]));
			$modelo->setDescripcion(STRTOUPPER($myrow["MODVEH_DESCRIPCION"]));
			
			$estado = new estadoVehiculo;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			
			$seccion = new seccion;
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$vehiculo = new vehiculo;
			$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["VEH_CODIGO"]));
			$vehiculo->setTipoVehiculo($tipo);
			$vehiculo->setModeloVehiculo($modelo);
			$vehiculo->setEstadoVehiculo($estado);
			$vehiculo->setPatente(STRTOUPPER($myrow["VEH_PATENTE"]));
			$vehiculo->setNumeroInstitucional(STRTOUPPER($myrow["VEH_NUMEROINSITUCIONAL"]));
			$vehiculo->setProcedencia($procedencia);
			$vehiculo->setCodigoEquipo($myrow["VEH_COD_EQUIPO_SAP"]);
			$vehiculo->setUnidadAgregado($unidadAgregado);
      		$vehiculo->setSeccion($seccion);
      		$vehiculo->setNumeroSAP($myrow["VEH_SAP"]);
      		$vehiculo->setNumeroSAP($myrow["VEH_SAP"]);
			$vehiculo->setTarjetaCombustible($myrow["NRO_TARJETA"]);
			
			$vehiculos[$i] = $vehiculo;					
			$i++;
		}
	}
	
	function listaTotalVehiculosAgregados($unidad, $nombreBuscar, $tipoVehiculo, $NombreCampo, $TipoOrden, $tipoEstado, $vehiculos){
		
		if ($NombreCampo == "tipo")  $campoOrdenar = "TV.TVEH_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "marca") $campoOrdenar = "M.MVEH_DESCRIPCION, MO.MODVEH_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "patente")  $campoOrdenar = "V.VEH_PATENTE {$TipoOrden}";
		if ($NombreCampo == "codigoEquipo")  $campoOrdenar = "V.VEH_COD_EQUIPO_SAP {$TipoOrden}";
		if ($NombreCampo == "seccion")  $campoOrdenar = "TS.SEC_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "estado")  $campoOrdenar = "E.EST_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "unidad")  $campoOrdenar = "UA.UNI_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "nroTarjeta") $campoOrdenar = "NRO_TARJETA {$TipoOrden}";
		if ($NombreCampo == "") $campoOrdenar = "V.TVEH_CODIGO, V.VEH_PATENTE ASC";
		
		$sql = "SELECT 
					V.VEH_NUMEROINSITUCIONAL,
					V.VEH_PATENTE,
					V.VEH_CODIGO,
					V.TVEH_CODIGO,
					V.VEH_COD_EQUIPO_SAP,
					V.VEH_SAP,
					TV.TVEH_DESCRIPCION,
					MO.MODVEH_CODIGO,
					MO.MODVEH_DESCRIPCION,
					M.MVEH_CODIGO,
					M.MVEH_DESCRIPCION,
					E.EST_CODIGO,
					E.EST_DESCRIPCION,
					V.PREC_CODIGO,
					P.PREC_DESCRIPCION,
					V.UNI_CODIGO,
					EV.UNI_CODIGO Cod_Origen,
					U.UNI_DESCRIPCION Des_Origen,
					EV.SEC_CODIGO,
					TS.SEC_DESCRIPCION,
					CONCAT(TC.TC_NRO_TARJETA,'-',	TC.TC_NRO_TARJETA_DV) NRO_TARJETA
				FROM VEHICULO V
				JOIN ESTADO_VEHICULO EV ON EV.VEH_CODIGO = V.VEH_CODIGO
				JOIN ESTADO E ON EV.EST_CODIGO = E.EST_CODIGO
				JOIN UNIDAD U ON V.UNI_CODIGO = U.UNI_CODIGO
				LEFT JOIN PROCEDENCIA_RECURSO P ON V.PREC_CODIGO = P.PREC_CODIGO
				JOIN TIPO_VEHICULO TV ON V.TVEH_CODIGO = TV.TVEH_CODIGO
				LEFT JOIN MODELO_VEHICULO MO ON V.MODVEH_CODIGO = MO.MODVEH_CODIGO
				LEFT JOIN MARCA_VEHICULO M ON V.MVEH_CODIGO = M.MVEH_CODIGO
				LEFT JOIN UNIDAD UA ON EV.UNI_AGREGADO = UA.UNI_CODIGO
				LEFT JOIN TIPO_SECCION TS ON EV.SEC_CODIGO = TS.SEC_CODIGO
				LEFT JOIN TARJETA_COMBUSTIBLE TC ON TC.COD_VEH = V.VEH_CODIGO AND TC.TC_FECHA_HASTA IS NULL
				WHERE EV.UNI_AGREGADO = {$unidad} AND EV.FECHA_HASTA IS NULL";
		
		if($tipoVehiculo != "") $sql .= " AND V.TVEH_CODIGO = {$tipoVehiculo}";
		if($nombreBuscar != "") $sql .= " AND V.VEH_PATENTE like '%{$nombreBuscar}%'";

		$sql .= " ORDER BY {$campoOrdenar}";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) )  {
			$tipo = new tipoVehiculo;
			$tipo->setCodigo(STRTOUPPER($myrow["TVEH_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TVEH_DESCRIPCION"]));
			
			$procedencia = new procedenciaVehiculo;
			$procedencia->setCodigo(STRTOUPPER($myrow["PREC_CODIGO"]));
			$procedencia->setDescripcion(STRTOUPPER($myrow["PREC_DESCRIPCION"]));
			
			$marca = new marcaVehiculo;
			$marca->setCodigo(STRTOUPPER($myrow["MVEH_CODIGO"]));
			$marca->setDescripcion(STRTOUPPER($myrow["MVEH_DESCRIPCION"]));
			
			$modelo = new modeloVehiculo;
			$modelo->setMarca($marca);
			$modelo->setCodigo(STRTOUPPER($myrow["MODVEH_CODIGO"]));
			$modelo->setDescripcion(STRTOUPPER($myrow["MODVEH_DESCRIPCION"]));
			
			$estado = new estadoVehiculo;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["Cod_Origen"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["Des_Origen"]));
			
			$seccion = new seccion;
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$vehiculo = new vehiculo;
			$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["VEH_CODIGO"]));
			$vehiculo->setTipoVehiculo($tipo);
			$vehiculo->setModeloVehiculo($modelo);
			$vehiculo->setEstadoVehiculo($estado);
			$vehiculo->setPatente(STRTOUPPER($myrow["VEH_PATENTE"]));
			$vehiculo->setNumeroInstitucional(STRTOUPPER($myrow["VEH_NUMEROINSITUCIONAL"]));
			$vehiculo->setProcedencia($procedencia);
			$vehiculo->setCodigoEquipo($myrow["VEH_COD_EQUIPO_SAP"]);
			$vehiculo->setUnidadAgregado($unidadAgregado);
			$vehiculo->setSeccion($seccion);
			$vehiculo->setTarjetaCombustible($myrow["NRO_TARJETA"]);
			
			$vehiculos[$i] = $vehiculo;
			$i++;
		}
	}
	/*-----------------------------------------------------------------------------------------------------------*/
	
	function buscaDatosVehiculo($vehiculoBuscar, $codigoEquipo, $vehiculos){

		$sql = "SELECT 
					V.VEH_NUMEROINSITUCIONAL,
					V.VEH_PATENTE,
					V.VEH_CODIGO,
					V.VEH_COD_EQUIPO_SAP,
					V.VEH_SAP,
					V.TVEH_CODIGO,
					T.TVEH_DESCRIPCION,
					V.MODVEH_CODIGO,
					MO.MODVEH_DESCRIPCION,
					V.MVEH_CODIGO,
					M.MVEH_DESCRIPCION,
					E.EST_CODIGO,
					E.EST_DESCRIPCION,
					V.PREC_CODIGO,
					P.PREC_DESCRIPCION,
					V.UNI_CODIGO,
					V.ANNO_FABRICACION,
					V.VALIDA_ANNO_FABRICACION,
					U.UNI_DESCRIPCION,
					EV.FECHA_DESDE,
					EV.UNI_AGREGADO,
					UA.UNI_DESCRIPCION AS DES_UNIDADGREGADO,
					EV.EST_LUGARREPARACION,
					L.LREP_DESCRIPCION,
					EV.SEC_CODIGO,
					TS.SEC_DESCRIPCION,
					EV.TFALLA_CODIGO,
					TF.TFALLA_DESCRIPCION,
					EV.TCLASIFICACION_CITACION_CODIGO,
					CONCAT(TC.TC_NRO_TARJETA,'-',	TC.TC_NRO_TARJETA_DV) NRO_TARJETA
				FROM VEHICULO V
				LEFT JOIN ESTADO_VEHICULO EV ON (EV.VEH_CODIGO = V.VEH_CODIGO 
											AND EV.CORRELATIVO_ESTADOVEHICULO = (SELECT MAX(EA.CORRELATIVO_ESTADOVEHICULO) C
																				FROM ESTADO_VEHICULO EA 
																				WHERE EA.VEH_CODIGO = V.VEH_CODIGO))
				LEFT JOIN ESTADO E ON EV.EST_CODIGO = E.EST_CODIGO
				LEFT JOIN UNIDAD U ON V.UNI_CODIGO = U.UNI_CODIGO
				LEFT JOIN PROCEDENCIA_RECURSO P ON V.PREC_CODIGO = P.PREC_CODIGO
				LEFT JOIN TIPO_VEHICULO T ON V.TVEH_CODIGO = T.TVEH_CODIGO
				LEFT JOIN MODELO_VEHICULO MO ON V.MODVEH_CODIGO = MO.MODVEH_CODIGO
				LEFT JOIN MARCA_VEHICULO M ON V.MVEH_CODIGO = M.MVEH_CODIGO
				LEFT JOIN UNIDAD UA ON EV.UNI_AGREGADO = UA.UNI_CODIGO
				LEFT JOIN LUGAR_REPARACION L ON EV.EST_LUGARREPARACION = L.LREP_CODIGO
				LEFT JOIN TIPO_FALLA_VEHICULO TF ON EV.TFALLA_CODIGO = TF.TFALLA_CODIGO
				LEFT JOIN TIPO_SECCION TS ON EV.SEC_CODIGO = TS.SEC_CODIGO
				LEFT JOIN TARJETA_COMBUSTIBLE TC ON TC.COD_VEH = V.VEH_CODIGO AND TC.TC_FECHA_HASTA IS NULL";
		
		if($vehiculoBuscar != "") $sql .= " WHERE V.VEH_CODIGO = {$vehiculoBuscar}";
		if($codigoEquipo != "") $sql .= " WHERE V.VEH_COD_EQUIPO_SAP = '{$codigoEquipo}'";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
			
			$tipo = new tipoVehiculo;
			$tipo->setCodigo(STRTOUPPER($myrow["TVEH_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TVEH_DESCRIPCION"]));
				
			$procedencia = new procedenciaVehiculo;
			$procedencia->setCodigo(STRTOUPPER($myrow["PREC_CODIGO"]));
			$procedencia->setDescripcion(STRTOUPPER($myrow["PREC_DESCRIPCION"]));
				
			$marca = new marcaVehiculo;
			$marca->setCodigo(STRTOUPPER($myrow["MVEH_CODIGO"]));
			$marca->setDescripcion(STRTOUPPER($myrow["MVEH_DESCRIPCION"]));
				
			if ($myrow["MODVEH_CODIGO"] == ""){
				$codigoModelo = 1;	
				$descripcionModelo = "NO INDICA MODELO";
			} else {
				$codigoModelo = $myrow["MODVEH_CODIGO"];	
				$descripcionModelo = $myrow["MODVEH_DESCRIPCION"];
			}
			
			if ($myrow["TFALLA_DESCRIPCION"] == ""){
				$codigoFalla = 1;	
				$descripcionFalla = "NO INDICA FALLA";
			} else {
				$codigoFalla = $myrow["TFALLA_CODIGO"];	
				$descripcionFalla = $myrow["TFALLA_DESCRIPCION"];
			}
			
			$modelo = new modeloVehiculo;
			$modelo->setMarca($marca);
			$modelo->setCodigo(STRTOUPPER($codigoModelo));
			$modelo->setDescripcion(STRTOUPPER($descripcionModelo));
			
			$estado = new estadoRecurso;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			$estado->setFechaDesde($myrow["FECHA_DESDE"]);
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DES_UNIDADGREGADO"]));
			
			$lugarDeReparacion = new lugarReparacion;
			$lugarDeReparacion->setCodigo(STRTOUPPER($myrow["EST_LUGARREPARACION"]));
			$lugarDeReparacion->setDescripcion(STRTOUPPER($myrow["LREP_DESCRIPCION"]));
			
			$tipoFallaVehiculo = new fallaVehiculo;
			$tipoFallaVehiculo->setCodigo(STRTOUPPER($codigoFalla));
			$tipoFallaVehiculo->setDescripcion(STRTOUPPER($descripcionFalla));
			
			$seccion = new seccion;
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$clasificacionCitacion = new clasificacionCitacion;
			$clasificacionCitacion->setCodigo(STRTOUPPER($myrow["TCLASIFICACION_CITACION_CODIGO"]));
			
			$vehiculo = new vehiculo;
			$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["VEH_CODIGO"]));
			$vehiculo->setTipoVehiculo($tipo);
			$vehiculo->setModeloVehiculo($modelo);
			$vehiculo->setEstadoVehiculo($estado);
			$vehiculo->setPatente(STRTOUPPER($myrow["VEH_PATENTE"]));
			$vehiculo->setNumeroInstitucional(STRTOUPPER($myrow["VEH_NUMEROINSITUCIONAL"]));
			$vehiculo->setProcedencia($procedencia);
			$vehiculo->setUnidad($unidad);	
			$vehiculo->setCodigoEquipo($myrow["VEH_COD_EQUIPO_SAP"]);
			$vehiculo->setUnidadAgregado($unidadAgregado);
			$vehiculo->setLugarReparacion($lugarDeReparacion);
			$vehiculo->setTipoFallaVehiculo($tipoFallaVehiculo);
			$vehiculo->setSeccion($seccion);
			$vehiculo->setClasificacionCitacion($clasificacionCitacion);
			$vehiculo->setAnnoFabricacion(STRTOUPPER($myrow["ANNO_FABRICACION"]));
			$vehiculo->setValidaAnnoFabricacion(STRTOUPPER($myrow["VALIDA_ANNO_FABRICACION"]));
			$vehiculo->setNumeroSAP($myrow["VEH_SAP"]);
			$vehiculo->setTarjetaCombustible($myrow["NRO_TARJETA"]);
			
			$vehiculos[$i] = $vehiculo;
			$i++;
		}
	}
	
	function updateVehiculo($vehiculo){
		
		$modeloVehiculo = $vehiculo->getModeloVehiculo()->getCodigo();
		if ($modeloVehiculo == 1) $modeloVehiculo = "Null";
		
		$sql = "UPDATE VEHICULO SET
				UNI_CODIGO = {$vehiculo->getUnidad()->getCodigoUnidad()}
				WHERE VEH_CODIGO = {$vehiculo->getCodigoVehiculo()}";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
		
	function updateEstadoVehiculo($vehiculo, $fechaNuevoEstado){
		
		$sql = "UPDATE ESTADO_VEHICULO SET
				FECHA_HASTA = '{$fechaNuevoEstado}'
				WHERE VEH_CODIGO = {$vehiculo->getCodigoVehiculo()} AND FECHA_HASTA IS NULL";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function insertEstadoVehiculo($vehiculo, $fechaNuevoEstado){
		
		if ($vehiculo->getLugarReparacion()->getCodigo() == 0 ) $lugarDeRepacionGuardar = 'NULL';
		else $lugarDeRepacionGuardar = $vehiculo->getLugarReparacion()->getCodigo();
		
		if ($vehiculo->getUnidadAgregado()->getCodigoUnidad() == 0) $unidadAgregadoGuardar = 'NULL';
		else $unidadAgregadoGuardar = $vehiculo->getUnidadAgregado()->getCodigoUnidad();
	
      	if ($vehiculo->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
		else $seccionGuardar = $vehiculo->getSeccion()->getCodigo();
		
		if ($vehiculo->getTipoFallaVehiculo()->getCodigo() == 0 ) $tipoFallaGuardar = 'NULL';
		else $tipoFallaGuardar = $vehiculo->getTipoFallaVehiculo()->getCodigo();
		
		$sql = "INSERT INTO ESTADO_VEHICULO (VEH_CODIGO, UNI_CODIGO, EST_CODIGO, FECHA_DESDE, EST_DOCUMENTO, UNI_AGREGADO, EST_LUGARREPARACION, TFALLA_CODIGO, SEC_CODIGO, TCLASIFICACION_CITACION_CODIGO)
				VALUES ({$vehiculo->getCodigoVehiculo()},{$vehiculo->getUnidad()->getCodigoUnidad()},{$vehiculo->getEstadoVehiculo()->getCodigo()},'{$fechaNuevoEstado}','{$vehiculo->getDocumentoEstado()}',{$unidadAgregadoGuardar},{$lugarDeRepacionGuardar},{$tipoFallaGuardar},{$seccionGuardar},{$vehiculo->getClasificacionCitacion()->getCodigo()})";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function dejarDisponible($vehiculo, $fecha){
		
		$sql = "UPDATE VEHICULO SET UNI_CODIGO = Null WHERE VEH_CODIGO = {$vehiculo->getCodigoVehiculo()}";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function bajaVehiculo($vehiculo, $motivo, $fecha){ 
		
		$sql = "INSERT INTO ESTADO_VEHICULO (VEH_CODIGO, UNI_CODIGO, EST_CODIGO, FECHA_DESDE, FECHA_HASTA)
				VALUES ({$vehiculo->getCodigoVehiculo()},{$vehiculo->getUnidad()->getCodigoUnidad()},{$vehiculo->getEstadoVehiculo()->getCodigo()},'{$fecha}','{$fecha}');";
		
		//echo $sql;		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function nuevoVehiculo($vehiculo){ 
		
		$modeloVehiculo = $vehiculo->getModeloVehiculo()->getCodigo();
		if ($modeloVehiculo == 1) $modeloVehiculo = "Null";

		$sql = "INSERT INTO VEHICULO 
				(TVEH_CODIGO, PREC_CODIGO, VEH_COD_EQUIPO_SAP, UNI_CODIGO, MVEH_CODIGO, MODVEH_CODIGO, VEH_PATENTE, VEH_NUMEROINSITUCIONAL, ANNO_FABRICACION, VALIDA_ANNO_FABRICACION) VALUES
				( {$vehiculo->getTipoVehiculo()->getCodigo()},
				{$vehiculo->getProcedencia()->getCodigo()},
				'{$vehiculo->getCodigoEquipo()}',
				{$vehiculo->getUnidad()->getCodigoUnidad()},
				{$vehiculo->getModeloVehiculo()->getMarca()->getCodigo()},
				{$modeloVehiculo},
				'{$vehiculo->getPatente()}',
				'{$vehiculo->getNumeroInstitucional()}',
				{$vehiculo->getAnnoFabricacion()},
				{$vehiculo->getValidaAnnoFabricacion()})";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return mysql_insert_id($this->Conecta()); 
	}
	
	function insertHistoricoEstado($nuevoEstadoHistorico, $usuario){
		
		$fechaActual = date("Y-m-d",time ());
		$horaActual  = date("H:s",time ());

		$sql = "INSERT INTO VEHICULO_ESTADO_HISTORICO 
				(VEH_ID, EST_CODIGO, FECHA, UNI_CODIGO, FECHA_INGRESO, HORA_INGRESO, USUARIO_INGRESO) VALUES 
				({$nuevoEstadoHistorico->getVehiculo()->getCodigoVehiculo()},
				 {$nuevoEstadoHistorico->getEstado()->getCodigo()},
				'{$nuevoEstadoHistorico->getFecha()}',
				'{$nuevoEstadoHistorico->getUnidad()->getCodigoUnidad()}',
				'{$fechaActual}',
				'{$horaActual}',
				'{$usuario}');";
		
		//echo $sql;					
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function listaEstadoHistoricoVehiculo($vehiculoId, $listaHistoricoEstados){
		
		$sql = "SELECT 
					VEHICULO_ESTADO_HISTORICO.FECHA,
					VEHICULO_ESTADO_HISTORICO.UNI_CODIGO,
					UNIDADES.UN_DESCRIPCION,
					VEHICULO_ESTADO_HISTORICO.EST_CODIGO,
					ESTADO_VEHICULO.EST_DESCRIPCION
				FROM UNIDADES
				JOIN VEHICULO_ESTADO_HISTORICO ON (unidades.Un_Id = VEHICULO_ESTADO_HISTORICO.UNI_CODIGO)
				JOIN ESTADO_VEHICULO ON (VEHICULO_ESTADO_HISTORICO.EST_CODIGO = ESTADO_VEHICULO.EST_DESCRIPCION)
				JOIN vehiculo ON (VEHICULO_ESTADO_HISTORICO.VEH_ID = vehiculo.VEH_ID)
				WHERE VEHICULO_ESTADO_HISTORICO.VEH_ID = {$vehiculoId} 
				ORDER BY VEHICULO_ESTADO_HISTORICO.FECHA DESC";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i = 0;
		while($myrow = mysql_fetch_array($result)){
			$estado = new estadoVehiculo;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["Est_Descripcion"]));
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$unidad->setDescripcionUnidad(STRTOUPPER($myrow["Un_Descripcion"]));
			
			$historicoEstado = new vehiculoEstadoHistorico;
			$historicoEstado->setEstado($estado);
			$historicoEstado->setUnidad($unidad);
			$historicoEstado->setFecha(STRTOUPPER($myrow["FECHA"]));
			$historicoEstado->setObservaciones(STRTOUPPER($myrow["UNI_CODIGO"]));
			
			$listaHistoricoEstados[$i] = $historicoEstado;
			$i++;
		}
	}          
	
	function listaVehiculosDisponiblesOld($unidad, $fechaServicio, $tipoServicio, $correlativo, $vehiculos){
		
		if ($tipoServicio != 2000 && $tipoServicio != 1100){ 
		
			$sql ="SELECT 
					VEHICULO.VEH_NUMEROINSITUCIONAL,
					VEHICULO.VEH_PATENTE,
					VEHICULO.VEH_CODIGO,
					TIPO_VEHICULO.TVEH_DESCRIPCION,
					VEHICULO.TVEH_CODIGO
					FROM ESTADO_VEHICULO
					LEFT JOIN ESTADO ON (ESTADO_VEHICULO.EST_CODIGO = ESTADO.EST_CODIGO)
					RIGHT JOIN VEHICULO ON (ESTADO_VEHICULO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
					JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)				      
					WHERE (VEHICULO.UNI_CODIGO = {$unidad}) AND 
					(ESTADO_VEHICULO.FECHA_DESDE <= '{$fechaServicio}' AND (ESTADO_VEHICULO.FECHA_HASTA > '{$fechaServicio}' OR ESTADO_VEHICULO.FECHA_HASTA IS NULL)) AND 
					(ESTADO.EST_CODIGO = 10) AND
					(VEHICULO.VEH_CODIGO NOT IN (
						SELECT VEHICULO_SERVICIO.VEH_CODIGO
						FROM VEHICULO_SERVICIO
						LEFT JOIN SERVICIO ON (VEHICULO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
						WHERE SERVICIO.TSERV_CODIGO = {$tipoServicio} AND  SERVICIO.FECHA = '{$fechaServicio}'))
					ORDER BY TVEH_DESCRIPCION, VEHICULO.VEH_PATENTE";
		}
		
		if ($tipoServicio == 2000 or $tipoServicio == 1100){

			$sql ="SELECT 
						VEHICULO.VEH_NUMEROINSITUCIONAL,
						VEHICULO.VEH_PATENTE,
						VEHICULO.VEH_CODIGO,
						TIPO_VEHICULO.TVEH_DESCRIPCION,
						VEHICULO.TVEH_CODIGO
					FROM ESTADO_VEHICULO
					LEFT JOIN ESTADO ON (ESTADO_VEHICULO.EST_CODIGO = ESTADO.EST_CODIGO)
					RIGHT JOIN VEHICULO ON (ESTADO_VEHICULO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
					JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)				      
					WHERE (VEHICULO.UNI_CODIGO = {$unidad}) 
					AND (ESTADO_VEHICULO.FECHA_DESDE <= '{$fechaServicio}' AND (ESTADO_VEHICULO.FECHA_HASTA > '{$fechaServicio}' OR ESTADO_VEHICULO.FECHA_HASTA IS NULL)) 
					AND (ESTADO.EST_CODIGO = 10)";

			if ($correlativo != ""){
				$sql .= " AND (VEHICULO.VEH_CODIGO NOT IN (SELECT VEHICULO_SERVICIO.VEH_CODIGO
															FROM VEHICULO_SERVICIO
															LEFT OUTER JOIN SERVICIO ON (VEHICULO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
															AND (VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
															WHERE (VEHICULO_SERVICIO.UNI_CODIGO = {$unidad} AND VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = {$correlativo})))";
			}
			
			$sql .= " ORDER BY TVEH_DESCRIPCION, VEHICULO.VEH_PATENTE";
		}
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) )  {
			$tipo = new tipoVehiculo;
			$tipo->setCodigo(STRTOUPPER($myrow["TVEH_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TVEH_DESCRIPCION"]));
			
			$vehiculo = new vehiculo;
			$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["VEH_CODIGO"]));
			$vehiculo->setTipoVehiculo($tipo);
			$vehiculo->setPatente(STRTOUPPER($myrow["VEH_PATENTE"]));
			$vehiculo->setNumeroInstitucional(STRTOUPPER($myrow["VEH_NUMEROINSITUCIONAL"]));
			
			$vehiculos[$i] = $vehiculo;
			$i++;
		}
	}
	
	function listaVehiculosDisponibles($unidad, $fechaServicio, $tipoServicio, $horaInicio, $horaTermino, $correlativo, $vehiculos){
		
		$listaExcluyente	= $this->listaVehiculosExcluyentes($unidad, $fechaServicio, $tipoServicio, $horaInicio, $horaTermino, $correlativo);
		$sqlExcluyente		= "AND VEHICULO.VEH_CODIGO NOT IN ({$listaExcluyente})";
		
		$sql = "SELECT 
					VEHICULO.VEH_NUMEROINSITUCIONAL,
					VEHICULO.VEH_PATENTE,
					VEHICULO.VEH_CODIGO,
					TIPO_VEHICULO.TVEH_DESCRIPCION,
					VEHICULO.TVEH_CODIGO,
					TIPO_VEHICULO.TVEH_KM,
					0 KMFINAL
				FROM VEHICULO
				JOIN ESTADO_VEHICULO ON (ESTADO_VEHICULO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
				JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)
				WHERE IF(ESTADO_VEHICULO.UNI_AGREGADO,ESTADO_VEHICULO.UNI_AGREGADO,ESTADO_VEHICULO.UNI_CODIGO) = {$unidad} 
				AND (ESTADO_VEHICULO.FECHA_DESDE <= '{$fechaServicio}' AND (ESTADO_VEHICULO.FECHA_HASTA > '{$fechaServicio}' OR ESTADO_VEHICULO.FECHA_HASTA IS NULL)) 
				AND ESTADO_VEHICULO.EST_CODIGO IN (10,150,3000) {$sqlExcluyente}
				ORDER BY TVEH_DESCRIPCION, VEH_PATENTE";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
			$tipo = new tipoVehiculo;
			$tipo->setCodigo(STRTOUPPER($myrow["TVEH_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TVEH_DESCRIPCION"]));
			$tipo->setIndicaKM(STRTOUPPER($myrow["TVEH_KM"]));
			
			$vehiculo = new vehiculo;
			$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["VEH_CODIGO"]));
			$vehiculo->setTipoVehiculo($tipo);
			$vehiculo->setPatente(STRTOUPPER($myrow["VEH_PATENTE"]));
			$vehiculo->setNumeroInstitucional(STRTOUPPER($myrow["VEH_NUMEROINSITUCIONAL"]));
			$vehiculo->setUltimoKilometraje(STRTOUPPER($myrow["KMFINAL"]));
			
			$vehiculos[$i] = $vehiculo;
			$i++;
		}
	}
	
	function listaVehiculosExcluyentes($unidad, $fechaServicio, $servicio, $horaI, $horaT, $correlativo){
		
		$sql = "SELECT VEHICULO_SERVICIO.VEH_CODIGO
						FROM VEHICULO_SERVICIO
						JOIN SERVICIO ON (VEHICULO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO AND VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
						WHERE SERVICIO.FECHA = '{$fechaServicio}' AND SERVICIO.UNI_CODIGO = {$unidad}
						AND (SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) BETWEEN SERVICIO.HORA_INICIO AND SERVICIO.HORA_TERMINO
						OR SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1) BETWEEN SERVICIO.HORA_INICIO AND SERVICIO.HORA_TERMINO
						OR SERVICIO.HORA_INICIO BETWEEN SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) AND SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1))";
		//Servicio existente
		if($correlativo != "" && $correlativo != "-1") $sql .= " OR (SERVICIO.UNI_CODIGO = {$unidad} AND SERVICIO.CORRELATIVO_SERVICIO = {$correlativo})";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$listaVehiculos = "'',";
		while($myrow = mysql_fetch_array($result)){
			$listaVehiculos .= "'".$myrow["VEH_CODIGO"]."',";
		}
		$listaVehiculos = substr($listaVehiculos, 0, strlen($listaVehiculos)-1);
		return $listaVehiculos;
	}

	function actualizarEstadoVehiculo_mysqli($vehiculo){
		$sql = "CALL ActualizarEstadoVehiculo
				({$vehiculo->getCodigoVehiculo()},
				 {$vehiculo->getUnidad()->getCodigoUnidad()},
				 {$vehiculo->getEstadoVehiculo()->getCodigo()},
				'{$vehiculo->getEstadoVehiculo()->getFechaDesde()}',
				 {$vehiculo->getUnidadAgregado()->getCodigoUnidad()},
				 {$vehiculo->getSeccion()->getCodigo()},
				 {$vehiculo->getLugarReparacion()->getCodigo()},
				 {$vehiculo->getClasificacionCitacion()->getCodigo()})";
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['message']=='OK') ? true : false;
	}
	
	function registrarTarjetaCombustible($tarjetaCombustible){
		$sql = "CALL registrarTarjetaCombustible
				({$tarjetaCombustible->getCodigoVehiculo()},
				'{$tarjetaCombustible->getNroTarjeta()}',
				'{$tarjetaCombustible->getNroTarjetaDV()}',
				'{$tarjetaCombustible->getFechaDesde()}',
				 {$tarjetaCombustible->getValidado()},
				'{$tarjetaCombustible->getArchivo()}',
				'{$tarjetaCombustible->getCodFuncionarioRegistra()}')";
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['message']=='OK') ? true : false;
	}

	function buscarTarjetaCombustible($tarjetaCombustible){
		$sql = "SELECT 'OK' RESP
				FROM TARJETA_COMBUSTIBLE_TEMPORAL TC
				WHERE TC.TC_NRO_TARJETA = {$tarjetaCombustible->getNroTarjeta()} ";
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['RESP']=='OK') ? true : false;
	}
	
	function buscarTarjetaCombustibleDuplicada($tarjetaCombustible){
		$sql = "SELECT 'OK' RESP,
					V.VEH_PATENTE PATENTE
				FROM TARJETA_COMBUSTIBLE TC
				JOIN VEHICULO V ON V.VEH_CODIGO = TC.COD_VEH
				WHERE TC.TC_NRO_TARJETA = {$tarjetaCombustible->getNroTarjeta()} ";
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['RESP']=='OK') ? $row['PATENTE'] : false;
	}

	function buscarFechaTarjetaCombustible($tarjetaCombustible){
		$sql = "SELECT 'OK' RESP
				FROM TARJETA_COMBUSTIBLE TC
				WHERE TC.COD_VEH = {$tarjetaCombustible->getCodigoVehiculo()}
				AND TC.TC_FECHA_DESDE >= '{$tarjetaCombustible->getFechaDesde()}' ";
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['RESP']=='OK') ? true : false;
	}

	function listaHistorialTarjetasCombustible($codigoVehiculo, &$tarjetas){
		$sql = "SELECT 
					T.TC_NRO_TARJETA,
					T.TC_NRO_TARJETA_DV,
					T.TC_FECHA_DESDE,
					T.TC_FECHA_HASTA,
					T.TC_ARCHIVO,
					T.TC_FECHA_REGISTRO,
					T.TC_CODFUNCIONARIO_REGISTRA
				FROM TARJETA_COMBUSTIBLE T
				WHERE T.COD_VEH = {$codigoVehiculo}";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		$i=0;
		while($myrow = mysql_fetch_array($result)){
			$tarjeta = new tarjetaCombustible;
			$tarjeta->setNroTarjeta($myrow["TC_NRO_TARJETA"]);
			$tarjeta->setNroTarjetaDV($myrow["TC_NRO_TARJETA_DV"]);
			$tarjeta->setFechaDesde($myrow["TC_FECHA_DESDE"]);
			$tarjeta->setFechaHasta($myrow["TC_FECHA_HASTA"]);
			$tarjeta->setArchivo($myrow["TC_ARCHIVO"]);
			$tarjeta->setFechaRegistro($myrow["TC_FECHA_REGISTRO"]);
			$tarjeta->setCodFuncionarioRegistra($myrow["TC_CODFUNCIONARIO_REGISTRA"]);
			$tarjetas[$i] = $tarjeta;
			$i++;
		}
		mysql_close();
	}

	function eliminarTarjetaCombustible($tarjetaCombustible){
		$sql = "CALL eliminarTarjetaCombustible
				({$tarjetaCombustible->getCodigoVehiculo()},
				'{$tarjetaCombustible->getNroTarjeta()}',
				'{$tarjetaCombustible->getNroTarjetaDV()}')";
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['message']=='OK') ? true : false;
	}

}
?>