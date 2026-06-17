<?
Class dbCaballos extends Conexion
{			
	
		function listaTotalCaballos($unidad, $caballos){

			
			$sql = "SELECT 
              CABALLO.CAB_CODIGO,
              CABALLO.CAB_BCU,
              CABALLO.CAB_NOMBRE,
              CABALLO.UNI_CODIGO,
              CABALLO.FECHA_NAC,
              CABALLO.CAB_RAZA,
              CABALLO.CAB_COLOR,
              CABALLO.CAB_PELAJE,
              CABALLO.CAB_SEXO,
              ESTADO.EST_CODIGO,
              ESTADO.EST_DESCRIPCION,
           	  ESTADO_ANIMAL.UNI_AGREGADO,
           	  UNIDAD_AGREGADO.UNI_DESCRIPCION,
           	  TIPO_ANIMAL.TANIM_CODIGO,
           	  TIPO_ANIMAL.TANIM_DESCRIPCION
           	  
          FROM
              ESTADO_ANIMAL
          LEFT OUTER JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
          RIGHT OUTER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
          INNER JOIN UNIDAD ON (CABALLO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
          LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ANIMAL.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
          LEFT OUTER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
              WHERE
              CABALLO.TANI_CODIGO=10 AND
          CABALLO.UNI_CODIGO=".$unidad." AND ESTADO_ANIMAL.FECHA_HASTA IS NULL";
			
	        $sql .= " ORDER BY TIPO_ANIMAL.TANIM_CODIGO";   		 
	    //$sql .= " ORDER BY caballo.CAB_CODIGO, caballo.CAB_NOMBRE";
			
			//echo $sql;

			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {
				
				$estado = new estadoVehiculo;
				$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
				$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
				
				$unidadAgregado = new unidad;
				$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
				$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
				
				$tipo = new tipoAnimal;
				$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
				$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));

				$vehiculo = new caballo;
				
				$vehiculo->setCodigoCaballo(STRTOUPPER($myrow["CAB_CODIGO"]));
				$vehiculo->setNombreCaballo(STRTOUPPER($myrow["CAB_NOMBRE"]));
				$vehiculo->setUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
				$vehiculo->setNumeroBCU($myrow["CAB_BCU"]);
				$vehiculo->setFechaNacimiento(STRTOUPPER($myrow["FECHA_NAC"]));
				$vehiculo->setRaza(STRTOUPPER($myrow["CAB_RAZA"]));
	    	$vehiculo->setColor(STRTOUPPER($myrow["CAB_COLOR"]));
				$vehiculo->setPelaje(STRTOUPPER($myrow["CAB_PELAJE"]));
				$vehiculo->setSexo(STRTOUPPER($myrow["CAB_SEXO"]));
				$vehiculo->setEstadoVehiculo($estado);
				$vehiculo->setUnidadAgregado($unidadAgregado);
				$vehiculo->setTipoAnimal($tipo);
				
				$caballos[$i] = $vehiculo;					
				$i++;
			}
		}
		
		function listaTotalPerros($unidad, $caballos){

			
			$sql = "SELECT 
              CABALLO.CAB_CODIGO,
              CABALLO.CAB_BCU,
              CABALLO.CAB_NOMBRE,
              CABALLO.UNI_CODIGO,
              CABALLO.FECHA_NAC,
              CABALLO.CAB_RAZA,
              CABALLO.CAB_COLOR,
              CABALLO.CAB_PELAJE,
              CABALLO.CAB_SEXO,
              ESTADO.EST_CODIGO,
              ESTADO.EST_DESCRIPCION,
           	  ESTADO_ANIMAL.UNI_AGREGADO,
           	  UNIDAD_AGREGADO.UNI_DESCRIPCION,
           	  TIPO_ANIMAL.TANIM_CODIGO,
           	  TIPO_ANIMAL.TANIM_DESCRIPCION
           	  
          FROM
              ESTADO_ANIMAL
          LEFT OUTER JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
          RIGHT OUTER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
          INNER JOIN UNIDAD ON (CABALLO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
          LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ANIMAL.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
          LEFT OUTER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
              WHERE
               CABALLO.TANI_CODIGO=40 AND
          CABALLO.UNI_CODIGO=".$unidad." AND ESTADO_ANIMAL.FECHA_HASTA IS NULL";
			
	        $sql .= " ORDER BY TIPO_ANIMAL.TANIM_CODIGO";   		 
	    //$sql .= " ORDER BY caballo.CAB_CODIGO, caballo.CAB_NOMBRE";
			
			//echo $sql;

			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {
				
				$estado = new estadoVehiculo;
				$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
				$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
				
				$unidadAgregado = new unidad;
				$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
				$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
				
				$tipo = new tipoAnimal;
				$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
				$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));

				$vehiculo = new caballo;
				
				$vehiculo->setCodigoCaballo(STRTOUPPER($myrow["CAB_CODIGO"]));
				$vehiculo->setNombreCaballo(STRTOUPPER($myrow["CAB_NOMBRE"]));
				$vehiculo->setUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
				$vehiculo->setNumeroBCU($myrow["CAB_BCU"]);
				$vehiculo->setFechaNacimiento(STRTOUPPER($myrow["FECHA_NAC"]));
				$vehiculo->setRaza(STRTOUPPER($myrow["CAB_RAZA"]));
	    	$vehiculo->setColor(STRTOUPPER($myrow["CAB_COLOR"]));
				$vehiculo->setPelaje(STRTOUPPER($myrow["CAB_PELAJE"]));
				$vehiculo->setSexo(STRTOUPPER($myrow["CAB_SEXO"]));
				$vehiculo->setEstadoVehiculo($estado);
				$vehiculo->setUnidadAgregado($unidadAgregado);
				$vehiculo->setTipoAnimal($tipo);
				
				$caballos[$i] = $vehiculo;					
				$i++;
			}
		}
		
		function listaTotalCaballosAgregados($unidad, $caballos){

			
			$sql = "SELECT 
              CABALLO.CAB_CODIGO,
              CABALLO.CAB_BCU,
              CABALLO.CAB_NOMBRE,
              CABALLO.UNI_CODIGO,
              CABALLO.FECHA_NAC,
              CABALLO.CAB_RAZA,
              CABALLO.CAB_COLOR,
              CABALLO.CAB_PELAJE,
              CABALLO.CAB_SEXO,
              ESTADO.EST_CODIGO,
              ESTADO.EST_DESCRIPCION,
           	  ESTADO_ANIMAL.UNI_AGREGADO,
           	  UNIDAD_AGREGADO.UNI_DESCRIPCION,
           	  TIPO_ANIMAL.TANIM_CODIGO,
           	  TIPO_ANIMAL.TANIM_DESCRIPCION
           	  
          FROM
              ESTADO_ANIMAL
          LEFT OUTER JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
          RIGHT OUTER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
          INNER JOIN UNIDAD ON (CABALLO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
          LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ANIMAL.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
          LEFT OUTER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
              WHERE
          ESTADO_ANIMAL.UNI_AGREGADO=".$unidad." AND ESTADO_ANIMAL.FECHA_HASTA IS NULL";
			
	         		 
	    $sql .= " ORDER BY CABALLO.CAB_CODIGO, CABALLO.CAB_NOMBRE";
			
			//echo $sql;

			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {
				
				$estado = new estadoVehiculo;
				$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
				$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
				
				$unidadAgregado = new unidad;
				$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
				$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
				
				$tipo = new tipoAnimal;
				$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
				$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));

				$vehiculo = new caballo;
				
				$vehiculo->setCodigoCaballo(STRTOUPPER($myrow["CAB_CODIGO"]));
				$vehiculo->setNombreCaballo(STRTOUPPER($myrow["CAB_NOMBRE"]));
				$vehiculo->setUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
				$vehiculo->setNumeroBCU($myrow["CAB_BCU"]);
				$vehiculo->setFechaNacimiento(STRTOUPPER($myrow["FECHA_NAC"]));
				$vehiculo->setRaza(STRTOUPPER($myrow["CAB_RAZA"]));
	    	$vehiculo->setColor(STRTOUPPER($myrow["CAB_COLOR"]));
				$vehiculo->setPelaje(STRTOUPPER($myrow["CAB_PELAJE"]));
				$vehiculo->setSexo(STRTOUPPER($myrow["CAB_SEXO"]));
				$vehiculo->setEstadoVehiculo($estado);
				$vehiculo->setUnidadAgregado($unidadAgregado);
				$vehiculo->setTipoAnimal($tipo);
				
				$caballos[$i] = $vehiculo;					
				$i++;
			}
		}
		
		function buscaDatosCaballos($codigoVehiculo, $bcuVehiculo, $caballo){

			
			$sql = "SELECT 
              CABALLO.CAB_CODIGO,
              CABALLO.CAB_BCU,
              CABALLO.CAB_NOMBRE,
              CABALLO.UNI_CODIGO,
              CABALLO.FECHA_NAC,
              CABALLO.CAB_RAZA,
              CABALLO.CAB_COLOR,
              CABALLO.CAB_PELAJE,
              CABALLO.CAB_SEXO,
              CABALLO.VERIFICACION_ESTADO,
              ESTADO.EST_CODIGO,
              ESTADO.EST_DESCRIPCION,
           	  UNIDAD_AGREGADO.UNI_DESCRIPCION AS DES_UNIDADGREGADO,
              UNIDAD.UNI_DESCRIPCION,
              TIPO_ANIMAL.TANIM_CODIGO,
              TIPO_ANIMAL.TANIM_DESCRIPCION,
              ESTADO_ANIMAL.FECHA_DESDE,
              ESTADO_ANIMAL.UNI_AGREGADO
          FROM
              ESTADO_ANIMAL
          LEFT OUTER JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
          RIGHT OUTER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
          LEFT OUTER JOIN UNIDAD ON (CABALLO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
          LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ANIMAL.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
          LEFT OUTER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
              WHERE
             ESTADO_ANIMAL.FECHA_HASTA IS NULL";
             
           if ($codigoVehiculo != "") $sql .= " AND CABALLO.CAB_CODIGO = ".$codigoVehiculo;
	         if ($bcuVehiculo != "") $sql .= " AND CABALLO.CAB_BCU = '".$bcuVehiculo."'";
			
	         		 
	    //$sql .= " ORDER BY caballo.CAB_CODIGO, caballo.CAB_NOMBRE";
			
			//echo $sql;

			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {

				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$unidadAgregado = new unidad;
				$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
				$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DES_UNIDADGREGADO"]));
				
								
				$estado = new estadoAnimal;
				$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
				$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
				$estado->setFechaDesde($myrow["FECHA_DESDE"]);
				
				$tipo = new tipoAnimal;
				$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
				$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));

				$caballo = new caballo;
				
				$caballo->setCodigoCaballo(STRTOUPPER($myrow["CAB_CODIGO"]));
				$caballo->setNombreCaballo(STRTOUPPER($myrow["CAB_NOMBRE"]));
			  $caballo->setUnidad($unidad);	
				$caballo->setNumeroBCU($myrow["CAB_BCU"]);
				$caballo->setFechaNacimiento(STRTOUPPER($myrow["FECHA_NAC"]));
				$caballo->setRaza(STRTOUPPER($myrow["CAB_RAZA"]));
	    	$caballo->setColor(STRTOUPPER($myrow["CAB_COLOR"]));
				$caballo->setPelaje(STRTOUPPER($myrow["CAB_PELAJE"]));
				$caballo->setSexo(STRTOUPPER($myrow["CAB_SEXO"]));
				$caballo->setVerifica(STRTOUPPER($myrow["VERIFICACION_ESTADO"]));
				$caballo->setEstadoVehiculo($estado);
				$caballo->setUnidadAgregado($unidadAgregado);
				$caballo->setTipoAnimal($tipo);
				
		
			}
		}
		
		function buscaCaballoL4($codigoBcu, $caballo){

			
			$sql = "SELECT 
             animales.codigo_animal,
             animales.nombre_animal,
             raza.descripcion_raza,
             animales.fecha_nacimiento,
             animales.sexo,
             animales.pelaje,
             animales.color
           FROM
            animales
            LEFT JOIN raza ON (animales.raza = raza.codigo_raza)
          WHERE
            animales.codigo_animal ='".$codigoBcu."'";
			         				
			//echo $sql;

			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {

				$caballo = new caballo;
				
				$caballo->setNumeroBCU($myrow["codigo_animal"]);
				$caballo->setNombreCaballo(STRTOUPPER($myrow["nombre_animal"]));
				$caballo->setFechaNacimiento(STRTOUPPER($myrow["fecha_nacimiento"]));
				$caballo->setRaza(STRTOUPPER($myrow["descripcion_raza"]));
				$caballo->setSexo(STRTOUPPER($myrow["sexo"]));
				$caballo->setPelaje(STRTOUPPER($myrow["pelaje"]));
				$caballo->setColor(STRTOUPPER($myrow["color"]));
				
				
			}
		}
		
			function updateEstadoAnimal($vehiculo, $fechaNuevoEstado){
			
			$sql = "UPDATE ESTADO_ANIMAL SET
					FECHA_HASTA = '".$fechaNuevoEstado."'
					WHERE ANI_CODIGO = ".$vehiculo->getCodigoCaballo()." AND FECHA_HASTA IS NULL";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}		
		
		function insertEstadoAnimal($vehiculo, $fechaNuevoEstado){
			
			//echo "aqui";
			
			//echo "jjjj " . $vehiculo->getLugarReparacion()->getCodigo();
			

			
			if ($vehiculo->getUnidadAgregado()->getCodigoUnidad() == 0) $unidadAgregadoGuardar = 'NULL';
			else $unidadAgregadoGuardar = $vehiculo->getUnidadAgregado()->getCodigoUnidad();
							
			$sql = "INSERT INTO ESTADO_ANIMAL (ANI_CODIGO, EST_CODIGO, UNI_CODIGO, FECHA_DESDE, UNI_AGREGADO, SEC_CODIGO)
					VALUES (".$vehiculo->getCodigoCaballo().",".$vehiculo->getEstadoVehiculo()->getCodigo().",".$vehiculo->getUnidad()->getCodigoUnidad().",'".$fechaNuevoEstado."',".$unidadAgregadoGuardar.", NULL)";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
			function bajaAnimal($vehiculo, $motivo, $fecha){ 
			
			$sql = "INSERT INTO ESTADO_ANIMAL(ANI_CODIGO,EST_CODIGO, UNI_CODIGO, FECHA_DESDE, FECHA_HASTA)
				   VALUES (".$vehiculo->getCodigoCaballo().",".$vehiculo->getEstadoVehiculo()->getCodigo().",".$vehiculo->getUnidad()->getCodigoUnidad().",'".$fecha."','".$fecha."');";
			
			//echo $sql;		
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
			function updateAnimal($vehiculo){
				
			$sql = "UPDATE CABALLO SET
			    TANI_CODIGO = " .$vehiculo->getTipoAnimal().", 
					CAB_BCU = '" . $vehiculo->getNumeroBCU() . "', 
					CAB_NOMBRE = '".$vehiculo->getNombreCaballo(). "',
					UNI_CODIGO = ".$vehiculo->getUnidad()->getCodigoUnidad(). ",
					CAB_RAZA = '".$vehiculo->getRaza(). "',
					CAB_COLOR = '".$vehiculo->getColor(). "',
					CAB_PELAJE = '".$vehiculo->getPelaje(). "',
					VERIFICACION_ESTADO = '".$vehiculo->getVerifica(). "'

					WHERE CAB_CODIGO =" . $vehiculo->getCodigoCaballo();
			
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}	
		
			function dejarDisponible($vehiculo, $fecha){
			
			$sql = "UPDATE CABALLO SET UNI_CODIGO = Null WHERE CAB_CODIGO = " . $vehiculo->getCodigoCaballo();
			
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			//$result	= 1;
			return $result;
		}
		
		function nuevoAnimal($vehiculo){ 
			


			$sql = "INSERT INTO CABALLO
				   (TANI_CODIGO, CAB_BCU, CAB_NOMBRE, UNI_CODIGO, FECHA_NAC, CAB_RAZA, CAB_COLOR, CAB_PELAJE, CAB_SEXO, VERIFICACION_ESTADO) VALUES
			 	   (".$vehiculo->getTipoAnimal().", 
			 	   '".$vehiculo->getNumeroBCU()."',
			 	    '".$vehiculo->getNombreCaballo()."',
			 	    ".$vehiculo->getUnidad()->getCodigoUnidad(). ",
			 	     '".$vehiculo->getFechaNacimiento()."',
			 	     '".$vehiculo->getRaza()."',
			 	    '".$vehiculo->getColor()."',
			 	    '".$vehiculo->getPelaje()."',
			 	    '".$vehiculo->getSexo()."',
			 	    '".$vehiculo->getVerifica()."')";
			 	    
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			//return $result;
			return mysql_insert_id($this->Conecta()); 
		}
		
		function listaAnimalesDisponibles($unidad, $fechaServicio, $tipoServicio, $correlativo, $vehiculos){
	         
	         $sql  = "(";		 
	       	 $sql .= "SELECT 
	       	  CABALLO.CAB_NOMBRE,
					  CABALLO.CAB_BCU,
					  CABALLO.CAB_CODIGO,
					  TIPO_ANIMAL.TANIM_DESCRIPCION,
					  CABALLO.TANI_CODIGO
					FROM
					  ESTADO_ANIMAL
					  LEFT OUTER JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
					  RIGHT OUTER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
					  INNER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)				      
					WHERE
					  (CABALLO.TANI_CODIGO = 10) AND 
					  (ESTADO_ANIMAL.UNI_CODIGO = ".$unidad.") AND 
					  (ESTADO_ANIMAL.FECHA_DESDE <= '".$fechaServicio."' AND (ESTADO_ANIMAL.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_ANIMAL.FECHA_HASTA IS NULL)) AND 
					  (ESTADO.EST_CODIGO IN(10))";
			
			if ($correlativo != ""){	  

				$sql .= " AND
					  	(CABALLO.CAB_CODIGO NOT IN (
					  		SELECT 
							  ANIMALES_SERVICIO.ANIM_CODIGO
							FROM
							  ANIMALES_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (ANIMALES_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (ANIMALES_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (ANIMALES_SERVICIO.UNI_CODIGO = ".$unidad ." AND ANIMALES_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
			}	
			
			
			
			
			$sql .= ") UNION (";
			
			$sql .= "SELECT 
			      CABALLO.CAB_NOMBRE,
						CABALLO.CAB_BCU,
					  CABALLO.CAB_CODIGO,
					  TIPO_ANIMAL.TANIM_DESCRIPCION,
					  CABALLO.TANI_CODIGO
					FROM
					  ESTADO_ANIMAL
					  INNER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
					  INNER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
					WHERE
					  CABALLO.TANI_CODIGO = 10 AND
					  ESTADO_ANIMAL.UNI_AGREGADO = ".$unidad." AND 
					  ESTADO_ANIMAL.FECHA_DESDE <= '".$fechaServicio."' AND 
					  (ESTADO_ANIMAL.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_ANIMAL.FECHA_HASTA IS NULL)";
			
			if ($correlativo != ""){	  

				$sql .= " AND
					  	(CABALLO.CAB_CODIGO NOT IN (
					  		SELECT 
							  ANIMALES_SERVICIO.ANIM_CODIGO
							FROM
							  ANIMALES_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (ANIMALES_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (ANIMALES_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (ANIMALES_SERVICIO.UNI_CODIGO = ".$unidad ." AND ANIMALES_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
			}
			
			$sql .= ")";
			
				
			$sql .= " ORDER BY TANIM_DESCRIPCION, CAB_NOMBRE";
			
			//echo $sql;

			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {
				
				$tipo = new tipoAnimal;
				$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
				$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));
											
				$vehiculo = new caballo;
				$vehiculo->setCodigoCaballo(STRTOUPPER($myrow["CAB_CODIGO"]));
				$vehiculo->setTipoAnimal($tipo);
				$vehiculo->setNumeroBCU(STRTOUPPER($myrow["CAB_BCU"]));
				$vehiculo->setNombreCaballo(STRTOUPPER($myrow["CAB_NOMBRE"]));
			
				
				$vehiculos[$i] = $vehiculo;					
				$i++;
			}
		}
		
		function listaPerrosDisponibles($unidad, $fechaServicio, $tipoServicio, $correlativo, $vehiculos){
	         
	         $sql  = "(";		 
	       	 $sql .= "SELECT 
	       	  CABALLO.CAB_NOMBRE,
					  CABALLO.CAB_BCU,
					  CABALLO.CAB_CODIGO,
					  TIPO_ANIMAL.TANIM_DESCRIPCION,
					  CABALLO.TANI_CODIGO
					FROM
					  ESTADO_ANIMAL
					  LEFT OUTER JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
					  RIGHT OUTER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
					  INNER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)				      
					WHERE
					  (CABALLO.TANI_CODIGO = 40) AND 
					  (ESTADO_ANIMAL.UNI_CODIGO = ".$unidad.") AND 
					  (ESTADO_ANIMAL.FECHA_DESDE <= '".$fechaServicio."' AND (ESTADO_ANIMAL.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_ANIMAL.FECHA_HASTA IS NULL)) AND 
					  (ESTADO.EST_CODIGO IN(10))";
			
			if ($correlativo != ""){	  

				$sql .= " AND
					  	(CABALLO.CAB_CODIGO NOT IN (
					  		SELECT 
							  ANIMALES_SERVICIO.ANIM_CODIGO
							FROM
							  ANIMALES_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (ANIMALES_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (ANIMALES_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (ANIMALES_SERVICIO.UNI_CODIGO = ".$unidad ." AND ANIMALES_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
			}	
			
			
			
			
			$sql .= ") UNION (";
			
			$sql .= "SELECT 
			      CABALLO.CAB_NOMBRE,
						CABALLO.CAB_BCU,
					  CABALLO.CAB_CODIGO,
					  TIPO_ANIMAL.TANIM_DESCRIPCION,
					  CABALLO.TANI_CODIGO
					FROM
					  ESTADO_ANIMAL
					  INNER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
					  INNER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
					WHERE
					  CABALLO.TANI_CODIGO = 40 AND
					  ESTADO_ANIMAL.UNI_AGREGADO = ".$unidad." AND 
					  ESTADO_ANIMAL.FECHA_DESDE <= '".$fechaServicio."' AND 
					  (ESTADO_ANIMAL.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_ANIMAL.FECHA_HASTA IS NULL)";
			
			if ($correlativo != ""){	  

				$sql .= " AND
					  	(CABALLO.CAB_CODIGO NOT IN (
					  		SELECT 
							  ANIMALES_SERVICIO.ANIM_CODIGO
							FROM
							  ANIMALES_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (ANIMALES_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (ANIMALES_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (ANIMALES_SERVICIO.UNI_CODIGO = ".$unidad ." AND ANIMALES_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
			}
			
			$sql .= ")";
			
				
			$sql .= " ORDER BY TANIM_DESCRIPCION, CAB_NOMBRE";
			
			//echo $sql;

			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {
				
				$tipo = new tipoAnimal;
				$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
				$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));
											
				$vehiculo = new caballo;
				$vehiculo->setCodigoCaballo(STRTOUPPER($myrow["CAB_CODIGO"]));
				$vehiculo->setTipoAnimal($tipo);
				$vehiculo->setNumeroBCU(STRTOUPPER($myrow["CAB_BCU"]));
				$vehiculo->setNombreCaballo(STRTOUPPER($myrow["CAB_NOMBRE"]));
			
				
				$vehiculos[$i] = $vehiculo;					
				$i++;
			}
		}
		
}//end class        
?>