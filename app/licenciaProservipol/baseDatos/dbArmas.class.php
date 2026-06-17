<?
Class dbArmas extends Conexion
{			
	//Funcion modificada l 05-05-2015
    //Campos agregados: TIPO_SECCION.SEC_DESCRIPCION
		function listaTotalArmas($unidad, $armaBuscar, $armas){

			$sql = "SELECT 
					  ARMA.ARM_CODIGO,
					  ARMA.EST_CODIGO,
					  ESTADO.EST_DESCRIPCION,
					  ARMA.MODARM_CODIGO,
					  MODELO_ARMA.MODARM_DESCRIPCION,
					  MODELO_ARMA.MARM_CODIGO,
					  MARCA_ARMA.MARM_DESCRIPCION,
					  ARMA.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  ARMA.TARM_CODIGO,
					  TIPO_ARMA.TARM_DESCRIPCION,
					  ARMA.ARM_NUMEROINSTITUCIONAL
					FROM
					  ARMA
					INNER JOIN ESTADO ON (ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
					INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
					INNER JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
					INNER JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				  	INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
	         		WHERE 
	         		  ARMA.UNI_CODIGO = ".$unidad;
	         		  
	        $sql = "SELECT 
					  ARMA.ARM_CODIGO,
					  ARMA.MODARM_CODIGO,
					  MODELO_ARMA.MODARM_DESCRIPCION,
					  MODELO_ARMA.MARM_CODIGO,
					  MARCA_ARMA.MARM_DESCRIPCION,
					  ARMA.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  ARMA.TARM_CODIGO,
					  TIPO_ARMA.TARM_DESCRIPCION,
					  ARMA.ARM_NUMEROSERIE,
					  ESTADO.EST_CODIGO,
					  ESTADO.EST_DESCRIPCION,
					  ESTADO_ARMA.UNI_AGREGADO,
  					  UNIDAD_AGREGADO.UNI_DESCRIPCION,
                      TIPO_SECCION.SEC_DESCRIPCION
					FROM
					  ARMA
					  INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
					  INNER JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
					  INNER JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
					  LEFT OUTER JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
					  LEFT OUTER JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
					  LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ARMA.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
                      LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ARMA.SEC_CODIGO)
					WHERE
					  ARMA.UNI_CODIGO = ".$unidad." AND 
					  ESTADO_ARMA.FECHA_HASTA IS NULL";
	         
	        if ($armaBuscar != "") $sql .= " AND ARMA.ARM_NUMEROSERIE like '%".$armaBuscar."%' ";
	         		 
	        $sql .= " ORDER BY ARMA.TARM_CODIGO, ARMA.ARM_CODIGO";
	        	         			
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {
				$tipo = new tipoArma;
				$tipo->setCodigo(STRTOUPPER($myrow["TARM_CODIGO"]));
				$tipo->setDescripcion(STRTOUPPER($myrow["TARM_DESCRIPCION"]));
				
				$marca = new marcaArma;
				$marca->setCodigo(STRTOUPPER($myrow["MARM_CODIGO"]));
				$marca->setDescripcion(STRTOUPPER($myrow["MARM_DESCRIPCION"]));
				
				$modelo = new modeloArma;
				$modelo->setMarcaArma($marca);
				$modelo->setCodigo(STRTOUPPER($myrow["MODARM_CODIGO"]));
				$modelo->setDescripcion(STRTOUPPER($myrow["MODARM_DESCRIPCION"]));
								
				$estado = new estadoRecurso;
				$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
				$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
				
				$unidadAgregado = new unidad;
				$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
				$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
                
                //Instancia agregada el 05-05-2015
 			    $seccion = new seccion; 
				$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
				$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
								
				$arma = new arma;
				$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
				$arma->setTipo($tipo);
				$arma->setModelo($modelo);
				$arma->setEstado($estado);
				$arma->setNumeroSerie(STRTOUPPER($myrow["ARM_NUMEROSERIE"]));
				$arma->setUnidad("");
				$arma->setUnidadAgregado($unidadAgregado);
                $arma->setSeccion($seccion); //Llamada agregada el 05-05-2015
			
				$armas[$i] = $arma;					
				$i++;
			}
		}
		
				/* Agregadas */
				function listaTotalArmasAgregadas($unidad, $armaBuscar, $armas){

			$sql = "SELECT 
					  ARMA.ARM_CODIGO,
					  ARMA.EST_CODIGO,
					  ESTADO.EST_DESCRIPCION,
					  ARMA.MODARM_CODIGO,
					  MODELO_ARMA.MODARM_DESCRIPCION,
					  MODELO_ARMA.MARM_CODIGO,
					  MARCA_ARMA.MARM_DESCRIPCION,
					  ARMA.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  ARMA.TARM_CODIGO,
					  TIPO_ARMA.TARM_DESCRIPCION,
					  ARMA.ARM_NUMEROINSTITUCIONAL
					FROM
					  ARMA
					INNER JOIN ESTADO ON (ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
					INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
					INNER JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
					INNER JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				  	INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
	         		WHERE 
	         		  ARMA.UNI_CODIGO = ".$unidad;
	         		  
	        $sql = "SELECT 
					  ARMA.ARM_CODIGO,
					  ARMA.MODARM_CODIGO,
					  MODELO_ARMA.MODARM_DESCRIPCION,
					  MODELO_ARMA.MARM_CODIGO,
					  MARCA_ARMA.MARM_DESCRIPCION,
					  ARMA.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  ARMA.TARM_CODIGO,
					  TIPO_ARMA.TARM_DESCRIPCION,
					  ARMA.ARM_NUMEROSERIE,
					  ESTADO.EST_CODIGO,
					  ESTADO.EST_DESCRIPCION,
					  ESTADO_ARMA.UNI_CODIGO AS Cod_Origen,
  					UNIDAD.UNI_DESCRIPCION AS Des_Origen,
           	TIPO_SECCION.SEC_DESCRIPCION
					FROM
					  ARMA
					  INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
					  INNER JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
					  INNER JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
					  LEFT OUTER JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
					  LEFT OUTER JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
					  LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ARMA.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
            LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ARMA.SEC_CODIGO)
					WHERE
					  ESTADO_ARMA.UNI_AGREGADO = ".$unidad." AND 
					  ESTADO_ARMA.FECHA_HASTA IS NULL";
	         
	        if ($armaBuscar != "") $sql .= " AND ARMA.ARM_NUMEROSERIE like '%".$armaBuscar."%' ";
	         		 
	        $sql .= " ORDER BY ARMA.TARM_CODIGO, ARMA.ARM_CODIGO";
	        	         			
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {
				$tipo = new tipoArma;
				$tipo->setCodigo(STRTOUPPER($myrow["TARM_CODIGO"]));
				$tipo->setDescripcion(STRTOUPPER($myrow["TARM_DESCRIPCION"]));
				
				$marca = new marcaArma;
				$marca->setCodigo(STRTOUPPER($myrow["MARM_CODIGO"]));
				$marca->setDescripcion(STRTOUPPER($myrow["MARM_DESCRIPCION"]));
				
				$modelo = new modeloArma;
				$modelo->setMarcaArma($marca);
				$modelo->setCodigo(STRTOUPPER($myrow["MODARM_CODIGO"]));
				$modelo->setDescripcion(STRTOUPPER($myrow["MODARM_DESCRIPCION"]));
								
				$estado = new estadoRecurso;
				$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
				$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
				
				$unidadAgregado = new unidad;
				$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["Cod_Origen"]));
				$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["Des_Origen"]));
                
                //Instancia agregada el 05-05-2015
 			    $seccion = new seccion; 
				$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
				$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
								
				$arma = new arma;
				$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
				$arma->setTipo($tipo);
				$arma->setModelo($modelo);
				$arma->setEstado($estado);
				$arma->setNumeroSerie(STRTOUPPER($myrow["ARM_NUMEROSERIE"]));
				$arma->setUnidad("");
				$arma->setUnidadAgregado($unidadAgregado);
                $arma->setSeccion($seccion); //Llamada agregada el 05-05-2015
			
				$armas[$i] = $arma;					
				$i++;
			}
		}
		/*---------------------------------------------------------------------------------------------------------*/
		
		function listaArmasDisponibles($unidad, $fechaServicio, $tipoServicio, $correlativo, $armas){

			//$sql = "SELECT 
			//			  ARMA.ARM_CODIGO,
			//			  TIPO_ARMA.TARM_DESCRIPCION,
			//			  ARMA.ARM_NUMEROSERIE
			//			FROM
			//			  ARMA
			//			  INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
			//			  LEFT OUTER JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
			//			  LEFT OUTER JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
			//			WHERE
			//			  (ARMA.UNI_CODIGO = ".$unidad.") AND 
			//			  (ESTADO.EST_CODIGO = 10) AND
			//			  (ESTADO_ARMA.FECHA_DESDE <= '".$fechaServicio."' AND (ESTADO_ARMA.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_ARMA.FECHA_HASTA IS NULL)) AND
			//			  (ARMA.ARM_CODIGO NOT IN (    
			//					SELECT 
			//					  ARMA_SERVICIO.ARM_CODIGO
			//					FROM
			//					  ARMA_SERVICIO
			//					  LEFT OUTER JOIN SERVICIO ON (ARMA_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
			//					  AND (ARMA_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
			//					WHERE
			//					  SERVICIO.TSERV_CODIGO = ".$tipoServicio." AND 
			//					  SERVICIO.FECHA = '".$fechaServicio."'))";
			
			
			
			$sql  = "(";	
			$sql .= "SELECT 
						  ARMA.ARM_CODIGO,
						  TIPO_ARMA.TARM_DESCRIPCION,
						  ARMA.ARM_NUMEROSERIE
						FROM
						  ARMA
						  INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
						  LEFT OUTER JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
						  LEFT OUTER JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
						WHERE
						  (ARMA.UNI_CODIGO = ".$unidad.") AND 
						  (ESTADO.EST_CODIGO = 10) AND
						  (ESTADO_ARMA.FECHA_DESDE <= '".$fechaServicio."' AND (ESTADO_ARMA.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_ARMA.FECHA_HASTA IS NULL))";


			if ($correlativo != ""){
										  
				$sql .=	" AND (ARMA.ARM_CODIGO NOT IN (    
								SELECT 
								  ARMA_SERVICIO.ARM_CODIGO
								FROM
								  ARMA_SERVICIO
								  LEFT OUTER JOIN SERVICIO ON (ARMA_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
								  AND (ARMA_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
								WHERE
								  (ARMA_SERVICIO.UNI_CODIGO = ".$unidad ." AND ARMA_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";    
			}
			
			$sql .= ") UNION (";
			
			$sql .= "SELECT 
					   ARMA.ARM_CODIGO,
					   TIPO_ARMA.TARM_DESCRIPCION,
					   ARMA.ARM_NUMEROSERIE
					FROM
					   ARMA
					   INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
					   LEFT OUTER JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
					   LEFT OUTER JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
					WHERE
					  ESTADO_ARMA.UNI_AGREGADO = ".$unidad." AND 
					  ESTADO_ARMA.FECHA_DESDE <= '".$fechaServicio."' AND 
					  (ESTADO_ARMA.FECHA_HASTA > '".$fechaServicio."' OR ESTADO_ARMA.FECHA_HASTA IS NULL)";
			
			if ($correlativo != ""){	  

				$sql .= " AND
					  	(ARMA.ARM_CODIGO NOT IN (
					  		SELECT 
							  ARMA_SERVICIO.ARM_CODIGO
							FROM
							  ARMA_SERVICIO
							  LEFT OUTER JOIN SERVICIO ON (ARMA_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
							  AND (ARMA_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
							  WHERE (ARMA_SERVICIO.UNI_CODIGO = ".$unidad ." AND ARMA_SERVICIO.CORRELATIVO_SERVICIO = ".$correlativo.")))";
			}
			
			$sql .= ")";
	         		 
	        $sql .= " ORDER BY TARM_DESCRIPCION, ARM_CODIGO";
	        
	        
	        
	        	         			
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) ){
				$tipo = new tipoArma;
				$tipo->setCodigo("");
				$tipo->setDescripcion(STRTOUPPER($myrow["TARM_DESCRIPCION"]));
						
				$arma = new arma;
				$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
				$arma->setTipo($tipo);
				$arma->setNumeroSerie(STRTOUPPER($myrow["ARM_NUMEROSERIE"]));
			
				$armas[$i] = $arma;					
				$i++;
			}
		}
		
		//Funcion modificada el 05-05-2015
		function buscaDatosArma($armaBuscar, $arma){

			$sql = "SELECT 
					  ARMA.ARM_CODIGO,
					  ARMA.EST_CODIGO,
					  ESTADO.EST_DESCRIPCION,
					  ARMA.MODARM_CODIGO,
					  MODELO_ARMA.MODARM_DESCRIPCION,
					  MODELO_ARMA.MARM_CODIGO,
					  MARCA_ARMA.MARM_DESCRIPCION,
					  ARMA.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  ARMA.TARM_CODIGO,
					  TIPO_ARMA.TARM_DESCRIPCION,
					  ARMA.ARM_NUMEROINSTITUCIONAL
					FROM
					  ARMA
					INNER JOIN ESTADO ON (ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
					INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
					INNER JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
					INNER JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				  	INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
	         		WHERE 
	         		  ARMA.ARM_CODIGO = ".$armaBuscar;
	        
	        
	        $sql = "SELECT 
					  ARMA.ARM_CODIGO,
					  ARMA.MODARM_CODIGO,
					  MODELO_ARMA.MODARM_DESCRIPCION,
					  MODELO_ARMA.MARM_CODIGO,
					  MARCA_ARMA.MARM_DESCRIPCION,
					  ARMA.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  ARMA.TARM_CODIGO,
					  TIPO_ARMA.TARM_DESCRIPCION,
					  ARMA.ARM_NUMEROSERIE,
					  ESTADO.EST_CODIGO,
					  ESTADO.EST_DESCRIPCION,
					  ESTADO_ARMA.FECHA_DESDE,
					  ARMA.ARM_BCU,
					  ESTADO_ARMA.UNI_AGREGADO,
					  UNIDAD_AGREGADO.UNI_DESCRIPCION AS DES_UNIDADGREGADO,
                      TIPO_SECCION.SEC_CODIGO,
                      TIPO_SECCION.SEC_DESCRIPCION
					FROM
					  ARMA
					  INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
					  INNER JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
					  LEFT OUTER JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
					  LEFT OUTER JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
					  LEFT OUTER JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
					  LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ARMA.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
                      LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ARMA.SEC_CODIGO)
					WHERE
					  ARMA.ARM_CODIGO = ".$armaBuscar." AND 
					  ESTADO_ARMA.FECHA_HASTA IS NULL";
	        
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {
				$tipo = new tipoArma;
				$tipo->setCodigo(STRTOUPPER($myrow["TARM_CODIGO"]));
				$tipo->setDescripcion(STRTOUPPER($myrow["TARM_DESCRIPCION"]));
				
				$marca = new marcaArma;
				$marca->setCodigo(STRTOUPPER($myrow["MARM_CODIGO"]));
				$marca->setDescripcion(STRTOUPPER($myrow["MARM_DESCRIPCION"]));
				
				$modelo = new modeloArma;
				$modelo->setMarcaArma($marca);
				$modelo->setCodigo(STRTOUPPER($myrow["MODARM_CODIGO"]));
				$modelo->setDescripcion(STRTOUPPER($myrow["MODARM_DESCRIPCION"]));
								
				$estado = new estadoRecurso;
				$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
				$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
				$estado->setFechaDesde($myrow["FECHA_DESDE"]);
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
				$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
				
				$unidadAgregado = new unidad;
				$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
				$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DES_UNIDADGREGADO"]));
                
                //Instancia agregada el 05-05-2015
               	$seccion = new seccion; 
				$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
				$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
								
				$arma = new arma;
				$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
				$arma->setTipo($tipo);
				$arma->setModelo($modelo);
				$arma->setEstado($estado);
				$arma->setNumeroSerie(STRTOUPPER($myrow["ARM_NUMEROSERIE"]));
				$arma->setUnidad($unidad);
				$arma->setNumeroBCU($myrow["ARM_BCU"]);
				$arma->setUnidadAgregado($unidadAgregado);
   	            $arma->setSeccion($seccion); //Llamada agregada el 05-05-2015
			}
		}
		
		
		function buscaDatosArmaPorSerie($armaBuscar, $arma){

			$sql = "SELECT 
					  ARMA.ARM_CODIGO
					FROM
					  ARMA
					  INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
					  INNER JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
					  LEFT OUTER JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
					  LEFT OUTER JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
					  LEFT OUTER JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
					WHERE
					  ARMA.ARM_NUMEROSERIE = '".$armaBuscar."' AND 
					  ESTADO_ARMA.FECHA_HASTA IS NULL";
	        
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) )  {
				$arma = new arma;
				$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
			}
		}
		
		
		function updateArma($arma){
			$sql = "UPDATE ARMA SET
					ARM_NUMEROINSTITUCIONAL = '".$arma->getNumeroSerie(). "',
					UNI_CODIGO = '".$arma->getUnidad()->getCodigoUnidad(). "',
					TARM_CODIGO = ".$arma->getTipo()->getCodigo(). ",
					MODARM_CODIGO = '".$arma->getModelo()->getCodigo(). "',
					EST_CODIGO =".$arma->getEstado()->getCodigo(). "
					WHERE ARM_CODIGO ='" . $arma->getCodigo(). "'";
					
			$sql = "UPDATE ARMA SET
					ARM_NUMEROSERIE = '".$arma->getNumeroSerie(). "',
					UNI_CODIGO = '".$arma->getUnidad()->getCodigoUnidad(). "',
					TARM_CODIGO = ".$arma->getTipo()->getCodigo(). ",
					MODARM_CODIGO = '".$arma->getModelo()->getCodigo(). "',
					ARM_BCU = '".$arma->getNumeroBCU(). "'
					WHERE ARM_CODIGO ='" . $arma->getCodigo(). "'";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			return $result;
		}
		
		function updateEstadoArma($arma, $fechaNuevoEstado){
			
			$sql = "UPDATE ESTADO_ARMA SET
					FECHA_HASTA = '".$fechaNuevoEstado."'
					WHERE ARM_CODIGO = ".$arma->getCodigo()." AND FECHA_HASTA IS NULL";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}		
		
        //Funcion modificada el 06-05-2015
        //Campo agregado: SEC_CODIGO
		function insertEstadoArma($arma, $fechaNuevoEstado){
			
			//echo "hfhfhf = " . $arma->getUnidadAgregado()->getCodigoUnidad() . " --- ";
			
			if ($arma->getUnidadAgregado()->getCodigoUnidad() == 0) $unidadAgregadoGuardar = 'NULL';
			else $unidadAgregadoGuardar = $arma->getUnidadAgregado()->getCodigoUnidad();
            
            //Condicion agregada el 06-05-2015
           	if ($arma->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
			else $seccionGuardar = $arma->getSeccion()->getCodigo();
			
			
			$sql = "INSERT INTO ESTADO_ARMA (EST_CODIGO, UNI_CODIGO, ARM_CODIGO, FECHA_DESDE, UNI_AGREGADO, SEC_CODIGO) 
					VALUES (".$arma->getEstado()->getCodigo().",".$arma->getUnidad()->getCodigoUnidad().",".$arma->getCodigo().",'".$fechaNuevoEstado."',".$unidadAgregadoGuardar.",".$seccionGuardar.")";
			
			//echo "entre";
			
			//echo $sql;
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
		
		
		function nuevaArma($arma){ 

			$sql = "INSERT INTO ARMA 
				   (ARM_NUMEROSERIE, TARM_CODIGO, MODARM_CODIGO, UNI_CODIGO) VALUES
			 	   ('".$arma->getNumeroSerie()."',
			 	    '".$arma->getTipo()->getCodigo()."',
			 	     ".$arma->getModelo()->getCodigo().",
			 	    '".$arma->getUnidad()->getCodigoUnidad()."')";
			 	    
			//echo $sql ."\n";
			//$result = 1;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return mysql_insert_id($this->Conecta()); 
			//return $result;
		}
		
		
		function dejarDisponible($arma, $fecha){
			
			$sql = "UPDATE ARMA SET UNI_CODIGO = Null WHERE ARM_CODIGO = " . $arma->getCodigo();
			
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			//$result	= 1;
			return $result;
		}
				
		
		function bajaArma($arma, $motivo, $fechaBaja){ 
							
			$sql = "INSERT INTO ESTADO_ARMA (EST_CODIGO, ARM_CODIGO, FECHA_DESDE, FECHA_HASTA)
					VALUES (".$arma->getEstado()->getCodigo().",".$arma->getCodigo().",'".$fechaBaja."','".$fechaBaja."');";
			
			//echo $sql;		
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			return $result;
		}
					
}//end class        
?>