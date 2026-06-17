<?
Class dbDioscar extends Conexion
{		
	
	function listaCaptura($Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios){
	
		$FechaHoy = date("Y-m-d");
		
		
				$sql = "SELECT 
              SIMCCAR.SIM_CODIGO,
              SIMCCAR.SIM_SERIE,
              SIMCCAR.SIM_TARJETA,
              SIMCCAR.SIM_IMEI,
              SIMCCAR.UNI_CODIGO,
              ESTADO.EST_CODIGO,
              ESTADO.EST_DESCRIPCION,
           	  ESTADO_SIMCCAR.UNI_AGREGADO,
           	  UNIDAD_AGREGADO.UNI_DESCRIPCION	  
          FROM
              ESTADO_SIMCCAR
          LEFT OUTER JOIN ESTADO ON (ESTADO_SIMCCAR.EST_CODIGO = ESTADO.EST_CODIGO)
          RIGHT OUTER JOIN SIMCCAR ON (ESTADO_SIMCCAR.SIM_CODIGO = SIMCCAR.SIM_CODIGO)
          LEFT OUTER JOIN UNIDAD ON (SIMCCAR.UNI_CODIGO = UNIDAD.UNI_CODIGO)
          LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_SIMCCAR.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
          WHERE
          SIMCCAR.UNI_CODIGO=".$Unidad." AND ESTADO_SIMCCAR.FECHA_HASTA IS NULL AND ESTADO.EST_CODIGO NOT IN(130)"; 
		        		    		       											
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
			  	$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
									
					$dioscar = new dioscar;
					$dioscar->setCodigoSimccar($myrow["SIM_CODIGO"]);
					$dioscar->setSerieSimccar(STRTOUPPER($myrow["SIM_SERIE"]));
					$dioscar->setTarjetaSimccar(STRTOUPPER($myrow["SIM_TARJETA"]));
          $dioscar->setImei(STRTOUPPER($myrow["SIM_IMEI"]));;
          $dioscar->setEstadoVehiculo($estado);
				  $dioscar->setUnidadAgregado($unidadAgregado);
					
					//$mes = new mes;
					//$mes->setCodigoMes(STRTOUPPER($myrow["MES_CODIGO"]));
					//$mes->setDescripcionMes(STRTOUPPER($myrow["MES_DESCRIPCION"]));
										
					//$persona = new funcionario;
					//$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
					//$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
					//$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
					//$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
					//$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
					//$persona->setCapturaDioscar($dioscar);
					//$persona->setMesDatos($mes);

				 
									
					$funcionarios[$i] = $dioscar;					
					$i++;
				}
		}
		
			function listaSimccarAgregada($Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios){
	
		$FechaHoy = date("Y-m-d");
		
		
				$sql = "SELECT 
              SIMCCAR.SIM_CODIGO,
              SIMCCAR.SIM_SERIE,
              SIMCCAR.SIM_TARJETA,
              SIMCCAR.SIM_IMEI,
              SIMCCAR.UNI_CODIGO,
              ESTADO.EST_CODIGO,
              ESTADO.EST_DESCRIPCION,
           	  ESTADO_SIMCCAR.UNI_AGREGADO,
           	  UNIDAD_AGREGADO.UNI_DESCRIPCION	  
          FROM
              ESTADO_SIMCCAR
          LEFT OUTER JOIN ESTADO ON (ESTADO_SIMCCAR.EST_CODIGO = ESTADO.EST_CODIGO)
          RIGHT OUTER JOIN SIMCCAR ON (ESTADO_SIMCCAR.SIM_CODIGO = SIMCCAR.SIM_CODIGO)
          INNER JOIN UNIDAD ON (SIMCCAR.UNI_CODIGO = UNIDAD.UNI_CODIGO)
          LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_SIMCCAR.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
          WHERE
          ESTADO_SIMCCAR.UNI_AGREGADO=".$Unidad." AND ESTADO_SIMCCAR.FECHA_HASTA IS NULL ";
		        		    		       											
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
			  	$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
									
					$dioscar = new dioscar;
					$dioscar->setCodigoSimccar($myrow["SIM_CODIGO"]);
					$dioscar->setSerieSimccar(STRTOUPPER($myrow["SIM_SERIE"]));
					$dioscar->setTarjetaSimccar(STRTOUPPER($myrow["SIM_TARJETA"]));
          $dioscar->setImei(STRTOUPPER($myrow["SIM_IMEI"]));;
          $dioscar->setEstadoVehiculo($estado);
				  $dioscar->setUnidadAgregado($unidadAgregado);
					
					//$mes = new mes;
					//$mes->setCodigoMes(STRTOUPPER($myrow["MES_CODIGO"]));
					//$mes->setDescripcionMes(STRTOUPPER($myrow["MES_DESCRIPCION"]));
										
					//$persona = new funcionario;
					//$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
					//$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
					//$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
					//$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
					//$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
					//$persona->setCapturaDioscar($dioscar);
					//$persona->setMesDatos($mes);

				 
									
					$funcionarios[$i] = $dioscar;					
					$i++;
				}
		}
	
function buscaDioscar($codigo,$serieArma,$dioscar){
					    	    
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
           	  ESTADO_SIMCCAR.FECHA_DESDE	  
          FROM SIMCCAR
          LEFT JOIN ESTADO_SIMCCAR ON (ESTADO_SIMCCAR.SIM_CODIGO = SIMCCAR.SIM_CODIGO)
          LEFT JOIN ESTADO ON (ESTADO_SIMCCAR.EST_CODIGO = ESTADO.EST_CODIGO)
          LEFT JOIN UNIDAD ON (SIMCCAR.UNI_CODIGO = UNIDAD.UNI_CODIGO)
          LEFT JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_SIMCCAR.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
          WHERE ESTADO_SIMCCAR.FECHA_HASTA IS NULL";
                    
           if ($codigo != "") $sql .= " AND SIMCCAR.SIM_CODIGO = ".$codigo;
	         if ($serieArma != "") $sql .= " AND SIMCCAR.SIM_SERIE = '".$serieArma."'";
           
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
										
					$dioscar = new dioscar;
					//$dioscar->setUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
          $dioscar->setCodigoSimccar($myrow["SIM_CODIGO"]);
          $dioscar->setSerieSimccar(STRTOUPPER($myrow["SIM_SERIE"]));
          $dioscar->setTarjetaSimccar(STRTOUPPER($myrow["SIM_TARJETA"]));
          $dioscar->setImei(STRTOUPPER($myrow["SIM_IMEI"]));
          $dioscar->setOrigen(STRTOUPPER($myrow["ORIGEN_SIMCCAR"]));
          $dioscar->setVerifica(STRTOUPPER($myrow["VERIFICACION_ESTADO"]));
          $dioscar->setMarca(STRTOUPPER($myrow["MSIM_CODIGO"]));
          $dioscar->setModelo(STRTOUPPER($myrow["MODSIM_CODIGO"]));
          $dioscar->setAnno(STRTOUPPER($myrow["ANNO_FABRICACION"]));
          $dioscar->setEstadoVehiculo($estado);
          $dioscar->setUnidad($unidad);	
          $dioscar->setUnidadAgregado($unidadAgregado);
  
													
					//$funcionarios[$i] = $dioscar;					
					//$i++;
				}
		}
		
			function nuevoDioscar($vehiculo){ 

			$sql = "INSERT INTO SIMCCAR
			       (SIM_SERIE,SIM_TARJETA,SIM_IMEI,UNI_CODIGO,ORIGEN_SIMCCAR, VERIFICACION_ESTADO)  VALUES
			 	    ('".$vehiculo->getSerieSimccar()."',  
            '".$vehiculo->getTarjetaSimccar()."',  
            '".$vehiculo->getImei()."',  
            ".$vehiculo->getUnidad()->getCodigoUnidad().",
            '".$vehiculo->getOrigen()."',
            '".$vehiculo->getVerifica()."')";
			
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			//return $result;
			return mysql_insert_id($this->Conecta()); 
		}
  
  function updateSimccar($vehiculo){
					
			$sql = "UPDATE SIMCCAR SET
			    UNI_CODIGO = ".$vehiculo->getUnidad()->getCodigoUnidad().",
			    SIM_TARJETA  = '".$vehiculo->getTarjetaSimccar()."',
			    SIM_IMEI  = '".$vehiculo->getImei()."',
			    MSIM_CODIGO  = '".$vehiculo->getMarca()."', 
			    MODSIM_CODIGO  = '".$vehiculo->getModelo()."', 
			    ANNO_FABRICACION  = '".$vehiculo->getAnno()."', 
				  ORIGEN_SIMCCAR      = '".$vehiculo->getOrigen()."',
          VERIFICACION_ESTADO = '".$vehiculo->getVerifica()."'            
					WHERE 
					SIM_CODIGO =".$vehiculo->getCodigoSimccar()."";
					
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
		  function updateSimccar2($vehiculo){
					
			$sql = "UPDATE SIMCCAR SET
			    UNI_CODIGO = ".$vehiculo->getUnidad()->getCodigoUnidad().",
			    SIM_TARJETA  = '".$vehiculo->getTarjetaSimccar()."',
			    SIM_IMEI  = '".$vehiculo->getImei()."',
			    MSIM_CODIGO  = '".$vehiculo->getMarca()."', 
			    MODSIM_CODIGO  = '".$vehiculo->getModelo()."', 
			    ANNO_FABRICACION  = '".$vehiculo->getAnno()."',
				  ORIGEN_SIMCCAR      = '".$vehiculo->getOrigen()."',
          VERIFICACION_ESTADO = '".$vehiculo->getVerifica()."'            
					WHERE 
					SIM_CODIGO =".$vehiculo->getCodigoSimccar()."";
					
			//echo $sql; 
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
			function dejarDisponible($vehiculo, $fecha){
			
			$sql = "UPDATE SIMCCAR SET UNI_CODIGO = NULL WHERE SIM_CODIGO = " . $vehiculo->getCodigoSimccar();
			
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			//$result	= 1;
			return $result;
		}
		
		function updateEstadoSimmcar($vehiculo, $fechaNuevoEstado){
			
			$sql = "UPDATE ESTADO_SIMCCAR SET
					FECHA_HASTA = '".$fechaNuevoEstado."'
					WHERE SIM_CODIGO = ".$vehiculo->getCodigoSimccar()." AND FECHA_HASTA IS NULL";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}		
		
				function updateEstadoSimmcar2($vehiculo, $fechaNuevoEstado){
			
			$sql = "UPDATE ESTADO_SIMCCAR SET
					FECHA_HASTA = '".$fechaNuevoEstado."'
					WHERE SIM_CODIGO = ".$vehiculo->getCodigoSimccar()." AND FECHA_HASTA IS NULL";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}	
		
		//function insertID() { 
    //       return mysql_insert_id($this->conecta());
     //  }
		
		function insertEstadoSimccar($vehiculo, $fechaNuevoEstado){
			
			//echo "aqui";
			
			//echo "jjjj " . $vehiculo->getLugarReparacion()->getCodigo();
			

			
			if ($vehiculo->getUnidadAgregado()->getCodigoUnidad() == 0) $unidadAgregadoGuardar = 'NULL';
			else $unidadAgregadoGuardar = $vehiculo->getUnidadAgregado()->getCodigoUnidad();
			
			if ($vehiculo->getReemplazoSimccar()->getReemplazo() == "") $reemplazoGuardar = 'NULL';
			else $reemplazoGuardar = $vehiculo->getReemplazoSimccar()->getReemplazo();
			if ($reemplazoGuardar == $vehiculo->getCodigoSimccar() )	$reemplazoGuardar = 'NULL';		
			$sql = "INSERT INTO ESTADO_SIMCCAR (SIM_CODIGO, EST_CODIGO, UNI_CODIGO, FECHA_DESDE, UNI_AGREGADO, SIM_REEMPLAZO)
					VALUES (".$vehiculo->getCodigoSimccar().",".$vehiculo->getEstadoVehiculo()->getCodigo().",".$vehiculo->getUnidad()->getCodigoUnidad().",'".$fechaNuevoEstado."',".$unidadAgregadoGuardar.",".$reemplazoGuardar.")";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
				function insertEstadoSimccar2($vehiculo, $fechaNuevoEstado2){
			
			//echo "aqui";
			
			//echo "jjjj " . $vehiculo->getLugarReparacion()->getCodigo();
			

			
			if ($vehiculo->getUnidadAgregado()->getCodigoUnidad() == 0) $unidadAgregadoGuardar = 'NULL';
			else $unidadAgregadoGuardar = $vehiculo->getUnidadAgregado()->getCodigoUnidad();
			
			if ($vehiculo->getReemplazoSimccar()->getReemplazo() == "") $reemplazoGuardar = 'NULL';
			else $reemplazoGuardar = $vehiculo->getReemplazoSimccar()->getReemplazo();
							
			$sql = "INSERT INTO ESTADO_SIMCCAR (SIM_CODIGO, EST_CODIGO, UNI_CODIGO, FECHA_DESDE, UNI_AGREGADO, SIM_REEMPLAZO)
					VALUES (".$vehiculo->getCodigoSimccar().",".$vehiculo->getEstadoVehiculo()->getCodigo().",".$vehiculo->getUnidad()->getCodigoUnidad().",'".$fechaNuevoEstado2."',".$unidadAgregadoGuardar.",".$reemplazoGuardar.")";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
		function bajaSimccar($vehiculo, $motivo, $fecha){ 
			
			$sql = "INSERT INTO ESTADO_SIMCCAR(SIM_CODIGO,EST_CODIGO, UNI_CODIGO, FECHA_DESDE, FECHA_HASTA)
				   VALUES (".$vehiculo->getCodigoSimccar().",".$vehiculo->getEstadoVehiculo()->getCodigo().",".$vehiculo->getUnidad()->getCodigoUnidad().",'".$fecha."','".$fecha."');";
			
			//echo $sql;		
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		

		function listaSimccarDisponibles($unidad, $fechaServicio, $tipoServicio, $correlativo, $vehiculos){
	         
	         $sql  = "(";		 
	       	 $sql .= "SELECT 
	       	  SIMCCAR.SIM_SERIE,
					  SIMCCAR.SIM_CODIGO
					FROM
					  ESTADO_SIMCCAR
					  LEFT OUTER JOIN ESTADO ON (ESTADO_SIMCCAR.EST_CODIGO = ESTADO.EST_CODIGO)
					  RIGHT OUTER JOIN SIMCCAR ON (ESTADO_SIMCCAR.SIM_CODIGO = SIMCCAR.SIM_CODIGO)								      
					WHERE				 
					  (ESTADO_SIMCCAR.UNI_CODIGO = ".$unidad.") AND 
					  (ESTADO_SIMCCAR.FECHA_DESDE <= '".$fechaServicio."' AND (ESTADO_SIMCCAR.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_SIMCCAR.FECHA_HASTA IS NULL)) AND 
					  (ESTADO.EST_CODIGO IN(10))";
			
			if ($correlativo != ""){	  

				$sql .= " AND
					  	(SIMCCAR.SIM_CODIGO NOT IN (
					  		SELECT 
							  SIMCCAR_SERVICIO.SIM_CODIGO
							FROM
							  SIMCCAR_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (SIMCCAR_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (SIMCCAR_SERVICIO.UNI_CODIGO = ".$unidad ." AND SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
			}	
			
			
			
			
			$sql .= ") UNION (";
			
			$sql .= "SELECT 
			      SIMCCAR.SIM_SERIE,
					  SIMCCAR.SIM_CODIGO
					FROM
					  ESTADO_SIMCCAR
					  INNER JOIN SIMCCAR ON (ESTADO_SIMCCAR.SIM_CODIGO = SIMCCAR.SIM_CODIGO)
					WHERE
					  ESTADO_SIMCCAR.UNI_AGREGADO = ".$unidad." AND 
					  ESTADO_SIMCCAR.FECHA_DESDE <= '".$fechaServicio."' AND 
					  (ESTADO_SIMCCAR.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_SIMCCAR.FECHA_HASTA IS NULL)";
			
			if ($correlativo != ""){	  

				$sql .= " AND
					  	(SIMCCAR.SIM_CODIGO NOT IN (
					  		SELECT 
							  SIMCCAR_SERVICIO.SIM_CODIGO
							FROM
							  SIMCCAR_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (SIMCCAR_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (SIMCCAR_SERVICIO.UNI_CODIGO = ".$unidad ." AND SIMCCAR_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
			}
			
			$sql .= ")";
			
				
			$sql .= " ORDER BY SIM_SERIE";
			
			//echo $sql;

			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {
				
				$vehiculo = new dioscar;
				$vehiculo->setCodigoSimccar($myrow["SIM_CODIGO"]);
				$vehiculo->setSerieSimccar(STRTOUPPER($myrow["SIM_SERIE"]));

			
				
				$vehiculos[$i] = $vehiculo;					
				$i++;
			}
		}		
		
  
}//end class   
?>