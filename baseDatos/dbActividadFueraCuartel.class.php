<?
Class dbActividadFueraCuartel extends Conexion {		
	
	function listaTotalFuncionarios($Unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $funcionarios){
		
		$FechaHoy = date("Y-m-d");
		
		if ($NombreCampo == "codigo")  $campoOrdenar = "F.FUN_CODIGO {$TipoOrden}";
		if ($NombreCampo == "nombre") $campoOrdenar = "F.FUN_APELLIDOPATERNO {$TipoOrden}, F.FUN_APELLIDOMATERNO {$TipoOrden}, F.FUN_NOMBRE {$TipoOrden}";
		if ($NombreCampo == "tipo") $campoOrdenar = "T.TSERV_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "fechaI")  $campoOrdenar = "A.FECHA_INICIO {$TipoOrden}";
		if ($NombreCampo == "fechaT")  $campoOrdenar = "A.FECHA_TERMINO {$TipoOrden}";
		if ($NombreCampo == "constancia")  $campoOrdenar = "F.FUN_CODIGO {$TipoOrden}";
		if ($NombreCampo == "") $campoOrdenar = "F.FUN_CODIGO {$TipoOrden}";
		
		$sql = "SELECT 
					A.COD_ACTIVIDAD_FUERA_CUARTEL,
					F.FUN_CODIGO,
					F.UNI_CODIGO,
					F.FUN_APELLIDOPATERNO,
					F.FUN_APELLIDOMATERNO,
					F.FUN_NOMBRE,
					F.FUN_NOMBRE2,
					T.TSERV_DESCRIPCION,
					A.FUN_RUT,
					A.FUN_CODIGO_UNIDAD,
					A.FECHA_INICIO,
					A.FECHA_TERMINO,
					A.FECHA_INICIO_REAL,
					A.FECHA_TERMINO_REAL
				FROM ACTIVIDAD_FUERA_CUARTEL A 
				JOIN TIPO_SERVICIO T ON (A.TIPO_ACTIVIDAD = T.TSERV_CODIGO)
				JOIN FUNCIONARIO F ON (F.FUN_RUT = A.FUN_RUT)
				WHERE A.UNI_CODIGO = '{$Unidad}' AND A.ESTADO = 1";
		
        if ($nombreBuscar == ""){
			$sql .= " AND CURDATE() BETWEEN A.FECHA_INICIO AND A.FECHA_TERMINO";
		}
		else{
			if($nombreBuscar[0]==" ") $nombreBuscar = SUBSTR($nombreBuscar, 1);
			
			$sql .= " AND (F.FUN_APELLIDOPATERNO like '%{$nombreBuscar}%' 
                        OR F.FUN_APELLIDOMATERNO like '%{$nombreBuscar}%' 
                        OR F.FUN_NOMBRE like '%{$nombreBuscar}%'
						OR F.FUN_NOMBRE2 like '%{$nombreBuscar}%')";
		}
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$actividadFueraCuartel = new actividadFueraCuartel;
			$actividadFueraCuartel->setCodActividadFueraCuartel(STRTOUPPER($myrow["COD_ACTIVIDAD_FUERA_CUARTEL"]));
			$actividadFueraCuartel->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
			$actividadFueraCuartel->setNumDocumento(STRTOUPPER($myrow["NUM_DOCUMENTO"]));
			$actividadFueraCuartel->setFechaInicio(STRTOUPPER($myrow["FECHA_INICIO"]));
			$actividadFueraCuartel->setFechaTermino(STRTOUPPER($myrow["FECHA_TERMINO"]));
			$actividadFueraCuartel->setFechaInicioReal(STRTOUPPER($myrow["FECHA_INICIO_REAL"]));
			$actividadFueraCuartel->setFechaTerminoReal(STRTOUPPER($myrow["FECHA_TERMINO_REAL"]));
			$actividadFueraCuartel->setUsuarioProservipol(STRTOUPPER($myrow["FUN_CODIGO_UNIDAD"]));
			$actividadFueraCuartel->setUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$actividadFueraCuartel->setTipoActividad(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
			
			$personal = new funcionario;
			$personal->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$personal->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$personal->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$personal->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$personal->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$personal->setActividadFueraCuartel($actividadFueraCuartel);
			
			$funcionarios[$i] = $personal;
			$i++;
		}
	}
	
	function mensajeActividadFueraCuartel($unidad, $fecha, $servicios){
		
        $sql = "SELECT 
					F.FUN_CODIGO,
					A.UNI_CODIGO,
					F.FUN_APELLIDOPATERNO,
					F.FUN_APELLIDOMATERNO,
					F.FUN_NOMBRE,
					F.FUN_NOMBRE2,
					G.GRA_DESCRIPCION,
					T.TSERV_DESCRIPCION,
					A.FUN_RUT,
					A.FECHA_INICIO,
					A.FECHA_TERMINO,
					A.NOMBRE_ARCHIVO,
					A.ESTADO
				FROM FUNCIONARIO F
				JOIN GRADO G ON (G.ESC_CODIGO = F.ESC_CODIGO) AND (G.GRA_CODIGO = F.GRA_CODIGO)
				JOIN ACTIVIDAD_FUERA_CUARTEL A ON (A.FUN_RUT = F.FUN_RUT)
				JOIN TIPO_SERVICIO T ON (A.TIPO_ACTIVIDAD = T.TSERV_CODIGO)
				WHERE A.UNI_CODIGO = {$unidad} AND A.FECHA_REGISTRO = '{$fecha}'";
        
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			
			$grado = new grado;
			$grado->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
			
			$actividadFueraCuartel = new actividadFueraCuartel;
			$actividadFueraCuartel->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
			$actividadFueraCuartel->setTipoActividad(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
			$actividadFueraCuartel->setEstado($myrow["ESTADO"]);
			
			$personal = new funcionario;
			$personal->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$personal->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$personal->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$personal->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$personal->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$personal->setGrado($grado);
			
			$personal->setActividadFueraCuartel($actividadFueraCuartel);
			
			$servicios[$i] = $personal;
			$i++;
		}
	}
	
	function rutUsuario($codigo, $funcionarios){
		$sql = "SELECT F.FUN_RUT
				FROM FUNCIONARIO F
				WHERE F.FUN_CODIGO = '{$codigo}'";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
			$funcionario = new funcionario;
			$funcionario->setRutFuncionario($myrow["FUN_RUT"]);
			$funcionarios[$i] = $funcionario;
			$i++;
		}
	}
	
	function buscarFuncionarioActividadFueraCuartel($rut, $funcionarios){
		
  	 	$sql = "SELECT
					F.FUN_CODIGO,
					F.FUN_RUT,
					F.ESC_CODIGO,
					F.GRA_CODIGO,
					G.GRA_DESCRIPCION,
					F.FUN_APELLIDOPATERNO,
					F.FUN_APELLIDOMATERNO,
					F.FUN_NOMBRE,
					F.FUN_NOMBRE2,
					U.UNI_CODIGO,
					U.UNI_DESCRIPCION,
					C.CAR_CODIGO,
					C.CAR_DESCRIPCION,
					CF.FECHA_DESDE,
					CF.CUADRANTE_CODIGO,
					CF.UNI_AGREGADO AS COD_AGREGADO,
					U1.UNI_DESCRIPCION AS DES_AGREGADO,
					CF.CANT_DIAS
				FROM CARGO_FUNCIONARIO CF
				JOIN FUNCIONARIO F ON (F.FUN_CODIGO = CF.FUN_CODIGO AND CF.UNI_CODIGO = F.UNI_CODIGO)
				JOIN GRADO G ON (G.ESC_CODIGO = F.ESC_CODIGO) AND (G.GRA_CODIGO = F.GRA_CODIGO)
				JOIN CARGO C ON (CF.CAR_CODIGO = C.CAR_CODIGO)
				JOIN UNIDAD U ON (CF.UNI_CODIGO = U.UNI_CODIGO)
				LEFT JOIN UNIDAD U1 ON (CF.UNI_AGREGADO = U1.UNI_CODIGO)
				WHERE CF.FECHA_HASTA IS NULL AND CF.CAR_CODIGO NOT IN (1000,2000,3500,4000) AND F.FUN_RUT = '{$rut}'";
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$escalafon = new escalafon;
			$escalafon->setCodigo(STRTOUPPER($myrow["ESC_CODIGO"]));
			$escalafon->setDescripcion("");
			
			$grado = new grado;
			$grado->setEscalafon($escalafon);
			$grado->setCodigo(STRTOUPPER($myrow["GRA_CODIGO"]));
			$grado->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
			
			$cargo = new cargo;
			$cargo->setCodigo(STRTOUPPER($myrow["CAR_CODIGO"]));
			$cargo->setDescripcion(STRTOUPPER($myrow["CAR_DESCRIPCION"]));
			$cargo->setFechaDesde($myrow["FECHA_DESDE"]);
			$cargo->setCuadrante($myrow["CUADRANTE_CODIGO"]);
      		$cargo->setDias($myrow["CANT_DIAS"]);
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad($myrow["COD_AGREGADO"]);
			$unidadAgregado->setDescripcionUnidad($myrow["DES_AGREGADO"]);
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
			
			$funcionario = new funcionario;
			$funcionario->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$funcionario->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$funcionario->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$funcionario->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$funcionario->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
			$funcionario->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$funcionario->setGrado($grado);
			$funcionario->setCargo($cargo);
			$funcionario->setUnidad($unidad);
			$funcionario->setUnidadAgregado($unidadAgregado);
			
			$funcionarios[$i] = $funcionario;
			$i++;
		}
	}
	
	function listaServiciosPorFuncionario($funcionario, $fecha1, $fecha2, $servicios){
		$sql = "SELECT 
					UNIDAD.UNI_DESCRIPCION,
					TIPO_SERVICIO.TSERV_DESCRIPCION,
					SERVICIO.FECHA
				FROM FUNCIONARIO_SERVICIO
				JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				LEFT JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE FUNCIONARIO_SERVICIO.FUN_CODIGO = '{$funcionario}' AND  SERVICIO.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}' AND SERVICIO.TSERV_CODIGO <> '717'
				ORDER BY SERVICIO.FECHA DESC";
		//echo $sql;
		$i=0;
		$servicios = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			
			$unidad = new unidad;
			$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
			
			$tipoServicio = new tipoServicio;
			$tipoServicio->setDescripcion($myrow["TSERV_DESCRIPCION"]);
			
			$servicio = new servicio;
			$servicio->setUnidad($unidad);
			$servicio->setFecha($myrow["FECHA"]);
			$servicio->setTipoServicio($tipoServicio);
			
			$servicios[$i] = $servicio;
			$i++;
		}
	}
	
	function buscaFichaActividad($codActividad, $codUnidad, $funcionarios){
		$sql = "SELECT 
					A.COD_ACTIVIDAD_FUERA_CUARTEL,
					F.FUN_CODIGO,
					F.FUN_RUT,
					F.UNI_CODIGO,
					F.FUN_APELLIDOPATERNO,
					F.FUN_APELLIDOMATERNO,
					F.FUN_NOMBRE,
					F.FUN_NOMBRE2,
					A.FECHA_REGISTRO,
					A.FECHA_INICIO,
					A.FECHA_TERMINO,
					A.FECHA_INICIO_REAL,
					A.FECHA_TERMINO_REAL,
					A.TIPO_ACTIVIDAD,
					A.NUM_DOCUMENTO
				FROM ACTIVIDAD_FUERA_CUARTEL A 
				JOIN FUNCIONARIO F ON A.FUN_RUT = F.FUN_RUT
				WHERE A.COD_ACTIVIDAD_FUERA_CUARTEL = '{$codActividad}' AND A.UNI_CODIGO = '{$codUnidad}' AND A.ESTADO = 1";
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){

			$actividadFueraCuartel = new actividadFueraCuartel;
			$actividadFueraCuartel->setCodActividadFueraCuartel(STRTOUPPER($myrow["COD_ACTIVIDAD_FUERA_CUARTEL"]));
			$actividadFueraCuartel->setFechaInicio(STRTOUPPER($myrow["FECHA_INICIO"]));
			$actividadFueraCuartel->setFechaTermino(STRTOUPPER($myrow["FECHA_TERMINO"]));
			$actividadFueraCuartel->setFechaInicioReal(STRTOUPPER($myrow["FECHA_INICIO_REAL"]));
			$actividadFueraCuartel->setFechaTerminoReal(STRTOUPPER($myrow["FECHA_TERMINO_REAL"]));
			$actividadFueraCuartel->setFechaRegistro(STRTOUPPER($myrow["FECHA_REGISTRO"]));
			$actividadFueraCuartel->setTipoActividad(STRTOUPPER($myrow["TIPO_ACTIVIDAD"]));
			$actividadFueraCuartel->setNumDocumento(STRTOUPPER($myrow["NUM_DOCUMENTO"]));
			
			$funcionario = new funcionario;
			$funcionario->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$funcionario->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$funcionario->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$funcionario->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$funcionario->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
			$funcionario->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$funcionario->setUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			
			$funcionario->setActividadFueraCuartel($actividadFueraCuartel);
			$funcionarios[$i] = $funcionario;
			$i++;
		}
	}
	
	function listaServiciosValidados($fecha1, $fecha2, $codigoFuncionario, $servicios){
		$sql = "SELECT S.FECHA_SERVICIOS
				FROM CARGO_FUNCIONARIO CF 
				JOIN MARCELO_FECHA MF ON MF.FECHA BETWEEN CF.FECHA_DESDE AND IF(CF.FECHA_HASTA IS NULL, '".$fecha2."', DATE_ADD(CF.FECHA_HASTA, INTERVAL -1 DAY)) AND MF.FECHA BETWEEN '{$fecha1}' AND '{$fecha2}'
				JOIN SERVICIOS_CERTIFICADO S ON S.UNI_CODIGO = IF(ISNULL(CF.UNI_AGREGADO),CF.UNI_CODIGO,CF.UNI_AGREGADO) AND S.FECHA_SERVICIOS = MF.FECHA 
				WHERE CF.FUN_CODIGO = '{$codigoFuncionario}'
				ORDER BY S.FECHA_SERVICIOS ASC";
		//echo $sql;
		$i=0;
		$servicios = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			$servicio = new servicio;
			$servicio->setFecha($myrow["FECHA_SERVICIOS"]);
			$servicios[$i] = $servicio;
			$i++;
		}
	}

	function nuevaActividad($funcionario){
		$sql = "INSERT ACTIVIDAD_FUERA_CUARTEL 
					(NUM_DOCUMENTO,
  					FUN_RUT,
  					UNI_CODIGO,
  					FECHA_INICIO,
  					FECHA_TERMINO,
					FECHA_INICIO_REAL,
  					FECHA_TERMINO_REAL,
  					TIPO_ACTIVIDAD,
  					DIR_IP_UNIDAD,
  					FUN_CODIGO_UNIDAD,
  					FECHA_REGISTRO) VALUES 
			 	   ('{$funcionario->getNumDocumento()}',
			 	    '{$funcionario->getRutFuncionario()}',
			 	    '{$funcionario->getUnidad()}',
			 	    '{$funcionario->getFechaInicio()}',
			 	    '{$funcionario->getFechaTermino()}',
			 	    '{$funcionario->getFechaInicio()}',
			 	    '{$funcionario->getFechaTermino()}',
			 	   	'{$funcionario->getTipoActividad()}',
			 	    '{$funcionario->getIp()}',
			 	    '{$funcionario->getUsuarioProservipol()}',
			 	    '{$funcionario->getFechaRegistro()}')";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
	 	return $result;
	}
	
	function cargarListaServicio($funcionario){
		$sql = "SELECT CF.FUN_CODIGO, MF.FECHA, IF(CF.UNI_AGREGADO IS NULL, CF.UNI_CODIGO, CF.UNI_AGREGADO) COD_UNIDAD
				FROM CARGO_FUNCIONARIO CF
				JOIN MARCELO_FECHA MF ON MF.FECHA BETWEEN CF.FECHA_DESDE AND IF(CF.FECHA_HASTA IS NULL, '{$funcionario->getFechaTermino()}', DATE_ADD(CF.FECHA_HASTA, INTERVAL -1 DAY))
				WHERE MF.FECHA BETWEEN '{$funcionario->getFechaInicio()}' AND '{$funcionario->getFechaTermino()}'
				AND CF.FUN_CODIGO = '{$funcionario->getCodigoFuncionario()}'
				ORDER BY MF.FECHA ASC";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$listaEstados = array();
		while($myrow = mysql_fetch_array($result)){
			array_push($listaEstados, array(
    		"codFuncionario"	=> $myrow["FUN_CODIGO"],
    		"tipoActividad"	 	=> $funcionario->getTipoActividad(),
   			"fecha" 			=> $myrow["FECHA"],
   			"codUnidad" 		=> $myrow["COD_UNIDAD"],
			));
		}
		return $listaEstados;
	}
	
	function cargarListaFuncionarioServicio($funcionario){
		$sql = "SELECT 
					CF.FUN_CODIGO, 
					MF.FECHA, 
					IF(CF.UNI_AGREGADO IS NULL, CF.UNI_CODIGO, CF.UNI_AGREGADO) COD_UNIDAD,
					(SELECT MAX(SS.CORRELATIVO_SERVICIO) AS CORRELATIVO
				FROM SERVICIO SS 
				WHERE SS.UNI_CODIGO = IF(CF.UNI_AGREGADO IS NULL, CF.UNI_CODIGO, CF.UNI_AGREGADO)) CORRELATIVO
				FROM CARGO_FUNCIONARIO CF
				JOIN MARCELO_FECHA MF ON MF.FECHA BETWEEN CF.FECHA_DESDE AND IF(CF.FECHA_HASTA IS NULL, '{$funcionario->getFechaTermino()}', DATE_ADD(CF.FECHA_HASTA, INTERVAL -1 DAY))
				WHERE MF.FECHA BETWEEN '{$funcionario->getFechaInicio()}' AND '{$funcionario->getFechaTermino()}'
				AND CF.FUN_CODIGO = '{$funcionario->getCodigoFuncionario()}'
				ORDER BY MF.FECHA DESC";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$listaEstados = array();
		$UnidadAnterior = "";
		while($myrow = mysql_fetch_array($result)){
			(count($listaEstados)==0||$UnidadAnterior!=$myrow["COD_UNIDAD"]) ? $correlativo = $myrow["CORRELATIVO"] : $correlativo-- ;
			array_push($listaEstados, array(
    		"codFuncionario"	=> $myrow["FUN_CODIGO"],
    		"tipoActividad"		=> $funcionario->getTipoActividad(),
   			"fecha" 			=> $myrow["FECHA"],
   			"codUnidad" 		=> $myrow["COD_UNIDAD"],
   			"correlativo" 		=> $correlativo,
			));
			$UnidadAnterior = $myrow["COD_UNIDAD"];
		}
		return $listaEstados;
	}
	
	function insertNuevoServicio($listaServicios){
		$sql = "INSERT INTO SERVICIO (UNI_CODIGO,TSERV_CODIGO,FECHA,HORA_INICIO,HORA_TERMINO) VALUES";
			for($i=0;$i< count($listaServicios);$i++){
			$sql .= "({$listaServicios[$i]["codUnidad"]},'{$listaServicios[$i]["tipoActividad"]}','{$listaServicios[$i]["fecha"]}','',''),";
		}
		$sql = substr($sql, 0, strlen($sql)-1);
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
    	return $result;
	}
	
	function insertFuncionariosServicio($listaServicios){
		$sql = "INSERT INTO FUNCIONARIO_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, NUMERO_MEDIO, FACT_CODIGO) VALUES";
		for ($i=0;$i< count($listaServicios);$i++){
    		$sql .= "({$listaServicios[$i]["codUnidad"]},{$listaServicios[$i]["correlativo"]},'{$listaServicios[$i]["codFuncionario"]}',1,NULL),";
    	}
		$sql = substr($sql, 0, strlen($sql)-1);
		$result = $this->execstmt($this->Conecta(),$sql);
		return $result;
	}
	
	function anularActividad($actividad){
		$sql = "UPDATE ACTIVIDAD_FUERA_CUARTEL 
				SET ESTADO = 0
				,FECHA_MODIFICA = '{$actividad->getFechaRegistro()}'
				,DIR_IP_MODIFICA = '{$actividad->getIp()}'
				,FUN_CODIGO_MODIFICA = '{$actividad->getUsuarioProservipol()}'
				WHERE COD_ACTIVIDAD_FUERA_CUARTEL = '{$actividad->getCodActividadFueraCuartel()}'
				AND UNI_CODIGO = '{$actividad->getUnidad()}' AND ESTADO = 1";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function suspenderActividad($actividad){
		$sql = "UPDATE ACTIVIDAD_FUERA_CUARTEL 
				SET FECHA_TERMINO_REAL = '{$actividad->getFechaTerminoReal()}'
				,FECHA_MODIFICA = '{$actividad->getFechaRegistro()}'
				,DIR_IP_MODIFICA = '{$actividad->getIp()}'
				,FUN_CODIGO_MODIFICA = '{$actividad->getUsuarioProservipol()}'
				WHERE COD_ACTIVIDAD_FUERA_CUARTEL = '{$actividad->getCodActividadFueraCuartel()}'
				AND UNI_CODIGO = '{$actividad->getUnidad()}' AND ESTADO = 1";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}

	function cargarListaServicios($actividad){
		$sql = "SELECT SERVICIO.UNI_CODIGO,SERVICIO.CORRELATIVO_SERVICIO
				FROM FUNCIONARIO_SERVICIO
				JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO AND FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
				WHERE FUNCIONARIO_SERVICIO.FUN_CODIGO = '{$actividad->getCodigoFuncionario()}'
				AND SERVICIO.TSERV_CODIGO = '{$actividad->getTipoActividad()}'
				AND SERVICIO.FECHA BETWEEN '{$actividad->getFechaInicio()}' AND '{$actividad->getFechaTermino()}'";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$listaServicios = array();
		while($myrow = mysql_fetch_array($result)){
			array_push($listaServicios, array(
   			"codUnidad"			=> $myrow["UNI_CODIGO"],
   			"correlativo"		=> $myrow["CORRELATIVO_SERVICIO"],
   			"codFuncionario"	=> $actividad->getCodigoFuncionario(),
			));
		}
		return $listaServicios;
  	}
	
	function borrarFuncionariosServicio($listaServicios){
	 	$sql = "DELETE FROM FUNCIONARIO_SERVICIO WHERE ";
		for($i=0;$i< count($listaServicios);$i++){
	  		$sql .= "(UNI_CODIGO={$listaServicios[$i]["codUnidad"]} AND FUN_CODIGO = '{$listaServicios[$i]["codFuncionario"]}' AND CORRELATIVO_SERVICIO = {$listaServicios[$i]["correlativo"]}) OR ";
	  	}
		$sql = substr($sql, 0, strlen($sql)-4);
		$result = $this->execstmt($this->Conecta(),$sql);
		//echo $sql ."\n\n";
		mysql_close();
    	return $result;
  	}
	
	function deleteServicio($listaServicios){
	  	$sql = "DELETE FROM SERVICIO WHERE ";
		for($i=0;$i< count($listaServicios);$i++){
	  		$sql .= "(CORRELATIVO_SERVICIO = {$listaServicios[$i]["correlativo"]} AND UNI_CODIGO = {$listaServicios[$i]["codUnidad"]}) OR ";
	  	}
		$sql = substr($sql, 0, strlen($sql)-4);
		$result = $this->execstmt($this->Conecta(),$sql);
		//echo $sql ."\n\n";
		mysql_close();
    	return $result;
	}

}//end class
?>