<?
// INICIO DE FUNCIONES

Class dbUnidad extends Conexion
{			
	function descripcionUnidad($codigoUnidad){
		 
		 $sql = "SELECT 
				 UNIDAD.UNI_DESCRIPCION
				 FROM UNIDAD
				 WHERE UNIDAD.UNI_CODIGO = " . $codigoUnidad;
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $myrow = mysql_fetch_array($result);
		 return $myrow["UNI_DESCRIPCION"];
	}
	
	
	function listaUnidades($codigoUnidadPadre){
		 
		$sql = "SELECT 
		 		 UNIDAD.UNI_CODIGO,
		 		 UNIDAD.UNI_PADRE,
				 UNIDAD.UNI_DESCRIPCION
				 FROM UNIDAD
				 WHERE UNIDAD.UNI_PADRE = " . $codigoUnidadPadre;
	     
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
				 WHERE UNIDAD.UNI_MOSTRAR = 1 AND ";
				 
		if ($codigoUnidadPadre != "") $sql .= " UNIDAD.UNI_PADRE = " . $codigoUnidadPadre; 
		if ($codigoUnidadPadre == "") $sql .= "	UNIDAD.UNI_PADRE IS NULL"; 
	     
	    $sql .= " ORDER BY UNIDAD.UNI_CODIGO";
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
				FROM
				  UNIDAD
				  INNER JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_CODIGO = UNIDAD1.UNI_PADRE)
				WHERE
				  UNIDAD1.UNI_CODIGO = ".$codigoUnidad;
	     
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
    
 //Funcion agregada el 20-04-2015
 	function listaUnidadesEspecializadas($tipoUnidad,$codigoUnidadPadre,$unidadUsuario,$correlativo){
		 
        if($tipoUnidad == 30 || $tipoUnidad == 120 || $tipoUnidad == 135){
		  
		  if($correlativo!=""){
		  $disponible="AND UNIDAD.UNI_CODIGO NOT IN(SELECT 
                         UNIDAD_SERVICIO.UNIDAD_SERVICIO 
                         FROM 
                         UNIDAD_SERVICIO
                         WHERE
                         UNI_CODIGO=".$unidadUsuario."	 AND
                         CORRELATIVO_SERVICIO=".$correlativo.")";
		  }else{
		  $disponible="";
		  }
				 $sql="SELECT 
                   ESPECIALIDAD_TUNIDAD.UNI_ESPECIALIZADA,
                    UNIDAD.UNI_CODIGO,
                    UNIDAD.UNI_PADRE,
                    ESPECIALIDAD_TUNIDAD.UNI_ESPECIALIZADA AS UNI_ABUELO,
                    UNIDAD.UNI_DESCRIPCION,
                    UNIDAD.UNI_PLANCUADRANTE,
                    UNIDAD.UNI_SELECCIONABLE,
                    UNIDAD.UNI_TIPOUNIDAD
                   FROM 
                    ESPECIALIDAD_TUNIDAD
                    LEFT OUTER JOIN UNIDAD ON (ESPECIALIDAD_TUNIDAD.UNI_CODIGO=UNIDAD.UNI_PADRE) 
                    WHERE
                    ESPECIALIDAD_TUNIDAD.ACTIVO=1 AND UNIDAD.UNI_CODIGO IS NOT NULL AND ESPECIALIDAD_TUNIDAD.UNI_ESPECIALIZADA=".$unidadUsuario." AND UNIDAD.UNI_PADRE=".$codigoUnidadPadre." ".$disponible."
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
                    FROM 
                    ESPECIALIDAD_TUNIDAD
                    LEFT OUTER JOIN UNIDAD ON (ESPECIALIDAD_TUNIDAD.UNI_CODIGO=UNIDAD.UNI_CODIGO) 
                    WHERE
                    ESPECIALIDAD_TUNIDAD.ACTIVO=1 AND UNIDAD.UNI_CODIGO IS NOT NULL AND
                    ESPECIALIDAD_TUNIDAD.UNI_ESPECIALIZADA=".$codigoUnidadPadre." ".$disponible;  
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
 }
	
}//end class   
?>