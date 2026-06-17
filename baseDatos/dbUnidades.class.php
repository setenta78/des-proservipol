<?
// INICIO DE FUNCIONES

Class dbUnidad extends Conexion{

	function descripcionUnidad($codigoUnidad){
		 
		 $sql = "SELECT 
				 UNIDAD.UNI_DESCRIPCION
				 FROM UNIDAD
				 WHERE UNIDAD.UNI_CODIGO = {$codigoUnidad}";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $myrow = mysql_fetch_array($result);
		 return $myrow["UNI_DESCRIPCION"];
	}
	
	function listaUnidades($codigoUnidadPadre){
		
		//if($codigoUnidadPadre==120 || $codigoUnidadPadre==220 ||$codigoUnidadPadre==700 || $codigoUnidadPadre==9620 || $codigoUnidadPadre==410 || $codigoUnidadPadre==1030 || $codigoUnidadPadre==1550 || $codigoUnidadPadre==10610 || $codigoUnidadPadre==1840 || $codigoUnidadPadre==310 || $codigoUnidadPadre==1900 || $codigoUnidadPadre==830 || $codigoUnidadPadre==130 || $codigoUnidadPadre==8730 || $codigoUnidadPadre==9720){
		//	$gope=" UNIDAD.UNI_CODIGO NOT IN(10960,10970,10980,11010,11030,11380,11400,11460,11490,11510,11540,11550,11560,11570,11910) AND ";
		//}else{
		//	$gope="";
		//}	
		$gope="";
		/*
		$sql = "SELECT 
					UNIDAD.UNI_CODIGO,
					UNIDAD.UNI_PADRE,
					UNIDAD.UNI_DESCRIPCION
					FROM UNIDAD
					WHERE UNIDAD.UNI_PADRE = " . $codigoUnidadPadre;
		*/
		$sql = "SELECT 
					UNIDAD.UNI_CODIGO,
					UNIDAD.UNI_PADRE,
					UNIDAD.UNI_DESCRIPCION,
					UNIDAD1.UNI_PADRE AS UNI_ABUELO,
					UNIDAD.UNI_PLANCUADRANTE,
					UNIDAD.UNI_SELECCIONABLE,
					UNIDAD.UNI_TIPOUNIDAD
				FROM UNIDAD
				LEFT OUTER JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
				WHERE ".$gope." UNIDAD.UNI_MOSTRAR = 1 AND ";
		
		if ($codigoUnidadPadre != "") $sql .= " UNIDAD.UNI_PADRE = " . $codigoUnidadPadre; 
		if ($codigoUnidadPadre == "") $sql .= "	UNIDAD.UNI_PADRE IS NULL"; 
		
		$sql .= " ORDER BY UNIDAD.UNI_DESCRIPCION";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ){
			
			if ($myrow["UNI_ABUELO"] == "") $codigoAbuelo = "-1";
			else $codigoAbuelo = STRTOUPPER($myrow["UNI_ABUELO"]);
			
			$abuelo = new Unidad;
			$abuelo->setCodigoUnidad($codigoAbuelo);
			
			$padre = new Unidad;
			$padre->setCodigoUnidad(STRTOUPPER($myrow["UNI_PADRE"]));
			$padre->setPadreUnidad($abuelo);
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$unidad->setPadreUnidad($padre);
			$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			$unidad->setSeleccionable($myrow["UNI_SELECCIONABLE"]);
			$unidad->setTienePlanCuadrante($myrow["UNI_PLANCUADRANTE"]);
			$unidad->setTipoUnidad($myrow["UNI_TIPOUNIDAD"]);
			
			$unidades[$i] = $unidad;
			$i++;
		} 
		return $unidades;
	}
	
	function unidadPadre($codigoUnidad){
		
		$sql = "SELECT 
					UNIDAD.UNI_CODIGO,
					UNIDAD.UNI_DESCRIPCION
				FROM UNIDAD
				JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_CODIGO = UNIDAD1.UNI_PADRE)
				WHERE UNIDAD1.UNI_CODIGO = {$codigoUnidad}";
	    //echo $sql;
	    $result = $this->execstmt($this->Conecta(),$sql);
	    mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ){
			$padre = new Unidad;
			$padre->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$padre->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			$i++;
		}
		return $padre;
	}
	
 	function listaUnidadesEspecializadas($tipoUnidad,$codigoUnidadPadre,$unidadUsuario,$correlativo){
		
			if($correlativo!=""){
				$disponible = "AND UNIDAD.UNI_CODIGO NOT IN (SELECT UNIDAD_SERVICIO.UNIDAD_SERVICIO 
															FROM UNIDAD_SERVICIO
															WHERE UNI_CODIGO = {$unidadUsuario}
															AND	CORRELATIVO_SERVICIO = {$correlativo})";
			}else{
				$disponible = "";
			}
			
			$sql = "SELECT 
						ESPECIALIDAD_TUNIDAD.UNI_ESPECIALIZADA,
						UNIDAD.UNI_CODIGO,
						UNIDAD.UNI_PADRE,
						ESPECIALIDAD_TUNIDAD.UNI_ESPECIALIZADA AS UNI_ABUELO,
						UNIDAD.UNI_DESCRIPCION,
						UNIDAD.UNI_PLANCUADRANTE,
						UNIDAD.UNI_SELECCIONABLE,
						UNIDAD.UNI_TIPOUNIDAD
					FROM ESPECIALIDAD_TUNIDAD
                    LEFT JOIN UNIDAD ON (ESPECIALIDAD_TUNIDAD.UNI_CODIGO = UNIDAD.UNI_PADRE) 
                    WHERE ESPECIALIDAD_TUNIDAD.ACTIVO = 1 
					AND UNIDAD.UNI_CODIGO IS NOT NULL 
					AND ESPECIALIDAD_TUNIDAD.UNI_ESPECIALIZADA = {$unidadUsuario} 
					AND UNIDAD.UNI_PADRE = {$codigoUnidadPadre} {$disponible}
					UNION 
					SELECT 
						ESPECIALIDAD_TUNIDAD.UNI_ESPECIALIZADA,
						UNIDAD.UNI_CODIGO,
						UNIDAD.UNI_PADRE,
						ESPECIALIDAD_TUNIDAD.UNI_ESPECIALIZADA AS UNI_ABUELO,
						UNIDAD.UNI_DESCRIPCION,
						UNIDAD.UNI_PLANCUADRANTE,
						UNIDAD.UNI_SELECCIONABLE,
						UNIDAD.UNI_TIPOUNIDAD
					FROM ESPECIALIDAD_TUNIDAD
					LEFT JOIN UNIDAD ON (ESPECIALIDAD_TUNIDAD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					WHERE ESPECIALIDAD_TUNIDAD.ACTIVO = 1
					AND UNIDAD.UNI_CODIGO IS NOT NULL
					AND ESPECIALIDAD_TUNIDAD.UNI_ESPECIALIZADA = {$codigoUnidadPadre} {$disponible}
					ORDER BY UNI_DESCRIPCION";
			//echo $sql;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			$i=0;
			while( $myrow = mysql_fetch_array($result) ){
				
				if ($myrow["UNI_ABUELO"] == "") $codigoAbuelo = "-1";
				else $codigoAbuelo = STRTOUPPER($myrow["UNI_ABUELO"]);
				
				$abuelo = new Unidad;
				$abuelo->setCodigoUnidad($codigoAbuelo);
				
				$padre = new Unidad;
				$padre->setCodigoUnidad(STRTOUPPER($myrow["UNI_PADRE"]));
				$padre->setPadreUnidad($abuelo);
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
				$unidad->setPadreUnidad($padre);
				$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
				$unidad->setTienePlanCuadrante($myrow["UNI_PLANCUADRANTE"]);
				$unidad->setSeleccionable($myrow["UNI_SELECCIONABLE"]);
				$unidad->setTipoUnidad($myrow["UNI_TIPOUNIDAD"]);
				
				$unidades[$i] = $unidad;
				$i++;
			}
			return $unidades;
	}

	function buscarUnidad($buscar, $unidades){
		$sql = "SELECT 
				UNI_CODIGO,
				UNI_DESCRIPCION
				FROM UNIDAD
				WHERE UNI_DESCRIPCION LIKE '{$buscar}'";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while( $myrow = mysql_fetch_array($result) ){
			$unidad = new Unidad;
			$unidad->setCodigoUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			
			$unidades[$i] = $unidad;
			$i++;
		}
		return $padre;
	}
	
	function buscarUnidadCodigo($codigoUnidad){
		
		$sql = "SELECT 
					U.UNI_CODIGO,
					U.UNI_PADRE,
					U.UNI_DESCRIPCION,
					U1.UNI_PADRE UNI_ABUELO,
					IF(ISNULL(U2.UNI_CODIGO),0,1) CONHIJOS,
					U.UNI_CAPTURA
				FROM UNIDAD U
				LEFT JOIN UNIDAD U1 ON U.UNI_PADRE = U1.UNI_CODIGO
				LEFT JOIN UNIDAD U2 ON U.UNI_CODIGO = U2.UNI_PADRE
				WHERE U.UNI_MOSTRAR = 1 AND U.UNI_CODIGO <> 1 AND U.UNI_PADRE = {$codigoUnidad}
				GROUP BY U.UNI_CODIGO
				ORDER BY U.UNI_ORDEN, U.UNI_CODIGO";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
			
			$abuelo = new Unidad;
			$abuelo->setCodigoUnidad($myrow["UNI_ABUELO"]);
			
			$padre = new Unidad;
			$padre->setCodigoUnidad($myrow["UNI_PADRE"]);
			$padre->setPadreUnidad($abuelo);
			
			$unidad = new Unidad;
			$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			$unidad->setContieneHijos($myrow["CONHIJOS"]);
			$unidad->setCaptura($myrow["UNI_CAPTURA"]);
			$unidad->setPadreUnidad($padre);
			$unidades[$i] = $unidad;
			$i++;
		}
		return $unidades;
	}
	
	function buscarUnidadNombre($descUnidad){
		
		$sql = "SELECT 
					U.UNI_CODIGO,
					U.UNI_PADRE,
					U.UNI_DESCRIPCION,
					U1.UNI_PADRE UNI_ABUELO,
					IF(ISNULL(U2.UNI_CODIGO),0,1) CONHIJOS,
					U.UNI_CAPTURA
				FROM UNIDAD U
				LEFT JOIN UNIDAD U1 ON U.UNI_PADRE = U1.UNI_CODIGO
				WHERE U.UNI_MOSTRAR = 1 AND U.UNI_DESCRIPCION LIKE '%{$descUnidad}%'
				AND U.UNI_CODIGO NOT IN (0,1,20)";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while( $myrow = mysql_fetch_array($result) ){
			
			$abuelo = new Unidad;
			$abuelo->setCodigoUnidad($myrow["UNI_ABUELO"]);
			
			$padre = new Unidad;
			$padre->setCodigoUnidad($myrow["UNI_PADRE"]);
			$padre->setPadreUnidad($abuelo);
			
			$unidad = new Unidad;
			$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$unidad->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			$unidad->setContieneHijos($myrow["CONHIJOS"]);
			$unidad->setCaptura($myrow["UNI_CAPTURA"]);
			$unidad->setPadreUnidad($padre);
			$unidades[$i] = $unidad;
			$i++;
		}
		return $unidades;
	}

}//end class   
?>