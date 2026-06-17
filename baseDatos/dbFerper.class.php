<?
Class dbFerper extends Conexion {
	
	function listaTotalFuncionarios($Unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $funcionarios){
		
		$FechaHoy = date("Y-m-d");
		
		if ($NombreCampo == "codigo")  $campoOrdenar = "FUNCIONARIO.FUN_CODIGO {$TipoOrden}";
		if ($NombreCampo == "nombre") $campoOrdenar = "FUNCIONARIO.FUN_APELLIDOPATERNO {$TipoOrden}, FUNCIONARIO.FUN_APELLIDOMATERNO {$TipoOrden}, FUNCIONARIO.FUN_NOMBRE {$TipoOrden}";
		if ($NombreCampo == "permiso") $campoOrdenar = "TIPO_SERVICIO.TSERV_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "fechaI")  $campoOrdenar = "FERPER.FECHA_INICIO {$TipoOrden}";
		if ($NombreCampo == "fechaT")  $campoOrdenar = "FERPER.FECHA_TERMINO {$TipoOrden}";
		if ($NombreCampo == "archivo")  $campoOrdenar = "FUNCIONARIO.FUN_CODIGO {TipoOrden}";
		if ($NombreCampo == "constancia")  $campoOrdenar = "FUNCIONARIO.FUN_CODIGO {$TipoOrden}";
		if ($NombreCampo == "") $campoOrdenar = "FUNCIONARIO.FUN_CODIGO {$TipoOrden}";
		
		$sql = "SELECT 
				        FUNCIONARIO.FUN_CODIGO,
				        FUNCIONARIO.UNI_CODIGO,
				        FUNCIONARIO.FUN_APELLIDOPATERNO,
				        FUNCIONARIO.FUN_APELLIDOMATERNO,
				        FUNCIONARIO.FUN_NOMBRE,
				        FUNCIONARIO.FUN_NOMBRE2,
				        FERPER.TIPO_PERMISO,
				        TIPO_SERVICIO.TSERV_DESCRIPCION,
				        FERPER.FOLIO_PERMISO,
				        FERPER.FUN_RUT,
				        FERPER.FUN_CODIGO_UNIDAD,
				        FERPER.FECHA_INICIO,
				        FERPER.FECHA_TERMINO,
				        FERPER.FECHA_TERMINO_REAL,
				        FERPER.NOMBRE_ARCHIVO
				    FROM FUNCIONARIO
				    JOIN FERPER ON (FUNCIONARIO.FUN_RUT = FERPER.FUN_RUT)
				    JOIN TIPO_SERVICIO ON (FERPER.TIPO_PERMISO = TIPO_SERVICIO.TSERV_CODIGO)
				    WHERE FERPER.UNI_CODIGO = '{$Unidad}' AND FERPER.ESTADO_PERMISO = 1";
		
		if ($nombreBuscar == ""){
			$sql .= " AND CURDATE() BETWEEN FERPER.FECHA_INICIO AND FERPER.FECHA_TERMINO";
		}
		else{
			if($nombreBuscar[0]==" ") $nombreBuscar = SUBSTR($nombreBuscar, 1);
			
			$sql .= " AND (FUNCIONARIO.FUN_APELLIDOPATERNO like '%{$nombreBuscar}%' 
								OR FUNCIONARIO.FUN_APELLIDOMATERNO like '%{$nombreBuscar}%' 
								OR FUNCIONARIO.FUN_NOMBRE like '%{$nombreBuscar}%'
								OR CONCAT(FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_APELLIDOPATERNO) like '%{$nombreBuscar}%'
								OR CONCAT(FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_NOMBRE) like '%{$nombreBuscar}%'
								OR CONCAT(FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_APELLIDOMATERNO) like '%{$nombreBuscar}%'
								OR CONCAT(FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_APELLIDOMATERNO) like '%{$nombreBuscar}%'
								OR CONCAT(FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_NOMBRE2,' ',FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_APELLIDOMATERNO) like '%{$nombreBuscar}%'
								OR CONCAT(FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_APELLIDOMATERNO,' ',FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_NOMBRE2) like '%{$nombreBuscar}%'
								OR CONCAT(FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_NOMBRE2) like '%{$nombreBuscar}%'
								OR CONCAT(FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_APELLIDOMATERNO,', ',FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_NOMBRE2) like '%{$nombreBuscar}%')";
		}
		
		$sql .= " ORDER BY FUNCIONARIO.FUN_CODIGO, FERPER.FECHA_INICIO";
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$Permiso = new ferper;
			$Permiso->setTipoPermiso(STRTOUPPER($myrow["TIPO_PERMISO"]));
			$Permiso->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
			$Permiso->setFolio(STRTOUPPER($myrow["FOLIO_PERMISO"]));
			$Permiso->setFechaInicio(STRTOUPPER($myrow["FECHA_INICIO"]));
			$Permiso->setFechaTermino(STRTOUPPER($myrow["FECHA_TERMINO"]));
			$Permiso->setFechaTerminoReal(STRTOUPPER($myrow["FECHA_TERMINO_REAL"]));
			$Permiso->setArchivoPermiso(STRTOUPPER($myrow["NOMBRE_ARCHIVO"]));
			$Permiso->setUsuarioProservipol(STRTOUPPER($myrow["FUN_CODIGO_UNIDAD"]));
			
			$persona = new funcionario;
			$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$persona->setTipoPermiso($Permiso);
			$persona->setDescripcionPermiso(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
			
			$funcionarios[$i] = $persona;
			$i++;
		}
	}
	
	function mensajePermiso($unidad, $fecha, $servicios){
		$sql = "SELECT 
					FUNCIONARIO.FUN_CODIGO,
					FUNCIONARIO.UNI_CODIGO,
					FUNCIONARIO.FUN_APELLIDOPATERNO,
					FUNCIONARIO.FUN_APELLIDOMATERNO,
					FUNCIONARIO.FUN_NOMBRE,
					FUNCIONARIO.FUN_NOMBRE2,
					GRADO.GRA_DESCRIPCION,
					FERPER.TIPO_PERMISO,
					TIPO_SERVICIO.TSERV_DESCRIPCION,
					FERPER.FOLIO_PERMISO,
					FERPER.FUN_RUT,
					FERPER.FECHA_INICIO,
					FERPER.FECHA_TERMINO,
					FERPER.NOMBRE_ARCHIVO,
					FERPER.ESTADO_PERMISO
				FROM FUNCIONARIO
				JOIN GRADO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
				JOIN FERPER ON (FUNCIONARIO.FUN_RUT = FERPER.FUN_RUT)
				JOIN TIPO_SERVICIO ON (FERPER.TIPO_PERMISO = TIPO_SERVICIO.TSERV_CODIGO)
				WHERE FERPER.UNI_CODIGO={$unidad} AND FERPER.FECHA_REGISTRO = '{$fecha}'";
		//echo $sql;
		$servicios = "";
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
			
			$permiso = new ferper;
			$permiso->setTipoPermiso(STRTOUPPER($myrow["TIPO_PERMISO"]));
			$permiso->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
			$permiso->setFolio(STRTOUPPER($myrow["FOLIO_PERMISO"]));
			$permiso->setEstadoPermiso(STRTOUPPER($myrow["ESTADO_PERMISO"]));
			
			$persona = new funcionario;
			$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$persona->setGrado($grado);
			
			$persona->setTipoPermiso(STRTOUPPER($myrow["ESTADO_PERMISO"]));
			$persona->setDescripcionPermiso(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
			
			$servicios[$i] = $persona;	
			$i++;
		}
	}
	
	function rutUsuario($codigo, $funcionarios){
		$sql = "SELECT FUNCIONARIO.FUN_RUT
				FROM FUNCIONARIO
				WHERE FUNCIONARIO.FUN_CODIGO = '{$codigo}'";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$funcionarios = "";
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
			$funcionario = new funcionario;
			$funcionario->setRutFuncionario($myrow["FUN_RUT"]);
			$funcionarios[$i] = $funcionario;
			$i++;
		}
	}	
	
	function buscarFuncionarioPermiso($rut, $funcionarios){
		
		$sql = "SELECT
					FUNCIONARIO.FUN_CODIGO,
					FUNCIONARIO.FUN_RUT,
					FUNCIONARIO.ESC_CODIGO,
					FUNCIONARIO.GRA_CODIGO,
					GRADO.GRA_DESCRIPCION,
					FUNCIONARIO.FUN_APELLIDOPATERNO,
					FUNCIONARIO.FUN_APELLIDOMATERNO,
					FUNCIONARIO.FUN_NOMBRE,
					FUNCIONARIO.FUN_NOMBRE2,
					UNIDAD.UNI_CODIGO,
					UNIDAD.UNI_DESCRIPCION,
					CARGO.CAR_CODIGO,
					CARGO.CAR_DESCRIPCION,
					CARGO_FUNCIONARIO.FECHA_DESDE,
					CARGO_FUNCIONARIO.CUADRANTE_CODIGO,
					CARGO_FUNCIONARIO.UNI_AGREGADO AS COD_AGREGADO,
					UNIDAD1.UNI_DESCRIPCION AS DES_AGREGADO,
					CARGO_FUNCIONARIO.CANT_DIAS
				FROM GRADO
				JOIN FUNCIONARIO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
				JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				LEFT JOIN UNIDAD ON (FUNCIONARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				LEFT JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
				LEFT JOIN UNIDAD UNIDAD1 ON (CARGO_FUNCIONARIO.UNI_AGREGADO = UNIDAD1.UNI_CODIGO)
				WHERE CARGO_FUNCIONARIO.FECHA_HASTA IS NULL	AND CARGO_FUNCIONARIO.CAR_CODIGO NOT IN(1000,2000,3005,3500,4000) 
				AND IFNULL(CARGO_FUNCIONARIO.UNI_AGREGADO,0) NOT IN (1)
				AND FUNCIONARIO.FUN_RUT = '{$rut}'";
		//echo $sql;
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

	function listaPermiso($folio,$servicios){
		$sql = "SELECT FERPER.FOLIO_PERMISO
	         	FROM FERPER
				WHERE FERPER.FOLIO_PERMISO = 'N24-{$folio}' AND ESTADO_PERMISO = 1";
		//echo $sql;
		$i=0;
		$servicios = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			$servicio = new ferper;
			$servicio->setFolio($myrow["FOLIO_PERMISO"]);
			$servicio->setRutFuncionario($myrow["FUN_RUT"]);
			$servicios[$i] = $servicio;
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
	
	function cargarListaServicio($funcionario){
		$sql = "SELECT CF.FUN_CODIGO, MF.FECHA, IF(CF.UNI_AGREGADO IS NULL, CF.UNI_CODIGO, CF.UNI_AGREGADO) COD_UNIDAD
				FROM CARGO_FUNCIONARIO CF
				JOIN MARCELO_FECHA MF ON MF.FECHA BETWEEN CF.FECHA_DESDE AND IF(CF.FECHA_HASTA IS NULL, '{$funcionario->getFechaTermino()}', DATE_ADD(CF.FECHA_HASTA, INTERVAL -1 DAY))
				WHERE MF.FECHA BETWEEN '{$funcionario->getFechaInicio()}' AND '{$funcionario->getFechaTermino()}'
				AND CF.FUN_CODIGO = '{$funcionario->getCodigoFuncionario()}'
				ORDER BY MF.FECHA ASC";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$listaEstados = array();
		while($myrow = mysql_fetch_array($result)){
			array_push($listaEstados, array(
    		"codFuncionario"	=> $myrow["FUN_CODIGO"],
    		"tipoPermiso"	 	=> $funcionario->getTipoPermiso(),
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
    		"tipoPermiso"		=> $funcionario->getTipoPermiso(),
   			"fecha" 			=> $myrow["FECHA"],
   			"codUnidad" 		=> $myrow["COD_UNIDAD"],
   			"correlativo" 		=> $correlativo,
			));
			$UnidadAnterior = $myrow["COD_UNIDAD"];
		}
		return $listaEstados;
	}
	
	function nuevoPermiso($funcionario){
		$sql = "INSERT FERPER 
					(FOLIO_PERMISO,
  					FUN_RUT,
  					UNI_CODIGO,
  					FECHA_INICIO,
  					FECHA_TERMINO,
  					FECHA_TERMINO_REAL,
  					TIPO_PERMISO,
  					NOMBRE_ARCHIVO,
  					DIR_IP_UNIDAD,
  					FUN_CODIGO_UNIDAD,
  					FECHA_REGISTRO) VALUES 
			 	   ('N24-{$funcionario->getFolio()}',
			 	    '{$funcionario->getRutFuncionario()}',
			 	    '{$funcionario->getUnidad()}',
			 	    '{$funcionario->getFechaInicio()}',
			 	    '{$funcionario->getFechaTermino()}',
			 	    '{$funcionario->getFechaTermino()}',
			 	   	'{$funcionario->getTipoPermiso()}',
			 	    'N24-{$funcionario->getArchivoPermiso()}',
			 	    '{$funcionario->getIp()}',
			 	    '{$funcionario->getUsuarioProservipol()}',
			 	    '{$funcionario->getFechaRegistro()}')";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
	 	return $result;
	}
	
	function insertNuevoServicio($listaServicios){
		$sql = "INSERT INTO SERVICIO (UNI_CODIGO,TSERV_CODIGO,FECHA,HORA_INICIO,HORA_TERMINO) VALUES";
			for($i=0;$i< count($listaServicios);$i++){
			$sql .= "({$listaServicios[$i]["codUnidad"]},'{$listaServicios[$i]["tipoPermiso"]}','{$listaServicios[$i]["fecha"]}','',''),";
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
	
	function buscaFichaPermiso($codFuncionario, $folio, $funcionarios){
		$sql = "SELECT 
					FUNCIONARIO.FUN_CODIGO,
					FUNCIONARIO.FUN_RUT,
					FERPER.FOLIO_PERMISO,
					FERPER.UNI_CODIGO,
					FUNCIONARIO.FUN_APELLIDOPATERNO,
					FUNCIONARIO.FUN_APELLIDOMATERNO,
					FUNCIONARIO.FUN_NOMBRE,
					FUNCIONARIO.FUN_NOMBRE2,
					FERPER.FECHA_REGISTRO,
					FERPER.FECHA_INICIO,
					FERPER.FECHA_TERMINO,
					FERPER.FECHA_TERMINO_REAL,
					FERPER.TIPO_PERMISO,
					FERPER.NOMBRE_ARCHIVO
				FROM FUNCIONARIO
				JOIN FERPER ON FERPER.FUN_RUT = FUNCIONARIO.FUN_RUT
				WHERE FUNCIONARIO.FUN_CODIGO = '{$codFuncionario}' AND FERPER.FOLIO_PERMISO = '{$folio}' AND FERPER.ESTADO_PERMISO = 1";
	  	//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){

			$permiso = new ferper;
			$permiso->setFolio(STRTOUPPER($myrow["FOLIO_PERMISO"]));
			$permiso->setFechaInicio(STRTOUPPER($myrow["FECHA_INICIO"]));
			$permiso->setFechaTermino(STRTOUPPER($myrow["FECHA_TERMINO"]));
			$permiso->setFechaTerminoReal(STRTOUPPER($myrow["FECHA_TERMINO_REAL"]));
			$permiso->setFechaRegistro(STRTOUPPER($myrow["FECHA_REGISTRO"]));
			$permiso->setTipoPermiso(STRTOUPPER($myrow["TIPO_PERMISO"]));
			$permiso->setArchivoPermiso(STRTOUPPER($myrow["NOMBRE_ARCHIVO"]));
			
			$funcionario = new funcionario;
			$funcionario->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$funcionario->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$funcionario->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$funcionario->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$funcionario->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
			$funcionario->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$funcionario->setUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			
			$funcionario->setTipoPermiso($permiso);
			$funcionarios[$i] = $funcionario;
			$i++;
		}
	}
	
	function PermisoAnulado($folio, $servicios){
		$sql = "SELECT 
					FERPER.FOLIO_PERMISO,
					MAX(FERPER.ESTADO_PERMISO) ESTADO
           		FROM FERPER
				WHERE FERPER.FOLIO_PERMISO = '{$folio}'";
		//echo $sql;
		$i=0;
		$servicios = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			$servicio = new ferper;
			$servicio->setFolio($myrow["FOLIO_PERMISO"]);
			$servicio->setEstadoPermiso($myrow["ESTADO"]);
			$servicios[$i] = $servicio;
			$i++;
		}
	}
	
	function anularPermiso($permiso){
		$sql = "UPDATE FERPER 
				SET ESTADO_PERMISO = {$permiso->getEstadoPermiso()} 
				,FECHA_MODIFICA = '{$permiso->getFechaRegistro()}'
				,DIR_IP_MODIFICA = '{$permiso->getIp()}'
				,FUN_CODIGO_MODIFICA = '{$permiso->getUsuarioProservipol()}'
				WHERE FOLIO_PERMISO = '{$permiso->getFolio()}' AND ESTADO_PERMISO = 1";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
 	function suspenderPermiso($permiso){
		$sql = "UPDATE FERPER 
				SET FECHA_TERMINO_REAL = '{$permiso->getFechaInicio()}'
				,FECHA_MODIFICA = '{$permiso->getFechaRegistro()}'
				,DIR_IP_MODIFICA = '{$permiso->getIp()}'
				,FUN_CODIGO_MODIFICA = '{$permiso->getUsuarioProservipol()}'
				WHERE FOLIO_PERMISO = '{$permiso->getFolio()}' AND ESTADO_PERMISO = 1";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function cargarListaServiciosPermiso($permiso){
		$sql = "SELECT SERVICIO.UNI_CODIGO,SERVICIO.CORRELATIVO_SERVICIO
				FROM FUNCIONARIO_SERVICIO
				JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO AND FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
				WHERE FUNCIONARIO_SERVICIO.FUN_CODIGO = '{$permiso->getCodigoFuncionario()}'
				AND SERVICIO.TSERV_CODIGO = '{$permiso->getTipoPermiso()}'
				AND SERVICIO.FECHA BETWEEN '{$permiso->getFechaInicio()}' AND '{$permiso->getFechaTermino()}'";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$listaServicios = array();
		while($myrow = mysql_fetch_array($result)){
			array_push($listaServicios, array(
   			"codUnidad"			=> $myrow["UNI_CODIGO"],
   			"correlativo"		=> $myrow["CORRELATIVO_SERVICIO"],
   			"codFuncionario"	=> $permiso->getCodigoFuncionario(),
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

	function nuevoPermiso_mysqli($funcionario){

		$sql = "CALL Registrar_Ferper
			 	   ('{$funcionario->getFolio()}',
			 	    '{$funcionario->getRutFuncionario()}',
			 	    '{$funcionario->getUnidad()}',
			 	    '{$funcionario->getFechaInicio()}',
			 	    '{$funcionario->getFechaTermino()}',
			 	   	'{$funcionario->getTipoPermiso()}',
			 	    '{$funcionario->getArchivoPermiso()}',
			 	    '{$funcionario->getIp()}',
			 	    '{$funcionario->getUsuarioProservipol()}',
			 	    '{$funcionario->getFechaRegistro()}',
					'{$funcionario->getCodigoFuncionario()}')";
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['message']=='OK') ? true : false;
	}

	function suspenderPermiso_mysqli($funcionario){
		$sql = "CALL Recortar_Ferper
				('{$funcionario->getFolio()}',
				'{$funcionario->getCodigoFuncionario()}',
				'{$funcionario->getTipoPermiso()}',
				'{$funcionario->getFechaTermino()}',
				'{$funcionario->getFechaTerminoReal()}',
				'{$funcionario->getFechaRegistro()}',
				'{$funcionario->getIp()}',
				'{$funcionario->getUsuarioProservipol()}')";
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['message']=='OK') ? true : false;
	}

	function anularPermiso_mysqli($funcionario){
		$sql = "CALL Anular_Ferper
				('{$funcionario->getFolio()}',
				'{$funcionario->getCodigoFuncionario()}',
				'{$funcionario->getTipoPermiso()}',
				'{$funcionario->getFechaInicio()}',
				'{$funcionario->getFechaTerminoReal()}',
				'{$funcionario->getFechaRegistro()}',
				'{$funcionario->getIp()}',
				'{$funcionario->getUsuarioProservipol()}',
				'{$funcionario->getEstadoPermiso()}')";
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['message']=='OK') ? true : false;
	}

}//end class
?>