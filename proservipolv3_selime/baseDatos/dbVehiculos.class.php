<?
Class dbVehiculos extends Conexion
{			
	
		function listaTotalVehiculos($unidad, $vehiculoBuscar, $tipoVehiculo, $NombreCampo, $TipoOrden, $tipoEstado, $vehiculos){

			  $sql = "SELECT 
	         		`vehiculo`.`Veh_Nro_Institucional`,
       				`vehiculo`.`Veh_Nro_Patente`,
       				`vehiculo`.`Veh_Id`,
       				`vehiculo`.`Veh_Bcu`,
       				`vehiculo`.`Tipo_VehiculoTip_Id`,
       				`tipo_vehiculo`.`Tip_Descripcion`,
       				`modelo_vehiculo`.`Mod_Descripcion`,
       				`vehiculo`.`Estado_VehiculoEst_Codigo`,
       				`estado_vehiculo`.`Est_Descripcion`,
       				`vehiculo`.`marca_vehiculoMar_Codigo`,
       				`vehiculo`.`modelo_vehiculoMod_Codigo`,
       				`marca_vehiculo`.`Mar_Descripcion`,
       				`vehiculo`.`Procedencia_VehiculoPro_Codigo`,
  					`procedencia_vehiculo`.`pro_descripcion`
					 FROM `marca_vehiculo`
   					 RIGHT OUTER JOIN `vehiculo` ON (`marca_vehiculo`.`Mar_Codigo` = `vehiculo`.`marca_vehiculoMar_Codigo`)
   					 LEFT OUTER JOIN `modelo_vehiculo` ON (`vehiculo`.`modelo_vehiculoMod_Codigo` = `modelo_vehiculo`.`Mod_Codigo`) AND (`vehiculo`.`marca_vehiculoMar_Codigo` = `modelo_vehiculo`.`marca_vehiculoMar_Codigo`)
   					 LEFT OUTER JOIN `tipo_vehiculo` ON (`vehiculo`.`Tipo_VehiculoTip_Id` = `tipo_vehiculo`.`Tip_Id`)
   					 LEFT OUTER JOIN `estado_vehiculo` ON (`vehiculo`.`Estado_VehiculoEst_Codigo` = `estado_vehiculo`.`Est_Codigo`)
	         		 LEFT OUTER JOIN `procedencia_vehiculo` ON (`vehiculo`.`Procedencia_VehiculoPro_Codigo` = `procedencia_vehiculo`.`pro_codigo`)
	         		 WHERE `vehiculo`.`Veh_Unidad_Actual` = '".$unidad."' and `vehiculo`.`Estado_VehiculoEst_Codigo` in (".$tipoEstado.") ";
	         
	         if ($vehiculoBuscar != "") $sql .= "AND `vehiculo`.`Veh_Nro_Patente` like '%".$vehiculoBuscar."%' ";
	         		 
	         $sql .= "ORDER BY `vehiculo`.`Tipo_VehiculoTip_Id`, `vehiculo`.`Veh_Nro_Institucional`";
	         
	         //if ($Estado == 100) $sql = $sql . " WHERE `vehiculo`.`Veh_Unidad_Actual` = '".$unidad."' AND `vehiculo`.`Estado_VehiculoEst_Codigo` IN (0,1,4)";
	         //else $sql = $sql . "WHERE `vehiculo`.`Veh_Unidad_Actual` = '".$unidad."' AND `vehiculo`.`Estado_VehiculoEst_Codigo` = " . $Estado;
	       	
	         //$sql = $sql . " order by " . $NombreCampo . " " . $TipoOrden;
				
			
			$sql = "SELECT 
					  VEHICULO.VEH_NUMEROINSITUCIONAL,
					  VEHICULO.VEH_PATENTE,
					  VEHICULO.VEH_CODIGO,
					  VEHICULO.TVEH_CODIGO,
					  VEHICULO.VEH_BCU,
					  TIPO_VEHICULO.TVEH_DESCRIPCION,
					  VEHICULO.MODVEH_CODIGO,
					  MODELO_VEHICULO.MODVEH_DESCRIPCION,
					  MODELO_VEHICULO.MVEH_CODIGO,
					  MARCA_VEHICULO.MVEH_DESCRIPCION,
					  ESTADO.EST_CODIGO,
					  ESTADO.EST_DESCRIPCION,
					  VEHICULO.PREC_CODIGO,
					  PROCEDENCIA_RECURSO.PREC_DESCRIPCION,
					  VEHICULO.UNI_CODIGO,
					  ESTADO_VEHICULO.UNI_AGREGADO,
  					  UNIDAD_AGREGADO.UNI_DESCRIPCION
					FROM
					  ESTADO_VEHICULO
					  LEFT OUTER JOIN ESTADO ON (ESTADO_VEHICULO.EST_CODIGO = ESTADO.EST_CODIGO)
					  RIGHT OUTER JOIN VEHICULO ON (ESTADO_VEHICULO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
					  INNER JOIN UNIDAD ON (VEHICULO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  LEFT OUTER JOIN PROCEDENCIA_RECURSO ON (VEHICULO.PREC_CODIGO = PROCEDENCIA_RECURSO.PREC_CODIGO)
					  INNER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)
					  LEFT OUTER JOIN MODELO_VEHICULO ON (VEHICULO.MODVEH_CODIGO = MODELO_VEHICULO.MODVEH_CODIGO)
					  LEFT OUTER JOIN MARCA_VEHICULO ON (VEHICULO.MVEH_CODIGO = MARCA_VEHICULO.MVEH_CODIGO)
					  LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_VEHICULO.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
					WHERE
					  VEHICULO.UNI_CODIGO = ".$unidad." AND 
					  ESTADO_VEHICULO.FECHA_HASTA IS NULL";
			
			 if ($tipoVehiculo != "") $sql .= " AND VEHICULO.TVEH_CODIGO = ".$tipoVehiculo;
			 if ($vehiculoBuscar != "") $sql .= " AND VEHICULO.VEH_PATENTE like '%".$vehiculoBuscar."%'";
	         		 
	         $sql .= " ORDER BY VEHICULO.TVEH_CODIGO, VEHICULO.VEH_PATENTE";
			
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
				
				$vehiculo = new vehiculo;
				$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["VEH_CODIGO"]));
				$vehiculo->setTipoVehiculo($tipo);
				$vehiculo->setModeloVehiculo($modelo);
				$vehiculo->setEstadoVehiculo($estado);
				$vehiculo->setPatente(STRTOUPPER($myrow["VEH_PATENTE"]));
				$vehiculo->setNumeroInstitucional(STRTOUPPER($myrow["VEH_NUMEROINSITUCIONAL"]));
				$vehiculo->setProcedencia($procedencia);
				$vehiculo->setNumeroBCU($myrow["VEH_BCU"]);
				$vehiculo->setUnidadAgregado($unidadAgregado);
				
				$vehiculos[$i] = $vehiculo;					
				$i++;
			}
		}
		
		
		function buscaDatosVehiculo($vehiculoBuscar, $bcuVehiculo, $vehiculo){
					         
	         $sql = "SELECT 
	         		`vehiculo`.`Veh_Nro_Institucional`,
       				`vehiculo`.`Veh_Nro_Patente`,
       				`vehiculo`.`Veh_Id`,
       				`vehiculo`.`Veh_Bcu`,
       				`vehiculo`.`Veh_Unidad_Actual`,
       				`vehiculo`.`Tipo_VehiculoTip_Id`,
       				`tipo_vehiculo`.`Tip_Descripcion`,
       				`modelo_vehiculo`.`Mod_Descripcion`,
       				`vehiculo`.`Estado_VehiculoEst_Codigo`,
       				`estado_vehiculo`.`Est_Descripcion`,
       				`vehiculo`.`marca_vehiculoMar_Codigo`,
       				`vehiculo`.`modelo_vehiculoMod_Codigo`,
       				`marca_vehiculo`.`Mar_Descripcion`,
       				`vehiculo`.`Procedencia_VehiculoPro_Codigo`,
  					`procedencia_vehiculo`.`pro_descripcion`
					 FROM `marca_vehiculo`
   					 RIGHT OUTER JOIN `vehiculo` ON (`marca_vehiculo`.`Mar_Codigo` = `vehiculo`.`marca_vehiculoMar_Codigo`)
   					 LEFT OUTER JOIN `modelo_vehiculo` ON (`vehiculo`.`modelo_vehiculoMod_Codigo` = `modelo_vehiculo`.`Mod_Codigo`) AND (`vehiculo`.`marca_vehiculoMar_Codigo` = `modelo_vehiculo`.`marca_vehiculoMar_Codigo`)
   					 LEFT OUTER JOIN `tipo_vehiculo` ON (`vehiculo`.`Tipo_VehiculoTip_Id` = `tipo_vehiculo`.`Tip_Id`)
   					 LEFT OUTER JOIN `estado_vehiculo` ON (`vehiculo`.`Estado_VehiculoEst_Codigo` = `estado_vehiculo`.`Est_Codigo`)
	         		 LEFT OUTER JOIN `procedencia_vehiculo` ON (`vehiculo`.`Procedencia_VehiculoPro_Codigo` = `procedencia_vehiculo`.`pro_codigo`)";
	         
	         if ($vehiculoBuscar != "") $sql .= "WHERE `vehiculo`.`Veh_Id` = ".$vehiculoBuscar;
	         if ($patenteVehiculo != "") $sql .= "WHERE `vehiculo`.`Veh_Nro_Patente` = '".$patenteVehiculo."'";
	         

			$sql = "SELECT 
					  VEHICULO.VEH_NUMEROINSITUCIONAL,
					  VEHICULO.VEH_PATENTE,
					  VEHICULO.VEH_CODIGO,
					  VEHICULO.VEH_BCU,
					  VEHICULO.TVEH_CODIGO,
					  TIPO_VEHICULO.TVEH_DESCRIPCION,
					  VEHICULO.MODVEH_CODIGO,
					  MODELO_VEHICULO.MODVEH_DESCRIPCION,
					  VEHICULO.MVEH_CODIGO,
					  MARCA_VEHICULO.MVEH_DESCRIPCION,
					  ESTADO.EST_CODIGO,
					  ESTADO.EST_DESCRIPCION,
					  VEHICULO.PREC_CODIGO,
					  PROCEDENCIA_RECURSO.PREC_DESCRIPCION,
					  VEHICULO.UNI_CODIGO,
					  VEHICULO.ANNO_FABRICACION,
					  VEHICULO.VALIDA_ANNO_FABRICACION,
					  UNIDAD.UNI_DESCRIPCION,
					  ESTADO_VEHICULO.FECHA_DESDE,
					  ESTADO_VEHICULO.UNI_AGREGADO,
  					  UNIDAD_AGREGADO.UNI_DESCRIPCION AS DES_UNIDADGREGADO,
  					  ESTADO_VEHICULO.EST_LUGARREPARACION,
  					  LUGAR_REPARACION.LREP_DESCRIPCION,
  					  ESTADO_VEHICULO.TFALLA_CODIGO,
              TIPO_FALLA_VEHICULO.TFALLA_DESCRIPCION
					FROM
					  ESTADO_VEHICULO
					  LEFT OUTER JOIN ESTADO ON (ESTADO_VEHICULO.EST_CODIGO = ESTADO.EST_CODIGO)
					  RIGHT OUTER JOIN VEHICULO ON (ESTADO_VEHICULO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
					  LEFT OUTER JOIN UNIDAD ON (VEHICULO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  LEFT OUTER JOIN PROCEDENCIA_RECURSO ON (VEHICULO.PREC_CODIGO = PROCEDENCIA_RECURSO.PREC_CODIGO)
					  LEFT OUTER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)
					  LEFT OUTER JOIN MODELO_VEHICULO ON (VEHICULO.MODVEH_CODIGO = MODELO_VEHICULO.MODVEH_CODIGO)
					  LEFT OUTER JOIN MARCA_VEHICULO ON (VEHICULO.MVEH_CODIGO = MARCA_VEHICULO.MVEH_CODIGO)
					  LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_VEHICULO.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
					  LEFT OUTER JOIN LUGAR_REPARACION ON (ESTADO_VEHICULO.EST_LUGARREPARACION = LUGAR_REPARACION.LREP_CODIGO)
					  LEFT OUTER JOIN TIPO_FALLA_VEHICULO ON (ESTADO_VEHICULO.TFALLA_CODIGO = TIPO_FALLA_VEHICULO.TFALLA_CODIGO)
					WHERE
					  ESTADO_VEHICULO.FECHA_HASTA IS NULL";
						 	         
	         if ($vehiculoBuscar != "") $sql .= " AND VEHICULO.VEH_CODIGO = ".$vehiculoBuscar;
	         if ($bcuVehiculo != "") $sql .= " AND VEHICULO.VEH_BCU = '".$bcuVehiculo."'";
				
			//echo $sql;
			
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
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
					
				$vehiculo = new vehiculo;
				$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["VEH_CODIGO"]));
				$vehiculo->setTipoVehiculo($tipo);
				$vehiculo->setModeloVehiculo($modelo);
				$vehiculo->setEstadoVehiculo($estado);
				$vehiculo->setPatente(STRTOUPPER($myrow["VEH_PATENTE"]));
				$vehiculo->setNumeroInstitucional(STRTOUPPER($myrow["VEH_NUMEROINSITUCIONAL"]));
				$vehiculo->setProcedencia($procedencia);
				$vehiculo->setUnidad($unidad);	
				$vehiculo->setNumeroBCU($myrow["VEH_BCU"]);
				$vehiculo->setUnidadAgregado($unidadAgregado);
				$vehiculo->setLugarReparacion($lugarDeReparacion);
				$vehiculo->setTipoFallaVehiculo($tipoFallaVehiculo);
				$vehiculo->setAnnoFabricacion(STRTOUPPER($myrow["ANNO_FABRICACION"]));
   	    $vehiculo->setValidaAnnoFabricacion(STRTOUPPER($myrow["VALIDA_ANNO_FABRICACION"]));
			}
		}
		
		
		function updateVehiculo($vehiculo){
		
			$modeloVehiculo = $vehiculo->getModeloVehiculo()->getCodigo();
			if ($modeloVehiculo == 1) $modeloVehiculo = "Null";
		
			$sql = "UPDATE VEHICULO SET
					VEH_PATENTE = '" . $vehiculo->getPatente() . "', 
					VEH_NUMEROINSITUCIONAL = '".$vehiculo->getNumeroInstitucional(). "',
					UNI_CODIGO = ".$vehiculo->getUnidad()->getCodigoUnidad(). ",
					PREC_CODIGO = ".$vehiculo->getProcedencia()->getCodigo(). ",
					VEH_BCU = '".$vehiculo->getNumeroBCU(). "',
					TVEH_CODIGO = ".$vehiculo->getTipoVehiculo()->getCodigo(). ",
					MVEH_CODIGO = ". $vehiculo->getModeloVehiculo()->getMarca()->getCodigo(). ",
					MODVEH_CODIGO = ".$modeloVehiculo. ",
					ANNO_FABRICACION = " . $vehiculo->getAnnoFabricacion() . ",
					VALIDA_ANNO_FABRICACION = " . $vehiculo->getValidaAnnoFabricacion() . "
					WHERE VEH_CODIGO =" . $vehiculo->getCodigoVehiculo();
			
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}		
		
		
		function updateEstadoVehiculo($vehiculo, $fechaNuevoEstado){
			
			$sql = "UPDATE ESTADO_VEHICULO SET
					FECHA_HASTA = '".$fechaNuevoEstado."'
					WHERE VEH_CODIGO = ".$vehiculo->getCodigoVehiculo()." AND FECHA_HASTA IS NULL";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}		
		
		function insertEstadoVehiculo($vehiculo, $fechaNuevoEstado){
			
			//echo "aqui";
			
			//echo "jjjj " . $vehiculo->getLugarReparacion()->getCodigo();
			
			if ($vehiculo->getLugarReparacion()->getCodigo() == 0 ) $lugarDeRepacionGuardar = 'NULL';
			else $lugarDeRepacionGuardar = $vehiculo->getLugarReparacion()->getCodigo();
			
			if ($vehiculo->getUnidadAgregado()->getCodigoUnidad() == 0) $unidadAgregadoGuardar = 'NULL';
			else $unidadAgregadoGuardar = $vehiculo->getUnidadAgregado()->getCodigoUnidad();
			
			if ($vehiculo->getTipoFallaVehiculo()->getCodigo() == 0 ) $tipoFallaGuardar = 'NULL';
			else $tipoFallaGuardar = $vehiculo->getTipoFallaVehiculo()->getCodigo();
			
			$sql = "INSERT INTO ESTADO_VEHICULO (VEH_CODIGO, UNI_CODIGO, EST_CODIGO, FECHA_DESDE, EST_DOCUMENTO, UNI_AGREGADO, EST_LUGARREPARACION, TFALLA_CODIGO)
					VALUES (".$vehiculo->getCodigoVehiculo().",".$vehiculo->getUnidad()->getCodigoUnidad().",".$vehiculo->getEstadoVehiculo()->getCodigo().",'".$fechaNuevoEstado."','".$vehiculo->getDocumentoEstado()."',".$unidadAgregadoGuardar.",".$lugarDeRepacionGuardar.",".$tipoFallaGuardar.")";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
		
		function dejarDisponible($vehiculo, $fecha){
			
			$sql = "UPDATE VEHICULO SET UNI_CODIGO = Null WHERE VEH_CODIGO = " . $vehiculo->getCodigoVehiculo();
			
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			//$result	= 1;
			return $result;
		}
		
		
		function bajaVehiculo($vehiculo, $motivo, $fecha){ 
			
			$sql = "INSERT INTO ESTADO_VEHICULO (VEH_CODIGO, UNI_CODIGO, EST_CODIGO, FECHA_DESDE, FECHA_HASTA)
				   VALUES (".$vehiculo->getCodigoVehiculo().",".$vehiculo->getUnidad()->getCodigoUnidad().",".$vehiculo->getEstadoVehiculo()->getCodigo().",'".$fecha."','".$fecha."');";
			
			//echo $sql;		
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
		
		function nuevoVehiculo($vehiculo){ 
			
			$modeloVehiculo = $vehiculo->getModeloVehiculo()->getCodigo();
			if ($modeloVehiculo == 1) $modeloVehiculo = "Null";

			$sql = "INSERT INTO VEHICULO 
				   (TVEH_CODIGO, PREC_CODIGO, VEH_BCU, UNI_CODIGO, MVEH_CODIGO, MODVEH_CODIGO, VEH_PATENTE, VEH_NUMEROINSITUCIONAL, ANNO_FABRICACION, VALIDA_ANNO_FABRICACION) VALUES
			 	   ( ".$vehiculo->getTipoVehiculo()->getCodigo().",
			 	     ".$vehiculo->getProcedencia()->getCodigo().",
			 	    '".$vehiculo->getNumeroBCU()."',
			 	     ".$vehiculo->getUnidad()->getCodigoUnidad().",
			 	     ".$vehiculo->getModeloVehiculo()->getMarca()->getCodigo().",
			 	     ".$modeloVehiculo.",
			 	    '".$vehiculo->getPatente()."',
			 	    '".$vehiculo->getNumeroInstitucional()."',
			 	    ".$vehiculo->getAnnoFabricacion().",
			 	    ".$vehiculo->getValidaAnnoFabricacion().")";
			 	    
			echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
		
		
		
		//function borraFuncionario($funcionario){
		//	
		//	$sql = "DELETE FROM funcionarios WHERE Fun_Codigo ='". $funcionario->getCodigoFuncionario() ."'";
		//	
		//	//echo $sql;
		//	return 1;
		//	//$result = $this->execstmt($this->Conecta(),$sql);			
		//}		
		
		
		function insertHistoricoEstado($nuevoEstadoHistorico, $usuario){
			
			$fechaActual = date("Y-m-d",time ()); 
			$horaActual  = date("H:s",time ()); 

			
			
			$sql = "INSERT INTO VEHICULO_ESTADO_HISTORICO 
					(VEH_ID, EST_CODIGO, FECHA, UNI_CODIGO, FECHA_INGRESO, HORA_INGRESO, USUARIO_INGRESO) VALUES 
					(".$nuevoEstadoHistorico->getVehiculo()->getCodigoVehiculo().",
					 ".$nuevoEstadoHistorico->getEstado()->getCodigo().",
					'".$nuevoEstadoHistorico->getFecha()."',
					'".$nuevoEstadoHistorico->getUnidad()->getCodigoUnidad()."',
					'".$fechaActual."',
					'".$horaActual."',
					'".$usuario."');";
					
			//echo $sql;					
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
		
		function listaEstadoHistoricoVehiculo($vehiculoId, $listaHistoricoEstados){
			
			$sql = "SELECT 
					  VEHICULO_ESTADO_HISTORICO.FECHA,
					  VEHICULO_ESTADO_HISTORICO.UNI_CODIGO,
					  unidades.Un_Descripcion,
					  VEHICULO_ESTADO_HISTORICO.EST_CODIGO,
					  estado_vehiculo.Est_Descripcion
					FROM
					  unidades
					  INNER JOIN VEHICULO_ESTADO_HISTORICO ON (unidades.Un_Id = VEHICULO_ESTADO_HISTORICO.UNI_CODIGO)
					  INNER JOIN estado_vehiculo ON (VEHICULO_ESTADO_HISTORICO.EST_CODIGO = estado_vehiculo.Est_Codigo)
					  INNER JOIN vehiculo ON (VEHICULO_ESTADO_HISTORICO.VEH_ID = vehiculo.Veh_Id)
					WHERE
					  VEHICULO_ESTADO_HISTORICO.VEH_ID = " . $vehiculoId . " 
					ORDER BY
					  VEHICULO_ESTADO_HISTORICO.FECHA DESC";
			
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
				//$historicoEstado->setVehiculo($vehiculo);
				$historicoEstado->setEstado($estado);
				$historicoEstado->setUnidad($unidad);
				$historicoEstado->setFecha(STRTOUPPER($myrow["FECHA"]));
				$historicoEstado->setObservaciones(STRTOUPPER($myrow["UNI_CODIGO"]));
				
				$listaHistoricoEstados[$i] = $historicoEstado;
				$i++;
			}
		}          
		
		
		//-- FUNCIONES PARA FICHA SERVICIO
		
		
		function listaVehiculosDisponiblesOld($unidad, $fechaServicio, $tipoServicio, $correlativo, $vehiculos){
	         		 
	       if ($tipoServicio != 2000 && $tipoServicio != 1100){ 
	        
	         $sql ="SELECT 
					  VEHICULO.VEH_NUMEROINSITUCIONAL,
					  VEHICULO.VEH_PATENTE,
					  VEHICULO.VEH_CODIGO,
					  TIPO_VEHICULO.TVEH_DESCRIPCION,
					  VEHICULO.TVEH_CODIGO
					FROM
					  ESTADO_VEHICULO
					  LEFT OUTER JOIN ESTADO ON (ESTADO_VEHICULO.EST_CODIGO = ESTADO.EST_CODIGO)
					  RIGHT OUTER JOIN VEHICULO ON (ESTADO_VEHICULO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
					  INNER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)				      
					WHERE
					  (VEHICULO.UNI_CODIGO = ".$unidad.") AND 
					  (ESTADO_VEHICULO.FECHA_DESDE <= '".$fechaServicio."' AND (ESTADO_VEHICULO.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_VEHICULO.FECHA_HASTA IS NULL)) AND 
					  (ESTADO.EST_CODIGO = 10) AND
					  (VEHICULO.VEH_CODIGO NOT IN (
					  		SELECT 
							  VEHICULO_SERVICIO.VEH_CODIGO
							FROM
							  VEHICULO_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (VEHICULO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							WHERE
							  SERVICIO.TSERV_CODIGO = ".$tipoServicio." AND 
							  SERVICIO.FECHA = '".$fechaServicio."'))";
		  
	         $sql .= " ORDER BY TVEH_DESCRIPCION, VEHICULO.VEH_PATENTE";
	       }
	       
	       if ($tipoServicio == 2000 or $tipoServicio == 1100){
	         
	        // $xx = "";
			// if ($correlativo != "") $xx = " WHERE (VEHICULO_SERVICIO.UNI_CODIGO = ".$unidad ." AND VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")";
			 
			 $sql ="SELECT 
					  VEHICULO.VEH_NUMEROINSITUCIONAL,
					  VEHICULO.VEH_PATENTE,
					  VEHICULO.VEH_CODIGO,
					  TIPO_VEHICULO.TVEH_DESCRIPCION,
					  VEHICULO.TVEH_CODIGO
					FROM
					  ESTADO_VEHICULO
					  LEFT OUTER JOIN ESTADO ON (ESTADO_VEHICULO.EST_CODIGO = ESTADO.EST_CODIGO)
					  RIGHT OUTER JOIN VEHICULO ON (ESTADO_VEHICULO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
					  INNER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)				      
					WHERE
					  (VEHICULO.UNI_CODIGO = ".$unidad.") AND 
					  (ESTADO_VEHICULO.FECHA_DESDE <= '".$fechaServicio."' AND (ESTADO_VEHICULO.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_VEHICULO.FECHA_HASTA IS NULL)) AND 
					  (ESTADO.EST_CODIGO = 10)";
			
			if ($correlativo != ""){	  
							  
				$sql .= " AND
					  	(VEHICULO.VEH_CODIGO NOT IN (
					  		SELECT 
							  VEHICULO_SERVICIO.VEH_CODIGO
							FROM
							  VEHICULO_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (VEHICULO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (VEHICULO_SERVICIO.UNI_CODIGO = ".$unidad ." AND VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
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
		
		
		function listaVehiculosDisponibles($unidad, $fechaServicio, $tipoServicio, $correlativo, $vehiculos){
	         
	         $sql  = "(";		 
	       	 $sql .= "SELECT 
					  VEHICULO.VEH_NUMEROINSITUCIONAL,
					  VEHICULO.VEH_PATENTE,
					  VEHICULO.VEH_CODIGO,
					  TIPO_VEHICULO.TVEH_DESCRIPCION,
					  VEHICULO.TVEH_CODIGO
					FROM
					  ESTADO_VEHICULO
					  LEFT OUTER JOIN ESTADO ON (ESTADO_VEHICULO.EST_CODIGO = ESTADO.EST_CODIGO)
					  RIGHT OUTER JOIN VEHICULO ON (ESTADO_VEHICULO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
					  INNER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)				      
					WHERE
					  (ESTADO_VEHICULO.UNI_CODIGO = ".$unidad.") AND 
					  (ESTADO_VEHICULO.FECHA_DESDE <= '".$fechaServicio."' AND (ESTADO_VEHICULO.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_VEHICULO.FECHA_HASTA IS NULL)) AND 
					  (ESTADO.EST_CODIGO = 10)";
			
			if ($correlativo != ""){	  

				$sql .= " AND
					  	(VEHICULO.VEH_CODIGO NOT IN (
					  		SELECT 
							  VEHICULO_SERVICIO.VEH_CODIGO
							FROM
							  VEHICULO_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (VEHICULO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (VEHICULO_SERVICIO.UNI_CODIGO = ".$unidad ." AND VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
			}	
			
			
			
			
			$sql .= ") UNION (";
			
			$sql .= "SELECT 
					  VEHICULO.VEH_NUMEROINSITUCIONAL,
					  VEHICULO.VEH_PATENTE,
					  VEHICULO.VEH_CODIGO,
					  TIPO_VEHICULO.TVEH_DESCRIPCION,
					  VEHICULO.TVEH_CODIGO
					FROM
					  ESTADO_VEHICULO
					  INNER JOIN VEHICULO ON (ESTADO_VEHICULO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
					  INNER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)
					WHERE
					  ESTADO_VEHICULO.UNI_AGREGADO = ".$unidad." AND 
					  ESTADO_VEHICULO.FECHA_DESDE <= '".$fechaServicio."' AND 
					  (ESTADO_VEHICULO.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_VEHICULO.FECHA_HASTA IS NULL)";
			
			if ($correlativo != ""){	  

				$sql .= " AND
					  	(VEHICULO.VEH_CODIGO NOT IN (
					  		SELECT 
							  VEHICULO_SERVICIO.VEH_CODIGO
							FROM
							  VEHICULO_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (VEHICULO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (VEHICULO_SERVICIO.UNI_CODIGO = ".$unidad ." AND VEHICULO_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
			}
			
			$sql .= ")";
			
				
			$sql .= " ORDER BY TVEH_DESCRIPCION, VEH_PATENTE";
			
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
		
		
		function buscaVehiculoL3($codigoBcu, $vehiculo){
					         
	         $sql = "SELECT 
	         		`vehiculos`.`numero_institucional`,
       				`vehiculos`.`patente`,
       				`vehiculos`.`bcu`,
       				`vehiculos`.`tipo_vehiculo`,
       				`vehiculos`.`modelo`,
       				`vehiculos`.`marca`,
       				`vehiculos`.`ano_fabricacion`,
       				`vehiculos`.`procedencia`
					 FROM `vehiculos`
   					 WHERE `vehiculos`.`bcu` = '".$codigoBcu . "'";
	         	         		
			//echo $sql;
			
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result)){
			
				$tipo = new tipoVehiculo;
				$tipo->setCodigo(STRTOUPPER($myrow["tipo_vehiculo"]));
				$tipo->setDescripcion("");
					
				$procedencia = new procedenciaVehiculo;
				$procedencia->setCodigo(STRTOUPPER($myrow["procedencia"]));
				$procedencia->setDescripcion("");
					
				$marca = new marcaVehiculo;
				$marca->setCodigo(STRTOUPPER($myrow["marca"]));
				$marca->setDescripcion("");
					
				if ($myrow["MODVEH_CODIGO"] == ""){
					$codigoModelo = 1;	
					$descripcionModelo = "NO INDICA MODELO";
				} else {
					$codigoModelo = $myrow["modelo"];	
					$descripcionModelo = "";
				}
					
				$modelo = new modeloVehiculo;
				$modelo->setMarca($marca);
				$modelo->setCodigo(STRTOUPPER($codigoModelo));
				$modelo->setDescripcion(STRTOUPPER($descripcionModelo));
					
				$vehiculo = new vehiculo;
				$vehiculo->setTipoVehiculo($tipo);
				$vehiculo->setModeloVehiculo($modelo);
				$vehiculo->setPatente(STRTOUPPER($myrow["patente"]));
				$vehiculo->setNumeroInstitucional(STRTOUPPER($myrow["numero_institucional"]));
				$vehiculo->setProcedencia($procedencia);
				$vehiculo->setNumeroBCU($myrow["bcu"]);
				$vehiculo->setAnnoFabricacion($myrow["ano_fabricacion"]);
			}
		} 
		
		
		function buscaUltimoKilometraje($codigoVehiculo, $vehiculo){
			
			$sql = "SELECT 
					  VEHICULO_SERVICIO.VEH_CODIGO,
					  MAX(VEHICULO_SERVICIO.KM_FINAL) MAX_KILOMETRAJE
					FROM
					  VEHICULO_SERVICIO
					WHERE
					  VEHICULO_SERVICIO.VEH_CODIGO = ".$codigoVehiculo."
					GROUP BY
					  VEHICULO_SERVICIO.VEH_CODIGO";
					  
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$num_rows = mysql_num_rows($result);
			if ($num_rows>0){
				$myrow = mysql_fetch_array($result);
				$vehiculo = new vehiculo;
				$vehiculo->setUltimoKilometraje($myrow["MAX_KILOMETRAJE"]);
			}
		}
		
		
		
		
		
		function listaCantidadVehiculos($unidad, $tipoUnidad, $tipoVehiculo, $fecha1, $inicio, $listaVehiculosUnidad){	
			
			if ($tipoVehiculo != ""){				
				$filtro = " AND VEHICULO.TVEH_CODIGO = ". $tipoVehiculo;
			}
			
			if ($tipoUnidad == "nacional"){
				$unidadAgregada = "";
				$unidadFiltro   = "";     
			}
			
			if ($tipoUnidad == "zona"){
							
				if ($inicio == "1"){
					$unidadAgregada = "IF (UNIDAD3.UNI_CODIGO=".$unidad.",UNIDAD2.UNI_CODIGO, UNIDAD3.UNI_CODIGO) AS UNI_CODIGO,";          
					$unidadAgregada .= "IF (UNIDAD3.UNI_CODIGO=".$unidad.",UNIDAD2.UNI_DESCRIPCION, UNIDAD3.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
				}
				
				if ($inicio == "0"){
					$unidadAgregada = "IF (UNIDAD3.UNI_CODIGO=".$unidad.",UNIDAD3.UNI_CODIGO, UNIDAD2.UNI_CODIGO) AS UNI_CODIGO,";          
					$unidadAgregada .= "IF (UNIDAD3.UNI_CODIGO=".$unidad.",UNIDAD3.UNI_DESCRIPCION, UNIDAD2.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
				}
				
				$unidadAgrupar = "UNI_CODIGO, UNI_DESCRIPCION,";
			}   
			
			if ($tipoUnidad == "prefectura"){
				
				if ($inicio == "1"){  
					$unidadAgregada = "IF (UNIDAD2.UNI_CODIGO=".$unidad.",UNIDAD1.UNI_CODIGO, UNIDAD2.UNI_CODIGO) AS UNI_CODIGO,";          
					$unidadAgregada .= "IF (UNIDAD2.UNI_CODIGO=".$unidad.",UNIDAD1.UNI_DESCRIPCION, UNIDAD2.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
				}
				
				if ($inicio == "0"){  
					$unidadAgregada = "IF (UNIDAD2.UNI_CODIGO=".$unidad.",UNIDAD2.UNI_CODIGO, UNIDAD1.UNI_CODIGO) AS UNI_CODIGO,";          
					$unidadAgregada .= "IF (UNIDAD2.UNI_CODIGO=".$unidad.",UNIDAD2.UNI_DESCRIPCION, UNIDAD1.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
				}
			
				$unidadAgrupar = "UNI_CODIGO, UNI_DESCRIPCION,"; 
				
			}
			
			if ($tipoUnidad == "comisaria"){

				if ($inicio == "1"){  							
					$unidadAgregada = "IF (UNIDAD1.UNI_CODIGO=".$unidad.",UNIDAD.UNI_CODIGO, UNIDAD1.UNI_CODIGO) AS UNI_CODIGO,";          
					$unidadAgregada .= "IF (UNIDAD1.UNI_CODIGO=".$unidad.",UNIDAD.UNI_DESCRIPCION, UNIDAD1.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
				}
				
				if ($inicio == "0"){  							
					$unidadAgregada = "IF (UNIDAD1.UNI_CODIGO=".$unidad.",UNIDAD1.UNI_CODIGO, UNIDAD.UNI_CODIGO) AS UNI_CODIGO,";          
					$unidadAgregada .= "IF (UNIDAD1.UNI_CODIGO=".$unidad.",UNIDAD1.UNI_DESCRIPCION, UNIDAD.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
				}
						
				$unidadAgrupar = "UNI_CODIGO, UNI_DESCRIPCION,"; 
			}
			
			
			if ($tipoUnidad == "destacamento"){
				$unidadAgregada = "UNIDAD.UNI_CODIGO, UNIDAD.UNI_DESCRIPCION,";
			
				$unidadAgrupar = "UNI_CODIGO, UNI_DESCRIPCION,"; 
			}
											
			
			 $sql = "SELECT 
					  ".$unidadAgregada."
					  VEHICULO.TVEH_CODIGO,
					  TIPO_VEHICULO.TVEH_DESCRIPCION,
					  COUNT(*) AS CANT_VEHICULOS
					FROM
					  VEHICULO
					  INNER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)
					  LEFT OUTER JOIN ESTADO_VEHICULO ON (VEHICULO.VEH_CODIGO = ESTADO_VEHICULO.VEH_CODIGO)
					  INNER JOIN UNIDAD ON (VEHICULO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  INNER JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)       
					  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO) 
					  WHERE ESTADO_VEHICULO.FECHA_HASTA IS NULL AND
					  (UNIDAD.UNI_PADRE = ".$unidad." OR                                                                                                                                                                                                                                                                    
					  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR 
					  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR 
					  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad."))))"
					 .$filtro."
					GROUP BY
					  ".$unidadAgrupar."
					  VEHICULO.TVEH_CODIGO,
					  TIPO_VEHICULO.TVEH_DESCRIPCION
					ORDER BY
					  VEHICULO.TVEH_CODIGO";
					  
			
			$sql = "SELECT 
					  ".$unidadAgregada."
					  VEHICULO.TVEH_CODIGO,
					  TIPO_VEHICULO.TVEH_DESCRIPCION,
					  ESTADO_VEHICULO.EST_CODIGO,
					  COUNT(*) AS CANT_VEHICULOS
					FROM
					  VEHICULO
					  INNER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)
					  INNER JOIN ESTADO_VEHICULO ON (VEHICULO.VEH_CODIGO = ESTADO_VEHICULO.VEH_CODIGO)
					  INNER JOIN UNIDAD ON (VEHICULO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  INNER JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)       
					  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO) 
					  WHERE ESTADO_VEHICULO.FECHA_HASTA IS NULL AND
					  (UNIDAD.UNI_PADRE = ".$unidad." OR                                                                                                                                                                                                                                                                    
					  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR 
					  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR 
					  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad."))))"
					 .$filtro."
					GROUP BY
					  ".$unidadAgrupar."
					  VEHICULO.TVEH_CODIGO,
					  TIPO_VEHICULO.TVEH_DESCRIPCION,
					  ESTADO_VEHICULO.EST_CODIGO
					ORDER BY
					  ".$unidadAgrupar." TVEH_CODIGO";		  					  


			//echo $sql;
			
			$cont=0;
			$i=0;
			$listaVehiculosUnidad = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			
			$tipoDeVehiculoPaso 	= "";
			$unidadDePaso			= "";
			$codUnidadPaso 			= "";
			$desUnidadPaso 			= "";
			$codTipoVehiculo 		= "";
			$desTipoVehiculo 		= "";
			$cantidadTotalVehiculos = 0;
			$cantidadActivoPaso		= 0;
			$cantidadMantencionPaso	= 0;
			$cantidadReparacionPaso	= 0;
			$cantidadPBajaPaso		= 0;
			$cantidadTribunalPaso	= 0;
            //Aqui en adelante
            $cantidadActivo         = 0;
            $cantidadAgregado       = 0;
            $cantidadReparacionMenor = 0;
            $cantidadReparacionMayor = 0;
            $cantidadEvaluacionFalla = 0;
            $cantidadTramiteAdm      = 0;
			
			if (mysql_num_rows($result)>0){
			
				while($myrow = mysql_fetch_array($result) ){
					
					if (($tipoDeVehiculoPaso != $myrow["TVEH_CODIGO"] OR $unidadDePaso != $myrow["UNI_CODIGO"]) && $tipoDeVehiculoPaso != "" && unidadDePaso != ""){
						
						$unidad = new unidad;
						$unidad->setCodigoUnidad($codUnidadPaso);
						$unidad->setDescripcionUnidad($desUnidadPaso);
					
						$tipoVehiculo = new tipoVehiculo;
						$tipoVehiculo->setCodigo($codTipoVehiculo);
						$tipoVehiculo->setDescripcion($desTipoVehiculo);
									
						$vehiculosUnidad = new vehiculosUnidad;
						$vehiculosUnidad->setUnidad($unidad);
						$vehiculosUnidad->setTipoVehiculo($tipoVehiculo);
						$vehiculosUnidad->setCantidadVehiculos($cantidadTotalVehiculos);
						$vehiculosUnidad->setCantidadActivos($cantidadActivoPaso);
						$vehiculosUnidad->setCantidadMantencion($cantidadMantencionPaso);
						$vehiculosUnidad->setCantidadReparacion($cantidadReparacionPaso);
						$vehiculosUnidad->setCantidadProcesoBaja($cantidadPBajaPaso);
						$vehiculosUnidad->setCantidadTribunal($cantidadTribunalPaso);
                        //Aqui en adelante
                        $vehiculosUnidad->setCantidadActivo($cantidadActivo);
                     	$vehiculosUnidad->setCantidadAgregado($cantidadAgregado);
                        $vehiculosUnidad->setCantidadReparacionMenor($cantidadReparacionMenor);
                     	$vehiculosUnidad->setCantidadReparacionMayor($cantidadReparacionMayor);
                        $vehiculosUnidad->setCantidadEvaluacionFalla($cantidadEvaluacionFalla);
                     	$vehiculosUnidad->setCantidadTramiteAdm($cantidadTramiteAdm);
													
						$listaVehiculosUnidad[$i] = $vehiculosUnidad;
						$i++;
						
						$tipoDeVehiculoPaso 	= "";
						$codUnidadPaso 			= "";
						$desUnidadPaso 			= "";
						$codTipoVehiculo 		= "";
						$desTipoVehiculo 		= "";
						$cantidadTotalVehiculos = 0;
						$cantidadActivoPaso		= 0;
						$cantidadMantencionPaso	= 0;
						$cantidadReparacionPaso	= 0;
						$cantidadPBajaPaso		= 0;
						$cantidadTribunalPaso	= 0;
                        //Aqui en adelante
                        $cantidadActivo         = 0;
                        $cantidadAgregado       = 0;
                        $cantidadReparacionMenor = 0;
                        $cantidadReparacionMayor = 0;
                        $cantidadEvaluacionFalla = 0;
                        $cantidadTramiteAdm      = 0;
					}
					 
					$tipoDeVehiculoPaso = $myrow["TVEH_CODIGO"];
					$unidadDePaso 		= $myrow["UNI_CODIGO"];
					$codUnidadPaso 		= $myrow["UNI_CODIGO"];
					$desUnidadPaso 		= $myrow["UNI_DESCRIPCION"];
					$codTipoVehiculo	= $myrow["TVEH_CODIGO"];
					$desTipoVehiculo	= $myrow["TVEH_DESCRIPCION"];
                    
                                    //Modificado				
					if ($myrow["EST_CODIGO"] == 10) $cantidadActivo = $myrow["CANT_VEHICULOS"];
                    if ($myrow["EST_CODIGO"] == 3000) $cantidadAgregado = $myrow["CANT_VEHICULOS"];
                        $cantidadActivoPaso=$cantidadActivo+$cantidadAgregado;
                    
                    //Modificado
					if ($myrow["EST_CODIGO"] == 21) $cantidadMantencionPaso = $myrow["CANT_VEHICULOS"];
                    
                    //Modificado
                    if ($myrow["EST_CODIGO"] == 31) $cantidadReparacionMenor = $myrow["CANT_VEHICULOS"];
                    if ($myrow["EST_CODIGO"] == 32) $cantidadReparacionMayor = $myrow["CANT_VEHICULOS"];
                    if ($myrow["EST_CODIGO"] == 70) $cantidadEvaluacionFalla = $myrow["CANT_VEHICULOS"];
                    if ($myrow["EST_CODIGO"] == 80) $cantidadTramiteAdm = $myrow["CANT_VEHICULOS"];
                        $cantidadReparacionPaso=$cantidadReparacionMenor+$cantidadReparacionMayor+$cantidadEvaluacionFalla+$cantidadTramiteAdm;

					if ($myrow["EST_CODIGO"] == 40 ) $cantidadPBajaPaso = $myrow["CANT_VEHICULOS"];
					if ($myrow["EST_CODIGO"] == 50 ) $cantidadTribunalPaso = $myrow["CANT_VEHICULOS"];
									
					//if ($myrow["EST_CODIGO"] == 10) $cantidadActivoPaso = $myrow["CANT_VEHICULOS"];
					//if ($myrow["EST_CODIGO"] == 20) $cantidadMantencionPaso = $myrow["CANT_VEHICULOS"];
					//if ($myrow["EST_CODIGO"] == 30) $cantidadReparacionPaso = $myrow["CANT_VEHICULOS"];
					//if ($myrow["EST_CODIGO"] == 40) $cantidadPBajaPaso = $myrow["CANT_VEHICULOS"];
					//if ($myrow["EST_CODIGO"] == 50) $cantidadTribunalPaso = $myrow["CANT_VEHICULOS"];
					//if ($myrow["CANT_VEHICULOS"] == 60) $cantidadPerdidoPaso = $myrow["CANT_VEHICULOS"];
	
					$cantidadTotalVehiculos += $myrow["CANT_VEHICULOS"]*1;
	
				}
				
						$unidad = new unidad;
						$unidad->setCodigoUnidad($codUnidadPaso);
						$unidad->setDescripcionUnidad($desUnidadPaso);
					
						$tipoVehiculo = new tipoVehiculo;
						$tipoVehiculo->setCodigo($codTipoVehiculo);
						$tipoVehiculo->setDescripcion($desTipoVehiculo);
									
						$vehiculosUnidad = new vehiculosUnidad;
						$vehiculosUnidad->setUnidad($unidad);
						$vehiculosUnidad->setTipoVehiculo($tipoVehiculo);
						$vehiculosUnidad->setCantidadVehiculos($cantidadTotalVehiculos);
						$vehiculosUnidad->setCantidadActivos($cantidadActivoPaso);
						$vehiculosUnidad->setCantidadMantencion($cantidadMantencionPaso);
						$vehiculosUnidad->setCantidadReparacion($cantidadReparacionPaso);
						$vehiculosUnidad->setCantidadProcesoBaja($cantidadPBajaPaso);
						$vehiculosUnidad->setCantidadTribunal($cantidadTribunalPaso);
                        
                        //Aqui en adelante
                        $vehiculosUnidad->setCantidadActivo($cantidadActivo);
                     	$vehiculosUnidad->setCantidadAgregado($cantidadAgregado);
                        $vehiculosUnidad->setCantidadReparacionMenor($cantidadReparacionMenor);
                     	$vehiculosUnidad->setCantidadReparacionMayor($cantidadReparacionMayor);
                        $vehiculosUnidad->setCantidadEvaluacionFalla($cantidadEvaluacionFalla);
                     	$vehiculosUnidad->setCantidadTramiteAdm($cantidadTramiteAdm);
													
						$listaVehiculosUnidad[$i] = $vehiculosUnidad;
			}		
			
		}
		
					
}//end class        
?>