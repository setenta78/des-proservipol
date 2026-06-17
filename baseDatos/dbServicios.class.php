<?
Class dbServicios extends Conexion{
	
	function listaServiciosUnidad($unidad, $fecha1, $fecha2, $tipoServicios, $servicios){
		
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
					SERVICIOS_CERTIFICADO.FECHA_SERVICIOS
				FROM SERVICIO
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				LEFT JOIN SERVICIOS_CERTIFICADO ON (SERVICIO.FECHA = SERVICIOS_CERTIFICADO.FECHA_SERVICIOS) AND (SERVICIO.UNI_CODIGO = SERVICIOS_CERTIFICADO.UNI_CODIGO)
				WHERE (SERVICIO.UNI_CODIGO = {$unidad}) AND (SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}') AND TIPO_SERVICIO.TSERV_CODIGO NOT IN (160,161,170,180,633,632,713,162,5005,630,631,867)";
		
		if ($tipoServicios != "") $sql .= " AND (SERVICIO.TSERV_CODIGO IN ({$tipoServicios}))";
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
			$servicio->setFechaValidacion($myrow["FECHA_SERVICIOS"]);
			
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
					SERVICIO.DESCRIPCION_SERVICIO,
					SERVICIO.UNI_CODIGO_DESTINO,
					U2.UNI_DESCRIPCION UNI_CODIGO_DESTINO_DESC
				FROM SERVICIO
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				LEFT JOIN UNIDAD U2 ON (SERVICIO.UNI_CODIGO_DESTINO = U2.UNI_CODIGO)
				WHERE SERVICIO.UNI_CODIGO = {$unidad} AND SERVICIO.CORRELATIVO_SERVICIO = {$correlativo}";
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

		$destino = new unidad;
		$destino->setCodigoUnidad($myrow["UNI_CODIGO_DESTINO"]);
		$destino->setDescripcionUnidad($myrow["UNI_CODIGO_DESTINO_DESC"]);

		$servicio = new servicio;
		$servicio->setUnidad($unidad);
		$servicio->setFecha($myrow["FECHA"]);
		$servicio->setTipoServicio($tipoServicio);
		$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
		$servicio->setDescripcionServicioOtroExtraordinario($myrow["DESCRIPCION_OTRO_EXTRAORDINARIO"]);
		$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
		$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
		$servicio->setObservaciones($myrow["DESCRIPCION_SERVICIO"]);
		$servicio->setDestino($destino);
	}
	
	function buscaFuncionariosAsignados($unidad, $correlativo, $funcionarios){
		
		$sql = "SELECT 
					FUNCIONARIO_SERVICIO.FUN_CODIGO,
					FUNCIONARIO.ESC_CODIGO,
					FUNCIONARIO.GRA_CODIGO,
					GRADO.GRA_DESCRIPCION,
					FUNCIONARIO.FUN_APELLIDOPATERNO,
					FUNCIONARIO.FUN_APELLIDOMATERNO,
					FUNCIONARIO.FUN_NOMBRE
				FROM FUNCIONARIO_SERVICIO
				JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
				JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
				WHERE FUNCIONARIO_SERVICIO.UNI_CODIGO = {$unidad} AND FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = {$correlativo} 
				ORDER BY FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO";
		
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
					CUADRANTE.CUA_DESCRIPCION,
					UNIDAD.UNI_DESCRIPCION
				FROM CUADRANTE_SERVICIO
				JOIN FUNCIONARIO_SERVICIO ON (CUADRANTE_SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) 
					AND (CUADRANTE_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO) 
					AND (CUADRANTE_SERVICIO.FUN_CODIGO = FUNCIONARIO_SERVICIO.FUN_CODIGO)
				JOIN UNIDAD_CUADRANTE ON (CUADRANTE_SERVICIO.CUADRANTE_CODIGO = UNIDAD_CUADRANTE.CUADRANTE_CODIGO)
				JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
				JOIN UNIDAD ON (UNIDAD_CUADRANTE.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE FUNCIONARIO_SERVICIO.UNI_CODIGO = {$unidad} AND FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = {$correlativo}
				ORDER BY FUNCIONARIO_SERVICIO.NUMERO_MEDIO, UNIDAD_CUADRANTE.CUADRANTE_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$cuadrante = new cuadrante;
			$cuadrante->setCodigo($myrow["CUADRANTE_CODIGO"]);
			$cuadrante->setDescripcion($myrow["CUA_DESCRIPCION"]);
			$cuadrante->setDescUni($myrow["UNI_DESCRIPCION"]);
			$puntero = $myrow["NUMERO_MEDIO"] - 1;
			$mediosVigilancia[$puntero]->setCuadrantes($cuadrante);
		}
	}
	
	function buscadestinosAsignados($unidad, $correlativo, $mediosVigilancia){
		
		$sql = "SELECT DISTINCT 
					FUNCIONARIO_SERVICIO.NUMERO_MEDIO,
					UNIDAD_SERVICIO.UNIDAD_SERVICIO,
					UNIDAD.UNI_DESCRIPCION
				FROM UNIDAD_SERVICIO
				JOIN FUNCIONARIO_SERVICIO ON (UNIDAD_SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					AND (UNIDAD_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					AND (UNIDAD_SERVICIO.FUN_CODIGO = FUNCIONARIO_SERVICIO.FUN_CODIGO)
				JOIN UNIDAD ON (UNIDAD_SERVICIO.UNIDAD_SERVICIO = UNIDAD.UNI_CODIGO)
				WHERE UNIDAD_SERVICIO.UNI_CODIGO = {$unidad} AND FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = {$correlativo}
				ORDER BY FUNCIONARIO_SERVICIO.NUMERO_MEDIO, UNIDAD_SERVICIO.UNI_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$destino = new unidad;
			$destino->setCodigoUnidad($myrow["UNIDAD_SERVICIO"]);
			$destino->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
			$puntero = $myrow["NUMERO_MEDIO"] - 1;
			$mediosVigilancia[$puntero]->setUnidades($destino);
		}
	}
	
	function buscaAccesoriosAsignados($unidad, $correlativo, $mediosVigilancia){
		
		$sql = "SELECT 
				  ACCESORIO_SERVICIO.FUN_CODIGO,
				  TIPO_ACCESORIO.TACC_CODIGO,
				  TIPO_ACCESORIO.TACC_DESCRIPCION
				FROM ACCESORIO_SERVICIO
				JOIN TIPO_ACCESORIO ON (ACCESORIO_SERVICIO.TACC_CODIGO = TIPO_ACCESORIO.TACC_CODIGO)
				WHERE ACCESORIO_SERVICIO.UNI_CODIGO = {$unidad} AND ACCESORIO_SERVICIO.CORRELATIVO_SERVICIO = {$correlativo}
				ORDER BY ACCESORIO_SERVICIO.FUN_CODIGO, TIPO_ACCESORIO.ORDEN ASC";
		
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
				FROM ARMA_SERVICIO
				JOIN ARMA ON (ARMA_SERVICIO.ARM_CODIGO = ARMA.ARM_CODIGO)
				JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
				WHERE ARMA_SERVICIO.UNI_CODIGO = {$unidad} AND ARMA_SERVICIO.CORRELATIVO_SERVICIO = {$correlativo}
				ORDER BY ARMA_SERVICIO.FUN_CODIGO, ARMA_SERVICIO.ARM_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$cantidadMediosVigilacia = count($mediosVigilancia);
		while($myrow = mysql_fetch_array($result)){
			for ($i=0;$i<$cantidadMediosVigilacia;$i++){
				$cantidadFuncionarios = $mediosVigilancia[$i]->getCantidadDeFuncionarios();
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
	
	function buscaAnimalesAsignados($unidad, $correlativo, $mediosVigilancia){
		
		$sql = "SELECT 
					ANIMAL_SERVICIO.FUN_CODIGO,
					ANIMAL_SERVICIO.TANIM_CODIGO,
					TIPO_ANIMAL.TANIM_DESCRIPCION
				FROM ANIMAL_SERVICIO
				JOIN TIPO_ANIMAL ON (ANIMAL_SERVICIO.TANIM_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
				WHERE ANIMAL_SERVICIO.UNI_CODIGO = {$unidad} AND ANIMAL_SERVICIO.CORRELATIVO_SERVICIO = {$correlativo}
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
	
	function buscaAnimalAsignado($unidad, $correlativo, $mediosVigilancia){
		
		$sql = "SELECT CABALLO.CAB_CODIGO,
						CABALLO.CAB_NOMBRE,
						FUNCIONARIO_ANIMAL.FUN_CODIGO,
						TIPO_ANIMAL.TANIM_CODIGO,
						TIPO_ANIMAL.TANIM_DESCRIPCION
				FROM FUNCIONARIO_SERVICIO
				JOIN FUNCIONARIO_ANIMAL ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_ANIMAL.FUN_UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_ANIMAL.FUN_CORRELATIVO_SERVICIO) AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_ANIMAL.FUN_CODIGO)
				JOIN ANIMALES_SERVICIO ON (FUNCIONARIO_ANIMAL.ANIM_UNI_CODIGO = ANIMALES_SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_ANIMAL.ANIM_CORRELATIVO_SERVICIO = ANIMALES_SERVICIO.CORRELATIVO_SERVICIO) AND (FUNCIONARIO_ANIMAL.ANIM_CODIGO = ANIMALES_SERVICIO.ANIM_CODIGO)
				JOIN CABALLO ON (ANIMALES_SERVICIO.ANIM_CODIGO = CABALLO.CAB_CODIGO)
				JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
				WHERE FUNCIONARIO_SERVICIO.UNI_CODIGO = {$unidad} AND FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = {$correlativo}";
		
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
						$animal->setCodigo($myrow["TANIM_DESCRIPCION"]);
						$animal->setDescripcion($myrow["CAB_NOMBRE"]);
						$mediosVigilancia[$i]->getFuncionarios($j)->setAnimales($animal);
					}
				}
			}
		}
	}

	function buscaCamarasAsignadas($unidad, $correlativo, $mediosVigilancia){
		
		$sql = "SELECT 
					V.FUN_CODIGO CODFUNCIONARIO,
					V.VC_CODIGO CODCAMARA,
					CONCAT(M.MVC_DESCRIPCION,' ',MO.MODVC_DESCRIPCION) MODELO,
					C.VC_NRO_SERIE NROSERIE
				FROM FUNCIONARIO_VIDEOCAMARA V
				JOIN VIDEOCAMARA C ON C.VC_CODIGO = V.VC_CODIGO
				LEFT JOIN MARCA_VIDEOCAMARA M ON M.MVC_CODIGO = C.MVC_CODIGO
				LEFT JOIN MODELO_VIDEOCAMARA MO ON MO.MVC_CODIGO = C.MVC_CODIGO AND MO.MODVC_CODIGO = C.MODVC_CODIGO
				WHERE V.UNI_CODIGO = {$unidad} AND V.CORRELATIVO_SERVICIO = {$correlativo}
				ORDER BY V.FUN_CODIGO, V.VC_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$cantidadMediosVigilacia = count($mediosVigilancia);
		while($myrow = mysql_fetch_array($result)){
			for ($i=0;$i<$cantidadMediosVigilacia;$i++){
				$cantidadFuncionarios = $mediosVigilancia[$i]->getCantidadDeFuncionarios();
				for ($j=0; $j<$cantidadFuncionarios;$j++){
					$codigoFuncionarioObjeto = $mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario();
					if ($myrow["CODFUNCIONARIO"] == $codigoFuncionarioObjeto){
						$camara = new camara;
						$camara->setCodigo($myrow["CODCAMARA"]);
						$camara->setModelo($myrow["MODELO"]);
						$camara->setNumeroSerie($myrow["NROSERIE"]);
						$mediosVigilancia[$i]->getFuncionarios($j)->setCamaras($camara);
					}
				}
			}
		}
	}

	function buscaMedioVigilancia($unidad, $correlativo, $mediosVigilancia){
		
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
				FROM FUNCIONARIO_SERVICIO
				JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
				JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO) 
				LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO) AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
				LEFT JOIN VEHICULO_SERVICIO ON (FUNCIONARIO_VEHICULO.VEH_UNI_CODIGO = VEHICULO_SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_VEHICULO.VEH_CORRELATIVO_SERVICIO = VEHICULO_SERVICIO.CORRELATIVO_SERVICIO) AND (FUNCIONARIO_VEHICULO.VEH_CODIGO = VEHICULO_SERVICIO.VEH_CODIGO)
				LEFT JOIN VEHICULO ON (VEHICULO_SERVICIO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
				LEFT JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)
				LEFT JOIN FUNCIONARIO_ANIMAL ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_ANIMAL.FUN_UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_ANIMAL.FUN_CORRELATIVO_SERVICIO) AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_ANIMAL.FUN_CODIGO)
				LEFT JOIN ANIMALES_SERVICIO ON (FUNCIONARIO_ANIMAL.ANIM_UNI_CODIGO = ANIMALES_SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_ANIMAL.ANIM_CORRELATIVO_SERVICIO = ANIMALES_SERVICIO.CORRELATIVO_SERVICIO) AND (FUNCIONARIO_ANIMAL.ANIM_CODIGO = ANIMALES_SERVICIO.ANIM_CODIGO)
				LEFT JOIN CABALLO ON (ANIMALES_SERVICIO.ANIM_CODIGO = CABALLO.CAB_CODIGO)
				LEFT JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
				LEFT JOIN FACTORES ON (FUNCIONARIO_SERVICIO.FACT_CODIGO = FACTORES.FACT_CODIGO)
				WHERE FUNCIONARIO_SERVICIO.UNI_CODIGO = {$unidad} AND FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = {$correlativo}
				ORDER BY FUNCIONARIO_SERVICIO.NUMERO_MEDIO, VEHICULO.VEH_CODIGO, CABALLO.CAB_CODIGO, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE";
		
		//echo $sql;
		$cont=0;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$numeroMedioPaso = 0;
		$numeroDeRegistros = mysql_num_rows($result);
		if ($numeroDeRegistros >0){
			while($myrow = mysql_fetch_array($result)){
				if ($numeroMedioPaso != $myrow["NUMERO_MEDIO"]){
					if ($cont>0) {
						$mediosVigilancia[$i] = $medioVigilancia;
						$i++;
					}
					$numeroMedioPaso = $myrow["NUMERO_MEDIO"];
					$medioVigilancia = new medioVigilancia;
				}
				
				$animal = new animal;
				$animal->setCodigoAnimal($myrow["CAB_CODIGO"]);
				$animal->setNombreAnimal(STRTOUPPER($myrow["CAB_NOMBRE"]));
				
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
				$medioVigilancia->setAnimal($animal);
				$medioVigilancia->setTipoAnimal($tipo);
				
				$cont++;
			}
			
			$mediosVigilancia[$i] = $medioVigilancia;
		}
	}
	
	function buscaComisionServicioDia($unidad, $fecha, $funcionariosComision){
		
		$sql =  "SELECT DISTINCT
						FUNCIONARIO_SERVICIO.FUN_CODIGO,
						GRADO.GRA_DESCRIPCION,
						FUNCIONARIO.FUN_APELLIDOPATERNO,
						FUNCIONARIO.FUN_APELLIDOMATERNO,
						FUNCIONARIO.FUN_NOMBRE
				FROM SERVICIO
				JOIN FUNCIONARIO_SERVICIO ON FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO AND FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO
				JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
				JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO) 
				LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO) AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
				WHERE SERVICIO.UNI_CODIGO = {$unidad} AND SERVICIO.FECHA = '{$fecha}' AND SERVICIO.TSERV_CODIGO = 867
				ORDER BY FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE";
		
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$numeroDeRegistros = mysql_num_rows($result);
		if ($numeroDeRegistros >0){
			while($myrow = mysql_fetch_array($result)){

				$grado = new grado;
				$grado->setDescripcion($myrow["GRA_DESCRIPCION"]);
				
				$funcionario = new funcionario;
				$funcionario->setCodigoFuncionario($myrow["FUN_CODIGO"]);
				$funcionario->setApellidoPaterno($myrow["FUN_APELLIDOPATERNO"]);
				$funcionario->setApellidoMaterno($myrow["FUN_APELLIDOMATERNO"]);
				$funcionario->setPNombre($myrow["FUN_NOMBRE"]);
				$funcionario->setGrado($grado);
				
				$funcionariosComision[$i] = $funcionario;
				$i++;
			}
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
          WHERE ((`log_real`.`Un_Codigo` ='{$unidad}') and  (`log_real`.`Serv_Id` = {$servicio}) and 
          (`log_real`.`GS_Fecha` = '{$fecha}') and (`logisticos`.`Log_Descripcion` is Null)) 
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
			
			$vehiculo = new vehiculo;
			$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["Veh_Id"]));
			$vehiculo->setTipoVehiculo($tipo);
			$vehiculo->setPatente(STRTOUPPER($myrow["Veh_Nro_Patente"]));
			
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
		
	function ultimoCorrelativo($unidad){
		
		$sql = "SELECT MAX(CORRELATIVO_SERVICIO) AS ULTIMO FROM SERVICIO WHERE UNI_CODIGO = {$unidad}";
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
				$sql .= "({$servicio->getUnidad()->getCodigoUnidad()},{$servicio->getCorrelativo()},'{$codigoFuncionario}',{$numeroMedio},{$factor}),";
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
				$sql .= "({$servicio->getUnidad()->getCodigoUnidad()},{$servicio->getCorrelativo()},{$codigoVehiculo},{$servicio->getMedioDeVigilancia($i)->getKmInicial()},{$servicio->getMedioDeVigilancia($i)->getKmFinal()}),";
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
				$sql .= "({$servicio->getUnidad()->getCodigoUnidad()},{$servicio->getCorrelativo()},{$codigoAnimal},{$tipo}),";
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
					$sql .= "({$servicio->getUnidad()->getCodigoUnidad()},{$servicio->getCorrelativo()},'{$codigoFuncionario}',{$codigoArma}),";
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
	
	function insertCamarasServicio($servicio){
		
		$sql = "INSERT INTO FUNCIONARIO_VIDEOCAMARA (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, VC_CODIGO) VALUES ";
		$existe = 0;
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$cantidadCamaras = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCantidadCamaras();
				for ($k=0; $k<$cantidadCamaras; $k++){
					$codigoCamara = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCamaras($k)->getCodigo();
					$codigoCamara = substr($codigoCamara, 1, strlen($codigoCamara));
					$sql .= "({$servicio->getUnidad()->getCodigoUnidad()},{$servicio->getCorrelativo()},'{$codigoFuncionario}',{$codigoCamara}),";
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
					$sql .= "({$servicio->getUnidad()->getCodigoUnidad()},{$servicio->getCorrelativo()},'{$codigoFuncionario}',{$codigoAnimal}),";
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
					$sql .= "({$servicio->getUnidad()->getCodigoUnidad()},{$servicio->getCorrelativo()},'{$codigoFuncionario}',{$codigoAccesorio}),";
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
		for($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$cantidadCuadrantes = $servicio->getMedioDeVigilancia($i)->getCantidadDeCuadrantes();
				for($k=0; $k<$cantidadCuadrantes; $k++){
					$codigoCuadrante = $servicio->getMedioDeVigilancia($i)->getCuadrantes($k)->getCodigo();
					//if ($codigoCuadrante != 0) {
						$sql .= "({$servicio->getUnidad()->getCodigoUnidad()},{$servicio->getCorrelativo()},'{$codigoFuncionario}',{$codigoCuadrante}),";
					//}
					$existe = 1;
				}
			}
		}
		
		if($existe == 1){
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
				$codigoFuncionario	= $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$codigoVehiculo		= $servicio->getMedioDeVigilancia($i)->getVehiculo();
				$unidad				= $servicio->getUnidad()->getCodigoUnidad();
				$correlativo		= $servicio->getCorrelativo();
				if ($codigoVehiculo != 0) {
					$sql .= "({$unidad},{$correlativo},'{$codigoFuncionario}',{$unidad},{$correlativo},{$codigoVehiculo}),";
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
				$codigoAnimal	= $servicio->getMedioDeVigilancia($i)->getAnimal();
				$unidad			= $servicio->getUnidad()->getCodigoUnidad();
				$correlativo	= $servicio->getCorrelativo();
				if ($codigoAnimal != 0) {
					$sql .= "({$unidad},{$correlativo},'{$codigoFuncionario}',{$unidad},{$correlativo},{$codigoAnimal}),";
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
	
	function insertUnidadServicio($servicio){
		
		$sql = "INSERT INTO UNIDAD_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, UNIDAD_SERVICIO) VALUES ";
		
		$existe = 0;
		$cantidadMedios = $servicio->getCantidadDeMediosDeVigilancia();
		for ($i=0; $i<$cantidadMedios; $i++){
			$cantidadPersonal = $servicio->getMedioDeVigilancia($i)->getCantidadDeFuncionarios();
			for ($j=0; $j<$cantidadPersonal; $j++){
				$codigoFuncionario = $servicio->getMedioDeVigilancia($i)->getFuncionarios($j)->getCodigoFuncionario();
				$cantidadUnidades = $servicio->getMedioDeVigilancia($i)->getCantidadDeUnidades();
				for ($k=0; $k<$cantidadUnidades; $k++){
					$codigoUnidad = $servicio->getMedioDeVigilancia($i)->getUnidades($k)->getCodigoUnidad();
					//if ($codigoCuadrante != 0) {
						$sql .= "({$servicio->getUnidad()->getCodigoUnidad()},{$servicio->getCorrelativo()},'{$codigoFuncionario}',{$codigoUnidad}),";
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
	
	function insertNuevoServicio($servicio){
		
		$sql = "INSERT INTO SERVICIO (UNI_CODIGO, TSERV_CODIGO, TEXT_CODIGO, FECHA, HORA_INICIO, HORA_TERMINO,
				DESCRIPCION_OTRO_EXTRAORDINARIO, DESCRIPCION_SERVICIO, UNI_CODIGO_DESTINO)
				VALUES ({$servicio->getUnidad()->getCodigoUnidad()},{$servicio->getTipoServicio()->getCodigo()},
				{$servicio->getServicioExtraordinario()->getCodigo()},'{$servicio->getFecha()}',
				'{$servicio->getHoraInicio()}','{$servicio->getHoraTermino()}','{$servicio->getDescripcionServicioOtroExtraordinario()}',
				'{$servicio->getObservaciones()}',{$servicio->getDestino()->getCodigoUnidad()})";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		if ($result == 1){
			$ultimoCorrelativo = $this->ultimoCorrelativo($servicio->getUnidad()->getCodigoUnidad());
			$servicio->setCorrelativo($ultimoCorrelativo);
			
			$resultInsertFuncionariosAsignados	= $this->insertFuncionariosServicio($servicio);
			$resultInsertVehiculosAsignados		= $this->insertVehiculosServicio($servicio);
			$resultInsertFuncionarioVehiculo	= $this->insertFuncionarioVehiculo($servicio);
			$resultInsertAnimalAsignado			= $this->insertAnimalServicio($servicio);
			$resultInsertFuncionarioAnimal		= $this->insertFuncionarioAnimal($servicio);
			
			$resultInsertArmasAsignadas			= $this->insertArmasServicio($servicio);
			$resultInsertAnimalesAsignados		= $this->insertAnimalesServicio($servicio);
			$resultInsertAccesoriosAsignados	= $this->insertAccesoriosServicio($servicio);
			$resultInsertCamarasAsignadas		= $this->insertCamarasServicio($servicio);
			$resultInsertCuadrantesAsignados	= $this->insertCuadrantesServicio($servicio);
			$resultInsertUnidadesAsignadas	    = $this->insertUnidadServicio($servicio);
			//echo $resultInsertAccesoriosAsignados;
		}
		//echo $resultInsertAccesoriosAsignados;
		return $result;
	}
	
	function updateServicio($servicio){
		
		$sql = "UPDATE SERVICIO SET 
				TSERV_CODIGO = {$servicio->getTipoServicio()->getCodigo()},
				TEXT_CODIGO = {$servicio->getServicioExtraordinario()->getCodigo()},
				FECHA = '{$servicio->getFecha()}',
				HORA_INICIO = '{$servicio->getHoraInicio()}',
				HORA_TERMINO = '{$servicio->getHoraTermino()}',
				DESCRIPCION_OTRO_EXTRAORDINARIO ='{$servicio->getDescripcionServicioOtroExtraordinario()}',
				DESCRIPCION_SERVICIO ='{$servicio->getObservaciones()}',
				UNI_CODIGO_DESTINO = {$servicio->getDestino()->getCodigoUnidad()}
				WHERE UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$result = 1;
		if ($result == 1){
			$resultBorrarFuncionarioVehiculo	= $this->borrarFuncionarioVehiculo($servicio);
			$resultBorrarFuncionarioAnimal		= $this->borrarFuncionarioAnimal($servicio);
			$resultBorrarCuadrantesAsignados	= $this->borrarCuadrantesServicio($servicio);
			$resultBorrarAccesoriosAsignados	= $this->borrarAccesoriosServicio($servicio);
			$resultBorrarAnimalesAsignados		= $this->borrarAnimalServicio($servicio);
			$resultBorrarArmasAsignadas			= $this->borrarArmasServicio($servicio);
			$resultBorrarAnimalesAsignados2		= $this->borrarAnimalesServicio($servicio);
			$resultBorrarVehiculosAsignados		= $this->borrarVehiculosServicio($servicio);
			$resultBorrarFuncionariosAsignados	= $this->borrarFuncionariosServicio($servicio);
			$resultBorrarUnidadesAsignadas		= $this->borrarUnidadServicio($servicio);
			$resultBorrarCamarasAsignadas		= $this->borrarCamarasServicio($servicio);
			
			if ($resultBorrarFuncionariosAsignados == 1) $resultInsertFuncionariosAsignados	= $this->insertFuncionariosServicio($servicio);
			if ($resultBorrarVehiculosAsignados == 1) $resultInsertVehiculosAsignados = $this->insertVehiculosServicio($servicio);
			if ($resultBorrarAnimalesAsignados2 == 1) $resultInsertAnimalAsignado = $this->insertAnimalServicio($servicio);
			if ($resultBorrarArmasAsignadas == 1) $resultInsertArmasAsignadas = $this->insertArmasServicio($servicio);
			if ($resultBorrarAnimalesAsignados == 1) $resultInsertAnimalesAsignados = $this->insertAnimalesServicio($servicio);
			if ($resultBorrarAccesoriosAsignados == 1) $resultInsertAccesoriosAsignados	= $this->insertAccesoriosServicio($servicio);
			if ($resultBorrarCamarasAsignadas == 1) $resultInsertCamarasAsignadas = $this->insertCamarasServicio($servicio);
			if ($resultBorrarCuadrantesAsignados == 1) $resultInsertCuadrantesAsignados	= $this->insertCuadrantesServicio($servicio);
			if ($resultBorrarFuncionarioAnimal ==1) $resultInsertFuncionarioAnimal = $this->insertFuncionarioAnimal($servicio);
			if ($resultBorrarFuncionarioVehiculo == 1) $resultInsertFuncionarioVehiculo	= $this->insertFuncionarioVehiculo($servicio);
			if ($resultBorrarUnidadesAsignadas == 1) $resultInsertUnidadesAsignadas = $this->insertUnidadServicio($servicio);
		}
		return $result;
	}
	
	function borrarFuncionarioVehiculo($servicio){
		$sql = "DELETE FROM FUNCIONARIO_VEHICULO 
				WHERE FUN_UNI_CODIGO ={$servicio->getUnidad()->getCodigoUnidad()} AND FUN_CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}

	function borrarFuncionarioSimccar($servicio){
		$sql = "DELETE FROM FUNCIONARIO_SIMCCAR
				WHERE FUN_UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND FUN_CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function borrarFuncionarioAnimal($servicio){
		$sql = "DELETE FROM FUNCIONARIO_ANIMAL
				WHERE FUN_UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND FUN_CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql); 
		mysql_close();
		return $result;
	}
	
	function borrarCuadrantesServicio($servicio){
		$sql = "DELETE FROM CUADRANTE_SERVICIO 
				WHERE UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result; 
	}
	
	function borrarAccesoriosServicio($servicio){
		$sql = "DELETE FROM ACCESORIO_SERVICIO
				WHERE UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function borrarAnimalesServicio($servicio){
		$sql = "DELETE FROM ANIMAL_SERVICIO
				WHERE UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close(); 
		return $result;
	}
	
	function borrarArmasServicio($servicio){
		$sql = "DELETE FROM ARMA_SERVICIO
				WHERE UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function borrarAnimalServicio($servicio){
		$sql = "DELETE FROM ANIMALES_SERVICIO
				WHERE UNI_CODIGO ={$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function borrarCamarasServicio($servicio){
		$sql = "DELETE FROM FUNCIONARIO_VIDEOCAMARA
				WHERE UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}

	function borrarVehiculosServicio($servicio){
		$sql = "DELETE FROM VEHICULO_SERVICIO
				WHERE UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function borrarFuncionariosServicio($servicio){
		$sql = "DELETE FROM FUNCIONARIO_SERVICIO
				WHERE UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function borrarUnidadServicio($servicio){
		$sql = "DELETE FROM UNIDAD_SERVICIO 
				WHERE UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function deleteServicio($servicio){
		$resultBorrarFuncionarioVehiculo	= $this->borrarFuncionarioVehiculo($servicio);
		$resultBorrarFuncionarioAnimal		= $this->borrarFuncionarioAnimal($servicio);
		$resultBorrarCuadrantesAsignados	= $this->borrarCuadrantesServicio($servicio);
		$resultBorrarAccesoriosAsignados	= $this->borrarAccesoriosServicio($servicio);
		$resultBorrarAnimalesAsignados		= $this->borrarAnimalesServicio($servicio);
		$resultBorrarArmasAsignadas			= $this->borrarArmasServicio($servicio);
		$resultBorrarAnimalAsignado			= $this->borrarAnimalServicio($servicio);
		$resultBorrarVehiculosAsignados		= $this->borrarVehiculosServicio($servicio);
		$resultBorrarFuncionariosAsignados	= $this->borrarFuncionariosServicio($servicio);
		$resultBorrarUnidadesAsignadas		= $this->borrarUnidadServicio($servicio);
		$resultBorrarCamarasAsignadas		= $this->borrarCamarasServicio($servicio);

		$sql = "DELETE FROM SERVICIO 
				WHERE UNI_CODIGO = {$servicio->getUnidad()->getCodigoUnidad()} AND CORRELATIVO_SERVICIO = {$servicio->getCorrelativo()}";
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function listaServiciosPorFuncionarioFinal($funcionario, $fecha1, $fecha2, $servicios){	
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
				FROM FUNCIONARIO_SERVICIO
				JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE FUNCIONARIO_SERVICIO.FUN_CODIGO = '{$funcionario}' 
				AND SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}' 
				ORDER BY SERVICIO.FECHA DESC, SERVICIO.HORA_INICIO DESC";
			
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
		
		if ($codServicio != 0) $filtroServicio = " AND SERVICIO.TSERV_CODIGO IN ({$codServicio})";
		
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
				FROM FUNCIONARIO_SERVICIO
				JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE FUNCIONARIO_SERVICIO.FUN_CODIGO = '{$funcionario}' AND SERVICIO.FECHA {$condicion} BETWEEN '{$fecha1}' AND '{$fecha2}' {$filtroServicio} 
				ORDER BY SERVICIO.FECHA DESC, SERVICIO.HORA_INICIO DESC";
		
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
				FROM FUNCIONARIO_SERVICIO
				JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE FUNCIONARIO_SERVICIO.FUN_CODIGO = '{$funcionario}' AND SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}'
				ORDER BY SERVICIO.FECHA DESC, SERVICIO.HORA_INICIO DESC";
		
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
	
	function listaServiciosPorVehiculo($vehiculo, $fecha1, $fecha2, $servicios){
		
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
				  VEHICULO_SERVICIO.KM_FINAL,
				  SERVICIO.HORA_INICIO,
				  SERVICIO.HORA_TERMINO
				FROM SERVICIO
				JOIN VEHICULO_SERVICIO ON (SERVICIO.UNI_CODIGO = VEHICULO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = VEHICULO_SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE VEHICULO_SERVICIO.VEH_CODIGO = {$vehiculo} AND SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}'
				ORDER BY SERVICIO.FECHA DESC, SERVICIO.HORA_INICIO DESC";
		
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
			$servicio->setHoraInicio(SUBSTR($myrow["HORA_INICIO"],0,5));
			$servicio->setHoraTermino(SUBSTR($myrow["HORA_TERMINO"],0,5));
			
			$servicios[$i] = $servicio;
			$i++;
		}
	}
	
	function listaServiciosPorAnimales($animal, $fecha1, $fecha2, $codServicio, $servicios){
		
		if ($codServicio != 0) $filtroServicio = " AND SERVICIO.TSERV_CODIGO = {$codServicio}";
		
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
				FROM SERVICIO
				JOIN ANIMALES_SERVICIO ON (SERVICIO.UNI_CODIGO = ANIMALES_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = ANIMALES_SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE ANIMALES_SERVICIO.ANIM_CODIGO = {$animal} AND SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}' {$filtroServicio}
				ORDER BY SERVICIO.FECHA DESC, SERVICIO.HORA_INICIO DESC";
		
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

	function listaServiciosPorArmas($arma, $fecha1, $fecha2, $servicios){
		
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
				FROM SERVICIO
				JOIN ARMA_SERVICIO ON (SERVICIO.UNI_CODIGO = ARMA_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = ARMA_SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE ARMA_SERVICIO.ARM_CODIGO = {$arma} AND 
				SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}' 
				ORDER BY SERVICIO.FECHA DESC, SERVICIO.HORA_INICIO DESC";
		
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

		if ($codServicio != 0) $filtroServicio = " AND SERVICIO.TSERV_CODIGO = {$codServicio}";
		
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
				FROM SERVICIO
				JOIN SIMCCAR_SERVICIO ON (SERVICIO.UNI_CODIGO = SIMCCAR_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE SIMCCAR_SERVICIO.SIM_CODIGO = {$vehiculo} AND SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}' {$filtroServicio} 
				ORDER BY SERVICIO.FECHA DESC, SERVICIO.HORA_INICIO DESC";
		
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
	
	function listaServiciosPorCamara($camara, $fecha1, $fecha2, $servicios){
		
		$sql = "SELECT 
					S.UNI_CODIGO,
					U.UNI_DESCRIPCION,
					S.CORRELATIVO_SERVICIO,
					S.TSERV_CODIGO,
					T.TSERV_DESCRIPCION,
					S.TEXT_CODIGO,
					E.TEXT_DESCRIPCION,
					S.FECHA,
					S.HORA_INICIO,
					S.HORA_TERMINO
				FROM SERVICIO S
				JOIN FUNCIONARIO_VIDEOCAMARA V ON S.UNI_CODIGO = V.UNI_CODIGO AND S.CORRELATIVO_SERVICIO = V.CORRELATIVO_SERVICIO
				JOIN TIPO_SERVICIO T ON S.TSERV_CODIGO = T.TSERV_CODIGO
				LEFT JOIN TIPO_EXTRAORDINARIO E ON S.TEXT_CODIGO = E.TEXT_CODIGO
				JOIN UNIDAD U ON S.UNI_CODIGO = U.UNI_CODIGO
				WHERE V.VC_CODIGO = {$camara} AND S.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}'
				ORDER BY S.FECHA DESC, S.HORA_INICIO DESC";
		
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
		
		if ($tipoServicio != ""){
			$filtro = " AND SERVICIO.TSERV_CODIGO = {$tipoServicio}";
		}
		
		if ($tipoUnidad == "nacional"){
			$unidadAgregada = "";
			$unidadFiltro   = "";
		}
		
		if ($tipoUnidad == "zona"){
			$unidadAgregada = "UNIDAD3.UNI_CODIGO, UNIDAD3.UNI_DESCRIPCION,";
			if ($inicio == "0") $unidadFiltro = "WHERE (UNIDAD3.UNI_CODIGO = {$unidad})";
			if ($inicio == "1") $unidadFiltro = "";
		}
		
		if ($tipoUnidad == "prefectura"){
			$unidadAgregada = "UNIDAD2.UNI_CODIGO, UNIDAD2.UNI_DESCRIPCION,";
			if ($inicio == "0") $unidadFiltro = "WHERE (UNIDAD2.UNI_CODIGO = {$unidad})";
			if ($inicio == "1") $unidadFiltro = "WHERE (UNIDAD3.UNI_CODIGO = {$unidad})";
		}
		
		if ($tipoUnidad == "comisaria"){
			$unidadAgregada = "UNIDAD1.UNI_CODIGO, UNIDAD1.UNI_DESCRIPCION,";
			if ($inicio == "0") $unidadFiltro = "WHERE (UNIDAD1.UNI_CODIGO = {$unidad})";
			if ($inicio == "1") $unidadFiltro = "WHERE (UNIDAD2.UNI_CODIGO = {$unidad})";
		}
		
		if ($tipoUnidad == "destacamento"){
			$unidadAgregada = "UNIDAD.UNI_CODIGO, UNIDAD.UNI_DESCRIPCION,";
			if ($inicio == "0") $unidadFiltro = "WHERE (UNIDAD.UNI_CODIGO = {$unidad})";
			if ($inicio == "1") $unidadFiltro = "WHERE (UNIDAD1.UNI_CODIGO = {$unidad})";
			$correlativo = "SERVICIO.CORRELATIVO_SERVICIO,";
		}
		
		$sql = "SELECT 
				  {$unidadAgregada}{$correlativo}
				  SERVICIO.TSERV_CODIGO,
				  TIPO_SERVICIO.TSERV_DESCRIPCION,
				  SERVICIO.FECHA,
				  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
				  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
				FROM SERVICIO
				JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
				JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
				JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
				JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
				{$unidadFiltro} {$filtro}
				GROUP BY {$unidadAgregada}{$correlativo}
				  SERVICIO.TSERV_CODIGO,
				  TIPO_SERVICIO.TSERV_DESCRIPCION,
				  SERVICIO.FECHA
				HAVING
				  SERVICIO.FECHA = '{$fecha1}' ORDER BY UNI_DESCRIPCION, TIPO_SERVICIO.TSERV_ORDEN";
		
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
			$filtro = " AND SERVICIO.TSERV_CODIGO = {$tipoServicio}";
		}
		
		if ($tipoUnidad == "prefectura"){
			$subconsulta = "SELECT UNIDAD.UNI_CODIGO
							FROM UNIDAD
							LEFT JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
							LEFT JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
							WHERE UNIDAD2.UNI_CODIGO = {$unidad}
							UNION
							SELECT UNIDAD1.UNI_CODIGO
							FROM UNIDAD
							LEFT JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
							LEFT JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
							WHERE UNIDAD2.UNI_CODIGO = {$unidad}";
		}
		
		if ($tipoUnidad == "destacamento" or $tipoUnidad == "comisaria"){
			$subconsulta = "SELECT UNIDAD.UNI_CODIGO
							FROM UNIDAD
							LEFT JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
							WHERE UNIDAD1.UNI_CODIGO = {$unidad}
							UNION
							SELECT {$unidad} FROM UNIDAD";
		}
		
		if ($tipoUnidad == "zona"){
			$subconsulta = "SELECT UNIDAD.UNI_CODIGO
							FROM UNIDAD UNIDAD1
							LEFT JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
							LEFT JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
							JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
							WHERE UNIDAD3.UNI_CODIGO = {$unidad}
							UNION
							SELECT UNIDAD1.UNI_CODIGO
							FROM UNIDAD UNIDAD1
							LEFT JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
							LEFT JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
							JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
							WHERE UNIDAD3.UNI_CODIGO = {$unidad}";
		}
		
		$sql = "SELECT {$unidadDesagregada}
				  SERVICIO.TSERV_CODIGO,
				  TIPO_SERVICIO.TSERV_DESCRIPCION,
				  SERVICIO.FECHA,
				  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
				  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
				FROM SERVICIO
				JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
				  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
				  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
				JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)       
				WHERE (SERVICIO.UNI_CODIGO IN ({$subconsulta})) {$filtro}
				GROUP BY
				  {$unidadDesagregada}
				  SERVICIO.TSERV_CODIGO,
				  TIPO_SERVICIO.TSERV_DESCRIPCION,
				  SERVICIO.FECHA
				HAVING SERVICIO.FECHA = '{$fecha1}' ORDER BY SERVICIO.UNI_CODIGO, TIPO_SERVICIO.TSERV_ORDEN";
		
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
		if ($tipoUnidad	== "nacional" && $inicio == 0){
			$sql = "SELECT
					  20 AS UNI_CODIGO,
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM UNIDAD 
					JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					WHERE (UNIDAD.UNI_PADRE = {$unidad} OR 
					  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = {$unidad} OR 
					  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = {$unidad} OR 
					  UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = {$unidad} )))) AND 
					  SERVICIO.FECHA = '{$fecha1}'
					GROUP BY
					  UNI_CODIGO,
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION";
		}
		
		if (($tipoUnidad == "zona" || $tipoUnidad == "prefectura") && $inicio == 0){
			$sql = "SELECT 
						IF (UNIDAD3.UNI_CODIGO={$unidad},UNIDAD3.UNI_CODIGO, UNIDAD2.UNI_CODIGO) AS UNI_CODIGO,
						IF (UNIDAD3.UNI_CODIGO={$unidad},UNIDAD3.UNI_DESCRIPCION, UNIDAD2.UNI_DESCRIPCION) AS UNI_DESCRIPCION, 
						SERVICIO.TSERV_CODIGO,
						TIPO_SERVICIO.TSERV_DESCRIPCION,
						COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
						COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM UNIDAD UNIDAD1
					JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
					JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
					JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					WHERE (UNIDAD.UNI_PADRE = {$unidad} 
					OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO
											FROM UNIDAD 
											WHERE UNIDAD.UNI_PADRE = {$unidad} 
											OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
																	FROM UNIDAD 
																	WHERE UNIDAD.UNI_PADRE = {$unidad} 
																	OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
																							FROM UNIDAD 
																							WHERE UNIDAD.UNI_PADRE = {$unidad})
																	)
											)
					) AND SERVICIO.FECHA = '{$fecha1}'
					GROUP BY
						UNI_CODIGO,
						UNI_DESCRIPCION,
						SERVICIO.TSERV_CODIGO,
						TIPO_SERVICIO.TSERV_DESCRIPCION";
		}
		
		if($tipoUnidad == "comisaria" && $inicio == 0){
			$sql = "SELECT 
					  IF (UNIDAD2.UNI_CODIGO={$unidad},UNIDAD2.UNI_CODIGO, UNIDAD1.UNI_CODIGO) AS UNI_CODIGO,
					  IF (UNIDAD2.UNI_CODIGO={$unidad},UNIDAD2.UNI_DESCRIPCION, UNIDAD1.UNI_DESCRIPCION) AS UNI_DESCRIPCION, 
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM UNIDAD UNIDAD1
					JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
					JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
					JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					WHERE (UNIDAD.UNI_PADRE = {$unidad} 
					OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
											FROM UNIDAD 
											WHERE UNIDAD.UNI_PADRE = {$unidad} 
											OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
																	FROM UNIDAD 
																	WHERE UNIDAD.UNI_PADRE = {$unidad} 
																	OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
																							FROM UNIDAD 
																							WHERE UNIDAD.UNI_PADRE = {$unidad})
																	)
											)
					) AND SERVICIO.FECHA = '{$fecha1}'
					GROUP BY
						UNI_CODIGO,
						UNI_DESCRIPCION,
						SERVICIO.TSERV_CODIGO,
						TIPO_SERVICIO.TSERV_DESCRIPCION";
		}
		
		if ($tipoUnidad== "zona" && $inicio == 1){
			$sql= "SELECT 
					  IF(UNIDAD3.UNI_CODIGO={$unidad},UNIDAD2.UNI_CODIGO, UNIDAD3.UNI_CODIGO) AS UNI_CODIGO,
					  IF(UNIDAD3.UNI_CODIGO={$unidad},UNIDAD2.UNI_DESCRIPCION, UNIDAD3.UNI_DESCRIPCION) AS UNI_DESCRIPCION,
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM UNIDAD UNIDAD1
					JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
					JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
					JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					WHERE (UNIDAD.UNI_PADRE = {$unidad} 
					OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
											FROM UNIDAD 
											WHERE UNIDAD.UNI_PADRE = {$unidad} 
											OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
																	FROM UNIDAD 
																	WHERE UNIDAD.UNI_PADRE = {$unidad} 
																	OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
																							FROM UNIDAD 
																							WHERE UNIDAD.UNI_PADRE = {$unidad})
																	)
											)
					) AND SERVICIO.FECHA = '{$fecha1}' AND SERVICIO.TSERV_CODIGO = {$tipoServicio}
					GROUP BY
						UNI_CODIGO,
						UNI_DESCRIPCION,
						SERVICIO.TSERV_CODIGO,
						TIPO_SERVICIO.TSERV_DESCRIPCION";
		}
		
		if ($tipoUnidad== "prefectura" && $inicio == 1){
			$sql= "SELECT 
					  IF (UNIDAD2.UNI_CODIGO={$unidad},UNIDAD1.UNI_CODIGO, UNIDAD2.UNI_CODIGO) AS UNI_CODIGO,          
					  IF (UNIDAD2.UNI_CODIGO={$unidad},UNIDAD1.UNI_DESCRIPCION, UNIDAD2.UNI_DESCRIPCION) AS UNI_DESCRIPCION,
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM UNIDAD UNIDAD1
					JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
					JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
					JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					WHERE (UNIDAD.UNI_PADRE = {$unidad} 
					OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
											FROM UNIDAD 
											WHERE UNIDAD.UNI_PADRE = {$unidad} 
											OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
																	FROM UNIDAD 
																	WHERE UNIDAD.UNI_PADRE = {$unidad} 
																	OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
																							FROM UNIDAD 
																							WHERE UNIDAD.UNI_PADRE = {$unidad})
																	)
											)
					) AND SERVICIO.FECHA = '{$fecha1}' AND SERVICIO.TSERV_CODIGO = {$tipoServicio}
					GROUP BY
						UNI_CODIGO,
						UNI_DESCRIPCION,
						SERVICIO.TSERV_CODIGO,
						TIPO_SERVICIO.TSERV_DESCRIPCION";
		}
		
		if ($tipoUnidad== "comisaria" && $inicio == 1){
			$sql= "SELECT 
					  IF (UNIDAD1.UNI_CODIGO={$unidad},UNIDAD.UNI_CODIGO, UNIDAD1.UNI_CODIGO) AS UNI_CODIGO,          
					  IF (UNIDAD1.UNI_CODIGO={$unidad},UNIDAD.UNI_DESCRIPCION, UNIDAD1.UNI_DESCRIPCION) AS UNI_DESCRIPCION,
					  SERVICIO.TSERV_CODIGO,
					  TIPO_SERVICIO.TSERV_DESCRIPCION,
					  COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					  COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM UNIDAD UNIDAD1
					JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
					JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
					JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					WHERE (UNIDAD.UNI_PADRE = {$unidad} 
					OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
											FROM UNIDAD 
											WHERE UNIDAD.UNI_PADRE = {$unidad} 
											OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
																	FROM UNIDAD 
																	WHERE UNIDAD.UNI_PADRE = {$unidad} 
																	OR UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO 
																							FROM UNIDAD 
																							WHERE UNIDAD.UNI_PADRE = {$unidad})
																	)
											)
					) AND SERVICIO.FECHA = '{$fecha1}' AND SERVICIO.TSERV_CODIGO = {$tipoServicio}
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
					FROM UNIDAD UNIDAD1
					JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
					JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
					JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					WHERE UNIDAD.UNI_PADRE = {$unidad} AND SERVICIO.FECHA = '{$fecha1}' AND SERVICIO.TSERV_CODIGO = {$tipoServicio}
					GROUP BY
						UNIDAD.UNI_CODIGO,
						UNIDAD.UNI_DESCRIPCION,
						SERVICIO.TSERV_CODIGO,
						TIPO_SERVICIO.TSERV_DESCRIPCION,
						SERVICIO.CORRELATIVO_SERVICIO
					ORDER BY UNIDAD.UNI_DESCRIPCION";
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
					FROM UNIDAD UNIDAD1
					JOIN UNIDAD ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
					JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
					JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
					JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					WHERE UNIDAD.UNI_CODIGO = {$unidad} AND SERVICIO.FECHA = '{$fecha1}' AND SERVICIO.TSERV_CODIGO = {$tipoServicio}
					GROUP BY
						UNIDAD.UNI_CODIGO,
						UNIDAD.UNI_DESCRIPCION,
						SERVICIO.TSERV_CODIGO,
						TIPO_SERVICIO.TSERV_DESCRIPCION,
						SERVICIO.CORRELATIVO_SERVICIO";
		}
		
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
		
		$filtroServicio = "";
		if ($tipoServicio != "") $filtroServicio =  "AND SERVICIO.TSERV_CODIGO = {$tipoServicio}";

		if ($tipoUnidad != "destacamento"){
		
		$sql = "SELECT 
					VISTA_UNIDADES_3.{$tipoUnidadPadre}_CODIGO AS UNI_CODIGO_PADRE,
					VISTA_UNIDADES_3.{$tipoUnidad}_CODIGO AS UNI_CODIGO,
					VISTA_UNIDADES_3.{$tipoUnidad}_DESCRIPCION AS UNI_DESCRIPCION,
					SERVICIO.TSERV_CODIGO AS TSERV_CODIGO,
					UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS TSERV_DESCRIPCION,
					COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
				FROM SERVICIO
				JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				JOIN VISTA_UNIDADES_3 ON (SERVICIO.UNI_CODIGO = VISTA_UNIDADES_3.DESTACAMENTO_CODIGO)
				LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
				  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
				  AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
				WHERE SERVICIO.FECHA = '{$fecha1}'
				GROUP BY
					VISTA_UNIDADES_3.{$tipoUnidadPadre}_CODIGO,
					VISTA_UNIDADES_3.{$tipoUnidad}_CODIGO,
					VISTA_UNIDADES_3.{$tipoUnidad}_DESCRIPCION,
					SERVICIO.TSERV_CODIGO,
					UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION)
				HAVING UNI_CODIGO_PADRE = {$unidad} {$filtroServicio}
				ORDER BY TIPO_SERVICIO.TSERV_DESCRIPCION";
		
		} else {
			
			$sql = "SELECT 
						VISTA_UNIDADES_4.{$tipoUnidadPadre}_CODIGO AS UNI_CODIGO_PADRE ,
						VISTA_UNIDADES_4.{$tipoUnidad}_CODIGO AS UNI_CODIGO ,
						VISTA_UNIDADES_4.{$tipoUnidad}_DESCRIPCION AS UNI_DESCRIPCION,
						SERVICIO.TSERV_CODIGO AS TSERV_CODIGO,
						UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS TSERV_DESCRIPCION,
						SERVICIO.CORRELATIVO_SERVICIO CORRELATIVO_SERVICIO,
						COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
						COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
					FROM SERVICIO
					JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
					JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					JOIN VISTA_UNIDADES_4 ON (SERVICIO.UNI_CODIGO = VISTA_UNIDADES_4.DESTACAMENTO_CODIGO)
					LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
						AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
						AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
					WHERE SERVICIO.FECHA = '{$fecha1}'
					GROUP BY
						VISTA_UNIDADES_4.{$tipoUnidadPadre}_CODIGO,
						VISTA_UNIDADES_4.{$tipoUnidad}_CODIGO,
						VISTA_UNIDADES_4.{$tipoUnidad}_DESCRIPCION,
						SERVICIO.TSERV_CODIGO,
						UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION),
						SERVICIO.CORRELATIVO_SERVICIO
						HAVING UNI_CODIGO_PADRE = {$unidad} {$filtroServicio}
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
						FROM SERVICIO
						JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
						LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
						JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
						JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) 
							AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
						LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
							AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
							AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
						WHERE UNIDAD.UNI_CODIGO = {$unidad} AND SERVICIO.FECHA = '{$fecha1}'
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
		
		$sql = "SELECT SERVICIOS_CERTIFICADO.FECHA_SERVICIOS
				FROM SERVICIOS_CERTIFICADO
				WHERE SERVICIOS_CERTIFICADO.UNI_CODIGO = {$unidadServicios} 
				AND SERVICIOS_CERTIFICADO.FECHA_SERVICIOS = '{$fechaServicios}'";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		while($myrow = mysql_fetch_array($result) ){
			$fechaValidacion = $myrow["FECHA_SERVICIOS"];
		}
	}
	
	function buscaListaFechaValidacion($unidad, $fechaServicios, &$servicios){
		
		$sql = "SELECT SERVICIOS_CERTIFICADO.FECHA_SERVICIOS
				FROM SERVICIOS_CERTIFICADO
				WHERE SERVICIOS_CERTIFICADO.UNI_CODIGO = {$unidad} 
				AND SERVICIOS_CERTIFICADO.FECHA_SERVICIOS >= '{$fechaServicios}' 
				ORDER BY SERVICIOS_CERTIFICADO.FECHA_SERVICIOS ASC";
		//echo $sql;
		$cont=0;
		$i=0;
		$servicios = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			$servicio = new servicio;
			$servicio->setUnidad($unidad);
			$servicio->setFecha($myrow["FECHA_SERVICIOS"]);
			$servicios[$i] = $servicio;
			$i++;
		}
	}

	function buscaTiposDeServiciosPorFuncionario($unidadServicio, $fecha1, $fecha2, $tipoServicio, $codigoFuncionario, $cantidadColaciones, $cantidadOtrosServicios, $codigoServicio, $grupo){	
		
		$sql = "SELECT 
					FUNCIONARIO_SERVICIO.FUN_CODIGO,
					SUM(IF(TIPO_SERVICIO.TSERV_GRUPO = 'COLACION', 1, 0)) AS COLACIONES,
					SUM(IF(TIPO_SERVICIO.TSERV_GRUPO <> 'COLACION', 1, 0)) AS OTROS_SERVICIOS,
					SERVICIO.TSERV_CODIGO,
					TIPO_SERVICIO.TSERV_GRUPO
				FROM SERVICIO
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
				WHERE SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}'
					AND SERVICIO.UNI_CODIGO = {$unidadServicio} AND TIPO_SERVICIO.TSERV_GRUPO <> 'SIN SERVICIO'
				GROUP BY FUNCIONARIO_SERVICIO.FUN_CODIGO
				ORDER BY FUNCIONARIO_SERVICIO.FUN_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			$codigoFuncionario[]		= $myrow[0];
			$cantidadColaciones[]		= $myrow[1];
			$cantidadOtrosServicios[]	= $myrow[2];
			$codigoServicio[]			= $myrow[3];
			$grupo[]					= $myrow[4];
		}
	}
	
	function buscaServiciosPorFuncionario($unidadServicio, $fecha1, $fecha2, $tipoServicio, $codigoFuncionario, $cantidadColaciones){
		
		$sql = "SELECT 
					FUNCIONARIO_SERVICIO.FUN_CODIGO,
					COUNT(*)
				FROM SERVICIO
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
				WHERE SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}' 
					AND SERVICIO.UNI_CODIGO = {$unidadServicio} AND TIPO_SERVICIO.TSERV_GRUPO = '{$tipoServicio}'
			  GROUP BY FUNCIONARIO_SERVICIO.FUN_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			$codigoFuncionario[]	= $myrow[0];
			$cantidadColaciones[]	= $myrow[1];
		}
	}
	
	function buscaServicioJefaturaSupervicionPorFuncionario($unidadServicio, $fecha1, $fecha2, $codigoFuncionario, $cantidadSupervisiones){	
		
		$sql = "SELECT
					FUNCIONARIO_SERVICIO.FUN_CODIGO,
					COUNT(*)
				FROM FUNCIONARIO_SERVICIO
				JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) 
					AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
				WHERE SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}' 
					AND SERVICIO.UNI_CODIGO = {$unidadServicio} AND SERVICIO.TSERV_CODIGO = 607
				GROUP BY FUNCIONARIO_SERVICIO.FUN_CODIGO 
				ORDER BY FUNCIONARIO_SERVICIO.FUN_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			$codigoFuncionario[]		= $myrow[0];
			$cantidadSupervisiones[]	= $myrow[1];
		}
	}
	
	function buscaColacionPorFuncionario($unidadServicio, $fecha1, $fecha2, $codigoFuncionario, $cantidadColaciones, $codigoServicio){
		
		$sql = "SELECT 
					FUNCIONARIO_SERVICIO.FUN_CODIGO,
					SUM(IF(TIPO_SERVICIO.TSERV_GRUPO = 'COLACION', 1, 0)) AS COLACIONES,
					SERVICIO.TSERV_CODIGO
				FROM SERVICIO
					INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
					AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
				WHERE SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}' 
					AND SERVICIO.UNI_CODIGO = {$unidadServicio} AND TIPO_SERVICIO.TSERV_GRUPO = 'COLACION'
				GROUP BY FUNCIONARIO_SERVICIO.FUN_CODIGO
				ORDER BY FUNCIONARIO_SERVICIO.FUN_CODIGO";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			$codigoFuncionario[]	= $myrow[0];
			$cantidadColaciones[]	= $myrow[1];
			$codigoServicio[]		= $myrow[2];
		}
	}
	
	function ExcesoColacion($unidad, $fecha, $funcionarios){
		
		$sql = "SELECT 
					O.FUN_CODIGO,
					CONCAT(F.FUN_APELLIDOPATERNO,' ',F.FUN_APELLIDOMATERNO,', ',F.FUN_NOMBRE,' (',G.GRA_DESCRIPCION,')') NOMBRE
					FROM (SELECT 
					FS.FUN_CODIGO,
					S.TSERV_CODIGO,
					S.HORA_INICIO,
					S.HORA_TERMINO,
					TIME_TO_SEC(TIMEDIFF(CONCAT(IF(S.HORA_TERMINO <= S.HORA_INICIO,'2000-01-02 ','2000-01-01 '),S.HORA_TERMINO), CONCAT('2000-01-01 ',S.HORA_INICIO)))/3600 HORAS,
					(TIME_TO_SEC(TIMEDIFF(CONCAT(IF(S.HORA_TERMINO <= S.HORA_INICIO,'2000-01-02 ','2000-01-01 '),S.HORA_TERMINO), CONCAT('2000-01-01 ',S.HORA_INICIO)))/3600)*0.3 COLACIONMAX
				FROM FUNCIONARIO_SERVICIO FS
				JOIN SERVICIO S ON S.UNI_CODIGO = FS.UNI_CODIGO AND S.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO
				WHERE S.TSERV_CODIGO NOT IN (142,143,144,145,146,147,148,149,151,152,153,607) AND FS.UNI_CODIGO = {$unidad} AND S.FECHA = '{$fecha}') O
				JOIN (SELECT 
						FS.FUN_CODIGO,
						S.TSERV_CODIGO,
						CASE 
						WHEN S.TSERV_CODIGO = 142 THEN 0.5 
						WHEN S.TSERV_CODIGO = 143 THEN 1 
						WHEN S.TSERV_CODIGO = 144 THEN 1.5 
						WHEN S.TSERV_CODIGO = 145 THEN 2 
						WHEN S.TSERV_CODIGO = 146 THEN 2.5 
						WHEN S.TSERV_CODIGO = 147 THEN 3
						WHEN S.TSERV_CODIGO = 148 THEN 0.75 
						WHEN S.TSERV_CODIGO = 149 THEN 1.25 
						WHEN S.TSERV_CODIGO = 151 THEN 1.75 
						WHEN S.TSERV_CODIGO = 152 THEN 2.25 
						WHEN S.TSERV_CODIGO = 153 THEN 2.75 
						END COLACION
					FROM FUNCIONARIO_SERVICIO FS
					JOIN SERVICIO S ON S.UNI_CODIGO = FS.UNI_CODIGO AND S.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO
					JOIN TIPO_SERVICIO T ON T.TSERV_CODIGO = S.TSERV_CODIGO
					WHERE S.TSERV_CODIGO IN (142,143,144,145,146,147,148,149,151,152,153,607) AND FS.UNI_CODIGO = {$unidad} AND S.FECHA = '{$fecha}') C 
				ON C.FUN_CODIGO = O.FUN_CODIGO AND O.COLACIONMAX < COLACION
				JOIN FUNCIONARIO F ON F.FUN_CODIGO = O.FUN_CODIGO
				JOIN GRADO G ON G.ESC_CODIGO = F.ESC_CODIGO AND G.GRA_CODIGO = F.GRA_CODIGO";
		
		//echo $sql;
		$cont=0;
		$i=0;
		$servicios = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		while($myrow = mysql_fetch_array($result) ){
			
			$funcionario = new funcionario;
			$funcionario->setCodigoFuncionario($myrow["FUN_CODIGO"]);
			$funcionario->setPNombre($myrow["NOMBRE"]);
			
			$funcionarios[$i] = $funcionario;
			$i++;
		}
	}
	
	function ExcesoServicios($unidad, $fecha, $funcionarios){
		
		$sql = "SELECT 
					B.FUN_CODIGO,
					B.NOMBRE,
					SUM(B.HH) HORA
				FROM (SELECT 
						FS.FUN_CODIGO,
						CONCAT(F.FUN_APELLIDOPATERNO,' ',F.FUN_APELLIDOMATERNO,', ',F.FUN_NOMBRE,' (',G.GRA_DESCRIPCION,')') NOMBRE,
						S.TSERV_CODIGO,
						S.HORA_INICIO,
						S.HORA_TERMINO,
						(IF(S.HORA_TERMINO <= S.HORA_INICIO,TIME_TO_SEC(S.HORA_TERMINO)+86400,TIME_TO_SEC(S.HORA_TERMINO)) - TIME_TO_SEC(S.HORA_INICIO))/3600 HH
					FROM FUNCIONARIO_SERVICIO FS
					JOIN SERVICIO S ON S.UNI_CODIGO = FS.UNI_CODIGO AND S.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO
					JOIN FUNCIONARIO F ON F.FUN_CODIGO = FS.FUN_CODIGO
					JOIN GRADO G ON G.ESC_CODIGO = F.ESC_CODIGO AND G.GRA_CODIGO = F.GRA_CODIGO
					WHERE S.TSERV_CODIGO NOT IN (14,22,23,81,142,143,144,145,146,147,148,149,151,152,153,508,607,870) 
					AND FS.UNI_CODIGO = {$unidad} AND S.FECHA = '{$fecha}') B
				GROUP BY B.FUN_CODIGO
				HAVING HORA > 24";
		
		//echo $sql;
		$cont=0;
		$i=0;
		$servicios = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		while($myrow = mysql_fetch_array($result) ){
			
			$funcionario = new funcionario;
			$funcionario->setCodigoFuncionario($myrow["FUN_CODIGO"]);
			$funcionario->setPNombre($myrow["NOMBRE"]);
			
			$funcionarios[$i] = $funcionario;
			$i++;
		}
	}
	
	function DeficitServicios($unidad, $fecha, $funcionarios){
		
		$sql = "SELECT 
					B.FUN_CODIGO,
					B.NOMBRE,
					SUM(B.HH) HORA
				FROM (SELECT 
						FS.FUN_CODIGO,
						CONCAT(F.FUN_APELLIDOPATERNO,' ',F.FUN_APELLIDOMATERNO,', ',F.FUN_NOMBRE,' (',G.GRA_DESCRIPCION,')') NOMBRE,
						S.TSERV_CODIGO,
						S.HORA_INICIO,
						S.HORA_TERMINO,
						(IF(S.HORA_TERMINO <= S.HORA_INICIO,TIME_TO_SEC(S.HORA_TERMINO)+86400,TIME_TO_SEC(S.HORA_TERMINO)) - TIME_TO_SEC(S.HORA_INICIO))/3600 HH
					FROM FUNCIONARIO_SERVICIO FS
					JOIN SERVICIO S ON S.UNI_CODIGO = FS.UNI_CODIGO AND S.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO
					JOIN FUNCIONARIO F ON F.FUN_CODIGO = FS.FUN_CODIGO
					JOIN GRADO G ON G.ESC_CODIGO = F.ESC_CODIGO AND G.GRA_CODIGO = F.GRA_CODIGO
					WHERE S.TSERV_CODIGO NOT IN (14,22,23,81,142,143,144,145,146,147,148,149,151,152,153,508,607,870) 
					AND FS.UNI_CODIGO = {$unidad} AND S.FECHA = '{$fecha}') B
				GROUP BY B.FUN_CODIGO
				HAVING HORA < 4";
		
		//echo $sql;
		$cont=0;
		$i=0;
		$servicios = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		while($myrow = mysql_fetch_array($result) ){
			
			$funcionario = new funcionario;
			$funcionario->setCodigoFuncionario($myrow["FUN_CODIGO"]);
			$funcionario->setPNombre($myrow["NOMBRE"]);
			
			$funcionarios[$i] = $funcionario;
			$i++;
		}
	}
	
}
?>