<?
Class dbLicenciaConducir extends Conexion
{			
	
	function insertDatosLicenciaDeConducirMunicipal($licenciaDeConducir){
		
		$sql = "INSERT INTO LICENCIA_MUNICIPAL (FUN_CODIGO, LM_NUMERO, COM_CODIGO, LM_FECHA_ULTIMO_CONTROL, LM_FECHA_PROXIMO_CONTROL, LM_OBSERVACIONES) 
				VALUES ('".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."',
						 ".$licenciaDeConducir->getNumero().",
						 ".$licenciaDeConducir->getComuna().",
						'".$licenciaDeConducir->getFechaUltimoControl()."',
						'".$licenciaDeConducir->getFechaProximoControl()."',
						'".$licenciaDeConducir->getObservaciones()."')"; 
				
				
				//ON DUPLICATE KEY UPDATE 
				//		COM_CODIGO = ".$licenciaDeConducir->getComuna() .", 
				//		LM_FECHA_ULTIMO_CONTROL = '".$licenciaDeConducir->getFechaUltimoControl()."',
				//		LM_FECHA_PROXIMO_CONTROL = '".$licenciaDeConducir->getFechaProximoControl()."',
				//		LM_OBSERVACIONES = '".$licenciaDeConducir->getObservaciones()."');";

		//echo $sql;

		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function deleteDatosLicenciaDeConducirMunicipal($licenciaDeConducir){
		
		$sql = "DELETE FROM LICENCIA_MUNICIPAL 
				WHERE 
					FUN_CODIGO = '".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."' AND
					LM_NUMERO = ". $licenciaDeConducir->getNumero();

		//echo $sql;

		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function insertClasesLicenciaDeConducirMunicipal($licenciaDeConducir){
		
		$cantidadClases = $licenciaDeConducir->getCantidadDeClases();
		
		$sql = "INSERT INTO CLASE_LICENCIA_CONDUCIR (FUN_CODIGO, LM_NUMERO, TLIC_CODIGO) VALUES ";
		for ($i=0; $i<$cantidadClases; $i++){
			$sql .= "('".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."',".$licenciaDeConducir->getNumero().",".$licenciaDeConducir->getClases($i)->getCodigo()."),";
		}
		$sql = substr($sql, 0, -1);  
		
		//echo $sql;
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function deleteClasesLicenciaDeConducirMunicipal($licenciaDeConducir){
		
		$sql = "DELETE FROM CLASE_LICENCIA_CONDUCIR  
				WHERE 
					FUN_CODIGO = '".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."' AND
					LM_NUMERO = ". $licenciaDeConducir->getNumero();
				
		//echo $sql;
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
		
	
	
	function insertRestriccionLicenciaDeConducirMunicipal($licenciaDeConducir){
		
		$cantidadRestriccones = $licenciaDeConducir->getCantidadDeRestricciones();
		
		$sql = "INSERT INTO RESTRICCION_CONDUCIR_MUNICIPAL (FUN_CODIGO, LM_NUMERO, TRE_CODIGO) VALUES ";
		for ($i=0; $i<$cantidadRestriccones; $i++){
			$sql .= "('".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."',".$licenciaDeConducir->getNumero().",".$licenciaDeConducir->getRestricciones($i)->getCodigo()."),";
		}
		$sql = substr($sql, 0, -1);  
		
		//echo $sql;
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function deleteRestriccionLicenciaDeConducirMunicipal($licenciaDeConducir){

		$sql = "DELETE FROM RESTRICCION_CONDUCIR_MUNICIPAL 
				WHERE 
				FUN_CODIGO = '".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."' AND
				LM_NUMERO = ". $licenciaDeConducir->getNumero();
	
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function insertLicenciaConducirMunicipal($licenciaDeConducir){
		
		
		
		$this->deleteClasesLicenciaDeConducirMunicipal($licenciaDeConducir);   
		$this->deleteRestriccionLicenciaDeConducirMunicipal($licenciaDeConducir);
		$this->deleteDatosLicenciaDeConducirMunicipal($licenciaDeConducir);
		
		$resultDatosLicencia = $this->insertDatosLicenciaDeConducirMunicipal($licenciaDeConducir);
		
		$resultClases 		 = $this->insertClasesLicenciaDeConducirMunicipal($licenciaDeConducir);
		if ($licenciaDeConducir->getCantidadDeRestricciones() > 0) $resultRestricciones = $this->insertRestriccionLicenciaDeConducirMunicipal($licenciaDeConducir);
		
		$resultado = $resultDatosLicencia . " - " . $resultClases  . " - " . $resultRestricciones;
		return $resultado;
	}
	
	
	function deleteLicenciaConducirMunicipal($licenciaDeConducir){
			
		$this->deleteClasesLicenciaDeConducirMunicipal($licenciaDeConducir);   
		$this->deleteRestriccionLicenciaDeConducirMunicipal($licenciaDeConducir);
		$this->deleteDatosLicenciaDeConducirMunicipal($licenciaDeConducir);

	}
	
	
	
	
	
	function insertDatosLicenciaDeConducirSemep($licenciaDeConducir){
		
		
		$sql = "INSERT INTO LICENCIA_SEMEP (FUN_CODIGO, LS_FECHA_HABILITACION, TEV_CODIGO, LS_FECHA_RENOVACION, LS_OBSERVACIONES) 
				VALUES ('".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."',
						'".$licenciaDeConducir->getFechaHabilitacion()."',
						 ".$licenciaDeConducir->getEvaluacion()->getCodigo().",
						'".$licenciaDeConducir->getFechaRenovacion()."',
						'".$licenciaDeConducir->getObservaciones()."')";
						 
				//ON DUPLICATE KEY UPDATE 
				//		TEV_CODIGO = ".$licenciaDeConducir->getComuna() .",
				//		LS_FECHA_RENOVACION = '".getEvaluacion()->getCodigo()."',
				//		LS_OBSERVACIONES = '".$licenciaDeConducir->getObservaciones()."')";

		//echo $sql;

		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function deleteDatosLicenciaDeConducirSemep($licenciaDeConducir){
		
		$sql = "DELETE FROM LICENCIA_SEMEP 
				WHERE
				FUN_CODIGO = '".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."' AND
				LS_FECHA_HABILITACION = '".$licenciaDeConducir->getFechaHabilitacion()."'";
		
		//echo $sql;

		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function insertVehiculosAutorizadosLicenciaDeConducirSemep($licenciaDeConducir){
		
		$cantidadVehiculos = $licenciaDeConducir->getCantidadDeVehiculosAutorizados();
		
		$sql = "INSERT INTO VEHICULO_AUTORIZADO_SEMEP (FUN_CODIGO, LS_FECHA_HABILITACION, TSEM_CODIGO) VALUES ";
		for ($i=0; $i<$cantidadVehiculos; $i++){
			$sql .= "('".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."','".$licenciaDeConducir->getFechaHabilitacion()."',".$licenciaDeConducir->getVehiculosAutorizados($i)->getCodigo()."),";
		}
		$sql = substr($sql, 0, -1);  
		
		//echo $sql;
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function deleteVehiculosAutorizadosLicenciaDeConducirSemep($licenciaDeConducir){
		
		$sql = "DELETE FROM VEHICULO_AUTORIZADO_SEMEP 
				WHERE
				FUN_CODIGO = '".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."' AND
				LS_FECHA_HABILITACION = '".$licenciaDeConducir->getFechaHabilitacion()."'";
		
		//echo $sql;
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	
	function insertRestriccionLicenciaDeConducirSemep($licenciaDeConducir){
		
		$cantidadRestriccones = $licenciaDeConducir->getCantidadDeRestricciones();
		
		$sql = "INSERT INTO RESTRICCION_CONDUCIR_SEMEP (FUN_CODIGO, LS_FECHA_HABILITACION, TRE_CODIGO) VALUES ";
		for ($i=0; $i<$cantidadRestriccones; $i++){
			$sql .= "('".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."','".$licenciaDeConducir->getFechaHabilitacion()."',".$licenciaDeConducir->getRestricciones($i)->getCodigo()."),";
		}
		$sql = substr($sql, 0, -1);  
		
		//echo $sql;
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function deleteRestriccionLicenciaDeConducirSemep($licenciaDeConducir){
		
				
		$sql = "DELETE FROM RESTRICCION_CONDUCIR_SEMEP 
				WHERE
				FUN_CODIGO = '".$licenciaDeConducir->getFuncionario()->getCodigoFuncionario()."' AND
				LS_FECHA_HABILITACION = '".$licenciaDeConducir->getFechaHabilitacion()."'";
		
		//echo $sql;
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function insertLicenciaConducirSemep($licenciaDeConducir){
		
		$tipoEvaluacionIngresada = $licenciaDeConducir->getEvaluacion()->getCodigo();
		
		
		$this->deleteVehiculosAutorizadosLicenciaDeConducirSemep($licenciaDeConducir);
		$this->deleteRestriccionLicenciaDeConducirSemep($licenciaDeConducir);
		$this->deleteDatosLicenciaDeConducirSemep($licenciaDeConducir);
		
		$resultDatosLicencia = $this->insertDatosLicenciaDeConducirSemep($licenciaDeConducir);
		
		if ($tipoEvaluacionIngresada != 30 && $tipoEvaluacionIngresada != 40){
			$resultVehiculos	 = $this->insertVehiculosAutorizadosLicenciaDeConducirSemep($licenciaDeConducir);
			if ($licenciaDeConducir->getCantidadDeRestricciones() > 0) $resultRestricciones = $this->insertRestriccionLicenciaDeConducirSemep($licenciaDeConducir);
		}
		
		$resultado = $resultDatosLicencia . " - " . $resultVehiculos  . " - " . $resultRestricciones;
		return $resultado;
	}


	function deleteLicenciaConducirSemep($licenciaDeConducir){
		
	
		$this->deleteVehiculosAutorizadosLicenciaDeConducirSemep($licenciaDeConducir);
		$this->deleteRestriccionLicenciaDeConducirSemep($licenciaDeConducir);
		$this->deleteDatosLicenciaDeConducirSemep($licenciaDeConducir);

	}		
		
			
	
	
	function listaLicenciasDeConducir($unidad, $nombreCampo, $orden, $funcionarios){
	
		
		if ($nombreCampo == "grado")  			  $campoOrdenar = "FUNCIONARIO.ESC_CODIGO ".$orden.", FUNCIONARIO.GRA_CODIGO ".$orden.", FUNCIONARIO.FUN_CODIGO ".$orden;
		if ($nombreCampo == "nombre") 			  $campoOrdenar = "FUNCIONARIO.FUN_APELLIDOPATERNO ".$orden.", FUNCIONARIO.FUN_APELLIDOMATERNO ".$orden.", FUNCIONARIO.FUN_NOMBRE ".$orden;
		if ($nombreCampo == "codigo") 			  $campoOrdenar = "FUNCIONARIO.FUN_CODIGO ".$orden;
		if ($nombreCampo == "cargo")  			  $campoOrdenar = "CARGO.CAR_DESCRIPCION ".$orden;
		if ($nombreCampo == "licenciaMunicipal")  $campoOrdenar = "LICENCIA_MUNICIPAL.LM_FECHA_PROXIMO_CONTROL ".$orden;
		if ($nombreCampo == "licenciaSemep")  	  $campoOrdenar = "LICENCIA_SEMEP.LS_FECHA_RENOVACION ".$orden;
		
		if ($nombreCampo == "") $campoOrdenar = "FUNCIONARIO.ESC_CODIGO, FUNCIONARIO.GRA_CODIGO, FUNCIONARIO.FUN_CODIGO";
		
				
		$sql = "SELECT DISTINCT
				  FUNCIONARIO.FUN_CODIGO,
				  GRADO.GRA_DESCRIPCION,
				  CARGO.CAR_DESCRIPCION,
				  FUNCIONARIO.FUN_APELLIDOPATERNO,
				  FUNCIONARIO.FUN_APELLIDOMATERNO,
				  FUNCIONARIO.FUN_NOMBRE,
				  FUNCIONARIO.FUN_NOMBRE2,
				  LICENCIA_MUNICIPAL.LM_FECHA_PROXIMO_CONTROL,
				  LICENCIA_SEMEP.LS_FECHA_RENOVACION,
				  LICENCIA_MUNICIPAL.COM_CODIGO,
				  COMUNA.COM_DESCRIPCION,
				  ARCHIVO_LICENCIA_CONDUCIR.TIPO,
				  ARCHIVO_LICENCIA_CONDUCIR.NOMBRE_ARCHIVO
				FROM
				  FUNCIONARIO
				  INNER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				  INNER JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
				  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
				  INNER JOIN ESCALAFON ON (GRADO.ESC_CODIGO = ESCALAFON.ESC_CODIGO)
				  LEFT OUTER JOIN LICENCIA_MUNICIPAL ON (FUNCIONARIO.FUN_CODIGO = LICENCIA_MUNICIPAL.FUN_CODIGO)
				  LEFT OUTER JOIN COMUNA ON (LICENCIA_MUNICIPAL.COM_CODIGO = COMUNA.COM_CODIGO)
				  LEFT OUTER JOIN LICENCIA_SEMEP ON (FUNCIONARIO.FUN_CODIGO = LICENCIA_SEMEP.FUN_CODIGO)
				  LEFT OUTER JOIN ARCHIVO_LICENCIA_CONDUCIR ON (FUNCIONARIO.FUN_CODIGO = ARCHIVO_LICENCIA_CONDUCIR.FUN_CODIGO) 
				WHERE FUNCIONARIO.UNI_CODIGO = ".$unidad." AND CARGO_FUNCIONARIO.FECHA_HASTA IS NULL AND TESC_CODIGO IN (10,320,330)
				ORDER BY ".$campoOrdenar;				  
								
				//echo $sql;
				
				$i=0;
				$result = $this->execstmt($this->Conecta(),$sql);
				mysql_close();
				while($myrow = mysql_fetch_array($result)){
					$grado = new grado;
					$grado->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
					
					$cargo = new cargo;
					$cargo->setCodigo(STRTOUPPER($myrow["CAR_CODIGO"]));
					$cargo->setDescripcion(STRTOUPPER($myrow["CAR_DESCRIPCION"]));
					
					$cuadrante = new cuadrante;
					$cuadrante->setCodigo($myrow["CUADRANTE_CODIGO"]);
					$cuadrante->setAbreviatura($myrow["CUA_ABREVIATURA"]);
					
					$comuna = new comuna;
					$comuna->setCodigoComuna($myrow["COM_CODIGO"]);
					$comuna->setDescripcionComuna($myrow["COM_DESCRIPCION"]);
					
					
					if ($myrow["LM_FECHA_PROXIMO_CONTROL"] != ""){
						$arrayFechaPaso					= explode("-",$myrow["LM_FECHA_PROXIMO_CONTROL"]);
						$municipalFechaProximoControl 	= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
					} else {
						$municipalFechaProximoControl = "";
					}
					
					if ($myrow["LS_FECHA_RENOVACION"] != ""){  
						$arrayFechaPaso					= explode("-",$myrow["LS_FECHA_RENOVACION"]);
						$semepFechaRenovacion 			= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
					} else {
						$semepFechaRenovacion = "";
					}
					
					
					$licenciaConducirMunicipal = new licenciaConducirMunicipal;
					$licenciaConducirMunicipal->setFechaProximoControl($municipalFechaProximoControl);
					$licenciaConducirMunicipal->setComuna($comuna);
					
					$licenciaConducirSemep = new licenciaConducirSemep;
					$licenciaConducirSemep->setFechaRenovacion($semepFechaRenovacion);
					
					$persona = new funcionario;
					$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
					$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
					$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
					$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
					$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
					$persona->setGrado($grado);
					$persona->setCargo($cargo);
					$persona->setCuadrante($cuadrante);
					$persona->setLicenciaConducirMunicipal($licenciaConducirMunicipal);
					$persona->setLicenciaSemep($licenciaConducirSemep);
					
					// $tieneLicencia = "";
					//if($myrow["TIPO"] == "NO TIENE") $tieneLicencia = 0;
					//if($myrow["TIPO"] == "MUNICIPAL") $tieneLicencia = 1;
					//if($myrow["TIPO"] == "SEMEP") $tieneLicencia = 2;
					
					$persona->setTieneLicencia(STRTOUPPER($myrow["TIPO"])); 
					$persona->setArchivoLicencia(($myrow["NOMBRE_ARCHIVO"])); 
					
					
					$funcionarios[$i] = $persona;					
					$i++;
				}
		}
	
	
	function buscaLicenciasFuncionario($codigoFuncionario, $funcionario){
		
		$sql = "SELECT 
				  FUNCIONARIO.FUN_CODIGO,
				  GRADO.GRA_DESCRIPCION,
				  FUNCIONARIO.FUN_APELLIDOPATERNO,
				  FUNCIONARIO.FUN_APELLIDOMATERNO,
				  FUNCIONARIO.FUN_NOMBRE,
				  FUNCIONARIO.FUN_NOMBRE2,
				  CARGO_FUNCIONARIO.CAR_CODIGO, 
				  CARGO.CAR_DESCRIPCION,
				  LICENCIA_MUNICIPAL.COM_CODIGO,
				  COMUNA.COM_DESCRIPCION,
				  LICENCIA_MUNICIPAL.LM_NUMERO,
				  LICENCIA_MUNICIPAL.LM_FECHA_ULTIMO_CONTROL,
				  LICENCIA_MUNICIPAL.LM_FECHA_PROXIMO_CONTROL,
				  LICENCIA_MUNICIPAL.LM_OBSERVACIONES,
				  LICENCIA_SEMEP.LS_FECHA_HABILITACION,
				  LICENCIA_SEMEP.TEV_CODIGO,
				  TIPO_EVALUACION_SEMEP.TEV_DESCRIPCION,
				  LICENCIA_SEMEP.LS_FECHA_RENOVACION,
				  LICENCIA_SEMEP.LS_OBSERVACIONES,
				  ARCHIVO_LICENCIA_CONDUCIR.TIPO,
				  ARCHIVO_LICENCIA_CONDUCIR.NOMBRE_ARCHIVO
				FROM
				  FUNCIONARIO
				  INNER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				  INNER JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
				  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
				  LEFT OUTER JOIN LICENCIA_MUNICIPAL ON (FUNCIONARIO.FUN_CODIGO = LICENCIA_MUNICIPAL.FUN_CODIGO)
				  LEFT OUTER JOIN LICENCIA_SEMEP ON (FUNCIONARIO.FUN_CODIGO = LICENCIA_SEMEP.FUN_CODIGO)
				  LEFT OUTER JOIN TIPO_EVALUACION_SEMEP ON (LICENCIA_SEMEP.TEV_CODIGO = TIPO_EVALUACION_SEMEP.TEV_CODIGO)
				  LEFT OUTER JOIN COMUNA ON (LICENCIA_MUNICIPAL.COM_CODIGO = COMUNA.COM_CODIGO)
				  LEFT OUTER JOIN ARCHIVO_LICENCIA_CONDUCIR ON (FUNCIONARIO.FUN_CODIGO = ARCHIVO_LICENCIA_CONDUCIR.FUN_CODIGO)
				WHERE
				  FUNCIONARIO.FUN_CODIGO = '".$codigoFuncionario."' AND 
				  CARGO_FUNCIONARIO.FECHA_HASTA IS NULL";
		
			//echo $sql;
		
				$i=0;
				$result = $this->execstmt($this->Conecta(),$sql);
				mysql_close();
				
				//echo mysql_num_rows($result);

				while($myrow = mysql_fetch_array($result)){
					
					$grado = new grado;
					$grado->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
					
					$cargo = new cargo;
					$cargo->setCodigo(STRTOUPPER($myrow["CAR_CODIGO"]));
					$cargo->setDescripcion(STRTOUPPER($myrow["CAR_DESCRIPCION"]));
					
					$comuna = new comuna;
					$comuna->setCodigoComuna(STRTOUPPER($myrow["COM_CODIGO"]));
					$comuna->setDescripcionComuna(STRTOUPPER($myrow["COM_DESCRIPCION"]));
					
					if ($myrow["LM_FECHA_ULTIMO_CONTROL"] != ""){
						$arrayFechaPaso					= explode("-",$myrow["LM_FECHA_ULTIMO_CONTROL"]);
						$municipalFechaUltimoControl 	= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
					} else {
						$municipalFechaUltimoControl = "";
					}
	
					if ($myrow["LM_FECHA_PROXIMO_CONTROL"] != ""){
						$arrayFechaPaso					= explode("-",$myrow["LM_FECHA_PROXIMO_CONTROL"]);
						$municipalFechaProximoControl 	= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
					} else {
						$municipalFechaProximoControl = "";
					}
					
					$licenciaConducirMunicipal = new licenciaConducirMunicipal;
					$licenciaConducirMunicipal->setNumero($myrow["LM_NUMERO"]);
					$licenciaConducirMunicipal->setComuna($comuna);
					$licenciaConducirMunicipal->setFechaUltimoControl($municipalFechaUltimoControl);
					$licenciaConducirMunicipal->setFechaProximoControl($municipalFechaProximoControl);
					$licenciaConducirMunicipal->setObservaciones($myrow["LM_OBSERVACIONES"]);
					
					
					$evaluacionSemep = new tipoEvaluacionSemep;
					$evaluacionSemep->setCodigo($myrow["TEV_CODIGO"]);
					$evaluacionSemep->setDescripcion(STRTOUPPER($myrow["TEV_DESCRIPCION"]));
					
					
					
					if ($myrow["LS_FECHA_HABILITACION"] != ""){
						$arrayFechaPaso					= explode("-",$myrow["LS_FECHA_HABILITACION"]);
						$semepFechaHabilitacion 	= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
					} else {
						$semepFechaHabilitacion = "";
					}
	
					if ($myrow["LS_FECHA_RENOVACION"] != ""){  
						$arrayFechaPaso					= explode("-",$myrow["LS_FECHA_RENOVACION"]);
						$semepFechaRenovacion 	= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
					} else {
						$semepFechaRenovacion = "";
					}
					
					
					$licenciaConducirSemep = new licenciaConducirSemep;
					$licenciaConducirSemep->setEvaluacion($evaluacionSemep);
					$licenciaConducirSemep->setFechaHabilitacion($semepFechaHabilitacion);
					$licenciaConducirSemep->setFechaRenovacion($semepFechaRenovacion);
					$licenciaConducirSemep->setObservaciones($myrow["LS_OBSERVACIONES"]);
					
					$persona = new funcionario;
					$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
					$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
					$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
					$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
					$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
					$persona->setGrado($grado);
					$persona->setCargo($cargo);
					$persona->setLicenciaConducirMunicipal($licenciaConducirMunicipal);
					$persona->setLicenciaSemep($licenciaConducirSemep);
					$persona->setTieneLicencia(STRTOUPPER($myrow["TIPO"]));
					$persona->setArchivoLicencia(($myrow["NOMBRE_ARCHIVO"]));
					
					$funcionario = $persona;					
					$i++;
				}
	}
	
	function buscaClaseLCMunicipalFuncionario($codigoFuncionario, $funcionario){
		
		$sql = "SELECT 
  					CLASE_LICENCIA_CONDUCIR.TLIC_CODIGO,
  					TIPO_LICENCIA_CONDUCIR.TLIC_DESCRIPCION
				FROM
  					CLASE_LICENCIA_CONDUCIR
  					INNER JOIN TIPO_LICENCIA_CONDUCIR ON (CLASE_LICENCIA_CONDUCIR.TLIC_CODIGO = TIPO_LICENCIA_CONDUCIR.TLIC_CODIGO)
				WHERE
  					CLASE_LICENCIA_CONDUCIR.FUN_CODIGO = '".$codigoFuncionario."' AND CLASE_LICENCIA_CONDUCIR.LM_NUMERO = ". $funcionario->getLicenciaConducirMunicipal()->getNumero();
		
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
				
		while($myrow = mysql_fetch_array($result)){
			$claseLicenciaConducir = new tipoLicenciaConducir;
			$claseLicenciaConducir->setCodigo($myrow["TLIC_CODIGO"]);
			$claseLicenciaConducir->setDescripcion(STRTOUPPER($myrow["TLIC_DESCRIPCION"]));
			
			$funcionario->getLicenciaConducirMunicipal()->setClases($claseLicenciaConducir);
		}
	}
	
	
	function buscaRestriccionLCMunicipalFuncionario($codigoFuncionario, $funcionario){
		
	
		$sql = "SELECT 
				  RESTRICCION_CONDUCIR_MUNICIPAL.TRE_CODIGO,
				  TIPO_RESTRICCION_CONDUCIR.TRE_DESCRIPCION
				FROM
				  RESTRICCION_CONDUCIR_MUNICIPAL
				  INNER JOIN TIPO_RESTRICCION_CONDUCIR ON (RESTRICCION_CONDUCIR_MUNICIPAL.TRE_CODIGO = TIPO_RESTRICCION_CONDUCIR.TRE_CODIGO)
				WHERE
				  RESTRICCION_CONDUCIR_MUNICIPAL.FUN_CODIGO = '".$codigoFuncionario."' AND RESTRICCION_CONDUCIR_MUNICIPAL.LM_NUMERO = ". $funcionario->getLicenciaConducirMunicipal()->getNumero();
		
		//echo $sql;

		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
				
		while($myrow = mysql_fetch_array($result)){
			$restriccionLicenciaConducir = new tipoRestriccionConducir;
			$restriccionLicenciaConducir->setCodigo($myrow["TRE_CODIGO"]);
			$restriccionLicenciaConducir->setDescripcion(STRTOUPPER($myrow["TRE_DESCRIPCION"]));
			
			$funcionario->getLicenciaConducirMunicipal()->setRestricciones($restriccionLicenciaConducir);
		}
	}
		

	function buscaVehiculosPermitidosSemep($codigoFuncionario, $funcionario){
		
		$arrayFechaPaso				= explode("-",$funcionario->getLicenciaSemep()->getFechaHabilitacion());
		$semepFechaHabilitacion 	= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
			
		
		$sql = "SELECT 
				  VEHICULO_AUTORIZADO_SEMEP.TSEM_CODIGO,
				  TIPO_CLASIFICACION_SEMEP.TSEM_DESCRIPCION
				FROM
				  VEHICULO_AUTORIZADO_SEMEP
				  INNER JOIN TIPO_CLASIFICACION_SEMEP ON (VEHICULO_AUTORIZADO_SEMEP.TSEM_CODIGO = TIPO_CLASIFICACION_SEMEP.TSEM_CODIGO)
				WHERE
				  VEHICULO_AUTORIZADO_SEMEP.FUN_CODIGO = '".$codigoFuncionario."' AND VEHICULO_AUTORIZADO_SEMEP.LS_FECHA_HABILITACION = '". $semepFechaHabilitacion ."'";
		
		//echo $sql;
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
				
		while($myrow = mysql_fetch_array($result)){
			$vehiculoAutorizado = new tipoClasificacionSemep;
			$vehiculoAutorizado->setCodigo($myrow["TSEM_CODIGO"]);
			$vehiculoAutorizado->setDescripcion(STRTOUPPER($myrow["TSEM_DESCRIPCION"]));
			
			$funcionario->getLicenciaSemep()->setVehiculosAutorizados($vehiculoAutorizado);
		}
	}	
	
	
	function buscaRestriccionesSemep($codigoFuncionario, $funcionario){
		
		$arrayFechaPaso				= explode("-",$funcionario->getLicenciaSemep()->getFechaHabilitacion());
		$semepFechaHabilitacion 	= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
		
		
		$sql = "SELECT 
				  RESTRICCION_CONDUCIR_SEMEP.TRE_CODIGO,
				  TIPO_RESTRICCION_CONDUCIR.TRE_DESCRIPCION
				FROM
				  RESTRICCION_CONDUCIR_SEMEP
				  INNER JOIN TIPO_RESTRICCION_CONDUCIR ON (RESTRICCION_CONDUCIR_SEMEP.TRE_CODIGO = TIPO_RESTRICCION_CONDUCIR.TRE_CODIGO)
				WHERE
				  RESTRICCION_CONDUCIR_SEMEP.FUN_CODIGO = '".$codigoFuncionario."' AND RESTRICCION_CONDUCIR_SEMEP.LS_FECHA_HABILITACION = '". $semepFechaHabilitacion ."'";
		
		//echo $sql;
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
				
		while($myrow = mysql_fetch_array($result)){
			$restriccionLicenciaConducir = new tipoRestriccionConducir;
			$restriccionLicenciaConducir->setCodigo($myrow["TRE_CODIGO"]);
			$restriccionLicenciaConducir->setDescripcion(STRTOUPPER($myrow["TRE_DESCRIPCION"]));
			
			$funcionario->getLicenciaSemep()->setRestricciones($restriccionLicenciaConducir);
			
		}
	}		
		
	
	function insertArchivoSubido($codigoFuncionario, $tipo, $nombreArchivo){
		
				
		$sql = "INSERT INTO ARCHIVO_LICENCIA_CONDUCIR (FUN_CODIGO, TIPO, NOMBRE_ARCHIVO)
				VALUES ('".$codigoFuncionario."',
						'".$tipo."',
						'".$nombreArchivo."')";
						 
		//echo $sql;

		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	
	function deleteArchivoSubido($codigoFuncionario, $tipo, $nombreArchivo){
		
				
		$sql = "DELETE FROM ARCHIVO_LICENCIA_CONDUCIR
				WHERE 
					FUN_CODIGO = '".$codigoFuncionario."' AND
					TIPO = '". $tipo."' AND
					NOMBRE_ARCHIVO = '". $nombreArchivo. "';";
						 
		//echo $sql;

		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
		
		
}//end class   
?>