<?
Class dbAnotaciones extends conexion
{			

	function listarAnotacion($unidad,$correlativoServicio,$numeroMedio,$listadoAnotacion,$cantidadAnotaciones){

		$sql = "SELECT 
           ANOT_ID,
  				 ANOTACIONES.FACT_CODIGO,
  				 ANOT_HORA_INICIO,
  				 ANOT_HORA_TERMINO,
           ANOTACIONES.CUADRANTE_CODIGO,
           UNI_CODIGO_OTRO,
           CUADRANTE.CUA_DESCRIPCION,
           UNI_DESCRIPCION,
           FACT_DESCRIPCION
				FROM
				  ANOTACIONES
				  LEFT JOIN UNIDAD_CUADRANTE ON (ANOTACIONES.CUADRANTE_CODIGO = UNIDAD_CUADRANTE.CUADRANTE_CODIGO)
				  LEFT JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
				  LEFT JOIN UNIDAD ON (ANOTACIONES.UNI_CODIGO_OTRO = UNIDAD.UNI_CODIGO)
				  LEFT JOIN FACTORES ON (ANOTACIONES.FACT_CODIGO = FACTORES.FACT_CODIGO)
				WHERE 1";
				
		$sql .= " AND ANOTACIONES.UNI_CODIGO            = '".$unidad."'";
		$sql .= " AND ANOTACIONES.CORRELATIVO_SERVICIO = '".$correlativoServicio."'";
		$sql .= " AND ANOTACIONES.NUMERO_MEDIO = '".$numeroMedio."'";
		
		$sql .= " ORDER BY ANOTACIONES.ANOT_ID ASC";

		
		//echo $sql;
										
		$result = $this->execstmt($this->Conecta(DB_HOST_SERVICIOS,DB_USER_SERVICIOS,DB_PASS_SERVICIOS,DB_DB_SERVICIOS),$sql);
		//echo $result;
		$i = 0;
		while($myrow = mysql_fetch_array($result)) {

			$anotacion = new anotacion;
			$anotacion->setIdAnotacion($myrow["ANOT_ID"]);
			$anotacion->setFactor($myrow["FACT_CODIGO"]);
			$anotacion->setDescripcionFactor($myrow["FACT_DESCRIPCION"]);
			$anotacion->setHoraInicio($myrow["ANOT_HORA_INICIO"]);
			$anotacion->setHoraTermino($myrow["ANOT_HORA_TERMINO"]);
			$anotacion->setCuadrante($myrow["CUADRANTE_CODIGO"]);
			$anotacion->setDescripcionCuadrante($myrow["CUA_DESCRIPCION"]);
			$anotacion->setOtraUnidad($myrow["UNI_CODIGO_OTRO"]);
			$anotacion->setDescripcionOtraUnidad($myrow["UNI_DESCRIPCION"]);
			
			$listadoAnotacion[$i] = $anotacion;				
			$i++;
		}
		$cantidadAnotaciones = $i;
	}


	function insertAnotacion($anotacion){

		$sql = "INSERT 
				INTO ANOTACIONES 
				(UNI_CODIGO,
  				 CORRELATIVO_SERVICIO,
  				 NUMERO_MEDIO,
  				 ANOT_ID,
  				 FACT_CODIGO,
  				 ANOT_HORA_INICIO,
  				 ANOT_HORA_TERMINO,
  				 CUADRANTE_CODIGO,
  				 UNI_CODIGO_OTRO)
				VALUES 
				 (
          '".$anotacion->getHojaRuta()->getUnidad()."',
          '".$anotacion->getHojaRuta()->getCorrelativoServicio()."',
          '".$anotacion->getHojaRuta()->getNumeroMedio()."',
				  '".$anotacion->getIdAnotacion()."',
				  '".$anotacion->getFactor()."',
				  '".$anotacion->getHoraInicio()."',
				  '".$anotacion->getHoraTermino()."',
				  ".$anotacion->getCuadrante().",
				  ".$anotacion->getOtraUnidad()."
				  );";

		//echo $sql;

		$result = $this->execstmt($this->Conecta(DB_HOST_SERVICIOS,DB_USER_SERVICIOS,DB_PASS_SERVICIOS,DB_DB_SERVICIOS),$sql);
		echo $result;
		return $result;
	}





}//end class   
?>