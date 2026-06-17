<?
Class dbLicencia extends Conexion{
			
function buscaFuncionarioLicencia($rut, $funcionarios){
		  
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
		WHERE
		  CARGO_FUNCIONARIO.FECHA_HASTA IS NULL	AND CARGO_FUNCIONARIO.CAR_CODIGO NOT IN(1000,2000,3005,3500,4000) AND
		  FUNCIONARIO.FUN_RUT = '".$rut."'";
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
      $cargo->setDias($myrow["CANT_DIAS"]); //aqui agregado
			
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

	function buscaFichaLicencia($codFuncionario, $color, $folio, $funcionarios){
	 
    $sql = "SELECT 
		  				FUNCIONARIO.FUN_CODIGO,
		  				FUNCIONARIO.FUN_RUT,
              LICENCIA_MEDICA.COLOR_LICENCIA,
              LICENCIA_MEDICA.FOLIO_LICENCIA,
              IF(CARGO_FUNCIONARIO.UNI_AGREGADO IS NULL, CARGO_FUNCIONARIO.UNI_CODIGO, CARGO_FUNCIONARIO.UNI_AGREGADO) UNIDAD,
		  				FUNCIONARIO.FUN_APELLIDOPATERNO,
		  				FUNCIONARIO.FUN_APELLIDOMATERNO,
		  				FUNCIONARIO.FUN_NOMBRE,
		  				FUNCIONARIO.FUN_NOMBRE2,
              LICENCIA_MEDICA.FECHA_OTORGAMIENTO,
              LICENCIA_MEDICA.FECHA_INICIO,
              LICENCIA_MEDICA.FECHA_TERMINO,
              LICENCIA_MEDICA.NUM_DIAS,
              LICENCIA_MEDICA.FECHA_INICIO_REAL,
              LICENCIA_MEDICA.FECHA_TERMINO_REAL,
              LICENCIA_MEDICA.TIPO_LICENCIA_MEDICA,
              LICENCIA_MEDICA.RECUERABILIDAD_LABORAL,
              LICENCIA_MEDICA.INICIO_TRAMITE_INVALIDEZ,
              LICENCIA_MEDICA.TIPO_REPOSO,
              LICENCIA_MEDICA.LUGAR_REPOSO,
              LICENCIA_MEDICA.RUT_PROFESIONAL,
              LICENCIA_MEDICA.TIPO_PROFESIONAL,
              LICENCIA_MEDICA.ESPECIALIDAD_PROFESIONAL,
              LICENCIA_MEDICA.TIPO_ATENCION,
              LICENCIA_MEDICA.RUT_HIJO,
              LICENCIA_MEDICA.FECHA_NAC_HIJO,
              LICENCIA_MEDICA.NOMBRE_ARCHIVO
					FROM FUNCIONARIO
			    JOIN LICENCIA_MEDICA ON LICENCIA_MEDICA.FUN_RUT = FUNCIONARIO.FUN_RUT
			    LEFT JOIN CARGO_FUNCIONARIO ON CARGO_FUNCIONARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO AND CARGO_FUNCIONARIO.FECHA_HASTA IS NULL
					WHERE FUNCIONARIO.FUN_CODIGO = '".$codFuncionario."'
					AND LICENCIA_MEDICA.COLOR_LICENCIA = '".$color."'
					AND LICENCIA_MEDICA.FOLIO_LICENCIA = ".$folio."
					AND LICENCIA_MEDICA.ESTADO_LICENCIA = 1";
    //echo $sql;
    	    
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			
			$licencia = new licenciaMedica;			
			$licencia->setColor(STRTOUPPER($myrow["COLOR_LICENCIA"]));
			$licencia->setFolio(STRTOUPPER($myrow["FOLIO_LICENCIA"]));
			$licencia->setFecha1(STRTOUPPER($myrow["FECHA_OTORGAMIENTO"]));
			$licencia->setFecha2(STRTOUPPER($myrow["FECHA_INICIO"]));
			$licencia->setFechaTerminoInicial(STRTOUPPER($myrow["FECHA_TERMINO"]));
			$licencia->setDias(STRTOUPPER($myrow["NUM_DIAS"]));
			$licencia->setFechaInicioReal(STRTOUPPER($myrow["FECHA_INICIO_REAL"]));
			$licencia->setFechaTerminoReal(STRTOUPPER($myrow["FECHA_TERMINO_REAL"]));
			$licencia->setTipoLicencia(STRTOUPPER($myrow["TIPO_LICENCIA_MEDICA"]));
			$licencia->setRecuperacion(STRTOUPPER($myrow["RECUERABILIDAD_LABORAL"]));
			$licencia->setInvalidez(STRTOUPPER($myrow["INICIO_TRAMITE_INVALIDEZ"]));
			$licencia->setTipoReposo(STRTOUPPER($myrow["TIPO_REPOSO"]));
			$licencia->setLugarReposo(STRTOUPPER($myrow["LUGAR_REPOSO"]));
			$licencia->setRutProfesional(STRTOUPPER($myrow["RUT_PROFESIONAL"]));
			$licencia->setTipoProfesional(STRTOUPPER($myrow["TIPO_PROFESIONAL"]));
			$licencia->setEspecialidad(STRTOUPPER($myrow["ESPECIALIDAD_PROFESIONAL"]));
			$licencia->setAtencion(STRTOUPPER($myrow["TIPO_ATENCION"]));
			$licencia->setRutHijo(STRTOUPPER($myrow["RUT_HIJO"]));
			$licencia->setFecha3(STRTOUPPER($myrow["FECHA_NAC_HIJO"]));				
			$licencia->setArchivoLicenciaMedica(STRTOUPPER($myrow["NOMBRE_ARCHIVO"]));
			
			$funcionario = new funcionario;
			$funcionario->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$funcionario->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$funcionario->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$funcionario->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$funcionario->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
			$funcionario->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$funcionario->setUnidad(STRTOUPPER($myrow["UNIDAD"]));
			
			$funcionario->setTipoLicencia($licencia);					
			$funcionarios[$i] = $funcionario;					
			$i++;
		}
	}
		
	function buscaTipoLicencia($tipoServicio){
					  	    
  	$sql = "SELECT 
						TIPO_SERVICIO.TSERV_CODIGO,
						TIPO_SERVICIO.TSERV_DESCRIPCION
					FROM TIPO_SERVICIO
					WHERE TIPO_SERVICIO.TSERV_GRUPO IN ('MATERNIDAD','ENFERMEDAD','LABORAL','PREVENTIVA')";
  	    //echo $sql;
  	    
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			
			$tipo = new tipoServicio;
 			$tipo->setCodigo(STRTOUPPER($myrow["TSERV_CODIGO"]));
 			$tipo->setDescripcion(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
	
			$tipoServicio[$i] = $tipo;
			$i++;
		}
	}
	
	function nuevaLicencia($funcionario){ 

		//$correlativoAnterior = $this->correlativoAnterior($funcionario->getUnidad();
		//$funcionario->setCorrelativo($correlativoAnterior);
		
		$sql = "INSERT LICENCIA_MEDICA (COLOR_LICENCIA,FOLIO_LICENCIA,FUN_RUT,UNI_CODIGO,FECHA_OTORGAMIENTO,FECHA_INICIO,FECHA_TERMINO,NUM_DIAS,FECHA_INICIO_REAL,FECHA_TERMINO_REAL,RUT_HIJO,FECHA_NAC_HIJO,TIPO_LICENCIA_MEDICA,RECUERABILIDAD_LABORAL,INICIO_TRAMITE_INVALIDEZ,TIPO_REPOSO,LUGAR_REPOSO,RUT_PROFESIONAL,TIPO_PROFESIONAL,ESPECIALIDAD_PROFESIONAL,TIPO_ATENCION,NOMBRE_ARCHIVO,FECHA_REGISTRO,DIR_IP_UNIDAD,FUN_CODIGO_UNIDAD,CODIGO_SELIME) VALUES
		 	   ('".$funcionario->getColor()."',
		 	    '".$funcionario->getFolio()."',
		 	    '".$funcionario->getRutFuncionario()."',
		 	    '".$funcionario->getUnidad()."',
		 	    '".$funcionario->getFecha1()."',
		 	    '".$funcionario->getFecha2()."',
		 	    '".$funcionario->getFechaTermino()."',
		 	    '".$funcionario->getDias()."',
		 	    '".$funcionario->getFechaInicioReal()."',
		 	    '".$funcionario->getFechaTermino()."',
		 	    '".$funcionario->getRutHijo()."',
		 	    '".$funcionario->getFecha3()."',
		 	    '".$funcionario->getTipoLicencia()."',
		 	    '".$funcionario->getRecuperacion()."',
		 	    '".$funcionario->getInvalidez()."',
		 	    '".$funcionario->getTipoReposo()."',
		 	    '".$funcionario->getLugarReposo()."',
		 	    '".$funcionario->getRutProfesional()."',
		 	    '".$funcionario->getTipoProfesional()."',
		 	    '".$funcionario->getEspecialidad()."',
		 	    '".$funcionario->getAtencion()."',
		 	    '".$funcionario->getArchivoLicenciaMedica()."',
		 	    '".$funcionario->getFechaRegistro()."',
		 	    '".$funcionario->getIp()."',
		 	    '".$funcionario->getUsuarioProservipol()."',
		 	    '".$funcionario->getCodigoSelime()."')";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
    //$result = 1;	
		
		if ($result == 1){
			$ultimoCorrelativo = $this->ultimoCorrelativo($servicio->getUnidad()->getCodigoUnidad());
			$servicio->setCorrelativo($ultimoCorrelativo);
			$resultInsertServicios 	= $this->insertNuevoServicio($servicio);
	  }
	}
	
	function listaTotalLicencias($Unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $funcionarios){
		
		$FechaHoy = date("Y-m-d");
		
		if ($NombreCampo == "codigo")  $campoOrdenar = "FUNCIONARIO.FUN_CODIGO ".$TipoOrden;
		if ($NombreCampo == "nombre") $campoOrdenar = "FUNCIONARIO.FUN_APELLIDOPATERNO ".$TipoOrden.", FUNCIONARIO.FUN_APELLIDOMATERNO ".$TipoOrden.", FUNCIONARIO.FUN_NOMBRE ".$TipoOrden;
		if ($NombreCampo == "licencia") $campoOrdenar = "LICENCIA_MEDICA.COLOR_LICENCIA ".$TipoOrden;
		if ($NombreCampo == "fechaI")  $campoOrdenar = "LICENCIA_MEDICA.FECHA_INICIO_REAL ".$TipoOrden;
		if ($NombreCampo == "fechaT")  $campoOrdenar = "LICENCIA_MEDICA.FECHA_TERMINO_REAL ".$TipoOrden;
		if ($NombreCampo == "archivo")  $campoOrdenar = "FUNCIONARIO.FUN_CODIGO ".$TipoOrden;
		if ($NombreCampo == "constancia")  $campoOrdenar = "FUNCIONARIO.FUN_CODIGO ".$TipoOrden;
		if ($NombreCampo == "") $campoOrdenar = "FUNCIONARIO.FUN_CODIGO ".$TipoOrden;
		
		$sql = "SELECT 
		        FUNCIONARIO.FUN_CODIGO,
		        FUNCIONARIO.UNI_CODIGO,
		        FUNCIONARIO.FUN_APELLIDOPATERNO,
		        FUNCIONARIO.FUN_APELLIDOMATERNO,
		        FUNCIONARIO.FUN_NOMBRE,
		        FUNCIONARIO.FUN_NOMBRE2,
		        LICENCIA_MEDICA.TIPO_LICENCIA_MEDICA,
		        TIPO_SERVICIO.TSERV_DESCRIPCION,
		        LICENCIA_MEDICA.COLOR_LICENCIA,
		        LICENCIA_MEDICA.FOLIO_LICENCIA,
		        LICENCIA_MEDICA.FUN_RUT,
		        LICENCIA_MEDICA.FECHA_INICIO,
		        LICENCIA_MEDICA.FECHA_INICIO_REAL,
		        LICENCIA_MEDICA.FECHA_TERMINO,
		        LICENCIA_MEDICA.FECHA_TERMINO_REAL,
		        LICENCIA_MEDICA.NOMBRE_ARCHIVO
        FROM FUNCIONARIO
        JOIN LICENCIA_MEDICA ON (FUNCIONARIO.FUN_RUT = LICENCIA_MEDICA.FUN_RUT)
        JOIN TIPO_SERVICIO ON (LICENCIA_MEDICA.TIPO_LICENCIA_MEDICA = TIPO_SERVICIO.TSERV_CODIGO)
        WHERE LICENCIA_MEDICA.UNI_CODIGO='".$Unidad."' AND LICENCIA_MEDICA.ESTADO_LICENCIA=1";
		
		if ($nombreBuscar == ""){
			$sql .= " AND CURDATE() BETWEEN LICENCIA_MEDICA.FECHA_INICIO_REAL AND LICENCIA_MEDICA.FECHA_TERMINO_REAL"; 
		}
		else{
			if($nombreBuscar[0]==" ") $nombreBuscar = SUBSTR($nombreBuscar, 1);
			
			$sql .= " AND (FUNCIONARIO.FUN_APELLIDOPATERNO like '%".$nombreBuscar."%' 
								OR FUNCIONARIO.FUN_APELLIDOMATERNO like '%".$nombreBuscar."%' 
								OR FUNCIONARIO.FUN_NOMBRE like '%".$nombreBuscar."%'
								OR CONCAT(FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_APELLIDOPATERNO) like '%".$nombreBuscar."%'
								OR CONCAT(FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_NOMBRE) like '%".$nombreBuscar."%'
								OR CONCAT(FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_APELLIDOMATERNO) like '%".$nombreBuscar."%'
								OR CONCAT(FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_APELLIDOMATERNO) like '%".$nombreBuscar."%'
								OR CONCAT(FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_NOMBRE2,' ',FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_APELLIDOMATERNO) like '%".$nombreBuscar."%'
								OR CONCAT(FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_APELLIDOMATERNO,' ',FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_NOMBRE2) like '%".$nombreBuscar."%'
								OR CONCAT(FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_NOMBRE2) like '%".$nombreBuscar."%'
								OR CONCAT(FUNCIONARIO.FUN_APELLIDOPATERNO,' ',FUNCIONARIO.FUN_APELLIDOMATERNO,', ',FUNCIONARIO.FUN_NOMBRE,' ',FUNCIONARIO.FUN_NOMBRE2) like '%".$nombreBuscar."%')";
		}
		$sql .= " ORDER BY ".$campoOrdenar;
		//echo $sql;
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
							
			$licencia = new licenciaMedica;
			$licencia->setTipoLicencia(STRTOUPPER($myrow["TIPO_LICENCIA_MEDICA"]));
			$licencia->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
			$licencia->setColor(STRTOUPPER($myrow["COLOR_LICENCIA"]));
			$licencia->setFolio(STRTOUPPER($myrow["FOLIO_LICENCIA"]));
			$licencia->setFechaInicioReal(STRTOUPPER($myrow["FECHA_INICIO_REAL"]));
			$licencia->setFecha2(STRTOUPPER($myrow["FECHA_INICIO"]));
			$licencia->setFechaTermino(STRTOUPPER($myrow["FECHA_TERMINO"]));
			$licencia->setFechaTerminoReal(STRTOUPPER($myrow["FECHA_TERMINO_REAL"]));
			$licencia->setArchivoLicenciaMedica(STRTOUPPER($myrow["NOMBRE_ARCHIVO"]));
			
			$persona = new funcionario;
			$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$persona->setTipoLicencia($licencia);
		  $persona->setDescripcionLicencia(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
			
			$funcionarios[$i] = $persona;
			$i++;
		}
	}
		
	function ultimoCorrelativo($unidad){
		
		$sql = "SELECT MAX(CORRELATIVO_SERVICIO) AS ULTIMO FROM SERVICIO WHERE UNI_CODIGO =".$unidad;
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$myrow = mysql_fetch_array($result); 
		return $myrow["ULTIMO"];
	}
	
	function insertNuevoServicio($servicio){
		
		$horaInicio="";
	  $horaTermino="";
	  $fecha_inicial=$servicio->getFechaInicioReal();
	  //$fecha_inicial=$servicio->getFecha2();
	  $numDias	= $servicio->getDias();
    /*$fecha_termino=$servicio->getFechaTermino();
    $fechaTPaso 		= explode("-",$fecha_termino);
	  $fecha_termino   = $fechaTPaso[2].$fechaTPaso[1].$fechaTPaso[0];
		
    $numDias = $fecha_inicial->diff($fecha_termino);
    $numDias = $numDias->format('%d');
    $numDias = $numDias +1;*/
		/*
    $totalDias = date('d-m-Y', strtotime("$fechaInicial + $numDias day"));
    $fecha_final = $totalDias; 
    $partesfi = explode ( "-", $fecha_inicial); 
    $partesff = explode ( "-", $fecha_final ); 

    $primera = mktime ( 0, 0, 0, date ("$partesfi[1]"), date ("$partesfi[0]"), date ("$partesfi[2]") ); 
    $segunda = mktime ( 0, 0, 0, date ("$partesff[1]"), date ("$partesff[0]"), date ("$partesff[2]") ); 
    $cuenta_dias = ($segunda - $primera) / 86400;
		*/	
    $contador = 0; 
	  
	  $sql = "INSERT INTO SERVICIO (UNI_CODIGO,TSERV_CODIGO,FECHA,HORA_INICIO,HORA_TERMINO) VALUES";
	  $existe = 0;	
		//echo $sql ."\n\n";
	for ($i = 0; $i <= $numDias ; $i++ ){
   
    /*
    $fecha_inicial = mktime ( 0, 0, 0, date ("$partesfi[1]"), date ("$partesfi[0]") + $contador, date ("$partesfi[2]") ); 
    $dias = date ( "d-m-Y", $fecha_inicial ); 
    */
    $fechaNew = date("d-m-Y",strtotime("$fecha_inicial + $i day"));
			/* if($fechaNew==$fecha_termino){
			$i = $numDias;
			}
			else{*/
    	$contador += 1;    
 			
   	 	$fechaPaso 		= explode("-",$fechaNew);
	  	$fechaGuardar   = $fechaPaso[2].$fechaPaso[1].$fechaPaso[0];
   		
     	$sql .= "(".$servicio->getUnidad().",'".$servicio->getTipoLicencia()."','".$fechaGuardar."','".$horaInicio."','".$horaTermino."'),";
    	$existe = 1;
   		// }
    	// echo $sql ."\n\n";
   	}     
 
 		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			
		 	// $result = 1;	
			if ($result  == 1) $resultInsertFuncionariosAsignados	= $this->insertFuncionariosServicio($servicio, $contador);
			//echo $resultInsertFuncionariosAsignados;
  	}
    return $result;	 					
	}

	function insertFuncionariosServicio($servicio){
			
     $numeroMedio=1;
     $factor="NULL";
		 $sql = "INSERT INTO FUNCIONARIO_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, NUMERO_MEDIO, FACT_CODIGO) VALUES";
		 $numDias	= $servicio->getDias();
		 $fecha_inicial=$servicio->getFechaInicioReal();
    	//$fecha_termino=$servicio->getFechaTermino();
    	/*
    	$numDias = ($fecha_inicial->diff($fecha_termino))+1;
      $numDias = $numDias->format('%d');
    	$numDias = $numDias +1;
    	*/
		 $correlativo=$servicio->getCorrelativo();
		 $existe = 0;	
		 for ($i = 0; $i <= $numDias; $i++ ){
		 	$correlativo += 1;
     	$sql .= "(".$servicio->getUnidad().",".$correlativo.",'".$servicio->getCodigoFuncionario()."',".$numeroMedio.",".$factor."),";
     	$existe = 1;
     }
     if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-1);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
		 return $result;
  	}
	}
	
	function listaLicenciaMedica($color, $folio,$servicios){	
								
		$sql = "SELECT 
	          LICENCIA_MEDICA.COLOR_LICENCIA,
	          LICENCIA_MEDICA.FOLIO_LICENCIA
	        FROM
	        LICENCIA_MEDICA
				 WHERE
				  LICENCIA_MEDICA.COLOR_LICENCIA = '".$color."' AND 
				  LICENCIA_MEDICA.FOLIO_LICENCIA = ".$folio." AND ESTADO_LICENCIA = 1";
							
		//echo $sql;
		
		$cont=0;
		$i=0;
		$servicios = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			
			$servicio = new licenciaMedica;
			$servicio->setColor($myrow["COLOR_LICENCIA"]);
			$servicio->setFolio($myrow["FOLIO_LICENCIA"]);
			$servicio->setRutFuncionario($myrow["FUN_RUT"]);
					
			$servicios[$i] = $servicio;
	
			$i++;
		}
	}
		
	function listaServiciosPorFuncionario($funcionario, $fecha1, $fecha2, $servicios){
		
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
				  INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
				  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
				  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE FUNCIONARIO_SERVICIO.FUN_CODIGO = '".$funcionario."' AND 
				  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."' AND
				  SERVICIO.TSERV_CODIGO <> '717'
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
	
	function listaServiciosValidados($fecha1, $fecha2, $unidad, $servicios){
		
		$sql = "SELECT S.FECHA_SERVICIOS
						FROM SERVICIOS_CERTIFICADO S
						WHERE S.FECHA_SERVICIOS BETWEEN '".$fecha1."' AND '".$fecha2."'
						AND S.UNI_CODIGO = '".$unidad."' 
					  ORDER BY S.FECHA_SERVICIOS DESC";
		
		//echo $sql;
		$cont=0;
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
	
	function mensajeLicenciaMedica($unidad, $fecha, $servicios){	
									
    $sql = "SELECT 
		        FUNCIONARIO.FUN_CODIGO,
		        FUNCIONARIO.UNI_CODIGO,
		        FUNCIONARIO.FUN_APELLIDOPATERNO,
		        FUNCIONARIO.FUN_APELLIDOMATERNO,
		        FUNCIONARIO.FUN_NOMBRE,
		        FUNCIONARIO.FUN_NOMBRE2,
		        GRADO.GRA_DESCRIPCION,
		        LICENCIA_MEDICA.TIPO_LICENCIA_MEDICA,
		        TIPO_SERVICIO.TSERV_DESCRIPCION,
		        LICENCIA_MEDICA.COLOR_LICENCIA,
		        LICENCIA_MEDICA.FOLIO_LICENCIA,
		        LICENCIA_MEDICA.FUN_RUT,
		        LICENCIA_MEDICA.FECHA_INICIO,
		        LICENCIA_MEDICA.FECHA_INICIO_REAL,
		        LICENCIA_MEDICA.FECHA_TERMINO,
		        LICENCIA_MEDICA.FECHA_TERMINO_REAL,
		        LICENCIA_MEDICA.NOMBRE_ARCHIVO,
		        LICENCIA_MEDICA.ESTADO_LICENCIA
        FROM FUNCIONARIO
        JOIN GRADO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
        JOIN LICENCIA_MEDICA ON (FUNCIONARIO.FUN_RUT = LICENCIA_MEDICA.FUN_RUT)
        JOIN TIPO_SERVICIO ON (LICENCIA_MEDICA.TIPO_LICENCIA_MEDICA = TIPO_SERVICIO.TSERV_CODIGO)
        WHERE LICENCIA_MEDICA.UNI_CODIGO=".$unidad." AND LICENCIA_MEDICA.FECHA_REGISTRO = '".$fecha."'";
						
		//echo $sql;
		$cont=0;
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
			
			$licencia = new licenciaMedica;
			$licencia->setTipoLicencia(STRTOUPPER($myrow["TIPO_LICENCIA_MEDICA"]));
			$licencia->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
			$licencia->setColor(STRTOUPPER($myrow["COLOR_LICENCIA"]));
			$licencia->setFolio(STRTOUPPER($myrow["FOLIO_LICENCIA"]));
			
			$persona = new funcionario;
			$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$persona->setGrado($grado);
		  $persona->setDescripcionLicencia(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
		  $persona->setTipoLicencia(STRTOUPPER($myrow["ESTADO_LICENCIA"]));
		  
			$servicios[$i] = $persona;
			$i++;
		}
	}
	
	function updateLicencia($servicio){
		$sql = "UPDATE LICENCIA_MEDICA SET 
		        ESTADO_LICENCIA = ".$servicio->getEstadoLicencia()."
				WHERE COLOR_LICENCIA = '".$servicio->getColor()."' AND FOLIO_LICENCIA = ".$servicio->getFolio()."
				AND ESTADO_LICENCIA = 1";
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
		$result = 1;
		
		if ($result == 1){
			$resultBorrarFuncionariosServicio = $this->borrarFuncionariosServicio($servicio);
		}
	}
	    	
	function deleteServicio($servicio){

		$correlativos=$servicio->getCorrelativo();
		$arregloCorrelativos=unserialize(stripslashes($correlativos));
		$sql = "DELETE FROM SERVICIO WHERE ";
	  $existe = 0;	
		foreach($arregloCorrelativos as  $valor){
		  $i++;
      $item[$valor];
			$sql .= "CORRELATIVO_SERVICIO = ".$valor." AND UNI_CODIGO=".$servicio->getUnidad()." OR ";  
      $existe = 1;
	  }
	  if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-4);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
		  mysql_close();
    }
    return $result;
	}
	
	function borrarFuncionariosServicio($servicio){
			
		$correlativos=$servicio->getCorrelativo();
		$arregloCorrelativos=unserialize(stripslashes($correlativos));
		$sql = "DELETE FROM FUNCIONARIO_SERVICIO WHERE ";
	  $existe = 0;	
		foreach($arregloCorrelativos as  $valor){
		  $i++;
      $item[$valor];
			$sql .= "UNI_CODIGO=".$servicio->getUnidad()." AND FUN_CODIGO = '" .$servicio->getCodigoFuncionario()."' AND CORRELATIVO_SERVICIO =".$valor." OR ";  
			
      $existe = 1;
	  }
	  if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-4);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
		  mysql_close();
		  $result = 1;	
		  if ($result  == 1) $resultBorrarServicio	= $this->deleteServicio($servicio);
    }
    return $result;
  }
  
  function deleteServicioRecorte($servicio){

		$correlativos=$servicio->getCorrelativo();
		$arregloCorrelativos=unserialize(stripslashes($correlativos));
		$sql = "DELETE FROM SERVICIO WHERE ";
	  $existe = 0;	
		foreach($arregloCorrelativos as  $valor){
		  $i++;
      $item[$valor];
			$sql .= "CORRELATIVO_SERVICIO = ".$valor." AND UNI_CODIGO=".$servicio->getUnidad()." OR ";  
      $existe = 1;
	  }
	  if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-4);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
		  mysql_close();
    }
    return $result;
	}
	
		function borrarFuncionariosServicioRecorte($servicio){
			
		  $correlativos=$servicio->getCorrelativo();
		  $arregloCorrelativos=unserialize(stripslashes($correlativos));
		  $sql = "DELETE FROM FUNCIONARIO_SERVICIO WHERE ";
	    $existe = 0;	
		  foreach($arregloCorrelativos as  $valor){
		  $i++;
      $item[$valor];
			$sql .= "UNI_CODIGO=".$servicio->getUnidad()." AND FUN_CODIGO = '" .$servicio->getCodigoFuncionario()."' AND CORRELATIVO_SERVICIO = ".$valor." OR ";  
			
      $existe = 1;
	  	}
	  	 if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-4);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
		  mysql_close();
		   $result = 1;	
		   if ($result  == 1) $resultBorrarServicio	= $this->deleteServicioRecorte($servicio);
    }
    return $result;
   
  }
  
 	function updateTerminoReal($servicio){
		$sql = "UPDATE LICENCIA_MEDICA SET 
		        FECHA_TERMINO_REAL = '".$servicio->getFechaTerminoInicial()."' 
				WHERE COLOR_LICENCIA = '".$servicio->getColor()."' AND FOLIO_LICENCIA = ".$servicio->getFolio();
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
		$result = 1;
		
		if ($result == 1){
			$resultBorrarFuncionariosServicio = $this->borrarFuncionariosServicioRecorte($servicio);
		}
		
	}
	
	function LicenciaMedicaAnulada($color, $folio, $servicios){	
									
			$sql = "SELECT 
              LICENCIA_MEDICA.COLOR_LICENCIA,
              LICENCIA_MEDICA.FOLIO_LICENCIA,
              MAX(LICENCIA_MEDICA.ESTADO_LICENCIA) ESTADO
            FROM LICENCIA_MEDICA
					 	WHERE
					  LICENCIA_MEDICA.COLOR_LICENCIA = '".$color."' AND 
					  LICENCIA_MEDICA.FOLIO_LICENCIA = '".$folio."' ";
			
			//echo $sql;
			$cont=0;
			$i=0;
			$servicios = "";
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result) ){
				
				$servicio = new licenciaMedica;
				$servicio->setColor($myrow["COLOR_LICENCIA"]);
				$servicio->setFolio($myrow["FOLIO_LICENCIA"]);
				$servicio->setEstadoLicencia($myrow["ESTADO"]);
				$servicios[$i] = $servicio;

				$i++;
			}
		}
  
  
	function codigoLicenciaSelime($codigo, $tipoLicencia){	
			
			$sql = "SELECT TIPO_SERVICIO.TSERV_CODIGO_SELIME
							FROM  TIPO_SERVICIO
							WHERE TIPO_SERVICIO.TSERV_CODIGO = ".$codigo;
								
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$tipoLicencia = "";
			$i=0;
			while($myrow = mysql_fetch_array($result) ){
				
				$licencia = new tipoServicio;
				$licencia->setCodigo($myrow["TSERV_CODIGO_SELIME"]);								
				$tipoLicencia[$i] = $licencia;

				$i++;
			}
		}
  
	function rutUsuario($codigo, $funcionarios){	
			
			$sql = "SELECT FUNCIONARIO.FUN_RUT
							FROM FUNCIONARIO
							WHERE FUNCIONARIO.FUN_CODIGO = '".$codigo."'";
								
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

	function reparticionCodigo($codigo, $unidades){	
		
		$sql = "SELECT UNIDAD_PERSONAL.UNI_PERSONAL
						FROM UNIDAD_PERSONAL
						WHERE UNIDAD_PERSONAL.UNI_CODIGO = ".$codigo;
							
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad($myrow["UNI_PERSONAL"]);					
			$unidades[$i] = $unidad;

			$i++;
		}
		
	}
	
	function reparticionDescripcion($codigo, $unidades){	
		
		$sql = "SELECT treparticion.REPARTICION_DESCRIPCION
						FROM treparticion
						WHERE treparticion.REPARTICION_CODIGO = ".$codigo;
							
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
			
			$unidad = new unidad;
			$unidad->setDescripcionUnidad($myrow["REPARTICION_DESCRIPCION"]);					
			$unidades[$i] = $unidad;

			$i++;
		}
	}
	
	/*	
	function licenciaSelime($funcionario){ 

		$hora = date("H:i:s");

		$sql = "INSERT INTO `licencias_intermedias` ( `serie` , `folio` , `rut` , `dias` , `desde` , `cod_tipo` , `licencia` , `fecha_lic` , `usuario` , `fecha_dig` , `hora_dig` , `unidad_usuario` , `nomunidad_usuario` , `proservipol` , `estado` ) 
           VALUES ('Q', '00003234', '111111111', '2', '2', '1', '1', '20161007', '222222222', '20161007', '1000', '3523532325', 'FGHGHFH', '1', '1') ";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
    			
	}
	*/

	function licenciaSelime($funcionario){ 

		$hora = date("Hi");
		$hora = str_replace(":", "", $hora);

		$sql = "INSERT licencias_intermedias (serie, folio, rut, dias, desde, cod_tipo, licencia, fecha_lic, usuario, fecha_dig, hora_dig, unidad_usuario, nomunidad_usuario, proservipol, estado) VALUES
		 	   ('".$funcionario->getColor()."',
		 	    '".$funcionario->getFolio()."',
		 	    '".$funcionario->getRutFuncionario()."',
		 	    '".$funcionario->getDias()."',
		 	    '".$funcionario->getFecha2()."',
		 	    '".$funcionario->getTipoLicencia()."',
		 	    '".$funcionario->getAtencion()."',
		 	    '".$funcionario->getFecha1()."',
		 	    '".$funcionario->getUsuarioProservipol()."',
		 	    '".$funcionario->getFechaRegistro()."',
		 	    '".$hora."',
		 	    '".$funcionario->getUnidad()->getCodigoUnidad()."',
		 	    '".$funcionario->getUnidad()->getDescripcionUnidad()."',
		 	    '1',
		 	    '1')";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
    			
	}

	function updateAnulaLicenciaSelime($funcionario){
		
		$sql = "UPDATE licencias_intermedias SET 
		        estado = '".$funcionario->getEstadoLicencia()."'
				WHERE proservipol = 1 AND estado = 1 AND
				serie = '".$funcionario->getColor()."' AND folio = ".$funcionario->getFolio();
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
		
	}	

	function listaServiciosLicenciaPendiente($funcionario, $fecha1, $fecha2, $servicios){	
			
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
					  SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."' AND
					  SERVICIO.TSERV_CODIGO = '717'
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
	
	function BorrarLicenciaPendiente($servicio){
		
		$correlativos=$servicio->getCorrelativo();
		$unidades=$servicio->getUnidad();
		
		$sql = "DELETE FROM FUNCIONARIO_SERVICIO WHERE ";
	  $existe = 0;
	  $i = 0;
	  
		foreach($correlativos as  $valor){
			
			$item[$valor];
			$sql .= "(FUN_CODIGO = '" .$servicio->getCodigoFuncionario()."' AND UNI_CODIGO=".$unidades[$i]." AND CORRELATIVO_SERVICIO = ".$valor.") OR ";
			$i++;
      $existe = 1;
	  }
	  
	  if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-4);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
		  mysql_close();
		  $result = 1;
			if ($result  == 1) $resultBorrarServicio	= $this->deleteServicioPendiente($servicio);
    }
    
    return $result;
    
	}
  
  function deleteServicioPendiente($servicio){

		$correlativos=$servicio->getCorrelativo();
		$unidades=$servicio->getUnidad();
		
	  $sql = "DELETE FROM SERVICIO WHERE ";
	  $existe = 0;	
	  $i=0;
	  
	  foreach($correlativos as  $valor){
		  
      $item[$valor];
      if($this->ExisteServiciosLicenciaPendiente($unidades[$i],$valor)){
				$sql .= "(CORRELATIVO_SERVICIO = ".$valor." AND UNI_CODIGO=".$unidades[$i].") OR ";
			}
      $i++;
      $existe = 1;
      
	 	}
		
		if ($existe == 1){
			$sql = substr($sql, 0, strlen($sql)-4);
			//echo $sql ."\n\n";
			$result = $this->execstmt($this->Conecta(),$sql);
		  mysql_close();
    }
    
    return $result;
    
	}
	
	function ExisteServiciosLicenciaPendiente($unidad,$correlativo){
		
		$sql = "SELECT *
				FROM FUNCIONARIO_SERVICIO
				WHERE FUNCIONARIO_SERVICIO.UNI_CODIGO = ".$unidad." AND FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo;
							
		//echo $sql;

		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		if(mysql_fetch_array($result) ){
			return 0;
		}
		return 1;
	}
  
  function CorrigeLicencias($unidad){
  
  	$sql = "SELECT 
						L.COLOR_LICENCIA,
						L.FOLIO_LICENCIA,
						F.FUN_CODIGO,
						L.TIPO_LICENCIA_MEDICA,
						TS.TSERV_DESCRIPCION,
						L.FECHA_INICIO_REAL,
						L.FECHA_TERMINO_REAL,
						L.NUM_DIAS,
						DATEDIFF(L.FECHA_TERMINO_REAL, L.FECHA_INICIO_REAL)+1 DAYS,
						(SELECT COUNT(*) 
						FROM SERVICIO S
						JOIN FUNCIONARIO_SERVICIO FS ON FS.UNI_CODIGO = S.UNI_CODIGO AND FS.CORRELATIVO_SERVICIO = S.CORRELATIVO_SERVICIO
						WHERE FS.FUN_CODIGO = F.FUN_CODIGO
						AND S.TSERV_CODIGO = L.TIPO_LICENCIA_MEDICA  
						AND S.UNI_CODIGO = L.UNI_CODIGO
						AND S.FECHA BETWEEN L.FECHA_INICIO_REAL AND L.FECHA_TERMINO_REAL
						) SERVICIOS
						FROM LICENCIA_MEDICA L
						JOIN FUNCIONARIO F ON F.FUN_RUT = L.FUN_RUT
						JOIN TIPO_SERVICIO TS ON TS.TSERV_CODIGO = L.TIPO_LICENCIA_MEDICA
						WHERE L.ESTADO_LICENCIA = 1
		        AND L.UNI_CODIGO = '".$unidad."'
						AND L.FECHA_INICIO >= (CURDATE() - INTERVAL 7 DAY)
						AND L.FECHA_INICIO <= CURDATE()";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
	/*-------------------------------------------------------------------------------------------------*/
			
			$CantServ = $myrow["SERVICIOS"];
			$CantLic	= $myrow["DAYS"];
			$Color		= $myrow["COLOR_LICENCIA"];
			$Folio		= $myrow["FOLIO_LICENCIA"];
			$CodFun		= $myrow["FUN_CODIGO"];
			$Tipo			= $myrow["TIPO_LICENCIA_MEDICA"];
			$FechaI		= $myrow["FECHA_INICIO_REAL"];
			$FechaT		= $myrow["FECHA_TERMINO_REAL"];
			$CantDiferencia = $CantLic-$CantServ;
			
			if($CantDiferencia>0||$CantServ==0){
				
				$Correlativo	= "";	
				$sql = "SELECT MAX(CORRELATIVO_SERVICIO) AS ULTIMO FROM SERVICIO WHERE UNI_CODIGO = '".$unidad."'";
				
				$result2 = $this->execstmt($this->Conecta(),$sql);
				while($myrow2 = mysql_fetch_array($result2)){
					$Correlativo	= $myrow2["ULTIMO"];
				}
				
				$sql = "SELECT 
	 								SERVICIO.CORRELATIVO_SERVICIO,
	 								SERVICIO.UNI_CODIGO,
	 								SERVICIO.FECHA
								FROM SERVICIO
								JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO AND SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
								WHERE	FUNCIONARIO_SERVICIO.FUN_CODIGO = '".$CodFun."'
								AND SERVICIO.UNI_CODIGO = '".$unidad."'
								AND SERVICIO.TSERV_CODIGO = '".$Tipo."'
								AND SERVICIO.FECHA BETWEEN '".$FechaI."' AND '".$FechaT."'
								ORDER BY SERVICIO.FECHA";
				
				$result2 = $this->execstmt($this->Conecta(),$sql);
				$fecha = strtotime('+0 day',strtotime($FechaI));
				$fechaEval = date('Y-m-d',$fecha);
				$contar = 0;
				
	/*----Cuando Faltan dias entre------------------------------------------------------------------------------------------------------------------------------------------------*/
				while($myrow2 = mysql_fetch_array($result2)){
					$contar++;
					$FechaServ = $myrow2["FECHA"];
					
					//echo $CodFun." -- ".$Color." ".$Folio." -> ".$Tipo." * ".$Correlativo." / ".$fechaEval." // ".$FechaServ." --- ".($fechaEval != $FechaServ)." ** ".$contar."<br>";
					if($fechaEval != $FechaServ){
						
						$fechaPaso 		= explode("-",$fechaEval);
	  				$fechaGuardar = $fechaPaso[0].$fechaPaso[1].$fechaPaso[2];
	/*------Insert Servicio---------------------------------------------------------------------------------------------------------------------------------*/
						$sql = "INSERT SERVICIO (UNI_CODIGO,TSERV_CODIGO,FECHA,HORA_INICIO,HORA_TERMINO) VALUES ('".$unidad."','".$Tipo."','".$fechaGuardar."','','')";
						
						//echo $sql;
						//$result3 = 1;	
						$result3 = $this->execstmt($this->Conecta(),$sql);
						if($result3){
	/*------Insert Funcionario Servicio---------------------------------------------------------------------------------------------------------------------*/
							$Correlativo++;
							$sql = "INSERT FUNCIONARIO_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, NUMERO_MEDIO, FACT_CODIGO) VALUES ('".$unidad."','".$Correlativo."','".$CodFun."',1,NULL)";
							
							//echo $sql;
							//$result4 = 1;
							$result4 = $this->execstmt($this->Conecta(),$sql);
							if($result4 == false) echo "Problema en: ".mysql_error()." // ".$CodFun." -> ".$Correlativo." / ".$unidad."<br>";
	/*-----------------------------------------------------------------------------------------------------------------------------------------------------*/
						}
						else{
							echo "Problema en: ".mysql_error()." // ".$CodFun." -> ".$Correlativo." / ".$unidad."<br>";
						}
	/*-----------------------------------------------------------------------------------------------------------------------------------------------------*/
						$fecha = strtotime('+1 day',strtotime($fechaEval));
						$fechaEval = date('Y-m-d',$fecha);
	/*--------Ver si esta registrado el servicio siguiente-------------------------------------------------------------------------------------------------*/
						$contar++;
						//echo $CodFun." -- ".$Color." ".$Folio." -> ".$Tipo." * ".$Correlativo." / ".$fechaEval." // ".$FechaServ." --- ".($fechaEval != $FechaServ)." ** ".$contar."<br>";
						if($fechaEval != $FechaServ){
	/*------Insert Servicio---------------------------------------------------------------------------------------------------------------------------------*/
							$sql = "INSERT SERVICIO (UNI_CODIGO,TSERV_CODIGO,FECHA,HORA_INICIO,HORA_TERMINO) VALUES ('".$unidad."','".$Tipo."','".$fechaGuardar."','','')";
						
							//echo $sql;
							//$result3 = 1;	
							$result3 = $this->execstmt($this->Conecta(),$sql);
							if ($result3){
	/*------Insert Funcionario Servicio---------------------------------------------------------------------------------------------------------------------*/
								$Correlativo++;
								$sql = "INSERT FUNCIONARIO_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, NUMERO_MEDIO, FACT_CODIGO) VALUES ('".$unidad."','".$Correlativo."','".$CodFun."',1,NULL)";
								
								//echo $sql;
								//$result4 = 1;
								$result4 = $this->execstmt($this->Conecta(),$sql);
								if($result4 == false) echo "Problema en: ".mysql_error()." // ".$CodFun." -> ".$Correlativo." / ".$unidad."<br>";
	/*-----------------------------------------------------------------------------------------------------------------------------------------------------*/
							}
							else{
								echo "Problema en: ".mysql_error()." // ".$CodFun." -> ".$Correlativo." / ".$unidad."<br>";
							}
						}
	/*-----------------------------------------------------------------------------------------------------------------------------------------------------*/
					}
					$fecha = strtotime('+1 day',strtotime($fechaEval));
					$fechaEval = date('Y-m-d',$fecha);
				}
	/*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	/*----Cuando Faltan dias al final------------------------------------------------------------------------------------------------------------------------------------------------------*/
			
				while($contar <= $CantLic){
					$contar++;
					$fechaPaso 		= explode("-",$fechaEval);
	  			$fechaGuardar = $fechaPaso[0].$fechaPaso[1].$fechaPaso[2];
	/*------Insert Servicio---------------------------------------------------------------------------------------------------------------------------------*/
					$sql = "INSERT SERVICIO (UNI_CODIGO,TSERV_CODIGO,FECHA,HORA_INICIO,HORA_TERMINO) VALUES ('".$unidad."','".$Tipo."','".$fechaGuardar."','','')";
					
					//echo $sql;
					//$result3 = 1;	
					$result3 = $this->execstmt($this->Conecta(),$sql);
					if ($result3){
	/*------Insert Funcionario Servicio---------------------------------------------------------------------------------------------------------------------*/
						$Correlativo++;
						$sql = "INSERT FUNCIONARIO_SERVICIO (UNI_CODIGO, CORRELATIVO_SERVICIO, FUN_CODIGO, NUMERO_MEDIO, FACT_CODIGO) VALUES ('".$unidad."','".$Correlativo."','".$CodFun."',1,NULL)";
						
						//echo $sql;
						//$result4 = 1;
						$result4 = $this->execstmt($this->Conecta(),$sql);
						if($result4 == false) echo "Problema en: ".mysql_error()." // ".$CodFun." -> ".$Correlativo." / ".$unidad."<br>";
	/*-----------------------------------------------------------------------------------------------------------------------------------------------------*/
					}
					else{
						echo "Problema en: ".mysql_error()." // ".$CodFun." -> ".$Correlativo." / ".$unidad."<br>";
					}
	/*-----------------------------------------------------------------------------------------------------------------------------------------------------*/
					$fecha = strtotime('+1 day',strtotime($fechaEval));
					$fechaEval = date('Y-m-d',$fecha);
				}
	/*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	/*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
			}
	/*-------------------------------------------------------------------------------------------------*/
			$i++;
		}
		return 1;		
  }
  
}//end class   
?>