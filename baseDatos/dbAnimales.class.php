<?
Class dbAnimal extends Conexion{			
	
	function listaTotalCaballos($unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $Animales){
		
		if ($NombreCampo == "tipo")  $campoOrdenar = "CABALLO.CAB_CODIGO ".$TipoOrden;
		if ($NombreCampo == "nombre") $campoOrdenar = "CABALLO.CAB_NOMBRE ".$TipoOrden;
		if ($NombreCampo == "color") $campoOrdenar = "CABALLO.CAB_RAZA ".$TipoOrden;
		if ($NombreCampo == "bcu")  $campoOrdenar = "CABALLO.CAB_BCU ".$TipoOrden;
		if ($NombreCampo == "seccion")  $campoOrdenar = "TIPO_SECCION.SEC_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "estado")  $campoOrdenar = "ESTADO.EST_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "unidad")  $campoOrdenar = "UNIDAD_AGREGADO.UNI_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "") $campoOrdenar = "TIPO_ANIMAL.TANIM_CODIGO ASC";
		
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
	       	  TIPO_ANIMAL.TANIM_DESCRIPCION,
          	ESTADO_ANIMAL.SEC_CODIGO,
				  	TIPO_SECCION.SEC_DESCRIPCION
	      FROM  ESTADO_ANIMAL
	      LEFT OUTER JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
	      RIGHT OUTER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
	      INNER JOIN UNIDAD ON (CABALLO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
	      LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ANIMAL.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
	      LEFT OUTER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
        LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ANIMAL.SEC_CODIGO)
	      WHERE CABALLO.TANI_CODIGO=10 AND CABALLO.UNI_CODIGO=".$unidad." AND ESTADO_ANIMAL.FECHA_HASTA IS NULL";
	  
	  if ($nombreBuscar != "") $sql .= " AND CABALLO.CAB_NOMBRE LIKE '%".$nombreBuscar."%' ";	

		$sql .= " ORDER BY ".$campoOrdenar;
	  	 
	  //$sql .= " ORDER BY caballo.CAB_CODIGO, caballo.CAB_NOMBRE";
		//echo $sql;
	
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ) {
			
			$estado = new estadoVehiculo;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			
			$tipo = new tipoAnimal;
			$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));
			
			$seccion = new seccion; //Instancia agregada el 28-04-2015
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$animal = new animal;
			$animal->setCodigoAnimal(STRTOUPPER($myrow["CAB_CODIGO"]));
			$animal->setNombreAnimal(STRTOUPPER($myrow["CAB_NOMBRE"]));
			$animal->setUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$animal->setNumeroBCU($myrow["CAB_BCU"]);
			$animal->setFechaNacimiento(STRTOUPPER($myrow["FECHA_NAC"]));
			$animal->setRaza(STRTOUPPER($myrow["CAB_RAZA"]));
	  	$animal->setColor(STRTOUPPER($myrow["CAB_COLOR"]));
			$animal->setPelaje(STRTOUPPER($myrow["CAB_PELAJE"]));
			$animal->setSexo(STRTOUPPER($myrow["CAB_SEXO"]));
			$animal->setEstadoAnimal($estado);
			$animal->setUnidadAgregado($unidadAgregado);
			$animal->setTipoAnimal($tipo);
      $animal->setSeccion($seccion);
			
			$Animales[$i] = $animal;					
			$i++;
		}
	}
	
	function listaTotalPerros($unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $Animales){
		
		if ($NombreCampo == "tipo")  $campoOrdenar = "CABALLO.CAB_CODIGO ".$TipoOrden;
		if ($NombreCampo == "nombre") $campoOrdenar = "CABALLO.CAB_NOMBRE ".$TipoOrden;
		if ($NombreCampo == "color") $campoOrdenar = "CABALLO.CAB_RAZA ".$TipoOrden;
		if ($NombreCampo == "bcu")  $campoOrdenar = "CABALLO.CAB_BCU ".$TipoOrden;
		if ($NombreCampo == "seccion")  $campoOrdenar = "TIPO_SECCION.SEC_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "estado")  $campoOrdenar = "ESTADO.EST_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "unidad")  $campoOrdenar = "UNIDAD_AGREGADO.UNI_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "") $campoOrdenar = "TIPO_ANIMAL.TANIM_CODIGO ASC";
		
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
	       	  TIPO_ANIMAL.TANIM_DESCRIPCION,
          	ESTADO_ANIMAL.SEC_CODIGO,
				  	TIPO_SECCION.SEC_DESCRIPCION
	      FROM ESTADO_ANIMAL
	      LEFT OUTER JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
	      RIGHT OUTER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
	      INNER JOIN UNIDAD ON (CABALLO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
	      LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ANIMAL.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
	      LEFT OUTER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
        LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ANIMAL.SEC_CODIGO)
	      WHERE CABALLO.TANI_CODIGO=40 AND CABALLO.UNI_CODIGO=".$unidad." AND ESTADO_ANIMAL.FECHA_HASTA IS NULL";
	      
   	if ($nombreBuscar != "") $sql .= " AND CABALLO.CAB_NOMBRE LIKE '%".$nombreBuscar."%' ";	

		$sql .= " ORDER BY ".$campoOrdenar;
	  //$sql .= " ORDER BY caballo.CAB_CODIGO, caballo.CAB_NOMBRE";
		//echo $sql;
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ) {	
			$estado = new estadoVehiculo;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			
			$tipo = new tipoAnimal;
			$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));
			
			$seccion = new seccion; //Instancia agregada el 28-04-2015
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$animal = new animal;
			$animal->setCodigoAnimal(STRTOUPPER($myrow["CAB_CODIGO"]));
			$animal->setNombreAnimal(STRTOUPPER($myrow["CAB_NOMBRE"]));
			$animal->setUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$animal->setNumeroBCU($myrow["CAB_BCU"]);
			$animal->setFechaNacimiento(STRTOUPPER($myrow["FECHA_NAC"]));
			$animal->setRaza(STRTOUPPER($myrow["CAB_RAZA"]));
	  	$animal->setColor(STRTOUPPER($myrow["CAB_COLOR"]));
			$animal->setPelaje(STRTOUPPER($myrow["CAB_PELAJE"]));
			$animal->setSexo(STRTOUPPER($myrow["CAB_SEXO"]));
			$animal->setEstadoAnimal($estado);
			$animal->setUnidadAgregado($unidadAgregado);
			$animal->setTipoAnimal($tipo);
      $animal->setSeccion($seccion);
			
			$Animales[$i] = $animal;					
			$i++;
		}
	}
	
	function listaCaballosAgregados($unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $Animales){
		
		if ($NombreCampo == "tipo")  $campoOrdenar = "CABALLO.CAB_CODIGO ".$TipoOrden;
		if ($NombreCampo == "nombre") $campoOrdenar = "CABALLO.CAB_NOMBRE ".$TipoOrden;
		if ($NombreCampo == "color") $campoOrdenar = "CABALLO.CAB_RAZA ".$TipoOrden;
		if ($NombreCampo == "bcu")  $campoOrdenar = "CABALLO.CAB_BCU ".$TipoOrden;
		if ($NombreCampo == "seccion")  $campoOrdenar = "TIPO_SECCION.SEC_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "estado")  $campoOrdenar = "ESTADO.EST_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "unidad")  $campoOrdenar = "UNIDAD_AGREGADO.UNI_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "") $campoOrdenar = "TIPO_ANIMAL.TANIM_CODIGO ASC";
		
		$sql = "SELECT 
	            CABALLO.CAB_CODIGO,
	            CABALLO.CAB_BCU,
	            CABALLO.CAB_NOMBRE,
	            CABALLO.FECHA_NAC,
	            CABALLO.CAB_RAZA,
	            CABALLO.CAB_COLOR,
	            CABALLO.CAB_PELAJE,
	            CABALLO.CAB_SEXO,
	            ESTADO.EST_CODIGO,
	            ESTADO.EST_DESCRIPCION,
	            UNIDAD.UNI_CODIGO,
	         	  UNIDAD.UNI_DESCRIPCION,
	         	  ESTADO_ANIMAL.UNI_AGREGADO,
	         	  UNIDAD_AGREGADO.UNI_DESCRIPCION DESCRIPCION_AGREGADO,
	         	  TIPO_ANIMAL.TANIM_CODIGO,
	         	  TIPO_ANIMAL.TANIM_DESCRIPCION,
          		ESTADO_ANIMAL.SEC_CODIGO,
				  		TIPO_SECCION.SEC_DESCRIPCION
	          FROM ESTADO_ANIMAL
	          LEFT JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
	          RIGHT JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
	          JOIN UNIDAD ON (CABALLO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
	          LEFT JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ANIMAL.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
	          LEFT JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
        		LEFT JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ANIMAL.SEC_CODIGO)
	          WHERE CABALLO.TANI_CODIGO=10 AND ESTADO_ANIMAL.UNI_AGREGADO=".$unidad." AND ESTADO_ANIMAL.FECHA_HASTA IS NULL";
	      
   	if ($nombreBuscar != "") $sql .= " AND CABALLO.CAB_NOMBRE LIKE '%".$nombreBuscar."%' ";

		$sql .= " ORDER BY ".$campoOrdenar;		
		//echo $sql;
	
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ) {
			
			$estado = new estadoVehiculo;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DESCRIPCION_AGREGADO"]));
			
			$tipo = new tipoAnimal;
			$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));
			
			$seccion = new seccion; //Instancia agregada el 28-04-2015
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$animal = new animal;
			$animal->setCodigoAnimal(STRTOUPPER($myrow["CAB_CODIGO"]));
			$animal->setNombreAnimal(STRTOUPPER($myrow["CAB_NOMBRE"]));
			$animal->setNumeroBCU($myrow["CAB_BCU"]);
			$animal->setFechaNacimiento(STRTOUPPER($myrow["FECHA_NAC"]));
			$animal->setRaza(STRTOUPPER($myrow["CAB_RAZA"]));
	  	$animal->setColor(STRTOUPPER($myrow["CAB_COLOR"]));
			$animal->setPelaje(STRTOUPPER($myrow["CAB_PELAJE"]));
			$animal->setSexo(STRTOUPPER($myrow["CAB_SEXO"]));
			$animal->setEstadoAnimal($estado);
			$animal->setUnidadAgregado($unidadAgregado);
			$animal->setUnidad($unidad);
			$animal->setTipoAnimal($tipo);
      $animal->setSeccion($seccion);
			
			$Animales[$i] = $animal;
			$i++;
		}
	}
	
	function listaPerrosAgregados($unidad, $nombreBuscar, $NombreCampo, $TipoOrden, $Animales){
		
		if ($NombreCampo == "tipo")  $campoOrdenar = "CABALLO.CAB_CODIGO ".$TipoOrden;
		if ($NombreCampo == "nombre") $campoOrdenar = "CABALLO.CAB_NOMBRE ".$TipoOrden;
		if ($NombreCampo == "color") $campoOrdenar = "CABALLO.CAB_RAZA ".$TipoOrden;
		if ($NombreCampo == "bcu")  $campoOrdenar = "CABALLO.CAB_BCU ".$TipoOrden;
		if ($NombreCampo == "seccion")  $campoOrdenar = "TIPO_SECCION.SEC_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "estado")  $campoOrdenar = "ESTADO.EST_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "unidad")  $campoOrdenar = "UNIDAD_AGREGADO.UNI_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "") $campoOrdenar = "TIPO_ANIMAL.TANIM_CODIGO ASC";
		
		$sql = "SELECT 
	            CABALLO.CAB_CODIGO,
	            CABALLO.CAB_BCU,
	            CABALLO.CAB_NOMBRE,
	            CABALLO.FECHA_NAC,
	            CABALLO.CAB_RAZA,
	            CABALLO.CAB_COLOR,
	            CABALLO.CAB_PELAJE,
	            CABALLO.CAB_SEXO,
	            ESTADO.EST_CODIGO,
	            ESTADO.EST_DESCRIPCION,
	            UNIDAD.UNI_CODIGO,
	         	  UNIDAD.UNI_DESCRIPCION,
	         	  ESTADO_ANIMAL.UNI_AGREGADO,
	         	  UNIDAD_AGREGADO.UNI_DESCRIPCION DESCRIPCION_AGREGADO,
	         	  TIPO_ANIMAL.TANIM_CODIGO,
	         	  TIPO_ANIMAL.TANIM_DESCRIPCION,
          		ESTADO_ANIMAL.SEC_CODIGO,
				  		TIPO_SECCION.SEC_DESCRIPCION
	          FROM ESTADO_ANIMAL
	          LEFT OUTER JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
	          RIGHT OUTER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
	          INNER JOIN UNIDAD ON (CABALLO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
	          LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ANIMAL.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
	          LEFT OUTER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
        		LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ANIMAL.SEC_CODIGO)
	          WHERE CABALLO.TANI_CODIGO=40 AND ESTADO_ANIMAL.UNI_AGREGADO=".$unidad." AND ESTADO_ANIMAL.FECHA_HASTA IS NULL";
	      
   	if ($nombreBuscar != "") $sql .= " AND CABALLO.CAB_NOMBRE LIKE '%".$nombreBuscar."%' ";	

		$sql .= " ORDER BY ".$campoOrdenar;		
		//echo $sql;
	
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ) {
			
			$estado = new estadoVehiculo;
			$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DESCRIPCION_AGREGADO"]));
			
			$tipo = new tipoAnimal;
			$tipo->setCodigo(STRTOUPPER($myrow["TANIM_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));
			
			$seccion = new seccion; //Instancia agregada el 28-04-2015
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$animal = new animal;
			$animal->setCodigoAnimal(STRTOUPPER($myrow["CAB_CODIGO"]));
			$animal->setNombreAnimal(STRTOUPPER($myrow["CAB_NOMBRE"]));
			$animal->setNumeroBCU($myrow["CAB_BCU"]);
			$animal->setFechaNacimiento(STRTOUPPER($myrow["FECHA_NAC"]));
			$animal->setRaza(STRTOUPPER($myrow["CAB_RAZA"]));
	  	$animal->setColor(STRTOUPPER($myrow["CAB_COLOR"]));
			$animal->setPelaje(STRTOUPPER($myrow["CAB_PELAJE"]));
			$animal->setSexo(STRTOUPPER($myrow["CAB_SEXO"]));
			$animal->setEstadoAnimal($estado);
			$animal->setUnidadAgregado($unidadAgregado);
			$animal->setUnidad($unidad);
			$animal->setTipoAnimal($tipo);
      $animal->setSeccion($seccion);
			
			$Animales[$i] = $animal;
			$i++;
		}
	}
	
	function buscaDatosAnimal($codigoAnimal, $bcuAnimal, $Animales){
	
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
	          ESTADO_ANIMAL.UNI_AGREGADO,
          	ESTADO_ANIMAL.SEC_CODIGO,
				  	TIPO_SECCION.SEC_DESCRIPCION
	      FROM ESTADO_ANIMAL
	      LEFT OUTER JOIN ESTADO ON (ESTADO_ANIMAL.EST_CODIGO = ESTADO.EST_CODIGO)
	      RIGHT OUTER JOIN CABALLO ON (ESTADO_ANIMAL.ANI_CODIGO = CABALLO.CAB_CODIGO)
	      LEFT OUTER JOIN UNIDAD ON (CABALLO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
	      LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ANIMAL.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
        LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ANIMAL.SEC_CODIGO)
	      LEFT OUTER JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
	      WHERE ESTADO_ANIMAL.FECHA_HASTA IS NULL";
	  
		if ($codigoAnimal != "") $sql .= " AND CABALLO.CAB_CODIGO = ".$codigoAnimal;
		if ($bcuAnimal != "") $sql .= " AND CABALLO.CAB_BCU = '".$bcuAnimal."'";
	  
	  //$sql .= " ORDER BY caballo.CAB_CODIGO, caballo.CAB_NOMBRE";
		//echo $sql;
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ) {
			
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
			
			$seccion = new seccion; //Instancia agregada el 28-04-2015
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$Animales = new animal;
			$Animales->setCodigoAnimal(STRTOUPPER($myrow["CAB_CODIGO"]));
			$Animales->setNombreAnimal(STRTOUPPER($myrow["CAB_NOMBRE"]));
		  $Animales->setUnidad($unidad);	
			$Animales->setNumeroBCU($myrow["CAB_BCU"]);
			$Animales->setFechaNacimiento(STRTOUPPER($myrow["FECHA_NAC"]));
			$Animales->setRaza(STRTOUPPER($myrow["CAB_RAZA"]));
	  	$Animales->setColor(STRTOUPPER($myrow["CAB_COLOR"]));
			$Animales->setPelaje(STRTOUPPER($myrow["CAB_PELAJE"]));
			$Animales->setSexo(STRTOUPPER($myrow["CAB_SEXO"]));
			$Animales->setVerifica(STRTOUPPER($myrow["VERIFICACION_ESTADO"]));
			$Animales->setEstadoAnimal($estado);
			$Animales->setUnidadAgregado($unidadAgregado);
			$Animales->setTipoAnimal($tipo);
      $Animales->setSeccion($seccion);
	
		}
	}
	
	function buscaCaballoL4($codigoBcu, $Animales){
		
		$sql = "SELECT 
	         animales.codigo_animal,
	         animales.nombre_animal,
	         raza.descripcion_raza,
	         animales.fecha_nacimiento,
	         animales.sexo,
	         animales.pelaje,
	         animales.color
	       FROM animales
	       LEFT JOIN raza ON (animales.raza = raza.codigo_raza)
	       WHERE animales.codigo_animal ='".$codigoBcu."'";
		         				
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) )  {
	
			$Animales = new animal;
			
			$Animales->setNumeroBCU($myrow["codigo_animal"]);
			$Animales->setNombreAnimal(STRTOUPPER($myrow["nombre_animal"]));
			$Animales->setFechaNacimiento(STRTOUPPER($myrow["fecha_nacimiento"]));
			$Animales->setRaza(STRTOUPPER($myrow["descripcion_raza"]));
			$Animales->setSexo(STRTOUPPER($myrow["sexo"]));
			$Animales->setPelaje(STRTOUPPER($myrow["pelaje"]));
			$Animales->setColor(STRTOUPPER($myrow["color"]));
			
		}
	}
	
	function updateEstadoAnimal($animal, $fechaNuevoEstado){
		
		$sql = "UPDATE ESTADO_ANIMAL SET
				FECHA_HASTA = '".$fechaNuevoEstado."'
				WHERE ANI_CODIGO = ".$animal->getCodigoAnimal()." AND FECHA_HASTA IS NULL";
		
		//echo $sql;
		//$result = 1;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}		
	
	function insertEstadoAnimal($animal, $fechaNuevoEstado){
		
		//echo "aqui";
		//echo "jjjj " . $vehiculo->getLugarReparacion()->getCodigo();
		
		if ($animal->getUnidadAgregado()->getCodigoUnidad() == 0) $unidadAgregadoGuardar = 'NULL';
		else $unidadAgregadoGuardar = $animal->getUnidadAgregado()->getCodigoUnidad();
		
		if ($animal->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
    else $seccionGuardar = $animal->getSeccion()->getCodigo();
		
		$sql = "INSERT INTO ESTADO_ANIMAL (ANI_CODIGO, EST_CODIGO, UNI_CODIGO, FECHA_DESDE, UNI_AGREGADO, SEC_CODIGO)
				VALUES (".$animal->getCodigoAnimal().",".$animal->getEstadoAnimal()->getCodigo().",".$animal->getUnidad()->getCodigoUnidad().",'".$fechaNuevoEstado."',".$unidadAgregadoGuardar.",".$seccionGuardar.")";
		
		//echo $sql;
		//$result = 1;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function bajaAnimal($animal, $motivo, $fecha){ 
		
		$sql = "INSERT INTO ESTADO_ANIMAL(ANI_CODIGO,EST_CODIGO, UNI_CODIGO, FECHA_DESDE, FECHA_HASTA)
			   VALUES (".$animal->getCodigoAnimal().",".$animal->getEstadoAnimal()->getCodigo().",".$animal->getUnidad()->getCodigoUnidad().",'".$fecha."','".$fecha."');";
		
		//echo $sql;		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateAnimal($animal){
			
		$sql = "UPDATE CABALLO SET
		    TANI_CODIGO = " .$animal->getTipoAnimal().", 
				CAB_BCU = '" . $animal->getNumeroBCU() . "', 
				CAB_NOMBRE = '".$animal->getNombreAnimal(). "',
				UNI_CODIGO = ".$animal->getUnidad()->getCodigoUnidad(). ",
				CAB_RAZA = '".$animal->getRaza(). "',
				CAB_COLOR = '".$animal->getColor(). "',
				CAB_PELAJE = '".$animal->getPelaje(). "',
				VERIFICACION_ESTADO = '".$animal->getVerifica(). "'
				WHERE CAB_CODIGO =" . $animal->getCodigoAnimal();
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}	
	
	function dejarDisponible($animal, $fecha){
		
		$sql = "UPDATE CABALLO SET UNI_CODIGO = Null WHERE CAB_CODIGO = " . $animal->getCodigoAnimal();
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		//$result	= 1;
		return $result;
	}
	
	function nuevoAnimal($animal){ 
		
		$sql = "INSERT INTO CABALLO
			   (TANI_CODIGO, CAB_BCU, CAB_NOMBRE, UNI_CODIGO, FECHA_NAC, CAB_RAZA, CAB_COLOR, CAB_PELAJE, CAB_SEXO, VERIFICACION_ESTADO) VALUES
		 	   (".$animal->getTipoAnimal().", 
		 	   '".$animal->getNumeroBCU()."',
		 	   '".$animal->getNombreAnimal()."',
		 	   ".$animal->getUnidad()->getCodigoUnidad(). ",
		 	   '".$animal->getFechaNacimiento()."',
		 	   '".$animal->getRaza()."',
		 	   '".$animal->getColor()."',
		 	   '".$animal->getPelaje()."',
		 	   '".$animal->getSexo()."',
		 	   '".$animal->getVerifica()."')";
		 	    
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		//return $result;
		return mysql_insert_id($this->Conecta()); 
	}
	
	function listaAnimalesDisponibles($unidad, $fechaServicio, $tipoServicio, $horaInicio, $horaTermino, $correlativo, $Animales){
	  
		$listaExcluyente 	= $this->listaAnimalesExcluyentes($unidad, $fechaServicio, $horaInicio, $horaTermino, $correlativo);
		$sqlExcluyente 		= "AND CABALLO.CAB_CODIGO NOT IN ({$listaExcluyente})";
		
		$sql = "SELECT 
			     	CABALLO.CAB_NOMBRE,
					CABALLO.CAB_BCU,
					CABALLO.CAB_CODIGO,
					TIPO_ANIMAL.TANIM_DESCRIPCION,
					CABALLO.TANI_CODIGO
				FROM CABALLO
				JOIN ESTADO_ANIMAL ON (CABALLO.CAB_CODIGO = ESTADO_ANIMAL.ANI_CODIGO)
				JOIN TIPO_ANIMAL ON (CABALLO.TANI_CODIGO = TIPO_ANIMAL.TANIM_CODIGO)
				WHERE IF(ESTADO_ANIMAL.UNI_AGREGADO,ESTADO_ANIMAL.UNI_AGREGADO,ESTADO_ANIMAL.UNI_CODIGO) = {$unidad}
					AND (ESTADO_ANIMAL.FECHA_DESDE <= '{$fechaServicio}' AND (ESTADO_ANIMAL.FECHA_HASTA >= '{$fechaServicio}' OR ESTADO_ANIMAL.FECHA_HASTA IS NULL)) 
					AND ESTADO_ANIMAL.EST_CODIGO IN (10,3000)
					{$sqlExcluyente}
				ORDER BY TANIM_DESCRIPCION, CAB_NOMBRE";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) )  {
			
			$tipo = new tipoAnimal;
			$tipo->setCodigo(STRTOUPPER($myrow["TANI_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TANIM_DESCRIPCION"]));
										
			$animal = new animal;
			$animal->setCodigoAnimal(STRTOUPPER($myrow["CAB_CODIGO"]));
			$animal->setTipoAnimal($tipo);
			$animal->setNumeroBCU(STRTOUPPER($myrow["CAB_BCU"]));
			$animal->setNombreAnimal(STRTOUPPER($myrow["CAB_NOMBRE"]));
		
			$Animales[$i] = $animal;					
			$i++;
		}
	}
	
	function listaAnimalesExcluyentes($unidad, $fechaServicio, $horaI, $horaT, $correlativo){
		
		$sql = "SELECT ANIMALES_SERVICIO.ANIM_CODIGO
						FROM ANIMALES_SERVICIO
						JOIN SERVICIO ON (ANIMALES_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO AND ANIMALES_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
						WHERE SERVICIO.FECHA = '{$fechaServicio}' AND SERVICIO.UNI_CODIGO = {$unidad}
						AND (SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) BETWEEN SERVICIO.HORA_INICIO AND SERVICIO.HORA_TERMINO
						OR SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1) BETWEEN SERVICIO.HORA_INICIO AND SERVICIO.HORA_TERMINO
						OR SERVICIO.HORA_INICIO BETWEEN SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) AND SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1))";
		//Servicio existente
		if($correlativo != "" && $correlativo != "-1") $sql .= " OR (SERVICIO.UNI_CODIGO = {$unidad} AND SERVICIO.CORRELATIVO_SERVICIO = {$correlativo})";
		//echo $sql;
    $result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$listaAnimales = "'',";
		while($myrow = mysql_fetch_array($result)){
			$listaAnimales .= "'".$myrow["ANIM_CODIGO"]."',";
		}
    $listaAnimales = substr($listaAnimales, 0, strlen($listaAnimales)-1);
    return $listaAnimales;
	}

}//end class        
?>