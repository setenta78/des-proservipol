<?
Class dbServicios extends Conexion
{			
	
		function listaServiciosUnidad($unidad, $fecha1, $fecha2, $tipoServicios, $servicios){	
			
			//$sql = "SELECT 
			//		  SERVICIO.UNI_CODIGO,
			//		  SERVICIO.CORRELATIVO_SERVICIO,
			//		  UNIDAD.UNI_DESCRIPCION,
			//		  SERVICIO.TSERV_CODIGO,
			//		  TIPO_SERVICIO.TSERV_DESCRIPCION,
			//		  TIPO_SERVICIO.TSERV_TIPO,
			//		  SERVICIO.TEXT_CODIGO,
			//		  TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION,
			//		  SERVICIO.FECHA,
			//		  SERVICIO.HORA_INICIO,
			//		  SERVICIO.HORA_TERMINO
			//		FROM
			//		  SERVICIO
			//		  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
			//		  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
			//		  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
			//		WHERE
			//		  (SERVICIO.UNI_CODIGO = ". $unidad . ")
			//		   AND
			//		  (SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."')";
			//
			//if ($tipoServicios != "") $sql .= " AND (SERVICIO.TSERV_CODIGO IN (".$tipoServicios."))";
			//
			//$sql .= " ORDER BY SERVICIO.FECHA DESC, TIPO_SERVICIO.TSERV_DESCRIPCION ASC";



			$sql = "SELECT DISTINCT
						  SERVICIO.UNI_CODIGO,
						  SERVICIO.CORRELATIVO_SERVICIO,
						  UNIDAD.UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  TIPO_SERVICIO.TSERV_TIPO,
						  SERVICIO.TEXT_CODIGO,
						  TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION,
						  SERVICIO.FECHA,
						  SERVICIO.HORA_INICIO,
						  SERVICIO.HORA_TERMINO,
						  SERVICIOS_CERTIFICADO.FECHA_CERTIFICADO
						FROM
						  SERVICIO
						  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
						  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
						  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
						  LEFT OUTER JOIN SERVICIOS_CERTIFICADO ON (SERVICIO.FECHA = SERVICIOS_CERTIFICADO.FECHA_SERVICIOS)
						  AND (SERVICIO.UNI_CODIGO = SERVICIOS_CERTIFICADO.UNI_CODIGO)
						WHERE
						  (SERVICIO.UNI_CODIGO = ". $unidad . ") AND 
						  (SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."')
						  AND TIPO_SERVICIO.TSERV_CODIGO NOT IN (170,180,633,632,180,162,5005,630,631)";
			
			if ($tipoServicios != "") $sql .= " AND (SERVICIO.TSERV_CODIGO IN (".$tipoServicios."))";
			
			$sql .= " ORDER BY SERVICIO.FECHA DESC, TIPO_SERVICIO.TSERV_DESCRIPCION ASC";


								
			//echo $sql;
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion($myrow["TSERV_DESCRIPCION"]);
				$tipoServicio->setTipo($myrow["TSERV_TIPO"]);
				
				$tipoServicioExtraordinario = new tipoServicioExtraordinario;
				$tipoServicioExtraordinario->setCodigo($myrow["TEXT_CODIGO"]);
				$tipoServicioExtraordinario->setDescripcion($myrow["TEXT_DESCRIPCION"]);
				
				$servicio = new servicio;
				$servicio->setUnidad($unidad);
				$servicio->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$servicio->setFecha($myrow["FECHA"]);
				$servicio->setTipoServicio($tipoServicio);
				$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
				$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
				$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
				$servicio->setFechaValidacion($myrow["FECHA_CERTIFICADO"]);
								
				$servicios[$i] = $servicio;

				$i++;
			}
		}	
		
		function buscaDatosServicio($unidad, $correlativo, &$servicio){
			
			$sql = "SELECT 
					  SERVICIO.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  SERVICIO.CORRELATIVO_SERVICIO,
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  TIPO_SERVICIO.TSERV_TIPO,
					  SERVICIO.TEXT_CODIGO,
					  TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION,
					  SERVICIO.FECHA,
					  SERVICIO.HORA_INICIO,
					  SERVICIO.HORA_TERMINO,
					  SERVICIO.DESCRIPCION_OTRO_EXTRAORDINARIO,
					  SERVICIO.DESCRIPCION_SERVICIO
					FROM
					  SERVICIO
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					WHERE
					  SERVICIO.UNI_CODIGO = ".$unidad." AND 
					  SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo;
			
			 //echo $sql;
         
	         $cont=0;
			 $i=0;
			 $result = $this->execstmt($this->Conecta(),$sql);
			 mysql_close();
			 $myrow = mysql_fetch_array($result);

			 $unidad = new unidad;
			 $unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);  
			 $unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);  

			 $tipoServicio = new tipoServicio;
			 $tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
			 $tipoServicio->setDescripcion($myrow["TSERV_DESCRIPCION"]);
			 $tipoServicio->setTipo($myrow["TSERV_TIPO"]);
			 
			 $tipoServicioExtraordinario = new tipoServicioExtraordinario;
			 $tipoServicioExtraordinario->setCodigo($myrow["TEXT_CODIGO"]);
			 $tipoServicioExtraordinario->setDescripcion($myrow["TEXT_DESCRIPCION"]);
			 
			 $servicio = new servicio;
			 $servicio->setUnidad($unidad);
			 $servicio->setFecha($myrow["FECHA"]);
			 $servicio->setTipoServicio($tipoServicio);
			 $servicio->setServicioExtraordinario($tipoServicioExtraordinario);
			 $servicio->setDescripcionServicioOtroExtraordinario($myrow["DESCRIPCION_OTRO_EXTRAORDINARIO"]);
			 $servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
			 $servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
			 $servicio->setObservaciones($myrow["DESCRIPCION_SERVICIO"]);
 
		}

		
		function buscaFuncionariosAsignados($unidad, $correlativo, $funcionarios){
			
			 $sql =  "SELECT 
					  	FUNCIONARIO_SERVICIO.FUN_CODIGO,
						FUNCIONARIO.ESC_CODIGO,
						FUNCIONARIO.GRA_CODIGO,
						GRADO.GRA_DESCRIPCION,
						FUNCIONARIO.FUN_APELLIDOPATERNO,
						FUNCIONARIO.FUN_APELLIDOMATERNO,
						FUNCIONARIO.FUN_NOMBRE
					  FROM
						FUNCIONARIO_SERVICIO
						INNER JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
						INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
					  WHERE
						FUNCIONARIO_SERVICIO.UNI_CODIGO = ".$unidad." AND 
						FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = ". $correlativo . " ORDER BY FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO";
		
			//echo $sql;
			
			$cont=0;
			$i=0;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				$escalafon = new escalafon;
				$escalafon->setCodigo(STRTOUPPER($myrow["ESC_CODIGO"]));
				$escalafon->setDescripcion("");

				$grado = new grado;
				$grado->setEscalafon($escalafon);
				$grado->setCodigo(STRTOUPPER($myrow["GRA_CODIGO"]));
				$grado->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
			
				$funcionario = new funcionario;
				$funcionario->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
				$funcionario->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
				$funcionario->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
				$funcionario->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
				$funcionario->setGrado($grado);
								
				$funcionarios[$i] = $funcionario;
				$i++;
			}
	}

	
	function buscaCuadrantesAsignados($unidad, $correlativo, $mediosVigilancia){
		
		$sql = "SELECT DISTINCT 
				  FUNCIONARIO_SERVICIO.NUMERO_MEDIO,
				  UNIDAD_CUADRANTE.CUADRANTE_CODIGO,
				  CUADRANTE.CUA_DESCRIPCION
				FROM
				  CUADRANTE_SERVICIO
				  INNER JOIN FUNCIONARIO_SERVICIO ON (CUADRANTE_SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
				  AND (CUADRANTE_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
				  AND (CUADRANTE_SERVICIO.FUN_CODIGO = FUNCIONARIO_SERVICIO.FUN_CODIGO)
				  INNER JOIN UNIDAD_CUADRANTE ON (CUADRANTE_SERVICIO.CUADRANTE_CODIGO = UNIDAD_CUADRANTE.CUADRANTE_CODIGO)
				  INNER JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
				WHERE
				  FUNCIONARIO_SERVICIO.UNI_CODIGO = ".$unidad." AND 
				  FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = " . $correlativo ."
				ORDER BY FUNCIONARIO_SERVICIO.NUMERO_MEDIO, UNIDAD_CUADRANTE.CUADRANTE_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			//echo "entre";
			$cuadrante = new cuadrante;
			$cuadrante->setCodigo($myrow["CUADRANTE_CODIGO"]);
			$cuadrante->setDescripcion($myrow["CUA_DESCRIPCION"]);
			$puntero = $myrow["NUMERO_MEDIO"] - 1;
			$mediosVigilancia[$puntero]->setCuadrantes($cuadrante);
			//echo $puntero;
		}
		
	}
	
	
	function buscaAccesoriosAsignados($unidad, $correlativo, $mediosVigilancia){
		
		$sql = "SELECT 
				  ACCESORIO_SERVICIO.FUN_CODIGO,
				  TIPO_ACCESORIO.TACC_CODIGO,
				  TIPO_ACCESORIO.TACC_DESCRIPCION
				FROM
				  ACCESORIO_SERVICIO
				  INNER JOIN TIPO_ACCESORIO ON (ACCESORIO_SERVICIO.TACC_CODIGO = TIPO_ACCESORIO.TACC_CODIGO)
				WHERE
				  ACCESORIO_SERVICIO.UNI_CODIGO = ".$unidad." AND 
				  ACCESORIO_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo."
				ORDER BY
				  ACCESORIO_SERVICIO.FUN_CODIGO,
				  ACCESORIO_SERVICIO.TACC_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$cantidadmediosVigilacia = count($mediosVigilancia);
		while($myrow = mysql_fetch_array($result)){
			$accesorio = new tipoAccesorio;
			$accesorio->setCodigo($myrow["TACC_CODIGO"]);
			$accesorio->setDescripcion($myrow["TACC_DESCRIPCION"]);
			
			for ($i=0;$i<$cantidadmediosVigilacia;$i++){
				$cantidadFuncionarios = $mediosVigilancia[$i]->getCantidadDeFuncionarios();
				for ($j=0; $j<$cantidadFuncionarios;$j++){
					$codigoFuncionarioObjeto = $mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario();
					if ($myrow["FUN_CODIGO"] == $codigoFuncionarioObjeto){
						$accesorio = new tipoAccesorio;
						$accesorio->setCodigo($myrow["TACC_CODIGO"]);
						$accesorio->setDescripcion($myrow["TACC_DESCRIPCION"]);
						
						$mediosVigilancia[$i]->getFuncionarios($j)->setAccesorios($accesorio);
					}
				}
			}
		}
	}
	
	
	function buscaArmasAsignadas($unidad, $correlativo, $mediosVigilancia){
		
		$sql = "SELECT 
				  ARMA_SERVICIO.FUN_CODIGO,
				  ARMA_SERVICIO.ARM_CODIGO,
				  TIPO_ARMA.TARM_CODIGO,
				  TIPO_ARMA.TARM_DESCRIPCION,
				  ARMA.ARM_NUMEROSERIE
				FROM
				  ARMA_SERVICIO
				  INNER JOIN ARMA ON (ARMA_SERVICIO.ARM_CODIGO = ARMA.ARM_CODIGO)
				  INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
				WHERE
				  ARMA_SERVICIO.UNI_CODIGO = ".$unidad." AND 
				  ARMA_SERVICIO.CORRELATIVO_SERVICIO = ". $correlativo ."
				ORDER BY ARMA_SERVICIO.FUN_CODIGO, ARMA_SERVICIO.ARM_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$cantidadMediosVigilacia = count($mediosVigilancia);
		while($myrow = mysql_fetch_array($result)){
			
			//$accesorio = new tipoAccesorio;
			//$accesorio->setCodigo($myrow["TACC_CODIGO"]);
			//$accesorio->setDescripcion($myrow["TACC_DESCRIPCION"]);
			
			for ($i=0;$i<$cantidadMediosVigilacia;$i++){
				$cantidadFuncionarios = $mediosVigilancia[$i]->getCantidadDeFuncionarios();
				//echo "cantidadFuncionarios " . $cantidadFuncionarios;
				for ($j=0; $j<$cantidadFuncionarios;$j++){
					$codigoFuncionarioObjeto = $mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario();
					if ($myrow["FUN_CODIGO"] == $codigoFuncionarioObjeto){
						$tipoArma = new tipoArma;
						$tipoArma->setCodigo($myrow["TARM_CODIGO"]);
						$tipoArma->setDescripcion($myrow["TARM_DESCRIPCION"]);
						
						$arma = new arma;
						$arma->setCodigo($myrow["ARM_CODIGO"]);
						$arma->setTipo($tipoArma);
						$arma->setNumeroSerie($myrow["ARM_NUMEROSERIE"]);
						
						$mediosVigilancia[$i]->getFuncionarios($j)->setArmas($arma);
					}
				}
			}
		}
	}
	
	function buscaSimccarAsignadas($unidad, $correlativo, $mediosVigilancia){
		
		$sql = "SELECT DISTINCT
				  SIMCCAR_SERVICIO.SIM_CODIGO,
				  SIMCCAR.SIM_SERIE,
				  SIMCCAR_SERVICIO.FUN_CODIGO
				FROM
				  SIMCCAR_SERVICIO
				  INNER JOIN SIMCCAR ON (SIMCCAR_SERVICIO.SIM_CODIGO = SIMCCAR.SIM_CODIGO)
				WHERE
				  SIMCCAR_SERVICIO.UNI_CODIGO = ".$unidad." AND 
				  SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO = ". $correlativo ."
				ORDER BY SIMCCAR_SERVICIO.SIM_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$cantidadMediosVigilacia = count($mediosVigilancia);
		while($myrow = mysql_fetch_array($result)){
			
			//$accesorio = new tipoAccesorio;
			//$accesorio->setCodigo($myrow["TACC_CODIGO"]);
			//$accesorio->setDescripcion($myrow["TACC_DESCRIPCION"]);
			
			for ($i=0;$i<$cantidadMediosVigilacia;$i++){
				$cantidadFuncionarios = $mediosVigilancia[$i]->getCantidadDeFuncionarios();
				//echo "cantidadFuncionarios " . $cantidadFuncionarios;
				for ($j=0; $j<$cantidadFuncionarios;$j++){
					$codigoFuncionarioObjeto = $mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario();
					if ($myrow["FUN_CODIGO"] == $codigoFuncionarioObjeto){
					//if ($codigoFuncionarioObjeto!=""){

						$arma = new dioscar;
						$arma->setCodigoSimccar($myrow["SIM_CODIGO"]);
						$arma->setSerieSimccar($myrow["SIM_SERIE"]);

						$mediosVigilancia[$i]->getFuncionarios($j)->setSimccars($arma);
					}
				}
			}
		}
	}
	
	
	function buscaAnimalesAsignados($unidad, $correlativo, $mediosVigilancia){
		
		$sql = "SELECT 
				  ANIMAL_SERVICIO.FUN_CODIGO,
				  ANIMAL_SERVICIO.TANIM_CODIGO,
				  TIPO_ANIMAL.TANIM_DESCRIPCION
				FROM
				  ANIMAL_SERVICIO
				  INNER JOIN TIPO_ANIMAL ON (ANIMAL_SERVICIO.TANIM_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
				WHERE
				  ANIMAL_SERVICIO.UNI_CODIGO = ".$unidad." AND 
				  ANIMAL_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo."
				ORDER BY ANIMAL_SERVICIO.FUN_CODIGO, ANIMAL_SERVICIO.TANIM_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$cantidadmediosVigilacia = count($mediosVigilancia);
		while($myrow = mysql_fetch_array($result)){

			for ($i=0;$i<$cantidadmediosVigilacia;$i++){
				$cantidadFuncionarios = $mediosVigilancia[$i]->getCantidadDeFuncionarios();
				for ($j=0; $j<$cantidadFuncionarios;$j++){
					$codigoFuncionarioObjeto = $mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario();
					if ($myrow["FUN_CODIGO"] == $codigoFuncionarioObjeto){
						$animal = new tipoAnimal;
						$animal->setCodigo($myrow["TANIM_CODIGO"]);
						$animal->setDescripcion($myrow["TANIM_DESCRIPCION"]);
											
						$mediosVigilancia[$i]->getFuncionarios($j)->setAnimales($animal);
					}
				}
			}
		}
	}
	
	
	
	
	function buscaMedioVigilancia($unidad, $correlativo, $mediosVigilancia){
			
			 $sql =  "SELECT 
						  VEHICULO_SERVICIO.VEH_CODIGO,
						  VEHICULO.VEH_PATENTE,
						  VEHICULO_SERVICIO.KM_INICIAL,
						  VEHICULO_SERVICIO.KM_FINAL,
						  VEHICULO.TVEH_CODIGO,
  						  TIPO_VEHICULO.TVEH_DESCRIPCION,
						  FUNCIONARIO_SERVICIO.FUN_CODIGO,
						  GRADO.GRA_DESCRIPCION,
						  FUNCIONARIO.FUN_APELLIDOPATERNO,
						  FUNCIONARIO.FUN_APELLIDOMATERNO,
						  FUNCIONARIO.FUN_NOMBRE,
						  CUADRANTE_SERVICIO.CUADRANTE_CODIGO,
						  CUADRANTE.CUA_DESCRIPCION
						FROM
						  FUNCIONARIO_SERVICIO
						  INNER JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
						  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO) 
						  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO) AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
						  LEFT OUTER JOIN VEHICULO_SERVICIO ON (FUNCIONARIO_VEHICULO.VEH_UNI_CODIGO = VEHICULO_SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_VEHICULO.VEH_CORRELATIVO_SERVICIO = VEHICULO_SERVICIO.CORRELATIVO_SERVICIO) AND (FUNCIONARIO_VEHICULO.VEH_CODIGO = VEHICULO_SERVICIO.VEH_CODIGO)
						  LEFT OUTER JOIN VEHICULO ON (VEHICULO_SERVICIO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
						  INNER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)
						  INNER JOIN CUADRANTE_SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = CUADRANTE_SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = CUADRANTE_SERVICIO.CORRELATIVO_SERVICIO) AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = CUADRANTE_SERVICIO.FUN_CODIGO)
						  INNER JOIN UNIDAD_CUADRANTE ON (CUADRANTE_SERVICIO.CUADRANTE_CODIGO = UNIDAD_CUADRANTE.CUADRANTE_CODIGO)
						  INNER JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
						WHERE
						FUNCIONARIO_SERVICIO.UNI_CODIGO = ".$unidad." AND 
						FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = ". $correlativo . "
						ORDER BY
						  VEHICULO.VEH_CODIGO,
						  FUNCIONARIO_SERVICIO.FUN_CODIGO,
						  UNIDAD_CUADRANTE.CUADRANTE_CODIGO";
		
			$sql =  "SELECT DISTINCT
						  VEHICULO_SERVICIO.VEH_CODIGO,
						  VEHICULO.VEH_PATENTE,
						  VEHICULO_SERVICIO.KM_INICIAL,
						  VEHICULO_SERVICIO.KM_FINAL,
						  VEHICULO.TVEH_CODIGO,
  						TIPO_VEHICULO.TVEH_DESCRIPCION,
  					  
              CABALLO.CAB_CODIGO,
              CABALLO.CAB_NOMBRE,
						  TIPO_ANIMAL.TANIM_CODIGO, 
						  TIPO_ANIMAL.TANIM_DESCRIPCION,
						  

						  
						  FUNCIONARIO_SERVICIO.FUN_CODIGO,
						  GRADO.GRA_DESCRIPCION,
						  FUNCIONARIO.FUN_APELLIDOPATERNO,
						  FUNCIONARIO.FUN_APELLIDOMATERNO,
						  FUNCIONARIO.FUN_NOMBRE,
						  FUNCIONARIO_SERVICIO.NUMERO_MEDIO,
						  FUNCIONARIO_SERVICIO.FACT_CODIGO,
						  FACTORES.FACT_DESCRIPCION
						FROM
						 	FUNCIONARIO_SERVICIO
						  INNER JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
						  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO) 
              LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO) AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
              LEFT OUTER JOIN VEHICULO_SERVICIO ON (FUNCIONARIO_VEHICULO.VEH_UNI_CODIGO = VEHICULO_SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_VEHICULO.VEH_CORRELATIVO_SERVICIO = VEHICULO_SERVICIO.CORRELATIVO_SERVICIO) AND (FUNCIONARIO_VEHICULO.VEH_CODIGO = VEHICULO_SERVICIO.VEH_CODIGO)
              LEFT OUTER JOIN VEHICULO ON (VEHICULO_SERVICIO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
              LEFT OUTER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)
              LEFT OUTER JOIN FUNCIONARIO_ANIMAL ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_ANIMAL.FUN_UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_ANIMAL.FUN_CORRELATIVO_SERVICIO) AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_ANIMAL.FUN_CODIGO)
              LEFT OUTER JOIN ANIMALES_SERVICIO ON (FUNCIONARIO_ANIMAL.ANIM_UNI_CODIGO = ANIMALES_SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_ANIMAL.ANIM_CORRELATIVO_SERVICIO = ANIMALES_SERVICIO.CORRELATIVO_SERVICIO) AND (FUNCIONARIO_ANIMAL.ANIM_CODIGO = ANIMALES_SERVICIO.ANIM_CODIGO)

              LEFT OUTER JOIN CABALLO ON (ANIMALES_SERVICIO.ANIM_CODIGO = CABALLO.CAB_CODIGO)

              LEFT OUTER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
              LEFT OUTER JOIN FACTORES ON (FUNCIONARIO_SERVICIO.FACT_CODIGO = FACTORES.FACT_CODIGO)
						WHERE
						FUNCIONARIO_SERVICIO.UNI_CODIGO = ".$unidad." AND 
						FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = ". $correlativo . "
						ORDER BY
						  FUNCIONARIO_SERVICIO.NUMERO_MEDIO,
						  VEHICULO.VEH_CODIGO, CABALLO.CAB_CODIGO,
						  FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE";
		
			//echo $sql;
			
			$cont=0;
			$i=0;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$numeroMedioPaso = 0;
			
			$numeroDeRegistros = mysql_num_rows($result);
			if ($numeroDeRegistros >0){
				while($myrow = mysql_fetch_array($result)){
					//echo $numeroMedioPaso . " == " .$myrow["NUMERO_MEDIO"] . " --- ";
					if ($numeroMedioPaso != $myrow["NUMERO_MEDIO"]){
						//echo "cont " . $cont . " ------ ";
						if ($cont>0) {
							$mediosVigilancia[$i] = $medioVigilancia;
							$i++;
						}
						$numeroMedioPaso = $myrow["NUMERO_MEDIO"];
						$medioVigilancia = new medioVigilancia;
					}
					
					
					
					
					$caballo = new caballo;
				  $caballo->setCodigoCaballo($myrow["CAB_CODIGO"]);
				  $caballo->setNombreCaballo(STRTOUPPER($myrow["CAB_NOMBRE"]));
				  


				  
				  $tipo = new tipoAnimal;
				  $tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
				  $tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));
					
					$factorDemanda = new factor;
					$factorDemanda->setCodigo($myrow["FACT_CODIGO"]);
					$factorDemanda->setDescripcion($myrow["FACT_DESCRIPCION"]);
					
					$tipoVehiculo = new tipoVehiculo;
					$tipoVehiculo->setCodigo($myrow["TVEH_CODIGO"]);
					$tipoVehiculo->setDescripcion($myrow["TVEH_DESCRIPCION"]);
					
					$vehiculo = new vehiculo;
					$vehiculo->setCodigoVehiculo($myrow["VEH_CODIGO"]);
					$vehiculo->setPatente($myrow["VEH_PATENTE"]);
					$vehiculo->setTipoVehiculo($tipoVehiculo);
					
					$grado = new grado;
					$grado->setDescripcion($myrow["GRA_DESCRIPCION"]);
					
					$funcionario = new funcionario;
					$funcionario->setCodigoFuncionario($myrow["FUN_CODIGO"]);
					$funcionario->setApellidoPaterno($myrow["FUN_APELLIDOPATERNO"]);
					$funcionario->setApellidoMaterno($myrow["FUN_APELLIDOMATERNO"]);
					$funcionario->setPNombre($myrow["FUN_NOMBRE"]);
					$funcionario->setGrado($grado);
            	
					$medioVigilancia->setVehiculo($vehiculo);
					$medioVigilancia->setFuncionarios($funcionario);
					$medioVigilancia->setKmInicial($myrow["KM_INICIAL"]);
					$medioVigilancia->setKmFinal($myrow["KM_FINAL"]);
					$medioVigilancia->setFactor($factorDemanda);
					$medioVigilancia->setNumeroMedio($numeroMedioPaso);
					$medioVigilancia->setAnimal($caballo);
					$medioVigilancia->setTipoAnimal($tipo);

					
					
					$cont++;
				}
				
				$mediosVigilancia[$i] = $medioVigilancia;
			}
	}

	
	function buscaVehiculosAsignados($unidad, $servicio, $fecha, $vehiculosAsignados){
			         
         $sql= "SELECT 
         		`log_real`.`Log_Numero`,
       			`log_real`.`Log_KmInicial`,
       			`log_real`.`Log_KmFinal`,
       			`log_real`.`Log_TotalKm`,
       			`log_real`.`Log_Combustible`,
       			`vehiculo`.`Veh_Id`,
       			`vehiculo`.`Veh_Nro_Patente`,
       			`tipo_vehiculo`.`Tip_Descripcion`,
       			`logisticos`.`Log_Descripcion`
				FROM `logisticos`
   				RIGHT OUTER JOIN `log_real` ON (`logisticos`.`Log_Id` = `log_real`.`Log_Id`)
   				INNER JOIN `vehiculo` ON (`log_real`.`Log_Numero` = `vehiculo`.`Veh_Id`)
   				LEFT OUTER JOIN `tipo_vehiculo` ON (`vehiculo`.`Tipo_VehiculoTip_Id` = `tipo_vehiculo`.`Tip_Id`)
                WHERE ((`log_real`.`Un_Codigo` ='".$unidad."') and  (`log_real`.`Serv_Id` = " . $servicio . ") and 
                      (`log_real`.`GS_Fecha` = '" . $fecha . "') and (`logisticos`.`Log_Descripcion` is Null)) 
                ORDER BY `log_real`.`log_id`";
         
         //echo $sql;
         
         $cont=0;
		 $i=0;
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 while($myrow = mysql_fetch_array($result) ){
		 	$tipo = new tipoVehiculo;
			$tipo->setCodigo(STRTOUPPER($myrow["Tipo_VehiculoTip_Id"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["Tip_Descripcion"]));
			
			//$procedencia = new procedenciaVehiculo;
			//$procedencia->setCodigo(STRTOUPPER($myrow["Procedencia_VehiculoPro_Codigo"]));
			//$procedencia->setDescripcion(STRTOUPPER($myrow["pro_descripcion"]));
			//
			//$marca = new marcaVehiculo;
			//$marca->setCodigo(STRTOUPPER($myrow["marca_vehiculoMar_Codigo"]));
			//$marca->setDescripcion(STRTOUPPER($myrow["Mar_Descripcion"]));
			//
			//$modelo = new modeloVehiculo;
			//$modelo->setMarca($marca);
			//$modelo->setCodigo(STRTOUPPER($myrow["modelo_vehiculoMod_Codigo"]));
			//$modelo->setDescripcion(STRTOUPPER($myrow["Mod_Descripcion"]));
			//
			//$estado = new estadoVehiculo;
			//$estado->setCodigo(STRTOUPPER($myrow["Estado_VehiculoEst_Codigo"]));
			//$estado->setDescripcion(STRTOUPPER($myrow["Est_Descripcion"]));
			
			$vehiculo = new vehiculo;
			$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["Veh_Id"]));
			$vehiculo->setTipoVehiculo($tipo);
			//$vehiculo->setModeloVehiculo($modelo);
			//$vehiculo->setEstadoVehiculo($estado);
			$vehiculo->setPatente(STRTOUPPER($myrow["Veh_Nro_Patente"]));
			//$vehiculo->setNumeroInstitucional(STRTOUPPER($myrow["Veh_Nro_Institucional"]));
			//$vehiculo->setProcedencia($procedencia);
			
			$vehiculoAsignado = new vehiculoAsignado;
			$vehiculoAsignado->setVehiculo($vehiculo);
			$vehiculoAsignado->setKmInicial($myrow["Log_KmInicial"]);  
			$vehiculoAsignado->setKmFinal($myrow["Log_KmFinal"]);
			$vehiculoAsignado->setTotalKms($myrow["Log_TotalKm"]);    
			$vehiculoAsignado->setLtsCombustible($myrow["Log_Combustible"]);  
			
			$vehiculosAsignados[$i] = $vehiculoAsignado;					
			$i++;
		 }
     }


	 function buscaHojaDeRuta($unidad, $correlativo, $tieneHojaRuta){
		
		$sql = "SELECT * FROM HOJA_RUTA
				WHERE
				  HOJA_RUTA.UNI_CODIGO = ".$unidad." AND 
				  HOJA_RUTA.CORRELATIVO_SERVICIO = ".$correlativo;
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$tieneHojaRuta = 0;
		while($myrow = mysql_fetch_array($result)){
			$tieneHojaRuta = 1;
		}
	 }

	function ultimoCorrelativo($unidad){
		
		$sql = "SELECT MAX(CORRELATIVO_SERVICIO) AS ULTIMO FROM SERVICIO WHERE UNI_CODIGO =". $unidad;
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$myrow = mysql_fetch_array($result); 
		return $myrow["ULTIMO"];
	}
	
	
	function insertFuncionariosServicio($servicio){
		
		$sql = "INSERT INTO FUNCIONARIO_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, NUMERO_MEDIO, FACT_CODIGO) VALUES ";
		
		$existe = 0;	
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$factor = $servicio->getMedioDeVigilancia($i)->getFactor();
			if ($factor == 0) $factor = "Null";
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($k=0; $k<$cantidadPersonal; $k++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($k)->getCodigoFuncionario();
				$numeroMedio = ($i+1);
				$sql .= "(".$servicio->getUnidad()->getCodigoUnidad().",".$servicio->getCorrelativo().",'".$codigoFuncionario."',".$numeroMedio.",".$factor."),";
				$existe = 1;
			}
		}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}
	
	function insertVehiculosServicio($servicio){
		
		$sql = "INSERT INTO VEHICULO_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, VEH_CODIGO, KM_INICIAL, KM_FINAL) VALUES ";
		
		$existe = 0;	
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$codigoVehiculo = $servicio->getMedioDeVigilancia($i)->getVehiculo();
			if ($codigoVehiculo != 0) {
				$sql .= "(".$servicio->getUnidad()->getCodigoUnidad().",".$servicio->getCorrelativo().",".$codigoVehiculo.",".$servicio->getMedioDeVigilancia($i)->getKmInicial().",".$servicio->getMedioDeVigilancia($i)->getKmFinal()."),";
				$existe = 1;
			}
		}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}
	
		function insertAnimalServicio($servicio){
		
		$sql = "INSERT INTO ANIMALES_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, ANIM_CODIGO, TANIM_CODIGO) VALUES ";
		
		$tipo=0;
		$existe = 0;	
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$codigoAnimal = $servicio->getMedioDeVigilancia($i)->getAnimal();
			if ($codigoAnimal != 0) {
				$sql .= "(".$servicio->getUnidad()->getCodigoUnidad().",".$servicio->getCorrelativo().",".$codigoAnimal.",".$tipo."),";
				$existe = 1;
			}
		}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}
	
	function insertArmasServicio($servicio){
		
		$sql = "INSERT INTO ARMA_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, ARM_CODIGO) VALUES ";

		$existe = 0;			
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$cantidadArmas = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadArmas();
				for ($k=0; $k<$cantidadArmas; $k++){
					$codigoArma = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getArmas($k)->getCodigo();
					$codigoArma = substr($codigoArma, 1, strlen($codigoArma));
					$sql .= "(".$servicio->getUnidad()->getCodigoUnidad().",".$servicio->getCorrelativo().",'".$codigoFuncionario."',".$codigoArma."),";
					$existe = 1;
				}
			}
		}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}
	
	
	function insertAnimalesServicio($servicio){
		
		$sql = "INSERT INTO ANIMAL_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, TANIM_CODIGO) VALUES ";
		
		$existe = 0;		
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$cantidadAnimales = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadAnimales();
				for ($k=0; $k<$cantidadAnimales; $k++){
					$codigoAnimal = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getAnimales($k)->getCodigo();
					$codigoAnimal = substr($codigoAnimal, 1, strlen($codigoAnimal));
					$sql .= "(".$servicio->getUnidad()->getCodigoUnidad().",".$servicio->getCorrelativo().",'".$codigoFuncionario."',".$codigoAnimal."),";
					$existe = 1;
					
				}
			}
		}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}
	
	
	function insertAccesoriosServicio($servicio){
		
		$sql = "INSERT INTO ACCESORIO_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, TACC_CODIGO) VALUES ";
		
		$existe = 0;	
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$cantidadAccesorios = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadAccesorios();
				for ($k=0; $k<$cantidadAccesorios; $k++){
					$codigoAccesorio = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getAccesorios($k)->getCodigo();
					$codigoAccesorio = substr($codigoAccesorio, 1, strlen($codigoAccesorio));
					$sql .= "(".$servicio->getUnidad()->getCodigoUnidad().",".$servicio->getCorrelativo().",'".$codigoFuncionario."',".$codigoAccesorio."),";
					$existe = 1;
					//echo $sql ."\n\n";
				}
				
			}
		
		}
			//echo $sql ."\n\n";
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}
	
	
	function insertCuadrantesServicio($servicio){
		
		$sql = "INSERT INTO CUADRANTE_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, CUADRANTE_CODIGO) VALUES ";
		
		$existe = 0;	
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$cantidadCuadrantes = $servicio->getMedioDeVigilancia($i)->getCantidadDeCuadrantes();
				for ($k=0; $k<$cantidadCuadrantes; $k++){
					$codigoCuadrante = $servicio->getMedioDeVigilancia($i)->getCuadrantes($k)->getCodigo();
					//if ($codigoCuadrante != 0) {
						$sql .= "(".$servicio->getUnidad()->getCodigoUnidad().",".$servicio->getCorrelativo().",'".$codigoFuncionario."',".$codigoCuadrante."),";
					//}
					$existe = 1;
				}
			}
		}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}
	
	
	function insertFuncionarioVehiculo($servicio){
		
		$sql = "INSERT INTO FUNCIONARIO_VEHICULO (FUN_UNI_CODIGO, FUN_CORRELATIVO_SERVICIO, FUN_CODIGO, VEH_UNI_CODIGO, VEH_CORRELATIVO_SERVICIO, VEH_CODIGO) VALUES ";

		$existe = 0;			
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$codigoVehiculo    = $servicio->getMedioDeVigilancia($i)->getVehiculo();
				$unidad			   = $servicio->getUnidad()->getCodigoUnidad();
				$correlativo	   = $servicio->getCorrelativo();
				if ($codigoVehiculo != 0) {
					$sql .= "(".$unidad.",".$correlativo.",'".$codigoFuncionario."',".$unidad.",".$correlativo.",".$codigoVehiculo."),";
					$existe = 1;
				}
			}
		}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}
	
	function insertFuncionarioAnimal($servicio){
		
		$sql = "INSERT INTO FUNCIONARIO_ANIMAL (FUN_UNI_CODIGO, FUN_CORRELATIVO_SERVICIO, FUN_CODIGO, ANIM_UNI_CODIGO, ANIM_CORRELATIVO_SERVICIO, ANIM_CODIGO) VALUES ";

		$existe = 0;			
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$codigoAnimal    = $servicio->getMedioDeVigilancia($i)->getAnimal();
				$unidad			   = $servicio->getUnidad()->getCodigoUnidad();
				$correlativo	   = $servicio->getCorrelativo();
				if ($codigoAnimal != 0) {
					$sql .= "(".$unidad.",".$correlativo.",'".$codigoFuncionario."',".$unidad.",".$correlativo.",".$codigoAnimal."),";
					$existe = 1;
				}
			}
		}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}	
	
		//function insertSimccarServicio($servicio){
		
		//$sql = "INSERT INTO SIMCCAR_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, SIM_CODIGO) VALUES ";
		
		//$existe = 0;	
		//$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		//for ($i=0; $i<$cantidadMedios; $i++){
		//	$codigoVehiculo = $servicio->getMedioDeVigilancia($i)->getSimccars();
		//	if ($codigoVehiculo != 0) {
		//		$sql .= "(".$servicio->getUnidad()->getCodigoUnidad().",".$servicio->getCorrelativo().",".$codigoVehiculo."),";
		//		$existe = 1;
		//	}
		//}
		
	//	if ($existe == 1){
	//		$sql = substr($sql, 0, strlen($sql)-1);
	//		//echo $sql ."\n\n";
	//		$result = $this->execstmt($this->Conecta(),$sql);
	//		mysql_close();
	//		return $result;
	//	}
	//}
	
	function insertSimccarServicio($servicio){
		
		$sql = "INSERT INTO SIMCCAR_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, SIM_CODIGO, FUN_CODIGO) VALUES ";

		$existe = 0;			
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$cantidadArmas = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadSimccars();
				for ($k=0; $k<$cantidadArmas; $k++){
					$codigoArma = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getSimccars($k)->getCodigoSimccar();
					$codigoArma = substr($codigoArma, 1, strlen($codigoArma));
					$sql .= "(".$servicio->getUnidad()->getCodigoUnidad().",".$servicio->getCorrelativo().",".$codigoArma.",'".$codigoFuncionario."'),";
					$existe = 1;
				}
			}
		}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}
	
	function insertFuncionarioSimccar($servicio){
		
		$sql = "INSERT INTO FUNCIONARIO_SIMCCAR (FUN_UNI_CODIGO, FUN_CORRELATIVO_SERVICIO, FUN_CODIGO, SIM_UNI_CODIGO, SIM_CORRELATIVO_SERVICIO, SIM_CODIGO) VALUES ";

		$existe = 0;			
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$codigoVehiculo    = $servicio->getMedioDeVigilancia($i)->getSimccars();
				$unidad			   = $servicio->getUnidad()->getCodigoUnidad();
				$correlativo	   = $servicio->getCorrelativo();
				if ($codigoVehiculo != 0) {
					$sql .= "(".$unidad.",".$correlativo.",'".$codigoFuncionario."',".$unidad.",".$correlativo.",".$codigoVehiculo."),";
					$existe = 1;
				}
			}
		}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
	}

	function insertNuevoServicio($servicio){
		
		$sql = "INSERT INTO SERVICIO (UNI_CODIGO, TSERV_CODIGO, TEXT_CODIGO, FECHA, HORA_INICIO, HORA_TERMINO,
				DESCRIPCION_OTRO_EXTRAORDINARIO, DESCRIPCION_SERVICIO) 
				VALUES (".$servicio->getUnidad()->getCodigoUnidad().",".$servicio->getTipoServicio()->getCodigo().",
				".$servicio->getServicioExtraordinario()->getCodigo().",'".$servicio->getFecha()."',
				'".$servicio->getHoraInicio()."','".$servicio->getHoraTermino()."','".$servicio->getDescripcionServicioOtroExtraordinario()."',
				'".$servicio->getObservaciones()."')";
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		if ($result == 1){
			$ultimoCorrelativo = $this->ultimoCorrelativo($servicio->getUnidad()->getCodigoUnidad());
			$servicio->setCorrelativo($ultimoCorrelativo);
			
			$resultInsertFuncionariosAsignados 	= $this->insertFuncionariosServicio($servicio);
			$resultInsertVehiculosAsignados 	= $this->insertVehiculosServicio($servicio);
			$resultInsertFuncionarioVehiculo	= $this->insertFuncionarioVehiculo($servicio);
			$resultInsertAnimalAsignado 	= $this->insertAnimalServicio($servicio);
			$resultInsertFuncionarioAnimal	= $this->insertFuncionarioAnimal($servicio);
			$resultInsertSimccarAsignados 	= $this->insertSimccarServicio($servicio);
			//$resultInsertFuncionarioSimccar	= $this->insertFuncionarioSimccar($servicio);
			$resultInsertArmasAsignadas			= $this->insertArmasServicio($servicio);
			$resultInsertAnimalesAsignados		= $this->insertAnimalesServicio($servicio);
			$resultInsertAccesoriosAsignados	= $this->insertAccesoriosServicio($servicio);
			$resultInsertCuadrantesAsignados	= $this->insertCuadrantesServicio($servicio);

			
			//echo $resultInsertAccesoriosAsignados;
		}
			//echo $resultInsertAccesoriosAsignados;
			
		return $result;
		
						
		//echo $sql . "\n\n";
		//$result = $this->execstmt($this->Conecta(),$sql);
		//return $result;		
		
		//echo "CANTIDAD DE MEDIOS : " . $servicio->getCantidadDeMediosDeVigilancia() . "\n";
		//for ($i=0; $i<$servicio->getCantidadDeMediosDeVigilancia();$i++) {
		//	echo "MEDIO DE VIGILANCIA NUMERO " . ($i+1) . " :\n";
		//	echo "VEHICULO " . $servicio->getMedioDeVigilancia($i)->getVehiculo() . "\n";
		//	echo "KM_INICIAL " . $servicio->getMedioDeVigilancia($i)->getKmInicial() . "\n";
		//	echo "KM_FINAL " . $servicio->getMedioDeVigilancia($i)->getKmFinal() . "\n";
		//	
		//	for ($j=0; $j<$servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios(); $j++){
		//		echo $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario() . "\n";
		//		
		//		echo "ARMAS : " . $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadArmas() . "\n";
		//		for ($k=0; $k<$servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadArmas(); $k++){
		//			echo "  " .$servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getArmas($k)->getCodigo();
		//		}
		//		echo "\n";
		//		
		//		echo "ANIMALES : " . $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadAnimales() . "\n";
		//		for ($k=0; $k<$servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadAnimales(); $k++){
		//			echo "  " .$servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getAnimales($k)->getCodigo();
		//		}
		//		echo "\n";
		//		
		//		echo "ACCESORIOS : " . $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadAccesorios() . "\n";
		//		for ($k=0; $k<$servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadAccesorios(); $k++){
		//			echo "  " .$servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getAccesorios($k)->getCodigo();
		//		}
		//		echo "\n";
		//	}
		//	echo "CUADRANTES :\n";
		//	
		//	for ($j=0; $j<$servicio->getMedioDeVigilancia($i)->getCantidadDeCuadrantes(); $j++) echo " " . $servicio->getMedioDeVigilancia($i)->getCuadrantes($j)->getCodigo();
		//	echo "\n\n";
		//} 
	}
	
	
	function updateServicio($servicio){
		
		$sql = "UPDATE SERVICIO SET 
				TSERV_CODIGO = ".$servicio->getTipoServicio()->getCodigo().",
				TEXT_CODIGO = ".$servicio->getServicioExtraordinario()->getCodigo().",
				FECHA = '".$servicio->getFecha()."',
				HORA_INICIO = '".$servicio->getHoraInicio()."',
				HORA_TERMINO = '".$servicio->getHoraTermino()."',
				DESCRIPCION_OTRO_EXTRAORDINARIO ='".$servicio->getDescripcionServicioOtroExtraordinario()."',
				DESCRIPCION_SERVICIO ='".$servicio->getObservaciones()."'
				WHERE UNI_CODIGO = ".$servicio->getUnidad()->getCodigoUnidad()." AND CORRELATIVO_SERVICIO = ".$servicio->getCorrelativo();
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$result = 1;
		if ($result == 1){
			$resultBorrarFuncionarioVehiculo		= $this->borrarFuncionarioVehiculo($servicio);
			$resultBorrarFuncionarioAnimal		 = $this->borrarFuncionarioAnimal($servicio);
			$resultBorrarCuadrantesAsignados		= $this->borrarCuadrantesServicio($servicio);
			$resultBorrarAccesoriosAsignados		= $this->borrarAccesoriosServicio($servicio);

			$resultBorrarAnimalesAsignados			= $this->borrarAnimalServicio($servicio);
			$resultBorrarArmasAsignadas				= $this->borrarArmasServicio($servicio);
			$resultBorrarSimccarAsignadas		= $this->borrarSimccarServicio($servicio);
			
			$resultBorrarAnimalesAsignados2			= $this->borrarAnimalesServicio($servicio);
			$resultBorrarVehiculosAsignados			= $this->borrarVehiculosServicio($servicio);
			$resultBorrarFuncionariosAsignados		= $this->borrarFuncionariosServicio($servicio);
			
	    if ($resultBorrarFuncionariosAsignados == 1) $resultInsertFuncionariosAsignados	= $this->insertFuncionariosServicio($servicio);
			if ($resultBorrarVehiculosAsignados == 1)	 $resultInsertVehiculosAsignados 	= $this->insertVehiculosServicio($servicio);
			if ($resultBorrarAnimalesAsignados2 == 1) $resultInsertAnimalAsignado 	= $this->insertAnimalServicio($servicio);
			if ($resultBorrarArmasAsignadas == 1)		 $resultInsertArmasAsignadas		= $this->insertArmasServicio($servicio);
			
			if ($resultBorrarSimccarAsignadas == 1)		$resultInsertSimccarAsignados 	= $this->insertSimccarServicio($servicio);
			
			if ($resultBorrarAnimalesAsignados == 1)	 $resultInsertAnimalesAsignados		= $this->insertAnimalesServicio($servicio);
			if ($resultBorrarAccesoriosAsignados == 1)   $resultInsertAccesoriosAsignados	= $this->insertAccesoriosServicio($servicio);
			if ($resultBorrarCuadrantesAsignados == 1)   $resultInsertCuadrantesAsignados	= $this->insertCuadrantesServicio($servicio);
			if(	$resultBorrarFuncionarioAnimal ==1)      $resultInsertFuncionarioAnimal	= $this->insertFuncionarioAnimal($servicio);
			if ($resultBorrarFuncionarioVehiculo == 1)	 $resultInsertFuncionarioVehiculo	= $this->insertFuncionarioVehiculo($servicio);
		}
		
		return $result;
	}
	
	function borrarFuncionarioVehiculo($servicio){
		
		$sql = "DELETE FROM FUNCIONARIO_VEHICULO 
				WHERE FUN_UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND FUN_CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql); 
	  	mysql_close();
	  	return $result;   
	}
	
		function borrarFuncionarioSimccar($servicio){
		
		$sql = "DELETE FROM FUNCIONARIO_SIMCCAR
				WHERE FUN_UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND FUN_CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql); 
	  	mysql_close();
	  	return $result;   
	}
	
		function borrarFuncionarioAnimal($servicio){
		
		$sql = "DELETE FROM FUNCIONARIO_ANIMAL
				WHERE FUN_UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND FUN_CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql); 
	  	mysql_close();
	  	return $result;   
	}
	
	function borrarCuadrantesServicio($servicio){
		
		$sql = "DELETE FROM CUADRANTE_SERVICIO 
				WHERE UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql);   
	  	mysql_close();
	  	return $result; 
	}
	
	
	function borrarAccesoriosServicio($servicio){
		
		$sql = "DELETE FROM ACCESORIO_SERVICIO
				WHERE UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql);    
	  	mysql_close();
	  	return $result;
	}

	
	function borrarAnimalServicio($servicio){
		
		$sql = "DELETE FROM ANIMAL_SERVICIO
				WHERE UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql);   
	  	mysql_close(); 
	  	return $result;
	}


	function borrarArmasServicio($servicio){
		
		$sql = "DELETE FROM ARMA_SERVICIO
				WHERE UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql);  
	  	mysql_close();  
	  	return $result;
	}
	
		function borrarAnimalesServicio($servicio){
		
		$sql = "DELETE FROM ANIMALES_SERVICIO
				WHERE UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql); 
	  	mysql_close();   
	  	return $result;
	}
	
	function borrarVehiculosServicio($servicio){
		
		$sql = "DELETE FROM VEHICULO_SERVICIO
				WHERE UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql); 
	  	mysql_close();   
	  	return $result;
	}
	
	function borrarSimccarServicio($servicio){
		
		$sql = "DELETE FROM SIMCCAR_SERVICIO
				WHERE UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql); 
	  	mysql_close();   
	  	return $result;
	}
	
	function borrarFuncionariosServicio($servicio){
		
		$sql = "DELETE FROM FUNCIONARIO_SERVICIO
				WHERE UNI_CODIGO =".$servicio->getUnidad()->getCodigoUnidad()." AND CORRELATIVO_SERVICIO = ". $servicio->getCorrelativo();
				
		//echo $sql . "\n\n";                                
	  	$result = $this->execstmt($this->Conecta(),$sql);    
	  	mysql_close();
	  	return $result;
	}
	
	
	function deleteServicio($servicio){
		
		$resultBorrarFuncionarioVehiculo		= $this->borrarFuncionarioVehiculo($servicio);
		$resultBorrarFuncionarioAnimal		= $this->borrarFuncionarioAnimal($servicio);
		$resultBorrarCuadrantesAsignados		= $this->borrarCuadrantesServicio($servicio);
		$resultBorrarAccesoriosAsignados		= $this->borrarAccesoriosServicio($servicio);
		$resultBorrarAnimalesAsignados			= $this->borrarAnimalesServicio($servicio);
		$resultBorrarArmasAsignadas				= $this->borrarArmasServicio($servicio);
		$resultBorrarAnimalAsignado			= $this->borrarAnimalServicio($servicio);
		$resultBorrarSimccarServicio		= $this->borrarSimccarServicio($servicio);
		//$resultBorrarSimccarAsignados		= $this->borrarFuncionarioSimccar($servicio);
		$resultBorrarVehiculosAsignados			= $this->borrarVehiculosServicio($servicio);
		$resultBorrarFuncionariosAsignados		= $this->borrarFuncionariosServicio($servicio);
		
		$sql = "DELETE FROM SERVICIO 
				WHERE UNI_CODIGO = ".$servicio->getUnidad()->getCodigoUnidad()." AND CORRELATIVO_SERVICIO = ".$servicio->getCorrelativo();
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	

	function listaServiciosPorFuncionarioFinal($funcionario, $fecha1, $fecha2, $codServicio, $servicios){	
			
				
			if ($codServicio != 0) $filtroServicio = " AND SERVICIO.TSERV_CODIGO IN (" . $codServicio . ")";
			
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
					FROM
					  FUNCIONARIO_SERVICIO
					  INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					WHERE
					  FUNCIONARIO_SERVICIO.FUN_CODIGO = '".$funcionario."' AND 
					  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."' ".$filtroServicio." 
					  ORDER BY SERVICIO.FECHA DESC";
								
			//echo $sql;
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion($myrow["TSERV_DESCRIPCION"]);
				
				$tipoServicioExtraordinario = new tipoServicioExtraordinario;
				$tipoServicioExtraordinario->setCodigo($myrow["TEXT_CODIGO"]);
				$tipoServicioExtraordinario->setDescripcion($myrow["TEXT_DESCRIPCION"]);
				
				$servicio = new servicio;
				$servicio->setUnidad($unidad);
				$servicio->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$servicio->setFecha($myrow["FECHA"]);
				$servicio->setTipoServicio($tipoServicio);
				$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
				$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
				$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
								
				$servicios[$i] = $servicio;

				$i++;
			}
		}
		
		function listaServiciosPorFuncionario($funcionario, $fecha1, $fecha2, $codServicio, $servicios){	
			
				
			if ($codServicio != 0) $filtroServicio = " AND SERVICIO.TSERV_CODIGO IN (" . $codServicio . ")";
			
			if($fecha2 == "30000101"){
				$condicion = "";
			}else{
				$condicion = "NOT";
				}
			
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
					FROM
					  FUNCIONARIO_SERVICIO
					  INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					WHERE
					  FUNCIONARIO_SERVICIO.FUN_CODIGO = '".$funcionario."' AND 
					  SERVICIO.FECHA ".$condicion." BETWEEN '".$fecha1."' AND '".$fecha2."' ".$filtroServicio." 
					  ORDER BY SERVICIO.FECHA DESC";
								
			//echo $sql;
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion($myrow["TSERV_DESCRIPCION"]);
				
				$tipoServicioExtraordinario = new tipoServicioExtraordinario;
				$tipoServicioExtraordinario->setCodigo($myrow["TEXT_CODIGO"]);
				$tipoServicioExtraordinario->setDescripcion($myrow["TEXT_DESCRIPCION"]);
				
				$servicio = new servicio;
				$servicio->setUnidad($unidad);
				$servicio->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$servicio->setFecha($myrow["FECHA"]);
				$servicio->setTipoServicio($tipoServicio);
				$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
				$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
				$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
								
				$servicios[$i] = $servicio;

				$i++;
			}
		}
		
		function listaServiciosPorFuncionario2($funcionario, $fecha1, $fecha2, $codServicio, $servicios){	
			
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
					FROM
					  FUNCIONARIO_SERVICIO
					  INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					WHERE
					  FUNCIONARIO_SERVICIO.FUN_CODIGO = '".$funcionario."' AND 
					  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."'
					  ORDER BY SERVICIO.FECHA DESC";
								
			//echo $sql;
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion($myrow["TSERV_DESCRIPCION"]);
				
				$tipoServicioExtraordinario = new tipoServicioExtraordinario;
				$tipoServicioExtraordinario->setCodigo($myrow["TEXT_CODIGO"]);
				$tipoServicioExtraordinario->setDescripcion($myrow["TEXT_DESCRIPCION"]);
				
				$servicio = new servicio;
				$servicio->setUnidad($unidad);
				$servicio->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$servicio->setFecha($myrow["FECHA"]);
				$servicio->setTipoServicio($tipoServicio);
				$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
				$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
				$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
								
				$servicios[$i] = $servicio;

				$i++;
			}
		}		
		
		function listaServiciosPorVehiculo($vehiculo, $fecha1, $fecha2, $codServicio, $servicios){	

			//echo "hchg " . $codServicio;
							
			if ($codServicio != 0) $filtroServicio = " AND SERVICIO.TSERV_CODIGO = " . $codServicio;
			
			$sql = "SELECT 
					  SERVICIO.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  SERVICIO.CORRELATIVO_SERVICIO,
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  SERVICIO.TEXT_CODIGO,
					  TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION,
					  SERVICIO.FECHA,
					  VEHICULO_SERVICIO.KM_INICIAL,
					  VEHICULO_SERVICIO.KM_FINAL
					FROM
					  SERVICIO
					  INNER JOIN VEHICULO_SERVICIO ON (SERVICIO.UNI_CODIGO = VEHICULO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = VEHICULO_SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					WHERE
					  VEHICULO_SERVICIO.VEH_CODIGO = " .$vehiculo. " AND 
					  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."' ".$filtroServicio." 
					  ORDER BY SERVICIO.FECHA DESC";
								
			//echo $sql;
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion($myrow["TSERV_DESCRIPCION"]);
				
				$tipoServicioExtraordinario = new tipoServicioExtraordinario;
				$tipoServicioExtraordinario->setCodigo($myrow["TEXT_CODIGO"]);
				$tipoServicioExtraordinario->setDescripcion($myrow["TEXT_DESCRIPCION"]);
				
				$medioVigilancia = new medioVigilancia;
				$medioVigilancia->setKmInicial($myrow["KM_INICIAL"]);
				$medioVigilancia->setKmFinal($myrow["KM_FINAL"]);
				
				$servicio = new servicio;
				$servicio->setUnidad($unidad);
				$servicio->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$servicio->setFecha($myrow["FECHA"]);
				$servicio->setTipoServicio($tipoServicio);
				$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
				$servicio->setMedioDeVigilancia($medioVigilancia);
								
				$servicios[$i] = $servicio;

				$i++;
			}
		}
		
		function listaServiciosPorAnimales($vehiculo, $fecha1, $fecha2, $codServicio, $servicios){	

			//echo "hchg " . $codServicio;
							
			if ($codServicio != 0) $filtroServicio = " AND SERVICIO.TSERV_CODIGO = " . $codServicio;
			
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
					FROM
					  SERVICIO
					  INNER JOIN ANIMALES_SERVICIO ON (SERVICIO.UNI_CODIGO = ANIMALES_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = ANIMALES_SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					WHERE
					  ANIMALES_SERVICIO.ANIM_CODIGO = " .$vehiculo. " AND 
					  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."' ".$filtroServicio." 
					  ORDER BY SERVICIO.FECHA DESC";
								
			//echo $sql;
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion($myrow["TSERV_DESCRIPCION"]);
				
				$tipoServicioExtraordinario = new tipoServicioExtraordinario;
				$tipoServicioExtraordinario->setCodigo($myrow["TEXT_CODIGO"]);
				$tipoServicioExtraordinario->setDescripcion($myrow["TEXT_DESCRIPCION"]);
				
				
				$servicio = new servicio;
				$servicio->setUnidad($unidad);
				$servicio->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$servicio->setFecha($myrow["FECHA"]);
				$servicio->setTipoServicio($tipoServicio);
				$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
				$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
				$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
								
				$servicios[$i] = $servicio;

				$i++;
			}
		}
		
		function listaServiciosPorSimccar($vehiculo, $fecha1, $fecha2, $codServicio, $servicios){	

			//echo "hchg " . $codServicio;
							
			if ($codServicio != 0) $filtroServicio = " AND SERVICIO.TSERV_CODIGO = " . $codServicio;
			
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
					FROM
					  SERVICIO
					  INNER JOIN SIMCCAR_SERVICIO ON (SERVICIO.UNI_CODIGO = SIMCCAR_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					WHERE
					  SIMCCAR_SERVICIO.SIM_CODIGO = " .$vehiculo. " AND 
					  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."' ".$filtroServicio." 
					  ORDER BY SERVICIO.FECHA DESC";
								
			//echo $sql;
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion($myrow["TSERV_DESCRIPCION"]);
				
				$tipoServicioExtraordinario = new tipoServicioExtraordinario;
				$tipoServicioExtraordinario->setCodigo($myrow["TEXT_CODIGO"]);
				$tipoServicioExtraordinario->setDescripcion($myrow["TEXT_DESCRIPCION"]);
				
				
				$servicio = new servicio;
				$servicio->setUnidad($unidad);
				$servicio->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$servicio->setFecha($myrow["FECHA"]);
				$servicio->setTipoServicio($tipoServicio);
				$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
				$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
				$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
								
				$servicios[$i] = $servicio;

				$i++;
			}
		}
				
		
		function listaServiciosAcumulado_ultimo($unidad, $tipoUnidad, $tipoServicio, $fecha1, $inicio, $serviciosIngresados){	
			
			
			//echo "unidad " 		 . $unidad . "\n";
			//echo "tipoUnidad " 	 . $tipoUnidad . "\n";
			//echo "tipoServicio " . $tipoServicio . "\n";
			//echo "fecha1 " 		 . $fecha1 . "\n";
			//echo "inicio " 		 . $inicio . "\n";
			
			if ($tipoServicio != ""){
				$filtro = " AND SERVICIO.TSERV_CODIGO = ". $tipoServicio;
			}
			
			if ($tipoUnidad == "nacional"){
				$unidadAgregada = "";
				$unidadFiltro   = "";     
			}
			
			if ($tipoUnidad == "zona"){
				$unidadAgregada = "UNIDAD3.UNI_CODIGO, UNIDAD3.UNI_DESCRIPCION,";
				//$unidadFiltro   = "WHERE (UNIDAD3.UNI_CODIGO = ".$unidad.")";
				if ($inicio == "0") $unidadFiltro = "WHERE (UNIDAD3.UNI_CODIGO = ".$unidad.")";
				if ($inicio == "1") $unidadFiltro = "";
			}   
			
			if ($tipoUnidad == "prefectura"){
				$unidadAgregada = "UNIDAD2.UNI_CODIGO, UNIDAD2.UNI_DESCRIPCION,";
				if ($inicio == "0") $unidadFiltro = "WHERE (UNIDAD2.UNI_CODIGO = ".$unidad.")";        
				if ($inicio == "1") $unidadFiltro = "WHERE (UNIDAD3.UNI_CODIGO = ".$unidad.")";      
			}
			
			if ($tipoUnidad == "comisaria"){
				$unidadAgregada = "UNIDAD1.UNI_CODIGO, UNIDAD1.UNI_DESCRIPCION,";
				if ($inicio == "0") $unidadFiltro   = "WHERE (UNIDAD1.UNI_CODIGO = ".$unidad.")";      
				if ($inicio == "1") $unidadFiltro   = "WHERE (UNIDAD2.UNI_CODIGO = ".$unidad.")";      
			}
			
			if ($tipoUnidad == "destacamento"){
				$unidadAgregada = "UNIDAD.UNI_CODIGO, UNIDAD.UNI_DESCRIPCION,";
				if ($inicio == "0") $unidadFiltro   = "WHERE (UNIDAD.UNI_CODIGO = ".$unidad.")";      
				if ($inicio == "1") $unidadFiltro   = "WHERE (UNIDAD1.UNI_CODIGO = ".$unidad.")";      
				$correlativo = "SERVICIO.CORRELATIVO_SERVICIO,";
			}
											
			$sql = "SELECT 
					  ".$unidadAgregada.$correlativo."
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  SERVICIO.FECHA,
					  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM
					  SERVICIO
					  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					  INNER JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)       
					  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)       
					".$unidadFiltro.$filtro."
					GROUP BY
					  ".$unidadAgregada.$correlativo."   
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  SERVICIO.FECHA
					HAVING
					  SERVICIO.FECHA = '".$fecha1."' ORDER BY UNI_DESCRIPCION, TIPO_SERVICIO.TSERV_ORDEN";
														
			//echo $sql;
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
				
				$serviciosUnidad = new serviciosUnidad;
				$serviciosUnidad->setUnidad($unidad);
				$serviciosUnidad->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$serviciosUnidad->setFecha($myrow["FECHA"]);
				$serviciosUnidad->setTipoServicio($tipoServicio);
				$serviciosUnidad->setCantidadFuncionarios($myrow["CANT_PERSONAL"]);
				$serviciosUnidad->setCantidadVehiculos($myrow["CANT_VEHICULOS"]);
								
				$serviciosIngresados[$i] = $serviciosUnidad;

				$i++;
			}
		}
		
		
		function listaServiciosAcumulado_OLD($unidad, $tipoUnidad, $tipoServicio, $fecha1, $serviciosIngresados){	
			
			if ($tipoServicio != ""){
				//$unidadDesagregada = "SERVICIO.UNI_CODIGO, UNIDAD.UNI_DESCRIPCION,";
				$filtro = " AND SERVICIO.TSERV_CODIGO = ". $tipoServicio;
				
				//if ($tipoUnidad == "comisaria"){
				//	$unidadDesagregada = "";
				//	$filtro = " AND SERVICIO.TSERV_CODIGO = ". $tipoServicio;
				//}
			}
			
			if ($tipoUnidad == "prefectura"){
				$subconsulta = "SELECT 
								  UNIDAD.UNI_CODIGO
								FROM
								  UNIDAD
								  LEFT OUTER JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
								  LEFT OUTER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
								WHERE UNIDAD2.UNI_CODIGO = ".$unidad."
								UNION
								SELECT 
								  UNIDAD1.UNI_CODIGO
								FROM
								  UNIDAD
								  LEFT OUTER JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
								  LEFT OUTER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
								WHERE UNIDAD2.UNI_CODIGO = ".$unidad;
			}
			
			
			if ($tipoUnidad == "destacamento" or $tipoUnidad == "comisaria"){
				$subconsulta = "SELECT 
								  UNIDAD.UNI_CODIGO
								FROM
								  UNIDAD
								  LEFT OUTER JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
								WHERE UNIDAD1.UNI_CODIGO = ".$unidad."
								UNION
								SELECT ".$unidad." FROM UNIDAD";
				
				//if ($tipoUnidad == "comisaria") $unidadDesagregada = "UNIDAD1.UNI_CODIGO, UNIDAD1.UNI_DESCRIPCION,";
			}
			
			
			
			
			if ($tipoUnidad == "zona"){
				$subconsulta = "SELECT 
								  UNIDAD.UNI_CODIGO
								FROM
								  UNIDAD UNIDAD1
								  LEFT OUTER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
								  LEFT OUTER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
								  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
								WHERE
								  UNIDAD3.UNI_CODIGO =  ".$unidad."
								UNION
								SELECT 
								  UNIDAD1.UNI_CODIGO
								FROM
								  UNIDAD UNIDAD1
								  LEFT OUTER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
								  LEFT OUTER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
								  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
								WHERE
								  UNIDAD3.UNI_CODIGO =  ".$unidad;
			}
									
			$sql = "SELECT 
					  ".$unidadDesagregada."
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  SERVICIO.FECHA,
					  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM
					  SERVICIO
					  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					  INNER JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)       
					WHERE
					  (SERVICIO.UNI_CODIGO IN (".$subconsulta."))".$filtro."
					GROUP BY
					  ".$unidadDesagregada."
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  SERVICIO.FECHA
					HAVING
					  SERVICIO.FECHA = '".$fecha1."' ORDER BY SERVICIO.UNI_CODIGO, TIPO_SERVICIO.TSERV_ORDEN";
														
			//echo $sql;
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
				
				$serviciosUnidad = new serviciosUnidad;
				$serviciosUnidad->setUnidad($unidad);
				$serviciosUnidad->setFecha($myrow["FECHA"]);
				$serviciosUnidad->setTipoServicio($tipoServicio);
				$serviciosUnidad->setCantidadFuncionarios($myrow["CANT_PERSONAL"]);
				$serviciosUnidad->setCantidadVehiculos($myrow["CANT_VEHICULOS"]);
								
				$serviciosIngresados[$i] = $serviciosUnidad;

				$i++;
			}
		}	
		
		
		function listaServiciosAcumulado($unidad, $tipoUnidad, $tipoServicio, $fecha1, $inicio, $serviciosIngresados){	
			
			//echo "unidad " 		 . $unidad . "\n";
			//echo "tipoUnidad " 	 . $tipoUnidad . "\n";
			//echo "tipoServicio " 	 . $tipoServicio . "\n";
			//echo "fecha1 " 		 . $fecha1 . "\n";
			//echo "inicio " 		 . $inicio . "\n";
		
			//// CONSULTA POR SERVICIO NIVEL NACIONAL
			
			//$sql = "SELECT
			//		  UNIDAD3.UNI_CODIGO,
			//		  UNIDAD3.UNI_DESCRIPCION,
			//		  SERVICIO.TSERV_CODIGO,
			//		  TIPO_SERVICIO.TSERV_DESCRIPCION,
			//		  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
			//		  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
			//		FROM
			//		  UNIDAD UNIDAD1
			//		  INNER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
			//		  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
			//		  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
			//		  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
			//		  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
			//		  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
			//		  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
			//		  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
			//		  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
			//		  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
			//		WHERE
			//		  (UNIDAD.UNI_PADRE = ".$unidad." OR 
			//		  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad.")))) AND 
			//		  SERVICIO.FECHA = '".$fecha1."'
			//		GROUP BY
			//		  UNIDAD3.UNI_CODIGO,
			//		  UNIDAD3.UNI_DESCRIPCION,
			//		  SERVICIO.TSERV_CODIGO,
			//		  TIPO_SERVICIO.TSERV_DESCRIPCION";
			
			if ($tipoUnidad	== "nacional" && $inicio == 0){
		  		$sql = "SELECT 
						  UNIDAD4.UNI_CODIGO,
						  UNIDAD4.UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
						  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
						FROM
						  UNIDAD UNIDAD1
						  INNER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
						  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
						  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
						  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
						  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
						  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
						  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
						  INNER JOIN UNIDAD UNIDAD4 ON (UNIDAD3.UNI_PADRE = UNIDAD4.UNI_CODIGO)
						  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
						WHERE
						  (UNIDAD.UNI_PADRE = ".$unidad." OR 
						  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR 
						  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR 
						  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." )))) AND 
						  SERVICIO.FECHA = '".$fecha1."'
						GROUP BY
						  UNIDAD4.UNI_CODIGO,
						  UNIDAD4.UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION";					  
						  
						  
				$sql = "SELECT
						  20 AS UNI_CODIGO,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
						  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
						FROM
						  UNIDAD 
						  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
						  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
						  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
						  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
						  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
						WHERE
						  (UNIDAD.UNI_PADRE = ".$unidad." OR 
						  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR 
						  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR 
						  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." )))) AND 
						  SERVICIO.FECHA = '".$fecha1."'
						GROUP BY
						  UNI_CODIGO,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION";					  						  
			}
			
			if (($tipoUnidad == "zona" || $tipoUnidad == "prefectura") && $inicio == 0){
		  		
		  		// CONSULTA POR SERVICIO POR ZONA O POR PREFECTURA
            
				$sql = "SELECT 
					  IF (UNIDAD3.UNI_CODIGO=".$unidad.",UNIDAD3.UNI_CODIGO, UNIDAD2.UNI_CODIGO) AS UNI_CODIGO,
					  IF (UNIDAD3.UNI_CODIGO=".$unidad.",UNIDAD3.UNI_DESCRIPCION, UNIDAD2.UNI_DESCRIPCION) AS UNI_DESCRIPCION, 
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM
					  UNIDAD UNIDAD1
					  INNER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
					  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					WHERE
					  (UNIDAD.UNI_PADRE = ".$unidad." OR 
					  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad.")))) AND 
					  SERVICIO.FECHA = '".$fecha1."'
					GROUP BY
					  UNI_CODIGO,
					  UNI_DESCRIPCION,
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION";				  
			}
			
			if ($tipoUnidad == "comisaria" && $inicio == 0){
			
				// CONSULTA POR COMISARIA
	            
				$sql = "SELECT 
						  IF (UNIDAD2.UNI_CODIGO=".$unidad.",UNIDAD2.UNI_CODIGO, UNIDAD1.UNI_CODIGO) AS UNI_CODIGO,
						  IF (UNIDAD2.UNI_CODIGO=".$unidad.",UNIDAD2.UNI_DESCRIPCION, UNIDAD1.UNI_DESCRIPCION) AS UNI_DESCRIPCION, 
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
						  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
						FROM
						  UNIDAD UNIDAD1
						  INNER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
						  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
						  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
						  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
						  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
						  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
						  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
						  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
						WHERE
						  (UNIDAD.UNI_PADRE = ".$unidad." OR 
						  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad.")))) AND 
						  SERVICIO.FECHA = '".$fecha1."'
						GROUP BY
						  UNI_CODIGO,
						  UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION";
			}
			
			if ($tipoUnidad== "zona" && $inicio == 1){
				
				$sql= "SELECT 
						  IF (UNIDAD3.UNI_CODIGO=".$unidad.",UNIDAD2.UNI_CODIGO, UNIDAD3.UNI_CODIGO) AS UNI_CODIGO,          
						  IF (UNIDAD3.UNI_CODIGO=".$unidad.",UNIDAD2.UNI_DESCRIPCION, UNIDAD3.UNI_DESCRIPCION) AS UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
						  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
						FROM
						  UNIDAD UNIDAD1
						  INNER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
						  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
						  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
						  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
						  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
						  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
						  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
						  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
						WHERE
						  (UNIDAD.UNI_PADRE = ".$unidad." OR 
						  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad.")))) AND 
						  SERVICIO.FECHA = '".$fecha1."' AND SERVICIO.TSERV_CODIGO = ".$tipoServicio."
						GROUP BY
						  UNI_CODIGO,
						  UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION";
						  
			}
			
			if ($tipoUnidad== "prefectura" && $inicio == 1){
				
				$sql= "SELECT 
						  IF (UNIDAD2.UNI_CODIGO=".$unidad.",UNIDAD1.UNI_CODIGO, UNIDAD2.UNI_CODIGO) AS UNI_CODIGO,          
						  IF (UNIDAD2.UNI_CODIGO=".$unidad.",UNIDAD1.UNI_DESCRIPCION, UNIDAD2.UNI_DESCRIPCION) AS UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
						  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
						FROM
						  UNIDAD UNIDAD1
						  INNER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
						  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
						  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
						  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
						  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
						  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
						  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
						  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
						WHERE
						  (UNIDAD.UNI_PADRE = ".$unidad." OR 
						  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad.")))) AND 
						  SERVICIO.FECHA = '".$fecha1."' AND SERVICIO.TSERV_CODIGO = ".$tipoServicio."
						GROUP BY
						  UNI_CODIGO,
						  UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION";
						  
			}	
			
			if ($tipoUnidad== "comisaria" && $inicio == 1){
				
				$sql= "SELECT 
						  IF (UNIDAD1.UNI_CODIGO=".$unidad.",UNIDAD.UNI_CODIGO, UNIDAD1.UNI_CODIGO) AS UNI_CODIGO,          
						  IF (UNIDAD1.UNI_CODIGO=".$unidad.",UNIDAD.UNI_DESCRIPCION, UNIDAD1.UNI_DESCRIPCION) AS UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
						  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
						FROM
						  UNIDAD UNIDAD1
						  INNER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
						  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
						  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
						  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
						  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
						  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
						  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
						  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
						WHERE
						  (UNIDAD.UNI_PADRE = ".$unidad." OR 
						  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad." OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = ".$unidad.")))) AND 
						  SERVICIO.FECHA = '".$fecha1."' AND SERVICIO.TSERV_CODIGO = ".$tipoServicio."
						GROUP BY
						  UNI_CODIGO,
						  UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION ORDER BY UNI_DESCRIPCION";
			}				

			if ($tipoUnidad == "destacamento" && $inicio == 1){
				
				$sql= "SELECT 
						  UNIDAD.UNI_CODIGO,          
						  UNIDAD.UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  SERVICIO.CORRELATIVO_SERVICIO,
						  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
						  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
						FROM
						  UNIDAD UNIDAD1
						  INNER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
						  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
						  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
						  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
						  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
						  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
						  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
						  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
						WHERE
						  UNIDAD.UNI_PADRE = ".$unidad." AND SERVICIO.FECHA = '".$fecha1."' AND SERVICIO.TSERV_CODIGO = ".$tipoServicio."
						GROUP BY
						  UNIDAD.UNI_CODIGO,          
						  UNIDAD.UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  SERVICIO.CORRELATIVO_SERVICIO ORDER BY UNIDAD.UNI_DESCRIPCION";
			}
			
			
			if ($tipoUnidad == "sinHijo" && $inicio == 1){
				
				$sql= "SELECT 
						  UNIDAD.UNI_CODIGO,          
						  UNIDAD.UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  SERVICIO.CORRELATIVO_SERVICIO,
						  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
						  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
						FROM
						  UNIDAD UNIDAD1
						  INNER JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
						  INNER JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
						  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
						  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
						  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
						  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
						  INNER JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
						  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
						WHERE
						  UNIDAD.UNI_CODIGO = ".$unidad." AND SERVICIO.FECHA = '".$fecha1."' AND SERVICIO.TSERV_CODIGO = ".$tipoServicio."
						GROUP BY
						  UNIDAD.UNI_CODIGO,          
						  UNIDAD.UNI_DESCRIPCION,
						  SERVICIO.TSERV_CODIGO,
						  TIPO_SERVICIO.TSERV_DESCRIPCION,
						  SERVICIO.CORRELATIVO_SERVICIO";
				
			}

			
			
            
            
			
			////CONSULTA POR DESTACAMENTO		  
			//		  
			//$sql = "SELECT 
			//		  UNIDAD.UNI_CODIGO,
			//		  UNIDAD.UNI_DESCRIPCION,
			//		  SERVICIO.TSERV_CODIGO,
			//		  TIPO_SERVICIO.TSERV_DESCRIPCION,
			//		  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
			//		  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
			//		FROM
			//		  UNIDAD 
			//		  INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
			//		  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
			//		  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
			//		  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
			//		  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
			//		  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
			//		  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
			//		WHERE
			//		  SERVICIO.UNI_CODIGO = ".$unidad." AND  SERVICIO.FECHA = '".$fecha1."'
			//		GROUP BY
			//		  UNIDAD.UNI_CODIGO,
			//		  UNIDAD.UNI_DESCRIPCION,
			//		  SERVICIO.TSERV_CODIGO,
			//		  TIPO_SERVICIO.TSERV_DESCRIPCION";					  

														
			//echo $sql;
			
			
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
				
				$serviciosUnidad = new serviciosUnidad;
				$serviciosUnidad->setUnidad($unidad);
				$serviciosUnidad->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$serviciosUnidad->setFecha($myrow["FECHA"]);
				$serviciosUnidad->setTipoServicio($tipoServicio);
				$serviciosUnidad->setCantidadFuncionarios($myrow["CANT_PERSONAL"]);
				$serviciosUnidad->setCantidadVehiculos($myrow["CANT_VEHICULOS"]);
								
				$serviciosIngresados[$i] = $serviciosUnidad;

				$i++;
			}
		}
		
		
		
		function listaServiciosAcumuladoNuevo($unidad, $tipoUnidad, $tipoUnidadPadre, $tipoServicio, $fecha1, $inicio, $serviciosIngresados){	
			
			//echo "unidad " 		 . $unidad . "\n";
			//echo "tipoUnidad " 	 . $tipoUnidad . "\n";
			//echo "tipoServicio " 	 . $tipoServicio . "\n";
			//echo "fecha1 " 		 . $fecha1 . "\n";
			//echo "inicio " 		 . $inicio . "\n";
		
		
			$filtroServicio = "";
			if ($tipoServicio != "") $filtroServicio =  "AND SERVICIO.TSERV_CODIGO = " . $tipoServicio;
		
			if ($tipoUnidad != "destacamento"){
			
			$sql = "SELECT 
					  VISTA_UNIDADES_3.".$tipoUnidadPadre."_CODIGO AS UNI_CODIGO_PADRE,
					  VISTA_UNIDADES_3.".$tipoUnidad."_CODIGO AS UNI_CODIGO,
					  VISTA_UNIDADES_3.".$tipoUnidad."_DESCRIPCION AS UNI_DESCRIPCION,
					  SERVICIO.TSERV_CODIGO AS TSERV_CODIGO,
					  UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS TSERV_DESCRIPCION,
					  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM
					  SERVICIO
					  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  INNER JOIN VISTA_UNIDADES_3 ON (SERVICIO.UNI_CODIGO = VISTA_UNIDADES_3.DESTACAMENTO_CODIGO)
					  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					WHERE
					  SERVICIO.FECHA = '".$fecha1."'
					GROUP BY
					  VISTA_UNIDADES_3.".$tipoUnidadPadre."_CODIGO,
					  VISTA_UNIDADES_3.".$tipoUnidad."_CODIGO,
					  VISTA_UNIDADES_3.".$tipoUnidad."_DESCRIPCION,
					  SERVICIO.TSERV_CODIGO,
					  UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION)
					HAVING UNI_CODIGO_PADRE = ".$unidad." ".$filtroServicio."
					ORDER BY TIPO_SERVICIO.TSERV_DESCRIPCION";
			
		} else {
				
				$sql = "SELECT 
					  VISTA_UNIDADES_4.".$tipoUnidadPadre."_CODIGO AS UNI_CODIGO_PADRE ,
					  VISTA_UNIDADES_4.".$tipoUnidad."_CODIGO AS UNI_CODIGO ,
					  VISTA_UNIDADES_4.".$tipoUnidad."_DESCRIPCION AS UNI_DESCRIPCION,
					  SERVICIO.TSERV_CODIGO AS TSERV_CODIGO,
					  UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS TSERV_DESCRIPCION,
					  SERVICIO.CORRELATIVO_SERVICIO CORRELATIVO_SERVICIO,
					  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM
					  SERVICIO
					  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  INNER JOIN VISTA_UNIDADES_4 ON (SERVICIO.UNI_CODIGO = VISTA_UNIDADES_4.DESTACAMENTO_CODIGO)
					  LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					WHERE
					  SERVICIO.FECHA = '".$fecha1."'
					GROUP BY
					  VISTA_UNIDADES_4.".$tipoUnidadPadre."_CODIGO,
					  VISTA_UNIDADES_4.".$tipoUnidad."_CODIGO,
					  VISTA_UNIDADES_4.".$tipoUnidad."_DESCRIPCION,
					  SERVICIO.TSERV_CODIGO,
					  UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION),
					  SERVICIO.CORRELATIVO_SERVICIO
					HAVING UNI_CODIGO_PADRE = ".$unidad." ".$filtroServicio."
					ORDER BY TIPO_SERVICIO.TSERV_DESCRIPCION";
		
		
		}
			
														
			//echo $sql;
			
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
				
				$serviciosUnidad = new serviciosUnidad;
				$serviciosUnidad->setUnidad($unidad);
				$serviciosUnidad->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$serviciosUnidad->setFecha($myrow["FECHA"]);
				$serviciosUnidad->setTipoServicio($tipoServicio);
				$serviciosUnidad->setCantidadFuncionarios($myrow["CANT_PERSONAL"]);
				$serviciosUnidad->setCantidadVehiculos($myrow["CANT_VEHICULOS"]);
								
				$serviciosIngresados[$i] = $serviciosUnidad;

				$i++;
			}
		}
		
		
		
		
		
		
		
		
		function listaServiciosUnidadCantidades($unidad, $fecha1, $fecha2, $tipoServicios, $servicios){	
			
			$sql = "SELECT 
SERVICIO.UNI_CODIGO,
SERVICIO.CORRELATIVO_SERVICIO,
UNIDAD.UNI_DESCRIPCION,
SERVICIO.TSERV_CODIGO,
TIPO_SERVICIO.TSERV_DESCRIPCION,
TIPO_SERVICIO.TSERV_TIPO,
SERVICIO.TEXT_CODIGO,
TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION,
SERVICIO.FECHA,
SERVICIO.HORA_INICIO,
SERVICIO.HORA_TERMINO,
COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS

FROM
SERVICIO
INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
LEFT OUTER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
WHERE
UNIDAD.UNI_CODIGO = ". $unidad . " AND SERVICIO.FECHA = '".$fecha1."'
GROUP BY
UNIDAD.UNI_CODIGO,          
UNIDAD.UNI_DESCRIPCION,
SERVICIO.TSERV_CODIGO,
TIPO_SERVICIO.TSERV_DESCRIPCION,
SERVICIO.CORRELATIVO_SERVICIO
ORDER BY SERVICIO.FECHA DESC, TIPO_SERVICIO.TSERV_DESCRIPCION ASC";
								
			//echo $sql;
			
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			
			while($myrow = mysql_fetch_array($result) ){
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$tipoServicio = new tipoServicio;
				$tipoServicio->setCodigo($myrow["TSERV_CODIGO"]);
				$tipoServicio->setDescripcion($myrow["TSERV_DESCRIPCION"]);
				$tipoServicio->setTipo($myrow["TSERV_TIPO"]);
				
				$tipoServicioExtraordinario = new tipoServicioExtraordinario;
				$tipoServicioExtraordinario->setCodigo($myrow["TEXT_CODIGO"]);
				$tipoServicioExtraordinario->setDescripcion($myrow["TEXT_DESCRIPCION"]);
				
				$servicio = new servicio;
				$servicio->setUnidad($unidad);
				$servicio->setCorrelativo($myrow["CORRELATIVO_SERVICIO"]);
				$servicio->setFecha($myrow["FECHA"]);
				$servicio->setTipoServicio($tipoServicio);
				$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
				$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
				$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
				$servicio->setCantidadFuncionarios($myrow["CANT_PERSONAL"]);
				$servicio->setCantidadVehiculos($myrow["CANT_VEHICULOS"]);
								
				$servicios[$i] = $servicio;

				$i++;
			}
		}		
		

		function buscaFechaValidacion($unidadServicios, $fechaServicios, &$fechaValidacion){
			
			$sql = "SELECT 
					  SERVICIOS_CERTIFICADO.FECHA_CERTIFICADO
					FROM
					  SERVICIOS_CERTIFICADO
					WHERE
					  SERVICIOS_CERTIFICADO.UNI_CODIGO = ".$unidadServicios." AND 
					  SERVICIOS_CERTIFICADO.FECHA_SERVICIOS = '".$fechaServicios."'";
			
			
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			
			while($myrow = mysql_fetch_array($result) ){
				$fechaValidacion = $myrow["FECHA_CERTIFICADO"];
			}
		}
		
		
		function buscaTiposDeServiciosPorFuncionario($unidadServicio, $fecha1, $fecha2, $tipoServicio, $codigoFuncionario, $cantidadColaciones, $cantidadOtrosServicios, $codigoServicio, $grupo){	
			
				
			$sql = "SELECT 
					  TIPO_SERVICIO.TSERV_GRUPO,
					  COUNT(*)
					FROM
					  SERVICIO
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					WHERE
					  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
					  FUNCIONARIO_SERVICIO.FUN_CODIGO = '".$funcionario."'
					GROUP BY
					  TIPO_SERVICIO.TSERV_GRUPO
					HAVING
					  TIPO_SERVICIO.TSERV_GRUPO = '".$tipoServicio."'";
			
			
			$sql = "SELECT 
					  FUNCIONARIO_SERVICIO.FUN_CODIGO,
					  SUM(IF(TIPO_SERVICIO.TSERV_GRUPO = 'COLACION', 1, 0)) AS COLACIONES,
					  SUM(IF(TIPO_SERVICIO.TSERV_GRUPO <> 'COLACION', 1, 0)) AS OTROS_SERVICIOS,
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_GRUPO
					  
					FROM
					  SERVICIO
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					WHERE
					  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
					  SERVICIO.UNI_CODIGO = ".$unidadServicio." AND
					  TIPO_SERVICIO.TSERV_GRUPO <> 'SIN SERVICIO'
					GROUP BY
					   FUNCIONARIO_SERVICIO.FUN_CODIGO
					ORDER BY
						FUNCIONARIO_SERVICIO.FUN_CODIGO";
								
			//echo $sql;
			
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				$codigoFuncionario[] 		= $myrow[0];
				$cantidadColaciones[] 	= $myrow[1];
				$cantidadOtrosServicios[] = $myrow[2];
				$codigoServicio[]         = $myrow[3];
				$grupo[]                  = $myrow[4];
			}
		}
		
		function buscaServicioJefaturaSupervicionPorFuncionario($unidadServicio, $fecha1, $fecha2, $codigoFuncionario, $cantidadSupervisiones){	
			
			
			$sql = "SELECT                                       
					  FUNCIONARIO_SERVICIO.FUN_CODIGO,           
					  COUNT(*)                                  
					FROM                                         
					  FUNCIONARIO_SERVICIO                       
					  INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					WHERE                                        
					  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
					  SERVICIO.UNI_CODIGO = ".$unidadServicio." AND
					  SERVICIO.TSERV_CODIGO = 607                
					GROUP BY                                     
					   FUNCIONARIO_SERVICIO.FUN_CODIGO           
					ORDER BY                                     
						FUNCIONARIO_SERVICIO.FUN_CODIGO";        
								
			//echo $sql;
			
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				$codigoFuncionario[] 		= $myrow[0];
				$cantidadSupervisiones[] 	= $myrow[1];
			}
		}
		
		function buscaColacionPorFuncionario($unidadServicio, $fecha1, $fecha2, $codigoFuncionario, $cantidadColaciones, $codigoServicio){	
				
			$sql = "SELECT 
					  FUNCIONARIO_SERVICIO.FUN_CODIGO,
					  SUM(IF(TIPO_SERVICIO.TSERV_GRUPO = 'COLACION', 1, 0)) AS COLACIONES,
					  SERVICIO.TSERV_CODIGO
					  
					FROM
					  SERVICIO
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					WHERE
					  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
					  SERVICIO.UNI_CODIGO = ".$unidadServicio." AND
					  TIPO_SERVICIO.TSERV_GRUPO = 'COLACION'
					GROUP BY
					   FUNCIONARIO_SERVICIO.FUN_CODIGO
					ORDER BY
						FUNCIONARIO_SERVICIO.FUN_CODIGO";
								
			//echo $sql;
			
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				$codigoFuncionario[] 		= $myrow[0];
				$cantidadColaciones[] 	= $myrow[1];
				$codigoServicio[]       = $myrow[2];
			}
		}
		
}//end class   
?>