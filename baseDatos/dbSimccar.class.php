<?
Class dbSimccar extends Conexion{		
	
	function listaCaptura($Unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $Simccar){
		$FechaHoy = date("Y-m-d");
		if ($NombreCampo == "serie")  $campoOrdenar = "SIMCCAR.SIM_SERIE ".$TipoOrden;
		if ($NombreCampo == "tarjeta") $campoOrdenar = "SIMCCAR.SIM_TARJETA ".$TipoOrden;
		if ($NombreCampo == "imei") $campoOrdenar = "SIMCCAR.SIM_IMEI ".$TipoOrden;
		if ($NombreCampo == "estado")  $campoOrdenar = "ESTADO.EST_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "unidad")  $campoOrdenar = "UNIDAD.UNI_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "seccion")  $campoOrdenar = "TIPO_SECCION.SEC_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "") $campoOrdenar = "SIMCCAR.SIM_CODIGO ASC";
		
		$sql = "SELECT 
          SIMCCAR.SIM_CODIGO,
          SIMCCAR.SIM_SERIE,
          SIMCCAR.SIM_TARJETA,
          SIMCCAR.SIM_IMEI,
          ESTADO.EST_CODIGO,
          ESTADO.EST_DESCRIPCION,
          ESTADO_SIMCCAR.UNI_CODIGO,
       	  UNIDAD.UNI_DESCRIPCION,
       	  ESTADO_SIMCCAR.UNI_AGREGADO,
       	  UNIDAD_AGREGADO.UNI_DESCRIPCION DESCRIPCION_AGREGADO,
          ESTADO_SIMCCAR.SEC_CODIGO,
				  TIPO_SECCION.SEC_DESCRIPCION
      FROM ESTADO_SIMCCAR
      LEFT JOIN ESTADO ON (ESTADO_SIMCCAR.EST_CODIGO = ESTADO.EST_CODIGO)
      RIGHT JOIN SIMCCAR ON (ESTADO_SIMCCAR.SIM_CODIGO = SIMCCAR.SIM_CODIGO)
      LEFT JOIN UNIDAD ON (SIMCCAR.UNI_CODIGO = UNIDAD.UNI_CODIGO)
      LEFT JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_SIMCCAR.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
      LEFT JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_SIMCCAR.SEC_CODIGO)
      WHERE SIMCCAR.UNI_CODIGO=".$Unidad." AND ESTADO_SIMCCAR.FECHA_HASTA IS NULL AND ESTADO.EST_CODIGO NOT IN(140)";
    
    if ($nombreBuscar != "") $sql .= " AND SIMCCAR.SIM_SERIE LIKE '%".$nombreBuscar."%' ";
		
		$sql .= " ORDER BY ".$campoOrdenar;
		//echo $sql;
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			
			$estado = new estadoRecurso;
		  $estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
	  	$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			
	  	$unidadAgregado = new unidad;
		  $unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
	  	$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DESCRIPCION_AGREGADO"]));
						
	  	$unidad = new unidad;
		  $unidad->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
	  	$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
	  	
			$seccion = new seccion;
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$simccar = new simccar;
			$simccar->setCodigoSimccar($myrow["SIM_CODIGO"]);
			$simccar->setSerieSimccar(STRTOUPPER($myrow["SIM_SERIE"]));
			$simccar->setTarjetaSimccar(STRTOUPPER($myrow["SIM_TARJETA"]));
      $simccar->setImei(STRTOUPPER($myrow["SIM_IMEI"]));;
      $simccar->setEstadoSimccar($estado);
		  $simccar->setUnidad($unidad);
		  $simccar->setUnidadAgregado($unidadAgregado);
      $simccar->setSeccion($seccion);
			
			$Simccar[$i] = $simccar;					
			$i++;
		}
	}
	
	function listaSimccarAgregada($Unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $Simccar){
		$FechaHoy = date("Y-m-d");
		if ($NombreCampo == "serie")  $campoOrdenar = "SIMCCAR.SIM_SERIE ".$TipoOrden;
		if ($NombreCampo == "tarjeta") $campoOrdenar = "SIMCCAR.SIM_TARJETA ".$TipoOrden;
		if ($NombreCampo == "imei") $campoOrdenar = "SIMCCAR.SIM_IMEI ".$TipoOrden;
		if ($NombreCampo == "estado")  $campoOrdenar = "ESTADO.EST_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "unidad")  $campoOrdenar = "UNIDAD_AGREGADO.UNI_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "seccion")  $campoOrdenar = "TIPO_SECCION.SEC_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "") $campoOrdenar = "SIMCCAR.SIM_CODIGO ASC";
			
		$sql = "SELECT 
          SIMCCAR.SIM_CODIGO,
          SIMCCAR.SIM_SERIE,
          SIMCCAR.SIM_TARJETA,
          SIMCCAR.SIM_IMEI,
          ESTADO.EST_CODIGO,
          ESTADO.EST_DESCRIPCION,
          ESTADO_SIMCCAR.UNI_CODIGO,
       	  UNIDAD.UNI_DESCRIPCION,
       	  ESTADO_SIMCCAR.UNI_AGREGADO,
       	  UNIDAD_AGREGADO.UNI_DESCRIPCION DESCRIPCION_AGREGADO,
          ESTADO_SIMCCAR.SEC_CODIGO,
				  TIPO_SECCION.SEC_DESCRIPCION
	      FROM ESTADO_SIMCCAR
	      LEFT JOIN ESTADO ON (ESTADO_SIMCCAR.EST_CODIGO = ESTADO.EST_CODIGO)
	      RIGHT JOIN SIMCCAR ON (ESTADO_SIMCCAR.SIM_CODIGO = SIMCCAR.SIM_CODIGO)
	      JOIN UNIDAD ON (SIMCCAR.UNI_CODIGO = UNIDAD.UNI_CODIGO)
	      LEFT JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_SIMCCAR.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
      	LEFT JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_SIMCCAR.SEC_CODIGO)
	      WHERE ESTADO_SIMCCAR.UNI_AGREGADO=".$Unidad." AND ESTADO_SIMCCAR.FECHA_HASTA IS NULL ";

    if ($nombreBuscar != "") $sql .= " AND SIMCCAR.SIM_SERIE LIKE '%".$nombreBuscar."%' ";
		
		$sql .= " ORDER BY ".$campoOrdenar;	      
		//echo $sql;
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			
			$estado = new estadoRecurso;
		  $estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
	  	$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
		
	  	$unidadAgregado = new unidad;
		  $unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
	  	$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DESCRIPCION_AGREGADO"]));
						
	  	$unidad = new unidad;
		  $unidad->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
	  	$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));

			$seccion = new seccion;
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
							
			$simccar = new simccar;
			$simccar->setCodigoSimccar($myrow["SIM_CODIGO"]);
			$simccar->setSerieSimccar(STRTOUPPER($myrow["SIM_SERIE"]));
			$simccar->setTarjetaSimccar(STRTOUPPER($myrow["SIM_TARJETA"]));
      $simccar->setImei(STRTOUPPER($myrow["SIM_IMEI"]));;
      $simccar->setEstadoSimccar($estado);
		  $simccar->setUnidad($unidad);
		  $simccar->setUnidadAgregado($unidadAgregado);
      $simccar->setSeccion($seccion);
      
			$Simccar[$i] = $simccar;
			$i++;
		}
	}
	
	function buscaSimccar($codigo,$serieSimccar,$simccar){
    $sql = "SELECT 
            SIMCCAR.SIM_CODIGO,
            SIMCCAR.SIM_SERIE,
            SIMCCAR.SIM_TARJETA,
            SIMCCAR.SIM_IMEI,
            SIMCCAR.UNI_CODIGO,
            SIMCCAR.MSIM_CODIGO,
            SIMCCAR.MODSIM_CODIGO,
            SIMCCAR.ANNO_FABRICACION,
            SIMCCAR.ORIGEN_SIMCCAR,
            SIMCCAR.VERIFICACION_ESTADO,
            ESTADO.EST_CODIGO,
            ESTADO.EST_DESCRIPCION,
         	  ESTADO_SIMCCAR.UNI_AGREGADO,
         	  UNIDAD_AGREGADO.UNI_DESCRIPCION AS DES_UNIDADGREGADO,
         	  UNIDAD.UNI_DESCRIPCION,
         	  ESTADO_SIMCCAR.FECHA_DESDE,
          	ESTADO_SIMCCAR.SEC_CODIGO,
				  	TIPO_SECCION.SEC_DESCRIPCION
		        FROM SIMCCAR
		        LEFT JOIN ESTADO_SIMCCAR ON (ESTADO_SIMCCAR.SIM_CODIGO = SIMCCAR.SIM_CODIGO)
		        LEFT JOIN ESTADO ON (ESTADO_SIMCCAR.EST_CODIGO = ESTADO.EST_CODIGO)
		        LEFT JOIN UNIDAD ON (SIMCCAR.UNI_CODIGO = UNIDAD.UNI_CODIGO)
		        LEFT JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_SIMCCAR.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
      			LEFT JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_SIMCCAR.SEC_CODIGO)
		        WHERE ESTADO_SIMCCAR.FECHA_HASTA IS NULL";
		
    if ($codigo != "") $sql .= " AND SIMCCAR.SIM_CODIGO = ".$codigo;
    if ($serieSimccar != "") $sql .= " AND SIMCCAR.SIM_SERIE = '".$serieSimccar."'";
    
    //echo $sql;		    	    
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DES_UNIDADGREGADO"]));
			
			$estado = new estadoRecurso;
			$estado->setCodigo($myrow["EST_CODIGO"]);
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			$estado->setFechaDesde($myrow["FECHA_DESDE"]);
			
			$seccion = new seccion;
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
							
			$simccar = new simccar;
			$simccar->setCodigoSimccar($myrow["SIM_CODIGO"]);
			$simccar->setSerieSimccar(STRTOUPPER($myrow["SIM_SERIE"]));
			$simccar->setTarjetaSimccar(STRTOUPPER($myrow["SIM_TARJETA"]));
			$simccar->setImei(STRTOUPPER($myrow["SIM_IMEI"]));
			$simccar->setOrigen(STRTOUPPER($myrow["ORIGEN_SIMCCAR"]));
			$simccar->setVerifica(STRTOUPPER($myrow["VERIFICACION_ESTADO"]));
			$simccar->setMarca(STRTOUPPER($myrow["MSIM_CODIGO"]));
			$simccar->setModelo(STRTOUPPER($myrow["MODSIM_CODIGO"]));
			$simccar->setAnno(STRTOUPPER($myrow["ANNO_FABRICACION"]));
			$simccar->setEstadoSimccar($estado);
			$simccar->setUnidad($unidad);	
			$simccar->setUnidadAgregado($unidadAgregado);
			$simccar->setSeccion($seccion);
		}
	}
	
	function nuevoSimccar($Simccar){
		$sql = "INSERT INTO SIMCCAR
			       (SIM_SERIE,SIM_TARJETA,SIM_IMEI,UNI_CODIGO,ORIGEN_SIMCCAR, VERIFICACION_ESTADO)  VALUES
			 	    ('".$Simccar->getSerieSimccar()."',  
            '".$Simccar->getTarjetaSimccar()."',  
            '".$Simccar->getImei()."',  
            ".$Simccar->getUnidad()->getCodigoUnidad().",
            '".$Simccar->getOrigen()."',
            '".$Simccar->getVerifica()."',
            '".$seccionGuardar."')";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return mysql_insert_id($this->Conecta()); 
	}
  
  function updateSimccar($Simccar){
		$unidad = $Simccar->getUnidad()->getCodigoUnidad();
		$estado = $Simccar->getEstadoSimccar()->getCodigo();
		
		if ($estado == 140) $unidad = "NULL";
		
		$sql = "UPDATE SIMCCAR SET
		    UNI_CODIGO = ".$unidad.",
		    SIM_TARJETA  = '".$Simccar->getTarjetaSimccar()."',
		    SIM_IMEI  = '".$Simccar->getImei()."',
		    MSIM_CODIGO  = '".$Simccar->getMarca()."',
		    MODSIM_CODIGO  = '".$Simccar->getModelo()."',
		    ANNO_FABRICACION  = '".$Simccar->getAnno()."',
			  ORIGEN_SIMCCAR      = '".$Simccar->getOrigen()."',
		    VERIFICACION_ESTADO = '".$Simccar->getVerifica()."'
				WHERE 
				SIM_CODIGO =".$Simccar->getCodigoSimccar()."";
				
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateSimccar2($Simccar){
		
		$sql = "UPDATE SIMCCAR SET
		  UNI_CODIGO = ".$Simccar->getUnidad()->getCodigoUnidad().",
		  SIM_TARJETA  = '".$Simccar->getTarjetaSimccar()."',
		  SIM_IMEI  = '".$Simccar->getImei()."',
		  MSIM_CODIGO  = '".$Simccar->getMarca()."',
		  MODSIM_CODIGO  = '".$Simccar->getModelo()."',
		  ANNO_FABRICACION  = '".$Simccar->getAnno()."',
		  ORIGEN_SIMCCAR      = '".$Simccar->getOrigen()."',
		  VERIFICACION_ESTADO = '".$Simccar->getVerifica()."'
			WHERE 
			SIM_CODIGO =".$Simccar->getCodigoSimccar()."";
		
		//echo $sql; 
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function dejarDisponible($Simccar, $fecha){
		
		$sql = "UPDATE SIMCCAR SET UNI_CODIGO = NULL WHERE SIM_CODIGO = " . $Simccar->getCodigoSimccar();
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateEstadoSimccar($Simccar, $fechaNuevoEstado){
		
		if ($Simccar->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
    else $seccionGuardar = $Simccar->getSeccion()->getCodigo();
    
    if ($fechaNuevoEstado == "") $fechaNuevoEstado = 'NULL';
    else $fechaNuevoEstado = "'".$fechaNuevoEstado."'";
		
		$sql = "UPDATE ESTADO_SIMCCAR SET
				FECHA_HASTA = ".$fechaNuevoEstado.", SEC_CODIGO = ".$seccionGuardar."
				WHERE SIM_CODIGO = ".$Simccar->getCodigoSimccar()." AND FECHA_HASTA IS NULL";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateEstadoSimccar2($Simccar, $fechaNuevoEstado){
		
		if ($Simccar->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
    else $seccionGuardar = $Simccar->getSeccion()->getCodigo();
		
		$sql = "UPDATE ESTADO_SIMCCAR SET
				FECHA_HASTA = '".$fechaNuevoEstado."', SEC_CODIGO = ".$seccionGuardar."
					WHERE SIM_CODIGO = ".$Simccar->getCodigoSimccar()." AND FECHA_HASTA IS NULL";
		
		//echo $sql;
		//$result = 1;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function insertEstadoSimccar($Simccar, $fechaNuevoEstado){
		
		if ($Simccar->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
    else $seccionGuardar = $Simccar->getSeccion()->getCodigo();
		
		if ($Simccar->getUnidadAgregado()->getCodigoUnidad() == 0) $unidadAgregadoGuardar = 'NULL';
		else $unidadAgregadoGuardar = $Simccar->getUnidadAgregado()->getCodigoUnidad();
			
		if ($Simccar->getReemplazoSimccar()->getReemplazo() == "") $reemplazoGuardar = 'NULL';
		else $reemplazoGuardar = $Simccar->getReemplazoSimccar()->getReemplazo();
			
		$sql = "INSERT INTO ESTADO_SIMCCAR (SIM_CODIGO, EST_CODIGO, UNI_CODIGO, FECHA_DESDE, UNI_AGREGADO, SIM_REEMPLAZO, SEC_CODIGO)
					VALUES (".$Simccar->getCodigoSimccar().",".$Simccar->getEstadoSimccar()->getCodigo().",".$Simccar->getUnidad()->getCodigoUnidad().",'".$fechaNuevoEstado."',".$unidadAgregadoGuardar.",".$reemplazoGuardar.",".$seccionGuardar.")";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function insertEstadoSimccar2($Simccar, $fechaNuevoEstado2){
		
		if ($Simccar->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
    else $seccionGuardar = $Simccar->getSeccion()->getCodigo();
		
		if ($Simccar->getUnidadAgregado()->getCodigoUnidad() == 0) $unidadAgregadoGuardar = 'NULL';
		else $unidadAgregadoGuardar = $Simccar->getUnidadAgregado()->getCodigoUnidad();
		
		if ($Simccar->getReemplazoSimccar()->getReemplazo() == "") $reemplazoGuardar = 'NULL';
		else $reemplazoGuardar = $Simccar->getReemplazoSimccar()->getReemplazo();
		
		$sql = "INSERT INTO ESTADO_SIMCCAR (SIM_CODIGO, EST_CODIGO, UNI_CODIGO, FECHA_DESDE, UNI_AGREGADO, SIM_REEMPLAZO, SEC_CODIGO)
				VALUES (".$Simccar->getCodigoSimccar().",".$Simccar->getEstadoSimccar()->getCodigo().",".$Simccar->getUnidad()->getCodigoUnidad().",'".$fechaNuevoEstado2."',".$unidadAgregadoGuardar.",".$reemplazoGuardar.",".$seccionGuardar.")";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function bajaSimccar($Simccar, $motivo, $fecha){ 
		
		$sql = "INSERT INTO ESTADO_SIMCCAR (SIM_CODIGO,EST_CODIGO, UNI_CODIGO, FECHA_DESDE, FECHA_HASTA)
			   VALUES (".$Simccar->getCodigoSimccar().",".$Simccar->getEstadoSimccar()->getCodigo().",".$Simccar->getUnidad()->getCodigoUnidad().",'".$fecha."','".$fecha."');";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function listaSimccarDisponibles($unidad, $fechaServicio, $tipoServicio, $correlativo, $Simccars){
	  
		$sql .= "(SELECT 
   	  SIMCCAR.SIM_SERIE,
		  SIMCCAR.SIM_CODIGO
			FROM ESTADO_SIMCCAR
		  LEFT OUTER JOIN ESTADO ON (ESTADO_SIMCCAR.EST_CODIGO = ESTADO.EST_CODIGO)
		  RIGHT OUTER JOIN SIMCCAR ON (ESTADO_SIMCCAR.SIM_CODIGO = SIMCCAR.SIM_CODIGO)
			WHERE	(ESTADO_SIMCCAR.UNI_CODIGO = ".$unidad.") AND 
		  (ESTADO_SIMCCAR.FECHA_DESDE <= '".$fechaServicio."' AND (ESTADO_SIMCCAR.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_SIMCCAR.FECHA_HASTA IS NULL)) AND 
		  (ESTADO.EST_CODIGO IN(10))";
		
		if ($correlativo != ""){
			$sql .= " AND
				  	(SIMCCAR.SIM_CODIGO NOT IN (
				  		SELECT SIMCCAR_SERVICIO.SIM_CODIGO
							FROM SIMCCAR_SERVICIO
						  LEFT OUTER JOIN SERVICIO ON (SIMCCAR_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
						  AND (SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
						  WHERE (SIMCCAR_SERVICIO.UNI_CODIGO = ".$unidad ." AND SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
		}
		
		$sql .= ") UNION ( SELECT 
			      SIMCCAR.SIM_SERIE,
					  SIMCCAR.SIM_CODIGO
						FROM ESTADO_SIMCCAR
						INNER JOIN SIMCCAR ON (ESTADO_SIMCCAR.SIM_CODIGO = SIMCCAR.SIM_CODIGO)
						WHERE
					  ESTADO_SIMCCAR.UNI_AGREGADO = ".$unidad." AND 
					  ESTADO_SIMCCAR.FECHA_DESDE <= '".$fechaServicio."' AND 
					  (ESTADO_SIMCCAR.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_SIMCCAR.FECHA_HASTA IS NULL)";
			
		if ($correlativo != ""){	
				$sql .= " AND
					  	(SIMCCAR.SIM_CODIGO NOT IN (
					  		SELECT SIMCCAR_SERVICIO.SIM_CODIGO
								FROM SIMCCAR_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (SIMCCAR_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (SIMCCAR_SERVICIO.UNI_CODIGO = ".$unidad ." AND SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
		}
		
		$sql .= ") ORDER BY SIM_SERIE";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ) {
			$Simccar = new simccar;
			$Simccar->setCodigoSimccar($myrow["SIM_CODIGO"]);
			$Simccar->setSerieSimccar(STRTOUPPER($myrow["SIM_SERIE"]));
			$Simccars[$i] = $Simccar;
			$i++;
		}
	}
}//end class   
?>