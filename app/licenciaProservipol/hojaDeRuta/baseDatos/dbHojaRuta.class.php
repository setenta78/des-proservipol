<?
Class dbHojaRuta extends conexion
{			

	function listarHojaRuta($unidad,$correlativoServicio,$numeroMedio,$listadoHojaRuta,$cantidadHojaRuta){

		$sql = "SELECT 
           UNI_CODIGO,
  				 CORRELATIVO_SERVICIO,
  				 NUMERO_MEDIO,
  				 HR_HORA_INICIO_REAL,
           HR_HORA_TERMINO_REAL
				FROM
				  HOJA_RUTA
				WHERE 1";
				
		$sql .= " AND HOJA_RUTA.UNI_CODIGO            = '".$unidad."'";
		$sql .= " AND HOJA_RUTA.CORRELATIVO_SERVICIO = '".$correlativoServicio."'";
		$sql .= " AND HOJA_RUTA.NUMERO_MEDIO = '".$numeroMedio."'";
		
		$sql .= " ORDER BY HOJA_RUTA.NUMERO_MEDIO ASC";
		
		//echo $sql;
										
		$result = $this->execstmt($this->Conecta(DB_HOST_SERVICIOS,DB_USER_SERVICIOS,DB_PASS_SERVICIOS,DB_DB_SERVICIOS),$sql);
		$i = 0;
		while($myrow = mysql_fetch_array($result)) {

			$hojaRuta = new hojaRuta;
			$hojaRuta->setUnidad($myrow["UNI_CODIGO"]);
			$hojaRuta->setCorrelativoServicio($myrow["CORRELATIVO_SERVICIO"]);
			$hojaRuta->setNumeroMedio($myrow["NUMERO_MEDIO"]);
			$hojaRuta->setHoraInicioReal($myrow["HR_HORA_INICIO_REAL"]);
			$hojaRuta->setHoraTerminoReal($myrow["HR_HORA_TERMINO_REAL"]);
			
			$listadoHojaRuta[$i] = $hojaRuta;				
			$i++;
		}
		$cantidadHojaRuta = $i;
	}






	function insertHojaRuta($hojaRuta){
		
		$sql = "INSERT 
				INTO HOJA_RUTA 
				(UNI_CODIGO,
  				 CORRELATIVO_SERVICIO,
  				 NUMERO_MEDIO,
  				 HR_HORA_INICIO_REAL,
  				 HR_HORA_TERMINO_REAL)
				VALUES 
				 (
          '".$hojaRuta->getUnidad()."',
				  '".$hojaRuta->getCorrelativoServicio()."',
				  '".$hojaRuta->getNumeroMedio()."',
				  '".$hojaRuta->getHoraInicioReal()."',
				  '".$hojaRuta->getHoraTerminoReal()."'
				  );";

		//echo $sql;

		$result = $this->execstmt($this->Conecta(DB_HOST_SERVICIOS,DB_USER_SERVICIOS,DB_PASS_SERVICIOS,DB_DB_SERVICIOS),$sql);
		return $result;
	}





	function deleteHojaRuta($hojaRuta){
			
		$sql = "DELETE FROM HOJA_RUTA
          WHERE UNI_CODIGO = '".$hojaRuta->getUnidad()."'
  				AND CORRELATIVO_SERVICIO = '".$hojaRuta->getCorrelativoServicio()."'
  				AND NUMERO_MEDIO = '".$hojaRuta->getNumeroMedio()."';";
		
		//echo $sql;
				  
		$result = $this->execstmt($this->Conecta(DB_HOST_SERVICIOS,DB_USER_SERVICIOS,DB_PASS_SERVICIOS,DB_DB_SERVICIOS),$sql);
		return $result;
	}


	function deleteHojaRutaAnotaciones($hojaRuta){
			
		$sql = "DELETE FROM ANOTACIONES
          WHERE UNI_CODIGO = '".$hojaRuta->getUnidad()."'
  				AND CORRELATIVO_SERVICIO = '".$hojaRuta->getCorrelativoServicio()."'
  				AND NUMERO_MEDIO = '".$hojaRuta->getNumeroMedio()."';";
		
		//echo $sql;
				  
		$result = $this->execstmt($this->Conecta(DB_HOST_SERVICIOS,DB_USER_SERVICIOS,DB_PASS_SERVICIOS,DB_DB_SERVICIOS),$sql);
		return $result;
	}




}//end class   
?>